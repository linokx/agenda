<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_Member');
	}
	public function index()
	{
		$this->lang->load('form', $this->config->item('language'));
		$data['main_title'] = 'Agenda';
		$data['menu'] = $this->load->view('member_form','',true);
		$data['vue'] = '';
		$this->load->view('layout',$data);
	}
	public function login()
	{
		$data['mdp'] = $this->input->post('mdp');
		$data['nom'] = $this->input->post('nom');
		if($this->M_Member->verifier($data)){
			$info = $this->M_Member->infos($data['nom']);
			$this->session->set_userdata('logged_in',$info);
			$coords = $this->session->userdata('logged_in');
			$position['lat'] = $coords->lat;
			$position['lon'] = $coords->lon;
			$this->session->set_userdata('position',$position);
			redirect('evenement');
		}
		else
		{
			redirect('error/mauvais_identifiant');
		}
	}

	public function inscription(){
		// Recupere le pseudo
		if($this->input->post('nom')){
			$data['mdp'] = $this->input->post('mdp');
			$data['nom'] = $this->input->post('nom');

			// Si deja utilisé
			if($this->M_Member->verifierNom($data['nom']) != 0){
				$dataLayout['vue'] = $this->load->view('inscription','',true);
			}
			else{
				$info = $this->M_Member->inscription($data);
				$this->session->set_userdata('logged_in',$info);
				redirect('evenement');
			}
		}
		else{
			$dataLayout['vue'] = $this->load->view('inscription','',true);
		}
		$dataLayout['main_title'] = 'Inscription';
		$dataLayout['vue'] = $this->load->view('inscription','',true);
		$this->load->view('layout',$dataLayout);
	}

	public function logout(){
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('position');
		redirect('member');
	}
}
?>