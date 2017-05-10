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

				<a href="<?php echo base_url();?>index.php?student/dashboard" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('dashboard_help');?>">

					<i class="icon-plus"></i>

                    <!--<img src="<?php echo base_url();?>template/images/icons/home.png" />-->

					<span><?php echo get_phrase('dashboard');?></span>

				</a>

		</li>

        

        

        

        <!------subject----->

		<li class="<?php if($page_name == 'subject')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/subject" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('subject_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('subject');?></span>

				</a>

		</li>

        

        

		<!------Marks----->
		<li class="dark-nav <?php if($page_name == 'marks' || $page_name == 'mark_view' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#marks_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('marks');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('marks');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="marks_submenu" class="collapse <?php if($page_name == 'marks' || $page_name == 'mark_view')echo 'in';?>">
                
				<li class="<?php if($page_name == 'marks')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/marks">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('marks_list');?>
                  </a>
                </li>    
				
                <li class="<?php if($page_name == 'mark_view' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/view_mark_chart">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('marks_graph');?>
                  </a>
                </li>							
					
            </ul>
		</li>
		
		
		<!------attendence----->
		<li class="dark-nav <?php if($page_name == 'attendence' || $page_name == 'daily_attendence'  || $page_name == 'attendence_view' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#communication_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('attendence');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('attendence');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="communication_submenu" class="collapse <?php if($page_name == 'attendence' || $page_name == 'daily_attendence'  || $page_name == 'attendence_view')echo 'in';?>">
                
				<li class="<?php if($page_name == 'daily_attendence')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/dailyattendence">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('daily_attendence');?>
                  </a>
                </li>    
				
                <!--<li class="<?php if($page_name == 'attendence' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/attendence">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('monthly_attendence');?>
                  </a>
                </li>-->
				<!--<li class="<?php if($page_name == 'attendence_view' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/view_attendance_chart">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('monthly_attendence_graph');?>
                  </a>
                </li>-->
					
            </ul>
		</li>



        

        <!------class routine----->

		<li class="<?php if($page_name == 'class_routine')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/class_routine" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('class_routine_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('class_routine');?></span>

				</a>

		</li>

        

        

        <!------invoice----->

		<li class="<?php if($page_name == 'feecollect')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/feecollect" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('invoice_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('payment');?></span>

				</a>

		</li>

        <!------Utilities----->
		<li class="dark-nav <?php if($page_name == 'book' || $page_name == 'transport' || $page_name == 'dormitory' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#utilities_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('Utilities');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('Utilities');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="utilities_submenu" class="collapse <?php if($page_name == 'book' || $page_name == 'transport' || $page_name == 'dormitory')echo 'in';?>">
                
				<li class="<?php if($page_name == 'book')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/book">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('library');?>
                  </a>
                </li>    
				
                <li class="<?php if($page_name == 'transport' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/transport">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('transport');?>
                  </a>
                </li>	
				
				 <li class="<?php if($page_name == 'dormitory' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/dormitory">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('dormitory');?>
                  </a>
                </li>
					
            </ul>
		</li>

		 <!------assignments----->

		<li class="<?php if($page_name == 'assignments')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/assignments" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('assignments_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('assignments');?></span>

				</a>

		</li>
        

        <!------noticeboard----->

		<li class="<?php if($page_name == 'noticeboard')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/noticeboard" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('noticeboard_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('noticeboard-event');?></span>

				</a>

		</li>

        

        

		
		
		<!-- E- Books  -->

	<!--	<li class="<?php if($page_name == 'ebooks')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?student/ebooks" rel="tooltip" data-placement="right" 

                	data-original-title="<?php echo get_phrase('profile_help');?>">

					<i class="icon-plus"></i>

					<span><?php echo get_phrase('View E-Books');?></span>

				</a>

		</li>-->
<!------manage previous papers--->

		<li class="dark-nav <?php if($page_name == 'Preivious question papers' || $page_name == 'Online Test' )echo 'active';?>">
			<span class="glow"></span>
            <a class="accordion-toggle  " data-toggle="collapse" href="#knowledge_submenu" rel="tooltip" data-placement="right" 
                data-original-title="<?php echo get_phrase('knowledge');?>">
                <i class="icon-user icon-plus"></i>  
                <span><?php echo get_phrase('knowledge');?><i class="icon-caret-down"></i></span>
            </a>
            
            <ul id="knowledge_submenu" class="collapse <?php if($page_name == 'Preivious question papers' || $page_name == 'Online Test')echo 'in';?>">
                
				<li class="<?php if($page_name == 'Preivious question papers')echo 'active';?>">
					<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/questionpaper">
                  		<i class="icon-user icon-plus"></i>                  		
                    	<?php echo get_phrase('Preivious question papers');?>
                  </a>
                </li>    
				
                <li class="<?php if($page_name == 'Online Test' )echo 'active';?>">
				<span class="glow"></span>
                  <a href="<?php echo base_url();?>index.php?student/onlinetest">
                      	<i class="icon-user icon-plus"></i>                    	
						<?php echo get_phrase('online_test');?>
                  </a>
                </li>							
					
            </ul>
		</li>
	</ul>

	

</div>