<?php
	class M_Evenement extends CI_Model
	{
		public function lister()
		{

			$this->db->select('*');
			$this->db->from('event');
			
			$query = $this->db->get();
			return $query->result();
		}
	}
?>