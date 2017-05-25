<div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
				<?php foreach($edit_data as $row):?>
                	<?php echo form_open('admin/student/'.$class_id.'/do_update/'.$row['student_id'] , array('class' => 'form-horizontal validatable','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"></label>
                                <div class="controls" style="width:210px;">
                                    <div class="avatar">
                                        <img id="blah" class="avatar-large" src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" height="100"  />
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('photo');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="" name="userfile" id="imgInp" />
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('class');?></label>
                                <div class="controls">
                                    <select name="class_id_non" id="" class="uniform" style="width:100%;" disabled="disabled">
                                        <?php 
                                        $classes = $this->db->get('class')->result_array();
                                        foreach($classes as $row2):
                                        ?>
                                            <option value="<?php echo $row2['class_id'];?>"
                                                <?php if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                                    <?php echo $row2['name'].'-'.$row2['name_numeric']; ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>" id="student_class_id"  />
                                </div>
                            </div>
			
								<div class="control-group">
                                	 <label class="control-label"><?php echo get_phrase('academic_year'); ?></label>
								<div class="controls">
									
                                    <select class="uniform validate[required]" name="student_academicyear_id">
                                    <option value="">&nbsp;&nbsp;&nbsp;-- Academic Year --</option> 
                                    <?php foreach($academicyear as $departments_list){ ?>
											<option value="<?php echo $departments_list['academic_id']  ?>" <?php if($row['student_academicyear_id']==$departments_list['academic_id']){ echo 'SELECTED';} ?>><?php echo $departments_list['session_name']  ?></option> 
									 <?php }?>
                                    </select>

                                </div>
								
                            </div>
							
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('admission_number'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="admission_number" id="admission_number"  value="<?php echo $row['admission_number']; ?>" />
									<span id=""></span>
                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('roll'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="roll" id="student_roll_val" value="<?php echo $row['roll'];?>"/>
									<input type="hidden" id="student_roll_val_hid" value="<?php echo $row['roll'];?>" />
                                    
                                    <span id="val_roll_img"></span>
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required]" name="name" value="<?php echo $row['name'];?>"/>

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('gender');?></label>
                                <div class="controls">
                                    <select name="sex" class="uniform" style="width:100%;">
                                        <option value="male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo get_phrase('male');?></option>
                                        <option value="female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo get_phrase('female');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('father_name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="father_name" value="<?php echo $row['father_name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('mother_name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="mother_name" value="<?php echo $row['mother_name'];?>"/>
                                </div>
                            </div>
							<?php /*
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('date_of_birth');?></label>
                                <div class="controls">
                                    <!--<input type="text" class="datepicker fill-up" name="birthday" value="<?php echo $row['birthday'];?>"/>-->
                                    
                                    <?php $birthday = explode("-",$row['birthday']); ?>
                                    <select name="birth_day" id="birth_day"  style="width:80px;" class="validate[required] uniform">
                                    <option value="">Day</option>
                                    <?php
                                    $strDay='';
                                    for ($i=1; $i<=31; $i++) {
                                    $strDay=(string)$i;
                                    if($i<10) $strDay='0'.$strDay;
                                    ?>
                                    <option value="<?php echo $strDay; ?>" <?php if($birthday[2] == $strDay) echo "selected" ?>>
                                    <?php echo $strDay; ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <select name="birth_month" id="birth_month"  style="width:100px;" class="validate[required] uniform">
                                    <option value="">Month</option>
                                    <?php
                                    function getMonthList()
                                    {
                                    return array( "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct",
                                    "Nov", "Dec");
                                    }
                                    $list=getMonthList();
                                    $index=1;
                                    foreach ( $list as &$row_data ) {
                                    ?>
                                    <option value="<?php  if($index < 10 ? $index = '0'.$index : $index );  echo $index  ?>" <?php if($birthday[1] == $index) echo "selected" ?>>
                                    <?php echo $row_data; ?>
                                    </option>
                                    <?php
                                    $index=$index+1;
                                    }
                                    ?>
                                    </select>
                                    
                                    <select name="birth_year" id="birth_year" style="width:80px;" class="validate[required] uniform">
                                    <option value="">Year</option>
                                    <?php
                                    for ($i=1950; $i<=date('Y'); $i++) {
                                    ?>
                                    <option value="<?php echo $i; ?>" <?php if($birthday[0] == $i) echo "selected" ?>>
                                    <?php echo $i; ?>
                                    </option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    
                                </div>
                            </div> */?>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('Date of Joining'); ?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up validate[required]" name="doj" value="<?php echo $row['doj'];?>"/>

                                </div>

                            </div>
							<?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('birth_place'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="birth_place" value="<?php echo $row['birth_place'];?>" />

                                </div>

                            </div> */?> 
                            <!--<div class="control-group">

                                <label class="control-label"><?php echo get_phrase('blood_group'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="blood_group" value="<?php echo $row['blood_group'];?>" />

                                </div>

                            </div>-->
                            <!--<div class="control-group">

                                <label class="control-label"><?php echo get_phrase('height'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="height"  value="<?php echo $row['height'];?>" />

                                </div>

                            </div>-->
                            
                            <!-- <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('weight'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="weight" value="<?php echo $row['weight'];?>" />

                                </div>

                            </div>-->
                            <!--<div class="control-group">

                                <label class="control-label"><?php //echo get_phrase('religion'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="religion" value="<?php //echo $row['religion'];?>" />
                                </div>

                            </div>-->
                            <!--<div class="control-group">

                                <label class="control-label"><?php //echo get_phrase('cast'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="cast" value="<?php //echo $row['cast'];?>" />
                                </div>

                            </div>-->
							<?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('nationality'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="nationality" value="<?php echo $row['nationality'];?>"/>

                                </div>

                            </div>
							*/?>
                            <!--<div class="control-group">

                                <label class="control-label"><?php echo get_phrase('student_qatar_id'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="student_qatar_id" value="<?php echo $row['student_qatar_id'];?>"/>

                                </div>

                            </div>-->
							<!--<div class="control-group">
                                	 <label class="control-label"><?php //echo get_phrase('country'); ?></label>
								<div class="controls">
									
                                    <select class="uniform validate[required]" name="country_id">
                                    <option value="">------ Select Country ----</option> 
                                    <?php //foreach($country_data as $country_data_view){ ?>
											<option value="<?php //echo $country_data_view['country_id']  ?>" <?php //if($country_data_view['country_id'] == $row['student_cid'] ) echo "selected" ?>><?php //echo $country_data_view['name']  ?></option> 
									 <?php //}?>
                                    </select>

                                </div>
								
                            </div>-->
							<!--
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('passport_number'); ?></label>

                                <div class="controls">

                                    <input type="text" class="fill-up validate[required]" name="passport_number" value="<?php echo $row['passport_number'];?>"/>

                                </div>

                            </div>
                            
                             <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('date_of_issue'); ?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up validate[required]" name="date_of_issue"  value="<?php echo $row['date_of_issue'];?>"/>

                                </div>

                            </div>
                            
                             <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('date_of_expiry'); ?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up validate[required]" name="date_of_expiry" value="<?php echo $row['date_of_expiry'];?>"/>

                                </div>

                            </div>-->
                            <!--<div class="control-group">

                                <label class="control-label"><?php //echo get_phrase('username'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="email" value="<?php //echo $row['email'];?>" id="student_email_val"/>
                                    <input type="hidden" name="hid_email" value="<?php //echo $row['email'];?>" id="student_hid_email_val"/>
									<span id="val_img"></span>
                                </div>

                            </div>-->

                            <!--<div class="control-group">

                                <label class="control-label"><?php //echo get_phrase('password'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="password" value="<?php //echo $row['password'];?>"/>

                                </div>

                            </div>-->

                           <!-- <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('parent_TAM_username'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="parent_email" value="<?php echo $row['parent_email'];?>"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('parent_TAM_password'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="parent_password" value="<?php echo $row['parent_password'];?>"/>

                                </div>

                            </div>-->

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('parent_phone1'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="parent_phone1" value="<?php echo $row['parent_phone1'];?>"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('parent_phone2'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="parent_phone2" value="<?php echo $row['parent_phone2'];?>"/>

                                </div>

                            </div>

                            <!--<div class="control-group">

                                <label class="control-label"><?php echo get_phrase('parent_email'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="student_parent_email" value="<?php echo $row['student_parent_email'];?>"/>

                                </div>

                            </div>-->
                           <!-- <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('father_qatar_id'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="father_qatar_id" value="<?php echo $row['father_qatar_id'];?>"/>

                                </div>

                            </div>
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('mother_qatar_id'); ?></label>

                                <div class="controls">

                                    <input type="text" class="validate[required]" name="mother_qatar_id" value="<?php echo $row['mother_qatar_id'];?>"/>

                                </div>

                            </div>-->
                            <!--<div class="control-group">
                                	 <label class="control-label"><?php //echo get_phrase('father_country'); ?></label>
								<div class="controls">
									
                                    <select class="uniform validate[required]" name="father_country_id">
                                    <?php //foreach($country_data as $country_data_view){ ?>
											<option value="<?php //echo $country_data_view['country_id']  ?>" <?php //if($country_data_view['country_id'] == $row['father_cid'] ) echo "selected" ?>><?php //echo $country_data_view['name']  ?></option> 
									 <?php //}?>
                                    </select>

                                </div>
								
                            </div>-->
                            <!--<div class="control-group">
                                	 <label class="control-label"><?php //echo get_phrase('mother_country'); ?></label>
								<div class="controls">
									
                                    <select class="uniform validate[required]" name="mother_country_id">
                                    <option value="">------ Select Country ----</option> 
                                    <?php //foreach($country_data as $country_data_view){ ?>
											<option value="<?php //echo $country_data_view['country_id']  ?>"  <?php //if($country_data_view['country_id'] == $row['mother_cid'] ) echo "selected" ?>><?php //echo $country_data_view['name']  ?></option> 
									 <?php //}?>
                                    </select>

                                </div>
								
                            </div>-->
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('present_address'); ?></label>

                                <div class="controls">

                                    <textarea name="address" rows="6" columns="4"><?php echo $row['address'];?></textarea>

                                </div>

                            </div>
							<?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('permanent_address'); ?></label>

                                <div class="controls">

                                    <textarea name="permanent_address" rows="6" columns="4"><?php echo $row['permanent_address'];?></textarea>
                                    
                                </div>

                            </div> */?>
                            <?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('previous_school_name'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="previous_school_name" value="<?php echo $row['previous_school_name'];?>"/>

                                </div>

                            </div> */?>

                            
<?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('occupation'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="occupation" value="<?php echo $row['occupation'];?>"/>            

                                </div>                              

                            </div> */?>
<?php /*
                            <div class="control-group">

                                <label class="control-label"><?php echo get_phrase('income(per Annum)'); ?></label>

                                <div class="controls">

                                    <input type="text" class="" name="income_per_annum" value="<?php echo $row['income_per_annum'];?>"/>

                                </div>                              

                            </div> */ ?>
										<!---------------------------------------->
							 	<div class="control-group">
								
                                <label class="control-label">RTE</label>
										<div class="controls">
										<label class="radio inline">
											<input type="radio" name="rte" id="rte_yes" value="1"  <?php if($row['rte']==1){ echo "checked"; } ?>> Yes
										</label>
										<label class="radio inline">
										<input type="radio" name="rte" id="rte_no" value="0" <?php if($row['rte']==0){ echo "checked"; } ?>> No
										</label>
										</div>
                                </div>
							<!----------------------------------------->
							<!---------------------------------------->
							 	<div class="control-group">
								
                                <label class="control-label">Student category</label>
										<div class="controls">
										<label class="radio inline">
											<input type="radio" name="student_category" id="student_category_0" value="0"  <?php if($row['student_category']==0){ echo "checked"; } ?>> Genral
										</label>
										<label class="radio inline">
										<input type="radio" name="student_category" id="student_category_1" value="1" <?php if($row['student_category']==1){ echo "checked"; } ?>> Staff
										</label>
										</div>
                                </div>
							<!----------------------------------------->
							
							
							<!---------------------------------------->
							 	<div class="control-group">
									<label class="control-label">Aadhaar Number</label>
									<div class="controls">
										<input type="text" class="" name="aadhaar_number" value="<?php echo $row['aadhaar_number'];?>"/>            
									</div> 
                                </div>
							<!----------------------------------------->
							
							
                            <!--
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('address');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('phone');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('email');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('password');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="password" value="<?php echo $row['password'];?>"/>
                                </div>
                            </div>
                             
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('parent_email');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="parent_email" value="<?php echo $row['parent_email'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('parent_password');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="parent_password" value="<?php echo $row['parent_password'];?>"/>
                                </div>
                            </div>                          
                            
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('roll');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="roll" value="<?php echo $row['roll'];?>"/>
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_student');?></button>
                        </div>
                    </form>
                    <?php endforeach;?>
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
	
	
	
		$('#student_email_val').on('change',function(){
			
		
		var semail = $(this).val();
		var prvemail = $('#student_hid_email_val').val();
		
		 if (!validateEmail(semail)) {
			$("#val_img").removeAttr("class"); 
			$("#val_img").attr("class","label label-warning");
			$("#val_img").text('');
            $("#val_img" ).text('Please enter valid email!');
			$("#student_email_val").val(prvemail);
			$("#student_email_val").focus();
			return false;
        }
		
		$('#val_img').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
		
		$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/sdtemailcheck/',
							data: { chkmail:semail , prevmail : prvemail },
							success: function(data) {
								//alert(data);
								
								if(data=='true'){
									if(prvemail==''){
									$("#student_email_val").val('');
									} else {
										$("#student_email_val").val(prvemail);
									}

									
									$("#val_img").text('');
									//$("#student_email_val").val('');
									$("#student_email_val").focus();
									$("#val_img").attr("class","label label-warning");
									$("#val_img" ).text( "'"+ semail +" ' already register try another !" );
								} else {
									$("#val_img").removeAttr("class");
									$('#val_img').text('');
									$("#val_img").attr("class","label label-success");
									$("#val_img" ).text( "'"+ semail +" ' available !" );
								}
								
							}
				  });
		
	});
	
	
	
	
// Function that validates email address through a regular expression.
function validateEmail(sEmail) {
	  var filter =  /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    
   if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

	
	
	$('#student_roll_val').on('change',function(){
		
		var sroll = $(this).val();
		
		var psroll = $('#student_roll_val_hid').val();
		
		var sclass = $('#student_class_id').val();
		
		if(sroll!=''){
		
		$('#val_roll_img').removeAttr("class").text('').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
		
		$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/sdtrollcheck/',
							data: { chkroll:sroll,prvroll:psroll, chkrollcls:sclass},
							success: function(data) {
								//alert(data);
								
								if(data=='true'){
									$("#val_roll_img").text('').attr("class","label label-warning").text( "Roll no '"+ sroll +" ' already exists try another !" );
									$("#student_roll_val").val(psroll).focus();
									
								} else {
									$("#val_roll_img").removeAttr("class").text('').attr("class","label label-success").text( "Roll no '"+ sroll +" ' available !" );
									
								}
								
							}
				  });
				  
		} else {
			$('#val_roll_img').removeAttr("class").text('');
		}
		
		
	});
	
	
</script>