<?php
	class M_Profil extends CI_Model
	{

		public function voir($data){
			$this->db->select('*');
			$this->db->from('membre');
			$this->db->where('login',$data);

			$query = $this->db->get();
			return $query->row();
		}

		public function actu($data)
		{

			$this->db->select('*');
			$this->db->from('actualite');
			$this->db->join('membre','membre.id = actualite.id_membre');
			$this->db->where('membre.login',$data->login);
			$this->db->order_by('date desc');
			
			$query = $this->db->get();
			return $query->result();
		}

		public function listerAmis($id)
		{
			$this->db->select('*');
			$this->db->from('amis');
			$this->db->join('membre', 'amis.id = membre.id');
			$this->db->where('amis.id_amis',$id);
			
			$query = $this->db->get();
			return $query->result();
		}

		public function modifier($data,$login){
			$this->db->where('login',$login);
			$this->db->update('membre',$data);
		}
	}
?>