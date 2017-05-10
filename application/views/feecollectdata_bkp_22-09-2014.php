
    
    	<div class="row-fluid">
        
        		<div class="span12">
                
                	<?php $i=1; //print_r($fcollectstandarddata); ?>
                    
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
                        
                        <?php $fpamount = $fcollectclassdata_view->fee_particular_amount;
							  $fdisamount = $fcollectclassdata_view->fee_particular_discount;
							  
							  $fpayamount = ($fpamount - $fdisamount );
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectclassdata_view->cname  ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_category ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_particular_name ?></td>
                            <td><?php echo $fpamount ?></td>
                            <td><?php echo $fdisamount ?></td>
                            <td>0.00</td>
                            <td><?php echo  number_format($fpayamount,2); ?></td>
                            <td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>">Pay</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            
                            
                            </td>
                            
                        </tr>
                    	<?php $i++; } } ?>
                        
                        <?php if(!empty($fcollectrolldata)) { foreach($fcollectrolldata as $fcollectrolldata_view){ ?>
                        <tr>
                        
                        
                         <?php $fpamount = $fcollectrolldata_view->fee_particular_amount;
							  $fdisamount = $fcollectrolldata_view->fee_particular_discount;
							  
							  $fpayamount = ($fpamount - $fdisamount );
						 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectrolldata_view->cname  ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_category ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_particular_name ?></td>
                             <td><?php echo $fpamount ?></td>
                            <td><?php echo $fdisamount ?></td>
                            <td>0.00</td>
                            <td><?php echo  number_format($fpayamount,2); ?></td>
                            <td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>">Pay</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            
                            
                            </td>
                        </tr>
                    	<?php $i++; } } ?>
                        
                        
                        <?php if(!empty($fcollectalldata)) { foreach($fcollectalldata as $fcollectalldata_view){ ?>
                        <tr>
                        
                        	 <?php $fpamount = $fcollectalldata_view->fee_particular_amount;
							  $fdisamount = $fcollectalldata_view->fee_particular_discount;
							  
							  $fpayamount = ($fpamount - $fdisamount );
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectalldata_view->cname  ?></td>
                            <td><?php echo $fcollectalldata_view->fee_category ?></td>
                            <td><?php echo $fcollectalldata_view->fee_particular_name ?></td>
                            <td><?php echo $fpamount ?></td>
                            <td><?php echo $fdisamount ?></td>
                            <td>0.00</td>
                            <td><?php echo  number_format($fpayamount,2); ?></td>
                            <td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>">Pay</button>
                            
                             <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            
                            
                            </td>
                        </tr>
                    	<?php $i++; } } ?>
                        
                         <?php if(!empty($fcollectstandarddata)) { foreach($fcollectstandarddata as $fcollectstandarddata_view){ ?>
                        <tr>
                        
                        	 <?php $fpamount = $fcollectstandarddata_view->fee_particular_amount;
							  $fdisamount = $fcollectstandarddata_view->fee_particular_discount;
							  
							  $fpayamount = ($fpamount - $fdisamount );
							 ?>
                        	<td><?php echo $i; ?></td>
                        	<td><?php echo $fcollectstandarddata_view->cname  ?></td>
                            <td><?php echo $fcollectstandarddata_view->fee_category ?></td>
                            <td><?php echo $fcollectstandarddata_view->fee_particular_name ?></td>
                            <td><?php echo $fpamount ?></td>
                            <td><?php echo $fdisamount ?></td>
                            <td>0.00</td>
                            <td><?php echo  number_format($fpayamount,2); ?></td>
                            <td>
                            
                            
                            <button class="btn btn-small btn-info custom-fee-pay-btn" name="paybutton" id="paybutton_<?php echo $i; ?>" value="" data-pay-val-id="<?php echo $i; ?>">Pay</button>
                            
                            <input type="hidden" name="hid_payamount_<?php echo $i; ?>" id="hid_payamount_<?php echo $i; ?>" value="<?php echo $fpayamount; ?>">
                            
                            
                            </td>
                        </tr>
                    	<?php $i++; } } ?>
                    </table>
                </div>
                </div>
        
        </div>
        
        
        
        
		
	

