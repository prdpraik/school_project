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

				<a href="<?php echo base_url();?>index.php?teacher/dashboard" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('dashboard_help');?>">

					<i class="icon-plus"></i>


					<span><?php echo get_phrase('dashboard');?></span>

				</a>

		</li>

        

        <!------student----->

		<li class="<?php if($page_name == 'student')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/student" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('student_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('student');?></span>

				</a>

		</li>

        

        <!------teacher----->

		<!--<li class="<?php //if($page_name == 'teacher')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php //echo base_url();?>index.php?teacher/teacher_list" rel="tooltip" data-placement="right" 

                	data-original-title="<?php //echo get_phrase('teacher_help');?>">

					<i class="icon-user icon-1x"></i>

                    <img src="<?php //echo base_url();?>template/images/icons/teacher.png" />

					<span><?php //echo get_phrase('teacher');?></span>

				</a>

		</li>-->

        

        <!------subject----->

		<!--<li class="<?php if($page_name == 'subject')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/subject" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('subject_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('subject');?></span>

				</a>

		</li>-->

        

        

        <!------marks----->

		<li class="<?php if($page_name == 'marks')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/marks" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('marks_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('enter_student_marks');?></span>

				</a>

		</li>
		
		 <!------attendence----->

		<!--<li class="<?php if($page_name == 'attendence')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/attendence" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('attendence_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('student_attendance');?></span>

				</a>

		</li>-->

		<!------staff attendance----->
		<!--<li class="dark-nav <?php if($page_name == 'daily_attendence' || $page_name == 'monthlyattendence' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#marks_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('staff_attendence');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('staff_attendence');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="marks_submenu" class="collapse <?php if($page_name == 'daily_attendence' || $page_name == 'monthlyattendence')echo 'in';?>">
                
				<li class="<?php if($page_name == 'daily_attendence')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?teacher/dailyattendence">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('daily_attendence');?>
                  </a>
                </li>    
				
                <li class="<?php if($page_name == 'monthlyattendence' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?teacher/mymonthlyattendence">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('monthly_attendence');?>
                  </a>
                </li>							
					
            </ul>
		</li>-->
        

        <!------class routine----->

		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/class_routine" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('class_routine_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('class_routine');?></span>

				</a>

		</li>
        
        <!------class routine----->

		<li class="<?php if($page_name == 'feecollect')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/feecollect" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('student_fee_details_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('student_fee_details');?></span>

				</a>

		</li>

         <!------leavetypes----->
                    <li class="<?php if($page_name == 'leavemanagement')echo 'dark-nav active';?>">
                        <span class="glow"></span>
                            <a href="<?php echo base_url();?>index.php?teacher/leavemanagement" rel="tooltip" data-placement="right" 
                                data-original-title="<?php echo get_phrase('leavemanagement_help');?>">
                                <i class="icon-user icon-plus"></i>  
                                <span><?php echo get_phrase('leave_management');?></span>
                            </a>
                    </li>

        <!------ utilities ----->
		<li class="dark-nav <?php if($page_name == 'book' || $page_name == 'transport' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#utilities_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('utilities');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('utilities');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="utilities_submenu" class="collapse <?php if($page_name == 'book' || $page_name == 'transport')echo 'in';?>">
                
				<li class="<?php if($page_name == 'book')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?teacher/book">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('library');?>
                  </a>
                </li>    
				
                <li class="<?php if($page_name == 'transport' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?teacher/transport">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('transport');?>
                  </a>
                </li>							
					
            </ul>
		</li>


        

        <!------assignments----->

		<li class="<?php if($page_name == 'assignments')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/assignments" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('assignments_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('assignments');?></span>

				</a>

		</li>
		
		
        <!------noticeboard----->

		<li class="<?php if($page_name == 'noticeboard')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/noticeboard" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('noticeboard_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('noticeboard-event');?></span>

				</a>

		</li>

        

        

        

		

		

	</ul>

	

</div>