<!DOCTYPE html>
<!--[if IEMobile 7 ]>    <html class="no-js iem7"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9 lt-ie10"> <![endif]-->
<!--[if IE 9]><html class="no-js lt-ie10"><![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<!-- <?=Configure::read('TestCheat')?> -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $title_for_layout ?></title>
		<meta name="description" content="<?php echo $title_for_layout ?>">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
		<?php echo $this->fetch('meta'); ?>

		<?php
		echo $this->Html->css(array('jquery-ui-1.10.2.custom.min', 'style'));
		echo $this->Html->script(array('vendor/modernizr-2.6.2.min'));
		?>
	</head>
	<body>
		<div id="container">
		<?php echo $this->fetch('content'); ?>
		</div>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendors/jquery-1.9.1.min.js"><\/script>')</script>
		<?php echo $this->Html->script(array('functions', 'main')); ?>
		<script type="text/javascript">
		  //<![CDATA[
		  $(function() {
			<?php echo $this->fetch('onload'); ?>
		  })
		  //]]>
		</script>
	</body>
</html>