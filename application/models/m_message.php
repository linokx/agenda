<?php
	class M_Message extends CI_Model
	{
		public function voir($data){
			$this->db->select('*');
			$this->db->from('conversation');
			$this->db->join('message','conversation.id_convers = message.id_convers');
			$this->db->join('membre','message.id_exp = membre.id');
			$this->db->where('message.id_convers',$data['id_convers']);
			$this->db->where('message.id_exp',$data['id_membre']);

			return $this->db->get()->result();
		}

		public function correspondant($id){

		}
	}
?>