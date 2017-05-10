<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php //print_r($result);exit; ?>
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
    
    
<body>
	<div id="main_body">
		<?php include 'header.php';?>
        <?php 
		include 'navigation.php';?>
        <div class="main-content">
            <?php include 'page_info.php';?>
            <div class="container-fluid padded">
<div class="box">
  <div class="box-content padded">
  <div class="tab-content"  style="overflow-y: hidden;">
            <!----TABLE LISTING STARTS---><!----TABLE LISTING ENDS--->
            <h3 class="custom-tam-title">
                        <i class="icon-pushpin"></i>Previous Question Papers Edit</h3>
            
			<!----CREATION FORM STARTS---->
		  <div class="box-content">
                	<?php echo form_open('admin/editpaper' , array('class' => 'form-horizontal validatable', 'enctype' => 'multipart/form-data', 'target'=>'_top'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('name');?></label>
                                <div class="controls">
                                    <input type="text" class="" name="title" value="<?php echo $result[0]->title;?>"/>
                                </div>
                            </div>
                            
							<input type="hidden"  name="id" value="<?php echo $result[0]->paperid; ?>" />
                             <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('classname');?></label>
                                <div class="controls">
                                    <select name="classname" class="uniform">
                                    	<option value="">--- Select Class Name --- </option>
                                        <option value="1" <?php if($result[0]->classname=='1'){ ?> selected="selected"<?php } ?>>1st Class</option>
                                        <option value="2" <?php if($result[0]->classname=='2'){ ?> selected="selected"<?php } ?>>2nd Class</option>
                                        <option value="3" <?php if($result[0]->classname=='3'){ ?> selected="selected"<?php } ?>>3rd Class</option>
                                        <option value="4" <?php if($result[0]->classname=='4'){ ?> selected="selected"<?php } ?>>4th Class</option>
                                        <option value="5" <?php if($result[0]->classname=='5'){ ?> selected="selected"<?php } ?>>5th Class</option>
                                        <option value="6" <?php if($result[0]->classname=='6'){ ?> selected="selected"<?php } ?>>6th Class</option>
                                        <option value="7" <?php if($result[0]->classname=='7'){ ?> selected="selected"<?php } ?>>7th Class</option>
                                        <option value="8" <?php if($result[0]->classname=='8'){ ?> selected="selected"<?php } ?>>8th Class</option>
                                        <option value="9" <?php if($result[0]->classname=='9'){ ?> selected="selected"<?php } ?>>9th Class</option>
                                        <option value="10" <?php if($result[0]->classname=='10'){ ?> selected="selected"<?php } ?>>10th Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('subject');?></label>
                                <div class="controls">
                                   <select name="subject" class="uniform">
                                    	<option value="">--- Select Subject Name --- </option>
                                        <option value="telugu" <?php if($result[0]->subject=='telugu'){ ?> selected="selected"<?php } ?>>Telugu</option>
                                        <option value="hindi" <?php if($result[0]->subject=='hindi'){ ?> selected="selected"<?php } ?>>Hindi</option>
                                        <option value="english" <?php if($result[0]->subject=='english'){ ?> selected="selected"<?php } ?>>English</option>
                                        <option value="maths" <?php if($result[0]->subject=='maths'){ ?> selected="selected"<?php } ?>>Maths</option>
                                        <option value="science" <?php if($result[0]->subject=='science'){ ?> selected="selected"<?php } ?>>Science</option>
                                        <option value="social" <?php if($result[0]->subject=='social'){ ?> selected="selected"<?php } ?>>Social</option>
                                  </select>
                                </div>
                            </div>
                            <div class="control-group" id="clone-div">
                                <label class="control-label"><?php echo get_phrase('Papers Upload');?></label>
                                <div class="controls"  style="width:210px;">
                                    <input type="file" class="validate[required]" name="book_file" id="imgInp"/><?php //
							$explode=explode(".",$result[0]->book_file);
							if($explode[1]=='pdf'){?>
                            <img src="<?php echo base_url();?>uploads/pdf.jpg"class="avatar-medium" /><br /><?php echo $result[0]->book_file; ?>
							<?php }else if($explode[1]=='doc' || $explode[2]=='docx'){?>
                            <img src="<?php echo base_url();?>uploads/word.jpg"class="avatar-medium" /><br /><?php echo $result[0]->book_file; ?>
							<?php }else if($explode[1]=='xlsx'){?>
							<img src="<?php echo base_url();?>uploads/excel.jpg"class="avatar-medium" /><br /><?php echo $result[0]->book_file; ?>
							<?php }else{?>
                            <img src="<?php echo base_url();?>uploads/ebook_image/<?php echo $result[0]->book_file; ?>"class="avatar-medium" /><br  /><?php echo $result[0]->book_file; ?>
							<?php }?>
                                </div>
                               
                            </div>
                            <!--<div style="float: left;left: 456px;overflow: hidden;position: absolute;z-index: 999;cursor:pointer;" onclick="return addMore();">Add More</div>
                            <div id="clonediv"></div>
                             <div class="control-group" >
                                <label class="control-label"><?php //echo get_phrase('Pdf File');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="validate[required]" name="pdf_file" id="imgInp"/>
                                </div>
                            </div>-->

                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-gray"><?php echo get_phrase('Update');?></button>
                        </div>
                    </form>                
                </div>
			<!----CREATION FORM ENDS--->
            
		</div>
	</div>
</div>