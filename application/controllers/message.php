<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct(){

		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		}
	}
	public function index()
	{
		$this->voir();
	}
	public function voir()
	{
		$this->load->model('M_Message');		
		$data['session'] = $this->session->userdata('logged_in');
		$infos['id_convers'] = $this->uri->segment(3);
		$infos['id_membre'] = $data['session']->id;
		
		$data['messages'] = $this->M_Message->voir($infos);		
		$data['membres'] = $this->M_Message->correspondant($infos['id_convers']);

		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_message','',true);
		$dataLayout['vue'] = $this->load->view('lister_message',$data,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>