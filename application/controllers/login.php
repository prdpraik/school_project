<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
    
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        /*cash control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
    
    /***default functin, redirects to login page if no admin logged in yet***/
    public function index()
    {
        
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
        if ($this->session->userdata('teacher_login') == 1)
            redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
        if ($this->session->userdata('student_login') == 1)
            redirect(base_url() . 'index.php?student/dashboard', 'refresh');
        if ($this->session->userdata('parent_login') == 1)
            redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
		if ($this->session->userdata('principal_login') == 1)
                redirect(base_url() . 'index.php?principal/dashboard', 'refresh');
		//librarian_login starts here
		if ($this->session->userdata('librarian_login') == 1)
            redirect(base_url() . 'index.php?librarian/dashboard', 'refresh');
		//librarian_login starts here			);
		if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');
        
        
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|xss_clean|valid_email'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|xss_clean|callback__validate_login'
            )
        );
        
        $this->form_validation->set_rules($config);
        $this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');
        $this->form_validation->set_error_delimiters('<div class="alert alert-error">
								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            if ($this->session->userdata('admin_login') == 1)
                redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
            if ($this->session->userdata('teacher_login') == 1)
                redirect(base_url() . 'index.php?teacher/dashboard', 'refresh');
            if ($this->session->userdata('student_login') == 1)
                redirect(base_url() . 'index.php?student/dashboard', 'refresh');
            if ($this->session->userdata('parent_login') == 1)
                redirect(base_url() . 'index.php?parents/dashboard', 'refresh');
			if ($this->session->userdata('principal_login') == 1)
                redirect(base_url() . 'index.php?principal/dashboard', 'refresh');
			//librarian_login starts here			);
			if ($this->session->userdata('librarian_login') == 1)
            redirect(base_url() . 'index.php?librarian/dashboard', 'refresh');
			//librarian_login starts here			);
			if ($this->session->userdata('accountant_login') == 1)
            redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');
			if ($this->session->userdata('office_login') == 1)
            redirect(base_url() . 'index.php?office/dashboard', 'refresh');
        }
        
    }
    
    /***validate login****/
    function _validate_login($str)
    {
        if ($this->input->post('login_type') == '') {
            $this->session->set_flashdata('flash_message', get_phrase('select_account_type'));
            redirect(base_url() . 'index.php?login', 'refresh');
            return FALSE;
        }
        if($this->input->post('login_type') == 'parent'){
             $query = $this->db->get_where('student', array(
            'parent_email' => $this->input->post('email'),
            'parent_password' => $this->input->post('password')
        ));
        }
        else{		
        $query = $this->db->get_where($this->input->post('login_type'), array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        ));
        }

        if ($query->num_rows() > 0) {
            $row = $query->row();
            if ($this->input->post('login_type') == 'admin') {
                $this->session->set_userdata('admin_login', '1');
                $this->session->set_userdata('admin_id', $row->admin_id);
                $this->session->set_userdata('name', $row->name);
                $this->session->set_userdata('level', $row->level);
                $this->session->set_userdata('login_type', 'admin');
            }
            if ($this->input->post('login_type') == 'teacher') {
                $this->session->set_userdata('teacher_login', '1');
                $this->session->set_userdata('teacher_id', $row->teacher_id);
                $this->session->set_userdata('name', $row->name);
                $this->session->set_userdata('login_type', 'teacher');
            }
            if ($this->input->post('login_type') == 'student') {
                $this->session->set_userdata('student_login', '1');				
                $this->session->set_userdata('student_id', $row->student_id);
                $this->session->set_userdata('name', $row->name);
				//added feature on 08-01-2015
				$this->session->set_userdata('student_class', $row->class_id);
                $this->session->set_userdata('login_type', 'student');
            }
            if ($this->input->post('login_type') == 'parent') {
                $this->session->set_userdata('parent_login', '1');
                $this->session->set_userdata('parent_id', $row->student_id);
                $this->session->set_userdata('name', $row->father_name);
                $this->session->set_userdata('login_type', 'parent');
            }
			if ($this->input->post('login_type') == 'principal') {
                $this->session->set_userdata('principal_login', '1');
                $this->session->set_userdata('parent_id', $row->student_id);
                $this->session->set_userdata('name', $row->father_name);
                $this->session->set_userdata('login_type', 'principal');
            }
			if ($this->input->post('login_type') == 'librarian') {
                $this->session->set_userdata('librarian_login', '1');
                $this->session->set_userdata('librarian_id', $row->name);
                $this->session->set_userdata('name', $row->phone);
                $this->session->set_userdata('login_type', 'librarian');
            }
			if ($this->input->post('login_type') == 'accountant') {
                $this->session->set_userdata('accountant_login', '1');
                $this->session->set_userdata('accountant_id', $row->name);
                $this->session->set_userdata('name', $row->phone);
                $this->session->set_userdata('login_type', 'accountant');
            }
			if ($this->input->post('login_type') == 'office') {
                $this->session->set_userdata('office_login', '1');
                $this->session->set_userdata('office_id', $row->name);
                $this->session->set_userdata('name', $row->phone);
                $this->session->set_userdata('login_type', 'office');
            }
            return TRUE;
        } else {
            $this->session->set_flashdata('flash_message', get_phrase('login_failed'));
            redirect(base_url() . 'index.php?login', 'refresh');
            return FALSE;
        }
    }
    
    /***DEFAULT NOR FOUND PAGE*****/
    function four_zero_four()
    {
        $this->load->view('four_zero_four');
    }
    

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/
	function reset_password()
	{
		$account_type = $this->input->post('account_type');
		if ($account_type == "") {
			redirect(base_url(), 'refresh');
		}
		
		if($account_type == 'parent'){
			$email  = $this->input->post('email');
			$result = $this->email_model->password_reset_email('parent', $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		}
		else{
			$email  = $this->input->post('email');
			$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL
		}
		if ($result == true) {
			$this->session->set_flashdata('flash_message', get_phrase('password_sent'));
		} else if ($result == false) {
			$this->session->set_flashdata('flash_message', get_phrase('account_not_found'));
		}
		
		redirect(base_url(), 'refresh');		
	}
    /*******LOGOUT FUNCTION *******/
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() . 'index.php?login', 'refresh');
    }
    
}
