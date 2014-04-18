<html lang="en">
<head>
  <?php $this->load->view('head');?>
  </head>
  <body>
    <?php $session_data = $this->session->userdata('login');?>
    <!-- <div class="navbar navbar-inverse navbar-fixed-top">
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
              <?php if ($session_data['level'] == 'employe') {?>
              <li class="<?php if ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='') {
              echo "active";
              }?>">
              <?=anchor('home/index', 'Home');?>
              </li>  
              <li class="<?php if ($this->uri->segment(2)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('home/onthemap', 'Peta Lokasi');?>
              </li>

              <?php } elseif ($session_data['level'] == 'branch') { ?>
              <li class="<?php if ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='index') {
                echo "active";
              }?>">
                <?=anchor('home/index', 'Home');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='employe') {
                echo "active";
              }?>">
                <?=anchor('employe', 'Data Pegawai');?>
              </li>
              <li class="<?php if ($this->uri->segment(2)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('home/onthemap', 'Peta Lokasi');?>
              </li>
              <?php } elseif($session_data['level'] == 'manager'){ ?>
              <li class="<?php if ($this->uri->segment(1)=='branch') {
                echo "active";
              }?>">
                <?=anchor('manager/index', 'Data Cabang');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('manager/onthemap', 'Peta Lokasi');?>
              </li>
              <?php } elseif ($session_data['level'] == 'estimator') { ?>
              <li class="<?php if ($this->uri->segment(1)=='formula') {
                echo "active";
              }?>">
                <?=anchor('formula/index', 'Rumus RAB');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='employe') {
                echo "active";
              }?>">
                <?=anchor('employe', 'Data Pegawai');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='branch') {
                echo "active";
              }?>">
                <?=anchor('manager/index', 'Data Cabang');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='pekerjaan') {
                echo "active";
              }?>">
                <?=anchor('pekerjaan/index', 'Data Pekerjaan');?>
              </li>  
              <?php } ?>
              <li class="">
                <?=anchor('login/sign_out', 'Sign Out');?>
              </li>
            </ul>
            <p class="navbar-text pull-right">
              
              <i class="icon-user icon-white"></i> <?=anchor('home/show_user/', 'Selamat Datang '.$session_data['name']);?>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div> -->
    <div class='container'>
      <ul class="nav nav-pills">
        <li class='pull-right'><span class="glyphicon glyphicon-user"> <?=anchor('home/show_user/', 'Selamat Datang '.$session_data['name']);?>
        </li>
      </ul>
      <div class="masthead">
        <h3 class="text-muted">Moelia Project</h3>
        <ul class="nav nav-justified">
          <?php if ($session_data['level'] == 'employe') {?>
              <li class="<?php if ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='') {
              echo "active";
              }?>">
              <?=anchor('home/index', 'Home');?>
              </li>  
              <li class="<?php if ($this->uri->segment(2)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('home/onthemap', 'Peta Lokasi');?>
              </li>

              <?php } elseif ($session_data['level'] == 'branch') { ?>
              <li class="<?php if ($this->uri->segment(1)=='home' && $this->uri->segment(2)=='index') {
                echo "active";
              }?>">
                <?=anchor('home/index', 'Home');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='employe') {
                echo "active";
              }?>">
                <?=anchor('employe', 'Data Pegawai');?>
              </li>
              <li class="<?php if ($this->uri->segment(2)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('home/onthemap', 'Peta Lokasi');?>
              </li>
              <?php } elseif($session_data['level'] == 'manager'){ ?>
              <li class="<?php if ($this->uri->segment(1)=='branch') {
                echo "active";
              }?>">
                <?=anchor('manager/index', 'Data Cabang');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='onthemap') {
                echo "active";
              }?>">
                <?=anchor('manager/onthemap', 'Peta Lokasi');?>
              </li>
              <?php } elseif ($session_data['level'] == 'estimator') { ?>
              <li class="<?php if ($this->uri->segment(1)=='formula') {
                echo "active";
              }?>">
                <?=anchor('formula/index', 'Rumus RAB');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='employe') {
                echo "active";
              }?>">
                <?=anchor('employe', 'Data Pegawai');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='branch') {
                echo "active";
              }?>">
                <?=anchor('manager/index', 'Data Cabang');?>
              </li>
              <li class="<?php if ($this->uri->segment(1)=='pekerjaan') {
                echo "active";
              }?>">
                <?=anchor('pekerjaan/index', 'Data Pekerjaan');?>
              </li>  
              <?php } ?>
              <li class="">
                <?=anchor('login/sign_out', 'Sign Out');?>
              </li>
        </ul>
      </div>
    
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
          <ol class="breadcrumb" style="margin-top: 10px, margin-bottom: 5px;">
              <?php for ($i=0; $i < 6; $i++) { 
                if ($this->uri->segment($i)!= null) {
                  ?>
                    <li><?=$this->uri->segment($i);?></li>
                <?php
                } else {
                  echo "";
                }
              }?>
          </ol>
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
      <div class='footer'>
          <p class="pull-right"><a href="#">Back to top</a></p>
          <p>PT. Moelia Graha Estetika ©2014</p>
      </div>
    </div>
    <?=$this->load->view('script');?>
</body>
</html>