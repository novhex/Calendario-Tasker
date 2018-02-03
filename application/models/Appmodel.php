<?php
/**
* 
*/
defined('BASEPATH') or exit('Error!');

class Appmodel extends CI_Model
{
	
	public function __construct(){
		# code...
		parent::__construct();
		$this->load->database();

	}

	public function addTask($title,$details,$date){
		
		$task_details = array('task_id'=>bin2hex(openssl_random_pseudo_bytes(5)),
					   'task_name'=>$title,
					   'task_details'=>$details,
					   'date'=>$date
		             );
		return $this->db->insert('task',$task_details);
	}
	public function allTask(){

		$sql = $this->db->get("task");
		return $sql->result_array();
	}


	public function deleteTask($id){
		$this->db->where('task_id',$id);
	
		return $this->db->delete('task');

		
	}

	public function update_task_date($eventid,$newdate){

		return $this->db->where('task_id',$eventid)->update('task',['date'=>$newdate]);
	}

	public function editTask($title,$details,$id){
		$new_taskdetails=array('task_name'=>$title,'task_details'=>$details);
		$this->db->where('task.task_id',$id);
		return $this->db->update('task',$new_taskdetails);
	}
}