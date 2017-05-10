<div class="box">
	<div class="box-header">
    
    	<!-- CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('dormitory_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>
					<?php echo get_phrase('add_dormitory');?>
                    	</a></li>
           <li>
                <a href="#rooms_list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo get_phrase('rooms_list');?>
                        </a></li>
            <li>
                <a href="#add_room" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('add_room');?>
                        </a></li>
            <li>
                <a href="#add_student" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo get_phrase('add_student');?>
                        </a></li>
		</ul>
    	<!-- CONTROL TABS END -->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!-- TABLE LISTING STARTS -->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('dormitory_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_room');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($dormitories as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['number_of_room'];?></td>
							<td><?php echo $row['description'];?></td>
							<td align="center">
                                <a  data-toggle="modal" href="#modal-form" onclick="modal('dormitory_profile',<?php echo $row['dormitory_id']; ?>)" class="btn btn-lightblue btn-small">

                                    <i class="icon-user"></i> <?php echo get_phrase('view'); ?>

                                </a>
                            	<a data-toggle="modal" href="#modal-form" onclick="modal('edit_dormitory',<?php echo $row['dormitory_id'];?>)" class="btn btn-gray btn-small">
                                		<i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                </a>
                            	<a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/dormitory/delete/<?php echo $row['dormitory_id'];?>')" class="btn btn-red btn-small">
                                		<i class="icon-trash"></i> <?php echo get_phrase('delete');?>
                                </a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!-- TABLE LISTING ENDS -->
            
            
			<!-- CREATION FORM STARTS -->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/dormitory/create' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('dormitory_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" placeholder="Dormitory Name" name="name"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('number_of_rooms');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" placeholder="No of Rooms" name="number_of_room"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" placeholder="Description" name="description"/>
                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_dormitory');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!-- CREATION FORM ENDS -->

            <!-- TABLE LISTING STARTS -->
            <div class="tab-pane box" id="rooms_list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('dormitory_name');?></div></th>
                            <th><div><?php echo get_phrase('room_name');?></div></th>
                            <th><div><?php echo get_phrase('max_students');?></div></th>
                            <th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;foreach($rooms as $row):?>
                        <?php $dormitory_details = $this->db->get_where('dormitory', array(
                        'dormitory_id' => $row['dormitory_id']
                    ))->result_array();?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $dormitory_details[0]['name'];?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['max_students'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td align="center">
                                
                                <a data-toggle="modal" href="#modal-form" onclick="modal('edit_room',<?php echo $row['room_id'];?>)" class="btn btn-gray btn-small">
                                        <i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                </a>
                                <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/dormitory/delete_room/<?php echo $row['room_id'];?>')" class="btn btn-red btn-small">
                                        <i class="icon-trash"></i> <?php echo get_phrase('delete');?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- TABLE LISTING ENDS -->

            <!-- CREATION ROOM FORM STARTS -->
            <div class="tab-pane box" id="add_room" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/dormitory/create_room' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('dormitory_name'); ?></label>

                                <div class="controls">

                                    <select name="dormitory_id" class="uniform" style="width:100%;">

                                        <?php
                                            $dormitories = $this->db->get('dormitory')->result_array();

                                            foreach ($dormitories as $row):
                                        ?>

                                            <option value="<?php echo $row['dormitory_id']; ?>">

                                                <?php echo $row['name']; ?>

                                            </option>

                                            <?php  endforeach; ?>
                                    </select>

                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('room_name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" placeholder="Room Name" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('max_students');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" placeholder="Maximum students allowed" name="max_students"/>
                                </div>
                            </div>                        
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('description');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required" placeholder="Description" name="description"/>
                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_room');?></button>
                        </div>
                    </form>                
                </div>                
            </div>
            <!-- CREATION FORM ENDS -->

            <!-- Assigning Student FORM STARTS -->
            <div class="tab-pane box" id="add_student" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/dormitory/assign_student' , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        <div class="padded">
                        
                        	<div class="control-group">

                                <label class="control-label"><?php echo get_phrase('dormitory_name'); ?></label>

                                <div class="controls">

                                    <select name="dormitory_id" class="uniform" style="width:100%;" id="dormitory_id">
                                            <option value=""><?php echo get_phrase('select_a_dormitory');?></option>
                                        <?php
                                            $dormitories = $this->db->get('dormitory')->result_array();

                                            foreach ($dormitories as $row):
                                        ?>

                                            <option value="<?php echo $row['dormitory_id']; ?>">

                                                <?php echo $row['name']; ?>

                                            </option>

                                            <?php  endforeach; ?>
                                    </select>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('room_number'); ?></label>

                                <div class="controls">

                                    <!--SELECT Room ACCORDING TO SELECTED Dormitory -->

                                    <?php 

                                        $dormitories    =   $this->crud_model->get_dormitories(); 

                                        foreach($dormitories as $row):

                                    ?>
                                    <select name="temp" id="room_id_<?php echo $row['dormitory_id'];?>" style="display: none;" class="room_id">

                                  

                                    <option value="">Room of dormitory <?php echo $row['name'];?></option>
                                    <?php 

                                        $rooms   =   $this->crud_model->get_rooms_by_dormitory($row['dormitory_id']); 

                                        foreach($rooms as $row2): 
                                    ?>                                    
                       
                                    <option value="<?php echo $row2['room_id'];?>"

                                        <?php if(isset($room_id) && $room_id == $row2['room_id'])

                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>

                                    </option>


                                    <?php endforeach; ?> 
                                    </select> 

                                    <?php endforeach;?>
                                    <select name="temp" id="room_id_0" 

                                        style="display:<?php if(isset($room_id) && $room_id >0)echo 'none';else echo 'block';?>;" class="room_id" style="float:left;">

                                        <option value="">Select a dormitory first</option>

                                    </select>
                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('student_class'); ?></label>

                                <div class="controls">

                                    <select name="class_id" class="uniform" id="class_id" style="width:100%;">

                                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                                        <?php
                                            $classes = $this->db->get('class')->result_array();

                                            foreach ($classes as $row):
                                        ?>

                                            <option value="<?php echo $row['class_id']; ?>">

                                                Class <?php echo $row['name']; ?>

                                            </option>

                                            <?php  endforeach; ?>

                                    </select>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('student_name'); ?></label>

                                <div class="controls">

                                    <!--SELECT Student ACCORDING TO SELECTED CLASS -->

                                    <?php 

                                        $classes    =   $this->crud_model->get_classes(); 

                                        foreach($classes as $row):

                                    ?>
                                    <select name="temp" id="student_id_<?php echo $row['class_id'];?>" style="display: none;" class="student_id">

                                  

                                    <option value="">Student of class <?php echo $row['name'];?></option>
                                    <?php 

                                        $students   =   $this->crud_model->get_students_by_class($row['class_id']); 

                                        foreach($students as $row2): 
                                    ?>                                    
                       
                                    <option value="<?php echo $row2['student_id'];?>"

                                        <?php if(isset($student_id) && $student_id == $row2['student_id'])

                                                echo 'selected="selected"';?>><?php echo $row2['name'];?>

                                    </option>


                                    <?php endforeach; ?> 
                                    </select> 

                                    <?php endforeach;?>
                                    <select name="temp" id="student_id_0" 

                                        style="display:<?php if(isset($subject_id) && $subject_id >0)echo 'none';else echo 'block';?>;" class="student_id" style="float:left;">

                                        <option value="">Select a class first</option>

                                    </select>
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('hostel_number');?></label>
                                <div class="controls">
                                    <input type="text" name="hostel_number"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('hostel_fees');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="hostel_fees"/>
                                </div>

                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_student');?></button>
                        </div>
                    </form>                
                </div>                
            </div>
            <!-- Assigning Student FORM ENDS -->
		</div>
	</div>
</div>
<script type="text/javascript">

  $(document).ready(function()
    {
        
        $('#class_id').change(function(){


            var class_id = $('#class_id').val();
            if(class_id != '' && class_id != 0)
            {
                var student_id  = '#student_id_'+class_id;
                $('.student_id').css('display','none').attr('name','temp');
                $(student_id).css('display','block').attr('name','student_id');
                $('#student_id_0').css('display','none');
            }
        });
        
        $('#dormitory_id').change(function(){


            var dormitory_id = $('#dormitory_id').val();
            if(dormitory_id != '' && dormitory_id != 0)
            {
                var room_id  = '#room_id_'+dormitory_id;
                $('.room_id').css('display','none').attr('name','temp');
                $(room_id).css('display','block').attr('name','dormitory_room_number');
                $('#room_id_0').css('display','none');
            }
        });
  });

</script> 