<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amis extends CI_Controller {

	public function voir($login){

		$this->load->model('M_Amis');
		$id = $this->session->userdata('logged_in');
		$infos->login = ($login!='')?$login: $id->login;
		$data['amis'] = $this->M_Amis->lister($infos);
		$dataLayout['main_title'] = 'Liste d\'amis';
		$dataLayout['menu'] = '';
		$dataLayout['vue'] = $this->load->view('lister_amis',$data,true);
		$this->load->view('layout',$dataLayout);	
	}
}
?>