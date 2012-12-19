<?php
	class M_Message extends CI_Model
	{
		public function voir($data){
			$sql = "SELECT * FROM conversation INNER JOIN message ON (conversation.id_convers = message.id_convers) INNER JOIN membre ON message.login_exp = membre.login WHERE (conversation.id_dest = ? AND conversation.id_exp = ? ) OR (conversation.id_exp = ? AND conversation.id_dest = ? ) ORDER BY date"; 

			/*$this->db->select('*');
			$this->db->from('converation');
			$this->db->join('message','conversation.id_convers = message.id_convers');
			$this->db->join('membre','message.id_exp = membre.id');
			$this->db->where('conversation.id_dest',$data['contact']);
			$this->db->where('conversation.id_exp',$data['membre']);
			$this->db->or_where('conversation.id_exp',$data['contact']);
			$this->db->where('conversation.id_dest',$data['membre']);*/

			return $this->db->query($sql, array($data['contact'],$data['membre'],$data['contact'],$data['membre']))->result();
		}

		public function lister($id){
			//SELECT * , CASE id_dest WHEN 1 THEN id_exp ELSE id_dest END AS id_membre FROM `message` WHERE date IN (SELECT max(date) FROM message  WHERE  (id_exp = 1 OR id_dest = 1) GROUP BY id_convers
			//SELECT * FROM message WHERE date IN (SELECT max(date) FROM message WHERE  (id_exp = 1 OR id_dest = 1) GROUP BY id_convers)
			$this->db->select_max('date');
			$this->db->from('message');
			$this->db->join('conversation','message.id_convers = conversation.id_convers');
			$this->db->where('id_exp',$id);
			$this->db->or_where('id_dest',$id);
			$this->db->group_by('message.id_convers');
			$data = $this->db->get()->result();
			$info = array();
			foreach ($data as $value) {
				array_push($info,$value->date);
			}
			$this->db->select('*');
			$this->db->from('message');
			$this->db->join('conversation','message.id_convers = conversation.id_convers');
			$this->db->where_in('date',$info);

			return $this->db->get()->result();
			
		}
		public function correspondant($login){
			$query = $this->db->select('photo,login,prenom,nom')->from('membre')->where('login',$login)->get();
			return $query->row();
		}

		public function insert($data){
			$data = array(
               'id_convers' => $data->id_convers ,
               'login_exp' => $data->login ,
               'message' => $data->message,
               'date' => $data->date
            );

			$this->db->insert('message', $data);
		}
	}
?>