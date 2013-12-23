<?php
/**
* 
*/
class Subpekerjaan extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('get_data');
    $this->load->model('general');
    $this->load->model('input_data');
    session_start();
  }
  public function show($id)
  {
    $data['sub'] = $this->get_data->get_subpekerjaan_by($id);
    $data['pekerjaan_id'] = $id;
    $data['last'] = "echo";
    $data['content'] = "subpekerjaan/show";
    $this->load->view('template',$data);
  }
  public function create($pekerjaan_id)
  {
    $this->general->setValidation();
    $data['pekerjaan_id'] = $pekerjaan_id;
    $data['content'] = "subpekerjaan/create";
    if($this->form_validation->run('subpekerjaan') == true) {
      $this->input_data->new_subpekerjaan($pekerjaan_id);
      $info = "Subpekerjaan Berhasil di Tambah";
      $this->general->informationSuccess($info);
      redirect('subpekerjaan/show/'.$pekerjaan_id);
    } else {
      $this->load->view('template',$data);  
    }
  }
  public function delete($id, $pekerjaan_id)
  {
    $this->input_data->delete_subpekerjaan($id);
    $info = "Subpekerjaan Berhasil di hapus";
    $this->general->informationSuccess($info);
    redirect('subpekerjaan/show/'.$pekerjaan_id);
  }
  public function edit($id, $pekerjaan_id)
  {
    $this->general->setValidation();
    $data['subpekerjaan'] = $this->get_data->get_subpekerjaan_by_ids($id);
    $data['content'] = "subpekerjaan/edit";
    if($this->form_validation->run('subpekerjaan') == true) {
      $this->input_data->edit_subpekerjaan($id);
      $info = "Subpekerjaan Berhasil di Ubah";
      $this->general->informationSuccess($info);
      redirect('subpekerjaan/show/'.$pekerjaan_id);
    } else {
      $this->load->view('template',$data);  
    }
  }
}

?>