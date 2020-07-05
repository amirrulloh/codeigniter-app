<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AutoComplete extends CI_Controller {


	public function index()
	{
		$this->load->view('autocomplete/index');
    }
    
    public function getEmployees($id)
    {
        $this->load->model('employee_model');
        if(empty($id)){
            echo json_encode([]);exit;
        }

        $employees = $this->employee_model->getEmployees($id);
        echo json_encode($employees);exit;
        
    }
}
