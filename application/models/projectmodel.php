<?php

class Projectmodel extends CI_Model {
	var $Name = '';
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all()
    {
        $query = $this->db->get('projects');
        return $query->result();
    }

    function insert_project()
    {
        $this->Name = $_POST['Name'];
		//if()    	
        $this->db->insert('projects', $this);
        return $this->db->insert_id();
    }

    function update_project()
    {
        $this->Name = $_POST['Name'];
        return $this->db->update('projects', $this, array('Id' => $_POST['Id']));
    }

    function remove_project(){
		return $this->db->delete('projects', array('Id' => $_POST['Id']));
    }
}