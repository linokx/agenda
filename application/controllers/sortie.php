<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sortie extends CI_Controller {
	public function index()
	{
		//$this->session->unset_userdata('position');
		if(!$this->session->userdata('position') || ($this->session->userdata('logged_in') &&($this->session->userdata('logged_in')->lat == 0 && $this->session->userdata('logged_in')->lon == 0))){
			$this->localiser();
		}
		else{
			$this->lister();
		}
	}
	public function page(){
		$this->lister();
	}
	public function lister()
	{
		$this->load->helper('form');
		$this->load->library('pagination');

		$user = $this->session->userdata('position');
		$dataMenu['mot'] = '';

		if($this->input->post('mot') != null)
		{
			$dataMenu['mot'] = $data['mot'] = $this->input->post('mot');
		}
		$this->load->model('M_Sortie');

		 
		
		
		$data['lat'] = $latitude = $user['lat'];
		$data['lon'] = $longitude = $user['lon'];
		$filtres = $this->session->userdata('filtre');
		$data['distance'] = (isset($filtres['distance']) && $filtres['distance']!= null)?$filtres['distance']: 50;
		$data['type'] = (isset($filtres['type']) && $filtres['type']!= null)?$filtres['type']: null;

		$config['base_url'] = site_url().'/sortie/page';
		$config['total_rows'] = $this->M_Sortie->compter($data);
		$config['first_link'] = 'Première page';
		$config['last_link'] = 'Dernière page';
		$config['use_page_numbers'] = TRUE;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$this->pagination->initialize($config);

		$data['debut'] = ($this->uri->segment(3)>0)?($this->uri->segment(3)-1)*$config['per_page']:0;
		$data['nombre'] = $config['per_page'];

		$dataLayout['session'] = $user;
		$dataLayout['lieux'] = $this->M_Sortie->lister($data);


		function cmp($a, $b) {
   		if ($a->distance == $b->distance) {
        	return 0;
    	}
    	return ($a->distance < $b->distance) ? -1 : 1;
		}
		
		$i = 0;
		foreach($dataLayout['lieux'] as $lieu)
		{
			$distance = round((6366*acos(cos(deg2rad($latitude))*cos(deg2rad($lieu->lat))*cos(deg2rad($lieu->lon) -deg2rad($longitude))+sin(deg2rad($latitude))*sin(deg2rad($lieu->lat))))*1000)/1000;
			$dataLayout['lieux'][$i]->distance = $distance;
			$i++;
		}

		uasort($dataLayout['lieux'], 'cmp');
		$i = 0;
		foreach($dataLayout['lieux'] as $lieu)
		{
			$distance = $dataLayout['lieux'][$i]->distance;
			$dataLayout['lieux'][$i]->distance = ($distance < 1) ? $distance*1000 ."m": round($distance*10)/10 ."km"; 
			$i++;
		}
		$dataMenu['filtre'] = $this->session->userdata('filtre');
		$dataMenu['distances'] = array(	array('distance' => 10,'texte' => '10km'),
										array('distance' => 20,'texte' => '20km'),
										array('distance' => 30,'texte' => '30km'),
										array('distance' => 40,'texte' => '40km'),
										array('distance' => 50,'texte' => '50km et +'));
		$dataMenu['types'] = array(	array('type' => 1,'texte' => 'Bar et Club'),
									array('type' => 2,'texte' => 'Concert et Spectacle'),
									array('type' => 3,'texte' => 'Détente'),
									array('type' => 4,'texte' => 'Culturel'),
									array('type' => 5,'texte' => 'Casino et Adulte'),
									array('type' => 6,'texte' => 'Sport'));


		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_sortie',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_sortie',$dataLayout,true);
		$this->load->view('layout',$dataLayout);
	}
	public function ajouter()
	{
		$this->load->helper('form');
		$this->load->model('M_Agenda');
		$id = $this->session->userdata('logged_in');
		$dataMenu['amis'] = $this->M_Agenda->listerAmis($id->id);
		$data['main_title'] = "Agenda";
		$data['menu'] = $this->load->view('menu_agenda',$dataMenu,true);
		$data['vue'] = $this->load->view('ajouter_agenda','',true);
		$this->load->view('layout',$data);
	}
	public function voir(){

		$data['main_title'] = "Voir Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);
	}
	public function croiser(){

		$data['main_title'] = "Croiser Agenda";
		$data['menu'] = "" ;
		$data['vue'] = $this->load->view('construction','',true);
		$this->load->view('layout',$data);

	}
	public function localiser(){
		if($this->input->post('lat')){
			$position['lat'] = $this->input->post('lat');
			$position['lon'] = $this->input->post('lon');
			$this->session->set_userdata('position',$position);
			if($this->session->userdata('logged_in') && $this->session->userdata('logged_in')->lat == 0 && $this->session->userdata('logged_in')->lon ==0){

				$this->load->model('M_Sortie');
				$this->M_Sortie->localiserUser($position,$this->session->userdata('logged_in')->id);
				$session = $this->session->userdata('logged_in');
				$session->lat = $position['lat'];
				$session->lon = $position['lon'];
				$this->session->set_userdata('logged_in',$session);
			}
			redirect('sortie');
		}
		else{
			$data['main_title'] = "Agenda";
			$data['menu'] = '';
			$data['vue'] = $this->load->view('localisation','',true);
			$this->load->view('layout',$data);
		}
	}
	public function position(){
		echo json_encode($this->session->userdata('position'));
	}
}
?>