<div class="box">
	<div class="box-content padded">
    
    	<div class="row-fluid">
        
        		<div class="span12">
                		<div class="custom-tam-hr-frm">
                       
                        <div class="control-group">
                        <label class="control-label" for="fee_collect_class_id"><?php echo get_phrase('class');?></label>
                        <div class="controls">
                        	<select name="fee_collect_class_id" id="fee_collect_class_id" class="span4 validate[required]" >
                            	<option value="">--- select class ---</option>
                               	
                                <?php if(!empty($class_data)) { foreach($class_data as $class_data_view){ ?>
                              	
                                	<option value="<?php echo $class_data_view->class_id ?>"><?php echo $class_data_view->name ?></option>
                                
                                <?php } } ?>
                                
                            </select>
                            <span id="val_fc_class_id"></span>
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('student');?></label>
                        <div class="controls">
                        	<select name="fee_collect_roll" id="fee_collect_roll" class="span4 validate[required]" >
                            	<option value="">--- select class first---</option>
                            </select>
                            
                        </div>
                        </div>
                        
                       
                        </div>
                
                </div>
        
        </div>
        
        <div class="row-fluid">
        
        		<div class="span12">
                
                	<div id="custom-fee-collect-data">
                    
                    
                    </div>
                
                </div>
                
        </div>
        
        
		
	</div>
</div>

<script>

$('#fee_collect_class_id').on('change',function(){
	
	var fcollect_cid = $(this).val();
	
	
	$('#val_fc_class_id').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
	
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_collect_get_student/',
							data: { get_fcollect_cid:fcollect_cid },
							success: function(data) {
								//alert(data);
								
								$('#val_fc_class_id').text('');
									
								$('#fee_collect_roll').text('').append(data);
								
							}
				  });
	
});

$('#fee_collect_roll').on('change',function(){
	
	
	var class_id = $('#fee_collect_class_id').val();
	
	var roll_id = $('#fee_collect_roll').val(); 
	
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_collect_get_data/',
							data: { get_fcollect_cid:class_id,get_fcollect_rollid:roll_id },
							success: function(data) {
								
								
								//alert(data);
								
								$('#custom-fee-collect-data').text('').append(data);
								
								
								
							}
				  });
	

	
	
});


</script>
