<?php
	class M_Amis extends CI_Model
	{
		public function lister($data){
			$query = $this->db->select('id')->from('membre')->where('login',$data->login)->get();
			$id = $query->row();
			$this->db->select('*');
			$this->db->from('amis');
			$this->db->join('membre','id_amis = membre.id');
			$this->db->where('amis.id',$id->id);
			//SELECT * FROM (`ami`) JOIN `membre` ON `id_amis` = `membre`.`id` WHERE `amis`.`id` IN ('SELECT id_membre FROM membre WHERE login =linokx')
			
			//$this->db->or_where('id_amis',$data['id']);

			$query = $this->db->get();
			return $query->result();
		}	
	}
?>