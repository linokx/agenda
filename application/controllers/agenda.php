<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		};
	}
	public function index()
	{
		$this->lister();
	}
	public function lister()
	{
		$prefs = array (
           'show_next_prev'  => TRUE
         );

		$this->load->library('calendar', $prefs);
		$data['pref'] = 6;
		$data['today'] = explode('-',date('d-m-Y'));
		$semaine = ($this->uri->segment(3))?$this->uri->segment(3):date('W');
		$annee = ($this->uri->segment(2))?$this->uri->segment(2):date('Y');
		$data['semaine'] = $semaine;
		$data['annee'] = $annee;
		$data['calendrier'] = $this->calendrier($data, 'thead');
		if($semaine-1 > 0){
			$data['precedent'] = $annee.'/'.($semaine-1);
		}
		else{
			$data['precedent'] = ($annee-1).'/'.date('W',strtotime(($annee-1).'-12-28'));
		}
		if($semaine+1 < date('W',strtotime($annee.'-12-28'))){
			$data['suivant'] = $annee.'/'.($semaine+1);
		}
		else
		{
			$data['suivant'] = ($annee+1).'/1';
		}
		$this->load->model('M_Agenda');
		$date = explode('-',date('N-d-m-Y'));
		$d = $date[1]-($date[0]-1);
		$m = $date[2];
		$y = $date[3];
		$long = 6;
		$date_min = date($y.'-'.$m.'-'.$d);		
		$date_max = date($y.'-'.$m.'-'.($d+($long-1)));
		$info_liste = $this->choixJour();
		//$data['rdvs'] =$this->M_Agenda->lister($info_liste);
		$data['rdvs'] = $this->calendrier($this->M_Agenda->lister($info_liste),'rdv');
		$id = $this->session->userdata('logged_in');
		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_agenda',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_agenda',$data,true);
		$this->load->view('layout',$dataLayout);
	}

	public function choixJour(){
		$annee = ($this->uri->segment(2)>0)?$this->uri->segment(2):date('Y');
		$semaine = ($this->uri->segment(3)>0)?$this->uri->segment(3):date('W');
		$prem = date('N',strtotime($annee.'-1-1')); //Premier jour de l'année
		$jours = $semaine*7;
		$compte = $prem-2;
		$j = 1;
		while(($jours-$compte)> $nbre_jours = date('t',strtotime($annee.'-'.$j.'-01'))){
			$j++;
			$compte += $nbre_jours;
		}
		$longueur = 7;
		$depart = date('d',strtotime($annee.'-'.$j.'-'.($jours-$compte)));
		$mois = $j;
		$id = $this->session->userdata('logged_in');
		return array('prem'=>$prem,'perso'=>true,'long'=>$longueur,'depart'=>$depart, 'mois'=>$mois,'annee'=>$annee,'semaine'=>$semaine, 'id_membre'=>$id->id);
	}

	public function ajouter(){

		$this->load->model('M_Agenda');
		$items = array('date_deb','heure_deb','date_fin','heure_fin','type','rappel');
		$data = $this->verification($this->input,$items);
		if($data['etat']){
			$data['id'] = $this->session->userdata('logged_in')->id;
			$heure = explode(':',$data['heure_deb']);
			$data['heure_deb'] = ($heure[0]*60)+$heure[1];
			$heure = explode(':',$data['heure_fin']);
			$data['heure_fin'] = ($heure[0]*60)+$heure[1];
			$date_deb = explode('-', $data['date_deb']); 
			$date_fin = explode('-', $data['date_fin']);
			$data['duree'] = (($date_fin[0]-$date_deb[0])*1440)+($data['heure_fin'] - $data['heure_deb']);
			$data['date_deb'] = $date_deb[2].'-'.$date_deb[1].'-'.$date_deb[0];
			$data['date_fin'] = $date_fin[2].'-'.$date_fin[1].'-'.$date_fin[0];
			$data['delai'] = 0;
			$data['lieu'] = ($this->input->post('lieu')!==null)?$this->input->post('lieu'):"";
			$data['id_lieu'] = $this->input->post('id_lieu');
			$data['description'] = ($this->input->post('descript')!== null)?$this->input->post('descript'):"";
			$data['prive'] = $this->input->post('prive');

			$this->M_Agenda->ajouter($data);
			redirect('agenda');
		}
		else if($this->uri->segment(3) === 'lieu'){

			$this->load->helper('form');
			$infos = $this->M_Agenda->infoSortie($this->uri->segment(4));

			$data['date_deb'] = date('d-m-Y');
			$data['heure_deb'] = date('G').':00';
			$data['date_fin'] = date('d-m-Y');
			$data['heure_fin'] = (date('G')+1).':00';
			$data['lieu'] = $infos->nom.', '.$infos->ville;
			$data['id_lieu'] = $infos->id_lieu;
			$dataLayout['vue'] = $this->load->view('ajouter_agenda',$data,true);
			
		}
		else{
			$this->load->helper('form');
			if(!$data['rempli']):
				$data['date_deb'] = date('d-m-Y');
				$data['heure_deb'] = date('G').':00';
				$data['date_fin'] = date('d-m-Y');
				$data['heure_fin'] = (date('G')+1).':00';
				$data['lieu'] = '';
				$data['id_lieu'] = '';
			endif;
			$dataLayout['vue'] = $this->load->view('ajouter_agenda',$data,true);
			
		}

		if($id = $this->session->userdata('logged_in')){
			$id = $this->session->userdata('logged_in');
			$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		}
		else{
			$dataMenu['amis'] = '';
		}
		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_agenda',$dataMenu,true);

		$this->load->view('layout',$dataLayout);
	}

	public function voir(){

		$data['main_title'] = "Voir Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);
	}

	public function supprimer(){
		if($this->uri->segment(3)>0){
			$this->load->model('M_Agenda');
			$id = $this->uri->segment(3);
			if($this->M_Agenda->supprimer($id)){
				redirect('agenda');
			}
			else{
				var_dump('erreur');
			}
		}
	}

	public function modifier(){
		$this->load->model('M_Agenda');
		$items = array('date_deb','heure_deb','date_fin','heure_fin','type','rappel');
		$data = $this->verification($this->input,$items);
		if($data['etat']){
			$data['id'] = $this->session->userdata('logged_in')->id;
			$data['id_agenda'] = $this->input->post('id_agenda');
			$data['id_lieu'] = ($this->uri->segment(4)>0)?$this->uri->segment(4):0;
			$heure = explode(':',$data['heure_deb']);
			$data['heure_deb'] = ($heure[0]*60)+$heure[1];
			$heure = explode(':',$data['heure_fin']);
			$data['heure_fin'] = ($heure[0]*60)+$heure[1];
			$date_deb = explode('-', $data['date_deb']); 
			$date_fin = explode('-', $data['date_fin']);
			$data['duree'] = (($date_fin[0]-$date_deb[0])*1440)+($data['heure_fin'] - $data['heure_deb']);
			$data['date_deb'] = $date_deb[2].'-'.$date_deb[1].'-'.$date_deb[0];
			$data['date_fin'] = $date_fin[2].'-'.$date_fin[1].'-'.$date_fin[0];
			$data['delai'] = 0;
			$data['lieu'] = ($this->input->post('lieu')!==null)?$this->input->post('lieu'):"";
			$data['id_lieu'] = '';
			$data['description'] = ($this->input->post('descript')!== null)?$this->input->post('descript'):"";
			$data['prive'] = $this->input->post('prive');

			$this->M_Agenda->modifier($data);
			redirect('agenda');
		}
		else{
			$this->load->helper('form');
			if(!$data['rempli']):
				$id = $this->uri->segment(3);
				$data = $this->M_Agenda->voir($id);
				$data->heure_deb = floor($data->heure_deb/60).':'.$data->heure_deb%60;
				$data->heure_fin = floor($data->heure_fin/60).':'.$data->heure_fin%60;
				$date_deb = explode('-', $data->date_deb); 
				$date_fin = explode('-', $data->date_fin);
				$data->date_deb = $date_deb[2].'-'.$date_deb[1].'-'.$date_deb[0];
				$data->date_fin = $date_fin[2].'-'.$date_fin[1].'-'.$date_fin[0];
			endif;
			$dataLayout['vue'] = $this->load->view('modifier_agenda',$data,true);
		}

		$dataLayout['main_title'] = "Modifier l'événement";
		$this->load->view('layout',$dataLayout);
	}

	public function croiser(){

		$data['main_title'] = "Croiser Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);
	}

	private function verification($data,$items){
		$infos['etat'] = true;
		$infos['rempli'] = false;
		foreach($items as $item):
			if($data->post($item) != null):
			 	$infos[$item] =$data->post($item);
			 	$infos['rempli'] = ($item != 'type' && $item != 'rappel')? true : $infos['rempli'];
			else:
				$infos[$item] = ($item == 'type')?1:"";
				$infos[$item] = ($item == 'rappel')?0:"";
				$infos['etat'] = false;
			endif;
		endforeach;
		return $infos;
	}

	private function calendrier($data,$part){

		$info = $this->choixJour();
		if($part == "thead"){
			$head = array();
			$annee = $info['annee'];
			$semaine = $info['semaine'];
			$prem = $info['prem'];
			$longueur = $info['long'];
			$depart = $info['depart'];
			$mois_date = $info['mois'];
			$col = null;
            for($d=0;$d<7;$d++):
				//$depart = date('d')-(date('N')-1);
				//$mois_date = 7;
				if($depart+$d > date('t',strtotime($annee.'-'.$mois_date.'-01'))){
					 $mois_date++;
					 $depart= 1-$d;
				}
				if($mois_date > 12)
				{
					$annee++;
					$mois_date = 1;
				}
                $date = new DateTime($mois_date.'/'.($depart+$d).'/'.$annee);
                $col = (date_format($date,'d-m-Y') == date('d-m-Y'))?$d+1:$col;
                $date_auj = explode('-',date_format($date, 'D-d-m-Y'));
                $num_jour = ($date_auj[0]);

				$num_jour = ($date_auj[0]);
	            switch($num_jour){
	                case 'Mon':
	                    $nom_jour = 'lun.';
	                break;
	                case 'Tue':
	                    $nom_jour = 'mar.';
	                break;
	                case 'Wed':
	                    $nom_jour = 'mer.';
	                break;
	                case 'Thu':
	                    $nom_jour = 'jeu.';
	                break;
	                case 'Fri':
	                    $nom_jour = 'ven.';
	                break;
	                case 'Sat':
	                    $nom_jour = 'sam.';
	                break;
	                case 'Sun':
	                    $nom_jour = 'dim.';
	                break;
	                default:
	                $nom_jour = '';
	            }
	            array_push($head, $nom_jour.' '.$date_auj[1].'/'.$date_auj[2]);
            endfor;
            return array('col'=>$col,'head'=>$head);
        }
        else
        {
        	$this->load->helper('array');
        	$result = array();
        	$result = array();
        	$t=0;
            //$date = new DateTime('12/11/2012'); //JJ/MM/AAAA
            //$date_auj = explode('-',date_format($date, 'd-m-Y'));
            $date_auj = explode('-',date('d-m-Y-N',strtotime($info['annee'].'-'.$info['mois'].'-'.$info['depart'])));
            //$date_auj[0] = 12;
            $pref = 6;
        	foreach($data as $rdv):
                $date_deb = explode('-',$rdv->date_deb);
                $date_fin = explode('-',$rdv->date_fin);
                //$date_auj[3]-=1;
                //$date_deb[2]=23;
                //echo(($date_fin[2]*1).'&');
	        	for($d=0;$d<7;$d++):

	                //if(($date_auj[0]+$d >= $date_deb[2])&&($date_auj[0]+$d < $date_fin[2]) || ($date_auj[0]+$d <= $date_fin[2] && $rdv[$t]->heure_fin > ($pref*60))):
		            if(($date_auj[0]-$date_auj[3])+$d == $date_deb[2]):
		                //Si ca commence aujourd'hui
		               if(($date_auj[0]-$date_auj[3])+$d == $date_deb[2])
		                {
		                    $heure_deb = 87+((($rdv->heure_deb-($pref*60))/60)*47);
		                    $duree = ($rdv->heure_deb+$rdv->duree > 1440) ? (((1440-$rdv->heure_deb)/60)*47)-20 : (($rdv->duree/60)*47)-20;

			                //$position = 54+((93)*$d);
			                $result[$t] = $rdv;
			                $result[$t]->longueur = $duree;
			                $deb = $date_deb[2].'/'.$date_deb[0];
			                $heure_deb = floor($rdv->heure_deb/60).'h'.$minute = ($rdv->heure_deb%60>10)?$rdv->heure_deb%60:"0".$rdv->heure_deb%60;
			                $fin = $date_fin[2].'/'.$date_fin[0];
			                $heure_fin = floor($rdv->heure_fin/60).'h'.$minute = ($rdv->heure_fin%60>10)?$rdv->heure_fin%60:"0".$rdv->heure_fin%60;

			                $result[$t]->heure_deb_text = $heure_deb;
			                $result[$t]->date_deb = $deb;
			                $result[$t]->heure_fin_text = $heure_fin;
			                $result[$t]->date_fin = $fin;
			                //$rdv->date_fin = $deb;
			                $result[$t]->position = 62+(93*($date_deb[2]-($date_auj[0]-$date_auj[3]+1)));
			                $t++;
			                //array_push($result,$rdv[$t]);
		                }
		                //Si ca a commencé avant aujourd'hui et ca corrige un beug sur les events de + d'un jour
		                if(($date_auj[0]-$date_auj[3])+$d < $date_fin[2])
		                {
		                    $heure_deb = 87;
			                $result[$t] = $rdv;
		                    $duree =(($date_auj[0]+$d) == $date_fin[2])? ((($rdv->heure_fin-($pref*60))/60)*47)-20 : (((1440-($pref*60))/60)*47)-20;

			                //$position = 54+((93)*$d);

			                $result[$t]->longueur = $duree;
			                $deb = $date_deb[2].'/'.$date_deb[1];
			                $heure_deb = floor($rdv->heure_deb/60).'h'.$minute = ($rdv->heure_deb%60>10)?$rdv->heure_deb%60:"0".$rdv->heure_deb%60;
			                $fin = $date_fin[2].'/'.$date_fin[1];
			                $heure_fin = floor($rdv->heure_fin/60).'h'.$minute = ($rdv->heure_fin%60>10)?$rdv->heure_fin%60:"0".$rdv->heure_fin%60;

			                $result[$t]->heure_deb_text = $heure_deb;
			                $result[$t]->date_deb = $deb;
			                $result[$t]->heure_fin_text = $heure_deb;
			                //$rdv->date_fin = $deb;
			                $result[$t]->position = 51+(93*($date_deb[2]-$date_auj[0]));
			                $t++;
		                }

	            	endif;
	            endfor;
	        endforeach;

	        return $result;
        }
	}
}
?>