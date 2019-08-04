<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Book_model extends CI_Model
{
	
	/*function __construct()
	{
		parent::__construct();
	}*/

	var $table = 'person';

	public function get_all_books()
	{
		$this->db->select("person.*, city.city_name, state.state_name, country.country_name");
		$this->db->join('city', 'city.ci_id = person.city');
		$this->db->join('state', 'state.s_id = person.state');
		$this->db->join('country', 'country.c_id = person.country');
		$query=$this->db->get('person');
		return $query->result();
	}	

	public function get_by_id($id)
	{
		$this->fetch_country();
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function book_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function book_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	function fetch_country()
		{
			$this->db->order_by('country_name','ASC');
			$sql = $this->db->get('country');
			$op = '<option value="">Select Country</option>';
			foreach ($sql->result() as $row) 
			{
				$op .= '<option value="'.$row->c_id.'">'.$row->country_name.'</option>';
			}
			return $op;
			return $sql->result();
		}

	function fetch_state($c)
		{
			$this->db->where('c_id',$c);
			$this->db->order_by('state_name','ASC');
			$sql = $this->db->get('state');
			$op = '<option value="">Select State</option>';
			foreach ($sql->result() as $row) 
			{
				$op .= '<option value="'.$row->s_id.'">'.$row->state_name.'</option>';
			}
			return $op;
		}

	function fetch_city($state_id)
		{
			$this->db->where('s_id', $state_id);
			$this->db->order_by('city_name', 'ASC');
			$sql = $this->db->get('city');
			$op = '<option value="">Select City</option>';
			foreach ($sql->result() as $row) 
			{
				$op .= '<option value="'.$row->ci_id.'">'.$row->city_name.'</option>';
			}
			return $op;
		}

	public function selectDetail($table,$fields='*', $type='')
	{
		$this->db->select($fields);
		$this->db->from($table);

		$query = $this->db->get();

		if ($type == "rowcount") {
			$data = $query->num_rows();
		}else{
			$data = $query->result();
		}
		$query->result();

		return $data;
	}
}

?>