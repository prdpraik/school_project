	<div class="container-fluid padded">
		<div class="row-fluid">
			<div class="span30">
				<!-- find me in partials/action_nav_normal -->
				<!--big normal buttons-->
				<div class="action-nav-normal">
					<div class="row-fluid">
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/marks">
							<img src="<?php echo base_url();?>template/images/icons/marks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('marks');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/view_attendance_chart">
							<img src="<?php echo base_url();?>template/images/icons/attendance_chart.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('attendance_view');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/view_mark_chart">
							<img src="<?php echo base_url();?>template/images/icons/mark_chart.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('mark_view');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/subject">
							<img src="<?php echo base_url();?>template/images/icons/subject.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('subject');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/class_routine">
							<img src="<?php echo base_url();?>template/images/icons/routine.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('class_routine');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/invoice">
							<img src="<?php echo base_url();?>template/images/icons/payment.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('payment');?></span>
							</a>
						</div><br />
						</div>
                    <div class="row-fluid">
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/book">
							<img src="<?php echo base_url();?>template/images/icons/book.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('library');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/dormitory">
							<img src="<?php echo base_url();?>template/images/icons/dormitory.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('dormitory');?></span>
							</a>
						</div>
                    
					    <div class="span2">
							<a href="<?php echo base_url();?>index.php?student/attendence">
							<img src="<?php echo base_url();?>template/images/icons/attendence.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('attendance');?></span>
							</a>
						</div>
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/transport">
							<img src="<?php echo base_url();?>template/images/icons/transport.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('transport');?></span>
							</a>
						</div>
						
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/assignments">
							<img src="<?php echo base_url();?>template/images/icons/assignment.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('assignments');?></span>
							</a>
						</div>
						
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/noticeboard">
							<img src="<?php echo base_url();?>template/images/icons/noticeboard.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('noticeboard');?></span>
							</a>
						</div>
						
					</div>
                    <div class="row-fulid">
                    	<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/tasks">
							<img src="<?php echo base_url();?>template/images/icons/Folder-Scheduled-Tasks-icon.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('tasks');?></span>
							</a>
						</div>
						
						<div class="span2">
							<a href="<?php echo base_url();?>index.php?student/questionpaper">
							<img src="<?php echo base_url();?>template/images/icons/ebooks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('Previous Question Papers');?></span>
							</a>
						</div>
                        <div class="span2">
							<a href="<?php echo base_url();?>index.php?student/onlinetest">
							<img src="<?php echo base_url();?>template/images/icons/ebooks.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('Online Test');?></span>
							</a>
						</div>
                        <div class="span2">
							<a href="<?php echo base_url();?>index.php?student/placements">
							<img src="<?php echo base_url();?>template/images/icons/placements.png" height="80px" width="80px"/><br />
							<span><?php echo get_phrase('placements');?></span>
							</a>
						</div>
                    </div>
				</div>
			</div>
            <!---DASHBOARD MENU BAR ENDS HERE-->
       </div><br><br />
       
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
						$this->db->where('class_id',$this->session->userdata('class_id'));
						$assignments	=	$this->db->get('assignments')->result_array();
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
									<?php echo $row['assignment_title']; ?>
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
			<!---TO DO Pollings -->
			<?php //if(!empty($this->session->userdata('standard'))):?>
			 <div class="span6">
				<div class="box tam-custom-assignments">
					<div class="box-header">
						<span class="title">
                        	<!--<i class="icon-reorder"></i>-->
                            <?php echo get_phrase('Polling');?>
                        </span>
					</div>
					<div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">
                    
                    <div  class="news-title" style="margin-bottom:15px;">Question</div>
					<div><div style="float:left;width:50%;" class="news-text" >sdfaasf</div><div style="float:left;width:50%;" class="news-text" >sdfaasf</div></div>
					</div>
				</div>
			</div>
			<?php //endif; ?>
			<!---TO DO Pollings ENDS-->
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