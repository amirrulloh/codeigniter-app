<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class employee_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getEmployees($id)
    {
        $query = $this->db
            ->select('employees.emp_no, employees.first_name, employees.last_name, departments.dept_name')
            ->from('employees')
            ->join('dept_emp', 'dept_emp.emp_no = employees.emp_no')
            ->join('departments', 'departments.dept_no = dept_emp.dept_no')
            ->where("employees.emp_no LIKE '$id%'")
            ->limit(25)
            ->get();
        
        return $query->result_array();
    }

}