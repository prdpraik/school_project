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

		<li class="<?php if($page_name == 'subject')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/subject" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('subject_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('subject');?></span>

				</a>

		</li>

        

        

        <!------marks----->

		<li class="<?php if($page_name == 'marks')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/marks" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('marks_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('marks');?></span>

				</a>

		</li>
		
		 <!------attendence----->

		<li class="<?php if($page_name == 'attendence')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/attendence" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('attendence_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('attendance');?></span>

				</a>

		</li>

        

        <!------class routine----->

		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/class_routine" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('class_routine_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('class_routine');?></span>

				</a>

		</li>

        

        

        <!------book----->

		<li class="<?php if($page_name == 'book')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/book" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('book_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('library');?></span>

				</a>

		</li>

        

        <!------transport----->

		<li class="<?php if($page_name == 'transport')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?teacher/transport" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('transport_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('transport');?></span>

				</a>

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