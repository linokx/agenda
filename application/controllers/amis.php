<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Amis extends CI_Controller {
	public function index()
	{
		$this->load->model('M_Amis');
		$infos['id'] = 1;
		$data['amis'] = $this->M_Amis->lister($infos);
		$dataLayout['main_title'] = 'Liste d\'amis';
		$dataLayout['menu'] = '';
		$dataLayout['vue'] = $this->load->view('lister_amis',$data,true);
		$this->load->view('layout',$dataLayout);	
	}
}
?>