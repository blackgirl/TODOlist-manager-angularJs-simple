<?php

class Taskmodel extends CI_Model{
	var $Name = '';
	var $Status = false;
	var $Priority = 0;
	var $ProjectId = 0;
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_all()
    {
        $query = $this->db->get_where('tasks',array('ProjectId'=>$_GET['ProjectId']));
        return $query->result();
    }

    function insert_task()
    {
        $this->Name = $_POST['Name'];
        $this->Status = $_POST['Status'];
        $this->Priority = $_POST['Priority'];
        $this->ProjectId = $_POST['ProjectId'];
		//if()    	
        return $this->db->insert('tasks', $this);
    }

    function update_task()
    {

        $this->Name = $_POST['Name'];
        $this->Status = $_POST['Status'];
        $this->Priority = $_POST['Priority'];
        $this->ProjectId = $_POST['ProjectId'];

        return $this->db->update('tasks', $this, array('Id' => $_POST['Id']));
    }

    function remove_task(){
		return $this->db->delete('tasks', array('Id' => $_POST['Id']));
    }
}
