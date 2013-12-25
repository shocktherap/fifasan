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
      // $data['daftar'] = $this->get_data->get_subprojectpekerjaan($id_project);
      $data['content'] = "subproject/daftar_subpekerjaan";
    }
    $this->load->view('template',$data);
   
  }
  public function save_sub_pekerjaan($id_project)
  {
    $data =  $this->input->post('data_subpekerjaan');    
    foreach ($data as $key) {
      $data_sub = $this->get_data->get_subpekerjaan_by_params("id", $key , "pekerjaan_id");
      $this->input_data->input_data_project_subpekerjaans($id_project, $key, $data_sub->pekerjaan_id);
    }
    $this->input_data->update_status_project($id_project);
    $info = "Subpekerjaan berhasil ditambah";
    $this->general->informationSuccess($info);
    redirect('home/index');
  }
  public function delete_sub($id_project)
  {
    $this->input_data->delete_sub($id_project);
    $this->input_data->delete_project($id_project);
    $info = "Project Berhasil di hapus";
    $this->general->informationSuccess($info);
    redirect('subproject/show/'.$id_project);
  }

  public function rab($id_project)
  {
    $pekerjaan = $this->get_data->get_pekerjaan();
    $number1 = 2; 
    foreach ($pekerjaan as $key) { 
      $number2 = 1;
      $data = $this->get_data->get_subprojectpekerjaan2($id_project,$key->id);
      foreach ($data as $pekerjaan_data) {
        $jumlah = $this->input->post("jumlah_".$number1."_".$number2);
        $volume = $this->input->post("volume_".$number1."_".$number2);

        $subpekerjaan_id = $pekerjaan_data->subpekerjaan_id;
        $this->input_data->input_rab($id_project, $subpekerjaan_id, $jumlah, $volume);    
        $number2+=1;
      }
      $number1+=1;
    }
    redirect('subproject/detail/'.$id_project);
  }

  public function detail($id_project)
  {
    $data['pekerjaan'] = $this->get_data->get_pekerjaan(); 
    $data['id_project'] = $id_project;
    $data['content'] = "subproject/detail";
    $this->load->view('template',$data);
  }
  
  public function output($id_project)
  {
    $nomor = 0;
    $this->load->helper('pdf');
    $this->load->library('cezpdf');
    prep_pdf();
    $this->cezpdf->addText(220,800,15,"Rencana Anggaran Biaya");
    $subproject = $this->get_data->subproject_pekerjaan($id_project);

    foreach ($subproject as $key) {
      $db_data[] = array('Nomor' => $nomor+=1, 'category' =>  $key->subpekerjaan_id, 'output' => 'Rp. '.$key->pengeluaran);
    }
    
    $col_names = array(
      'Nomor' => 'Nomor',
      'category' => 'Uraian',
      'output' => 'Jumlah',
    );
    // $this->cezpdf->ezTable($db_data,$col_names,'Kriteria Utama',array('width'=>10,'showHeading'=> 0));
    $this->cezpdf->ezStream();
  }
}
?>