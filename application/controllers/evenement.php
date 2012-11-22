<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Evenement extends CI_Controller {
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
		$this->load->helper('form');
		$this->load->model('M_Evenement');
		$this->load->model('M_Actualite');
		
		$dataLayout['lieux'] = $this->M_Evenement->lister();
		$dataTop['actualite'] = $this->M_Actualite->lister();

		
		$dataLayout['main_title'] = "Agenda";
		$dataLayout['top_menu'] = $this->load->view('lister_actualite',$dataTop,true);
		$dataLayout['menu'] = '';
		$dataLayout['vue'] = $this->load->view('lister_evenement',$dataLayout,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>