<?php
/**
* 
*/
class Formula extends CI_Controller
{
  
  function __construct()
  {
    parent::__construct();
    $this->load->model('get_data');
    $this->load->model('general');
    $this->load->model('input_data');
    session_start();
  }
  public function index()
  {
    $data['pekerjaan'] = $this->get_data->get_pekerjaan(); 
    $data['content'] = "formula/list_of_formula";
    $this->load->view('template',$data);
  }
  public function edit($id, $id_sub)
  {
    if($this->form_validation->run('formula') == true) {
      $this->input_data->edit_formula($id);
      $info = "Formula Berhasil di ubah";
      $this->general->informationSuccess($info);
      redirect('formula/show/'.$id_sub);
    } else {
      $data['data_sub_formula'] = $this->get_data->get_sub_formula($id);
      $data['content'] = "formula/formula_edit";  
    }
    $this->load->view('template',$data); 
  }
  public function show($id_sub)
  { 
    $data['id_sub'] = $id_sub;
    $data['data'] = $this->get_data->get_sub_in_formula($id_sub);
    $data['content'] = "formula/show_per_sub";
    $this->load->view('template',$data);  
  }
  public function delete($id, $id_sub)
  {
    $this->input_data->delete_formula($id);
    redirect('formula/show/'.$id_sub);
  }
  public function create($id_sub)
  {
    $data['id_sub'] = $id_sub;
    if($this->form_validation->run('formula') == true) {
      $this->input_data->create_formula($id_sub);
      $info = "Formula Berhasil di tambah";
      $this->general->informationSuccess($info);
      redirect('formula/show/'.$id_sub);
    } else {
      $data['content'] = "formula/formula_form_new";
    }
    $this->load->view('template',$data); 
  }
}
?>