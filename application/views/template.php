<html lang="en">
<head>
  <?php $this->load->view('head');?>
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active">
                <?=anchor('home/index', 'Home');?>
              </li>
              <li class="">
                <?=anchor('formula/index', 'Formula');?>
              </li>
              <li class="">
                <?=anchor('pekerjaan/index', 'Pekerjaan');?>
              </li>
              <li class="">
                <?=anchor('login/sign_out', 'Sign Out');?>
              </li>
            </ul>
            <p class="navbar-text pull-right">
              <?php $session_data = $this->session->userdata('login');?>
              <i class="icon-user icon-white"></i> <?=anchor('home/show_user/', 'Selamat Datang '.$session_data['name']);?>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <?php if ($this->uri->segment(2)!='detail') { ?>
        <div class="span2"></div>
        <?php }  else { ?>
          <div class="span3 bs-docs-sidebar">          
            <ul class="nav nav-list bs-docs-sidenav affix-top">
              <?php foreach ($pekerjaan as $key) { ?>
                <li><a href="#<?=$key->id;?>"><i class="icon-chevron-right"></i> <?=$key->nama;?></a></li>  
              <?php } ?>
            </ul>
        </div>
        <?php } ?>
        <div class="span8">
          <ul class="breadcrumb" style="margin-top: 10px, margin-bottom: 5px;">
              <?php for ($i=0; $i < 6; $i++) { 
                if ($this->uri->segment($i)!= null) {
                  ?>
                    <li><?=$this->uri->segment($i);?><span class="divider">/</span></li>
                <?php
                } else {
                  echo "";
                }
              }?>
          </ul>
          <?php
              if ($this->session->flashdata('message')) {
              echo $this->session->flashdata('message');
            }
          ?>
          <?php $this->load->view($content);?>
        </div>
        <div class="span1">
        </div>
      </div>
      <footer>
        <!-- <div class="container"> -->
          <p class="pull-right"><a href="#">Back to top</a></p>
          <p>Designed and built with love to Fifasan by <a href="http://twitter.com/twitter" target="_blank">@izqil</a> </p>
        <!-- </div> -->
      </footer>
    </div>
    <?=$this->load->view('script');?>
</body>
</html>