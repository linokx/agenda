<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filtre extends CI_Controller {

	/*public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')){
			redirect('agenda');
		}
	}*/
	public function distance(){
		$filtre = $this->session->userdata('filtre');
		$data = $filtre;
		if($filtre['distance'] == $this->uri->segment(3)){

			array_splice($data,array_search('distance',array_keys($data)),1);
		}
		else{
			$data['distance'] = $this->uri->segment(3);
		}
		$this->session->unset_userdata('filtre');
		$this->session->set_userdata('filtre', $data);
		redirect('sortie');
	}
	public function type(){
		$filtre = $this->session->userdata('filtre');
		$data = $filtre;
		$data['type'] = $this->uri->segment(3);

		$this->session->set_userdata('filtre',$data);
		
		redirect('sortie');
	}
}
?>