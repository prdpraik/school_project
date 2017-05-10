<style>

.custom-tam-main-select-block,.custom-tam-table-fee{
	padding:5px 20px;
	-webkit-box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	-moz-box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	box-shadow: 0px 0px 3px 1px rgba(0,0,0,0.75);
	margin-bottom:20px;
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

label.error {  
	color: #FB3A3A;
    display: inline-block;
	margin:2px 0;
    padding-left: 5px;
    text-align: left;
	}

</style>

<div class="box">
	<div class="box-content padded">
    
    
    	<div class="custom-tam-main-select-block">
    	<div class="row-fluid form-horizontal">
        	<form action="" method="post" name="" id="" class="validatable" >
            
            <?php if(!empty($sel_data)) @extract($sel_data); ?>
        		<div class="span5">
                		
                       
                        <div class="control-group">
                        <label class="control-label" for="fee_report_class_id"><?php echo get_phrase('class');?></label>
                        <div class="controls">
                        	<select name="fee_report_class_id" id="fee_report_class_id" class="span8 validate[required]" >
                            	<option value="">--- select class ---</option>
                               	
                                <?php if(!empty($class_data)) { foreach($class_data as $class_data_view){ ?>
                              	
                                	<option value="<?php echo $class_data_view->class_id ?>" <?php if($class_data_view->class_id == $rcid) echo "selected"; ?>><?php echo $class_data_view->name ?></option>
                                
                                <?php } } ?>
                                
                            </select>
                            <span id="val_fc_class_id"></span>
                        </div>
                        </div>
               </div>
               <div class="span5">
                        
                        <div class="control-group">
                        <label class="control-label" for="fee_report_particular"><?php echo get_phrase('particular');?></label>
                        <div class="controls">
                        	<select name="fee_report_particular" id="fee_report_particular" class="span8 validate[required]" >
                            	<option value="">--- select class first---</option>
                            </select>
                            
                        </div>
                        </div>
                        
                       
                        
                
                </div>
                <div class="span2">
                	<button type="submit" class="btn btn-info">Submit</button>
                </div>
                </form>
                
        
        </div>
        </div>
        <div class="custom-tam-main-select-block">
        <div class="row-fluid">
        
        <?php //print_r($student_data);
					 @extract($ptr_data); $ci =& get_instance();  $ci->load->model('fee_model');
					 
					 $pamount = $fee_particular_amount;
					 
					 $pdiscount = $fee_particular_discount;
					 
					 $payamount = ($pamount - $pdiscount);
					 
					  ?>
        
        		<div class="span3">
                	<?php echo $fcategory.' - '.$fee_particular_name ; ?>
                </div>
                <div class="span3">
                </div>
                <div class="span3">
                </div>
                <div class="span3">
                </div>
                
        </div>
        </div>
        <div class="row-fluid">
        
        		<div class="span12">
                
                	
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="responsive" id="teacher_dtable">

                                        <thead>

                                            <tr>
    
                                                <th><div><?php echo get_phrase('roll'); ?></div></th>
        
                                                <th><div><?php echo get_phrase('student_name'); ?></div></th>
        
                                                <th><div title="After discount applied"><?php echo get_phrase('payable_amount*'); ?></div></th>
        
                                                <th><div><?php echo get_phrase('paid_amount'); ?></div></th>
        
                                                <th><div><?php echo get_phrase('due_amount'); ?></div></th>
                                                
                                                <th><div><?php echo get_phrase('payment_status'); ?></div></th>
    
                                            </tr>

                                        </thead>

                                        <tbody>
                                        
                                        
                                        <?php foreach($student_data as $student_data_view) { 
										
										$fp_payamount = $ci->fee_model->getSumPaid($fee_particular_id,$student_data_view->class_id,$student_data_view->student_id);
							
										if($fp_payamount !=''){
											
											$fppaidamount =$fp_payamount;
										} else {
											$fppaidamount = 0;
										}
										
										$dueamount = ($payamount - $fppaidamount);
										
										
										
										?>
                                        	
                                        	<tr>
                                            	
                                                <td align="right"><?php echo $student_data_view->roll ?></td>
                                                
                                                <td><?php echo $student_data_view->name ?></td>
                                                
                                                <td align="right"><?php echo $payamount; ?></td>
                                                
                                                <td align="right"><?php echo $fppaidamount; ?></td>
                                                
                                                <td align="right"><?php echo $dueamount; ?></td>
                                                
                                                <td align="center"> <?php if($dueamount == 0) echo "<span class='label label-info'>  Paid  </label>";
														   else echo "<span class='label label-warning'>Unpaid</label>"; ?></td>
                                            
                                            </tr>
                                        <?php } ?>
                                        
                                        </tbody>

                    </table>
                
                </div>
                
        </div>
        
        
        
        
		
	</div>
</div>

<script>

$('#fee_report_class_id').on('change',function(){
	
	var report_cid = $(this).val();
	
	$('#val_fc_class_id').append('<img title="<?php echo base_url(); ?>template/images/loading.gif" src="<?php echo base_url(); ?>template/images/loading.gif">');
	
	
	call_pter(report_cid);
	
});

function call_pter(report_cid){
	
	$.ajax({
							type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_report_get_particular/',
							data: { get_report_cid:report_cid },
							success: function(data) {
								//alert(data);
								
								$('#val_fc_class_id').text('');
									
								$('#fee_report_particular').text('').append(data);
								
							}
				  });
	
}

</script>
<script src="<?php base_url() ?>template/js/jquery-1.11.1.min.js"></script>
<script src="<?php base_url() ?>template/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>template/css/dataTables.tableTools.css">
<script type="text/javascript" language="javascript" src="<?php base_url() ?>template/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php base_url() ?>template/js/dataTables.bootstrap.js"></script>
<script>var $j = jQuery.noConflict(true);</script>
<script>
$(document).ready(function() {
	
	$('#custom-tam-overlay').show();
	
    $j('#teacher_dtable').DataTable( {
		dom: 'T<"clear">lfrtip',
		 tableTools: {
            "sSwfPath": "<?php base_url() ?>template/swf/copy_csv_xls_pdf.swf",
			"aButtons": [
            {
                "sExtends": "copy",
                "mColumns": [0, 2, 3, 4]
            },
            {
                "sExtends": "csv",
                "mColumns": [0, 2, 3, 4]
            },
            {
                "sExtends": "pdf",
                "mColumns": [0, 2, 3, 4]
            },
            {
                "sExtends": "print",
                "mColumns": [0, 2, 3, 4]
            },
        ]
        }
	} );
	
} );

$(window).load(function(){
	
	
	var report_cid = $('#fee_report_class_id').val();
	
	call_pter(report_cid);
	
	$('#custom-tam-overlay').hide();
	
});
</script>
