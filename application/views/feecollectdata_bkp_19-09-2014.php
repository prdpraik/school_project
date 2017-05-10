<div class="box">
	<div class="box-content padded">
    
    	<div class="row-fluid">
        
        		<div class="span12">
                
                	<?php //print_r($fcollectrolldata); ?>
                    
                    
                    <table class="table table-bordered">
                    	<tr>
                        	<th></th>
                        	<th>Class</th>
                            <th>Category</th>
                        	<th>Particular</th>
                            <th>Amount</th>
                        	<th>Discount</th>
                            <th>Payable Amount</th>
                        </tr>
                        
                        <?php if(!empty($fcollectclassdata)) { foreach($fcollectclassdata as $fcollectclassdata_view){ ?>
                        <tr>
                        	<td></td>
                        	<td><?php echo $fcollectclassdata_view->cname  ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_category ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_particular_name ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_particular_amount ?></td>
                            <td><?php echo $fcollectclassdata_view->fee_particular_discount ?></td>
                            <td><?php  ?></td>
                            
                        </tr>
                    	<?php } } ?>
                        
                        <?php if(!empty($fcollectrolldata)) { foreach($fcollectrolldata as $fcollectrolldata_view){ ?>
                        <tr>
                        	<td></td>
                        	<td><?php echo $fcollectrolldata_view->cname  ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_category ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_particular_name ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_particular_amount ?></td>
                            <td><?php echo $fcollectrolldata_view->fee_particular_discount ?></td>
                            <td><?php  ?></td>
                            
                        </tr>
                    	<?php } } ?>
                        
                        
                        <?php if(!empty($fcollectalldata)) { foreach($fcollectalldata as $fcollectalldata_view){ ?>
                        <tr>
                        	<td></td>
                        	<td><?php echo $fcollectalldata_view->cname  ?></td>
                            <td><?php echo $fcollectalldata_view->fee_category ?></td>
                            <td><?php echo $fcollectalldata_view->fee_particular_name ?></td>
                            <td><?php echo $fcollectalldata_view->fee_particular_amount ?></td>
                            <td><?php echo $fcollectalldata_view->fee_particular_discount ?></td>
                            <td><?php  ?></td>
                            
                        </tr>
                    	<?php } } ?>
                    </table>
                
                </div>
        
        </div>
        
        
        
        
		
	</div>
</div>

