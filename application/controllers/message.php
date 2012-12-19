<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct(){

		parent::__construct();
		$this->load->model('M_Message');
		$this->load->model('M_Profil');	
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		}
	}
	public function index()
	{
		$this->lister();
	}

	public function lister(){
		$data['session'] = $this->session->userdata('logged_in');
		$dataMenu['info'] = $this->M_Profil->voir($data['session']);
		$data['conversations'] = $this->M_Message->lister($data['session']->login);
		foreach ($data['conversations'] as $value) {
			$correspondant = ($value->id_dest == $data['session']->login) ? $value->id_exp : $value->id_dest;
			$value->correspondant = $this->M_Message->correspondant($correspondant);
		}
		$dataLayout['main_title'] = "Messagerie";
		$dataLayout['menu'] = $this->load->view('menu_message', $dataMenu,true);
		$dataLayout['vue'] = $this->load->view('lister_message',$data,true);
		$this->load->view('layout',$dataLayout);
	}
	public function voir($login)
	{
		$data['session'] = $this->session->userdata('logged_in');
		$infos['contact'] = $login;
		$dataMenu['info'] = $this->M_Profil->voir($data['session']);
		$infos['membre'] = $data['session']->login;

		$data['messages'] = $this->M_Message->voir($infos);		
		$data['membres'] = $this->M_Message->correspondant($infos['contact']);

		$dataLayout['main_title'] = "Agenda";
		$dataLayout['menu'] = $this->load->view('menu_message',$dataMenu,true);
		$dataLayout['vue'] = $this->load->view('voir_message',$data,true);
		$this->load->view('layout',$dataLayout);
	}

	public function ajouter($login){
		$data->id_convers = $this->input->post('id_convers');
		$data->login = $this->session->userdata('logged_in')->login;
		$data->message = $this->input->post('message');
		$data->date = date('Y-m-d H:i:s');
		$data->correspondant = "alexis";
		$this->M_Message->insert($data);
		redirect('message/'.$data->correspondant);
	}
}
?>