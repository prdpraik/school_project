<style>
#custom-payment-block{
	border:3px solid #cdcdcd;
	padding:10px;
}
#custom-payment-block h1{
	color:#000;
}
.custom-tam-main-select-block,.custom-tam-table-fee{
	padding:5px 20px;
	-webkit-box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	margin-bottom:20px;
}
.custom-tam-table-fee{
	padding:5px;
}
.custom-tam-main-select-block .form-horizontal{
	padding-top:15px;
}
.custom-tam-main-select-block .form-horizontal .controls{
	margin-left: 0;
}
.custom-tam-main-select-block .form-horizontal .control-label{
	width:auto;
	padding-right:10px;
}

</style>

<div class="box">
	<div class="box-content padded">
    
    
    	<div class="custom-tam-main-select-block">
    	<div class="row-fluid form-horizontal">
        
        		<div class="span6">
                		
                       
                        <div class="control-group">
                        <label class="control-label" for="fee_collect_class_id"><?php echo get_phrase('class');?></label>
                        <div class="controls">
                        	<select name="fee_collect_class_id" id="fee_collect_class_id" class="span8 validate[required]" >
                            	<option value="">--- select class ---</option>
                               	
                                <?php if(!empty($class_data)) { foreach($class_data as $class_data_view){ ?>
                              	
                                	<option value="<?php echo $class_data_view->class_id ?>"><?php echo $class_data_view->name ?></option>
                                
                                <?php } } ?>
                                
                            </select>
                            <span id="val_fc_class_id"></span>
                        </div>
                        </div>
               </div>
               <div class="span6">
                        
                        <div class="control-group">
                        <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('student');?></label>
                        <div class="controls">
                        	<select name="fee_collect_roll" id="fee_collect_roll" class="span8 validate[required]" >
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
        
        <div class="row-fluid">
        	
            <div class="span6 offset3">
                		<div id="custom-payment-block" style="display:none;">
                        
                        	<div class="control-group">
                            <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('total_amount');?></label>
                            <div class="controls">
                               
                               <h1>&#8377; <span id="process_payment_amount_text">0</span>/-</h1>
                                
                            </div>
                            </div>
                        
                        	<div class="control-group">
                            <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('amount_to_be_collected');?></label>
                            <div class="controls">
                               
                               <input type="text" class="span12" name="process_payment_amount" id="process_payment_amount" value="0" />
                                
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('late_charges');?></label>
                            <div class="controls">
                               
                               <input type="text" class="span12"  />
                                
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('payment_mode');?></label>
                            <div class="controls">
                                <select name="fee_collect_roll" id="fee_collect_roll" class="span12 validate[required]" >
                                    <option value="0">Cash</option>
                                    <option value="1">Cheque</option>
                                </select>
                                
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label" for="fee_collect_roll"><?php echo get_phrase('remarks');?></label>
                            <div class="controls">
                                
                                <textarea class="span12" class="5" style="resize:none"></textarea>
                                
                            </div>
                            </div>
                            
                            <div class="form-actions">
                                <input type="submit" name="" value="Collect" id="" class="btn btn-success">
                                <input type="submit" name="" value="Cancel" id="" class="btn btn-danger">
                            </div>
                        
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
	
	$('#custom-tam-overlay').show();
	
	
	var class_id = $('#fee_collect_class_id').val();
	
	var roll_id = $('#fee_collect_roll').val(); 
	
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_collect_get_data/',
							data: { get_fcollect_cid:class_id,get_fcollect_rollid:roll_id },
							success: function(data) {
								
								
								//alert(data);
								
								$('#custom-fee-collect-data').text('').append(data);
								
								$('#custom-payment-block').show();
								
								$('#custom-tam-overlay').hide();
								
								
							}
				  });
	

	
	
});

$(document).on('click','.custom-fee-pay-btn',function(e){
	
	var paybtnid = $(this).data('pay-val-id');
	
	var payamount_val = $('#hid_payamount_'+paybtnid).val();
	
	
	$('#process_payment_amount_text').text(payamount_val);
	
	$('#process_payment_amount').val(payamount_val);
	
	
	
	 e.preventDefault();

        $("body, html").animate({ 
            scrollTop: $( $('#custom-payment-block') ).offset().top 
        }, 600);
	
});

</script>
