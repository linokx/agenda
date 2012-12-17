<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amis extends CI_Controller {
	public function index()
	{
		$this->voir();
	}
	public function voir(){
		$this->load->model('M_Amis');
		$id = $this->session->userdata('logged_in');
		$infos->login = ($this->uri->segment(3)!='')?$this->uri->segment(3): $id->login;
		$data['amis'] = $this->M_Amis->lister($infos);
		$dataLayout['main_title'] = 'Liste d\'amis';
		$dataLayout['menu'] = '';
		$dataLayout['vue'] = $this->load->view('lister_amis',$data,true);
		$this->load->view('layout',$dataLayout);	
	}
}
?>