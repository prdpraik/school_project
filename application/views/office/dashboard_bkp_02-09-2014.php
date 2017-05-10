	<div class="container-fluid padded">
    
    	<!--<div class="row-fulid">
        
        	<div class="span2">
            	
                	<div class="custom-tam-widjet custom-odd">
                    
                    	<div><i class="icon-user"></i></div>
                        <div>2323</div>
                    	<div>Students</div>
                        
                    </div>
            
            </div>
            <div class="span2">
            	
                	<div class="custom-tam-widjet custom-even">
                    	
                        <div><i class="icon-user"></i></div>
                        <div>0123</div>
                    	<div>Teachers</div>
                    
                    </div>
            
            </div>
            <div class="span2">
            	
                	<div class="custom-tam-widjet custom-odd">
                    	
                        <div><i class="icon-user"></i></div>
                        <div>4567</div>
                    	<div>Daily Attendence</div>
                    
                    </div>
            
            </div>
            <div class="span2">
            	
                	<div class="custom-tam-widjet custom-even">
                    
                    	<div><i class="icon-user"></i></div>
                        <div>9999</div>
                    	<div>Classes</div>
                    
                    </div>
            
            </div>
            <div class="span2">
            	
                	<div class="custom-tam-widjet custom-odd">
                    
                    	<div><i class="icon-user"></i></div>
                        <div>4747</div>
                    	<div>Books</div>
                    
                    </div>
            
            </div>
        
        </div>-->
    
    
		<div class="row-fluid">
			<div class="span30">
				<!-- find me in partials/action_nav_normal -->
				<!--big normal buttons-->
				<div class="action-nav-normal">
                	<div class="row-fulid">
                    <div class="span12">
                    	<div class="custom-tam-margin-bottom-20">
                        <h3 class="custom-tam-title">
                        <i class="icon-pushpin"></i>
                        Categories </h3>
                        </div>
                    </div>
                    </div>
					<div class="row-fluid">
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?admin/student">
                            <img src="<?php echo base_url();?>template/images/icons/user.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('manage_student');?></span>
                            
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/teacher">
							<img src="<?php echo base_url();?>template/images/icons/teacher.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('manage_teacher');?></span>
                           
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/attendence">
							<img src="<?php echo base_url();?>template/images/icons/attendence.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('attendance');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/class_routine">
							<img src="<?php echo base_url();?>template/images/icons/routine.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('class_routine');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/invoice">
							<img src="<?php echo base_url();?>template/images/icons/payment.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('payment');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/book">
							<img src="<?php echo base_url();?>template/images/icons/book.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('library');?></span>
							</a>
						</div>
                    </div><br />
                    <div class="row-fluid">
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/dormitory">
							<img src="<?php echo base_url();?>template/images/icons/dormitory.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('dormitory');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/transport">
							<img src="<?php echo base_url();?>template/images/icons/transport.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('transport');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/marks">
							<img src="<?php echo base_url();?>template/images/icons/marks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('Marks');?></span>
							</a>
						</div>
						<!--<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/system_settings">
							<img src="<?php echo base_url();?>template/images/icons/settings.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('settings');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/manage_language">
							<img src="<?php echo base_url();?>template/images/icons/language.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('language');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/backup_restore">
							<img src="<?php echo base_url();?>template/images/icons/backup.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('backup');?></span>
							</a>
						</div>-->
                        <div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/noticeboard">
							<img src="<?php echo base_url();?>template/images/icons/noticeboard.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('noticeboard');?></span>
							</a>
						</div>
						<!--<div class="span2 ">
							<a href="<?php //echo base_url();?>index.php?admin/parent">
							<img src="<?php //echo base_url();?>template/images/icons/parent.png" height="80px" width="80px"/><br />
							<span><?php //echo get_phrase('Parent');?></span>
							</a>
						</div>-->
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/sms_view">
							<img src="<?php echo base_url();?>template/images/icons/sms.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('SMS');?></span>
							</a>
						</div>

						
                                                <div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/email">
							<img src="<?php echo base_url();?>template/images/icons/mail.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('email');?></span>
							</a>
						</div>
                                                
						
					</div><br />
					
					<div class="row-fluid">
						
						
						
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/ebooks">
							<img src="<?php echo base_url();?>template/images/icons/ebooks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('E-Books Online');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/previousquestionpapers">
							<img src="<?php echo base_url();?>template/images/icons/ebooks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('Previous Question Papers');?></span>
							</a>
						</div>
						<div class="span2 ">
                            <a href="<?php echo base_url();?>index.php?admin/onlinetest">
                            <img src="<?php echo base_url();?>template/images/icons/ebooks.png" height="80px" width="80px"/><br />
                            <span><?php echo get_phrase('Online Test');?></span>
							</a>
						</div>
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/daily_attendence">
							<img src="<?php echo base_url();?>template/images/icons/attendence.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('daily attendence');?></span>
							</a>
						</div>
						
						<div class="span2 ">
							<a href="<?php echo base_url();?>index.php?admin/staffattendence">
							<img src="<?php echo base_url();?>template/images/icons/attendence.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('staff attendence ');?></span>
							</a>
						</div>
						
					</div>
                    
                   
                    <div class="row-fulid">
                    <div class="span12">
                    	<div class="custom-tam-margin-top-bottom-20">
                        <h3 class="custom-tam-title">
                        <i class="icon-pushpin"></i>
                        Categories </h3>
                        </div>
                    </div>
                    </div>
                     <div class="row-fulid custom-tam-cats">
                    <div class="span2"> <a href="<?php echo base_url();?>index.php?admin/exam"> <img src="<?php echo base_url();?>template/images/icons/exams.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('Exam');?></span> </a> </div>
                    <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/classes"> <img src="<?php echo base_url();?>template/images/icons/class.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('Class');?></span> </a> </div>
                    <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/subject"> <img src="<?php echo base_url();?>template/images/icons/subject.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('subject');?></span> </a> </div>
                    <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/employee_category"> <img src="<?php echo base_url();?>template/images/icons/Office-Customer-Male-Light-icon.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('employee_categories');?></span> </a> </div>
                    <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/departments"> <img src="<?php echo base_url();?>template/images/icons/Business-Department-icon.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('departments');?></span> </a> </div>
                   <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/book_cat"> <img src="<?php echo base_url();?>template/images/icons/Books-1-icon.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('book_categories');?></span> </a> </div>
                     
                  </div>
                  <div class="row-fulid custom-tam-cats">
                  	 <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/fees_cat"> <img src="<?php echo base_url();?>template/images/icons/Invoice-icon.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('fee_categories');?></span> </a> </div>
                      <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/timetable_category"> <img src="<?php echo base_url();?>template/images/icons/Invoice-icon.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('timetable_categories');?></span> </a> </div>
                      <div class="span2 "> <a href="<?php echo base_url();?>index.php?admin/standards"> <img src="<?php echo base_url();?>template/images/icons/class.png" height="80px" width="80px"/><br />
                      <span><?php echo get_phrase('standards');?></span> </a> </div>
                  </div>
                   
				</div>
			</div>
            <!---DASHBOARD MENU BAR ENDS HERE-->
       </div>
       
       
       
       
		<div class="row-fluid">
            <!--<div class="span6">
				<div class="box" style="border-style: solid;border-width: 3px;border-color:#1E2529">
					<div class="box-header">
						<div class="title">
                        	<i class="icon-calendar"></i>
							<?php //echo get_phrase('calendar_schedule');?>
						</div>
					</div>
					<div class="box-content">
						<div id="calendar2">
						</div>
					</div>
				</div>
			</div>-->
            <!---CALENDAR ENDS-->
            
            <!---TO DO LIST STARTS-->
			<div class="span12">
				<div class="box tam-custom-noticeboard">
					<div class="box-header">
						<span class="title">
                        	<!--<i class="icon-reorder"></i>-->
                            <?php echo get_phrase('noticeboard');?>
                        </span>
					</div>
					<div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                    
                    	<?php 
						$this->db->order_by('create_timestamp',desc);
						$notices	=	$this->db->get('noticeboard')->result_array();
						foreach($notices as $row):
						?>
						<div class="box-section news with-icons">
							<div class="avatar">
								<!--<img src="<?php echo base_url();?>template/images/icons/notification.png" height="25px" width="25px" alt="" />-->
                                <i class="icon-bullhorn"></i>
                                
							</div>
							<div class="news-time">
								<span><?php echo date('d',$row['create_timestamp']);?></span> <?php echo date('M',$row['create_timestamp']);?>
							</div>
							<div class="news-content">
								<div class="news-title">
									<?php echo $row['notice_title'];?>
								</div>
								<div class="news-text">
									 <?php echo $row['notice'];?>
								</div>
							</div>
						</div>
						<?php endforeach;?>
					</div>
				</div>
			</div>
            <!---TO DO LIST ENDS-->
       </div>
   </div>
   
  
  <script>
  $(document).ready(function() {

    // page is now ready, initialize the calendar...

    $("#calendar2").fullCalendar({
            header: {
                left: "prev,next",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            editable: 0,
            droppable: 0,
            /*drop: function (e, t) {
                var n, r;
                r = $(this).data("eventObject"), n = $.extend({}, r), n.start = e, n.allDay = t, $("#calendar").fullCalendar("renderEvent", n, !0);
                if ($("#drop-remove").is(":checked")) return $(this).remove()
            },
			
			nulled by Vokey*/
            events: [
			<?php 
			$notices	=	$this->db->get('noticeboard')->result_array();
			foreach($notices as $row):
			?>
			{
                title: "<?php echo $row['notice_title'];?>",
                start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
				end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>) 
            },
			<?php 
			endforeach
			?>
			]
        })

});
  </script>