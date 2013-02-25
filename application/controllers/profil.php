<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		}
		$this->load->model('M_Amis');
		$this->load->model('M_Profil');
	}
	public function index(){
		$this->voir();
	}
	public function voir(){

		$user_data = $this->session->userdata('logged_in');
		$data->login = $user_data->login;
		$dataMenu['info'] = $this->M_Profil->voir($user_data->login);
		$dataMenu['amis'] = $this->M_Amis->lister($data);
		
		$dataVue['titre'] = "Dernière actualité de ".$dataMenu['info']->prenom;
		$dataLayout['main_title'] = "Profil de ".$dataMenu['info']->prenom.' '.$dataMenu['info']->nom;
		$dataVue['actualite'] = $this->M_Profil->actu($data);
		$dataLayout['menu'] = $this->load->view('menu_profil',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_actualite',$dataVue,true);

		$this->load->view('layout',$dataLayout);
	}
	public function login()
	{
		$this->load->model('M_Member');
		$data['mdp'] = $this->input->post('mdp');
		$data['nom'] = $this->input->post('nom');
		if($this->M_Member->verifier($data)){
			$info = $this->M_Member->infos($data['nom']);
			$this->session->set_userdata('logged_in',$info);
			redirect('agenda');
		}
		else
		{
			redirect('error/mauvais_identifiant');
		}
	}

	public function modifier(){
		$user_data = $this->session->userdata('logged_in');
		if($this->input->post('pseudo')){
			if($this->input->post('pseudo') == $user_data->login){
				$check = array('pseudo','nom','prenom','mail','num','rue','pays');
				foreach($check as $champ){
					$infos[$champ] = $this->input->post($champ);
				}
				$info = array(
					'mail' => $infos['mail'],
					'nom' => $infos['nom'],
					'prenom' => $infos['prenom'],
					'adresse' => $infos['rue'],
					'num' => $infos['num'],
					'id_pays' => $infos['pays']
				);
				$titre = time().rand(1000,9999);
				$config['upload_path'] = './web/image/membre/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				$config['file_name'] = $titre.'.jpg';
				$this->load->library('upload', $config);
				$this->load->library('image_lib');

				if ($this->upload->do_upload('photo'))
				{
					$info['photo'] = $titre.'.jpg';
					$user_data->photo = $titre.'.jpg';
					$this->session->set_userdata('logged_in',$user_data);
					$data = array('upload_data' => $this->upload->data());
				}
				$this->M_Profil->modifier($info,$user_data->login);
				//redirect('profil/voir');
			}
			else{
				var_dump('no');
			}
		}
			$data = $this->M_Profil->voir($user_data->login);
			$dataLayout['vue'] = $this->load->view('modifier_profil',$data,true);
		

		$dataMenu['info'] = $data;
		$dataMenu['amis'] = $this->M_Amis->lister($data);
		$dataLayout['main_title'] = 'Modification des donnéess';
		$dataLayout['menu'] = $this->load->view('menu_profil',$dataMenu,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>