<?php //print_r($departments) ?>

<div class="box">
	<div class="box-header">
    
    	<!------CONTROL TABS START------->
		<ul class="nav nav-tabs nav-tabs-left">
        <li class="active"> <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> <?php echo get_phrase('teacher_list');?> </a></li>
        <li> <a href="#add" data-toggle="tab"><i class="icon-plus"></i> <?php echo get_phrase('add_teaching_staff');?> </a></li>
        <li> <a href="#addnontech" data-toggle="tab"><i class="icon-plus"></i> <?php echo get_phrase('add_non_teaching_staff');?> </a></li>
      </ul>
    	<!------CONTROL TABS END------->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!----TABLE LISTING STARTS--->
            <div class="tab-pane  active" id="list">
            		<div class="action-nav-normal">
                        <div class="" style="width:300px;margin-left:33%;">
                          <a href="#" title="Users">
                            <img src="<?php echo base_url();?>template/images/icons/teacher.png" /><br>
                            <span>Total <?php echo count($teachers);?> teachers</span>
                          </a>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-content">
                            <div id="dataTables">
                            <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive">
                                <thead>
                                    <tr>
                                        <th><div><?php echo get_phrase('employee_code');?></div></th>
                                        <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                                        <th><div><?php echo get_phrase('teacher_name');?></div></th>
                                        <th><div><?php echo get_phrase('department');?></div></th>
                                        <th><div><?php echo get_phrase('tam username');?></div></th>
                                        <th><div><?php echo get_phrase('options');?></div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1;foreach($teachers as $row):?>
                                    <tr>
                                        <td><?php echo $row['employee_code'];?></td>
                                        <td><div class="avatar"><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="avatar-medium" /></div></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['dname'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td align="center">
                                            <a data-toggle="modal" href="#modal-form" onclick="modal('teacher_profile',<?php echo $row['teacher_id'];?>)"
                                                 class="btn btn-green btn-small">
                                                    <i class="icon-user"></i> <?php echo get_phrase('profile');?>
                                            </a>
                                            <a data-toggle="modal" href="#modal-form" onclick="modal('edit_teacher',<?php echo $row['teacher_id'];?>)"	class="btn btn-gray btn-small">
                                                    <i class="icon-wrench"></i> <?php echo get_phrase('edit');?>
                                            </a>
                                            <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/teacher/delete/<?php echo $row['teacher_id'];?>')"
                                                 class="btn btn-red btn-small">
                                                    <i class="icon-trash"></i> <?php echo get_phrase('delete');?>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/teacher/create' , array('class' => 'form-horizontal validatable','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?admin/teacher/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="firstname" placeholder="First Name"/>
                                    <input type="text" class="validate[required]" name="lastname" placeholder="Last Name" />
                                </div>
                            </div>
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('employee_code');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="employee_code" placeholder="Employee Code"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('department');?></label>
                                <div class="controls">
                                    <select class="uniform validate[required]" name="employee_department_id">
                                    <option value="">-- Select Department --</option> 
                                    <?php foreach($departments as $departments_list){ ?>
											<option value="<?php echo $departments_list['department_id']  ?>"><?php echo $departments_list['department_name']  ?></option> 
									 <?php }?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('gender');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male"><?php echo get_phrase('male');?></option>
                                        <option value="female"><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birthday');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="birthday" placeholder="Birthday"/>
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('religion/cast'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="religion" placeholder="Religion" />
                                    <input type="text" class="validate[required]" name="cast" placeholder="Cast" />
                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('tam_username'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="email" placeholder="Tam Username"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('tam_password'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="password" placeholder="Tam Password"/>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('blood_group'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="blood_group" placeholder="Blood Group"/>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('subject'); ?></label>

                                <div class="controls">

                                    <textarea name="subject" class="validate[required]" rows="6" columns="4" placeholder="Subject"></textarea>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('previous_school_name'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="previous_school_name" placeholder="Previous School Name"/>

                                </div>

                            </div>
                            <!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="password"/>
                                </div>
                            </div>
                            -->
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('present_address'); ?></label>

                                <div class="controls">

                                    <textarea name="address" class="validate[required]" rows="6" columns="4" placeholder="Present Address"></textarea>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('permanent_address'); ?></label>

                                <div class="controls">

                                    <textarea name="permanent_address" class="validate[required]" rows="6" columns="4" placeholder="Permanent Address"></textarea>
                                    
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="phone" placeholder="Phone"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('teacher email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="teacher_email" placeholder="Teacher Email"/>
                                </div>
                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('father\husband\guardian name'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="father_first_name" placeholder="First Name"/>
                                    <input type="text" class="validate[required]" name="father_last_name" placeholder="Last Name" />

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('father\husband\guardian mobile number'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="father_mobile_number" placeholder="Father Mobile Number"/>
                                
                                </div>

                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('photo');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="validate[required]" name="userfile" id="imgInp" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls" style="width:210px;">
                                    <img id="blah" src="<?php echo base_url();?>uploads/user.jpg" alt="your image" height="100" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_teacher');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
            
            
            
            <!----CREATION NON Teaching FORM STARTS---->
			<div class="tab-pane box" id="addnontech" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open('admin/teacher/create' , array('class' => 'form-horizontal validatable','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    <form method="post" action="<?php echo base_url();?>index.php?admin/teacher/create/" class="form-horizontal validatable" enctype="multipart/form-data">
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="firstname" placeholder="First Name"/>
                                    <input type="text" class="validate[required]" name="lastname" placeholder="Last Name" />
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('gender');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male"><?php echo get_phrase('male');?></option>
                                        <option value="female"><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('birthday');?></label>
                                <div class="controls">
                                    <input type="text" class="datepicker fill-up" name="birthday" placeholder="Birthday"/>
                                </div>
                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('religion/cast'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="religion" placeholder="Religion" />
                                    <input type="text" class="validate[required]" name="cast" placeholder="Cast" />
                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('tam_username'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="email" placeholder="Tam Username"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('tam_password'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="password" placeholder="Tam Password"/>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('blood_group'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="blood_group" placeholder="Blood Group"/>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('subject'); ?></label>

                                <div class="controls">

                                    <textarea name="subject" class="validate[required]" rows="6" columns="4" placeholder="Subject"></textarea>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('previous_school_name'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="previous_school_name" placeholder="Previous School Name"/>

                                </div>

                            </div>
                            <!--<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="password"/>
                                </div>
                            </div>
                            -->
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('present_address'); ?></label>

                                <div class="controls">

                                    <textarea name="address" class="validate[required]" rows="6" columns="4" placeholder="Present Address"></textarea>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('permanent_address'); ?></label>

                                <div class="controls">

                                    <textarea name="permanent_address" class="validate[required]" rows="6" columns="4" placeholder="Permanent Address"></textarea>
                                    
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="phone" placeholder="Phone"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('teacher email');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="teacher_email" placeholder="Teacher Email"/>
                                </div>
                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('father\husband\guardian name'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="father_first_name" placeholder="First Name"/>
                                    <input type="text" class="validate[required]" name="father_last_name" placeholder="Last Name" />

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('father\husband\guardian mobile number'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="father_mobile_number" placeholder="Father Mobile Number"/>
                                
                                </div>

                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('photo');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="validate[required]" name="userfile" id="imgInp" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls" style="width:210px;">
                                    <img id="blah" src="<?php echo base_url();?>uploads/user.jpg" alt="your image" height="100" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('add_teacher');?></button>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION NON Teaching FORM ENDS--->
            
            
            
            
		</div>
	</div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>