<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etablissement extends CI_Controller {
	/*public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('logged_in')){
			redirect('member');
		};
	}*/
	public function index()
	{
	}
	public function voir(){

		if($this->uri->segment(3)>0){
			$this->load->model('M_Etablissement');
			$data = $this->M_Etablissement->voir($this->uri->segment(3));
			$data->position = $this->session->userdata('position');
			$data->galerie = $this->M_Etablissement->galerie($this->uri->segment(3));
			$dataLayout['main_title'] = $data->nom.', '.$data->ville;
			$dataLayout['menu'] = '';
			$dataLayout['vue'] = $this->load->view('voir_etablissement',$data,true);
			$this->load->view('layout',$dataLayout);
		}
		else{
			redirect('sortie');
		}
	}
	public function proposer(){
		$this->load->helper('form');
		if($this->input->post('nom')){

			$this->load->model('M_Etablissement');

			$config['upload_path'] = './web/image/etablissement/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['file_name'] = 'bonalibi.jpg';

			$this->load->library('upload', $config);
			$this->load->library('image_lib');

			if ( ! $this->upload->do_upload('image'))
			{
				$error = array('error' => $this->upload->display_errors());

				var_dump($error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());

			}
			$thumb['image_library'] = 'gd2';
			$thumb['source_image']	= './web/image/etablissement/bonalibi.jpg';
			$thumb['new_image'] = './web/image/etablissement/thumbnail/';
			$thumb['create_thumb'] = TRUE;
			$thumb['maintain_ratio'] = TRUE;
			$thumb['width']	= 100;
			$thumb['height'] = 100;
			$thumb['thumb_marker'] = '';

			$this->image_lib->initialize($thumb); 

			$this->image_lib->resize();

			$data['nom'] = $this->input->post('nom');
			$data['adresse'] = $this->input->post('adresse');
			$data['ville'] = $this->input->post('ville');
			$data['pays'] = $this->input->post('pays');
			$data['horaire'] = $this->input->post('horaire');
			$data['fermeture'] = $this->input->post('fermeture');
			$data['information'] = $this->input->post('information');
			$data['type'] = $this->input->post('type');
			$data['lat'] = $this->input->post('lat');
			$data['lon'] = $this->input->post('lon');
			$data['site'] = $this->input->post('site');
			$data['photo'] = 'bonalibi.jpg';

			$this->M_Etablissement->ajouter($data);
			$dataLayout['vue'] = $this->load->view('lieu_reussi','',true);

		}
		else{
			$dataLayout['vue'] = $this->load->view('ajouter_lieu','',true);
		}
		$dataLayout['main_title'] = 'Proposer un établissement';
		$dataLayout['menu'] = '';
		$this->load->view('layout',$dataLayout);

	}
}
?>