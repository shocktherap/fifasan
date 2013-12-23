<html>
<head>
<?=$this->load->view('head');?>
</head>
<body>
	<div class="container">
	  <div class="marketing">
	    <div class="row-fluid">
	      <div class="span4">        
	      </div>
	      <div class="span4">
	        <?=form_open('login/index');?>
	            <legend>Login</legend>
	            <?php
                	if ($this->session->flashdata('message')) {
                        echo $this->session->flashdata('message');
                    }
                ?>
	            <?php
		            if(!form_error('username')){
		            $message = "";
		            } else {
		                $message = "error";
		            }
		        ?>
		         <?php
		            if(!form_error('password')){
		            $message2 = "";
		            } else {
		                $message2 = "error";
		            }
		        ?>
	            <div class="control-group <?=$message;?>">
	              <label class="control-label" for="inputEmail">Username</label>
	              <div class="controls">
	                <input type="text" id="inputUsername" name="username" value="<?php echo set_value('username');?>" placeholder="Username"></input>
	                <span class="help-inline"><?php echo form_error('username');?></span>
	              </div>
	            </div>
	            <div class="control-group <?=$message2;?>">
	              <label class="control-label" for="inputPassword">Password</label>
	              <div class="controls">
	                <input type="password" id="inputPassword" name="password" value="" placeholder="Password"></input></br>
	                <span class="help-inline"><?php echo form_error('password');?></span>
	              </div>
	            </div>
	            <div class="control-group">
	              <div class="controls">
	                <button type="submit" class="btn">Sign in</button>
	              </div>
	            </div>
            <?=form_close();?>
	      </div>
	      <div class="span4">
	      </div>
	    </div>

	    <hr class="soften">
	  </div>
	</div>
<?=$this->load->view('script');?>
</body>
</html>