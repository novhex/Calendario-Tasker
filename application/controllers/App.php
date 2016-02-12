<?php
defined('BASEPATH') or exit('Error!');
/**
* 
*/
class App extends CI_Controller{
	
	private $data;

	public function __construct(){
		
		parent::__construct();
		$this->load->library(array('session','form_validation','mydateconverter'));
		$this->load->helper(array('url'));
		$this->load->model('appmodel');
	
	}

	public function index(){
		$this->data['page_title'] = "CalendarIO &raquo; DailyTasker ! ";
		$this->load->view('ui/tpl/head',$this->data);
		$this->data['tasks']=$this->appmodel->allTask();
		$this->load->view('ui/calendar_home',$this->data);
		$this->load->view('ui/tpl/footer',$this->data);

	}

	//ajax event!
	public function addtask(){

		    $response = $this->appmodel->addTask($this->input->post('title'),
			$this->input->post('description'),
			$this->mydateconverter->convertDate($this->input->post('date')));
			echo $response;

	}
	//ajax event!

	public function deletetask(){
		$response = $this->appmodel->deleteTask($this->input->get('id'));
		echo $response;
	}

	//ajax event!
	public function editask(){
		$response = $this->appmodel->editTask($this->input->post('title'),
			$this->input->post('description'),
			$this->input->post('id')
			);
			echo $response;
	}

}