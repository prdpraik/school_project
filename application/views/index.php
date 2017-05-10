<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="shortcut icon" href="<?php echo base_url();?>template/images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo base_url();?>template/images/favicon.ico" type="image/x-icon">
        <script type="text/javascript" src="<?php echo base_url();?>template/install/jquery.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>template/css/font.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
        <link href="<?php echo base_url();?>template/css/ekattor.css" media="screen" rel="stylesheet" type="text/css" />
		
        <!--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">-->
		<link href="<?php echo base_url();?>font-awesome-4.7.0/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>template/css/bootstrap-tagsinput.css" media="screen" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>template/css/tammanager.css" media="screen" rel="stylesheet" type="text/css" />
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
        <?php include $this->session->userdata('login_type').'/navigation.php';?>
        <div class="main-content">
            <?php include 'page_info.php';?>
            <div class="container-fluid padded">
                
                <?php  include $this->session->userdata('login_type').'/'.$page_name.'.php';?>
            </div> 
        <?php echo $this->dynamic_load->load_files('footer'); ?>
        <?php include 'footer.php';?>
        </div>
	</div>
</body>
<script type="text/javascript">
 $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
})
</script>
<?php include 'modal_hidden.php';?> 
</html>