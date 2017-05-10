<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php //print_r($result[0]->ebooks_category_id);exit; 
//$getdata = $this->db->get_where('previousquestionpapers', array('subject' => $this->uri->segment(3),'classname'=>$this->uri->segment(4)))->result_array();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <script type="text/javascript" src="<?php echo base_url();?>template/install/jquery.min.js"></script>
        <?php echo $this->dynamic_load->load_files('header'); ?>
	
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script>
			var urls = '<?php 
						echo json_encode(
								array('base_url' => base_url(),
									'backend_url' => backend_view(),
									'assets' => array( 'base' => asset_url(),
										'js' => asset_url('js'),
										'css' => asset_url('css'),
										'img' => asset_url('img')
									)
								)
							)
						?>';
		</script>
            <?php include 'includes.php';?>
        <title><?php echo $page_title;?> | <?php echo $system_title;?></title>
       

    </head>
    <style>
			/*.container {
				margin-top: 110px;
			}
			.error {
				color: #B94A48;
			}
			.form-horizontal {
				margin-bottom: 0px;
			}
			.hide{display: none;}*/
		</style>
    
<body>
	<div id="main_body">
		<?php include 'header.php';?>
        <?php 
		include 'navigation.php';?>
        <div class="main-content">
            <div class="container-fluid padded">

                    <div class="container-fluid">
            <div class="row-fluid">
                <div class="area-top clearfix">
                    <div class="pull-left header">
                        <h3 class="title">
                        <i class="icon-pushpin"></i>
                        <?php echo get_phrase('Online Test');?></h3>
                    </div>

                </div>
            </div>
        
        <!--------FLASH MESSAGES Nulled by vokey--->
        
		<!---->
        
        
                    <!--<div class="container-fluid padded tam-custom-border1"> -->
                    <div>
                
                

    <center>
<?php echo form_open('student/onlinetest' , array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data', 'target'=>'_top'));?>
        <div style="float:none !important;" class="span4">

            <div class="box">

                <div class="box-header">

                    <span class="title"> <i class="icon-info-sign"></i> Online Test.</span>

                </div>
				
                <div class="box-content padded tam-custom-border1">

                    <p><br>
                      <span class="controls">
                      <select name="classname" id="classname" class="uniform">
                        <option value="1" <?php if($_POST['1']=='1'){?> selected="selected" <?php } ?>>1st Class</option>
                        <option value="2" <?php if($_POST['2']=='2'){?> selected="selected" <?php } ?>>2nd Class</option>
                        <option value="3" <?php if($_POST['3']=='3'){?> selected="selected" <?php } ?>>3rd Class</option>
                        <option value="4" <?php if($_POST['4']=='4'){?> selected="selected" <?php } ?>>4th Class</option>
                        <option value="5" <?php if($_POST['5']=='5'){?> selected="selected" <?php } ?>>5th Class</option>
                        <option value="6" <?php if($_POST['6']=='6'){?> selected="selected" <?php } ?>>6th Class</option>
                        <option value="7" <?php if($_POST['7']=='7'){?> selected="selected" <?php } ?>>7th Class</option>
                        <option value="8" <?php if($_POST['8']=='8'){?> selected="selected" <?php } ?>>8th Class</option>
                        <option value="9" <?php if($_POST['9']=='9'){?> selected="selected" <?php } ?>>9th Class</option>
                        <option value="10" <?php if($_POST['10']=='10'){?> selected="selected" <?php } ?>>10th Class</option>
                      </select>
                      </span><!--<hr />-->
                      
                      <script>

                        /*$(document).ready(function() {

                            function ask()

                            {

                                Growl.info({title:"Select a class name and subject to view the papers",text:" "});

                            }

                            setTimeout(ask, 500);

                        });*/

                      </script>
                      
                    </p>
                    <p><span class="controls">
                      <select name="subject" id="subject" class="uniform">
                         <option value=''>--- Select Subject Name --- </option>
                        <option value="telugu" <?php if($_POST['telugu']=='telugu'){?> selected="selected" <?php } ?>>Telugu</option>
                        <option value="hindi" <?php if($_POST['hindi']=='hindi'){?> selected="selected" <?php } ?>>Hindi</option>
                        <option value="english" <?php if($_POST['english']=='english'){?> selected="selected" <?php } ?>>English</option>
                        <option value="maths" <?php if($_POST['maths']=='maths'){?> selected="selected" <?php } ?>>Maths</option>
                        <option value="science" <?php if($_POST['science']=='science'){?> selected="selected" <?php } ?>>Science</option>
                        <option value="social" <?php if($_POST['social']=='social'){?> selected="selected" <?php } ?>>Social</option>
                      </select>
                    </span></p>
                   <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('start');?></button>
                        </div> 
                </div>

            </div>

        </div>
</form>
    </center>
<div class="box">
<script type="text/javascript">
function getValue(){
    subject2=document.getElementById('subject2').value;
	classname2=document.getElementById('classname2').value;
	if(classname2!='' && subject2!=''){
	 window.location="index.php?student/questionpaper/"+subject2+"/"+classname2
	}
}
</script>
<?php //if($this->uri->segment(3)!='' && $this->uri->segment(4)!=''){?>
<?php if(!empty($_POST)){?>
                            <div class="box-content">

<?php //if(!empty($this->uri->segment(4))){?>

                                <div id="dataTables">
                                    <?php /*?><table width="200" border="1">
                                    <?php //print_r($onlinetest);?>
                                    <?php $i=1; foreach($onlinetest as $val) {?>
                                      <tr>
                                        <td colspan="2">Question <?php echo $i;?></td>
                                        <td colspan="2"><?php echo  $val['question'];?></td>
                                      </tr>
                                      <tr>
                                        <td><?php echo  $val['option1'];?><input type="radio" name="op1" /></td>
                                        <td><?php echo  $val['option2'];?><input type="radio" name="op2" /></td>
                                        <td><?php echo  $val['option3'];?><input type="radio" name="op3" /></td>
                                        <td><?php echo  $val['option4'];?><input type="radio" name="op4" /></td>
                                      </tr>
                                      <?php  $i++;} ?>
                                      <!--<tr>
                                        <td colspan="2">Q2</td>
                                        <td colspan="2">kdjsfak</td>
                                      </tr>
                                      <tr>
                                        <td>op1<input type="radio" name="op1" /></td>
                                        <td>op2<input type="radio" name="op2" /></td>
                                        <td>op3<input type="radio" name="op3" /></td>
                                        <td>op4<input type="radio" name="op4" /></td>
                                      </tr>-->
                                    </table><?php */?>
                    <?php echo form_open('student/result' , array('class' => 'form-horizontal validatable form-horizontal', 'enctype' => 'multipart/form-data', 'target'=>'_top','method'=>'post','id'=>'login'));?>

								<!--<form class="form-horizontal" role="form" id='login' method="post" action="result.php">-->
					<?php 
					//$res = mysql_query("select * from questions where category_id='$category' ORDER BY RAND()") or die(mysql_error());
                    $rows = count($onlinetest);//mysql_num_rows($res);
					//echo "<pre>";print_r($rows);
					$i=1;
                //while($result=mysql_fetch_array($res)){
					foreach($onlinetest as $result){
					?>
					
                    <?php if($i==1){?>         
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"> <?php echo $i?>.<?php echo $result['question'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option1'];?>
                   <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/>                                                                      
                    <br/>
                    <button id='next<?php echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                    </div>     

                     <?php }elseif($i<1 || $i<$rows){?>

                       <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $result['question'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option1'];?>
                    <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/>                                                                      
                    <br/>
                    <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>                    
                    <button id='next<?php echo $i;?>' class='next btn btn-success' type='button' >Next</button>
                    </div>

                   <?php }elseif($i==$rows){?>
                    <div id='question<?php echo $i;?>' class='cont'>
                    <p class='questions' id="qname<?php echo $i;?>"><?php echo $i?>.<?php echo $result['question'];?></p>
                    <input type="radio" value="1" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option1'];?>
                    <br/>
                    <input type="radio" value="2" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option2'];?>
                    <br/>
                    <input type="radio" value="3" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option3'];?>
                    <br/>
                    <input type="radio" value="4" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/><?php echo $result['option4'];?>
                    <br/>
                    <input type="radio" checked='checked' style='display:none' value="5" id='radio1_<?php echo $result['onlinetest_id'];?>' name='<?php echo $result['onlinetest_id'];?>'/>                                                                      
                    <br/>

                    <button id='pre<?php echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>                    
                    <button id='next<?php echo $i;?>' class='next btn btn-success' type='submit'>Finish</button>
                    </div>
					<?php } $i++;} ?>

				</form>
                                </div>
<?php  //} ?>
                            </div>
                            <?php } ?>
                        </div>

<script>

    function readURL(input) {

        if (input.files &amp;&amp; input.files[0]) {

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



</script>
<script type="text/javascript">
	
		$('.cont').addClass('hide');
		count=$('.questions').length;
		 $('#question'+1).removeClass('hide');

		 $(document).on('click','.next',function(){

		     element=$(this).attr('id');
		     last = parseInt(element.substr(element.length - 1));
		     nex=last+1;
		     $('#question'+last).addClass('hide');

		     $('#question'+nex).removeClass('hide');
		 });

		 $(document).on('click','.previous',function(){
             element=$(this).attr('id');
             last = parseInt(element.substr(element.length - 1));
             pre=last-1;
             $('#question'+last).addClass('hide');

             $('#question'+pre).removeClass('hide');
         });

		</script>
</script>

            </div> 
</div></div></div></div>
                    <div style="clear:both;color:#aaa; padding:20px;">
    	
                        		<center>&copy; 2013, N-gurukul</center>
  </div>        </div>
