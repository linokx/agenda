<?php
	class M_Etablissement extends CI_Model
	{

		public function voir($id){
			$this->db->select('*');
			$this->db->from('lieu');
			//$this->db->join('photo_etabl','photo_etabl.id_lieu = lieu.id_lieu');
			$this->db->where('lieu.id_lieu',$id);

			$query = $this->db->get();
			return $query->row();
		}
		public function galerie($id){
			$this->db->select('*');
			$this->db->from('photo_etabl');
			$this->db->where('id_lieu',$id);

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
			$data['min'] = '2012-11-01';
			$data['max'] = '2012-11-11';
			$this->db->where('date_deb >=',$data['min']);
			$this->db->where('date_fin <=',$data['max']);
			
			
			$query = $this->db->get();
			return $query->result();
		}
		public function addComment($data){
			$this->db->insert('comment',$data);
		}
		public function getComment($id_page){
			$sql = 'SELECT comment.*, membre.login, membre.id, membre.photo FROM comment LEFT JOIN membre ON (membre.id = comment.id_membre) WHERE id_page = ?';
			return $this->db->query($sql,array($id_page))->result();
		}

		public function ajouter($data){
			$info = array(
					'nom' => $data['nom'],
					'adresse' => $data['adresse'],
					'ville' => $data['ville'],
					'pays' => $data['pays'],
					'horaire' => $data['horaire'],
					'fermeture' => $data['fermeture'],
					'information' => $data['information'],
					'id_theme' => $data['type'],
					'lat' => $data['lat'],
					'lon' => $data['lon'],
					'site' => $data['site'],
					'photo' => $data['photo']
				);
			$this->db->insert('lieu',$data);
		}

		public function addPicture($data){
			$this->db->insert('photo_etabl',$data);
		}
	}
?>