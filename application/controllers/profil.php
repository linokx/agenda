<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		}
	}
	public function index(){
		$this->voir();
	}
	public function voir($login){
		$this->load->model('M_Profil');
		$this->load->model('M_Amis');

		$id = $this->session->userdata('logged_in');
		$data->login = ($login!='')?$login: $id->login;
		$dataMenu['info'] = $this->M_Profil->voir($data);
		//$this->session->set_userdata('logged_in',$dataMenu['info']);
		$dataMenu['amis'] = $this->M_Amis->lister($data);
		
		$dataLayout['main_title'] = "Agenda";
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
		$data = $this->session->userdata('logged_in');
		$this->load->model('M_Amis');
		
		$this->load->model('M_Profil');
		if($this->input->post('pseudo') != null){
			if($this->input->post('pseudo') == $this->session->userdata('logged_in')->login){
				$check = array('pseudo','nom','prenom','mail','num','rue','pays');
				foreach($check as $champ){
					$infos[$champ] = $this->input->post($champ);
				}
				$this->M_Profil->modifier($infos);
				redirect('profil/voir');
			}
			else{
				var_dump('no');
			}
		}
		else{
			$dataLayout['vue'] = $this->load->view('modifier_profil',$data,true);
		}			

		$dataMenu['info'] = $data;
		$dataMenu['amis'] = $this->M_Amis->lister($data);
		$dataLayout['main_title'] = 'Modification des donnéess';
		$dataLayout['menu'] = $this->load->view('menu_profil',$dataMenu,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>