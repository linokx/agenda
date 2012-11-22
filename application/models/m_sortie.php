<?php
	class M_Sortie extends CI_Model
	{
		public function lister($data){

			$latitude = $data['lat'];
			$longitude = $data['lon'];
			$distance = $data['distance'];
			$formule = "(6366*acos(cos(radians($latitude))*cos(radians(`lat`))*cos(radians(`lon`) -radians($longitude))+sin(radians($latitude))*sin(radians(`lat`))))";
			$this->db->select('*');
			$this->db->from('lieu');
			$this->db->where($formule.'<='.$distance);
			if($data['type'] != null){
				$this->db->where('id_theme',$data['type']);
			}
			if(!empty($data['mot'])){
				$this->db->like('nom',$data['mot']);
			}
			$this->db->limit($data['nombre'],$data['debut']);
			$query = $this->db->get();
			return $query->result();
		}

		public function compter($data){
			$latitude = $data['lat'];
			$longitude = $data['lon'];
			$distance = $data['distance'];
			$formule = "(6366*acos(cos(radians($latitude))*cos(radians(`lat`))*cos(radians(`lon`) -radians($longitude))+sin(radians($latitude))*sin(radians(`lat`))))";
			$this->db->select('*');
			$this->db->from('lieu');
			$this->db->where($formule.'<='.$distance);
			if($data['type'] != null){
				$this->db->where('id_theme',$data['type']);
			}
			if(!empty($data['mot'])){
				$this->db->like('nom',$data['mot']);
			}

			$query = $this->db->get();
			return $query->num_rows();
		}

		public function localiserUser($data,$id_membre){
			$this->db->where('id',$id_membre);
			$this->db->update('membre',array('lat'=>$data['lat'],'lon'=>$data['lon']));
		}
	}
?>