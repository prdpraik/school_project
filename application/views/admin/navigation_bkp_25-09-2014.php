<!--<div class="sidebar-background">
	<div class="primary-sidebar-background">
	</div>
</div>-->
<div class="primary-sidebar" id="tam-custom-sidebar">
	<!-- Main nav -->
    
    <div id="tam-custom-logo">
    	<a href="<?php echo base_url();?>">
        	<img src="<?php echo base_url();?>uploads/logo.png"  style="max-height:100px; max-width:100px;"/>
        </a>
    </div>
   	
	<ul class="nav nav-collapse collapse nav-collapse-primary">
    
        
        <!------dashboard----->
		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/dashboard" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('dashboard_help');?>">
					<!--<i class="icon-desktop icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/home.png" />
					<span><?php echo get_phrase('dashboard');?></span>
				</a>
		</li>
		
	<!------sms--------->
	 	       
		<li class="dark-nav <?php if($page_name == 'sms_view' || $page_name == 'sms_template_view' || $page_name == 'sent_sms' ||  $page_name == 'email' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#communication_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('communication_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/settings.png" />
                <span><?php echo get_phrase('communication');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="communication_submenu" class="collapse <?php if($page_name == 'sms_view' || $page_name == 'sms_template_view' || $page_name == 'sent_sms' ||  $page_name == 'email' )echo 'in';?>">
                <li class="<?php if($page_name == 'sms_view')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/sms_view">
                  		<!--<i class="icon-h-sign"></i>-->
                  		<img src="<?php echo base_url();?>template/images/icons/system_settings.png" />
                    	<?php echo get_phrase('send_sms');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'sms_template_view')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/sms_template_view">
                      	<!--<i class="icon-globe"></i>-->
                    	<img src="<?php echo base_url();?>template/images/icons/language.png" />
						<?php echo get_phrase('sms_template_view');?>
                  </a>
                </li>
               <li class="<?php if($page_name == 'sent_sms')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/sent_sms">
                      	<!--<i class="icon-globe"></i>-->
                    	<img src="<?php echo base_url();?>template/images/icons/language.png" />
						<?php echo get_phrase('sent_sms');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'email')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/email">
                      	<!--<i class="icon-globe"></i>-->
                    	<i class="icon-envelope"></i>
						<?php echo get_phrase('email');?>
                  </a>
                </li>
                 <!------noticeboard----->
                    <li class="<?php if($page_name == 'noticeboard')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/noticeboard" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('noticeboard_help');?>">
                                <!--<i class="icon-columns icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/noticeboard.png" />
                                <span><?php echo get_phrase('noticeboard-event');?></span>
                            </a>
                    </li>
               
            </ul>
		</li>

       	<li class="dark-nav <?php if(	$page_name == 'student' ||  $page_name == 'teacher' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#admission_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('admission_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/user.png" />
                <span><?php echo get_phrase('admission');?><i class="icon-caret-down"></i></span>
            </a>
            <ul id="admission_submenu" class="collapse <?php if(	$page_name == 'student' ||  $page_name == 'teacher' ) echo 'in';?>">
        
        
        <!------student----->
		<li class="<?php if($page_name == 'student')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/student" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('student_help');?>">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/user.png" />
					<span><?php echo get_phrase('student');?></span>
				</a>
		</li>
        	
        <!------teacher----->
		<li class="<?php if($page_name == 'teacher')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/teacher" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('teacher_help');?>">
					<!--<i class="icon-user icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/teacher.png" />
					<span><?php echo get_phrase('teacher');?></span>
				</a>
		</li>
       	
        </ul>
        </li>
        
        <!------parent----->
<!--		<li class="<?php if($page_name == 'parent')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/parent" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('teacher_help');?>">
					<i class="icon-user icon-1x"></i>
                    <img src="<?php echo base_url();?>template/images/icons/parent.png" />
					<span><?php echo get_phrase('parent');?></span>
				</a>
		</li>-->
       	
        
        <li class="dark-nav <?php if(	$page_name == 'subject' ||  $page_name == 'class' ||  $page_name == 'exam' ||  $page_name == 'marks' || $page_name == 'attendence' || $page_name == 'grade' || $page_name == 'timetable_category'|| $page_name == 'departments'|| $page_name ==  'daily_attendence')echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#academics_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('academics_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/subject.png" />
                <span><?php echo get_phrase('academics');?><i class="icon-caret-down"></i></span>
            </a>
            <ul id="academics_submenu" class="collapse <?php if(	$page_name == 'subject' ||  $page_name == 'class' ||  $page_name == 'exam' ||  $page_name == 'marks' || $page_name == 'attendence' || $page_name == 'grade'|| $page_name == 'timetable_category'|| $page_name == 'departments'|| $page_name ==  'daily_attendence') echo 'in';?>">
        
        
        <!------subject----->
		<li class="<?php if($page_name == 'subject')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/subject" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('subject_help');?>">
					<!--<i class="icon-tasks icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/subject.png" />
					<span><?php echo get_phrase('subject');?></span>
				</a>
		</li>
       	
        <!------classes----->
		<li class="<?php if($page_name == 'class')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/classes" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('class_help');?>">
					<!--<i class="icon-sitemap icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/class.png" />
					<span><?php echo get_phrase('class');?></span>
				</a>
		</li>
        	
        <!------exam----->
		<li class="<?php if($page_name == 'exam')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/exam" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('exam_help');?>">
					<!--<i class="icon-paste icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/exam.png" />
					<span><?php echo get_phrase('exam');?></span>
				</a>
		</li>
        
		<!------marks----->
		<li class="<?php if($page_name == 'marks')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/marks" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('marks_help');?>">
					<!--<i class="icon-pencil icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/marks.png" />
					<span><?php echo get_phrase('marks');?></span>
				</a>
		</li>
		
		<!------daily_attendence----->
		<li class="<?php if($page_name == 'daily_attendence')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/daily_attendence" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('daily_attendence_help');?>">
					<!--<i class="icon-pencil icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/marks.png" />
					<span><?php echo get_phrase('daily_attendence');?></span>
				</a>
		</li>
        
        <!------Attendence----->
		<li class="<?php if($page_name == 'attendence')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/attendence" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('attendence_help');?>">
					<!--<i class="icon-pencil icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/marks.png" />
					<span><?php echo get_phrase('Attendence');?></span>
				</a>
		</li>
        	
        <!------grade----->
		<li class="<?php if($page_name == 'grade')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/grade" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('grade_help');?>">
					<!--<i class="icon-list-ol icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/grade.png" />
					<span><?php echo get_phrase('exam-grade');?></span>
				</a>
		</li>
        
         <!------class routine----->
		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/class_routine" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('class_routine_help');?>">
					<!--<i class="icon-indent-right icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/routine.png" />
					<span><?php echo get_phrase('class_routine');?></span>
				</a>
		</li>
        
         <!------timetable category----->
		<li class="<?php if($page_name == 'timetable_category')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/timetable_category" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('timetable_categories_help');?>">
					<!--<i class="icon-indent-right icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/routine.png" />
					<span><?php echo get_phrase('timetable_categories');?></span>
				</a>
		</li>
       	
         <!------departments----->
		<li class="<?php if($page_name == 'departments')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/departments" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('departments_help');?>">
					<!--<i class="icon-indent-right icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/routine.png" />
					<span><?php echo get_phrase('departments');?></span>
				</a>
		</li>
        
        </ul>
        </li>
        
        
        
        <!------hr----->
        <li class="dark-nav <?php if(	$page_name == 'employee_category' ||  $page_name == 'leave_types' ||  $page_name == 'staff_attendence')echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#hr_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('hr_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                <span><?php echo get_phrase('hr');?><i class="icon-caret-down"></i></span>
            </a>
            <ul id="hr_submenu" class="collapse <?php if(	$page_name == 'employee_category' ||  $page_name == 'leave_types' ||  $page_name == 'staff_attendence' ) echo 'in';?>">
                    <!------employee category----->
                    <li class="<?php if($page_name == 'employee_category')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/employee_category" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('employee_category_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('employee_category');?></span>
                            </a>
                    </li>
                    
                    
                    <!------leavetypes----->
                    <li class="<?php if($page_name == 'leave_types')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/leavetypes" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('leavetypes_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('leave_types');?></span>
                            </a>
                    </li>
                    
                    <!------staffattendence----->
                    <li class="<?php if($page_name == 'staff_attendence')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/staffattendence" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('staffattendence_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('staff_attendence');?></span>
                            </a>
                    </li>
                    
                   
        
          </ul>
		</li>
        
        
        	
       
        
        <li class="dark-nav <?php if(	$page_name == 'invoice' ||  $page_name == 'feescat' ||  $page_name == 'class_wise_fees' ||  $page_name == 'studentpayments')echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#payment_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('payment_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                <span><?php echo get_phrase('payment');?><i class="icon-caret-down"></i></span>
            </a>
            <ul id="payment_submenu" class="collapse <?php if(	$page_name == 'invoice' ||  $page_name == 'feescat' ||  $page_name == 'class_wise_fees' ||  $page_name == 'studentpayments') echo 'in';?>">
                    <!------invoice----->
                    <li class="<?php if($page_name == 'invoice')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/invoice" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('invoice_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('payment');?></span>
                            </a>
                    </li>
                    
                    
                    <!------Fees category----->
                    <li class="<?php if($page_name == 'feescat')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/fees_cat" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('fees_category_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('fees_category');?></span>
                            </a>
                    </li>
                    
                    <!------Class wise fees----->
                    <li class="<?php if($page_name == 'class_wise_fees')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/class_wise_fees" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('class_wise_fees_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('class_wise_fees');?></span>
                            </a>
                    </li>
                    
                    <!------Student Payments----->
                    <li class="<?php if($page_name == 'studentpayments')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?admin/manage_student_fees" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('student_payments_help');?>">
                                <!--<i class="icon-money icon-1x"></i>-->
                                <img src="<?php echo base_url();?>template/images/icons/payment.png" />
                                <span><?php echo get_phrase('studentpayments');?></span>
                            </a>
                    </li>
        
          </ul>
		</li>	
     
		
		
		<!------Library------>
		<li class="dark-nav <?php if(	$page_name == 'book' ||  $page_name == 'bookcat' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#library_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('book_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/book.png" />
                <span><?php echo get_phrase('library');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="library_submenu" class="collapse <?php if(	$page_name == 'book' ||  $page_name == 'bookcat' )echo 'in';?>">
                <li class="<?php if($page_name == 'book')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/book">
                  		<!--<i class="icon-h-sign"></i>-->
                  		 <img src="<?php echo base_url();?>template/images/icons/book.png" />
                    	<?php echo get_phrase('add_books');?>
                  </a>
                </li>
                <li class="<?php if($page_name == 'bookcat')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/book_cat">
                      	<!--<i class="icon-globe"></i>-->
                    	 <img src="<?php echo base_url();?>template/images/icons/book.png" />
						<?php echo get_phrase('books_category');?>
                  </a>
                </li>
               
            </ul>
		</li>
		
		
		
		
       	<!------transport------>
		<li class="dark-nav <?php if(	$page_name == 'transport' ||  $page_name == 'dormitory' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#utilities_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('utilities_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/utilities.png" />
                <span><?php echo get_phrase('utilities');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="utilities_submenu" class="collapse <?php if(	$page_name == 'transport' ||  $page_name == 'dormitory'  )echo 'in';?>">
        
        
        <!------transport----->
		<li class="<?php if($page_name == 'transport')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/transport" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('transport_help');?>">
					<!--<i class="icon-truck icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/transport.png" />
					<span><?php echo get_phrase('transport');?></span>
				</a>
		</li>
        	
        <!------dormitory----->
		<li class="<?php if($page_name == 'dormitory')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/dormitory" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('dormitory_help');?>">
					<!--<i class="icon-hospital icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/dormitory.png" />
					<span><?php echo get_phrase('dormitory');?></span>
				</a>
		</li>
        
        
        </ul>
        </li>
       
        

		

        	
        <!------system settings------>
		<li class="dark-nav <?php if(	$page_name == 'system_settings' 		|| 
										$page_name == 'manage_language' 		|| 
										$page_name == 'backup_restore' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#settings_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('bed_ward_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/settings.png" />
                <span><?php echo get_phrase('settings');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="settings_submenu" class="collapse <?php if(	$page_name == 'system_settings' 		|| 
																$page_name == 'manage_language' 		|| 
																$page_name == 'backup_restore' )echo 'in';?>">
                <li class="<?php if($page_name == 'system_settings')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/system_settings">
                  		<!--<i class="icon-h-sign"></i>-->
                  		<img src="<?php echo base_url();?>template/images/icons/system_settings.png" />
                    	<?php echo get_phrase('system_settings');?>
                  </a>
                </li>
               <!-- <li class="<?php //if($page_name == 'manage_language')echo 'active';?>">
                  <a href="<?php //echo base_url();?>index.php?admin/manage_language">
                      	<i class="icon-globe"></i>
                    	<img src="<?php //echo base_url();?>template/images/icons/language.png" />
						<?php //echo get_phrase('manage_language');?>
                  </a>
                </li>-->
                <li class="<?php if($page_name == 'backup_restore')echo 'active';?>">
                  <a href="<?php echo base_url();?>index.php?admin/backup_restore">
                      	<!--<i class="icon-download-alt"></i>-->
                    	<img src="<?php echo base_url();?>template/images/icons/backup.png" />
						<?php echo get_phrase('backup_restore');?>
                  </a>
                </li>
            </ul>
		</li>
	
		<!------manage own profile--->
		<!--<li class="<?php //if($page_name == 'manage_profile')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php //echo base_url();?>index.php?admin/manage_profile" rel="tooltip" data-placement="right" 
                	data-original-title="<?php //echo get_phrase('profile_help');?>">
					<i class="icon-lock icon-1x"></i>
                    <img src="<?php //echo base_url();?>template/images/icons/profile.png" />
					<span><?php //echo get_phrase('profile');?></span>
				</a>
		</li>-->
        
        <!------system settings------>
		<li class="dark-nav <?php if(	$page_name == 'previousquestionpapers' 		|| 
										$page_name == 'onlinetest' 		|| 
										$page_name == 'ebooks' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#knowledge_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('knowledge_help');?>">
                <!--<i class="icon-wrench icon-1x"></i>-->
                <img src="<?php echo base_url();?>template/images/icons/settings.png" />
                <span><?php echo get_phrase('knowledge');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="knowledge_submenu" class="collapse <?php if(	$page_name == 'previousquestionpapers' 		|| 
																$page_name == 'onlinetest' 		|| 
																$page_name == 'ebooks' )echo 'in';?>">
        <li class="<?php if($page_name == 'ebooks')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/ebooks" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('ebooks');?>">
					<!--<i class="icon-lock icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/profile.png" />
					<span><?php echo get_phrase('ebooks');?></span>
				</a>
		</li>
		<li class="<?php if($page_name == 'previousquestionpapers')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/previousquestionpapers" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('Previous Question Papers');?>">
					<!--<i class="icon-lock icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/profile.png" />
					<span><?php echo get_phrase('Previous Question Papers');?></span>
				</a>
		</li>
        <li class="<?php if($page_name == 'onlinetest')echo 'dark-nav active';?>">
			<span class="glow"></span>
				<a href="<?php echo base_url();?>index.php?admin/onlinetest" rel="tooltip" data-placement="right" 
                	data-original-title="<?php echo get_phrase('Online Test');?>">
					<!--<i class="icon-lock icon-1x"></i>-->
                    <img src="<?php echo base_url();?>template/images/icons/profile.png" />
					<span><?php echo get_phrase('Online Test');?></span>
				</a>
		</li>
        </ul>
        
        
	</ul>
	
</div>