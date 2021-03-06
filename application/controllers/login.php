<?php 
  /**
  * 
  */
  class Login extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      session_start();
      $this->load->model('get_data');
      $this->load->model('general');
    }

    public function index()
    {
      $this->load->library('form_validation');
      $this->general->setValidation();
      if ($this->form_validation->run('login') == FALSE) {
        $this->load->view('login/index');
      } else { 
        $username = $this->input->post('username');
        $password = $this->input->post('password');        
        $datalevel = $this->get_data->get_level_user($username);
        if ($this->general->verify($username, $password) == TRUE){
            $newdata = array(
             'username'   => $username,
             'id'         => $datalevel->id,
             'name'       => $datalevel->name,
             'level'      => $datalevel->level,
             'branch_id'  => $datalevel->branch_id,
             'logged_in'  => TRUE
            );   
            $this->session->set_userdata('login',$newdata);
            $this->session->set_userdata('oauth_token', "aetildfvc3gc8apo");
            $this->session->set_userdata('oauth_token_secret', "l0bnxt00kgp2roi");
            if ($datalevel->level == 'branch') {
              redirect('home');
            } elseif ($datalevel->level == 'employe') {
              redirect('home');
            } elseif ($datalevel->level == 'estimator') {
              redirect('formula/index');
            } elseif ($datalevel->level == 'manager') {
              redirect('manager');
            }
          } else {
            $this->general->information("Username atau Password Salah");
            $this->load->view('login/index');
          }
      }
    }

    public function sign_out()
    {     
      $this->session->unset_userdata('login');
      $this->session->sess_destroy();
      session_destroy();
      redirect('login', 'refresh');
    }

  }
?>