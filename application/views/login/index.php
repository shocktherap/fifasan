<html>
<head>
<meta charset='utf-8'>
<title>Sistem RAB</title>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta name='description' content=''>
<meta name='author' content=''>
<!-- Le styles -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/amelia/bootstrap.min.css" type="text/css">
<link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/css/docs.min.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?= base_url('assets/css/paralax.css'); ?>" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/jquery-1.7.2.min.js'); ?>"></script>
<link rel="shortcut icon" href="<?= base_url(); ?>assets/ico/download.jpg">

</head>
<body>
<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->
<?php
  if(!form_error('username')){
  $message = "";
  } else {
      $message = "has-error";
  }
?>
 <?php
  if(!form_error('password')){
  $message2 = "";
  } else {
      $message2 = "has-error";
  }
?>
<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<?=form_open('login/index');?>
			    		<?php
                if ($this->session->flashdata('message')) {
                	    echo $this->session->flashdata('message');
                   }
              ?>
              <fieldset>
			    	  	<div class="form-group <?=$message;?>">
			    		    <input class="form-control" placeholder="username" name="username" type="text" value="<?php echo set_value('username');?>">
			    		</div>
			    		<div class="form-group <?=$message2;?>">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>
			      <?php form_close();?>
			    </div>
			</div>
		</div>
	</div>
</div>
	<?php $_SERVER['DOCUMENT_ROOT'];?>
	<?=$this->load->view('script');?>
	<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
</body>
</html>