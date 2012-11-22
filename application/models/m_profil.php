<?php
	class M_Profil extends CI_Model
	{

		public function voir($data){
			$this->db->select('*');
			$this->db->from('membre');
			$this->db->where('login',$data['login']);

			$query = $this->db->get();
			return $query->row();
		}

		public function actu($data)
		{

			$this->db->select('*');
			$this->db->from('actualite');
			$this->db->join('membre','membre.id = actualite.id_membre');
			$this->db->where('membre.login',$data['login']);
			$this->db->order_by('date desc');
			
			$query = $this->db->get();
			return $query->result();
		}
		public function lister($data)
		{
			$this->db->select('*');
			$this->db->from('agenda');
			$this->db->where('id_membre',$data['id']);
			if($data['perso'])
			{
				$this->db->where('prive',0);
			}
			$data['min'] = '2012-10-1';
			$this->db->where('date_deb >=',$data['min']);
			$this->db->where('date_fin <=',$data['max']);
			
			
			$query = $this->db->get();
			return $query->result();
		}

		public function ajouter($data)
		{
			$info = array(
					'id_membre' => $data['id'],
					'date_deb' => $data['date_deb'],
					'heure_deb' => $data['heure_deb'],
					'date_fin' => $data['date_fin'],
					'heure_fin' => $data['heure_fin'],
					'duree' => $data['duree'],
					'lieu' => $data['lieu'],
					'id_type' => $data['type'],
					'description' => $data['description'],
					'rappel' => $data['rappel'],
					'delai' => $data['delai'],
					'prive' => $data['prive']
				);
			var_dump($info);
			$this->db->insert('agenda',$info);
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
	}
?>