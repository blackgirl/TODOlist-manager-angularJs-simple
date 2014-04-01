<?php 

class Task extends CI_Controller {
	
	function all(){
		$this->load->model('taskmodel');
		$tasks = $this->taskmodel->get_all();
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($tasks));
	}

	function insert(){
		$this->load->model('taskmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->taskmodel->insert_task()));
	}
	function update(){
		$this->load->model('taskmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->taskmodel->update_task()));
	}

	function remove(){
		$this->load->model('taskmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->taskmodel->remove_task()));
	}
}