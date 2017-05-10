<?php
//echo '<pre>';
//print_r($data_all); 
//echo '</pre>';
?>
<div class="box">
	<div class="box-content padded">
    
    	<div class="row-fluid">
        
        		<div class="span12">
                		<div class="custom-tam-hr-frm">
                	    <form class="form-horizontal validatable" method="post" action="<?php base_url() ?>index.php?admin/add_incomeexpenses/<?php if($data->id>0) { echo $data->id; } ?>">
						
						
						 
						 <div class="row-fluid">
                        <div class="span6">
                        <div class="control-group">
						<label class="control-label"><?php echo get_phrase('entry_date');?></label>
						 <div class="controls">
						
						<input type="text" class=" validate[required]" name="entry_date" id="entry_date" value="<?php if($data->id>0) { echo date("d/m/Y",strtotime($data->entry_date)); }else { echo date("d/m/Y"); }?>"/>
						 </div>
						  </div>
                        </div>
						 <div class="span6">
                        <div class="control-group">
						  </div>
                        </div>
                        </div>
						 
                        <div class="row-fluid">
                        <div class="span6">
                        <div class="control-group">
					
                        <label class="control-label" for="income_exp_name"><?php echo get_phrase('Income/Expenditure_name');?></label>
                        <div class="controls">
                        <input type="text" class="validate[required]" id="income_exp_name" name="income_exp_name" placeholder="Income/Expenditure Name" value="<?php  if($data->id>0) { echo $data->income_exp_name; } ?>">
                        <span id="val_fc_val"></span>
                        </div>
                        </div>
                        </div>
                        <div class="span6">
                        <div class="control-group">
                        <label class="control-label" for="amount"><?php echo get_phrase('Amount');?></label>
                        <div class="controls">
                        	<input type="text" name="amount" id="amount" class="validate[required]" placeholder="Amount" value="<?php  if($data->id>0) { echo $data->amount; } ?>"/>
                         <span id="val_fc_inc"></span>   
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row-fluid">
                        
                        <div class="span6">
                        <div class="control-group">
                        <label class="control-label" for="category_description"><?php echo get_phrase('description');?></label>
                        <div class="controls">
                        	<textarea name="category_description" id="category_description" class="validate[required]" style="resize:none;"><?php  if($data->id>0) { echo $data->category_description; } ?></textarea>
                        </div>
                        </div>
                        </div>
                        
                        <div class="span6">
                        <div class="control-group">
                        <label class="control-label" for="entry_type"><?php echo get_phrase('entry_type');?></label>
                        <div class="controls">
                        	<select name="entry_type" id="entry_type" class="uniform validate[required]">
								<option value="">-- Select Type --&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                <option value="1" <?php  if($data->entry_type==1) { echo "SELECTED"; } ?>>Income</option>
                                <option value="2" <?php  if($data->entry_type==2) { echo "SELECTED"; } ?>>Expenditure</option>
                            </select>
                        </div>
                        </div>
                        </div>
                        </div>
                        <div class="row-fluid">
                        
                        <div class="span6">
                        <div class="control-group">
                        <div class="controls">
                        
                        <button type="submit" class="btn btn-lightblue"><?php if($data->id>0) { echo get_phrase('Update'); }else { echo get_phrase('Add'); }?></button>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                        </form>
                        </div>
                
                </div>
        
        </div>
				<div class="row-fluid">
						<div class="span12">
						 <table cellpadding="0" cellspacing="0" border="0" class="responsive" id="feereport_dtable">

                                        <thead>
                                            <tr>
												<th>Date</th>
												<th>Income/Expenditure Name</th>
												<th>Type</th>
												<th> Amount</th> 
												<th>Action</th>
											</tr>
										</thead>
										  <tfoot>
                                            <tr>
												<th>Date</th>
												<th>Income/Expenditure Name</th>
												<th>Type</th>
												<th> Amount</th> 
												<th>Action</th>
											</tr>
										</tfoot>
										 <tbody>
										 <?php foreach($data_all as $key=>$value){?>
										     <tr>
												<td><?php echo date("d-m-Y",strtotime($value['entry_date'])); ?></td>
												<td><?php echo $value['income_exp_name']; ?></td>
												<td><?php echo ($value['entry_type']==1)?'Income':'expenses'; ?></td>
												<td> <?php echo $value['amount']; ?></td> 
												<td><a href="<?php base_url() ?>index.php?admin/income_expenses/<?php echo $value['id']; ?>">Edit</a>/<a href="javascript:void(0);" onclick="delete_record(<?php echo $value['id']; ?>);">Delete</a></td>
											</tr>
										 <?php } ?>
										  </tbody>
										</table>
										
										
						</div>
				</div>
		 </div>
		  </div>
		  <script src="<?php base_url() ?>template/js/jquery-1.11.1.min.js"></script>
<script src="<?php base_url() ?>template/js/jquery.dataTables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php base_url() ?>template/css/dataTables.tableTools.css">
<script type="text/javascript" language="javascript" src="<?php base_url() ?>template/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php base_url() ?>template/js/dataTables.bootstrap.js"></script>
		  <script>
		  $(document).ready(function(){
			  // 
			
			  var $j = jQuery.noConflict(true);
			   var table = $j('#feereport_dtable').DataTable({
		dom: 'T<"clear">lfrtip',
		 tableTools: {
           "sSwfPath": "<?php base_url() ?>template/swf/copy_csv_xls_pdf.swf",
		  "aButtons": [
            {
                "sExtends": "copy",
				"bFooter": false,
				 "oSelectorOpts": {
					page: 'current'
				}
            },
            {
                "sExtends": "csv",
				"bFooter": false,
				 "oSelectorOpts": {
					page: 'current'
				}
            },
            {
                "sExtends": "pdf",
				"bFooter": false,
				 "oSelectorOpts": {
					page: 'current'
				}
            },
            {
                "sExtends": "print",
				"bFooter": false,
				 "oSelectorOpts": {
					page: 'current'
				 }
            },
        ]
        }
	});
	
	$j("#feereport_dtable tfoot th").each( function ( i ) {
		
        var select = $j('<select><option value="">All</option></select>')
            .appendTo( $j(this).empty() )
            .on( 'change', function () {
                var val = $j(this).val();
 
                table.column( i )
                    .search( val ? '^'+$j(this).val()+'$' : val, true, false )
                    .draw();
            } );
 
        table.column( i ).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );
			//$('#entry_date').datepicker({format : "dd/mm/yyyy" });  
		  });
		  function delete_record(id){
			var r = confirm("Do you want delete this record");
			
			if (r == true) {
				 window.location='<?php base_url() ?>index.php?admin/del_income_expenses/'+id;
			}
		  }
		  </script>
		  