<?php 

class Project extends CI_Controller {

	function index(){
		$this->load->view('project_index');
	}
	
	function all(){
		$this->load->model('projectmodel');
		$projects = $this->projectmodel->get_all();
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($projects));
	}

	function insert(){
		$this->load->model('projectmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->projectmodel->insert_project()));
	}
	
	function update(){
		$this->load->model('projectmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->projectmodel->update_project()));
	}

	function remove(){
		$this->load->model('projectmodel');
		$this->output
		    ->set_content_type('application/json')
		    ->set_output(json_encode($this->projectmodel->remove_project()));
		
	}
}