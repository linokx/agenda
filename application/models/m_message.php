<?php
	class M_Message extends CI_Model
	{
		public function voir($data){
			$this->db->select('*');
			$this->db->from('message');
			$this->db->join('membre','membre.id = message.id_exp OR membre.id = message.id_dest');
			$this->db->where('id_convers',1);

			$query=$this->db->get();
			return $query->result();
		}
	}
?>