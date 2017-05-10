<?php
//error_reporting(E_ALL);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* 	
 * 	@author : Joyonto Roy
 * 	date	: 20 August, 2013
 * 	University Of Dhaka, Bangladesh
 *   Nulled By Vokey 
 * 	Ekattor School & College Management System
 * 	http://codecanyon.net/user/joyontaroy
 */

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Email_model');
		$this->load->model('cce_model');
        $this->load->database();
        /* cache control */
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
		$this->load->helper('tam_helper');
		$this->load->helper('date');
    }

    /*     * *default functin, redirects to login page if no admin logged in yet** */

    public function index() {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /*     * *ADMIN DASHBOARD** */

    function dashboard() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $login_type = $this->session->userdata('login_type');
        $user_id = $this->session->userdata($login_type.'_id');
        $results = $this->db->get_where('email',array('type' => strtolower($login_type)))->result_array();
        $i = 0 ;
        foreach($results as $result){
             $unread = explode(',',$result['unread']);
             if(in_array($user_id,$unread)){
                 $i++;
             }
             
        }
//       $this->dynamic_load->add_css(array('href' => asset_url('css','core/bootstrap.min.css'), 'rel'  => 'stylesheet', 'type' => 'text/css'));
//        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','core/bootstrap.js'), 'type' => 'text/javascript'));
   
        $page_data['page_name'] = 'dashboard';
        $page_data[$login_type.'_message'] =  $i;
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE SMS CLASSWISE***** */

    function sms_view($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        //echo "The class id is ".$param1;
        if ($param2 == 'send_group_sms') {
            $numbers = $this->input->post('sms_recepients1');
            $msg = $this->input->post('send_sms');
            if ($numbers == -1 || $numbers == "-1") {
                send_sms_to_class($param1, $msg);
            }
        }
        if ($param2 == 'send_template_sms') {
            
        }
        $page_data['class_id'] = $param1;
        $page_data['page_name'] = 'sms_view';
        $page_data['page_title'] = get_phrase('sms_view');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE SMS TEMPLATE***** */

    function sms_template_view($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['sms_template_content'] = $this->input->post('sms_template_content');
            $this->db->insert('sms_template', $data);
            redirect(base_url() . 'index.php?admin/sms_template_view', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['sms_template_content'] = $this->input->post('sms_template_content');
            $this->db->where('sms_template_id', $param2);
            $this->db->update('sms_template_content', $data);
            //$this->db->last_query();
            redirect(base_url() . 'index.php?admin/sms_template_view', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('sms_template', array(
                        'sms_template_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('sms_template_id', $param2);
            $this->db->delete('sms_template');
            redirect(base_url() . 'index.php?admin/sms_template_view', 'refresh');
        }
        $page_data['sms_templates'] = $this->db->get('sms_template')->result_array();
        $page_data['page_name'] = 'sms_template_view';
        $page_data['page_title'] = get_phrase('sms_template_view');
        $this->load->view('index', $page_data);
    }

    function sent_sms() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['sent_sms'] = $this->db->get('sent_sms')->result_array();
        $page_data['page_name'] = 'sent_sms';
        $page_data['page_title'] = get_phrase('sent_sms');
        $this->load->view('index', $page_data);
    }
	
	
	/* ########################MANAGE MAIL SMS############################### */
	
	function mailsms(){
		
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'mailsms';
        $page_data['page_title'] = get_phrase('mail / sms');
        $this->load->view('index', $page_data);
	}
    function getClass(){
		$this->load->model('fee_model');
		$sm_class_data = $this->fee_model->getclass();
			
			$apnddata .=' 	<div class="control-group"><label class="control-label" for="rec_c_id">'.get_phrase('class').'</label>
<div class="controls"><select id="rec_c_id" name="rec_c_id" class="uniform validate[required]"><option value="">----select class----</option><option value="all">ALL</option>';
			
			foreach($sm_class_data as $sm_class_data_view){
				
				$apnddata .='<option value="'.$sm_class_data_view->class_id.'">'.$sm_class_data_view->name.'-'.$sm_class_data_view->name_numeric.'</option>';
				
			}
			$apnddata .='</select></div></div>';
			
			echo $apnddata;
	}
	
	function sendmailsms(){
		
		$rmthd = $this->input->post('receivermethod');
		$rtype = $this->input->post('receivertype');
		
		if($rtype == 1){
			
			$sm_qry = $this->db->get('teacher')->result();
			
			$smsdata='';
			foreach($sm_qry as $sm_qry_dta){
				if($sm_qry_dta->phone!=''){
				$smsdata.= $sm_qry_dta->phone.',';
				}
			}
			
			$smsto = rtrim($smsdata,',');
			
		}
		
		if($rtype == 2){
			
			$cid = $this->input->post('rec_c_id');
			
			if($cid!='' && $cid!='all'){
				$this->db->where('class_id',$cid);
				
			
			} 
				
			$sm_qry = $this->db->get('student')->result();
			
			
			$smsdata='';
			foreach($sm_qry as $sm_qry_dta){
				if($sm_qry_dta->phone!=''){
				$smsdata.= $sm_qry_dta->phone.',';
				}
			}
			
			
			$smsto = rtrim($smsdata,',');
		}
		
		if($rtype == 3){
			
			$cid = $this->input->post('rec_c_id');
			
			if($cid!='' && $cid!='all'){
				$this->db->where('class_id',$cid);
				
			
			} 
				
			$sm_qry = $this->db->get('student')->result();
			
			
			$smsdata='';
			foreach($sm_qry as $sm_qry_dta){
				if($sm_qry_dta->parent_phone1!=''){
				$smsdata.= $sm_qry_dta->parent_phone1.',';
				}
			}
			
			
			$smsto = rtrim($smsdata,',');
		}
		
		if($rmthd == 1){
			
			$msg = $this->input->post('smmsg');
			
			
		  $sus_sm = send_tam_sms($smsto,$msg);	
		  
		 // if($sus_sm !=''){
			 $this->session->set_flashdata('msg', 'SMS Send Success');
                redirect(base_url() . 'index.php?admin/mailsms/', 'refresh');  
		 // }
			
		}
		if($rmthd == 2){
			$ac_type  = $rtype;
            $email_subject = $this->input->post('smmsgt');
            $email_body = $this->input->post('smmsg');
            if($ac_type == 2){
				$cid = $this->input->post('rec_c_id');
			
			if($cid!='' && $cid!='all'){
				$this->db->where('class_id',$cid);
				
			
			} 
                  $results = $this->db->get('student')->result_array();
                  foreach($results as $result){
                     if(!empty($result['email'])){
                        $student_email[] = $result['email'];
                        $student_id[] = $result['student_id'];
                     }
                  }
                  $student_to = implode(',',$student_email);
                  $student_read = implode(',',$student_id);
                  $data = array();
                  $data['unread'] = $student_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'student';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  
                  $this->db->insert('email', $data);
                  $this->email_model->send_email('student', $student_to,$email_subject,$email_body);
                  
            }
            else if($ac_type == 1){
                  $results = $this->db->get('teacher')->result_array();
                  foreach($results as $result){
                        if(!empty($result['email'])){
                            $teacher_email[] = $result['email'];
                            $teacher_id[] = $result['teacher_id'];
                        }
                   }
                  $teacher_read = implode(',',$teacher_id);
                  $data = array();
                  $data['unread'] = $teacher_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'teacher';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  $this->db->insert('email', $data);
                  
                  $teacher_to = implode(',',$teacher_email);
                  $this->email_model->send_email('teacher', $teacher_to,$email_subject,$email_body);
            }
            else if($ac_type == 3){
				
				$cid = $this->input->post('rec_c_id');
			
			if($cid!='' && $cid!='all'){
				$this->db->where('class_id',$cid);
				
			
			} 
                  $result = $this->db->get('student')->result_array();
                 
                  foreach($result as $result){
                    
                      if(!empty($result['parent_email'])){
                            $parent_email[] = $result['parent_email'];
                            $parent_id[] = $result['student_id'];
                        }
                        }
                   if(!empty($parent_id)){
                        $parent_read = implode(',',$parent_id);
                   }
                  $data = array();
                  $data['unread'] = $parent_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'parent';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  $this->db->insert('email', $data);
				  
				   $parent_to = implode(',',$parent_email);
                  $this->email_model->send_email('parent', $parent_to,$email_subject,$email_body);
                  }
                
				 $this->session->set_flashdata('msg', 'Mail Send Success');
                redirect(base_url() . 'index.php?admin/mailsms/', 'refresh');   
            
		}
		
		//send_tam_sms($to,$msg);
	}
    /*     * **MANAGE STUDENTS CLASSWISE**** */

    function student($param1 = '', $param2 = '', $param3 = '') {

        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('firstname').' '.$this->input->post('lastname');            
            $data['sex'] = $this->input->post('sex');
			$data['student_academicyear_id'] = $this->input->post('student_academicyear_id');
            $data['father_name'] = $this->input->post('father_first_name').' '.$this->input->post('father_last_name');
            $data['mother_name'] = $this->input->post('mother_first_name').' '.$this->input->post('mother_last_name');
            $data['birthday'] = $this->input->post('birthday');
            $data['birth_place'] = $this->input->post('birth_place');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['nationality'] = $this->input->post('nationality');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['parent_email'] = $this->input->post('parent_email');
            $data['parent_password'] = $this->input->post('parent_password');
            $data['parent_phone1'] = $this->input->post('parent_phone1');
            $data['parent_phone2'] = $this->input->post('parent_phone2');
            $data['student_parent_email'] = $this->input->post('student_parent_email');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['class_id'] = $this->input->post('class_id');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['roll'] = $this->input->post('roll');
            $data['occupation'] = $this->input->post('occupation');
            $data['income_per_annum'] = $this->input->post('income_per_annum');
			
			$data['admission_number'] = $this->input->post('admission_number');
			$data['doj'] = $this->input->post('doj');
			$data['height'] = $this->input->post('height');
			$data['weight'] = $this->input->post('weight');
			$data['passport_number'] = $this->input->post('passport_number');
			$data['date_of_issue'] = $this->input->post('date_of_issue');
			$data['date_of_expiry'] = $this->input->post('date_of_expiry');
			$data['student_cid'] = $this->input->post('country_id');
			$data['father_cid'] = $this->input->post('father_country_id');
			$data['mother_cid'] = $this->input->post('mother_country_id');
            
            $this->db->insert('student', $data);
            $student_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');
            $this->email_model->account_opening_email('student', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			
			/* ////////////////////// SEND SMS TO PARENT /////////////////// */
			
			$system_name	=	$this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
			
			$to = $data['parent_phone1'].",".$data['parent_phone2'];
			
			$msg = "";
			$msg .="Thank you for associate with ". $system_name." please find your details to signin ";
			$msg .="Username: ".$data['parent_email'];
			$msg .=" Password: ".$data['parent_password'];
			
			$res = send_tam_sms($to,$msg);
			
			if($res){
			
            redirect(base_url() . 'index.php?admin/student/' . $data['class_id'], 'refresh');
			}
        }
		if ($param2 == 'promote')
		{
			   $data['class_id']    = $this->input->post('class_id');
         	   $this->db->where('student_id', $param3);
           	   $this->db->update('student', $data);
		//	   redirect(base_url() . 'index.php?admin/student/' . $param2, 'refresh');
		  redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        }
        if ($param2 == 'do_update') {
            $data['name'] = $this->input->post('name');            
            $data['sex'] = $this->input->post('sex');
			$data['student_academicyear_id'] = $this->input->post('student_academicyear_id');
            $data['father_name'] = $this->input->post('father_name');
            $data['mother_name'] = $this->input->post('mother_name');
            $data['birthday'] = $this->input->post('birthday');
            $data['birth_place'] = $this->input->post('birth_place');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['nationality'] = $this->input->post('nationality');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['parent_email'] = $this->input->post('parent_email');
            $data['parent_password'] = $this->input->post('parent_password');
            $data['parent_phone1'] = $this->input->post('parent_phone1');
            $data['parent_phone2'] = $this->input->post('parent_phone2');
            $data['student_parent_email'] = $this->input->post('student_parent_email');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');
            $data['class_id'] = $this->input->post('class_id');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['roll'] = $this->input->post('roll');
            $data['occupation'] = $this->input->post('occupation');
            $data['income_per_annum'] = $this->input->post('income_per_annum');
			
			$data['admission_number'] = $this->input->post('admission_number');
			$data['doj'] = $this->input->post('doj');
			$data['height'] = $this->input->post('height');
			$data['weight'] = $this->input->post('weight');
			$data['passport_number'] = $this->input->post('passport_number');
			$data['date_of_issue'] = $this->input->post('date_of_issue');
			$data['date_of_expiry'] = $this->input->post('date_of_expiry');
			$data['student_cid'] = $this->input->post('country_id');
			$data['father_cid'] = $this->input->post('father_country_id');
			$data['mother_cid'] = $this->input->post('mother_country_id');
			
			
			

            $this->db->where('student_id', $param3);
            $this->db->update('student', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param3 . '.jpg');
            $this->crud_model->clear_cache();

            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        } else if ($param2 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('student', array(
                        'student_id' => $param3
                    ))->result_array();
        } else if ($param2 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_student_id'] = $param3;
        } else if ($param2 == 'academic_result') {
            $page_data['academic_result'] = true;
            $page_data['current_student_id'] = $param3;
        }
        if ($param2 == 'delete') {
            $this->db->where('student_id', $param3);
            $this->db->delete('student');
            redirect(base_url() . 'index.php?admin/student/' . $param1, 'refresh');
        } else if ($param2 == 'upload') {
            $page_data['upload'] = 'active';
        }

        $page_data['class_id'] = $param1;
        $page_data['students'] = $this->db->get_where('student', array(
                    'class_id' => $param1
                ))->result_array();
		$this->db->select('*');
		$this->db->from('academicyear');
		$page_data['academicyear'] = $this->db->get()->result_array();
		
		
		$this->db->where('status',1);
		$page_data['country_data'] = $this->db->get_where('tam_country')->result_array();
		
        $page_data['page_name'] = 'student';
        $page_data['page_title'] = get_phrase('view_student');

        $this->load->view('index', $page_data);
        
		
		/********************my email****************************/
	
        
        /**********************************************************************************************/
         if ($param1 == 'do_upload') {
	
           if($_POST['isupload']){
      $class=$_POST['class_id'];
        //$values=$this->validate($_POST);
        
        if(isset($_FILES)){
             
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'xls|xlsx';
            $config['max_size'] = '100000';
            $config['file_name'] = time().'-'.$_POST['excelfile'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config); 
            if (!$this->upload->do_upload('excelfile')) {
                echo $error = $this->upload->display_errors();
        }       
        $req['image_url']=$this->upload->do_upload('excelfile');
   
      
      $data = array('upload_data' => $this->upload->data());
      $path= $data['upload_data']['full_path'];
        
      require_once APPPATH.'libraries/phpexcel/PHPExcel.php';
      require_once APPPATH.'libraries/phpexcel/PHPExcel/IOFactory.php';

      
$inputFileName = $path;

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); 
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
$counter=1;
for ($row =2,$i=0; $row <= $highestRow; $row++){ 
    
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
 $roll_no=$rowData[$i][0];
 $name=$rowData[$i][1];
 $gender=$rowData[$i][2];
 $dob=$rowData[$i][3];
 $father_name=$rowData[$i][4];
 $mother_name=$rowData[$i][5];
 $birthplace=$rowData[$i][6];
 $blood_group=$rowData[$i][7];
 $religion=$rowData[$i][8];
 $cast=$rowData[$i][9];
 $nationality=$rowData[$i][10];
 $user_name=$rowData[$i][11];
 $password=$rowData[$i][12];
 $parent_username=$rowData[$i][13];
 $parent_password=$rowData[$i][14];
 $parent_phone1=$rowData[$i][15];
 $parent_phone2=$rowData[$i][16];
 $parent_email=$rowData[$i][17];
 $occupation=$rowData[$i][18];
 $income=$rowData[$i][19];
 $present_address=$rowData[$i][20];
 $permanent_address=$rowData[$i][21];
 $previous_school=$rowData[$i][22];
 
// print_r($rowData);

if( (!empty($roll_no)) && ($roll_no!="") && ($class!="") && (!empty($class)) && (!empty($name)) && ($name!="")){ 
 
if( (!empty($gender)) && ($gender!="") && (!empty($dob)) && (!empty($dob)) && (!empty($father_name)) && (!empty($father_name))){   
     
if( (!empty($mother_name)) && ($mother_name!="") && (!empty($birthplace)) && (!empty($birthplace)) && (!empty($blood_group)) && (!empty($blood_group))){     
     
if( (!empty($religion)) && ($religion!="") && (!empty($cast)) && (!empty($cast)) && (!empty($nationality)) && (!empty($nationality))){  
     
if( (!empty($user_name)) && ($user_name!="") && (!empty($password)) && (!empty($password)) && (!empty($parent_username)) && (!empty($parent_username))){ 
         
if( (!empty($parent_password)) && ($parent_password!="") && (!empty($parent_phone1)) && (!empty($parent_phone1)) && (!empty($parent_email)) && (!empty($parent_email))){         
         
if( (!empty($occupation)) && ($occupation!="") && (!empty($income)) && (!empty($income)) && (!empty($present_address)) && (!empty($present_address))){    
    
if( (!empty($permanent_address)) && ($permanent_address!="")  ){  
         
    $query = $this->db->query("select roll from student where roll='$roll_no' and class_id='$class'");
      $rowcount = $query->num_rows();
      if($rowcount=='0'){
              
         $query = $this->db->query("insert into student(roll,name,sex,birthday,father_name,
     mother_name,birth_place,blood_group,religion,cast,nationality,email,password,parent_email,
     parent_password,parent_phone1,parent_phone2,student_parent_email,occupation,income_per_annum,
     address,permanent_address,previous_school_name,class_id) values('$roll_no','$name',
        '$gender','$dob','$father_name','$mother_name','$birthplace','$blood_group',
         '$religion','$cast','$nationality','$user_name','$password','$parent_username',
         '$parent_password','$parent_phone1','$parent_phone2','$parent_email','$occupation',
         '$income','$present_address','$permanent_address','$previous_school','$class')");

          $details['item'][]="<div style='color:#1171A3;'>The Roll No $roll_no inserted successfully... </div>"; 
      }
      else{
          $details['item'][]="<div style='color:#f00;'>The Roll No $roll_no already Exists.</div> ";
      }

    } //eight if
 
} //seventh if
         
         
  } //sixth if
         
 } //fifth if
 
 } //fourth if
 
     } //third if
 
   } //second if
  
   } //first if
   
  $counter=$counter+1; 

}
//echo $counter;
}
$details['class_id']=$class;
$this->load->view('admin/resultofupload', $details);

//passparameters($details);


//redirect( base_url() . 'index.php?admin/student/'.$class.'' );

}
		
		
/***********************************************************************************************/	

if(isset($_POST['bulk-promote'])){
	 $class_id=$_POST['promote_class_id'];
    $p_class = $this->input->post('p_class');
	 $count = $_POST['selectCount'];
	 
	 if(!empty($class_id) && ($class_id!="")){
    for ($i = 0; $i < $count; $i++) {
        if (isset($_POST['custom-student' . $i])) {
           $student_id = $_POST['custom-student' . $i];
		  
        $query = $this->db->query("update student set class_id=$class_id where student_id=$student_id");
            
        }
    }
	}
	redirect( base_url() . 'index.php?admin/student/'.$p_class.'' );
	}	
	
        
        
        
        
        
	if(isset($_POST['bulk-email'])){
	 $exam_id=$_POST['exam_id'];
         $count = $_POST['selectCount'];
	 
	 if(!empty($exam_id) && ($exam_id!="")){
    for ($i = 0; $i < $count; $i++) {
        if (isset($_POST['custom-student' . $i])) {
           $student_id = $_POST['custom-student' . $i];
	
           $query = mysql_query("select st.student_id,st.name as student_name,st.roll,st.student_parent_email,
		ee.name as exam_name,cc.name as class_name,ss.name as 
		subject_name,mm.mark_obtained,mm.mark_total
		from student st
		inner join class cc on cc.class_id=st.class_id
		inner join subject ss on ss.class_id=st.class_id
		inner join mark mm on mm.student_id=st.student_id
		inner join exam ee on ee.exam_id=mm.exam_id
		where st.student_id=$student_id and ee.exam_id=$exam_id group by ss.name order by ss.subject_id
		");
           
   
     
              while ($record = mysql_fetch_assoc( $query)) {
                   $student[$i][] = array('student_name' => $record['student_name'],
                                      'roll' => $record['roll'],
                                      'exam'  =>  $record['exam_name'],
                                      'class' =>  $record['class_name'],
                                      'subject_name'  =>  $record['subject_name'],
                                      'mark_obtained'  => $record['mark_obtained'],
                                      'mark_total'  =>  $record['mark_total'],         
        );
              }
              
       $sizeCount= sizeof($student[$i]); 
          
           
          $m[$i].='
		<table border="1">
		<tr>
		<td> Student Name</td>
		<td> Roll</td>
		<td> Exam</td>
		<td> Class</td>
		<td> Subject Name</td>
		<td> Marks Obtained</td>
		<td> Max Marks</td>
		</tr>'; 
          $a=0;
          for($p=0;$p<$sizeCount;$p++){ 
          $total= $student[$i][$p]['mark_obtained']+ $a;
               $a=$total;
          $m[$i].='
	   <tr>
		<td>'. $student[$i][$p]['student_name'].'  </td>
		<td>'.$student[$i][$p]['roll'].' </td>
		<td> '.$student[$i][$p]['exam'].' </td>
		<td> '.$student[$i][$p]['class'].' </td>
		<td> '.$student[$i][$p]['subject_name'].' </td>
		<td>'.$student[$i][$p]['mark_obtained'].' </td>
		<td> '.$student[$i][$p]['mark_total'].'  </td>
		</tr> ';
      
}
$m[$i].='<tr><td colspan="7">'.$a.'</td></tr>'; 
     $m[$i].='</table>';             

           
         
           
           
           
    echo   $m[$i];  
       
		
   /*
 $to="ritesh.1221@gmail.com";

$headers='MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html;charset=iso-8859-1' . "\r\n";
$headers .= 'From:' .$to. "\r\n";
  

$bodys .= " <br>";
  $subje .="Order Application";
  $receiver="ritesh.h4b@gmail.com";
  


  
    if(mail($receiver, $subje, $m[$i], $headers)){
        
     print('<script type="text/javascript">
                alert("Mail sent succesfully!!!");
               
             </script>');
        }else{
        print('<script type="text/javascript">
                alert("Mail sending failed!!!");
             </script>');
    }

  */
       
       /*
    $config = Array(
  'protocol' => 'smtp',
  'smtp_host' => 'ssl://smtp.googlemail.com',
  'smtp_port' => 465,
  'smtp_user' => 'ritesh.1221@gmail.com', // change it to yours
  'smtp_pass' => 'Ritesh@1221', // change it to yours
  'mailtype' => 'html',
  'charset' => 'iso-8859-1',
  'wordwrap' => TRUE
);

        $message = '';
        $this->load->library('email', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('ritesh.1221@gmail.com'); // change it to yours
      $this->email->to('ritesh.1221@gmail.com');// change it to yours
      $this->email->subject('Resume from JobsBuddy for your Job posting');
      $this->email->message($message);
      if($this->email->send())
     {
      echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }

       */
       /*
        $fromEmail="ritesh.h4b@gmail.com";
        $fromName="ritesh";
       $email="ritesh.1221@gmail.com";
            $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->load->library('email');

        $this->email->initialize($config);

        $this->email->from($fromEmail, $fromName);
        $this->email->to($email);

        $this->email->subject('Тест Email');
        $this->email->message('hai');

        if($this->email->send())
     {
      echo 'Email sent.';
     }
     else
    {
     show_error($this->email->print_debugger());
    }
     
      */


       /*
        $email="ritesh.1221@gmail.com";
        $subject="hai";
        $body="hai";
     $this->load->library('phpmailer');  
       
       $subject               =             'Test Email';

$name                  =             'Engr Mudasir';



$body                   =             "This si body text for test email to combine CodeIgniter and PHPmailer";

$this->phpmailer->AddAddress($email);

$this->phpmailer->IsMail();

$this->phpmailer->From     = 'info@computersneaker.com';

$this->phpmailer->FromName = 'Computer Sneaker';

$this->phpmailer->IsHTML(true);

$this->phpmailer->Subject  =  $subject;

$this->phpmailer->Body     =  $body;

if($this->phpmailer->Send()){
    echo "mail sent";
}else{
    echo "not sent";
}
       
     */  
       
       
       
       
       /*
      $config = Array(
			      'protocol' => 'smtp',
			      'smtp_host' => 'ssl://smtp.googlemail.com',
			      'smtp_port' => 465,
			      'smtp_user' => 'ritesh.1221@gmail.com',
			      'smtp_pass' => 'Ritesh@1221',
						'mailtype' => 'html'
			);
			
		
      
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");

			// Set to, from, message, etc.
			$this->email->to("ritesh.1221@gmail.com");
			$this->email->from("ritesh.1221@gmail.com","CodeRiddles Support");
			$this->email->bcc("ritesh.1221@gmail.com"); 
			$this->email->subject("Codeigniter email library Test");
			$this->email->message("<b>Codeigniter email Library</b> Body Content");
			
			
			$result = $this->email->send();
			echo $this->email->print_debugger(); 
       
       
       */
       

 /*
  $this->load->library('email');
  $this->email->from('ritesh.1221@gmail.com', "Admin Team");
  $this->email->to("ritesh.1221@gmail.com");
  $this->email->cc("ritesh.1221@gmail.com");
  $this->email->subject("This is test subject line");
  $this->email->message("Mail sent test message...");
   
  $data['message'] = "Sorry Unable to send email..."; 
  if($this->email->send()){     
   $data['message'] = "Mail sent..."; 
    echo "mail sent";
  }else{
      show_error($this->email->print_debugger());
  }
       
     */
       
       /*
       
    $this->load->library('email');
    $this->load->library('parser');



    $this->email->clear();
    $config['mailtype'] = "html";
    $this->email->initialize($config);
    $this->email->set_newline("\r\n");
    $this->email->from('ritesh.1221@gmail.com', 'Website');
    $list = array('ritesh.1221@gmail.com', 'ritesh.1221@gmail.com');
    $this->email->to($list);
    $data = array();
   // $htmlMessage = $this->parser->parse('messages/email', $data, true);
    $this->email->subject('This is an email test');
    $this->email->message('htmlMessage');



    if ($this->email->send()) {
        echo 'Your email was sent, thanks chamil.';
    } else {
        show_error($this->email->print_debugger());
    }   
       
      */ 
       

    
        }
        
        
    }
	 
	 }
	 
         
         
         
         
         
         
         
         
         
         else
	 if(($exam_id="")){
    for ($i = 0; $i < $count; $i++) {
        if (isset($_POST['custom-student' . $i])) {
           $student_id = $_POST['custom-student' . $i];
		  
        $query = $this->db->query("select st.student_id,st.name as student_name,st.roll,
		ee.name as exam_name,cc.name as class_name,ss.name as 
		subject_name,mm.mark_obtained,mm.mark_total
		from student st
		inner join class cc on cc.class_id=st.class_id
		inner join subject ss on ss.class_id=st.class_id
		inner join mark mm on mm.student_id=st.student_id
		inner join exam ee on ee.exam_id=mm.exam_id
		where st.student_id=$student_id
		");
            
        }
    }
	 
	 }
	
	}
	
	
		if(isset($_POST['bulk-sms'])){
	 $exam_id=$_POST['exam_id'];
    
	 
	 $count = $_POST['selectCount'];
	 
	 if(!empty($exam_id) && ($exam_id!="")){
    for ($i = 0; $i < $count; $i++) {
        if (isset($_POST['custom-student' . $i])) {
           $student_id = $_POST['custom-student' . $i];
		  
        $query = $this->db->query("select st.student_id,st.name as student_name,st.roll,
		ee.name as exam_name,cc.name as class_name,ss.name as 
		subject_name,mm.mark_obtained,mm.mark_total
		from student st
		inner join class cc on cc.class_id=st.class_id
		inner join subject ss on ss.class_id=st.class_id
		inner join mark mm on mm.student_id=st.student_id
		inner join exam ee on ee.exam_id=mm.exam_id
		where st.student_id=$student_id and ee.exam_id=$exam_id
		");
            
        }
    }
	 
	 }
	 else
	 if(($exam_id="")){
    for ($i = 0; $i < $count; $i++) {
        if (isset($_POST['custom-student' . $i])) {
           $student_id = $_POST['custom-student' . $i];
		  
        $query = $this->db->query("select st.student_id,st.name as student_name,st.roll,
		ee.name as exam_name,cc.name as class_name,ss.name as 
		subject_name,mm.mark_obtained,mm.mark_total
		from student st
		inner join class cc on cc.class_id=st.class_id
		inner join subject ss on ss.class_id=st.class_id
		inner join mark mm on mm.student_id=st.student_id
		inner join exam ee on ee.exam_id=mm.exam_id
		where st.student_id=$student_id
		");
            
        }
    }
	 
	 }
	
	}
	
	
	
	
		
		
		
		
		
		
        }
        }  
        
        
        
   
   
   /*    Check student roll exists or not      */
	function sdtamcheck(){
		
		$admission_number = trim($this->input->post('chkan'));
		
		
		$this->db->where('admission_number',$admission_number);
		
		
		$admission_number_chk_count = $this->db->count_all_results('student');
		if($admission_number_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/*    Check student roll exists or not      */
	function sdtrollcheck(){
		
		$sroll = trim($this->input->post('chkroll'));
		
		$psroll = trim($this->input->post('prvroll'));
		
		$sclass = trim($this->input->post('chkrollcls'));
		
		$this->db->where('roll',$sroll);
		$this->db->where('class_id',$sclass);
		
		if($psroll!=''){
			$this->db->where('roll !=',$psroll);
		}
		
		
		$roll_chk_count = $this->db->count_all_results('student');
		if($roll_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	
	/*    Check student email exists or not      */
	function sdtemailcheck(){
		
		$semail = trim($this->input->post('chkmail'));
		
		$psemail = trim($this->input->post('prevmail'));
		
		$this->db->where('email',$semail);
		
		if($psemail!=''){
			$this->db->where('email !=',$psemail);
		}
		
		$mail_chk_count = $this->db->count_all_results('student');
		if($mail_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/*    Check emp code exists or not      */
	function tchcodecheck(){
		
		$tcode = trim($this->input->post('chkcode'));
		
		$ptcode = trim($this->input->post('prevchkcode'));
		
		$this->db->where('employee_code',$tcode);
		
		if($ptcode!=''){
			$this->db->where('employee_code !=',$ptcode);
		}
		
		$code_chk_count = $this->db->count_all_results('teacher');
		if($code_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/*    Check teacher username exists or not      */
	function tchemailcheck(){
		
		$temail = trim($this->input->post('chkmail'));
		
		$ptemail = trim($this->input->post('prevmail'));
		
		$this->db->where('email',$temail);
		
		if($ptemail!=''){
			$this->db->where('email !=',$ptemail);
		}
		
		$mail_chk_count = $this->db->count_all_results('teacher');
		if($mail_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	/*    Check teacher email exists or not      */
	function tchtemailcheck(){
		
		$temail = trim($this->input->post('chkmail'));
		
		$ptemail = trim($this->input->post('prevmail'));
		
		$this->db->where('teacher_email',$temail);
		
		if($ptemail!=''){
			$this->db->where('teacher_email !=',$ptemail);
		}
		
		$mail_chk_count = $this->db->count_all_results('teacher');
		if($mail_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}


    /*     * **MANAGE PARENTS CLASSWISE**** */

    function parent($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['student_id'] = $param2;
            $data['relation_with_student'] = $this->input->post('relation_with_student');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['profession'] = $this->input->post('profession');
            $this->db->insert('parent', $data);
            $this->email_model->account_opening_email('parent', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

            $class_id = $this->db->get_where('student', array('student_id' => $data['student_id']))->row()->class_id;
            redirect(base_url() . 'index.php?admin/parent/' . $class_id, 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['relation_with_student'] = $this->input->post('relation_with_student');
            $data['phone'] = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['profession'] = $this->input->post('profession');

            $this->db->where('parent_id', $param2);
            $this->db->update('parent', $data);

            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('parent', array(
                        'parent_id' => $param3
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('parent_id', $param2);
            $this->db->delete('parent');
            redirect(base_url() . 'index.php?admin/parent/' . $param3, 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['students'] = $this->db->get_where('student', array(
                    'class_id' => $param1
                ))->result_array();
        $page_data['page_name'] = 'parent';
        $page_data['page_title'] = get_phrase('manage_parent');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE TEACHERS**** */

    function teacher($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('firstname').' '.$this->input->post('lastname');
			$data['employee_code'] = $this->input->post('employee_code');
			$data['employee_academicyear_id'] = $this->input->post('employee_academicyear_id');
			$data['employee_department_id'] = $this->input->post('employee_department_id');
            $data['sex'] = $this->input->post('sex');
            $data['birthday'] = $this->input->post('birthday');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['subject'] = $this->input->post('subject');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');                     
            $data['phone'] = $this->input->post('phone');
            $data['teacher_email'] = $this->input->post('teacher_email');
            $data['father_name'] = $this->input->post('father_first_name').' '.$this->input->post('father_last_name');
            $data['father_mobile_number'] = $this->input->post('father_mobile_number');

            $this->db->insert('teacher', $data);
            $teacher_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id . '.jpg');
            $this->email_model->account_opening_email('teacher', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
			$data['employee_code'] = $this->input->post('employee_code');
			$data['employee_academicyear_id'] = $this->input->post('employee_academicyear_id');
			$data['employee_department_id'] = $this->input->post('employee_department_id');
            $data['sex'] = $this->input->post('sex');
            $data['birthday'] = $this->input->post('birthday');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['blood_group'] = $this->input->post('blood_group');
            $data['subject'] = $this->input->post('subject');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');                     
            $data['phone'] = $this->input->post('phone');
            $data['teacher_email'] = $this->input->post('teacher_email');
            $data['father_name'] = $this->input->post('father_name');
            $data['father_mobile_number'] = $this->input->post('father_mobile_number');

            $this->db->where('teacher_id', $param2);
            $this->db->update('teacher', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        } else if ($param1 == 'personal_profile') {
            $page_data['personal_profile'] = true;
            $page_data['current_teacher_id'] = $param2;
        } else if ($param1 == 'edit') {
			
			
            $page_data['edit_data'] = $this->db->get_where('teacher', array(
                        'teacher_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('teacher_id', $param2);
            $this->db->delete('teacher');
            redirect(base_url() . 'index.php?admin/teacher/', 'refresh');
        }
		 $page_data['department_id'] = $param1;
			$this->db->where('department_status','active');
		
		$page_data['departments'] = $this->db->get('departments')->result_array();
		
		$this->db->select('teacher.*,departments.department_name as dname');
		$this->db->from('teacher,departments');
		$this->db->where('teacher.employee_department_id = departments.department_id');
		$this->db->where('teacher.employee_department_id', $param1);
        $page_data['teachers'] = $this->db->get()->result_array();
		$this->db->select('*');
		$this->db->from('academicyear');
		$page_data['academicyear'] = $this->db->get()->result_array();
        $page_data['page_name'] = 'teacher';
        $page_data['page_title'] = get_phrase('view_teacher');
        $this->load->view('index', $page_data);
    }
/*     * **MANAGE STAFF**** */

    function staff($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('firstname').' '.$this->input->post('lastname');
			$data['employee_code'] = $this->input->post('employee_code');
			$data['employee_academicyear_id'] = $this->input->post('employee_academicyear_id');
			$data['employee_department_id'] = $this->input->post('employee_department_id');
            $data['sex'] = $this->input->post('sex');
            $data['birthday'] = $this->input->post('birthday');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['blood_group'] = $this->input->post('blood_group');
            //$data['subject'] = $this->input->post('subject');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');                     
            $data['phone'] = $this->input->post('phone');
            $data['staff_email'] = $this->input->post('staff_email');
            $data['father_name'] = $this->input->post('father_first_name').' '.$this->input->post('father_last_name');
            $data['father_mobile_number'] = $this->input->post('father_mobile_number');

            $this->db->insert('staff_data', $data);
            $staff_id = mysql_insert_id();
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $staff_id . '.jpg');
           // $this->email_model->account_opening_email('staff', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
            redirect(base_url() . 'index.php?admin/staff/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
			$data['employee_code'] = $this->input->post('employee_code');
			$data['employee_academicyear_id'] = $this->input->post('employee_academicyear_id');
			$data['employee_department_id'] = $this->input->post('employee_department_id');
            $data['sex'] = $this->input->post('sex');
            $data['birthday'] = $this->input->post('birthday');
            $data['religion'] = $this->input->post('religion');
            $data['cast'] = $this->input->post('cast');
            $data['email'] = $this->input->post('email');
            $data['password'] = $this->input->post('password');
            $data['blood_group'] = $this->input->post('blood_group');
            //$data['subject'] = $this->input->post('subject');
            $data['previous_school_name'] = $this->input->post('previous_school_name');
            $data['address'] = $this->input->post('address');
            $data['permanent_address'] = $this->input->post('permanent_address');                     
            $data['phone'] = $this->input->post('phone');
            $data['staff_email'] = $this->input->post('staff_email');
            $data['father_name'] = $this->input->post('father_name');
            $data['father_mobile_number'] = $this->input->post('father_mobile_number');

            $this->db->where('staff_id', $param2);
            $this->db->update('staff_data', $data);
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/staff_image/' . $param2 . '.jpg');
            redirect(base_url() . 'index.php?admin/staff/', 'refresh');
        } else if ($param1 == 'staff_profile') {
            $page_data['staff_profile'] = true;
            $page_data['current_staff_id'] = $param2;
        } else if ($param1 == 'edit') {
			
			
            $page_data['edit_data'] = $this->db->get_where('staff_data', array(
                        'staff_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('staff_id', $param2);
            $this->db->delete('staff_data');
            redirect(base_url() . 'index.php?admin/staff/', 'refresh');
        }
		
			$this->db->where('department_status','active');
		
		$page_data['departments'] = $this->db->get('departments')->result_array();
		
		$this->db->select('staff_data.*,departments.department_name as dname');
		$this->db->from('staff_data,departments');
		$this->db->where('staff_data.employee_department_id = departments.department_id');
        $page_data['staff_data'] = $this->db->get()->result_array();
		$this->db->select('*');
		$this->db->from('academicyear');
		$page_data['academicyear'] = $this->db->get()->result_array();
        $page_data['page_name'] = 'non_teaching_staff';
        $page_data['page_title'] = get_phrase('non_teaching_staff');
        $this->load->view('index', $page_data);
    }
	
	
	
	/*    Check emp code exists or not      */
	function schcodecheck(){
		
		$tcode = trim($this->input->post('chkcode'));
		
		$ptcode = trim($this->input->post('prevchkcode'));
		
		$this->db->where('employee_code',$tcode);
		
		if($ptcode!=''){
			$this->db->where('employee_code !=',$ptcode);
		}
		
		$code_chk_count = $this->db->count_all_results('staff_data');
		if($code_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/*    Check staff username exists or not      */
	function schemailcheck(){
		
		$temail = trim($this->input->post('chkmail'));
		
		$ptemail = trim($this->input->post('prevmail'));
		
		$this->db->where('email',$temail);
		
		if($ptemail!=''){
			$this->db->where('email !=',$ptemail);
		}
		
		$mail_chk_count = $this->db->count_all_results('staff_data');
		if($mail_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	/*    Check staff email exists or not      */
	function schtemailcheck(){
		
		$temail = trim($this->input->post('chkmail'));
		
		$ptemail = trim($this->input->post('prevmail'));
		
		$this->db->where('staff_email',$temail);
		
		if($ptemail!=''){
			$this->db->where('staff_email !=',$ptemail);
		}
		
		$mail_chk_count = $this->db->count_all_results('staff_data');
		if($mail_chk_count > 0){
			echo "true";
		} else {
			echo "false";
		}
	}
	
	/*     * **MANAGE ENQUIRY**** */

    function frontdeskenquiry($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
			$ut = time();
			$lut = substr($ut, -6);
			$data['visit_id'] = date('Ymd').''.$lut;
            $data['name'] = $this->input->post('firstname').' '.$this->input->post('lastname');
			$data['visit_date'] = date('Y-m-d');
			$data['visit_intime'] = $this->input->post('ptime');
			$data['visit_outtime'] = $this->input->post('ptime');
			$data['phone'] = $this->input->post('phone');
			$data['purpose'] = $this->input->post('purpose');
			$data['meetperson'] = $this->input->post('mperson');
			$data['camefrom'] = $this->input->post('cfrom');
			$data['address'] = $this->input->post('address');
			$data['cdate'] = date('Y-m-d H:i:s');

            $this->db->insert('frontdeskenquiry_data', $data);
           
            redirect(base_url() . 'index.php?admin/frontdeskenquiry/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
			
            $this->db->where('staff_id', $param2);
            $this->db->update('staff_data', $data);
            redirect(base_url() . 'index.php?admin/frontdeskenquiry/', 'refresh');
        } else if ($param1 == 'edit') {
			
			
            $page_data['edit_data'] = $this->db->get_where('staff_data', array(
                        'staff_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('staff_id', $param2);
            $this->db->delete('staff_data');

            redirect(base_url() . 'index.php?admin/frontdeskenquiry/', 'refresh');
        }
		
			
		
		 $edate = $this->input->post('edate');
		if($edate !=''){
			$page_data['edate'] = $edate;
			$edt = date('Y-m-d',strtotime($edate));
			$this->db->where('visit_date',$edt);
       		$page_data['frontdeskenquiry_data'] = $this->db->get('frontdeskenquiry_data')->result_array();
		} else {
			$this->db->where('visit_date',date('Y-m-d'));
			$page_data['frontdeskenquiry_data'] = $this->db->get('frontdeskenquiry_data')->result_array();
		}
        $page_data['page_name'] = 'frontdeskenquiry';
        $page_data['page_title'] = get_phrase('front_desk_enquiry');
        $this->load->view('index', $page_data);
    }
	
	
	function tasks(){
			 
			if ($this->session->userdata('admin_login') != 1)

            redirect('login', 'refresh');
			
			$login_type = $this->session->userdata('login_type');
             $user_id = $this->session->userdata($login_type . '_id');
			 
			 $this->load->model('task_model');
			 $page_data['tasks_data'] = $this->task_model->gettasks($user_id,$login_type);
			 
			$page_data['page_info'] = 'tasks_view';
            $page_data['page_name'] = 'tasks_view';
            $page_data['page_title'] = get_phrase('things_to_do');
            $this->load->view('index', $page_data);
			
		 }
	function taskadd(){
			 
			if ($this->session->userdata('admin_login') != 1)

            redirect('login', 'refresh');
			 
			$page_data['page_info'] = 'task_add';
            $page_data['page_name'] = 'task_add';
            $page_data['page_title'] = get_phrase('thing_add');
            $this->load->view('index', $page_data);
			
		 }
	function taskedit($tid){
			 
			if ($this->session->userdata('admin_login') != 1)

            redirect('login', 'refresh');
			$this->load->model('task_model');
			$page_data['task_data'] = $this->task_model->gettask($tid);
			 
			$page_data['page_info'] = 'task_edit';
            $page_data['page_name'] = 'task_edit';
            $page_data['page_title'] = get_phrase('thing_edit');
            $this->load->view('index', $page_data);
			
		 }
	function taskinsert(){
			 
			 if ($this->session->userdata('admin_login') != 1)

             redirect('login', 'refresh');
			 
			 $login_type = $this->session->userdata('login_type');
             $user_id = $this->session->userdata($login_type . '_id');
			 
			 $taskdata['task_title'] = $this->input->post('task_title');
			 $taskdata['task_description'] = $this->input->post('task_description');
			 $taskdata['task_start_date'] = date("Y-m-d",strtotime($this->input->post('task_start_date')));
			 $taskdata['task_end_date'] = date("Y-m-d",strtotime($this->input->post('task_end_date')));
			 $taskdata['task_status'] = $this->input->post('task_status');
			 $taskdata['task_user_type'] = $login_type;
			 $taskdata['task_user_id'] = $user_id;
			 $taskdata['task_added_date'] =  date('Y-m-d H:i:s');
			 $taskdata['task_modified_date'] =  date('Y-m-d H:i:s');
			 
			 $this->load->model('task_model');
			 
			 $res = $this->task_model->insert_task($taskdata);
			 
			 if($res){
				 
				  $this->session->set_flashdata('msg', 'true');
				  $this->session->set_flashdata('task_title', $this->input->post('task_title'));
				  redirect(base_url().'index.php?'.$login_type.'/tasks', 'refresh');
			 }
			 
			 
			 
		 }
	function taskupdate(){
			 
			 if ($this->session->userdata('admin_login') != 1)

             redirect('login', 'refresh');
			 
			 $login_type = $this->session->userdata('login_type');
             $user_id = $this->session->userdata($login_type . '_id');
			 
			 $tid = $this->input->post('hid_tid');
			 
			 if($tid !=''){
			 
			 $taskdata['task_title'] = $this->input->post('task_title');
			 $taskdata['task_description'] = $this->input->post('task_description');
			 $taskdata['task_start_date'] = date("Y-m-d",strtotime($this->input->post('task_start_date')));
			 $taskdata['task_end_date'] = date("Y-m-d",strtotime($this->input->post('task_end_date')));
			 $taskdata['task_status'] = $this->input->post('task_status');
			 $taskdata['task_user_type'] = $login_type;
			 $taskdata['task_user_id'] = $user_id;
			 $taskdata['task_modified_date'] =  date('Y-m-d H:i:s');
			 
			 $this->load->model('task_model');
			 
			 $res = $this->task_model->update_task($taskdata,$tid);
			 
			 if($res){
				 
				  $this->session->set_flashdata('msg', 'add_true');
				  $this->session->set_flashdata('task_title', $this->input->post('task_title'));
				  redirect(base_url().'index.php?'.$login_type.'/tasks', 'refresh');
			 }
			 }
			 
			 
			 
		 }
		 function taskdelete($tid){
			 
			  if ($this->session->userdata('admin_login') != 1)

             redirect('login', 'refresh');
			 
			 $login_type = $this->session->userdata('login_type');
             $user_id = $this->session->userdata($login_type . '_id');
			 $this->load->model('task_model');
			 
			 
			 $res = $this->task_model->delete_task($tid);
			 
			 if($res){
				 
				  $this->session->set_flashdata('msg', 'del_true');
				  $this->session->set_flashdata('task_title', $this->input->post('task_title'));
				  redirect(base_url().'index.php?'.$login_type.'/tasks', 'refresh');
			 }
		 }

    /*     * **MANAGE SUBJECTS**** */

    function subject($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['class_id'] = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('subject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['class_id'] = $this->input->post('class_id');
            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->where('subject_id', $param2);
            $this->db->update('subject', $data);
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                        'subject_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }
        $page_data['subjects'] = $this->db->get('subject')->result_array();
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = get_phrase('manage_subject');
        $this->load->view('index', $page_data);
    }
	
		  /*     * **MANAGE ACADEMIC YEAR**** */

    function academicyear($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['session_name'] = $this->input->post('sessionname');           
            $this->db->insert('academicyear', $data);
            redirect(base_url() . 'index.php?admin/academicyear/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['session_name'] = $this->input->post('sessionname');           
            $this->db->where('academic_id', $param2);
            $this->db->update('academicyear', $data);
            redirect(base_url() . 'index.php?admin/academicyear/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('academicyear', array(
                        'subject_id' => $param2
                    ))->result_array();
        }
        /*if ($param1 == 'delete') {
            $this->db->where('subject_id', $param2);
            $this->db->delete('subject');
            redirect(base_url() . 'index.php?admin/subject/', 'refresh');
        }*/
        $page_data['academicyears'] = $this->db->get('academicyear')->result_array();
        $page_data['page_name'] = 'academicyear';
        $page_data['page_title'] = get_phrase('manage_academicyear');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE CLASSES**** */

    function classes($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
			//$data['standard_id'] = $this->input->post('standard_id');
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
        if ($param1 == 'do_update') {
			//$data['standard_id'] = $this->input->post('standard_id');
            $data['name'] = $this->input->post('name');
            $data['name_numeric'] = $this->input->post('name_numeric');
            $data['teacher_id'] = $this->input->post('teacher_id');

            $this->db->where('class_id', $param2);
            $this->db->update('class', $data);
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class', array(
                        'class_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_id', $param2);
            $this->db->delete('class');
            redirect(base_url() . 'index.php?admin/classes/', 'refresh');
        }
		
		
		$this->db->select('*');
		$this->db->from('class');
        $page_data['classes'] = $this->db->get()->result_array();
        $page_data['page_name'] = 'class';
        $page_data['page_title'] = get_phrase('manage_class');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE EXAMS**** */

    function exam($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['date'] = $this->input->post('date');
			$data['grand_total'] = $this->input->post('grand_total');
			$data['pass_mark'] = $this->input->post('pass_mark');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        if ($param1 == 'do_update') {
			
			
			
            $data['name'] = $this->input->post('name');
            $data['date'] = $this->input->post('date');
			$data['grand_total'] = $this->input->post('grand_total');
			$data['pass_mark'] = $this->input->post('pass_mark');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('exam_id', $param2);
            $this->db->update('exam', $data);
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('exam', array(
                        'exam_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('exam_id', $param2);
            $this->db->delete('exam');
            redirect(base_url() . 'index.php?admin/exam/', 'refresh');
        }
        $page_data['exams'] = $this->db->get('exam')->result_array();
        $page_data['page_name'] = 'exam';
        $page_data['page_title'] = get_phrase('manage_exam');
        $this->load->view('index', $page_data);
    }

    /*     * **MANAGE EXAM MARKS**** */

    function marks($exam_id = '', $class_id = '', $subject_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
			
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
             redirect(base_url() . 'index.php?admin/marks/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marks/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            //echo "<pre>";print_r($_POST);exit;
            foreach($_POST['mark_obtained'] as $key =>  $mark)
            {
                $data['mark_obtained'] = $mark;
                $data['comment'] = $_POST['comment'][$key];            

                $this->db->where('mark_id', $_POST['mark_id'][$key]);
                $this->db->update('mark', $data);
            }  
             $this->session->set_flashdata('flash_message', get_phrase('marks_updated'));            
            redirect(base_url() . 'index.php?admin/marks/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['subject_id'] = $subject_id;
		
		
			$this->db->select('grand_total');
			$this->db->where('exam_id',$exam_id);
			$res = $this->db->get_where('exam');
			
			$emgm = $res->row_array();
			extract($emgm);
			$page_data['grand_total'] = $grand_total;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name'] = 'marks';
        $page_data['page_title'] = get_phrase('manage_exam_marks');
        $this->load->view('index', $page_data);
    }
	
	
	/*     * **VIEW EXAM MARKS**** */

    function marksview($exam_id = '', $class_id = '', $subject_id = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {
            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');
			
            if ($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 && $page_data['subject_id'] > 0) {
             redirect(base_url() . 'index.php?admin/marksview/' . $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            } else if($page_data['exam_id'] > 0 && $page_data['class_id'] > 0 ){
				 redirect(base_url() . 'index.php?admin/marksview/' . $page_data['exam_id'] . '/' . $page_data['class_id'] , 'refresh');
			}else {
                $this->session->set_flashdata('mark_message', 'Choose exam, class and subject');
                redirect(base_url() . 'index.php?admin/marksview/', 'refresh');
            }
        }
        if ($this->input->post('operation') == 'update') {
            //echo "<pre>";print_r($_POST);exit;
            foreach($_POST['mark_obtained'] as $key =>  $mark)
            {
                $data['mark_obtained'] = $mark;
                $data['comment'] = $_POST['comment'][$key];            

                $this->db->where('mark_id', $_POST['mark_id'][$key]);
                $this->db->update('mark', $data);
            }  
             $this->session->set_flashdata('flash_message', get_phrase('marks_updated'));            
            redirect(base_url() . 'index.php?admin/marksview/' . $this->input->post('exam_id') . '/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');
        }
        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['subject_id'] = $subject_id;
		
		
			$this->db->select('grand_total');
			$this->db->where('exam_id',$exam_id);
			$res = $this->db->get_where('exam');
			
			$emgm = $res->row_array();
			extract($emgm);
			$page_data['grand_total'] = $grand_total;

        $page_data['page_info'] = 'Exam marks';

        $page_data['page_name'] = 'marksview';
        $page_data['page_title'] = get_phrase('view_exam_marks');
        $this->load->view('index', $page_data);
    }
	
	
	
    /*     * **MANAGE GRADES**** */

    function grade($param1 = '', $param2 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from'] = $this->input->post('mark_from');
            $data['mark_upto'] = $this->input->post('mark_upto');
            $data['comment'] = $this->input->post('comment');
            $this->db->insert('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['grade_point'] = $this->input->post('grade_point');
            $data['mark_from'] = $this->input->post('mark_from');
            $data['mark_upto'] = $this->input->post('mark_upto');
            $data['comment'] = $this->input->post('comment');

            $this->db->where('grade_id', $param2);
            $this->db->update('grade', $data);
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('grade', array(
                        'grade_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('grade_id', $param2);
            $this->db->delete('grade');
            redirect(base_url() . 'index.php?admin/grade/', 'refresh');
        }
        $page_data['grades'] = $this->db->get('grade')->result_array();
        $page_data['page_name'] = 'grade';
        $page_data['page_title'] = get_phrase('manage_grade');
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGING CLASS ROUTINE***************** */

    function class_routine($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class_id'] = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_start_min'] = $this->input->post('time_start_min');
            $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['time_end_min'] = $this->input->post('time_end_min');
            $data['day'] = $this->input->post('day');
            $this->db->insert('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class_id'] = $this->input->post('class_id');
            $data['subject_id'] = $this->input->post('subject_id');
            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));
            $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));
            $data['day'] = $this->input->post('day');

            $this->db->where('class_routine_id', $param2);
            $this->db->update('class_routine', $data);
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('class_routine', array(
                        'class_routine_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('class_routine_id', $param2);
            $this->db->delete('class_routine');
            redirect(base_url() . 'index.php?admin/class_routine/', 'refresh');
        }
        $page_data['page_name'] = 'class_routine';
        $page_data['page_title'] = get_phrase('manage_class_routine');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE BILLING / INVOICES WITH STATUS**** */

    function invoice($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['student_id'] = $this->input->post('student_id');
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['amount'] = $this->input->post('amount');
            $data['status'] = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->insert('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['student_id'] = $this->input->post('student_id');
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['amount'] = $this->input->post('amount');
            $data['status'] = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                        'invoice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            redirect(base_url() . 'index.php?admin/invoice', 'refresh');
        }
        $page_data['page_name'] = 'invoice';
        $page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ********MANAGE LIBRARY / BOOKS******************* */

    function book($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price'] = $this->input->post('price');
            $data['author'] = $this->input->post('author');
            $data['class_id'] = $this->input->post('class_id');
            $data['status'] = $this->input->post('status');
			$data['books_category_id'] = $this->input->post('books_category_id');
			$data['no_of_copies'] = $this->input->post('no_of_copies');
            $this->db->insert('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['price'] = $this->input->post('price');
            $data['author'] = $this->input->post('author');
            $data['class_id'] = $this->input->post('class_id');
            $data['status'] = $this->input->post('status');
			$data['books_category_id'] = $this->input->post('books_category_id');
			$data['no_of_copies'] = $this->input->post('no_of_copies');
            $this->db->where('book_id', $param2);
            $this->db->update('book', $data);
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('book', array(
                        'book_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('book_id', $param2);
            $this->db->delete('book');
            redirect(base_url() . 'index.php?admin/book', 'refresh');
        }
        $page_data['books'] = $this->db->get('book')->result_array();
        $page_data['page_name'] = 'book';
        $page_data['page_title'] = get_phrase('manage_library_books');
        $this->load->view('index', $page_data);
    }


	
    /****MANAGE BOOKS CATEGORY*****/
    function book_cat($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['books_category_name']       = $this->input->post('catname');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('books_category', $data);
            redirect(base_url() . 'index.php?admin/book_cat/', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['books_category_name']       = $this->input->post('catname');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            
            $this->db->where('books_category_id', $param2);
            $this->db->update('books_category', $data);
            redirect(base_url() . 'index.php?admin/book_cat/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('books_category_id', $param2);
            $this->db->delete('books_category');
            redirect(base_url() . 'index.php?admin/book_cat/', 'refresh');
        }
        $page_data['books_cat']   = $this->db->get('books_category')->result_array();
        $page_data['page_name']  = 'bookcat';
        $page_data['page_title'] = get_phrase('manage_books_category');
        $this->load->view('index', $page_data);
    }
	
	
	
	
	/*     * ********MANAGE BOOKISSUE******************* */

    function bookissue() {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
			
			$this->db->select('book_id,name');
			$this->db->where('status','available');
			$query = $this->db->get_where('book');
			
			$page_data['avlbooks'] = $query->result();
       
        $page_data['books'] = $this->db->get('book')->result_array();
        $page_data['page_name'] = 'bookissue';
        $page_data['page_title'] = get_phrase('Issue Books');
        $this->load->view('index', $page_data);
    }
	function getbookinfo(){
		$bookid = $this->input->post('bkid');
		
		$this->db->where('book_id',$bookid);
		$query = $this->db->get_where('book');
		$bookdata = $query->row_array();
		extract($bookdata);
		
		echo '<div class="control-group"><label class="control-label">'.get_phrase('author').'</label><div class="controls"><input type="text" class="" name="author" value="'.$author.'" disabled /></div></div><div class="control-group"><label class="control-label">'.get_phrase('description').'</label><div class="controls"><input type="text" class="" name="description" value="'.$description.'"/></div></div>';
	}
	function getuserinfo(){
		$usertype = $this->input->post('utype');
		$this->db->order_by('name');
		$query = $this->db->get_where($usertype);
		
		$userdata = $query->result();
		
		$udata = '';
		
		$udata .='<option value="">--- Select User ---</option>';
		
		foreach($userdata as $userdata_view){
			$udata .='<option value="'.$userdata_view->$usertype.'"_id">'.$userdata_view->name.'</option>';
			
		}
		echo $udata;
	}

    /*     * ********MANAGE TRANSPORT / VEHICLES / ROUTES******************* */

    function transport($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['route_name'] = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
			$data['start_point'] = $this->input->post('start_point');
			$data['start_time'] = $this->input->post('start_time');
			$data['seating_capacity'] = $this->input->post('seating_capacity');
            //$data['description'] = $this->input->post('description');
            //$data['route_fare'] = $this->input->post('route_fare');
			$data['driver_name'] = $this->input->post('driver_name');
			$data['driver_phone_no'] = $this->input->post('driver_phone_no');
			$data['driver_address'] = $this->input->post('driver_address');
            $this->db->insert('transport', $data);
            redirect(base_url() . 'index.php?admin/transport/'.$this->session->userdata('academic_year'), 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['route_name'] = $this->input->post('route_name');
            $data['number_of_vehicle'] = $this->input->post('number_of_vehicle');
			$data['start_point'] = $this->input->post('start_point');
			$data['start_time'] = $this->input->post('start_time');
			$data['seating_capacity'] = $this->input->post('seating_capacity');
            //$data['description'] = $this->input->post('description');
            //$data['route_fare'] = $this->input->post('route_fare');
			$data['driver_name'] = $this->input->post('driver_name');
			$data['driver_phone_no'] = $this->input->post('driver_phone_no');
			$data['driver_address'] = $this->input->post('driver_address');
            $this->db->where('transport_id', $param2);
            $this->db->update('transport', $data);
            redirect(base_url() . 'index.php?admin/transport/'.$this->session->userdata('academic_year'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('transport', array(
                        'transport_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('transport_id', $param2);
            $this->db->delete('transport');
            redirect(base_url() . 'index.php?admin/transport/'.$this->session->userdata('academic_year'), 'refresh');
        }
		if($param1 == 'add_pickups'){
			//print_r($_POST);
			$count_val = count($_POST['pickuppoint']);
			$rid = $param2;
			for($i=0;$i< $count_val ; $i++){
				
				$data['ppoint'] = $_POST['pickuppoint'][$i];
				$data['plmark'] = $_POST['pickuplmark'][$i];
				$data['ptime'] = $_POST['pickuptime'][$i];
				$data['prid'] = $rid;
				
				$this->db->insert('transport_points',$data);
				redirect(base_url() . 'index.php?admin/transport/'.$this->session->userdata('academic_year'), 'refresh');
			}
			
		}
		if ($param1 == 'assign_student') {
			
			$data['transport_id'] = $this->input->post('route_id');
            $data['ppoint_id'] = $this->input->post('pa_id');
			
			$p_student_id = $this->input->post('p_student_id');
			
			foreach($p_student_id as $ps_id ){
				//echo $ds_id;
				$this->db->where('student_id', $ps_id);
           		 $this->db->update('student', $data);
				
			}
            
            
            redirect(base_url() . 'index.php?admin/transport/'.$this->session->userdata('academic_year'), 'refresh');
        }
		//echo $param1;		
		$this->session->set_userdata('academic_year',$param1);
        $page_data['transports'] = $this->db->get('transport')->result_array();
        $page_data['page_name'] = 'transport';
        $page_data['page_title'] = get_phrase('manage_transport');
        $this->load->view('index', $page_data);
    }
	
	function del_tpoint(){
		
		$pid = $this->input->post('pid_val');
		
		if($pid!=''){
			
			$this->db->where('pid',$pid);
			
			$res = $this->db->delete('transport_points');
			
			if($res){
				
				echo "true";
			}
			else{
				echo "false";
			}
		}
		
	}
	function getpoints(){
		
		$rid = $this->input->post('route_id');
		
		$this->db->where('prid',$rid);
		$query = $this->db->get_where('transport_points');
		
		$pdata = $query->result();
		
		$respdata = '<option value="">---- select pickup point ----</option>';
		
		foreach($pdata as $pdata_view){
			
			
			$respdata .= '<option value="'.$pdata_view->pid.'">'.$pdata_view->ppoint.'</option>';
			
		}
		
		echo $respdata;
	}
	
	function ppnt_stn_data(){
		
		$this->load->model('fee_model');
			
			$p_cid = $this->input->post('get_p_cid');
			
			$p_roll_data = $this->fee_model->getrolls($p_cid);
			
			$apnddata .='';
			
			foreach($p_roll_data as $p_roll_data_view){
				
				$apnddata .='<label class="checkbox inline"><input type="checkbox" id="p_student_id_'.$p_roll_data_view->student_id.'" name="p_student_id[]" value="'.$p_roll_data_view->student_id.'">'.$p_roll_data_view->name.'-'.$p_roll_data_view->roll.'</label>';
				
			}
			
		echo $apnddata;

		
		
	}
	
	function get_route_data(){
		
		$route_id = $this->input->post('route_id');
		
		$this->db->select('student.*,transport_points.*');
		$this->db->from('student');
		$this->db->join('transport_points','pid=ppoint_id');
		$this->db->where('student_academicyear_id',$this->session->userdata('academic_year'));
		$this->db->where('transport_id',$route_id);
		
		$query = $this->db->get();
		
		$page_data['rdata'] = $query->result();
		
		$this->load->view('route_data', $page_data);
		
	}
    /*     * ********MANAGE DORMITORY / HOSTELS / ROOMS ******************* */

    function dormitory($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
            $data['name'] = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description'] = $this->input->post('description');
            $this->db->insert('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'create_room') {
            $data['name'] = $this->input->post('name');
            $data['dormitory_id'] = $this->input->post('dormitory_id');
			$data['max_students'] = $this->input->post('max_students');
            $data['description'] = $this->input->post('description');
            $this->db->insert('room', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'assign_student') {
			
			$data['dormitory_id'] = $this->input->post('dormitory_id');
            $data['dormitory_room_number'] = $this->input->post('dormitory_room_number');
			
			$dty_student_id = $this->input->post('dty_student_id');
			
			foreach($dty_student_id as $ds_id ){
				//echo $ds_id;
				$this->db->where('student_id', $ds_id);
           		 $this->db->update('student', $data);
				
			}
            
            
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }

        if ($param1 == 'do_update') {
            $data['name'] = $this->input->post('name');
            $data['number_of_room'] = $this->input->post('number_of_room');
            $data['description'] = $this->input->post('description');

            $this->db->where('dormitory_id', $param2);
            $this->db->update('dormitory', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('dormitory', array(
                        'dormitory_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'do_room_update') {
            $data['name'] = $this->input->post('name');
            $data['dormitory_id'] = $this->input->post('dormitory_id');
			$data['max_students'] = $this->input->post('max_students');
            $data['description'] = $this->input->post('description');

            $this->db->where('room_id', $param2);
            $this->db->update('room', $data);
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        } else if ($param1 == 'edit_room') {
            $page_data['edit_data'] = $this->db->get_where('room', array(
                        'room_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('dormitory_id', $param2);
            $this->db->delete('dormitory');
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        if ($param1 == 'delete_room') {
            $this->db->where('room_id', $param2);
            $this->db->delete('room');
            redirect(base_url() . 'index.php?admin/dormitory', 'refresh');
        }
        $page_data['dormitories'] = $this->db->get('dormitory')->result_array();
        $page_data['rooms']       = $this->db->get('room')->result_array();

        $page_data['page_name'] = 'dormitory';
        $page_data['page_title'] = get_phrase('manage_dormitory');
        $this->load->view('index', $page_data);
    }
	
	function dor_stn_data(){
		
		$this->load->model('fee_model');			
			$dty_cid = $this->input->post('get_der_cid');
			$dty_cid2 = $this->input->post('get_der_rid');
			//echo $dty_cid2."working";
			$dty_roll_data2 = $this->fee_model->getdnumber($dty_cid2);
			
			$dty_roll_data = $this->fee_model->getrolls2($dty_cid);
			//print_r($dty_roll_data);
			$apnddata .='';
			foreach($dty_roll_data2 as $mydorms)
				$apnddata .='<input type="hidden" value="'.$mydorms->max_students.'" id="max_students12" />';
			$j=0;
			foreach($dty_roll_data as $dty_roll_data_view){
				
				$apnddata .='<label class="checkbox inline"><input type="checkbox" id="dty_student_id_'.$j.'" name="dty_student_id[]" value="'.$dty_roll_data_view->student_id.'">'.$dty_roll_data_view->name.'-'.$dty_roll_data_view->roll.'</label>';								
				$j++;
			}
			$apnddata .='<input type="hidden" value="'.$j.'" id="check_size" />';
			
		echo $apnddata;

		
		
	}
	function dryname_chk(){
		$dname_val = trim($this->input->post('chkdnameval'));
		$prv_dname_val = trim($this->input->post('chkprvdnameval'));
		
		$this->db->where('name',$dname_val);
		$this->db->where('name !=',$prv_dname_val);
		$res = $this->db->count_all_results('dormitory');
		
		if($res > 0){
				echo "true";
			} else {
				echo "false";
			}
	}
	function dryname_chk_class(){
		$dname_val = trim($this->input->post('chkdnameval'));
		$prv_dname_val = trim($this->input->post('chkprvdnameval'));
		
		$this->db->where('name',$dname_val);
		$this->db->where('name !=',$prv_dname_val);
		$res = $this->db->count_all_results('class');
		
		if($res > 0){
				echo "true";
			} else {
				echo "false";
			}
	}
	function rmname_chk(){
		$rname_val = trim($this->input->post('chkrnameval'));
		$prv_rname_val = trim($this->input->post('chkprvrnameval'));
		$d_id = trim($this->input->post('chkdid'));
		
		$this->db->where('name',$rname_val);
		$this->db->where('name !=',$prv_rname_val);
		$this->db->where('dormitory_id',$d_id);
		$res = $this->db->count_all_results('room');
		
		if($res > 0){
				echo "true";
			} else {
				echo "false";
			}
	}

    /*     * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

    function noticeboard($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('noticeboard', $data);
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('noticeboard', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('noticeboard', array(
                        'notice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('noticeboard');
            redirect(base_url() . 'index.php?admin/noticeboard/', 'refresh');
        }
        $page_data['page_name'] = 'noticeboard';
        $page_data['page_title'] = get_phrase('manage_noticeboard');
        $page_data['notices'] = $this->db->get('noticeboard')->result_array();
        $this->load->view('index', $page_data);
    }
	
	/*     * *MANAGE EVENT / NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD* */

    function classnoticeboard($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($param1 == 'create') {
			$data['notice_class'] = $this->input->post('notice_class');
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->insert('classnotice', $data);
            redirect(base_url() . 'index.php?admin/classnoticeboard/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['notice_title'] = $this->input->post('notice_title');
            $data['notice'] = $this->input->post('notice');
            $data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
            $this->db->where('notice_id', $param2);
            $this->db->update('classnotice', $data);
            $this->session->set_flashdata('flash_message', get_phrase('notice_updated'));
            redirect(base_url() . 'index.php?admin/classnoticeboard/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('classnotice', array(
                        'notice_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('notice_id', $param2);
            $this->db->delete('classnotice');
            redirect(base_url() . 'index.php?admin/classnoticeboard/', 'refresh');
        }
        $page_data['page_name'] = 'classnoticeboard';
        $page_data['page_title'] = get_phrase('manage_class_noticeboard');
        $page_data['notices'] = $this->db->get('classnotice')->result_array();
		$page_data['classes'] = $this->db->get('class')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***SITE/SYSTEM SETTINGS******** */

    function system_settings($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param2 == 'do_update') {
            $this->db->where('type', $param1);
            $this->db->update('settings', array(
                'description' => $this->input->post('description')
            ));
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = get_phrase('system_settings');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***LANGUAGE SETTINGS******** */

    function manage_language($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
        if ($param1 == 'update_phrase') {
            $language = $param2;
            $total_phrase = $this->input->post('total_phrase');
            for ($i = 1; $i < $total_phrase; $i++) {
                //$data[$language]	=	$this->input->post('phrase').$i;
                $this->db->where('phrase_id', $i);
                $this->db->update('language', array($language => $this->input->post('phrase' . $i)));
            }
            redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/' . $language, 'refresh');
        }
        if ($param1 == 'do_update') {
            $language = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);

            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));
            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('flash_message', get_phrase('settings_updated'));

            redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
        }
        $page_data['page_name'] = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        //$page_data['language_phrases'] = $this->db->get('language')->result_array();
        $this->load->view('index', $page_data);
    }

    /*     * ***BACKUP / RESTORE / DELETE DATA PAGE********* */

    function backup_restore($operation = '', $type = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($operation == 'create') {
            $this->crud_model->create_backup($type);
        }
        if ($operation == 'restore') {
            $this->crud_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }
        if ($operation == 'delete') {
            $this->crud_model->truncate($type);
            $this->session->set_flashdata('backup_message', 'Data removed');
            redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
        }

        $page_data['page_info'] = 'Create backup / restore from backup';
        $page_data['page_name'] = 'backup_restore';
        $page_data['page_title'] = get_phrase('manage_backup_restore');
        $this->load->view('index', $page_data);
    }

    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */

    function manage_profile($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($param1 == 'update_profile_info') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', $data);
            $this->session->set_flashdata('flash_message', get_phrase('account_updated'));
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $data['password'] = $this->input->post('password');
            $data['new_password'] = $this->input->post('new_password');
            $data['confirm_new_password'] = $this->input->post('confirm_new_password');

            $current_password = $this->db->get_where('admin', array(
                        'admin_id' => $this->session->userdata('admin_id')
                    ))->row()->password;
            if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
                $this->db->where('admin_id', $this->session->userdata('admin_id'));
                $this->db->update('admin', array(
                    'password' => $data['new_password']
                ));
                $this->session->set_flashdata('flash_message', get_phrase('password_updated'));
            } else {
                $this->session->set_flashdata('flash_message', get_phrase('password_mismatch'));
            }
            redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
        }
        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data'] = $this->db->get_where('admin', array(
                    'admin_id' => $this->session->userdata('admin_id')
                ))->result_array();
        $this->load->view('index', $page_data);
    }

    function excel_import_data($file_name, $file_type, $class_id) {
        // error_reporting(E_ERROR | E_WARNING | E_PARSE);
        $this->load->library('excel');
        $file_name = $file_name;
        $file_type = $file_type;
        $class_id = $class_id;
        
        $file_path = FILE_PATH . $file_name;
        if (!$file_name || !is_file($file_path)) {
            $data['status'] = 0;
            $data['message'] = 'Please Upload the file once Again';
            $this->session->set_flashdata('invalid', 'File is not in proper format');
        }
        $url = array();
        $meta_data = array();
        $first_row = array('name', 'birthday', 'sex','religion','blood_group','address','phone','email','password','father_name','mother_name','class_id','roll','transport_id','dormitory_id','dormitory_room_number','parent_password','parent_email');
        $col_index = 18;
        $data = array();
        if ($file_type == 'xls' || $file_type == 'xlsx' || $file_type == '.xls' || $file_type == '.xlsx')
            $reader = 'Excel2007';
        elseif ($file_type == 'csv' || $file_type == 'text/plain' || $file_type == '.csv')
            $reader = 'CSV';
        else {
            $data['status'] = 0;
            $data['message'] = 'Please Upload the valid file format';
            @unlink($file_path);
            $this->session->set_flashdata('invalid', 'File is not in proper format');
        }
        $this->excel->load($file_path, $reader);
        $workSheet = $this->excel->setActiveSheetIndex(0);
        $worksheetTitle = $workSheet->getTitle();
        $highestRow = $workSheet->getHighestRow(); // e.g. 10
        $highestColumn = $workSheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $nrColumns = ord($highestColumn) - 64;
        for ($row = 1; $row <= $highestRow; $row++) {
            if ($row == 1) {
                for ($col = 0; $col < $col_index; ++$col) {
                    $cell = $workSheet->getCellByColumnAndRow($col, $row);
                    $val = $cell->getValue();
                    if ($val != $first_row[$col]) {
                        $data['status'] = 0;
                        $data['message'] = 'File is not in proper format';
                        @unlink($file_path);
                        $this->session->set_flashdata('invalid', 'File is not in proper format');
                    }
                }
            }
        }
        for ($row = 1; $row <= $highestRow; ++$row) {

            $data[$row] = array();
            for ($col = 0; $col < $col_index; ++$col) {
                $cell = $workSheet->getCellByColumnAndRow($col, $row);
                $val = $cell->getValue();
                $data[$row][$first_row[$col]] = $val;
                if ($first_row[$col] == 'Keyword Destination URL' && $val && $val != 'Keyword Destination URL') {
                    if ($key = array_search($val, $url)) {
                        $data[$row]['Meta Keywords'] = $meta_data[$key]['meta_keywords'];
                        $data[$row]['Meta Description'] = $meta_data[$key]['meta_description'];
                        $data[$row]['Page Status'] = $meta_data[$key]['page_status'];
                    } else {
                        $meta_val = $this->get_content_one($val);
                        $page_status = $this->define_status($val);
                        $data[$row]['Meta Keywords'] = ($meta_val['keywords']) ? $meta_val['keywords'] : '';
                        $data[$row]['Meta Description'] = ($meta_val['description']) ? $meta_val['description'] : '';
                        $data[$row]['Page Status'] = ($page_status) ? $page_status : 'Extra Page';
                        $meta_data[$val] = array('meta_keywords' => ($meta_val['keywords']) ? $meta_val['keywords'] : '',
                            'meta_description' => ($meta_val['description']) ? $meta_val['description'] : '',
                            'page_status' => ($page_status) ? $page_status : 'Extra Page'
                        );
                    }
                    if (!in_array($val, $url))
                        $url[$val] = $val;
                }
                $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            }
            if($row != 1){
				$this->db->insert('student', $data[$row]);
            }
            $data['status'] = 1;
            $data['message'] = 'Data has been inserted';
            @unlink($file_path);
            $this->session->set_flashdata('invalid', 'Student Data has been inserted');
        }
        redirect(base_url() . 'index.php?admin/student/' . $class_id . '/upload', 'refresh');
    }

    public function read() {
        $config['upload_path'] = './template/file/';
        $class_id = $this->input->post('class_id');
        $config['allowed_types'] = '*';
        $this->upload->initialize($config);
        $allowedExts = array("xls", "xlsx", ".xls", ".xlsx", "csv");
        $temp_name = $_FILES['studenfile']['tmp_name'];
        $name = $_FILES['studentfile']['name'];

        $temp = explode(".", $_FILES["studentfile"]["name"]);
        $extension = end($temp);
        if (in_array($extension, $allowedExts)) {
            if ($_FILES["studentfile"]["error"] > 0) {
                $data['msg'] = $this->upload->display_errors();
                $data['sign'] = 'error_box';
                $this->session->set_userdata($data);
                $this->session->set_flashdata('invalid', 'please upload only excel or csv type file.');
            } else {
                if (!$this->upload->do_upload('studentfile')) {
                    $data['status'] = 'failure';
                    $data['message'] = $this->upload->display_errors('', '');
                } else {
                    $data['status'] = 'success';
                    $data['upload_data'] = $this->upload->data();
                    $this->excel_import_data($data['upload_data']['file_name'],$extension,$class_id);
                }
            }
        } else {
            $data['msg'] = "Invalid file type.Try to upload a valid file.";
            $data['sign'] = 'error_box';
            $this->session->set_userdata($data);
            $this->session->set_flashdata('invalid', 'please upload only excel or csv type file.');
        }

        redirect(base_url() . 'index.php?admin/student/' . $class_id . '/upload', 'refresh');
    }

    function details() {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        $page_data['page_name'] = 'upload';
        $page_data['page_title'] = get_phrase('Student_Details');
        $this->load->view('index', $page_data);
    }
	function attendenceview($class_id = '') {
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		 if ($this->input->post('operation') == 'selection') {
			 $class_id = $this->input->post('class_id');
			  
			  $this->db->select('attendence.*,student.name as sname,student.roll as rno,workingdays.total_days as tdays');
			  $this->db->from('attendence,student,workingdays');
			  $this->db->where('attendence.class_id =',$class_id);
			  $this->db->where('attendence.student_id = student.student_id');
			  $this->db->where('attendence.month = workingdays.work_id');
			  $this->db->order_by('workingdays.work_id');
			  $query = $this->db->get_where();
			  $page_data['attendence_data'] = $query->result();
			  
			  	$page_data['class_id'] = $class_id;
				$page_data['page_info'] = 'Attendence';
				$page_data['page_name'] = 'attendenceview';
				$page_data['page_title'] = get_phrase('view_attendence');
				$this->load->view('index', $page_data);
			  
		 }
		 
	}
    /*     * **MANAGE ATTENDENCE**** */

    function attendence($class_id = '', $month = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');

        if ($this->input->post('operation') == 'selection') {

            $page_data['class_id'] = $this->input->post('class_id');

            $page_data['month'] = $this->input->post('month');

            if ($page_data['class_id'] > 0 && $page_data['month'] > 0) {
                redirect(base_url() . 'index.php?admin/attendence/' . $page_data['class_id'] . '/' . $page_data['month'], 'refresh');
            } else {
                $this->session->set_flashdata('attendence_message', 'Choose class');
                redirect(base_url() . 'index.php?admin/attendence/', 'refresh');
            }
        }

        if ($this->input->post('operation') == 'update') {
            foreach($_POST['present'] as $key => $p)
            {
                $data['present'] = $p;
                $this->db->where('attendence_id', $_POST['atten_id'][$key]);
                $this->db->update('attendence', $data);
            }

            redirect(base_url() . 'index.php?admin/attendence/' . $this->input->post('class_id') . '/' . $this->input->post('month'), 'refresh');
        }

        if ($this->input->post('working') == 'days') {
            $data['total_days'] = $this->input->post('totaldays');
            $this->db->where('work_id', $this->input->post('month'));
            $this->db->update('workingdays', $data);
            redirect(base_url() . 'index.php?admin/attendence/' . $this->input->post('class_id') . '/' . $this->input->post('month'), 'refresh');
        }
        $page_data['class_id'] = $class_id;
        $page_data['month'] = $month;
        $page_data['page_info'] = 'Attendence';
        $page_data['page_name'] = 'attendence';
        $page_data['page_title'] = get_phrase('manage_attendence');
        $this->load->view('index', $page_data);
    }

    function email($param1 = '', $param2 = '',$param3 =''){
        if ($this->session->userdata('admin_login') != 1){
            redirect('login', 'refresh');
        }
        $page_data['class_id'] = $param1;
        $page_data['page_name'] = 'email';
        $page_data['page_title'] = get_phrase('manage_email');
        $this->load->view('index', $page_data);
    }
    function email_view($param1 = '', $param2 = '',$param3 ='') {
        
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if($param2 == 'send'){
           
            $ac_type  = $param1;
            $email_subject = $this->input->post('email_recepients1');
            $email_body = $this->input->post('send_email_body');
            if($ac_type =='student'){
                  $results = $this->db->get('student')->result_array();
                  foreach($results as $result){
                     if(!empty($result['email'])){
                        $student_email[] = $result['email'];
                        $student_id[] = $result['student_id'];
                     }
                  }
                  $student_to = implode(',',$student_email);
                  $student_read = implode(',',$student_id);
                  $data = array();
                  $data['unread'] = $student_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'student';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  
                  $this->db->insert('email', $data);
                  $this->email_model->send_email('student', $student_to,$email_subject,$email_body);
                  
            }
            else if($ac_type =='teacher'){
                  $results = $this->db->get('teacher')->result_array();
                  foreach($results as $result){
                        if(!empty($result['email'])){
                            $teacher_email[] = $result['email'];
                            $teacher_id[] = $result['teacher_id'];
                        }
                   }
                  $teacher_read = implode(',',$teacher_id);
                  $data = array();
                  $data['unread'] = $teacher_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'teacher';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  $this->db->insert('email', $data);
                  
                  $teacher_to = implode(',',$teacher_email);
                  $this->email_model->send_email('teacher', $teacher_to,$email_subject,$email_body);
            }
            else if($ac_type =='parent'){
                  $result = $this->db->get('student')->result_array();
                 
                  foreach($result as $result){
                    
                      if(!empty($result['parent_email'])){
                            $parent_email[] = $result['parent_email'];
                            $parent_id[] = $result['student_id'];
                        }
                        }
                   if(!empty($parent_id)){
                        $parent_read = implode(',',$parent_id);
                   }
                  $data = array();
                  $data['unread'] = $parent_read;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'parent';
                  $data['subject'] = $email_subject;
                  $data['body'] = $email_body;
                  $this->db->insert('email', $data);
                  }
                  $parent_to = implode(',',$parent_email);
                  $this->email_model->send_email('parent', $parent_to,$email_subject,$email_body);
            }
        
        $result = $this->db->get_where('class', array('class_id' => $param1))->row();
        $page_data['ac_type']  = $param1;
        $page_data['class_name']    = $result->name;
        $page_data['page_name']     = 'email_view';
        $page_data['page_title']    = get_phrase('email_view');
        $this->load->view('index', $page_data);
    }





	/***this code added on 01-08-2014 by KP*****/
	
	
	 /****MANAGE FEES CATEGORY*****/
    function fees_cat($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['fees_category_name']       = $this->input->post('feescatname');
			$data['fees_category_prefix']       = $this->input->post('feescatprefix');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('fees_category', $data);
			
			$feestablename=str_replace(" ", "_", trim($data['fees_category_name']));
			$querystring="CREATE TABLE IF NOT EXISTS $feestablename (
						  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
						   `class_id` int(11) NOT NULL,
						  `student_id` int(11) NOT NULL,
						  `amount` int(11) NOT NULL,
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  PRIMARY KEY (`rec_id`)
						) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			$this->db->query ( $querystring );				
            redirect(base_url() . 'index.php?admin/fees_cat/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['fees_category_name']       = $this->input->post('feescatname');
			 $data['fees_category_prefix']       = $this->input->post('feescatprefix');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            
            $this->db->where('fees_category_id', $param2);
            $this->db->update('fees_category', $data);
			$feestablename=str_replace(" ", "_", trim($data['fees_category_name']));
			$querystring="CREATE TABLE IF NOT EXISTS $feestablename (
						  `rec_id` int(11) NOT NULL AUTO_INCREMENT,
						  `class_id` int(11) NOT NULL,
						  `student_id` int(11) NOT NULL,
						  `amount` int(11) NOT NULL,
						  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
						  PRIMARY KEY (`rec_id`)
						) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			$this->db->query ( $querystring );
            redirect(base_url() . 'index.php?admin/fees_cat/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
        	
			$fee_category_tbales = $this->db->get_where('fees_category', array(
                'fees_category_id' => $param2
            ))->result_array();
			
			
			foreach ($fee_category_tbales as $fee_category_tbale) {
				$fee_category_tbale_result=$fee_category_tbale['fees_category_name'];
				
				
				$fee_category_tbale_result=str_replace(" ", "_", $fee_category_tbale_result);
				$this->db->query ("DROP TABLE $fee_category_tbale_result");
			}
			
			$this->db->where('fee_category', $param2);
            $this->db->delete('class_wise_fees');
			
			
            $this->db->where('fees_category_id', $param2);
            $this->db->delete('fees_category');
            redirect(base_url() . 'index.php?admin/fees_cat/', 'refresh');
        }
        $page_data['fees_cat']   = $this->db->get('fees_category')->result_array();
        $page_data['page_name']  = 'feescat';
        $page_data['page_title'] = get_phrase('manage_fees_category');
        $this->load->view('index', $page_data);
    }




	 /****MANAGE CLASS WISE FEES CATEGORY*****/
    function class_wise_fees($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['class']       = $this->input->post('classname');
			$data['fee_category']       = $this->input->post('fee_category_name');
			$data['fee_amount']       = $this->input->post('fee_amount_name');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            $this->db->insert('class_wise_fees', $data);
			
            //redirect(base_url() . 'index.php?admin/class_wise_fees/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['class']       = $this->input->post('classname');
			 $data['fee_category']       = $this->input->post('fee_category_name');
			 $data['fee_amount']       = $this->input->post('fee_amount_name');
            //$data['class_id']   = $this->input->post('class_id');
            //$data['teacher_id'] = $this->input->post('teacher_id');
            
            $this->db->where('fee_amount_id', $param2);
            $this->db->update('class_wise_fees', $data);
            //redirect(base_url() . 'index.php?admin/fees_cat/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('subject', array(
                'subject_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('fee_amount_id', $param2);
            $this->db->delete('class_wise_fees');
            //redirect(base_url() . 'index.php?admin/class_wise_fees/', 'refresh');
        }
        $page_data['class_wise_fees']   = $this->db->get('class_wise_fees')->result_array();
        $page_data['page_name']  = 'class_wise_fees';
        $page_data['page_title'] = get_phrase('manage_calss_wise_fees_category');
        $this->load->view('index', $page_data);
    }




	/****MANAGE STUDENT FEES CATEGORY*****/
    function manage_student_fees($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        
        $page_data['class_id']   = $param1;
        $page_data['students']   = $this->db->get_where('student', array(
            'class_id' => $param1
        ))->result_array();
        $page_data['page_name']  = 'manage_fees';
        $page_data['page_title'] = get_phrase('manage_fees');
        $this->load->view('index', $page_data);
    }

	/****MANAGE STUDENT FEES CATEGORY*****/
    function save_student_fees()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        
        	$data['class_id']       = $this->input->post('class_id');
			$data['student_id']       = $this->input->post('student_id');
			$data['amount']       = $this->input->post('amount');
          	
			$tbalename=str_replace(" ", "_", $this->input->post('feetype'));
            $this->db->insert($tbalename, $data);
        
    }
	
	
	
	function daily_attendence($class_id,$addate){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		if( (isset($class_id) && $class_id!='') && (isset($addate) && $addate!='')  ){
			
			$page_data['class_id'] = $class_id;
            $page_data['daily_attendence_date'] = $addate;
			$msdate = date("Y-m-d",strtotime($addate));
			
				$this->db->select('student.roll sroll,student.name as sname,daily_attendence.*');
				$this->db->from('student,daily_attendence');
				$this->db->where('student.class_id',$class_id);
				$this->db->where('daily_attendence.class_id = student.class_id');
				$this->db->where('daily_attendence.student_id = student.student_id');
				$this->db->where('daily_attendence.present_date',$msdate);
				$adquery = $this->db->get_where();
				$addata = $adquery->result();
				$page_data['ad_data'] = $addata;
			
		}
		
		
		
		
		$page_data['page_info'] = 'Daily Attendence';
        $page_data['page_name'] = 'daily_attendence';
        $page_data['page_title'] = get_phrase('manage_daily_attendence');
        $this->load->view('index', $page_data);
		
	}
	
	function daily_attendence_reason(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$class_id = $this->input->post('class_id'); 
		$addate = $this->input->post('daily_attendence_date');
		if( (isset($class_id) && $class_id!='') && (isset($addate) && $addate!='')  ){
		$page_data['class_id'] = $class_id;
            $page_data['daily_attendence_date'] = $addate;
			$msdate = date("Y-m-d",strtotime($addate));
			
				$this->db->select('student.roll sroll,student.name as sname,daily_attendence.*');
				$this->db->from('student,daily_attendence');
				$this->db->where('student.class_id',$class_id);
				$this->db->where('daily_attendence.class_id = student.class_id');
				$this->db->where('daily_attendence.student_id = student.student_id');
				$this->db->where('daily_attendence.present_date',$msdate);
				$adquery = $this->db->get_where();
				$addata = $adquery->result();
				$page_data['ad_data'] = $addata;
				$page_data['page_info'] = 'daily attendence view';
        $page_data['page_name'] = 'daily_attendence_view';
        $page_data['page_title'] = get_phrase('daily_attendence_view');
        $this->load->view('index', $page_data);
		}
		
		
	}
	function daily_attn_count(){
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
		$smsclassid = $this->input->post('smscid');
		$smsdate = date("Y-m-d",strtotime($this->input->post('smsdt')));
		
		$this->db->where('present_date',$smsdate);
		$this->db->where('present_flag','A');
		$this->db->where('class_id',$smsclassid);
		$daily_atten_count = $this->db->count_all_results('daily_attendence');
		
		if($daily_atten_count > 0){
			echo "true";
		} else {
			echo "false";
		}
		
	}
	function sendsmsabsenties(){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
			
		$smsclassid = $this->input->post('smscid');
		$smsdate = date("Y-m-d",strtotime($this->input->post('smsdt')));
		
		
		$this->db->select('student.name as sname,student.parent_phone1 as pphone');
		$this->db->from('daily_attendence,student');
		$this->db->where('daily_attendence.present_date',$smsdate);
		$this->db->where('daily_attendence.present_flag','A');
		$this->db->where('daily_attendence.class_id',$smsclassid);
		$this->db->where('student.student_id = daily_attendence.student_id');
		$query =  $this->db->get_where();
		$smsdata = $query->result();
		foreach($smsdata as $smsdata_view){
			 $sid = $smsdata_view->sname;
			 
			 $to = $smsdata_view->pphone;
			 
			 $msg = "Your children ".$sid." absent school today (".$smsdate.") please inform the reason";
			 
			 $res = send_tam_sms($to,$msg);
		}
		
	}
	
	function daily_attn_update(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$adid = $this->input->post('adiid');
		
		$addata['present_flag'] = $this->input->post('adttype');
		
		$this->db->where('daily_attendence_id',$adid);
		
		$res = $this->db->update('daily_attendence',$addata);
		
		if($res){
			echo "true";
		} else {
			echo "false";
		}
		
	}
	
	function daily_attendence_view(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$operation = $this->input->post('operation');
		
		if(isset($operation) && $operation == 'selection'){
			
			 $class_id = $this->input->post('class_id');
		
		    $attendence_date = $this->input->post('daily_attendence_date');
			
			if ($class_id > 0 && $attendence_date != '') {
				
				
				$msdate = date("Y-m-d",strtotime($attendence_date));
				
				
				$this->db->where('class_id',$class_id);
				$this->db->where('present_date',$msdate);
				$daily_atten_count = $this->db->count_all_results('daily_attendence');
				
				if($daily_atten_count == 0){
					$this->db->select('student_id');
					$this->db->where('class_id',$class_id);
					$query = $this->db->get_where('student');
					$adata = $query->result();
					foreach($adata as $adata_inc){
						$dadata['student_id'] = $adata_inc->student_id;
						$dadata['class_id'] = $class_id;
						$dadata['present_flag'] = "P";
						$dadata['present_date'] = $msdate;
						$this->db->insert('daily_attendence',$dadata);
					}
					
					
				}
				
				/*$this->db->where('class_id',$class_id);
				$this->db->where('present_date',$msdate);
				$adquery = $this->db->get_where('daily_attendence');
				$addata = $query->result();
				$page_data['ad_data'] = $addata ;*/
				
				
				
				redirect(base_url() . 'index.php?admin/daily_attendence/'.$class_id.'/'.$msdate, 'refresh');
				
                
            } else {
                $this->session->set_flashdata('attendence_message', 'Choose class');
                redirect(base_url() . 'index.php?admin/daily_attendence/', 'refresh');
            }
			
		}
	}
// E-Books Customization

 function ebookscat($param1 = '', $param2 = ''){
	
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['ebooks_category_name']       = $this->input->post('ebook_catname');

            $this->db->insert('ebooks_cat', $data);
            redirect(base_url() . 'index.php?admin/ebookscat/', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['ebooks_category_name']       = $this->input->post('ebook_catname');
            
            $this->db->where('ebooks_category_id', $param2);
            $this->db->update('ebooks_cat', $data);
            redirect(base_url() . 'index.php?admin/ebookscat/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('ebooks_category_name', array(
                'ebooks_category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('ebooks_category_id', $param2);
            $this->db->delete('ebooks_cat');
            redirect(base_url() . 'index.php?admin/ebookscat/', 'refresh');
        }
        $page_data['ebooks_cat']   = $this->db->get('ebooks_cat')->result_array();
        $page_data['page_name']  = 'ebookscat';
        $page_data['page_title'] = get_phrase('manage_ebooks_category');
        $this->load->view('index', $page_data);
}
	

     function ebooks($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
       		$i=0;
			    foreach($_FILES as $key=>$val){
				$datas['ebook_file'] = $val['name'];
				 foreach($datas['ebook_file'] as $key=>$image){
				   $data['ebooks_name'] = $this->input->post('ebooks_name'); // $_FILES['image']['name'][$i]
			       $data['ebooks_category_id'] = $this->input->post('ebooks_category_id');
				   $name       = $image;
  				   $tmp_name   = $_FILES['ebook_file']['tmp_name'][$key];
				   $data['ebooks_url']=$image;
				   $this->db->insert('ebooks', $data);
				    $ebook_id = mysql_insert_id();
 				 if (move_uploaded_file($tmp_name, 'uploads/ebook_image/' . $ebook_id . '.jpg')) {
    				}
				if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], 'uploads/ebook_image/' . $ebook_id . '.pdf')) {
    			}
			 }
  				
			}
			redirect(base_url() . 'index.php?admin/ebooks');
	    }
        if ($param1 == 'do_update') {
            $data['ebooks_name'] = $this->input->post('ebooks_name');
			$data['ebooks_category_id'] = $this->input->post('ebooks_category_id');
            $this->db->where('ebooks_id', $param2);
            $this->db->update('ebooks', $data);

            move_uploaded_file($_FILES['ebook_file']['tmp_name'], 'uploads/ebook_image/' . $param2 . '.jpg');
            $this->crud_model->clear_cache();
			
            redirect(base_url() . 'index.php?admin/ebooks', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('ebooks', array(
                        'ebooks_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('ebooks_id', $param2);
            $this->db->delete('ebooks');
            redirect(base_url() . 'index.php?admin/ebooks', 'refresh');
        }
        $page_data['ebooks'] = $this->db->get('ebooks')->result_array();
        $page_data['page_name'] = 'ebooks';
        $page_data['page_title'] = get_phrase('manage_ebooks');
        $this->load->view('index', $page_data);
    }
	
	/**************************************************************************
				Previous Question Papers
	***************************************************************************/
	function previousquestionpapers($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
        if ($param1 == 'create') {
			//print_r($_POST);
       		$i=0;
			    foreach($_FILES as $key=>$val){
				$datas['book_file'] = $val['name'];
					 foreach($datas['book_file'] as $key=>$image){
					   $data['title']     = $this->input->post('title');
					   $data['subject']   = $this->input->post('subject');
					   $data['classname'] = $this->input->post('classname');
					   $name       = $image;
					   $tmp_name   = $_FILES['book_file']['tmp_name'][$key];
					   $data['book_file']=$image;
					   $path = "uploads/ebook_image/".time()."_".$name;
					   //print_r($data);
					   $this->db->insert('previousquestionpapers', $data);
						$ebook_id = mysql_insert_id();
					 if (move_uploaded_file($tmp_name, $path)) {
						}
					 if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], 'uploads/ebook_image/' . $ebook_id . '.pdf')) {
					 }
				 }
  				
			}
			//exit;
			redirect(base_url() . 'index.php?admin/previousquestionpapers');
	    }
        if ($param1 == 'do_update') {
            $data['ebooks_name'] 		= $this->input->post('ebooks_name');
			$data['ebooks_category_id'] = $this->input->post('ebooks_category_id');
            $this->db->where('ebooks_id', $param2);
            $this->db->update('ebooks', $data);

            move_uploaded_file($_FILES['ebook_file']['tmp_name'], 'uploads/ebook_image/' . $param2 . '.jpg');
            $this->crud_model->clear_cache();
			
            redirect(base_url() . 'index.php?admin/previousquestionpapers', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('ebooks', array(
                        'ebooks_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('paperid', $param2);
            $this->db->delete('previousquestionpapers');
            redirect(base_url() . 'index.php?admin/previousquestionpapers', 'refresh');
        }
        $page_data['ebooks'] = $this->db->get('previousquestionpapers')->result_array();
        $page_data['page_name'] = 'previousquestionpapers';
        $page_data['page_title'] = get_phrase('Previous Question Papers');
        $this->load->view('admin/previousquestionpaper', $page_data);
    }
	/************************************************************
			Edit Previous Question Papers
	************************************************************/
	function editpaper() {
		ini_set("display_errors","1");
		if(!empty($_POST)){
			//echo "<pre>";print_r($_POST);
			$data['title']     = $this->input->post('title');
			$data['subject']   = $this->input->post('subject');
			$data['classname'] = $this->input->post('classname');
			$data['book_file'] = $_FILES['book_file']['name'];
			$name   		   = $_FILES['book_file']['name'];
			$tmp_name   	   = $_FILES['book_file']['tmp_name'];
			$path 			   = "uploads/ebook_image/".time()."_".$name;
			//$ebook_id = mysql_insert_id();
			if (move_uploaded_file($tmp_name, $path)) {
    				}
			$s = $this->db->update('previousquestionpapers', $data, array('paperid' =>$_POST['id']));
            //move_uploaded_file($_FILES['ebook_file']['tmp_name'], 'uploads/ebook_image/' . $param2 . '.jpg');
			if($s){
					//redirect(base_url() . 'index.php?admin/ebooks', 'refresh');
					redirect(base_url() . 'index.php?admin/previousquestionpapers');
				}
		}
		$page_data['result'] = $this->db->get_where('previousquestionpapers', array('paperid'=>$this->uri->segment(3)))->result();
		$page_data['page_name'] = 'previous_question_papers';
        $page_data['page_title'] = get_phrase('previous_question_papers_edit');//print_r($page_data);//exit;
		$this->load->view('admin/editpreviouspapers', $page_data);
	}
	
	/**************************************************************************
				Previous Question Papers
	***************************************************************************/
	function onlinetest($param1 = '', $param2 = '', $param3 = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
         if ($param1 == 'create') {
            $data['classname'] = $this->input->post('classname');
            $data['subject']   = $this->input->post('subject');
			$data['question']  = $this->input->post('question');
			$data['option1']   = $this->input->post('option1');
			$data['option2']   = $this->input->post('option2');
			$data['option3']   = $this->input->post('option3');
			$data['option4']   = $this->input->post('option4');
			$data['ans']   	   = $this->input->post('ans');
            $data['createdby'] = date('Y-m-d H:i:s');
			$data['updatedby'] = date('Y-m-d H:i:s');
			//echo "<pre>";print_r($_POST);exit;
            $this->db->insert('onlinetest', $data);
            //redirect(base_url() . 'index.php?admin/onlinetest/', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data['ebooks_name'] = $this->input->post('ebooks_name');
			$data['ebooks_category_id'] = $this->input->post('ebooks_category_id');
            $this->db->where('onlinetest_id', $param2);
            $this->db->update('onlinetest', $data);

           // move_uploaded_file($_FILES['ebook_file']['tmp_name'], 'uploads/ebook_image/' . $param2 . '.jpg');
            //$this->crud_model->clear_cache();
			
            redirect(base_url() . 'index.php?admin/onlinetest', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('onlinetest', array(
                        'onlinetest_id' => $param2
                    ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('onlinetest_id', $param2);
            $this->db->delete('onlinetest');
            redirect(base_url() . 'index.php?admin/onlinetest', 'refresh');
        }
        $page_data['onlinetest'] = $this->db->get('onlinetest')->result_array();
        $page_data['page_name'] = 'onlinetest';
        $page_data['page_title'] = get_phrase('Online Test');
        $this->load->view('admin/onlinetests', $page_data);
    }
	
	function onlinetestedit() {
		ini_set("display_errors","1");
		if(!empty($_POST)){
			//echo "<pre>";print_r($_POST);
			$data['classname'] = $this->input->post('classname');
            $data['subject']   = $this->input->post('subject');
			$data['question']  = $this->input->post('question');
			$data['option1']   = $this->input->post('option1');
			$data['option2']   = $this->input->post('option2');
			$data['option3']   = $this->input->post('option3');
			$data['option4']   = $this->input->post('option4');
			$data['ans']   	   = $this->input->post('ans');
            //$data['createdby'] = date('Y-m-d H:i:s');
			$data['updatedby'] = date('Y-m-d H:i:s');
			//$ebook_id = mysql_insert_id();
			$s = $this->db->update('onlinetest', $data, array('onlinetest_id' =>$_POST['id']));
            //move_uploaded_file($_FILES['ebook_file']['tmp_name'], 'uploads/ebook_image/' . $param2 . '.jpg');
			if($s){
					//redirect(base_url() . 'index.php?admin/ebooks', 'refresh');
					redirect(base_url() . 'index.php?admin/onlinetest');
				}
		}
		$page_data['result'] = $this->db->get_where('onlinetest', array('onlinetest_id'=>$this->uri->segment(3)))->result();
		$page_data['page_name'] = 'online_test_edit';
        $page_data['page_title'] = get_phrase('online_test_edit');//print_r($page_data);//exit;
		$this->load->view('admin/onlinetestedit', $page_data);
	}
	
	/****MANAGE EMPLOYEE CATEGORY*****/
    function employee_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['employee_category_name'] = $this->input->post('employee_category_name');
            $data['employee_category_status']   = $this->input->post('employee_category_status');
            $data['employee_category_added_date'] = date('Y-m-d H:i:s');
			$data['employee_category_modified_date'] = date('Y-m-d H:i:s');
            $this->db->insert('employee_categories', $data);
            redirect(base_url() . 'index.php?admin/employee_category/', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['employee_category_name'] = $this->input->post('employee_category_name');
            $data['employee_category_status']   = $this->input->post('employee_category_status');
			$data['employee_category_modified_date'] = date('Y-m-d H:i:s');
            
            $this->db->where('employee_category_id', $param2);
            $this->db->update('employee_categories', $data);
            redirect(base_url() . 'index.php?admin/employee_category/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('employee_categories', array(
                'employee_category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('employee_category_id', $param2);
            $this->db->delete('employee_categories');
            redirect(base_url() . 'index.php?admin/employee_category/', 'refresh');
        }
        $page_data['employee_categories']   = $this->db->get('employee_categories')->result_array();
        $page_data['page_name']  = 'employee_category';
        $page_data['page_title'] = get_phrase('employee_categories');
        $this->load->view('index', $page_data);
    }
	
	/****MANAGE DEPARTMENTS*****/
    function departments($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['department_name'] = $this->input->post('department_name');
            $data['department_status']   = $this->input->post('department_status');
            $data['department_added_date'] = date('Y-m-d H:i:s');
			$data['department_modified_date'] = date('Y-m-d H:i:s');
            $this->db->insert('departments', $data);
            redirect(base_url() . 'index.php?admin/departments/', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['department_name'] = $this->input->post('department_name');
            $data['department_status']   = $this->input->post('department_status');
			$data['department_modified_date'] = date('Y-m-d H:i:s');
            
            $this->db->where('department_id', $param2);
            $this->db->update('departments', $data);
            redirect(base_url() . 'index.php?admin/departments/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('departments', array(
                'department_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('department_id', $param2);
            $this->db->delete('departments');
            redirect(base_url() . 'index.php?admin/departments/', 'refresh');
        }
        $page_data['departments']   = $this->db->get('departments')->result_array();
        $page_data['page_name']  = 'departments';
        $page_data['page_title'] = get_phrase('manage_departments');
        $this->load->view('index', $page_data);
    }
	
	
	 /*     * **MANAGE STAFF ATTENDENCE**** */

	//Daily Attendance for staff
	function daily_staffattendence($class_id,$addate=NULL) {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		if( (isset($class_id) && $class_id!='') && (isset($addate) && $addate!='')  ){
			
			$page_data['class_id'] = $class_id;			
            $page_data['daily_attendence_date'] = $addate;
			$msdate = date("Y-m-d",strtotime($addate));
				if($class_id=="teaching")
				{
				$this->db->select('teacher.name sname,daily_staffattendence.*');
				$this->db->from('teacher,daily_staffattendence');
				$this->db->where('daily_staffattendence.staff_type',$class_id);
				$this->db->where('teacher.teacher_id = daily_staffattendence.staff_id');				
				}
				if($class_id=="nonteaching")
				{
				$this->db->select('staff_data.name sname,daily_staffattendence.*');
				$this->db->from('staff_data,daily_staffattendence');
				$this->db->where('daily_staffattendence.staff_type',$class_id);
				$this->db->where('staff_data.staff_id = daily_staffattendence.staff_id');								
				}
				$this->db->where('daily_staffattendence.present_date',$msdate);
				$adquery = $this->db->get_where();
				$addata = $adquery->result();
				$page_data['ad_data'] = $addata;
		}
		

		$page_data['page_info'] = 'Daily Attendence';
        $page_data['page_name'] = 'daily_staff_attendence';
        $page_data['page_title'] = get_phrase('manage_daily_staffattendence');
        $this->load->view('index', $page_data);
			
    }
	
	function daily_staff_attendence_view(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$operation = $this->input->post('operation');		
		if(isset($operation) && $operation == 'selection'){
			
			$class_id = $this->input->post('class_id');
		    $attendence_date = $this->input->post('daily_attendence_date');			
			if ($class_id !=''  && $attendence_date != '') {
				$msdate = date("Y-m-d",strtotime($attendence_date));
		
					$this->db->where('staff_type',$class_id);
					$this->db->where('present_date',$msdate);
					$daily_atten_count = $this->db->count_all_results('daily_staffattendence');									
				if($daily_atten_count == 0){
								
					$this->db->select('*');
					if($class_id=="teaching"){
					$this->db->from('teacher');
					}
					if($class_id=="nonteaching"){
					$this->db->from('staff_data');
					}
					$query =  $this->db->get_where();
					$adata = $query->result();										
							
					foreach($adata as $adata_inc){
						if($class_id=="teaching")
							$dadata['staff_id'] = $adata_inc->teacher_id;
						if($class_id=="nonteaching")
							$dadata['staff_id'] = $adata_inc->staff_id;
						$dadata['staff_type'] = $class_id;
						$dadata['present_flag'] = "P";
						$dadata['present_date'] = $msdate;					
						$this->db->insert('daily_staffattendence',$dadata);
					}
					
					
				}
				
				/*$this->db->where('class_id',$class_id);
				$this->db->where('present_date',$msdate);
				$adquery = $this->db->get_where('daily_attendence');
				$addata = $query->result();
				$page_data['ad_data'] = $addata ;*/
				
				
				
				redirect(base_url() . 'index.php?admin/daily_staffattendence/'.$class_id.'/'.$msdate, 'refresh');
				
                
            } else {
                $this->session->set_flashdata('attendence_message', 'Choose class');
                redirect(base_url() . 'index.php?admin/daily_staffattendence/', 'refresh');
            }
			
		}
	}
	
	//Daily Attendance reason view
	function daily_staffattendence_reason(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$class_id = $this->input->post('class_id'); 
		$addate = $this->input->post('daily_attendence_date');
		if( (isset($class_id) && $class_id!='') && (isset($addate) && $addate!='')  ){
		$page_data['class_id'] = $class_id;
            $page_data['daily_attendence_date'] = $addate;
			$msdate = date("Y-m-d",strtotime($addate));
			
				if($class_id=="teaching")
				{
				$this->db->select('teacher.name sname,daily_staffattendence.*');
				$this->db->from('teacher,daily_staffattendence');
				$this->db->where('daily_staffattendence.staff_type',$class_id);
				$this->db->where('teacher.teacher_id = daily_staffattendence.staff_id');				
				}
				if($class_id=="nonteaching")
				{
				$this->db->select('staff_data.name sname,daily_staffattendence.*');
				$this->db->from('staff_data,daily_staffattendence');
				$this->db->where('daily_staffattendence.staff_type',$class_id);
				$this->db->where('staff_data.staff_id = daily_staffattendence.staff_id');								
				}
				$this->db->where('daily_staffattendence.present_date',$msdate);
				$adquery = $this->db->get_where();
				$addata = $adquery->result();
				$page_data['ad_data'] = $addata;
				
				$page_data['page_info'] = 'daily staffattendence view';
        $page_data['page_name'] = 'daily_staffattendence_view';
        $page_data['page_title'] = get_phrase('daily_staff_attendence_view');
		$this->load->view('index', $page_data);
		}
		
		
	}
	function staffdaily_attn_update(){
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$adid = $this->input->post('adiid');
		
		$addata['present_flag'] = $this->input->post('adttype');
		
		$this->db->where('daily_attendence_id',$adid);
		
		$res = $this->db->update('daily_staffattendence',$addata);
		
		if($res){
			echo "true";
		} else {
			echo "false";
		}
		
	}

	
	
	
	
	//monty attandance
    function staffattendence($department_id = '', $month = '') {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		
        if ($this->input->post('operation') == 'selection') {
		
            $page_data['department_id'] = $this->input->post('department_id');
            $page_data['month'] = $this->input->post('month');
			
            if ($page_data['department_id'] > 0 && $page_data['month'] > 0) {
                redirect(base_url() . 'index.php?admin/staffattendence/' . $page_data['department_id'] . '/' . $page_data['month'], 'refresh');
            } else {
                $this->session->set_flashdata('attendence_message', 'Choose class');
                redirect(base_url() . 'index.php?admin/staffattendence/', 'refresh');
            }
        }

        if ($this->input->post('operation') == 'update') {
            foreach($_POST['present'] as $key => $p)
            {
                $data['present'] = $p;
                $this->db->where('attendence_id', $_POST['atten_id'][$key]);
                $this->db->update('staff_attendence', $data);
            }

            redirect(base_url() . 'index.php?admin/staffattendence/' . $this->input->post('department_id') . '/' . $this->input->post('month'), 'refresh');
        }

        if ($this->input->post('working') == 'days') {
            $data['total_days'] = $this->input->post('totaldays');
            $this->db->where('work_id', $this->input->post('month'));
            $this->db->update('workingdays', $data);
            redirect(base_url() . 'index.php?admin/staffattendence/' . $this->input->post('department_id') . '/' . $this->input->post('month'), 'refresh');
        }
        $page_data['department_id'] = $department_id;
        $page_data['month'] = $month;
        $page_data['page_info'] = 'Staff Attendence';
        $page_data['page_name'] = 'staff_attendence';
        $page_data['page_title'] = get_phrase('manage_staff_attendence');
        $this->load->view('index', $page_data);
    }
	
	function staffattendenceview($department_id = '') {
		 if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		 if ($this->input->post('operation') == 'selection') {
			 $department_id = $this->input->post('department_id');
			  
			  $this->db->select('staff_attendence.*,teacher.name as tname,teacher.employee_code as ecode,workingdays.total_days as tdays');
			  $this->db->from('staff_attendence,teacher,workingdays');
			  $this->db->where('staff_attendence.department_id =',$department_id);
			  $this->db->where('staff_attendence.user_id = teacher.teacher_id');
			  $this->db->where('staff_attendence.month = workingdays.work_id');
			  $this->db->order_by('workingdays.work_id');
			  $query = $this->db->get_where();
			  $page_data['attendence_data'] = $query->result();
			  
			  	$page_data['department_id'] = $department_id;
				$page_data['page_info'] = 'Staff Attendence';
				$page_data['page_name'] = 'staffattendenceview';
				$page_data['page_title'] = get_phrase('view_staff_attendence');
				
				$this->load->view('index', $page_data);
			  
		 }

		 
	}
	
	/****MANAGE TIMETABLE CATEGORY*****/
    function timetable_category($param1 = '', $param2 = '')
    {
		$page_data['page_type'] = $this->uri->segment(3);
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		$this->load->library('fckeditor');
        if ($param1 == 'create') {
            $data['timetable_category_name'] = $this->input->post('timetable_category_name');
            $data['timetable_category_status']   = $this->input->post('timetable_category_status');
            $data['timetable_category_added_date'] = date('Y-m-d H:i:s');
			$data['timetable_category_modified_date'] = date('Y-m-d H:i:s');
            $this->db->insert('timetable_categories', $data);
            redirect(base_url() . 'index.php?admin/timetable_category/2', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['timetable_category_name'] = $this->input->post('timetable_category_name');
            $data['timetable_category_status']   = $this->input->post('timetable_category_status');
			$data['timetable_category_modified_date'] = date('Y-m-d H:i:s');
            
            $this->db->where('timetable_category_id', $param2);
            $this->db->update('timetable_categories', $data);
            redirect(base_url() . 'index.php?admin/timetable_category/2', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('timetable_categories', array(
                'timetable_category_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('timetable_category_id', $param2);
            $this->db->delete('timetable_categories');
			$data['timetable_modified_date'] = date('Y-m-d H:i:s');
			$data['timetable_delete'] = 'Y';
            $this->db->where('timetable_cid', $param2);
            $this->db->update('timetables',$data);
			
            redirect(base_url() . 'index.php?admin/timetable_category/2', 'refresh');
        }
		$this->db->select('timetables.*,timetable_categories.timetable_category_name as cname');
		$this->db->from('timetables,timetable_categories');
		$this->db->where('timetables.timetable_cid = timetable_categories.timetable_category_id');
		$this->db->where('timetable_delete','N');
		$page_data['timetable_view']   = $this->db->get()->result_array();
		$this->db->where('timetable_category_status','active');
		$page_data['timetable_categories_view']   = $this->db->get('timetable_categories')->result_array();
        $page_data['timetable_categories']   = $this->db->get('timetable_categories')->result_array();
        $page_data['page_name']  = 'timetable_category';
		if($page_data['page_type']==1)
		$page_data['page_title'] = get_phrase('timetable');
		if($page_data['page_type']==2)
        $page_data['page_title'] = get_phrase('timetable_categories');		
        $this->load->view('index', $page_data);
    }

	/****MANAGE TIMETABLE CATEGORY*****/
    function timetable($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
		if ($param1 == 'create') {
			$data['timetable_cid'] = $this->input->post('timetable_cid');
            $data['timetable_title'] = $this->input->post('timetable_title');
			$data['timetable_content'] = $this->input->post('timetable_content');
            $data['timetable_status']   = $this->input->post('timetable_status');
            $data['timetable_added_date'] = date('Y-m-d H:i:s');
			$data['timetable_modified_date'] = date('Y-m-d H:i:s');
			$data['timetable_delete'] = 'N';
            $this->db->insert('timetables', $data);
            redirect(base_url() . 'index.php?admin/timetable_category/1', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['timetable_cid'] = $this->input->post('timetable_cid');
            $data['timetable_title'] = $this->input->post('timetable_title');
			$data['timetable_content'] = $this->input->post('timetable_content');
            $data['timetable_status']   = $this->input->post('timetable_status');
			$data['timetable_modified_date'] = date('Y-m-d H:i:s');
            
            $this->db->where('timetable_id', $param2);
            $this->db->update('timetables', $data);
            redirect(base_url() . 'index.php?admin/timetable_category/1', 'refresh');
        } 
		 if ($param1 == 'delete') {
			$data['timetable_modified_date'] = date('Y-m-d H:i:s');
			$data['timetable_delete'] = 'Y';
            $this->db->where('timetable_id', $param2);
            $this->db->update('timetables',$data);
            redirect(base_url() . 'index.php?admin/timetable_category/1', 'refresh');
        }
	}
	
	/****MANAGE STANDARD*****/
    function standards($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        if ($param1 == 'create') {
            $data['standard_name'] = $this->input->post('standard_name');
            $data['standard_status']   = $this->input->post('standard_status');
            $data['standard_added_date'] = date('Y-m-d H:i:s');
			$data['standard_modified_date'] = date('Y-m-d H:i:s');
            $this->db->insert('standard', $data);
            redirect(base_url() . 'index.php?admin/standards/', 'refresh');
        }
		if ($param1 == 'do_update') {
            $data['standard_name'] = $this->input->post('standard_name');
            $data['standard_status']   = $this->input->post('standard_status');
			$data['standard_modified_date'] = date('Y-m-d H:i:s');
            
            $this->db->where('standard_id', $param2);
            $this->db->update('standard', $data);
            redirect(base_url() . 'index.php?admin/standards/', 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('standard', array(
                'standard_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'delete') {
            $this->db->where('standard_id', $param2);
            $this->db->delete('standard');
            redirect(base_url() . 'index.php?admin/standards/', 'refresh');
        }
        $page_data['standards']   = $this->db->get('standard')->result_array();
        $page_data['page_name']  = 'standards';
        $page_data['page_title'] = get_phrase('manage_standards');
        $this->load->view('index', $page_data);
    }
	
	/****MANAGE LEAVETYPES*****/
    function leavetypes()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('leave_model');
		
		$page_data['ltype_data'] = $this->leave_model->getltypes();
		
        $page_data['page_name']  = 'leave_types';
        $page_data['page_title'] = get_phrase('manage_leavetypes');
        $this->load->view('index', $page_data);
    }
	function ltypeedit($ltid)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('leave_model');
		
		$page_data['ltype_data'] = $this->leave_model->getltype($ltid);
		
        $page_data['page_name']  = 'edit_leave_types';
        $page_data['page_title'] = get_phrase('edit_leavetype');
        $this->load->view('index', $page_data);
    }
	function ltypeinsert(){
		
		$ltypedata['leave_type_title'] = trim($this->input->post('leave_type_title'));
		$ltypedata['leave_type_code'] = trim($this->input->post('leave_type_code'));
		$ltypedata['leave_type_max_days'] = $this->input->post('leave_type_max_days');
		$ltypedata['leave_type_status'] = $this->input->post('leave_type_status');
		$ltypedata['leave_type_half_allow'] = $this->input->post('half_allow_status');
		$ltypedata['leave_type_added_date'] = date('Y-m-d H:i:s');
		$ltypedata['leave_type_modified_date'] = date('Y-m-d H:i:s');
		$ltypedata['leave_type_delete'] = 'N';
		
		if($ltypedata['leave_type_title'] !=''){
			$this->load->model('leave_model');
			
			$res = $this->leave_model->insert_ltype($ltypedata);
			if($res){
				
				redirect(base_url().'index.php?admin/leavetypes','refresh');
			}
			
		}
	}
	function ltypeupdate(){
		
		$ltid = $this->input->post('hid_lt_id');
		$ltypedata['leave_type_title'] = trim($this->input->post('leave_type_title'));
		$ltypedata['leave_type_code'] = trim($this->input->post('leave_type_code'));
		$ltypedata['leave_type_max_days'] = $this->input->post('leave_type_max_days');
		$ltypedata['leave_type_status'] = $this->input->post('leave_type_status');
		$ltypedata['leave_type_half_allow'] = $this->input->post('half_allow_status');
		$ltypedata['leave_type_modified_date'] = date('Y-m-d H:i:s');
		
		if($ltid !=''){
			$this->load->model('leave_model');
			
			$res = $this->leave_model->update_ltype($ltypedata,$ltid);
			if($res){
				
				redirect(base_url().'index.php?admin/leavetypes','refresh');
			}
			
		}
	}
	function ltypedelete($ltid){
		
		if($ltid!=''){
			$ltypedata['leave_type_delete'] = 'Y';
			$ltypedata['leave_type_modified_date'] = date('Y-m-d H:i:s');
			
			$this->load->model('leave_model');
			
			$res = $this->leave_model->update_ltype($ltypedata,$ltid);
			if($res){
				
				redirect(base_url().'index.php?admin/leavetypes','refresh');
			}
			
		}
		
		
	}
	
	
	
	/****MANAGE PLACEMENTS*****/
    function placements()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('placement_model');
		
		$page_data['placement_data'] = $this->placement_model->getplacements();
		
        $page_data['page_name']  = 'placements';
        $page_data['page_title'] = get_phrase('manage_placements');
        $this->load->view('index', $page_data);
    }
	function placementedit($pslid)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('placement_model');
		
		$page_data['placement_data'] = $this->placement_model->getplacement($pslid);
		
        $page_data['page_name']  = 'edit_placements';
        $page_data['page_title'] = get_phrase('edit_placement');
        $this->load->view('index', $page_data);
    }
	function placementinsert(){
		
		$placementdata['placement_title'] = trim($this->input->post('placement_title'));
		$placementdata['placement_date'] = trim($this->input->post('placement_date'));
		$placementdata['placement_company'] = $this->input->post('placement_company');
		$placementdata['placement_description'] = $this->input->post('placement_description');
		$placementdata['placement_status'] = $this->input->post('placement_status');
		$placementdata['placement_added_date'] = date('Y-m-d H:i:s');
		$placementdata['placement_modified_date'] = date('Y-m-d H:i:s');
		$placementdata['placement_delete'] = 'N';
		
		if($placementdata['placement_title'] !=''){
			$this->load->model('placement_model');
			
			$res = $this->placement_model->insert_placement($placementdata);
			if($res){
				
				redirect(base_url().'index.php?admin/placements','refresh');
			}
			
		}
	}
	function placementupdate(){
		
		$pslid = $this->input->post('hid_psl_id');
		$placementdata['placement_title'] = trim($this->input->post('placement_title'));
		$placementdata['placement_date'] = trim($this->input->post('placement_date'));
		$placementdata['placement_company'] = $this->input->post('placement_company');
		$placementdata['placement_description'] = $this->input->post('placement_description');
		$placementdata['placement_status'] = $this->input->post('placement_status');
		$placementdata['placement_modified_date'] = date('Y-m-d H:i:s');
		
		if($pslid !=''){
			$this->load->model('placement_model');
			
			$res = $this->placement_model->update_placement($placementdata,$pslid);
			if($res){
				
				redirect(base_url().'index.php?admin/placements','refresh');
			}
			
		}
	}
	function placementdelete($pslid){
		
		if($pslid!=''){
			$placementdata['placement_modified_date'] = date('Y-m-d H:i:s');
		$placementdata['placement_delete'] = 'Y';
			
			$this->load->model('placement_model');
			
			$res = $this->placement_model->update_placement($placementdata,$pslid);
			if($res){
				
				redirect(base_url().'index.php?admin/placements','refresh');
			}
			
		}
		
		
	}
	
	
	/* ////////////////////// Fee Categories //////////////////////// */
	
	
	function feecategories(){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		$page_data['fee_cat_data'] = $this->fee_model->getfeecategories();
		
        $page_data['page_name']  = 'feecategories';
        $page_data['page_title'] = get_phrase('manage_fee_categories');
        $this->load->view('index', $page_data);
		
		
	}
	function fee_cat_insert(){
		
		
		$fcdata['fee_category'] = $this->input->post('fee_category');
		$fcdata['fc_invoice_pre_fix'] = $this->input->post('fc_invoice_pre_fix');
		$fcdata['fee_category_description'] = $this->input->post('fee_category_description');
		$fcdata['fee_category_status'] = $this->input->post('fee_category_status');
		$fcdata['fee_category_added_date'] = date('Y-m-d H:i:s');
		$fcdata['fee_category_modified_date'] = date('Y-m-d H:i:s');
		$fcdata['fee_category_delete'] = 'N';
		
		if($fcdata['fee_category'] !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->insert_feecategory($fcdata);
			if($res){
				
				redirect(base_url().'index.php?admin/feecategories','refresh');
			}
			
		}
		
	}
	function fee_cat_edit($fc_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('fee_model');
		
		$page_data['fc_data'] = $this->fee_model->getfeecategory($fc_id);
		
        $page_data['page_name']  = 'edit_fee_categories';
        $page_data['page_title'] = get_phrase('edit_fee_category');
        $this->load->view('index', $page_data);
    }
	function fee_cat_update(){
		
		$fc_id = $this->input->post('hid_fc_id');
		$fcdata['fee_category'] = $this->input->post('fee_category');
		$fcdata['fc_invoice_pre_fix'] = $this->input->post('fc_invoice_pre_fix');
		$fcdata['fee_category_description'] = $this->input->post('fee_category_description');
		$fcdata['fee_category_status'] = $this->input->post('fee_category_status');
		$fcdata['fee_category_modified_date'] = date('Y-m-d H:i:s');
		
		if($fc_id !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feecategory($fcdata,$fc_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feecategories','refresh');
			}
			
		}
	}
	function fee_cat_delete($fc_id){
		
		if($fc_id!=''){
			$fcdata['fee_category_modified_date'] = date('Y-m-d H:i:s');
		$fcdata['fee_category_delete'] = 'Y';
			
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feecategory($fcdata,$fc_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feecategories','refresh');
			}
			
		}
		
		
	}
	function fee_cat_check(){
		
		$fc_val = trim($this->input->post('chkfcval'));
		$prv_fc_val = trim($this->input->post('chkprvfcval'));
		if($fc_val){
			
			$this->load->model('fee_model');
			
		
				$res = $this->fee_model->feecategory_count($fc_val,$prv_fc_val);
			
			
			
			if($res > 0){
				echo "true";
			} else {
				echo "false";
			}
			
		}
	}
	function fee_cat_preinc_check(){
		
		$fc_inc_val = trim($this->input->post('chkfcpreincval'));
		$prv_fc_inc_val = trim($this->input->post('chkprvfcincval'));
		if($fc_inc_val){
			
			$this->load->model('fee_model');
			
		
			$res = $this->fee_model->feecategory_inc_count($fc_inc_val,$prv_fc_inc_val);
			
			
			
			if($res > 0){
				echo "true";
			} else {
				echo "false";
			}
			
		}
	}
	
	/* ////////////////////// Fee Particulars //////////////////////// */
	
	
	function feeparticulars($fc_id){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		$page_data['fc_data'] = $this->fee_model->getfeecategory($fc_id);
		
		
		$page_data['fp_data'] = $this->fee_model->getfeeparticulars();
		
        $page_data['page_name']  = 'feeparticulars';
        $page_data['page_title'] = get_phrase('manage_fee_particulars');
        $this->load->view('index', $page_data);
		
		
	}
	function fee_particular_type(){
		
		$gfp_type = $this->input->post('get_fp_type');
		
		$this->load->model('fee_model');
		
		$apnddata="";
		
		if($gfp_type == 'fp_standard'){
			
			
		
			$fp_standard_data = $this->fee_model->getstandard();
			
			$apnddata .=' 	<div class="control-group"><label class="control-label" for="fee_particular_type_id">'.get_phrase('standard').'</label>
<div class="controls"><select id="fee_particular_type_id" name="fee_particular_type_id" class="uniform"><option value="">----select standard----</option>';
			
			foreach($fp_standard_data as $fp_standard_data_view){
				
				$apnddata .='<option value="'.$fp_standard_data_view->standard_id.'">'.$fp_standard_data_view->standard_name.'</option>';
				
			}
			
			$apnddata .='</select></div></div>';
			
		} else if($gfp_type == 'fp_class'){
			
		
			$fp_class_data = $this->fee_model->getclass();
			
			$apnddata .=' 	<div class="control-group"><label class="control-label" for="fee_particular_type_id">'.get_phrase('class').'</label>
<div class="controls"><select id="fee_particular_type_id" name="fee_particular_type_id" class="uniform"><option value="">----select class----</option>';
			
			foreach($fp_class_data as $fp_class_data_view){
				
				$apnddata .='<option value="'.$fp_class_data_view->class_id.'">'.$fp_class_data_view->name.'-'.$fp_class_data_view->name_numeric.'</option>';
				
			}
			
			$apnddata .='</select></div></div>';
		} else if($gfp_type == 'fp_roll'){
			
			$fp_class_data = $this->fee_model->getclass();
			
			$apnddata .=' 	<div class="control-group"><label class="control-label" for="fee_particular_type_cid">'.get_phrase('class').'</label>
<div class="controls"><select id="fee_particular_type_cid" name="fee_particular_type_cid" class="uniform"><option value="">----select class----</option>';
			
			foreach($fp_class_data as $fp_class_data_view){
				
				$apnddata .='<option value="'.$fp_class_data_view->class_id.'">'.$fp_class_data_view->name.'-'.$fp_class_data_view->name_numeric.'</option>';
				
			}
			
			$apnddata .='</select></div></div><div id="custom-tam-fp-type-blck-roll"></div>';
		} else if($gfp_type == 'frm_class'){
			
			$fp_cid = $this->input->post('get_fp_cid');
			
			$fp_roll_data = $this->fee_model->getrolls($fp_cid);
			
			$apnddata .=' 	<div class="control-group"><label class="control-label" for="fee_particular_type_id">'.get_phrase('roll_no').'</label>
<div class="controls">';
			
			foreach($fp_roll_data as $fp_roll_data_view){
				
				$apnddata .='<label class="checkbox inline"><input type="checkbox" id="fee_particular_type_id'.$fp_roll_data_view->student_id.'" name="fee_particular_type_id[]" value="'.$fp_roll_data_view->student_id.'">'.$fp_roll_data_view->name.'-'.$fp_roll_data_view->roll.'</label>';
				
			}
			
			$apnddata .='</div></div>';
			
		}
		
		echo $apnddata;
	}
	
	function fee_particular_insert(){
		
	
		$fp_type =$this->input->post('fee_particular_type');
		
		if($fp_type == 'fp_roll'){
		$fptid_val ="";
		foreach($this->input->post("fee_particular_type_id") as $fptid){
			 $fptid_val .=",".$fptid.",";
		}
		$fee_particular_type_id =$fptid_val;
		 
		}
		else {
			$fee_particular_type_id = $this->input->post("fee_particular_type_id");
		}
		 
		$fpdata['fee_category_id'] = $this->input->post('fee_category_id');
		$fpdata['fee_particular_name'] = $this->input->post('fee_particular_name');
		$fpdata['fee_particular_description'] = $this->input->post('fee_particular_description');
		$fpdata['fee_particular_type'] = $fp_type ;
		$fpdata['fee_particular_type_id'] = $fee_particular_type_id ;
		$fpdata['fee_particular_type_cid'] = $this->input->post('fee_particular_type_cid');
		$fpdata['fee_particular_amount'] = $this->input->post('fee_particular_amount');
		$fpdata['fee_particular_discount'] = $this->input->post('fee_particular_discount');
		$fpdata['fee_particular_discount_reason'] = $this->input->post('fee_particular_discount_reason');
		$fpdata['fee_particular_status'] = $this->input->post('fee_particular_status');
		$fpdata['fee_particular_added_date'] = date('Y-m-d H:i:s');
		$fpdata['fee_particular_modified_date'] = date('Y-m-d H:i:s');
		$fpdata['fee_particular_delete'] = 'N';
		
		//print_r($fpdata);
		
		if($fpdata['fee_particular_name'] !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->insert_feeparticular($fpdata);
			if($res){
				
				redirect(base_url().'index.php?admin/feecategories','refresh');
			}
			
		}
		 
	}
	function fee_particular_delete($fp_id){
		
		if($fp_id!=''){
			$fpdata['fee_particular_modified_date'] = date('Y-m-d H:i:s');
		    $fpdata['fee_particular_delete'] = 'Y';
			
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feeparticular($fpdata,$fp_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feecategories','refresh');
			}
			
		}
	}
	function fee_particular_rolls(){
		
		$srolls = $this->input->post('srolls');
		$sclass = $this->input->post('sclass');
		
		$this->load->model('fee_model');
		
		$rdata =  $this->fee_model->getsrolls($srolls,$sclass);
		
		$rviews ="";
		
		$rviews .="<table class='table table-bordered'<tr><th>Roll No </th><th>Name </th><th>Father Name </th><tr>";
		
		foreach($rdata as $rdata_view){
			
			$rviews .='<tr><td>'.$rdata_view->roll.'</td><td>'.$rdata_view->name.'</td><td>'.$rdata_view->father_name.'</td></tr>';
			
		}
		
		$rviews .="</table>";
		
		echo $rviews;
		
	}
	function fee_particular_edit($fp_id)
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
       	$this->load->model('fee_model');
		
		$page_data['fp_data'] = $this->fee_model->getfeeparticular($fp_id);
		
		$page_data['fp_standard_data'] = $this->fee_model->getstandard();
		$page_data['fp_class_data'] = $this->fee_model->getclass();
		
        $page_data['page_name']  = 'edit_feeparticulars';
        $page_data['page_title'] = get_phrase('edit_fee_particular');
        $this->load->view('index', $page_data);
    }
	
	function fee_particular_update(){
		
		$fp_id = $this->input->post('fee_particular_id_hid');
		$fp_type =$this->input->post('fee_particular_type');
		
		if($fp_type == 'fp_roll'){
		$fptid_val ="";
		foreach($this->input->post("fee_particular_type_id") as $fptid){
			 $fptid_val .=",".$fptid.",";
		}
		$fee_particular_type_id = $fptid_val;
		 
		}
		else {
			$fee_particular_type_id = $this->input->post("fee_particular_type_id");
		}
		 
		$fpdata['fee_category_id'] = $this->input->post('fee_category_id');
		$fpdata['fee_particular_name'] = $this->input->post('fee_particular_name');
		$fpdata['fee_particular_description'] = $this->input->post('fee_particular_description');
		$fpdata['fee_particular_type'] = $fp_type ;
		$fpdata['fee_particular_type_id'] = $fee_particular_type_id ;
		$fpdata['fee_particular_type_cid'] = $this->input->post('fee_particular_type_cid');
		$fpdata['fee_particular_amount'] = $this->input->post('fee_particular_amount');
		$fpdata['fee_particular_discount'] = $this->input->post('fee_particular_discount');
		$fpdata['fee_particular_discount_reason'] = $this->input->post('fee_particular_discount_reason');
		$fpdata['fee_particular_status'] = $this->input->post('fee_particular_status');
		$fpdata['fee_particular_added_date'] = date('Y-m-d H:i:s');
		$fpdata['fee_particular_modified_date'] = date('Y-m-d H:i:s');
		$fpdata['fee_particular_delete'] = 'N';
		
		//print_r($fpdata);
		
		if($fpdata['fee_particular_name'] !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feeparticular($fpdata,$fp_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feeparticulars/'.$fpdata['fee_category_id'] ,'refresh');
			}
			
		}
		 
	}
	
	/* ////////////////////// Fee Periods //////////////////////// */
	
	
	function feeperiods(){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		$page_data['fc_data'] = $this->fee_model->getfcdata();
		
		$page_data['feeperiods'] = $this->fee_model->getfeeperiods();
		
        $page_data['page_name']  = 'feeperiods';
        $page_data['page_title'] = get_phrase('manage_fee_periods');
        $this->load->view('index', $page_data);
		
		
	}
	function fee_period_edit($fp_id){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		$page_data['fc_data'] = $this->fee_model->getfcdata();
		
		$page_data['feeperiod'] = $this->fee_model->getfeeperiod($fp_id);
		
        $page_data['page_name']  = 'edit_feeperiod';
        $page_data['page_title'] = get_phrase('edit_fee_period');
        $this->load->view('index', $page_data);
	
	}
	function fee_particulars_data(){
		
		$this->load->model('fee_model');
		
		echo $fc_id = $this->input->post('get_fc_id');
		
		$fp_data = $this->fee_model->getfpdata($fc_id);
		
		$fcvalue ='<option value="">--- select fee particular ---</option>';
		
		foreach($fp_data as $fp_data_view){
			
			$fcvalue .='<option value="'.$fp_data_view->fee_particular_id.'">'.$fp_data_view->fee_particular_name.'</option>';
		}
		
		echo $fcvalue;
	}
	
	function fee_period_insert(){
		
		
		$fcpdata['fee_period_cid'] = $this->input->post('fee_period_cid');
		$fcpdata['fee_period_pid'] = $this->input->post('fee_period_pid');
		$fcpdata['fee_period_sdate'] = $this->input->post('fee_period_sdate');
		$fcpdata['fee_period_edate'] = $this->input->post('fee_period_edate');
		$fcpdata['fee_period_ddate'] = $this->input->post('fee_period_ddate');
		$fcpdata['fee_period_added_date'] = date('Y-m-d H:i:s');
		$fcpdata['fee_period_modified_date'] = date('Y-m-d H:i:s');
		$fcpdata['fee_period_delete'] = 'N';
		
		if($fcpdata['fee_period_cid'] !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->insert_feeperiod($fcpdata);
			if($res){
				
				redirect(base_url().'index.php?admin/feeperiods','refresh');
			}
			
		}
		
	}
	function fee_period_update(){
		
		$fp_id = $this->input->post('fee_period_id_hid');
		
		$fpdata['fee_period_cid'] = $this->input->post('fee_period_cid');
		$fpdata['fee_period_pid'] = $this->input->post('fee_period_pid');
		$fpdata['fee_period_sdate'] = $this->input->post('fee_period_sdate');
		$fpdata['fee_period_edate'] = $this->input->post('fee_period_edate');
		$fpdata['fee_period_ddate'] = $this->input->post('fee_period_ddate');
		$fpdata['fee_period_modified_date'] = date('Y-m-d H:i:s');
		
		if($fpdata['fee_period_cid'] !=''){
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feeperiod($fpdata,$fp_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feeperiods','refresh');
			}
			
		}
	}
	function fee_period_delete($fp_id){
		
		if($fp_id!=''){
			$fpdata['fee_period_modified_date'] = date('Y-m-d H:i:s');
		    $fpdata['fee_period_delete'] = 'Y';
			
			$this->load->model('fee_model');
			
			$res = $this->fee_model->update_feeperiod($fpdata,$fp_id);
			if($res){
				
				redirect(base_url().'index.php?admin/feeperiods','refresh');
			}
			
		}
	}
	function fee_particular_check(){
		
		$fp_val = trim($this->input->post('chkfpval'));
		$prv_fp_val = trim($this->input->post('chk_prv_fp_val'));
		$fc_id = $this->input->post('chkfcid');
		
		$this->load->model('fee_model');
		
	    $res = $this->fee_model->chkparticular($fp_val,$fc_id,$prv_fp_val);
		
		if($res > 0){
			echo "true";
		} else{
			echo "false";
		}
		
		
	}
	
	
	/* ////////////////////// Fee Collect //////////////////////// */
	
	
	function feecollect(){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		$page_data['class_data'] = $this->fee_model->getclass();
		
        $page_data['page_name']  = 'feecollect';
        $page_data['page_title'] = get_phrase('fee_collect');
        $this->load->view('index', $page_data);
		
		
	}
	
	function fee_collect_get_student(){
		
		$fc_cid = $this->input->post('get_fcollect_cid');
		
		$this->load->model('fee_model');
			
		$fp_student_data = $this->fee_model->getrolls($fc_cid);
		
		$sdata ='<option value="">--- select student ---</option>';
		
		foreach($fp_student_data as $fp_student_data_view){
			
			$sdata .= '<option value="'.$fp_student_data_view->student_id.'">'.$fp_student_data_view->name.'</option>';
		}
		
		echo $sdata;
	}
	
	function fee_collect_get_data(){
		$fc_cid = $this->input->post('get_fcollect_cid');
		
		$fc_rollid = $this->input->post('get_fcollect_rollid');
		
		$this->load->model('fee_model');
		
		$page_data['fcollectclassdata'] = $this->fee_model->getfeeclassdata($fc_cid);
		
		$page_data['fcollectalldata'] = $this->fee_model->getfeealldata($fc_cid);
		
		$page_data['fcollectrolldata'] = $this->fee_model->getfeerolldata($fc_cid,$fc_rollid);
		
		//$page_data['fcollectstandarddata'] = $this->fee_model->getfeestandarddata($fc_cid);
		
		$page_data['class_roll_data'] = array('fc_class_id' => $fc_cid, 'fc_roll_id' => $fc_rollid);
		
		$this->load->view('feecollectdata', $page_data);
	}
	
	
	function fee_collect_process_data(){
		$this->load->model('fee_model');
		
		/*############# Random Id Generator ###############*/
	    $this->load->helper('string');
	    $rndm_str="";
		$rndm_str.=random_string('alpha',4);
		$rndm_str.="-";
		$rndm_str.=random_string('numeric',4);
		$rndm_str.="-";
		$rndm_str.=random_string('alpha',5);
		$rndm_str.="-";
		$rndm_str.=random_string('numeric',4);
		$rndm_str.="-";
		$rndm_str.=random_string('alpha',4);
	    /*############# Random Id Generator ###############*/
		
		$pay_mode = $this->input->post('process_payment_mode');
		
		if($pay_mode ==1){
			
			$fee_collect_data['fee_collection_cno'] = $this->input->post('process_payment_cheque_number');
			$fee_collect_data['fee_collection_cdate'] = $this->input->post('process_payment_cheque_date');
			$fee_collect_data['fee_collection_cbank'] = $this->input->post('process_payment_bank_name');
		}
		
		$fee_collect_data['fee_collection_id'] = $rndm_str;
		$fee_collect_data['fee_collection_class_id'] = $this->input->post('process_payment_class_id');
		$fee_collect_data['fee_collection_roll_id'] = $this->input->post('process_payment_roll_id');
		$fee_collect_data['fee_collection_particular_id'] = $this->input->post('process_payment_particular_id');
		$fee_collect_data['fee_collection_amount'] = $this->input->post('process_payment_amount');
		$fee_collect_data['fee_collection_late_charge'] = $this->input->post('process_payment_late_charge');
		$fee_collect_data['fee_collection_mode'] = $pay_mode;
		$fee_collect_data['fee_collection_remarks'] = $this->input->post('process_payment_remarks');
		
		$fee_collect_data['fee_collection_date'] = date('Y-m-d') ;
		$fee_collect_data['fee_collection_added_date'] = date('Y-m-d H:i:s');
		
		
		$login_type = $this->session->userdata('login_type');
        $user_id = $this->session->userdata($login_type.'_id');
		
		$fee_collect_data['fee_collection_added_by'] = $user_id ;
		
		$res = $this->fee_model->insert_fee_collection($fee_collect_data);
		
		if($res){
			$this->db->select('name as sname,parent_phone1 as pphone');
			$this->db->where('class_id',$fee_collect_data['fee_collection_class_id']);
			$this->db->where('student_id',$fee_collect_data['fee_collection_roll_id']);
			$query = $this->db->get_where('student');
			
			$rse = $query->row_array();
			
			extract($rse);
			
			$rse_per = $this->fee_model->getfeeparticular($fee_collect_data['fee_collection_particular_id']);
			
			extract($rse_per);
			
			 $sid = $sname;
			 
			 $to = $pphone;
			 
			 $msg = "Your payment amount - ".$fee_collect_data['fee_collection_amount']." towards '".$fee_particular_name."(".$fcategory.")"."' processed successfuly for your child '".$sid."'. on ".$fee_collect_data['fee_collection_added_date']."";
			 
			  echo   "true#";
			 
			  send_tam_sms($to,$msg);
			  
			  echo "#".$rndm_str;
			
		} else {
			
			echo   "false#";
		}
		
		
	}
	
	
   
 public function generatereceipt($receipt_id) {
	 
	 $this->load->model('fee_model');
	 
	 $receiptdata = $this->fee_model->getReceiptData($receipt_id);
	 
	 //print_r($receiptdata);
	 
	 extract($receiptdata);
	 
	 $cat_data = $this->fee_model->getfeecategory($cat_id);
	 
	 extract($cat_data);
	 
	 $gtotal = number_format(($fee_collection_amount + $fee_collection_late_charge),2);
	 
	 $this->load->library("Pdf");
	 $this->load->library("Numbertowords");
	 
	 $gwords = explode(".", ($fee_collection_amount + $fee_collection_late_charge));
	 
	 $c1 = $gwords[0]; // piece1
     $c2 = $gwords[1]; // piece2
	 $numtowrd = "";
	 $numtowrd .= $this->numbertowords->convert_number($c1)." rupees " ;
	 
	 if($c2 != 0){
		$numtowrd .= " and ".$this->numbertowords->convert_number($c2)." paisa." ; 
	 }
	 
	 $pydate = date("d-m-Y",strtotime($fee_collection_date));
	 
	 $paymode = $fee_collection_mode;
	 
	 if($paymode == 0){
		 
		 $mode_val= "Cash";
	 } if($paymode == 1){
		 $paymode == "Cheque";
	 }
	
    //============================================================+
    
 
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
 
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
   
	
	// remove default header/footer
	$pdf->setPrintHeader(false);
	$pdf->setPrintFooter(false);  
 
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
 
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
 
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
 
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
 
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
 
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
 
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
 
    // ---------------------------------------------------------    
 
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
 
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 9, '', true);   
 
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
 
    /// create some HTML content

$html = <<<EOD

<table border="1" cellspacing="0" cellpadding="4">
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		
		<th align="center">
        
        		<div style="font-weight: bold;" ><font size="15">Tam School Management</font></div>
                <div><font size="09">xxxxxxx, xxxxxxxx, xxxxxx - 500045</font></div>
        
        
        </th>
		
	</tr>
</table>
</td>
</tr>
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<th align="left">Receipt No : <span style="font-weight: bold;" >$fee_collection_receipt</span></th>
		<th align="center" style="font-weight: bold;"> FEE RECEIPT </th>
		<th align="right"> Date : <span style="font-weight: bold;" >$pydate</span> </th>
	</tr>
</table>
</td>
</tr>
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<th align="left"><span style="font-weight: bold;" >Student Name</span>: $sname</th>
		<th align="right"><span style="font-weight: bold;" > Class</span> : $cname</th>
	</tr>
</table>
</td>
</tr>


</table>
<table border="1" cellspacing="0" cellpadding="3">
	<tr style="font-weight: bold;" >
		<th align="center">Fee Category </th>
		<th align="center">Particular </th>
		<th align="center">Fee </th>
		<th align="center">Discount </th>
		<th align="center">Amount </th>
	</tr>
	<tr>
		<td>$fee_category</td>
		<td>$pname</td>
		<td align="right">&#8377; $pamount </td>
		<td align="right">&#8377; $discount </td>
		<td align="right">&#8377; $fee_collection_amount </td>
	</tr>
</table>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<td>

<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td align="left" >
		
			<table border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td align="left">
						Rupees In Word : $numtowrd
					</td>
				</tr>
				<tr>
					<td align="left">
						Mode : $mode_val
					</td>
				</tr>
				<tr>
					<td align="left">
						Remarks : $fee_collection_remarks
					</td>
				</tr>
				
				<tr>
					<td align="left">
						
					</td>
				</tr>
				
			</table>
		
		</td>
		<td align="right">
		
		
			<table border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td align="right">
						Sub-Total :  &#8377; $fee_collection_amount 
					</td>
				</tr>
				<tr>
					<td align="right">
						Late Charges :  &#8377; $fee_collection_late_charge
					</td>
				</tr>
				<tr>
					<td align="right">
						Total : &#8377; $gtotal
					</td>
				</tr>
				
				<tr>
					<td align="right">
						Received By : $aname
					</td>
				</tr>
				<tr>
					<td align="left">
						
					</td>
				</tr>
				<tr>
					<td align="right" style="color:#cdcdcd;">
						Signature
					</td>
				</tr>
			</table>
		
		
		</td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td align="center" style="color:#cdcdcd;">
			Management Copy
		</td>
	</tr>
</table>
</td>
</tr>
</table>


<br>
<br>
<br><br><br><br><br><br>
<br>
<br>


<table border="1" cellspacing="0" cellpadding="4">
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		
		<th align="center">
        
        		<div style="font-weight: bold;" ><font size="15">Tam School Management</font></div>
                <div><font size="09">xxxxxxx, xxxxxxxx, xxxxxx - 500045</font></div>
        
        
        </th>
		
	</tr>
</table>
</td>
</tr>
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<th align="left">Receipt No : <span style="font-weight: bold;" >$fee_collection_receipt</span></th>
		<th align="center" style="font-weight: bold;"> FEE RECEIPT </th>
		<th align="right"> Date : <span style="font-weight: bold;" >$pydate</span> </th>
	</tr>
</table>
</td>
</tr>
<tr>
<td>
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<th align="left"><span style="font-weight: bold;" >Student Name</span>: $sname</th>
		<th align="right"><span style="font-weight: bold;" > Class</span> : $cname</th>
	</tr>
</table>
</td>
</tr>


</table>
<table border="1" cellspacing="0" cellpadding="3">
	<tr style="font-weight: bold;" >
		<th align="center">Fee Category </th>
		<th align="center">Particular </th>
		<th align="center">Fee </th>
		<th align="center">Discount </th>
		<th align="center">Amount </th>
	</tr>
	<tr>
		<td>$fee_category</td>
		<td>$pname</td>
		<td align="right">&#8377; $pamount </td>
		<td align="right">&#8377; $discount </td>
		<td align="right">&#8377; $fee_collection_amount </td>
	</tr>
</table>

<table border="1" cellspacing="0" cellpadding="3">
<tr>
<td>

<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td align="left" >
		
			<table border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td align="left">
						Rupees In Word : $numtowrd
					</td>
				</tr>
				<tr>
					<td align="left">
						Mode : $mode_val
					</td>
				</tr>
				<tr>
					<td align="left">
						Remarks : $fee_collection_remarks
					</td>
				</tr>
				
				<tr>
					<td align="left">
						
					</td>
				</tr>
				
			</table>
		
		</td>
		<td align="right">
		
		
			<table border="0" cellspacing="0" cellpadding="4">
				<tr>
					<td align="right">
						Sub-Total :  &#8377; $fee_collection_amount 
					</td>
				</tr>
				<tr>
					<td align="right">
						Late Charges :  &#8377; $fee_collection_late_charge
					</td>
				</tr>
				<tr>
					<td align="right">
						Total : &#8377; $gtotal
					</td>
				</tr>
				
				<tr>
					<td align="right">
						Received By : $aname
					</td>
				</tr>
				<tr>
					<td align="left">
						
					</td>
				</tr>
				<tr>
					<td align="right" style="color:#cdcdcd;">
						Signature
					</td>
				</tr>
			</table>
		
		
		</td>
	</tr>
</table>

<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td align="center" style="color:#cdcdcd;">
			Customer Copy
		</td>
	</tr>
</table>
</td>
</tr>
</table>


EOD;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
 
    // ---------------------------------------------------------    
 
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    $pdf->Output($receipt_id.'.pdf', 'I');    
 
    //============================================================+
    // END OF FILE
    //============================================================+
    }


	function fee_pay_history(){
		
		$sdnt_id = $this->input->post('sid');
		$petr_id = $this->input->post('pid');
		
		 $this->load->model('fee_model');
		 
		 $payhisdata = $this->fee_model->getPayData($sdnt_id,$petr_id);
		 
		
		
		$paydata ="";
		
		$paydata .="<table class='table table-bordered'<tr><th>Receipt No </th><th> Pay Amount </th><th> Late Charge </th><th> Mode </th><th> Date </th><tr>";
		
		foreach($payhisdata as $payhisdata_view){
			
			$mode = $payhisdata_view->fee_collection_mode;
			
			if($mode == 0){
				$md_val = "Cash";
			} else if($mode == 1){
				$md_val = "Cheque";
			}
			
			$paydata .='<tr><td>'.$payhisdata_view->fee_collection_receipt.'</td><td>'.$payhisdata_view->fee_collection_amount.'</td><td>'.$payhisdata_view->fee_collection_late_charge.'</td><td>'.$md_val.'</td><td>'.date("d-m-Y",strtotime($payhisdata_view->fee_collection_date)).'</td></tr>';
			
		}
		
		$paydata .="</table>";
		
		echo $paydata;
		
		
	}
	
	
	
	function datecompare(){
		
			$date_1 = $this->input->post('startDate');
			$date_2 = $this->input->post('endDate');
			 
			if (strtotime($date_2) >= strtotime($date_1))
			{ 
				echo "true";
			}
			else
			{
				echo "false";
			}
   }
   
   
   /* ////////////////////// Fee Reporting //////////////////////// */
	
	
	function feereporting(){
		
		if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
        
      	$this->load->model('fee_model');
		
		
		
		$cid = $this->input->post('fee_report_class_id');
		
		$pid = $this->input->post('fee_report_particular');
		
		if( $cid != '' && $pid !=''){
		
		$pdata = $this->fee_model->getfeeparticular($pid);
		
		$page_data['ptr_data'] = $pdata;
		
		$page_data['sel_data'] = array('rcid'=> $cid , 'rpid'=> $pid);
		
		@extract($pdata);
		
		  $ptype = $fee_particular_type;
		  
		  if($ptype != 'fp_roll'){
			  
			  $page_data['student_data'] = $this->fee_model->getStudentReport($cid);
			  
		  } else if($ptype == 'fp_roll'){
			   $page_data['student_data'] = $this->fee_model->getStudentRollReport($fee_particular_type_id);
		  }
		}
		
		
		$page_data['class_data'] = $this->fee_model->getclass();
		
        $page_data['page_name']  = 'feereporting';
        $page_data['page_title'] = get_phrase('fee_reporting');
        $this->load->view('index', $page_data);
		
		
	}
	
	function fee_report_get_particular(){
		
		$this->load->model('fee_model');
		
		$cls_id = $this->input->post('get_report_cid');
		
		
		$reportallparticular = $this->fee_model->getAllParticular();
		
		$pdata ='<option value="">---- select perticular -----</option>';
		
		foreach($reportallparticular as $raparticulars){
			
			$pdata .= '<option value="'.$raparticulars->fee_particular_id.'">'.$raparticulars->fee_particular_name.'</option>';
		}
		
		$reportclassparticular = $this->fee_model->getClassParticular($cls_id);
		
		foreach($reportclassparticular as $rcparticulars){
			
			$pdata .= '<option value="'.$rcparticulars->fee_particular_id.'">'.$rcparticulars->fee_particular_name.'</option>';
		}
		
		$reportrollparticular = $this->fee_model->getRollParticular($cls_id);
		
		foreach($reportrollparticular as $rrparticulars){
			
			$pdata .= '<option value="'.$rrparticulars->fee_particular_id.'">'.$rrparticulars->fee_particular_name.'</option>';
		}
		
		/*$reportstandparticular = $this->fee_model->getStndParticular($cls_id);
		
		foreach($reportstandparticular as $rsparticulars){
			
			$pdata .= '<option value="'.$rsparticulars->fee_particular_id.'">'.$rsparticulars->fee_particular_name.'</option>';
		}*/
		
		echo $pdata;
	}
	function send_sms_unpaid_mem(){
		
		$data1 = $this->input->post('smem'); 
		$pname = $this->input->post('hid_pname');
		$pddate = $this->input->post('hid_pddate'); 
		foreach( $data1 as $key => $value){
          
		  
		 	 $this->db->select('name as sname,parent_phone1 as pphone');
			$this->db->where('student_id',$value);
			$query = $this->db->get_where('student');
			
			$rse = $query->row_array();
			
			extract($rse);
			
			
			
			 $sid = $sname;
			 
			 $to = $pphone;
			 
			 $msg = "Please payment amount for ".$pname."  on or before due date ".$pddate." for your child ".$sid."";
			 
			 
			 
			  send_tam_sms($to,$msg);
		  
		  
			}
	}
		
		
		 /*****************************************Calendar function***************************************************/
	function calendar($param1="" ,$param2="", $param3=""){
              if ($this->session->userdata('admin_login') != 1)
            redirect(base_url(), 'refresh');
              
                           
              
              if($param1=="calendar"){
        
			$page_data['page_title'] = get_phrase('view_student');

        $this->load->view('index', $page_data);
             
 
              $this->load->model('calendar_model');
              
              
              
	  if($param2){ $year = $param2; } else { $year = date('Y'); }

	  if($param3){ $month = $param3; } else { $month = date('m'); }

	 

	   if ($day = $this->input->post('day')) {
             

		   if(!$this->input->post('data')) {

			   $this->calendar_model->deleteEvent("$year-$month-$day");

		   } else {

			$this->calendar_model->add_calendar_data("$year-$month-$day", $this->input->post('data'));

		   }

		}

	   

	   $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
           

	    $data['success_message'] = $this->session->flashdata('success_message');	

		

		$config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));

		$config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));



		$config['template'] = '



   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="max-width: 100%;
height: 80%;">{/table_open}

			

			{heading_row_start}<tr>{/heading_row_start}

			

			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}

			{heading_title_cell}<th colspan="{colspan}" id="month_year">{heading}</th>{/heading_title_cell}

			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			

			{heading_row_end}</tr>{/heading_row_end}

			

			{week_row_start}<tr>{/week_row_start}

			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}

			{week_row_end}</tr>{/week_row_end}
                        



			

			{cal_row_start}<tr class="days">{/cal_row_start}

			{cal_cell_start}<td class="day">{/cal_cell_start}

			

			{cal_cell_content}

				<div class="day_num">{day}</div>

				<div class="content">{content}</div>

			{/cal_cell_content}

			{cal_cell_content_today}

				<div class="day_num highlight">{day}</div>

				<div class="content">{content}</div>

			{/cal_cell_content_today}

			

			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}

			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

			

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			

			{cal_cell_end}</td>{/cal_cell_end}

			{cal_row_end}</tr>{/cal_row_end}

			

			{table_close}</table>{/table_close}

';



		

		$this->load->library('month_cal', $config);

	

		

	   $cal_data = $this->calendar_model->get_calendar_data($year, $month);

	   $data['calender'] = $this->month_cal->generate($year, $month, $cal_data);

	   

      $meta['page_title'] = $this->lang->line("calendar");

	  $data['page_title'] = $this->lang->line("calendar");

      //$this->load->view('commons/header', $meta);

      $this->load->view('admin/calendar', $data);

     // $this->load->view('commons/footer');

 
        
          
              }
        
        /**********************************************************************************************/
            
        }
		
		/***MANAGE LEAVE **/

    function leavemanagement($param1 = '', $param2 = '', $param3 = '')

    {

        if ($this->session->userdata('admin_login') != 1)

            redirect(base_url(), 'refresh');

       

        if ($param1 == 'create') {

            $data['leave_tid']     = $this->input->post('leave_type');
			
			$data['leave_aid']     = $this->session->userdata('teacher_id');
			
			$data['leave_utype']     = 'teacher';
			
			$data['leave_fdate']     = date("Y-m-d",strtotime($this->input->post('lstartDate')));
			
			$data['leave_tdate']     = date("Y-m-d",strtotime($this->input->post('lendDate')));
			
			$data['leave_count']     = $this->input->post('no_dts');
			
			$data['leave_comments']     = $this->input->post('comments');
			
			$data['leave_added_date']     = date('Y-m-d H:i:s');
			
			$data['leave_modified_date']     = date('Y-m-d H:i:s');

            $this->db->insert('leave_data', $data);

            redirect(base_url() . 'index.php?admin/leavemanagement/', 'refresh');

        }

        if ($param1 == 'do_update') {

         
			
			
			
			
			
			$data['leave_status']     = $this->input->post('leave_status');
			
			$data['leave_message']     = $this->input->post('message');
			
			$data['leave_modifed_by']     = $this->session->userdata('admin_id');
			
			$data['leave_modified_date']     = date('Y-m-d H:i:s');

            $this->db->where('leave_id', $param2);

            $this->db->update('leave_data', $data);

            $this->session->set_flashdata('flash_message', get_phrase('leave_updated'));

            redirect(base_url() . 'index.php?admin/leavemanagement/', 'refresh');

        } else if ($param1 == 'edit') {

            $page_data['edit_data'] = $this->db->get_where('leave_data', array(

                'leave_id' => $param2

            ))->result_array();

        }

        if ($param1 == 'delete') {
			
			$data['leave_modified_date']     = date('Y-m-d H:i:s');
			
			$data['leave_modifed_by']     = $this->session->userdata('teacher_id');
			
			$data['leave_delete']     = 'Y';

            $this->db->where('leave_id', $param2);

            $this->db->update('leave_data', $data);

            $this->session->set_flashdata('flash_message', get_phrase('leave_updated'));

            redirect(base_url() . 'index.php?admin/leavemanagement/', 'refresh');

        }
		
		$this->load->model('leave_model');
		
		$page_data['ltype_data'] = $this->leave_model->listltypes();
		
		//$tid     = $this->session->userdata('teacher_id');

        $page_data['page_name']  = 'leavemanagement';

        $page_data['page_title'] = get_phrase('leave management');
		
		$this->db->select('leave_data.*,leave_types.leave_type_title as ltype,teacher.name as aname');
		
		$this->db->from('leave_data');
		
		$this->db->join('leave_types','leave_type_id=leave_tid');
		$this->db->join('teacher','teacher_id=leave_aid');
		
		$this->db->where('leave_delete','N');
		
		//$this->db->where('leave_aid',$tid);
		
		$this->db->order_by('leave_modified_date','desc');
		
		$query = $this->db->get();
		
        $page_data['leave_data']    = $query ->result_array();
		
		

        $this->load->view('index', $page_data);

    }
	
	function ltypedata(){
		
		$ltid = $this->input->post('lType');
		
		$this->load->model('leave_model');
		
		$ltype_data = $this->leave_model->getltype($ltid);
		
		extract($ltype_data );
		
		$lttid = $this->session->userdata('teacher_id');
		$this->db->select_sum('leave_count');
		$this->db->where('leave_tid',$ltid);
		$this->db->where('leave_aid',$lttid);
		$this->db->where('leave_delete','N');
		$query = $this->db->get('leave_data')->row_array();
		
		extract($query);
		//echo $leave_count;
		//echo $leave_type_max_days;
		$rms = $leave_type_max_days - $leave_count;
		
		if( $leave_count ==''){
			
			$leave_count=0;
		} else {
			
			$leave_count = $leave_count;
		}
		 $arr = array('thks' => $leave_count , 'mdays' => $leave_type_max_days, 'rms' => $rms ,'sts' => 'true');  
		//add the header here
    header('Content-Type: application/json');
    echo json_encode( $arr );
	}
	
	
   function caldays(){
	   
	   		$date_1 = date('Y-m-d',strtotime($this->input->post('startDate')));
			$date_2 = date('Y-m-d',strtotime($this->input->post('endDate')));
			$date1=date_create($date_1);
			$date2=date_create($date_2);
			$diff=date_diff($date1,$date2);
			$dval = $diff->format("%a");
			
			echo $dval+1;

   }
   
   function sms_student_data(){
	  $sid = $this->input->post('sid');
	  
	  $this->db->select('name,father_name,parent_phone1');
	  $this->db->where('student_id',$sid);
	  $query = $this->db->get_where('student');
	  
	  $data= $query->row_array();
	  extract($data);
	  
	 echo '<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="custom-tam-mode">Send SMS to '.$father_name.' (Parent Name)</h3>
			</div>
			<div class="modal-body">
			<div id="sms-overlay"><img src="'.base_url().'/template/images/ajax-loader-2.gif"></div>
			<div id="sms-feedback"></div>
			    <form class="form-horizontal" method="post" action="#" id="snd-frm">
				<div class="control-group">
				<label class="control-label" for="inputEmail">Student Name</label>
				<div class="controls">
				<p class="cstm-sts-txt">'.$name.'</p>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Parent Phone</label>
				<div class="controls">
				<p class="cstm-sts-txt">'.$parent_phone1.'</p>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="inputPassword">Message</label>
				<div class="controls">
				<textarea id="smessage" name="smessage" placeholder="Message" style="resize:none" maxlength="130"> </textarea>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for=""></label>
				<div class="controls">
				<p id="smessage_feedback"> </p>
				</div>
				</div>
				<div class="control-group">
				<div class="controls">
				<input type="hidden" value="'.$parent_phone1.'" id="smsphone" name="smsphone">
				<button type="button" class="btn btn-success" id="sndsmsbtn">Send SMS</button>
				</div>
				</div>
				</form>
				
			</div>
			<div class="modal-footer">
			<button class="btn btn-success btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
			
			</div>';
	  
   }
   function sms_student_snd(){
	   
	  $sphone = $this->input->post('smsphone');
	   
	  $smsg = $this->input->post('smessage');
	  
	  $res = send_tam_sms($sphone,$smsg);
	  
	  if($res){
		  echo "true";
	  } else {
		  echo "false";
	  }
	  
	   
   }
   function email_student_data(){
	  $sid = $this->input->post('sid');
	  
	  $this->db->select('name,father_name');
	  $this->db->where('student_id',$sid);
	  $query = $this->db->get_where('student');
	  
	  $data= $query->row_array();
	  extract($data);
	  
	 echo '<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="custom-tam-mode">Send Email to '.$father_name.' (Parent Name)</h3>
			</div>
			<div class="modal-body">
			<div id="sms-overlay"><img src="'.base_url().'/template/images/ajax-loader-2.gif"></div>
			<div id="sms-feedback"></div>
			    <form class="form-horizontal" method="post" action="#" id="snd-frm">
				<div class="control-group">
				<label class="control-label" for="inputEmail">Student Name</label>
				<div class="controls">
				<p class="cstm-sts-txt">'.$name.'</p>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="inputEmail">Subject</label>
				<div class="controls">
				<input type="text" name="ssub" id="ssub" >
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="inputPassword">Message</label>
				<div class="controls">
				<textarea id="smmessage" name="smmessage" placeholder="Message" style="resize:none" rows="8"> </textarea>
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for=""></label>
				<div class="controls">
				<p id="smessage_feedback"> </p>
				</div>
				</div>
				<div class="control-group">
				<div class="controls">
				<input type="hidden" value="'.$sid.'" id="mid" name="mid">
				<button type="button" class="btn btn-success" id="sndmailbtn">Send Mail</button>
				</div>
				</div>
				</form>
				
			</div>
			<div class="modal-footer">
			<button class="btn btn-success btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
			
			</div>';
	  
   }
   function mail_student_snd(){
	   
	 $ssub = $this->input->post('ssub');
	   
	 $smsg = $this->input->post('smmessage');
	  
	 $mid = $this->input->post('mid');
	  
	  $this->db->select('parent_email');
	  $this->db->where('student_id',$mid);
	  $query = $this->db->get_where('student');
	  
	  $datam= $query->row_array();
	  extract($datam);
	  
	  			  $data = array();
                  $data['unread'] = $mid;
                  $data['read'] = "";
                  $data['time'] = date("Y-m-d H:i:s");
                  $data['type'] = 'parent';
                  $data['subject'] = $ssub;
                  $data['body'] = $smsg;
                 $res = $this->db->insert('email', $data);
				  
				  
                 
				  
				  if($res){
					  echo "true";
				  } else {
					  echo "false";
				  }
   }
   
   /***------------CCE module controllers will start here-----------****/	
public function cce_category($param1='',$param2='')
{
	
		if ($param1 == 'create') {			
			$data['category'] = $this->input->post('add_category');
			
			$cce_check=$this->cce_model->check_cce_existed($this->input->post('add_category'));			
			if($cce_check)
			{
				$this->session->set_flashdata('msg','category already existed');
			}
			else{
            $this->db->insert('cce_category', $data);
			$this->session->set_flashdata('msg','succesfully created category');
			}
			redirect(base_url() . 'index.php?admin/cce_category/', 'refresh');
        }
		
		if ($param1 == 'up_date') {
			$cce_id = $this->input->post('edit_category_id');
			$data['category'] = $this->input->post('edit_category');
			$cce_check=$this->cce_model->check_cce_existed($this->input->post('edit_category'));
			if($cce_check)
			{
				$this->session->set_flashdata('msg','category already existed');
			}
			else{
				$this->db->where('cce_id', $cce_id);
				$this->db->update('cce_category', $data);
				$this->session->set_flashdata('msg','succesfully updated category');
			}
			redirect(base_url() . 'index.php?admin/cce_category/', 'refresh');
        }

		
		if ($param1 == 'delete') {
            $this->db->where('cce_id', $param2);
            $this->db->delete('cce_category');
			$this->session->set_flashdata('msg','succesfully deleted category');
            redirect(base_url() . 'index.php?admin/cce_category/', 'refresh');
        }
		$page_data['category'] = $this->cce_model->get_categories();
		$page_data['no_rows']=$this->cce_model->count_rows();
		$page_data['page_name'] = 'cce_category';
        $page_data['page_title'] = get_phrase('cce_category');
        $this->load->view('index', $page_data);
}
	public function cce_skills($param1='',$param2='')
{
		if ($param1 == 'create') {			
			$data['category_name'] = $this->input->post('category_name');
			$data['parent_skill'] = $this->input->post('parent_skill');
			$data['skill_name'] = $this->input->post('skill_name');
			$cce_check=$this->cce_model->check_cce_skill_existed($this->input->post('skill_name'));
			if($cce_check)
			{
				$this->session->set_flashdata('msg','skill already existed');
			}
			else{
            $this->db->insert('cce_skills', $data);
			$this->session->set_flashdata('msg','succesfully created skill');
			}
			redirect(base_url() . 'index.php?admin/cce_skills/', 'refresh');
        }
		if ($param1 == 'up_date') {
			$cce_id = $this->input->post('edit_skill_id');
			$data['skill_name'] = $this->input->post('edit_skill_name');			
			$cce_check=$this->cce_model->check_cce_skill_existed($this->input->post('edit_skill_name'));			
			if($cce_check)
			{
				$this->session->set_flashdata('msg','skill already existed');
			}
			else{
				$this->db->where('skill_id', $cce_id);
				$this->db->update('cce_skills', $data);
				$this->session->set_flashdata('msg','succesfully updated skill');
			}
			redirect(base_url() . 'index.php?admin/cce_skills/', 'refresh');
        }
		if ($param1 == 'delete') {
            $this->db->where('skill_id', $param2);
            $this->db->delete('cce_skills');
			$this->session->set_flashdata('msg','succesfully deleted skill');
            redirect(base_url() . 'index.php?admin/cce_skills/', 'refresh');
        }
		$page_data['category'] = $this->cce_model->get_categories();
		$page_data['skills'] = $this->cce_model->get_skills();
		$page_data['no_rows']=$this->cce_model->count_rows_skills();
		$page_data['page_name'] = 'cce_skills';
        $page_data['page_title'] = get_phrase('cce_skills');
        $this->load->view('index', $page_data);

}

	function cce_parent_skills(){

		$fc_id = $this->input->post('get_fc_id');		
		$fp_data = $this->cce_model->getfpdata($fc_id);
		
		$fcvalue ='<option value="none">No Parent</option>';
		
		foreach($fp_data as $fp_data_view){
			
			$fcvalue .='<option value="'.$fp_data_view->skill_id.'">'.$fp_data_view->skill_name.'</option>';
		}
		
		echo $fcvalue;
	}

	public function cce_indicators($param1='',$param2='')
	{		
		
		if ($param1 == 'create') {			
			$data['category_name'] = $this->input->post('category_name');
			$data['parent_skill'] = $this->input->post('parent_skill');
			$data['indicator_name'] = $this->input->post('indirator_name');
			$cce_check=$this->cce_model->check_cce_indicator_existed($this->input->post('indirator_name'));		
			if($cce_check)
			{
				$this->session->set_flashdata('msg','indicator already existed');
			}
			else{
            $this->db->insert('cce_indicators', $data);
			$this->session->set_flashdata('msg','succesfully created indicator');
			}
			redirect(base_url() . 'index.php?admin/cce_indicators/', 'refresh');
        }
		if ($param1 == 'up_date') {
			
			$cce_id = $this->input->post('indicator_id');
			$data['indicator_name'] = $this->input->post('indicator_name');		
			$cce_check=$this->cce_model->check_cce_indicator_existed($this->input->post('indicator_name'));				
			if($cce_check)
			{
				$this->session->set_flashdata('msg','indicator already existed');
			}
			else{
				$this->db->where('indicator_id', $cce_id);
				$this->db->update('cce_indicators', $data);
				$this->session->set_flashdata('msg','succesfully updated indicator');
			}
			redirect(base_url() . 'index.php?admin/cce_indicators/', 'refresh');
        }
		
		if ($param1 == 'delete') {
            $this->db->where('indicator_id', $param2);
            $this->db->delete('cce_indicators');
			$this->session->set_flashdata('msg','succesfully deleted indicator');
            redirect(base_url() . 'index.php?admin/cce_indicators/', 'refresh');
        }
		$page_data['indicators'] = $this->cce_model->get_indicators();
		$page_data['category'] = $this->cce_model->get_categories();		
		$page_data['no_rows']=$this->cce_model->count_rows_indicators();
		$page_data['page_name'] = 'cce_indicators';
        $page_data['page_title'] = get_phrase('cce_indicators');
        $this->load->view('index', $page_data);
	}
	
	function cce_parent_indicators(){

		$fc_id = $this->input->post('get_fc_id');		
		$fp_data = $this->cce_model->getfpdata($fc_id);
		
		$fcvalue ='<option value="">Select Skill</option>';
		
		foreach($fp_data as $fp_data_view){
			
			$fcvalue .='<option value="'.$fp_data_view->skill_id.'">'.$fp_data_view->skill_name.'</option>';
		}
		
		echo $fcvalue;
	}
	
	public function cce_assessment_term($param1='',$param2='')
	{		
		
		if ($param1 == 'create') {			
			$data['term_name'] = $this->input->post('term_name');
			$data['term_start_date'] = strtotime($this->input->post('term_start_date'));
			$data['term_end_date'] = strtotime($this->input->post('term_end_date'));
					
			//print_r($data);			
			$cce_check=$this->cce_model->check_cce_term_existed($this->input->post('term_name'));				
			if($cce_check)
			{
				$this->session->set_flashdata('msg','term already existed');
			}
			else{
            $this->db->insert('cce_assessment', $data);
			$this->session->set_flashdata('msg','succesfully created term');
			}
			redirect(base_url() . 'index.php?admin/cce_assessment_term/', 'refresh');
        }
		if ($param1 == 'up_date') {
			
			$cce_id = $this->input->post('term_id');
			$data['term_name'] = $this->input->post('term_name');
			$data['term_start_date'] = strtotime($this->input->post('term_start_date1'));
			$data['term_end_date'] = strtotime($this->input->post('term_end_date1'));			
			$cce_check=$this->cce_model->check_cce_term_existed($this->input->post('term_name'));	
					
			if($cce_check)
			{
				$this->session->set_flashdata('msg','term already existed');
			}
			else{
				//print_r($data);
				//die();
				$this->db->where('term_id', $cce_id);
				$this->db->update('cce_assessment', $data);
				$this->session->set_flashdata('msg','succesfully updated term');
			}
			redirect(base_url() . 'index.php?admin/cce_assessment_term/', 'refresh');
        }
		
		if ($param1 == 'delete') {
            $this->db->where('term_id', $param2);
            $this->db->delete('cce_assessment');
			$this->session->set_flashdata('msg','succesfully deleted term');
            redirect(base_url() . 'index.php?admin/cce_assessment_term/', 'refresh');
        }
		$page_data['assessment'] = $this->cce_model->get_assessment();			
		$page_data['no_rows']=$this->cce_model->count_rows_assessment();
		$page_data['page_name'] = 'cce_assessment_term';
        $page_data['page_title'] = get_phrase('cce_assessment_term');
        $this->load->view('index', $page_data);
	}
	public function cce_grade_sets($param1='',$param2='')
	{		
		
		if ($param1 == 'set_create') {			
			$data['set_name'] = $this->input->post('grade_setname');			
            $this->db->insert('cce_gradesets', $data);
			$this->session->set_flashdata('msg','succesfully created term');			
			redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }
		if ($param1 == 'create_grade') {			
			$data['set_name'] = $this->input->post('grade_set_name');
			$data['grade_name'] = $this->input->post('grade_name');
			$data['lower_bound'] = $this->input->post('lower_bound');
			$data['upper_bound'] = $this->input->post('upper_bound');
			$data['grade_points'] = $this->input->post('grade_points');			
            $this->db->insert('cce_grades', $data);
			$this->session->set_flashdata('msg','succesfully Created Grade');			
			redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }
		if ($param1 == 'up_date_sets') {
			$cce_id = $this->input->post('set_id');
			$data['set_name'] = $this->input->post('edit_category');
				$this->db->where('set_id', $cce_id);
				$this->db->update('cce_gradesets', $data);
				$this->session->set_flashdata('msg','succesfully updated term');
			redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }	
		if ($param1 == 'grade_update') {
			$cce_id = $this->input->post('edit_grade_id');
			$data['lower_bound']=$this->input->post('edit_lower_bound');
			$data['upper_bound']=$this->input->post('edit_upper_bound');
			$data['grade_points']=$this->input->post('edit_grade_points');			
				$this->db->where('grade_id', $cce_id);
				$this->db->update('cce_grades', $data);
				$this->session->set_flashdata('msg','succesfully updated term');
			redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }
		if ($param1 == 'set_delete') {
            $this->db->where('set_id', $param2);
            $this->db->delete('cce_gradesets');
			$this->session->set_flashdata('msg','succesfully deleted term');
            redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }
		if ($param1 == 'delete_grade') {			
            $this->db->where('grade_id', $param2);			
            $this->db->delete('cce_grades');
			$this->session->set_flashdata('msg','succesfully deleted term');
            redirect(base_url() . 'index.php?admin/cce_grade_sets/', 'refresh');
        }
		$page_data['gradesets'] = $this->cce_model->get_grade_sets();			
		$page_data['no_rows']=$this->cce_model->count_rows_gradeset();
		$page_data['page_name'] = 'cce_grade_sets';
        $page_data['page_title'] = get_phrase('cce_grade_sets');
        $this->load->view('index', $page_data);
	}
	
	function sets_dynamic_data(){

			$p_cid = $this->input->post('get_p_cid');
			
			$p_roll_data = $this->cce_model->get_grades_dynamic($p_cid);
			$total_rows=$this->cce_model->get_grade_rows_dynamic($p_cid);
			//print_r($p_roll_data);
			echo '<input type="hidden" id="total_rows" value="'.$total_rows.'" />';
			echo '<table cellpadding="0" cellspacing="0" class="table" border="1">';
			echo '<thead ><tr><th>Si No</th><th>Grade Set</th><th>Grade Name</th><th>Lower Bound</th><th>Upper Bound</th><th>Grade Points</th><th></th></tr></thead>';
			$var=1;
			foreach($p_roll_data as $row)
			{					
				echo '<tbody >';				
				echo '<tr><td>'.$var.'</td><td>'.$row['set_name'].'</td><td><input type="hidden" id="'.$var.'value" value="'.$row['grade_name'].'" />'.$row['grade_name'].'</td><td><input type="text" id="'.$var.'01" value="'.$row['lower_bound'].'" style="display:none;" /><span id="'.$var.'11">'.$row['lower_bound'].'</span></td><td><input type="text" style="display:none;" id="'.$var.'02" value="'.$row['upper_bound'].'" /><span id="'.$var.'12">'.$row['upper_bound'].'</span></td><td><input type="text" style="display:none;" id="'.$var.'03" value="'.$row['grade_points'].'" /><span id="'.$var.'13">'.$row['grade_points'].'</td><td><a id="'.$var.'edit" onclick="update_start('.$var.');" data-toggle="modal"  class="btn btn-gray btn-small"><i class="icon-wrench"></i>'.get_phrase('edit').'</a><form method="post" action="'.base_url().'index.php?admin/cce_grade_sets/grade_update"><input type="hidden" value="'.$row['grade_id'].'" name="edit_grade_id" /><input type="hidden" id="'.$var.'011" value="'.$row['lower_bound'].'" name="edit_lower_bound" /><input type="hidden" id="'.$var.'021" value="'.$row['upper_bound'].'" name="edit_upper_bound" /><input type="hidden" id="'.$var.'031" value="'.$row['grade_points'].'" name="edit_grade_points" /><button type="submit" id="'.$var.'update" style="display:none;" onclick=" return update_lower('.$var.')" class="btn btn-lightblue">Update</button></form><button onclick="close_row('.$var.');" id="'.$var.'cancel" class="btn btn-lightblue" style="display:none;">Cancel</button><a data-toggle="modal" id="'.$var.'delete" href="'.base_url().'index.php?admin/cce_grade_sets/delete_grade/'.$row['grade_id'].'")" onclick="return confirmation();" class="btn btn-red btn-small"><i class="icon-trash"></i>'.get_phrase('delete').'</a></td></tr>';
				echo '</tbody >';
				$var++;	
			}
			if($var==1)
			echo 'Now rows found';
			echo '</table>';

		
	}
	function grade_skills_mapping($param1='',$param2='')
	{
		if ($param1 == 'create') {			
			$data['grade_set'] = $this->input->post('grade_set_name');
			$data['category_name'] = $this->input->post('category_name');
			$skills = $this->input->post('skill_names');
			for($i=0;$i<sizeof($skills);$i++)
			{				
				$stat=$this->cce_model->check_grade_skills_existed($skills[$i]);
				if($stat==0)
				{
					$data['skill_name'] = $skills[$i];
					$this->db->insert('cce_grade_skills', $data);
				}
			}
			$this->session->set_flashdata('msg','succesfully created term');			
			redirect(base_url() . 'index.php?admin/grade_skills_mapping/', 'refresh');
        }
		if ($param1 == 'up_date') {
			$cce_id = $this->input->post('edit_grade_skill_id');
			$data['grade_set']=$this->input->post('edit_grade_skill_name');			
					
				$this->db->where('grade_skill_id', $cce_id);
				$this->db->update('cce_grade_skills', $data);
				$this->session->set_flashdata('msg','succesfully updated term');
			redirect(base_url() . 'index.php?admin/grade_skills_mapping/', 'refresh');
		}
		if ($param1 == 'delete') {			
            $this->db->where('grade_skill_id', $param2);			
            $this->db->delete('cce_grade_skills');
			$this->session->set_flashdata('msg','succesfully deleted term');
            redirect(base_url() . 'index.php?admin/grade_skills_mapping/', 'refresh');
        }
		$page_data['gradesets'] = $this->cce_model->get_grade_sets();
		$page_data['category'] = $this->cce_model->get_categories();			
		$page_data['gradeskills']=$this->cce_model->cce_grade_skills();
		$page_data['no_rows']=$this->cce_model->cce_grade_skills_rows();
		$page_data['page_name'] = 'cce_grade_skills';
        $page_data['page_title'] = get_phrase('cce_grade_skills_mapping');
        $this->load->view('index', $page_data);
		
	}
	function cce_grade_skills_dynamic(){

		$fc_id = $this->input->post('get_fc_id');		
		$fp_data = $this->cce_model->getfpdata($fc_id);
		$fp_rows = $this->cce_model->count_rows_grade_skills($fc_id);
		$skills_id=1;		
		//print_r($fp_data);
		echo '<input type="hidden" value="'.$fp_rows.'" id="no_rows_skills" name="total_skill_rows" />';
		foreach($fp_data as $fp_data_view){
			echo '<label class="checkbox inline"><input class="validate[required]" type="checkbox" id="check'.$skills_id.'" name="skill_names[]" value="'.$fp_data_view->skill_id.'">'.$fp_data_view->skill_name.'</label>';
			//echo $fp_data_view->skill_name.'<br>';
			//$fcvalue .='<input type="checkbox" value="'.$fp_data_view['skill_name'].'"> name="skills_array[]"'.$fp_data_view['skill_name'];
			$skills_id++;
		}
						
	}
	
	
	public function cce_assessment($param1='',$param2='')
	{		
		
		if ($param1 == 'create') {			
			$data['term_name'] = $this->input->post('term_name');
			$data['assessement_type'] = $this->input->post('assessement_type');
			$data['assessement_name'] = $this->input->post('assessement_name');
			$data['assessement_weightage'] = $this->input->post('assessement_weightage');					
			$cce_check=$this->cce_model->check_cce_term_existed($this->input->post('assessement_name'));				
			if($cce_check)
			{
				$this->session->set_flashdata('msg','assessment already existed');
			}
			else{
            $this->db->insert('cce_assessment_assign', $data);
			$this->session->set_flashdata('msg','succesfully created assessment');
			}
			redirect(base_url() . 'index.php?admin/cce_assessment/', 'refresh');
        }
		if ($param1 == 'up_date') {
			
			$cce_id = $this->input->post('assessement_id');			
			$data['assessement_name'] = $this->input->post('assessement_name');
			$data['assessement_weightage'] = $this->input->post('assessement_weightage');								
				$this->db->where('assessement_id', $cce_id);
				$this->db->update('cce_assessment_assign', $data);
				$this->session->set_flashdata('msg','succesfully updated assessment');
			redirect(base_url() . 'index.php?admin/cce_assessment/', 'refresh');
        }
		
		if ($param1 == 'delete') {
            $this->db->where('assessement_id', $param2);
            $this->db->delete('cce_assessment_assign');
			$this->session->set_flashdata('msg','succesfully deleted assessment');
            redirect(base_url() . 'index.php?admin/cce_assessment/', 'refresh');
        }
		$page_data['assessment'] = $this->cce_model->get_assessment_assign();	
		$page_data['allterms'] = $this->cce_model->get_assessment();
		$page_data['no_rows']=$this->cce_model->count_rows_assessment_assign();
		$page_data['page_name'] = 'cce_assessment_assign';
        $page_data['page_title'] = get_phrase('cce_assessment');
        $this->load->view('index', $page_data);
	}
	public function cce_class_indicator($param1='',$param2='')
	{	
		$page_data['class_id'] = $param1;
		if($param2=='update')
		{
			$check_update = $this->input->post('checked_data');			
			$grade_update = $this->input->post('checked_grade');
			
			for($i=0;$i<sizeof($check_update);$i++)
			{				
				for($j=0;$j<sizeof($grade_update);$j++)
				{
					$val1=explode('*',$grade_update[$j]);
					if($val1[1]==$check_update[$i])
					{
						$data['indicator_grade']=$val1[0];
					}
				}				
				$existed_row=$this->cce_model->check_class_indicator();
				foreach($existed_row as $mitest)
				{									
					if($mitest['ci_id']==$check_update[$i])
						{
							$data['indicator_checked']=1;						
							break;
						}
					else 
					{
						$data['indicator_checked']=0;
					}
				}				
				$this->db->where('ci_id', $check_update[$i]);
				$this->db->update('cce_class_indicator', $data);
			}		
			redirect(base_url() . 'index.php?admin/cce_class_indicator/'.$param1, 'refresh');
		}
		if($param1)
		{
		$data['class']=$param1;
					$this->db->group_by('category_name');
					$categories=$this->db->get('cce_indicators')->result_array();
					//print_r($categories);
					foreach($categories as $category)
					{													
						$this->db->where('category_name',$category['category_name']);
						$this->db->group_by('parent_skill');
						$skills=$this->db->get('cce_indicators')->result_array();
						foreach($skills as $skill)
						{													
							$this->db->where('category_name',$category['category_name']);
							$this->db->where('parent_skill',$skill['parent_skill']);					
							$indicators=$this->db->get('cce_indicators')->result_array();														
							//echo '<tr><td><pre>';print_r($indicators).'</td></tr>';
							foreach($indicators as $indicator)
							{
								$data['category_name']=$indicator['category_name'];
								$data['skill_name']=$indicator['parent_skill'];
								$data['indicator_name']=$indicator['indicator_id'];
								$check=$this->cce_model->class_indicator_check($data);
								if($check==0)
								{
									$this->db->insert('cce_class_indicator', $data);
								//print_r($data);
								}									
							}
							
				  }
					}
		}					
		$page_data['page_name'] = 'cce_class_indicator';
        $page_data['page_title'] = get_phrase('cce_class_indicator');
        $this->load->view('index', $page_data);
	}
	
	function examscheme($param1=''){
		
		
		
		$page_data['class_id'] = $param1;
		
		$page_data['termdata'] = $this->cce_model->get_assessment();
		
		$page_data['page_name'] = 'cce_exam_scheme';
        $page_data['page_title'] = get_phrase('exam_scheme');
        $this->load->view('index', $page_data);
	}
	function cce_add_test_data(){
		
		$now = time();

		$data['test_class_id'] = $this->input->post('asmntcid');
		
		$data['test_assessement_id'] = $this->input->post('asmntid');
		
		$data['test_name'] = $this->input->post('test_name');
		
		$data['test_added_date'] = unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$res = $this->cce_model->insTestData($data);
		
		if($res){
			
			echo "true";
			
		} else {
			
			echo "false";
		}
		
	}
	function cce_del_test_data(){
		
		$test_id = $this->input->post('t_id');
		
		$now = time();
		
		$data['test_modifiled_date'] = unix_to_human($now, TRUE, 'eu'); // Euro time with seconds
		
		$data['test_delete'] = 1;
		
		
		$res = $this->cce_model->delTestData($test_id,$data);
		
		if($res){
			
			echo "true";
			
		} else {
			
			echo "false";
		}
	}
	
	function cce_attendance($param1=''){
		
		
		
		$page_data['class_id'] = $param1;
		if($param1!=''){
		$page_data['student_data'] = $this->cce_model->getStudentData($param1);
		}
		
		
		$page_data['page_name'] = 'cce_attendance';
        $page_data['page_title'] = get_phrase('attendance');
        $this->load->view('index', $page_data);
	}
	
	function cce_attendance_ins(){
		
		$attendance_data = $this->input->post('attendance_id');
		
		foreach($attendance_data as $key => $attendance_id){
			
             $term1attendances = $this->input->post("term1attendance");
			 $data['attendance_term1_present'] = $term1attendances[$key];
			 
			 $term2attendances = $this->input->post("term2attendance");
			 $data['attendance_term2_present'] = $term2attendances[$key];
			 
			 $this->db->where('attendance_id',$attendance_id);
                $this->db->update('cce_attendance', $data);
		}
		
		$this->session->set_flashdata('flash_message', get_phrase('CCE_attendance_updated_successfully !'));            
            redirect(base_url() . 'index.php?admin/cce_attendance/' . $this->input->post('hid_cid'), 'refresh');
	}
	
	function cce_max_attendance($p1=''){
		
		if($p1 == 'gdata'){
			
			$qry = $this->db->get('cce_max_attendance');
			
			$data = $qry->row_array();
			
			extract($data);
			
			echo '<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="custom-tam-mode">Max Attendance Settings</h3>
			</div>
			<div class="modal-body">
			<div id="sms-overlay"><img src="'.base_url().'/template/images/ajax-loader-2.gif"></div>
			<div id="sms-feedback"></div>
			    <form class="form-horizontal" method="post" action="#" id="atd-frm" style="margin-top:30px;">
				
				<div class="control-group">
				<label class="control-label" for="">Max Attendance for Term 1</label>
				<div class="controls">
				<input type="text" name="mat1" id="mat1" value="'.$max_attendance_term1.'">
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for="">Max Attendance for Term 2</label>
				<div class="controls">
				<input type="text" id="mat2" name="mat2" value="'.$max_attendance_term2.'" />
				</div>
				</div>
				<div class="control-group">
				<label class="control-label" for=""></label>
				<div class="controls">
				<p id="smessage_feedback"> </p>
				</div>
				</div>
				<div class="control-group">
				<div class="controls">
				<input type="hidden" value="'.$max_attendance_id.'" id="aid" name="aid">
				<button type="button" class="btn btn-success" id="updatebtn">Update</button>
				</div>
				</div>
				</form>
				
			</div>
			<div class="modal-footer">
			<button class="btn btn-success btn-small" data-dismiss="modal" aria-hidden="true">Close</button>
			
			</div>';
	  
		}if($p1 == 'udata'){
			
			$data['max_attendance_term1'] = $this->input->post('mat1');
			$data['max_attendance_term2'] = $this->input->post('mat2');
			
			$max_id = $this->input->post('aid');
			
			$this->db->where('max_attendance_id',$max_id);
		
		    $res = $this->db->update('cce_max_attendance',$data);
			
			if($res){
			
				echo "true";
			
			} else {
				
				echo "false";
			}
		}
	}
	
	
	
}
?>