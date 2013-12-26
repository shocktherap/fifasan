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
      if ($this->get_data->check_project($id_project) == false) {
        $data['content'] = "subproject/daftar_subpekerjaan";  
      } else {
        redirect('subproject/detail/'.$id_project);
      }
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

  public function edit($id_project)
  {
    $data['id_project'] = $id_project;
    $data['pekerjaan'] = $this->get_data->get_pekerjaan(); 
    $data['content'] = "subproject/edit";
    $this->load->view('template',$data); 
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
    $data['project'] = $this->get_data->get_project_by_id($id_project);
    $data['content'] = "subproject/detail";
    $this->load->view('template',$data);
  }
  
  // public function output($id_project)
  // {
  //   $nomor = 0;
  //   $this->load->helper('pdf');
  //   $this->load->library('cezpdf');
  //   prep_pdf();
  //   $subproject = $this->get_data->subproject_pekerjaan($id_project);
  //   $project = $this->get_data->get_project_by_id($id_project);
  //   $this->cezpdf->addText(220,800,15,"Rencana Anggaran Biaya");
  //   $this->cezpdf->addText(50,750,12,"Nama Project: ".$project->nama);
  //   $this->cezpdf->addText(50,730,12,"Lokasi Project: ".$project->lokasi);
  //   $this->cezpdf->addText(50,710,12,"Tahun Project: ".$project->tahun);
  //   $this->cezpdf->addText(50,690,12,"Jenis Project: ".$project->jenis);
  //   $this->cezpdf->addText(50,670,12,"Pemilik Project: ".$project->pemilik);    

  //   // foreach ($subproject as $key) {
  //   //   $db_data[] = array('Nomor' => $nomor+=1, 'category' =>  $key->subpekerjaan_id, 'output' => 'Rp. '.$key->pengeluaran);
  //   // }

  //   $db_data[] = array('Nomor' => 1, 'category' =>  "Buku", 'output' => 'Rp. 100000');

  //   $col_names = array(
  //     'Nomor' => 'Nomor',
  //     'category' => 'Uraian',
  //     'output' => 'Jumlah',
  //   );
  //   $this->cezpdf->ezTable($db_data,$col_names,'Kriteria Utama',array('width'=>10,'showHeading'=> 0));
  //   $this->cezpdf->ezStream();
  // }

  public function loadpdf($id_project)
  {
    $subproject = $this->get_data->subproject_pekerjaan($id_project);
    // print_r($subproject);
    $project = $this->get_data->get_project_by_id($id_project);
    $this->load->library('cezpdf');
    $pdf = new CezPDF("a4");
    $pdf->ezText("Rencana Anggaran Biaya", 16, array('justification' => 'center'));
    $pdf->ezText("Nama Project: ".$project->nama, 12);
    $pdf->ezText("Lokasi Project: ".$project->lokasi, 12);
    $pdf->ezText("Tahun Project: ".$project->tahun, 12);
    $pdf->ezText("Jenis Project: ".$project->jenis, 12);
    $pdf->ezText("Pemilik Project: ".$project->pemilik, 12);
    $id = 0;
    $pekerjaan = $this->get_data->get_pekerjaan();
    foreach ($pekerjaan as $key) {
      $pekerjaan = $this->get_data->get_subprojectpekerjaan2($id_project,$key->id);
      $no = 0;
      $data[$key->id][] = array('no' => '','item' => "<strong>$key->nama</strong>",'harga_satuan' => '', 'volume' => '', 'total_harga' => '' );
      foreach ($pekerjaan as $subpekerjaan) {
        $no+=1;
        $data[$key->id][] = array('no' => $no, 'item' => $subpekerjaan->nama,'harga_satuan' => $subpekerjaan->harga_satuan,'volume' => $subpekerjaan->volume,'total_harga' => $subpekerjaan->pengeluaran);
      }  
    }

    $cols = array(
      'no'            => 'No',
      'item'         => 'Item Pekerjaan',
      'harga_satuan'  => 'Harga Satuan',
      'volume'        => 'Volume',
      'total_harga'   => 'Total Harga'
    );
    

    for ($i=0; $i < 14; $i++) { 
    $pdf->ezTable(
      $data[$i], $cols,'',array('width'=>400, 'shadeHeadingCol'=>array(0.4,0.6,0.6), 'cols'=>array('item'=>array('justification'=>'left', 'width'=>250), 'volume'=>array('justification'=>'left', 'width'=>50), 'harga_satuan'=>array('justification'=>'left', 'width'=>50), 'total_harga'=>array('justification'=>'left', 'width'=>80), 'no'=>array('justification'=>'left', 'width'=>30)))
    );
    $pdf->ezText("", 10);
    $pdf->ezText("", 10);
    }
    $pdf->ezText("<strong>Harga Diatas Belum termasuk: </strong>", 11);
    $pdf->ezText("1. Pemasangan instalasi listrik PLN", 10);

    $pdf->ezStream();
  }
}
?>