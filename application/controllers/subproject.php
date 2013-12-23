<?php
/**
* 
*/
class Subproject extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('get_data');
    $this->load->model('general');
    $this->load->model('input_data');
    session_start();
  }
  public function show($id_project)
  {
    $stats = $this->get_data->get_project_by_id($id_project);
    $data['id_project'] = $id_project;
    $data['pekerjaan'] = $this->get_data->get_pekerjaan(); 
    if ($stats->subpekerjaan == 0) {
      $data['content'] = "subproject/list_of_pekerjaan";
    } else {
      $data['daftar'] = $this->get_data->get_subprojectpekerjaan($id_project);
      $data['content'] = "subproject/daftar_subpekerjaan";
    }
    $this->load->view('template',$data);
   
  }
  public function save_sub_pekerjaan($id_project)
  {
    $data =  $this->input->post('data_subpekerjaan');    
    foreach ($data as $key) {
      $this->input_data->input_data_project_subpekerjaans($id_project, $key);
    }
    $this->input_data->update_status_project($id_project);
    $info = "Subpekerjaan berhasil ditambah";
    $this->general->informationSuccess($info);
    redirect('home/index');
  }
  public function delete_sub($id_project, $id_sub)
  {
    $this->input_data->delete_sub($id_project, $id_sub);
    $info = "Project Berhasil di hapus";
    $this->general->informationSuccess($info);
    redirect('subproject/show/'.$id_project);
  }
}
?>