	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span30">
				<!-- find me in partials/action_nav_normal -->
				<!--big normal buttons-->
				<div class="action-nav-normal">
					<div class="row-fluid">
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/marks">
							<img src="<?php echo base_url();?>template/images/icons/marks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('marks');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/attendence">
							<img src="<?php echo base_url();?>template/images/icons/attendence.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('attendance');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/view_attendance_chart">
							<img src="<?php echo base_url();?>template/images/icons/attendance_chart.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('attendance_view');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/view_mark_chart">
							<img src="<?php echo base_url();?>template/images/icons/mark_chart.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('mark_view');?></span>
							</a>
						</div>
						 <div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/teacher_contact">
							<img src="<?php echo base_url();?>template/images/icons/teacher_contact.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('teacher_contact');?>
                                                        <span class="badge badge-important parent-enquiry-badge">
                                                        <span id="ctl00_lbl_unread"><?php echo isset($count_unread_message)?$count_unread_message:'0';?></span>
                                                        </span>
                                                        </span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/class_routine">
							<img src="<?php echo base_url();?>template/images/icons/routine.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('class_routine');?></span>
							</a>
						</div>
						 </div><br />
					<div class="row-fluid">
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/invoice">
							<img src="<?php echo base_url();?>template/images/icons/payment.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('payment');?></span>
							</a>
						</div>
						 
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/dormitory">
							<img src="<?php echo base_url();?>template/images/icons/dormitory.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('dormitory');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/transport">
							<img src="<?php echo base_url();?>template/images/icons/transport.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('transport');?></span>
							</a>
						</div>
                  
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/assignments">
							<img src="<?php echo base_url();?>template/images/icons/assignment.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('assignments');?></span>
							</a>
						</div>                    		
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?parents/noticeboard">
							<img src="<?php echo base_url();?>template/images/icons/noticeboard.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('noticeboard');?></span>
							</a>
						</div>
                    </div>
				</div>
			</div>
            <!---DASHBOARD MENU BAR ENDS HERE-->
       </div><br /><br />
       
		<div class="row-fluid">
            <div class="span6">
				<div class="box tam-custom-assignments">
					<div class="box-header">
						<span class="title">
                        	<!--<i class="icon-reorder"></i>-->
                            <?php echo get_phrase('Assignments');?>
                        </span>
					</div>
					<div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                    
                    	<?php 
						
						 $assignments = $this->db->query('SELECT * FROM assignments WHERE class_id = (SELECT class_id FROM student WHERE student_id = ( SELECT student_id FROM parent WHERE student_id ='.$this->session->userdata('parent_id').' ) )')->result_array();
						
						if(!empty($assignments))
						{
						foreach($assignments as $row):
						?>
						<div class="box-section news with-icons">
							<div class="avatar">
								<!--<img src="<?php echo base_url();?>template/images/icons/notification.png" height="25px" width="25px" alt="" />-->
                                <i class="icon-list-alt"></i>
							</div>
							<div class="news-time">
								<span><?php echo date('d',$row['create_timestamp']);?></span> <?php echo date('M',$row['create_timestamp']);?>
							</div>
							<div class="news-content">
								<div class="news-title">
									<?php echo $row['assignment_title'];?>
								</div>
								<div class="news-text">
									 <?php echo $row['assignment'];?>
									<?php if(!empty($row['assignment_attachment'])) : ?>Attachment : <a href="<?php echo 'uploads/assignment_attachment/'.$row['assignment_attachment'] ?>">Download Attachment</a><?php endif; ?>
								</div>
							</div>
						</div>
						<?php
						endforeach;
						}
						else
						{
							echo '<center><div class="box-section news with-icons">No Assignments.</div></center>';
						}?>
					</div>
				</div>
			</div>
            <!---CALENDAR ENDS-->
            
            <!---TO DO LIST STARTS-->
			<div class="span6">
				<div class="box tam-custom-noticeboard">
					<div class="box-header">
						<span class="title">
                        	<!--<i class="icon-reorder"></i>-->
                            <?php echo get_phrase('noticeboard');?>
                        </span>
					</div>
					<div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                    
                    	<?php 
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
            },*/
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