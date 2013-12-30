<?php
/**
* 
*/
class Home extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('get_data');
    $this->load->model('general');
    $this->load->model('input_data');
    $this->load->helper('download');
    session_start();
  }

  public function index()
  {
    $data['list_project'] = $this->get_data->get_all_project();
    $data['content'] = "home/list_of_project";
    $this->load->view('template',$data);
  }
  public function create_project()
  {
    $this->general->setValidation();
    $data['content'] = "home/from_create_project";
    if($this->form_validation->run('create_project') == FALSE) {
      $this->load->view('template',$data);
    } else { 
      $this->input_data->create_new_project();
      $data = $this->get_data->get_last_project();
      $this->input_data->input_pengeluaran($data->project_id);
      $info = "Project Berhasil di tambah";
      $this->general->informationSuccess($info);
      redirect('home/index');
    }
  }
  public function delete_project($id_project)
  {
    $this->input_data->delete_sub($id_project);
    $this->input_data->delete_project($id_project);
    $this->input_data->delete_subtotal($id_project);
    $info = "Project Berhasil di hapus";
    $this->general->information($info);
    redirect('home/index');
  }
  public function show_project($id_project)
  {
    $data['id_project'] = $id_project;
    $data['storage'] =  $this->get_data->get_storage('project_id',$id_project);
    $data['data_project'] = $this->get_data->get_project_by_id($id_project);
    $data['content'] = "home/show_of_project";
    $this->load->view('template',$data);
  }
  public function edit_project($id_project)
  {
    $this->general->setValidation();
    $data['status'] = $this->get_data->get_status();
    $data['data_project'] = $this->get_data->get_project_by_id($id_project);
    $data['content'] = "home/update_of_project";
    if($this->form_validation->run('create_project') == FALSE) {
      $this->load->view('template',$data);
    } else { 
      $this->input_data->update_project($id_project);
      $info = "Project Berhasil di Update";
      $this->general->informationSuccess($info);
      redirect('home/index');
    }
  }
  public function show_user()
  {
    $session_data = $this->session->userdata('login');
    $data['user'] = $this->get_data->get_detail_user($session_data['id']);    
    $data['content'] = "home/show_user";
    if($this->form_validation->run('change_password') == FALSE) {
      $this->load->view('template', $data);
    } else {
      if ($data['user']->password == $this->input->post('old_password')) {
        $info = "Password berhasil diubah";
        $this->general->informationSuccess($info);
        redirect('home/show_user');   
      }
      else{
        $info = "Password lama yang anda masukan salah";
        $this->general->information($info);
        redirect('home/show_user');   
      }
    }    
  }
  public function download($id)
  {
    $key = $this->get_data->dowload_data($id);

    $data = file_get_contents(base_url("filestorage/".$key->file)); // Read the file's contents
    $name = $key->file;
    force_download($name, $data);
  }
  public function delete_file($id, $id_project)
  {

    $key = $this->get_data->dowload_data($id);
    $string = base_url('filestorage/'.$key->file);
    unlink($string);
    // $this->input_data->delete_file($id);

    $info = "File Berhasil Dihapus";
    $this->general->informationSuccess($info);
    redirect('home/show_project/'.$id_project);   
  }
}
?>