<?php
	class M_Actualite extends CI_Model
	{
		public function lister()
		{

			$this->db->select('*');
			$this->db->from('actualite');
			$this->db->join('membre','membre.id = actualite.id_membre');
			$this->db->order_by('date desc');
			
			$query = $this->db->get();
			return $query->result();
		}
	}
?>