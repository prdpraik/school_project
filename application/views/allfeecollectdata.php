
    <?php
	
	$array_data=array();
	?>
    	<div class="row-fluid">
        
        		<div class="span12">
                
                	<?php 
					
					
					$i=1; //print_r($fcollectstandarddata); ?>
                    <?php if(!empty($class_roll_data)) extract($class_roll_data); $ci =& get_instance();  $ci->load->model('fee_model');  ?>
                    <div class="custom-tam-table-fee">
                    <table class="table table-bordered">
                    	<tr>
                        	<th></th>
                        	<th>Class</th>
                            <th>Category</th>
                        	<th>Particular</th>
                            <th>Amount</th>
                        	<th>Discount</th>
                            <th>Paid Amount</th>
                            <th>Payable Amount</th>
							
                            <!--<th>Actions</th>-->
                        </tr>
                        
                        <?php if(!empty($fcollectclassdata)) { foreach($fcollectclassdata as $fcollectclassdata_view){ ?>
                        <tr>
                        
                        <?php
						   $sumFees=0;
							$fc_perid = $fcollectclassdata_view->fee_particular_id;
							
							
							
							$fp_payamount = $ci->fee_model->getSumPaid($fc_perid,$fc_class_id,$fc_roll_id);
							
							if($fp_payamount !=''){
								
								$fppaidamount =$fp_payamount;
							} else {
								$fppaidamount = 0.00;
							}
							
							
						
						
						 $fpamount = $fcollectclassdata_view->fee_particular_amount;
							  $fdisamount = $fcollectclassdata_view->fee_particular_discount;
							  
							  $sumFees+=$fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							  $array_data[$i]['fc_perid']=$fc_perid;
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectclassdata_view->cname.' - '.$fcollectclassdata_view->nname ?></td>
                            <td><?php echo $array_data[$i]['fee_category']= $fcollectclassdata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectclassdata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']= $fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2);$array_data[$i]['payamount']=$fpayamount; ?></td>
                            <!--<td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";}else { $cnt++; } ?>>View Pay History</button>
                           
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>-->
                            
                        </tr>
                    	<?php $i++; } } ?>
                        
                        <?php if(!empty($fcollectrolldata)) { foreach($fcollectrolldata as $fcollectrolldata_view){ ?>
                        <tr>
                        
                        
                         <?php 
						 	
							  $fc_perid = $fcollectrolldata_view->fee_particular_id;
							
							
							
								$fp_payamount = $ci->fee_model->getSumPaid($fc_perid,$fc_class_id,$fc_roll_id);
								
								if($fp_payamount !=''){
									
									$fppaidamount =$fp_payamount;
								} else {
									$fppaidamount = 0.00;
								}
							
							
							
						      $fpamount = $fcollectrolldata_view->fee_particular_amount;
							  $fdisamount = $fcollectrolldata_view->fee_particular_discount;
							  
							  $sumFees+=$fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							    $array_data[$i]['fc_perid']=$fc_perid;
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectrolldata_view->cname.' - '.$fcollectrolldata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectrolldata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectrolldata_view->fee_particular_name ?></td>
                             <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2);$array_data[$i]['payamount']=$fpayamount;?></td>
                            <!--<td>
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; }  ?>>View Pay History</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            </td>-->
                        </tr>
                    	<?php $i++; } } ?>
                        
                        
                        <?php if(!empty($fcollectalldata)) { foreach($fcollectalldata as $fcollectalldata_view){ ?>
                        <tr>
                        
                        	 <?php 
							 
							 $fc_perid = $fcollectalldata_view->fee_particular_id;
							
							
							
								$fp_payamount = $ci->fee_model->getSumPaid($fc_perid,$fc_class_id,$fc_roll_id);
								
								if($fp_payamount !=''){
									
									$fppaidamount =$fp_payamount;
								} else {
									$fppaidamount = 0.00;
								}
							
							 
							  $fpamount = $fcollectalldata_view->fee_particular_amount;
							  $fdisamount = $fcollectalldata_view->fee_particular_discount;
							  
							  $sumFees+=$fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							   $array_data[$i]['fc_perid']=$fc_perid;
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $className=$fcollectalldata_view->cname.' - '.$fcollectalldata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectalldata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectalldata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2);$array_data[$i]['payamount']=$fpayamount; ?></td>
                            <!--<td>
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; } ?>>View Pay History</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>-->
                        </tr>
                    	<?php $i++; } } ?>
                        
                         <?php if(!empty($fcollectstandarddata)) { foreach($fcollectstandarddata as $fcollectstandarddata_view){ ?>
                        <tr>
                        
                        	 <?php 
							 
							 	 $fc_perid = $fcollectstandarddata_view->fee_particular_id;
							
							
							
								$fp_payamount = $ci->fee_model->getSumPaid($fc_perid,$fc_class_id,$fc_roll_id);
								
								if($fp_payamount !=''){
									
									$fppaidamount =$fp_payamount;
								} else {
									$fppaidamount = 0.00;
								}
							
							 
							 
							 $fpamount = $fcollectstandarddata_view->fee_particular_amount;
							  $fdisamount = $fcollectstandarddata_view->fee_particular_discount;
							  
							$sumFees+=$fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							$array_data[$i]['fc_perid']=$fc_perid;
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectstandarddata_view->cname.' - '.$fcollectstandarddata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectstandarddata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectstandarddata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo $array_data[$i]['fpayamount']=number_format($fpayamount,2);$array_data[$i]['payamount']=$fpayamount; ?></td>
                            <!--<td>
                            
                           <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; } ?>>View Pay History</button>
                            
                            <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>-->
                        </tr>
                    	<?php $i++; } } ?>
                    </table>
                    	<input type="hidden" name="hid_payamount_class" id="hid_payamount_class" value="<?php echo $fc_class_id ?>"  />
                        <input type="hidden" name="hid_payamount_roll" id="hid_payamount_roll" value="<?php echo $fc_roll_id ?>"  />
                </div>
				
				
				
                </div>
				
        
        </div>
		<?php 
	//	echo '<pre>';
//print_r($array_data);		
		//	echo '</pre>';
		?>
		
		<?php if(count($array_data)){ ?>
		 
		 <div class="col-xs-2" style=" float: left;  width: 98%; text-align: right;   padding: 15px;">
				 <input name="b_print" type="button" class="ipt"   onClick="printdiv('print_table');" value=" Print ">
				 <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton" <?php if($sumFees==0) { echo "disabled";  } ?> style="cursor: pointer;">Pay</button>
				 
				 <button class="btn btn-small btn-success custom-fee-pay-his-btn-all" name="payhisbutton" id="payhisbutton" value="" >View Pay History</button>
		 </div>
		
		 <?php /*if($cnt>0){ ?>
		 <a href="<?php echo base_url();?>index.php?admin/feeCollectreceipt/<?php echo $fc_class_id; ?>/<?php echo $fc_roll_id; ?>" target="_new"><i class="icon-print icon-2x"></i></a>
		 <?php }*/ } ?>
		 <div class="row">
			<div class="span11">
			 <div class="custom-tam-table-fee table_new_class" style="margin-left: 35px; display:none; ">
			<form name="collect_fee_amt" id="collect_fee_amt" action="javascript:void(0);">
			 <table style="width:100%;">
			   <tr><td>
		      
			  
                    <table class="table table-bordered">
                    	<tr>
                        	<th></th>
                            <th>Category</th>
                        	<th>Particular</th>
                            <th>Payable Amount</th>
							 <th>Amtount to be collected</th>
							 <th>Late Charges </th>
                        </tr>
						<?php 
						$no=1;
						foreach($array_data as $key=>$value){
							$tot +=$value['payamount'];
							if($value['fpayamount']!=0){
							
						echo '<tr>
						         <td>'.($no++).'<input type="hidden" name="fc_perid['.$value['fc_perid'].']"  value="'.$value['fc_perid'].'"/></td>
								  <td>'.$value['fee_category'].'</td>
								  <td>'.$value['fee_particular_name'].'</td>
								  <td>'.$value['fpayamount'].'
								  <input type="hidden" rel="'.$value['fc_perid'].'" id="payable_actual_'.$value['fc_perid'].'" name="payable_actual['.$value['fc_perid'].']" value="'.$value['fpayamount'].'"/></td>
								   <td>
								   <input type="text" rel="'.$value['fc_perid'].'" name="payable_amt['.$value['fc_perid'].']" class="only_number payable_amt" id="payable_amt_'.$value['fc_perid'].'"/></td>
								    <td>
									<input type="text" rel="'.$value['fc_perid'].'" name="late_chrage['.$value['fc_perid'].']" id="late_chrage_'.$value['fc_perid'].'" class="only_number late_charge"/>
									<input type="hidden" rel="'.$value['fc_perid'].'" id="discount_'.$value['fc_perid'].'" name="discount['.$value['fc_perid'].']" class="only_number late_charge" value="'.$value['fdisamount'].'"/>
									
									</td>
						</tr>';
						 } } ?>
						 <tr>
						 <td></td>
						 <td></td>
						 <td>Total</td>
						 <td><?php echo number_format($tot,2); ?></td>
						 <td><span class="tot_span"></span></td>
						  <td><span class="late_charge_span"></span></td>
						 </tr>
						 
						</table>
					
					</td>
					<tr>
					
					 <td>
					       <div class="control-group">
                            <label class="control-label" for="process_payment_mode"><?php echo get_phrase('payment_mode');?></label>
                            <div class="controls">
                                <select name="process_payment_mode" id="process_payment_mode" class="span12 validate[required]" >
                                    <option value="0">Cash</option>
                                    <option value="1">Cheque</option>
									 <option value="2">Debit Card</option>
									 <option value="3">Bank</option>
                                </select>
                                
                            </div>
                            </div>
                           
                            <div id="custom-tam-cheque-info" style="display:none;">
                            
                            <div class="control-group">
                            <label class="control-label lbl_nbr" for="process_payment_cheque_number"><?php echo get_phrase('cheque_number');?></label>
                            <div class="controls">
                               
                               <input type="text" class="span12" id="process_payment_cheque_number" name="process_payment_cheque_number"  />
                                
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label lbl_date" for="process_payment_cheque_date"><?php echo get_phrase('cheque_date');?></label>
                            <div class="controls">
                               
                               <input type="text" class="span12" id="process_payment_cheque_date" name="process_payment_cheque_date" class="datepicker fill-up"  />
                                
                            </div>
                            </div>
                            
                            <div class="control-group">
                            <label class="control-label lbl_name" for="process_payment_bank_name"><?php echo get_phrase('bank_name');?></label>
                            <div class="controls">
                               
                               <input type="text" class="span12" id="process_payment_bank_name" name="process_payment_bank_name"  />
                                
                            </div>
                            </div>
                            </div>
					 </td>
					</tr>
					<tr>
					
					 <td> 
					 <label class="control-label" for="process_payment_remarks"><?php echo get_phrase('remarks');?></label>
					 
					 <textarea class="span12" class="5" name="process_payment_remarks" id="process_payment_remarks" style="resize:none"></textarea></td>
					</tr>
					
					<tr>
					<td>
					<input type="button" name="btn_collect" value="Collect" id="btn_collect" class="btn btn-success" onClick="collect()">
					</td>
					</tr></table>
					</div>
					</form>
		 </div>
		 </div>
		 
		<div class="row-fluid" id="print_table" style="display:none;" >
		  <div class="custom-tam-table-fee">
                    <table   class="table table-bordered">

				  <tr> 
				  <td colspan="2">
				  Name :
				  </td>
				  <td colspan="4">
				  <?php print_r($student_info[0]['name']); ?>
				  </td>
				  </tr>
				    <tr> 
				  <td colspan="2">
				  Class :
				  </td>
				  <td colspan="4">
				  <?php echo $className; ?>
				  </td>
				  </tr>
				  	    <tr> 
				  <td colspan="2">
				  RTE :
				  </td>
				  <td colspan="4">
				  <?php echo ($student_info[0]['rte']==1)?'Yes':'No'; ?>
				  </td>
				  </tr>
				  <tr>
				     <td><b>Category</b></td>
					 <td><b>Particular</b></td>
					 <td><b>Amount</b></td>
					 <td><b>Discount</b></td>
					 <td><b>Paid Amount</b></td>
					 <td><b>Payable Amount</b></td>
				  </tr>
				  <?php
				  
				      foreach($array_data  as $key=>$value){
						  $fpamount1+=$value['fpamount'];
						  $fdisamount1+=$value['fdisamount'];
						  $fppaidamount1+=$value['fppaidamount'];
						  $fpayamount1+=$value['fpayamount'];
						    echo '<tr> 
							<td>'.$value['fee_category'].'</td>
							<td>'.$value['fee_particular_name'].'</td>
							<td>'.$value['fpamount'].'</td>
							<td>'.$value['fdisamount'].'</td>
							<td>'.$value['fppaidamount'].'</td>
							<td>'.$value['fpayamount'].'</td>';
						echo '</tr>';
					   }
					      	 echo '<tr> 
							<td><b>Total</b></td>
							<td>:</td>
							<td><b>'.number_format($fpamount1,2).'</b></td>
							<td><b>'.number_format($fdisamount1,2).'</b></td>
							<td><b>'.number_format($fppaidamount1,2).'</b></td>
							<td><b>'.number_format($fpayamount1,2).'</b></td>';
						echo '</tr>';
					  
				  ?>
				</table>
		</div>
		</div>
		<script>
function collect(){
	var error=0;
	var error2=0;
	 $classId=$('#fee_collect_class_id').val();
				 $roll=$('#fee_collect_roll').val();
				 $('.payable_amt').each(function(i){
					 $id=$(this).attr('rel');		
					 if($(this).val()!=""){
						 var num = $('#payable_actual_'+$id).val();
						 num=num.replace(/,/g , "");
                     if($(this).val()>Number(num)|| $(this).val()==0){
						$(this).css('border','1px solid red'); 
						error++;
					 }
					}else{
						error2++;
					}
					
					if($(this).val()==""  || $(this).val()==0){
						if($('#late_chrage_'+$id).val()>0 && $('#late_chrage_'+$id).val()!=""){
							$('#late_chrage_'+$id).css('border','1px solid red'); 
							error++;
						}
					}					
				 });
				if($('.payable_amt').length==error2){
					$('.payable_amt').css('border','1px solid red'); 	error++;
				}
				 $data1=$('#collect_fee_amt').serialize()+'&class='+$classId+'&roll='+$roll;
				 if($classId>0 && $roll>0 && error==0){
					$.ajax({
					type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_collect_process_data_all/',
							data: $data1,
							success: function(data) {
								call_data_load();
								//$('#val_fc_class_id').text('');
								//$('#fee_collect_roll').text('').append(data);
							}
	});
	return false;
  }
}
		  $(document).ready(function(){
			 $('#paybutton').click(function(e){				  
					$('.table_new_class').toggle();
			  });
			 $(document).on('click','#btn_collect1',function(e){
	$.ajax({
				type: 'POST',
							url: '<?php echo base_url(); ?>index.php?admin/fee_collect_process_data_all/',
							data: $('#collect_fee_amt').serialize(),
							success: function(data) {
								//$('#val_fc_class_id').text('');
								//$('#fee_collect_roll').text('').append(data);
							}
	});
	 return false;
});

			  
		  });
		</script>
        
        
        
        
		
	

