<?php  

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Book extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('book_model');
	}

	public function index()
	{
		$data['books'] = $this->book_model->get_all_books();
		$this->load->view('book_view', $data);
	}

	public function find_country()
	{
		$data = $this->book_model->fetch_country();
		echo json_encode($data);
	}

	public function book_add()
	{
		$post = $this->input->post();
		echo "<pre>"; print_r($post); exit();
		if($post)
		{
			$insert = $this->book_model->book_add($post);
			echo json_encode(array("status" => TRUE));	
		}
	}

	public function ajax_edit($id)
	{
		$data = $this->book_model->get_by_id($id);
		echo json_encode($data);
	}

	public function book_update()
	{
		$data = $this->input->post();
		$this->book_model->book_update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function book_delete($id)
	{
		$this->book_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function state()
		{
			if($this->input->post('c_id'))
			{
				$c = $this->input->post('c_id');
				echo $this->book_model->fetch_state($c);
			}
		}

	public function city()
		{
			if($this->input->post('s_id'))
			{
				echo $this->book_model->fetch_city($this->input->post('s_id'));
			}
		}
}

?>