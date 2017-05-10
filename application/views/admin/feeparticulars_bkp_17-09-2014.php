<div class="box">
	<div class="box-content padded">
    
    	<div class="row-fluid">
        
        		<div class="span12">
                		<div class="custom-tam-hr-frm">
                        <?php if(!empty($fc_data)) extract($fc_data); ?>
                	    <form class="form-horizontal validatable" method="post" action="<?php base_url() ?>index.php?admin/fee_particular_insert">
                        
                        <div class="control-group">
                        <label class="control-label" for="fee_category"><?php echo get_phrase('fee_category');?></label>
                        <div class="controls">
                        <input type="text" class="validate[required]" id="fee_category" name="fee_category" value="<?php if(isset($fee_category)) echo $fee_category; ?>" disabled="disabled">
                        <input type="hidden" name="fee_category_id" id="fee_category_id" value="<?php if(isset($fee_category_id)) echo $fee_category_id; ?>" />
                        </div>
                        </div>
                       
                        <div class="control-group">
                        <label class="control-label" for="fee_particular_name"><?php echo get_phrase('particular_name');?></label>
                        <div class="controls">
                        	<input type="text" name="fee_particular_name" id="fee_particular_name" class="validate[required]" placeholder="Please enter particular name" />
                         <span id="val_fc_inc"></span>   
                        </div>
                        </div>
                       
                        <div class="control-group">
                        <label class="control-label" for="fee_particular_description"><?php echo get_phrase('description');?></label>
                        <div class="controls">
                        	<textarea name="fee_particular_description" id="fee_particular_description" class="validate[required]" style="resize:none;"></textarea>
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <label class="control-label" for="fee_particular_type"><?php echo get_phrase('type');?></label>
                        <div class="controls">
                        	<select name="fee_particular_type" id="fee_particular_type" class="uniform validate[required]" >
                            	<option value="">--- select type ---</option>
                                <option value="fp_all">All</option>
                                <option value="fp_standard">Standard</option>
                                <option value="fp_class">Class</option>
                                <option value="fp_roll">Roll No</option>
                            </select>
                            <span id="val_fp_type"></span>
                        </div>
                        </div>
                        
                        
                        <div id="custom-tam-fp-type-blck">
                        
                        	
                        
                        </div>
                        
                        
                       	<div class="control-group">
                        <label class="control-label" for="fee_particular_amount"><?php echo get_phrase('amount');?></label>
                        <div class="controls">
                        	<input type="number"  name="fee_particular_amount" id="fee_particular_amount" class="validate[required]" placeholder="Please enter particular amount" />
                         
                        </div>
                        </div>
                        <div class="control-group">
                        <label class="control-label" for="fee_particular_discount"><?php echo get_phrase('discount');?></label>
                        <div class="controls">
                        	<input type="text"  name="fee_particular_discount" id="fee_particular_discount" class="validate[required]" placeholder="Please enter particular discount" />
                         
                        </div>
                        </div>
                         <div class="control-group" style="display:none;" id="custom-tam-fp-discount">
                        <label class="control-label" for="fee_particular_discount_reason"><?php echo get_phrase('discount_reason');?></label>
                        <div class="controls">
                        	<textarea name="fee_particular_discount_reason" id="fee_particular_discount_reason" class="validate[required]" style="resize:none;"></textarea>
                        </div>
                        </div>
                        <div class="control-group" >
                        <label class="control-label" for="fee_particular_status"><?php echo get_phrase('fee_particular_status');?></label>
                        <div class="controls">
                        	<select name="fee_particular_status" id="fee_particular_status" class="uniform validate[required]">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        </div>
                        
                        <div class="control-group">
                        <div class="controls">
                        
                        <button type="submit" class="btn btn-lightblue"><?php echo get_phrase('add_fee_particular');?></button>
                        </div>
                        </div>
                        
                        
                        </form>
                        </div>
                
                </div>
        
        </div>
        
        <div class="row-fluid">
        	<div class="span12">
            <?php //print_r($fp_data) ?>
            	    <table class="table table-bordered">
                    		<thead>
                            	<tr>
                                	<th>Fee Category</th>
                                    <th>Particular Name</th>
                                    <th>Particular Type</th>
                                    <th>Particular Amount</th>
                                    <th>Particular Discount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($fp_data)) { foreach($fp_data as $fp_data_view) { ?>
                            	<tr>
                                	<td><?php echo $fp_data_view->fcategory ?></td>
                                    <td><?php echo $fp_data_view->fee_particular_name ?></td>
                                    <td><?php
									
									$fptype = $fp_data_view->fee_particular_type;
									
									if($fptype == 'fp_class'){
										$this->db->select('name as cname');
										$this->db->where('class_id',$fp_data_view->fee_particular_type_id);
										$query = $this->db->get_where('class');
										$cdata = $query->row_array();
										
										extract($cdata);
										
										
										echo ucfirst(str_replace('fp_','',$fptype))." / ".$cname ;
									} else if($fptype == 'fp_standard') {
										
										$this->db->select('standard_name as sname');
										$this->db->where('standard_id',$fp_data_view->fee_particular_type_id);
										$query = $this->db->get_where('standard');
										$sdata = $query->row_array();
										
										extract($sdata);
										
										echo ucfirst(str_replace('fp_','',$fptype))." / ".$sname ;
										
									} else if ($fptype == 'fp_roll'){
										
										echo ucfirst(str_replace('fp_','',$fptype))." / <a href='javascript:void(0);' data-rolls-val='".$fp_data_view->fee_particular_type_id."' data-roll-class='".$fp_data_view->fee_particular_type_cid."' class='fp-roll-view'>View</a>" ;
									} else {
										echo ucfirst(str_replace('fp_','',$fptype));
									}
									
									
									
									 ?>
									
									
									
									
									 </td>
                                    <td><?php echo $fp_data_view->fee_particular_amount ?></td>
                                    <td><?php echo $fp_data_view->fee_particular_discount ?></td>
                                    <td><?php echo ucfirst($fp_data_view->fee_particular_status) ?></td>
                                    <td><a href="<?php echo base_url();?>index.php?admin/fee_particular_edit/<?php echo $fp_data_view->fee_particular_id ?>" class="btn btn-small btn-lightblue"><i class="icon-edit"></i> Edit</a>  <a data-toggle="modal" href="#modal-delete" onclick="modal_delete('<?php echo base_url();?>index.php?admin/fee_particular_delete/<?php echo $fp_data_view->fee_particular_id ?>')" class="btn btn-small btn-red"><i class="icon-trash"></i> Trash</a></td>
                                </tr>
                            <?php } } ?>    
                            </tbody>
                    </table>
            
            </div>
        </div>
		
	</div>
</div>

<script>
$('#fee_category').on('change',function(){
	
	var fc_val = $(this).val();
	
	$('#val_fc_val').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
		
		$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_cat_check/',
							data: { chkfcval:fc_val },
							success: function(data) {
								//alert(data);
								
								if(data=='true'){
									$("#val_fc_val").text('').attr("class","label label-warning").text( "'"+ fc_val +" ' already exists try another !" );
									$("#fee_category").val('').focus();
								} else {
									$("#val_fc_val").removeAttr("class").text('').attr("class","label label-success").text( "'"+ fc_val +"' available !" );
									
								}
								
							}
				  });
	
});

$('#fc_invoice_pre_fix').on('change',function(){
	
	var fc_inc_val = $(this).val();
	
	$('#val_fc_inc').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
		
		$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_cat_preinc_check/',
							data: { chkfcpreincval:fc_inc_val, chkprvfcincval:'' },
							success: function(data) {
								//alert(data);
								
								if(data=='true'){
									$("#val_fc_inc").text('').attr("class","label label-warning").text( "'"+ fc_inc_val +" ' already exists try another !" );
									$("#fc_invoice_pre_fix").val('').focus();
								} else {
									$("#val_fc_inc").removeAttr("class").text('').attr("class","label label-success").text( "'"+ fc_inc_val +"' available !" );
									
								}
								
							}
				  });
	
});


$('#fee_particular_type').on('change',function(){
	
	var fp_type = $(this).val();
	
	$('#val_fp_type').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
	
	if(fp_type != '' || fp_type != 'fp_all'){
		
		
		
		$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_particular_type/',
							data: { get_fp_type:fp_type },
							success: function(data) {
								//alert(data);
								
								$('#val_fp_type').text('');
									
								$('#custom-tam-fp-type-blck').text('').append(data);
								
							}
				  });
	}
	
});

$(document).on('change','#fee_particular_type_cid',function(){
	
	var fp_cid = $(this).val();
	
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_particular_type/',
							data: { get_fp_cid:fp_cid , get_fp_type:'frm_class' },
							success: function(data) {
								//alert(data);
								
								
									
								$('#custom-tam-fp-type-blck-roll').text('').append(data);
								
							}
				  });
	
});
$('#fee_particular_discount').on('change',function(){
	
	var fp_discount = $(this).val();
	
	if(fp_discount > 0){
		
		$('#custom-tam-fp-discount').show(1000);
		
	}else{
		$('#custom-tam-fp-discount').hide(1000);
	}
	
});

$('.fp-roll-view').on('click',function(e){
	
	var fp_rolls = $(this).data('rolls-val');
	var fp_roll_class = $(this).data('roll-class');
	
	//alert(fp_rolls + fp_roll_class );
	
	$('#custom-tam-model-body-roll').text('');
	
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_particular_rolls/',
							data: { srolls:fp_rolls , sclass:fp_roll_class },
							success: function(data) {
								//alert(data);
								
								
									
								$('#custom-tam-model-body-roll').text('').append(data);
								
							}
				  });
	
	
	           e.preventDefault();
				$('#custom-tam-model-roll').modal('show');
	
	
});

</script>