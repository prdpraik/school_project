<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('get_sms'))
{
	function get_sms($template,$student_name = '',$father_name='',$class='') {
                 $msg = $template;
                 if($student_name!='')
                 {
                     $msg = str_replace("%student%", $student_name, $msg);
                 }
                 if($father_name!='')
                 {
                    $msg = str_replace("%father%", $father_name, $msg);
                 }
                 if($class!='')
                 {
                   $msg = str_replace("%class%", $class, $msg);
                 }
		return $msg;
	}
}

if ( ! function_exists('get_students_by_class_id'))
{
     function get_students_by_class_id($class_id,$format='json')
     {
                $CI	= &get_instance();
		$CI->load->database();
                $CI->db->select('student_id as value,name as text');
                $CI->db->from('student');
                $CI->db->where('class_id',$class_id);
                $query = $CI->db->get();
                $students_data = $query->result();
                return json_encode($students_data);

     }
}
if(!function_exists('send_sms'))
{
   function send_sms($to,$msg)
   {
       $url = "http://sms.smsmyntra.com/api/sendmsg.php?user=EduCloudCampus&pass=q12345&sender=ECCMPS&phone=%s&text=%s&priority=ndnd&stype=normal";
	   
       //$msg = urlencode ( $msg );
       $url = sprintf($url,$to,$msg);
       echo $url;
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch,CURLOPT_HTTPHEADER,array('X-Mashape-Authorization: YEOmdmfwvW4kIbLLCYYCL3BqRSX9inDp'));
        $response = curl_exec($ch);
        curl_close($ch); 
        return $response;
   }
}


if(! function_exists('send_sms_template'))
{
   function send_sms_template($student_id,$class_id,$msg)
   {
                  $CI	= &get_instance();
		  $CI->load->database();
                  $student_name =  $CI->db->select('name')->from('student')->where('student_id', $student_id)->get()->row()->name;
                  $father_name = $CI->db->select('name')->from('parent')->where('student_id', $student_id)->get()->row()->name;
                  $class_name = $CI->db->select('name')->from('class')->where('class_id', $class_id)->get()->row()->name;
                 if(strpos($msg,'%student%') !== false)
                 {
                     $msg = str_replace("%student%", $student_name, $msg);
                 }
                 if(strpos($msg,'%father%') !== false)
                 {
                    $msg = str_replace("%father%", $father_name, $msg);
                 }
                 if(strpos($msg,'%class%') !== false)
                 {
                   $msg = str_replace("%class%", $class, $msg);
                 }
                 //echo $msg;
                 $to = get_parent_number($student_id);
                 if($to !=NULL && $to != "" )
                 {
                     //echo sprintf("sent to %s successfully message is %s",$to,$msg); 
                 }
                 
                 //print_r(send_sms($to,$msg));
		 return $msg;
   }

}

if(!function_exists('send_sms_to_class')){
    function send_sms_to_class($class_id,$msg){
         $CI	= &get_instance();
   $CI->load->database();
   $students = $CI->db->select('student_id')->from('student')->where('class_id', $class_id)->get()->result();
   foreach($students as $student){
       $to = get_parent_number($student->student_id);
       send_sms_template($student->student_id,$class_id,$msg);
   }
       return 0;
    }
}

if(!function_exists('get_parent_number')){
    function get_parent_number($student_id){
       //$students = $this->db->get
       $CI	= &get_instance();
       $CI->load->database();
       return $CI->db->select('phone')->from('parent')->where('student_id', $student_id)->get()->row()->phone;
    }
}


if(!function_exists('send_tam_sms'))
{
  /* function send_tam_sms($to,$msg)
   {
      	$URL = "http://182.18.165.185/API/sms.php";
		$post_fields = array(
			'username' => 'varun7king',
			'password' => 'varun7king',
			'from' => 'TAMSMS',
			'to' => $to,
			'msg' => $msg
		);
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $URL);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		//curl_exec($ch);
		return curl_exec($ch);
   }*/
   function send_tam_sms_all($to,$msg){
	   
	    $username = urlencode('compucare2@gmail.com');
		$hash = urlencode('7ba694398e6b2b231efc0e2dacc31c25cf5c7e25');
		 $numbers = urlencode($to);
					$sender = urlencode('TXTLCL');
					$message = rawurlencode($msg);
					$data = 'username=' . $username . '&hash=' . $hash . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
					$ch = curl_init('http://api.textlocal.in/send/?' . $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
	                               $responseNew=json_decode($response);
                                       $responseNew= json_decode(json_encode($responseNew),true);

                                     curl_close($ch);
									
                                     return ($responseNew['status']=='success')?1:0;
   }
   function send_tam_sms($to,$msg){
	$CI	= &get_instance();
	$CI->load->database();
	$sms_registered_email=$CI->db->get_where('settings' , array('type'=>'sms_registered_email'))->row()->description;
	$sms_hascode=$CI->db->get_where('settings' , array('type'=>'sms_hascode'))->row()->description;
	$username = urlencode($sms_registered_email);
	$hash = urlencode($sms_hascode);
			if(strlen($to)==10){
				$to='91'.$to;
			}
			if((strlen($to)==12) && !empty($msg)){
			// Message details
					 $numbers = urlencode($to);
					$sender = urlencode('TXTLCL');
					$message = rawurlencode($msg);
					$data = 'username=' . $username . '&hash=' . $hash . '&numbers=' . $numbers . "&sender=" . $sender . "&message=" . $message;
					$ch = curl_init('http://api.textlocal.in/send/?' . $data);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$response = curl_exec($ch);
	                               $responseNew=json_decode($response);
                                       $responseNew= json_decode(json_encode($responseNew),true);
					//echo $responseNew['status'];
					//return  curl_close($ch); //exit;
                                          curl_close($ch);
                                     return ($responseNew['status']=='success')?1:0;
					
					
			}
	}
	
	function getSMSCount(){
		   // Authorisation details.	
	$username = "compucare2@gmail.com";
	$hash = "7ba694398e6b2b231efc0e2dacc31c25cf5c7e25";
	if(!empty($username) && !empty($hash)){
	if($_SERVER['REMOTE_ADDR']!='127.0.0.1'){
	// You shouldn't need to change anything here.	
	$data = "username=".$userame."&hash=".$hash;
	$ch = curl_init('https://control.textlocal.in/api2/balance');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$credits = curl_exec($ch);
	// This is the number of credits you have left	
	curl_close($ch);
	}
	}
		return $credits;
	}
}