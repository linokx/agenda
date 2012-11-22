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
	public function voir(){
		$this->load->model('M_Profil');
		$this->load->model('M_Amis');
		$id = $this->session->userdata('logged_in');
		$data['login'] = ($this->uri->segment(3)!='')?$this->uri->segment(3): $id->login;
		$dataMenu['info'] = $this->M_Profil->voir($data);
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
}
?>