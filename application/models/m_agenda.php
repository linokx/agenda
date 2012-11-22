<?php
	class M_Agenda extends CI_Model
	{

		public function lister($info)
		{
			$this->db->select('*');
			$this->db->from('agenda');
			$this->db->where('id_membre',$info['id_membre']);
			if($info['perso'])
			{
				$this->db->where('prive',0);
			}
			$min = date($info['annee'].'-'.$info['mois'].'-'.$info['depart']);
			$max = date($info['annee'].'-'.$info['mois'].'-'.($info['depart']+($info['long']-1)));
			$this->db->where('date_deb >=',$min);
			$this->db->where('date_fin <=',$max);
			
			
			$query = $this->db->get();
			return $query->result();
		}
		public function voir($id){
			$this->db->select('*');
			$this->db->from('agenda');
			$this->db->where('id_agenda',$id);

			$query = $this->db->get();
			return $query->row();
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
					'id_lieu' => $data['id_lieu'],
					'id_type' => $data['type'],
					'description' => $data['description'],
					'rappel' => $data['rappel'],
					'delai' => $data['delai'],
					'prive' => $data['prive']
				);
			$this->db->insert('agenda',$info);
		}

		public function modifier($data)
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
			$this->db->where('id_agenda',$data['id_agenda']);
			$this->db->update('agenda',$info);
		}

		public function supprimer($id){
			$this->db->delete('agenda',array('id_agenda' => $id));
			return true;
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

		public function infoSortie($id){
			$this->db->select('*');
			$this->db->from('lieu');
			$this->db->where('id_lieu',$id);

			$query = $this->db->get();
			return $query->row();
		}
	}
?>