<?php
/**
* 
*/
class Employe extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('managers');
    $this->load->model('user'); 
    $this->load->model('verify');
    $this->load->model('general');
    session_start();
  }

  public function index()
  {
    $session_data = $this->session->userdata('login');
    $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);

    $data['employe'] = $this->user->getuserusing('branch_id', $branch->id);
    $data['content'] = "employe/index";
    $this->load->view('template', $data);
  }

  public function createemploye()
  {
    $session_data = $this->session->userdata('login');
    $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);

    if($this->form_validation->run('employe') == TRUE) {
      if ($this->verify->checkuserbranch($this->input->post('username')) == TRUE ) {
          $this->user->inputnewemploye($branch->id);
          $info = "Pegawai Telah Ditambah";
          $this->general->informationSuccess($info);
          redirect('employe/index');
      } else {
        $info = "Username Telah Terdaftar";
        $this->general->information($info);
        $data['content'] = "employe/form_create_employe";
      }
    } else {
      $data['content'] = "employe/form_create_employe";
    }
      $this->load->view('template',$data);
  }
  public function delete($id)
  {
    $this->user->delete_user($id);
    $info = "Pegawai Telah Dihapus";
    $this->general->informationSuccess($info);
    redirect('employe/index');
  }

  public function resetpassword($id)
  {
    $this->user->resetpassword($id);
    $info = "Password Pegawai Telah Direset (12345) ";
    $this->general->informationSuccess($info);
    redirect('employe/index'); 
  }
}
?>