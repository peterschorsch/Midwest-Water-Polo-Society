<!DOCTYPE HTML>
<html class="htmlFoot">
	<head>
		<!-- Metadata -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		
		<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
		
		<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script> 
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
		
		<!-- include summernote css/js-->
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.css" rel="stylesheet">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.7.3/summernote.js"></script>
		
		<!-- Custom CSS Code -->
		<link rel="stylesheet" href="<?=base_url();?>public/css/bootstrap-3.3.5-dist/css/alt.css">
		
		<!-- Custom JS Code -->
		<script src="<?=base_url();?>public/js/default.js" type="text/javascript"></script>
		
		<!-- Multi-browser Date Picker -->
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<!-- Webpage Title -->
		<title><?php echo isset($title) ? $title : 'MWWPS'?></title>
		
	</head>
	<body class="bodyback" >
		<nav class="navbar navbar-inverse"><?php $this->load->view('layout/header');?></nav>
		<!--nav class="navbar navbar-inverse"><?php $this->load->view('layout/navigation');?></nav-->
		<?php $this->load->view('layout/changerequest');?>
		<main><?php $this->load->view($view);?></main>
		<footer class="footerReserve"><?php $this->load->view('layout/footer');?></footer>
	</body>
</html>