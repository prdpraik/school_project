
    <?php
	$array_data=array();
	?>
    	<div class="row-fluid">
        
        		<div class="span12">
                
                	<?php $i=1; //print_r($fcollectstandarddata); ?>
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
                            <th>Actions</th>
                        </tr>
                        
                        <?php if(!empty($fcollectclassdata)) { foreach($fcollectclassdata as $fcollectclassdata_view){ ?>
                        <tr>
                        
                        <?php
						
							$fc_perid = $fcollectclassdata_view->fee_particular_id;
							
							
							
							$fp_payamount = $ci->fee_model->getSumPaid($fc_perid,$fc_class_id,$fc_roll_id);
							
							if($fp_payamount !=''){
								
								$fppaidamount =$fp_payamount;
							} else {
								$fppaidamount = 0.00;
							}
							
							
						
						
						 $fpamount = $fcollectclassdata_view->fee_particular_amount;
							  $fdisamount = $fcollectclassdata_view->fee_particular_discount;
							  
							  $fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectclassdata_view->cname.' - '.$fcollectclassdata_view->nname ?></td>
                            <td><?php echo $array_data[$i]['fee_category']= $fcollectclassdata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectclassdata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']= $fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2); ?></td>
                            <td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";}else { $cnt++; } ?>>View Pay History</button>
                           
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>
                            
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
							  
							  $fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectrolldata_view->cname.' - '.$fcollectrolldata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectrolldata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectrolldata_view->fee_particular_name ?></td>
                             <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2); ?></td>
                            <td>
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; }  ?>>View Pay History</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            </td>
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
							  
							  $fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $className=$fcollectalldata_view->cname.' - '.$fcollectalldata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectalldata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectalldata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo  $array_data[$i]['fpayamount']=number_format($fpayamount,2); ?></td>
                            <td>
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; } ?>>View Pay History</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                             <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>
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
							  
							$fpayamount = ($fpamount - $fdisamount ) - ($fppaidamount);
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectstandarddata_view->cname.' - '.$fcollectstandarddata_view->nname  ?></td>
                            <td><?php echo $array_data[$i]['fee_category']=$fcollectstandarddata_view->fee_category ?></td>
                            <td><?php echo $array_data[$i]['fee_particular_name']=$fcollectstandarddata_view->fee_particular_name ?></td>
                            <td><?php echo $array_data[$i]['fpamount']=$fpamount ?></td>
                            <td><?php echo $array_data[$i]['fdisamount']= $fdisamount ?></td>
                            <td><?php echo $array_data[$i]['fppaidamount']=$fppaidamount?></td>
                            <td><?php echo $array_data[$i]['fpayamount']=number_format($fpayamount,2); ?></td>
                            <td>
                            
                           <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>" <?php if($fpayamount == 0) { echo "disabled";  } ?>>Pay</button>
                         
                            <button class="btn btn-small btn-success custom-fee-pay-his-btn" name="payhisbutton" id="payhisbutton_<?php echo $i; ?>" value="" data-pay-his-id="<?php echo $i; ?>"  <?php  if($fp_payamount == 0) { echo "disabled";} else { $cnt++; } ?>>View Pay History</button>
                            
                            <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            <input type="hidden" name="hid_payamount_particular_<?php echo $i; ?>" id="hid_payamount_particular_<?php echo $i; ?>" value="<?php echo $fc_perid; ?>">
                            
                            
                            </td>
                        </tr>
                    	<?php $i++; } } ?>
                    </table>
                    	<input type="hidden" name="hid_payamount_class" id="hid_payamount_class" value="<?php echo $fc_class_id ?>"  />
                        <input type="hidden" name="hid_payamount_roll" id="hid_payamount_roll" value="<?php echo $fc_roll_id ?>"  />
                </div>
				
				
				
                </div>
				
        
        </div>
		<?php if(count($array_data)){ ?>
		 <input name="b_print" type="button" class="ipt"   onClick="printdiv('print_table');" value=" Print ">
		 
		 <?php if($cnt>0){ ?>
		 <a href="<?php echo base_url();?>index.php?admin/feeCollectreceipt/<?php echo $fc_class_id; ?>/<?php echo $fc_roll_id; ?>" target="_new"><i class="icon-print icon-2x"></i></a>
		 <?php } } ?>
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
        
        
        
        
		
	

