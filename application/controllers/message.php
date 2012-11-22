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
		$data['messages'] = $this->M_Message->voir($this->uri->segment(3));		

		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_message','',true);
		$dataLayout['vue'] = $this->load->view('lister_message',$data,true);
		$this->load->view('layout',$dataLayout);
	}
}
?>