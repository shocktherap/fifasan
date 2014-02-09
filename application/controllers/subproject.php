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
    $this->load->model('projects');
    $this->load->model('input_data');
    session_start();
  }
  public function show($id_project)
  {
    $stats = $this->projects->get_project_by('project_id', $id_project);
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
    $this->input_data->input_data_pengeluaran($id_project);
    redirect('subproject/detail/'.$id_project);
  }

  public function detail($id_project)
  {
    $data['pekerjaan'] = $this->get_data->get_pekerjaan(); 
    $data['id_project'] = $id_project;
    $data['project'] = $this->projects->get_project_by('project_id', $id_project);
    $data['content'] = "subproject/detail";
    $this->load->view('template',$data);
  }

  public function pdf_output($id_project, $id_awal, $id_akhir)
  {    
    $project = $this->projects->get_project_by('project_id', $id_project);
    $this->load->helper('pdf');
    $this->load->library('cezpdf');
    prep_pdf();

    $this->cezpdf->ezText("Rencana Anggaran Biaya", 16, array('justification' => 'center'));    
    $this->cezpdf->ezText("Nama Project     : ".$project->nama, 12);
    $this->cezpdf->ezText("Lokasi Project    : ".$project->lokasi, 12);
    $this->cezpdf->ezText("Tahun Project    : ".$project->tahun, 12);
    $this->cezpdf->ezText("Jenis Project      : ".$project->jenis, 12);
    $this->cezpdf->ezText("Pemilik Project   : ".$project->pemilik, 12);
    $pekerjaan = $this->get_data->get_pekerjaan();
    foreach ($pekerjaan as $key) {
      $pekerjaan_data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
      $no = 0;
      $nama[$key->id] = $key->nama;
    $cols[$key->id] = array(
      'no'            => 'No',
      'item'          => 'Item Pekerjaan',
      'satuan'        => 'SAT',
      'harga_satuan'  => 'Harga Satuan',
      'volume'        => 'VOL',
      'total_harga'   => 'Total Harga'
    );
      foreach ($pekerjaan_data as $subpekerjaan) {
        $no+=1;
        $data[$key->id][] = array('no' => $no, 'item' => $subpekerjaan->nama, 'satuan' => $subpekerjaan->satuan, 'harga_satuan' => $subpekerjaan->harga_satuan,'volume' => $subpekerjaan->volume,'total_harga' => $subpekerjaan->pengeluaran);
      }
      
    }
    for ($i=$id_awal; $i <= $id_akhir; $i++) { 
    $this->cezpdf->ezTable( $data[$i], $cols[$i], $nama[$i],array('width'=>600,'showLines'=>4,'cols'=>array('no' => array('width'=>30),
        'item'=>array('width'=>270),'satuan'=>array('width'=>40),'harga_satuan'=>array('width'=>80),'volume'=>array('width'=>40),
        'total_harga'=>array('width'=>70))));
      $this->cezpdf->ezText("", 10);
    }

    // $rab = $this->get_data->get_total($id_project);
    // $datatotal = array(
    //  array('keterangan'=> "Total Kotor",'value'=> 'Rp. '.number_format($rab->total_kotor,2,",","."))
    // ,array('keterangan'=> "Jasa",'value'=> $rab->jasa.'%')
    // ,array('keterangan'=> "Total Bersih",'value'=>  'Rp. '.number_format($rab->total_bersih,2,",","."))
    // ,array('keterangan'=> "Pembulatan",'value'=>  'Rp. '.number_format($rab->pembulatan,2,",","."))
    // );

    // $cols2 = array(
    //   'keterangan' => 'Keterangan',
    //   'value'      => 'Value'
    // );
    // $this->cezpdf->ezTable( $datatotal, $cols2,'',array('width'=>400, 'shadeHeadingCol'=>array(0.4,0.6,0.6), 'cols'=>array('keterangan'=>array('justification'=>'left', 'width'=>250), 'value'=>array('justification'=>'left', 'width'=>100))));
    // $this->cezpdf->ezText("", 10);
    // $this->cezpdf->ezText("Harga Diatas Belum termasuk: ", 11);
    // $this->cezpdf->ezText("1. Pemasangan instalasi listrik PLN", 10);
    // $this->cezpdf->ezText("Moelia Graha Estetika    ", 14, array('justification' => 'right'));
    // $this->cezpdf->ezText("", 10);
    // $this->cezpdf->ezText("", 10);
    // $this->cezpdf->ezText("", 10);
    // $this->cezpdf->ezText("Ir. Masyuri Kurniawan, IAI", 14, array('justification' => 'right'));
    $this->cezpdf->ezStream();

  }

  public function pdf_output_data($id_project, $id_awal, $id_akhir)
  {    
    
    $this->load->helper('pdf');
    $this->load->library('cezpdf');
    prep_pdf();
    // $project = $this->projects->get_project_by('project_id', $id_project);
    
    // $pekerjaan = $this->get_data->get_pekerjaan();
    // foreach ($pekerjaan as $key) {
    //   $pekerjaan_data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
    //   $no = 0;
    //   $nama[$key->id] = $key->nama;
    // $cols[$key->id] = array(
    //   'no'            => 'No',
    //   'item'          => 'Item Pekerjaan',
    //   'satuan'        => 'SAT',
    //   'harga_satuan'  => 'Harga Satuan',
    //   'volume'        => 'VOL',
    //   'total_harga'   => 'Total Harga'
    // );
    //   foreach ($pekerjaan_data as $subpekerjaan) {
    //     $no+=1;
    //     $data[$key->id][] = array('no' => $no, 'item' => $subpekerjaan->nama, 'satuan' => $subpekerjaan->satuan, 'harga_satuan' => $subpekerjaan->harga_satuan,'volume' => $subpekerjaan->volume,'total_harga' => $subpekerjaan->pengeluaran);
    //   }
      
    // }
    // for ($i=$id_awal; $i <= $id_akhir; $i++) { 
    // $this->cezpdf->ezTable( $data[$i], $cols[$i], $nama[$i],array('width'=>600,'showLines'=>4,'cols'=>array('no' => array('width'=>30),
    //     'item'=>array('width'=>270),'satuan'=>array('width'=>40),'harga_satuan'=>array('width'=>80),'volume'=>array('width'=>40),
    //     'total_harga'=>array('width'=>70))));
    //   $this->cezpdf->ezText("", 10);
    // }

    // $rab = $this->get_data->get_total($id_project);
    // $datatotal = array(
    //  array('keterangan'=> "Total Kotor",'value'=> 'Rp. '.number_format($rab->total_kotor,2,",","."))
    // ,array('keterangan'=> "Jasa",'value'=> $rab->jasa.'%')
    // ,array('keterangan'=> "Total Bersih",'value'=>  'Rp. '.number_format($rab->total_bersih,2,",","."))
    // ,array('keterangan'=> "Pembulatan",'value'=>  'Rp. '.number_format($rab->pembulatan,2,",","."))
    // );

    // $cols2 = array(
    //   'keterangan' => 'Keterangan',
    //   'value'      => 'Value'
    // );
    // $this->cezpdf->ezTable( $datatotal, $cols2,'',array('width'=>400, 'shadeHeadingCol'=>array(0.4,0.6,0.6), 'cols'=>array('keterangan'=>array('justification'=>'left', 'width'=>250), 'value'=>array('justification'=>'left', 'width'=>100))));
    // $this->cezpdf->ezText("", 10);
    $this->cezpdf->ezText("Harga Diatas Belum termasuk: ", 11);
    $this->cezpdf->ezText("1. Pemasangan instalasi listrik PLN", 10);
    $this->cezpdf->ezText("Moelia Graha Estetika    ", 14, array('justification' => 'right'));
    $this->cezpdf->ezText("", 10);
    $this->cezpdf->ezText("", 10);
    $this->cezpdf->ezText("", 10);
    $this->cezpdf->ezText("Ir. Masyuri Kurniawan, IAI", 14, array('justification' => 'right'));
    $this->cezpdf->ezStream();

  }

  public function debug($id_project)
  {
    $pekerjaan = $this->get_data->get_pekerjaan();

    foreach ($pekerjaan as $key) {
      $pekerjaan_data = $this->get_data->get_subprojectpekerjaan2($id_project,$key->id);
      $no = 0;
      foreach ($pekerjaan_data as $subpekerjaan) {
        $no+=1;
        $data[$key->id][] = array('no' => $no, 'item' => $subpekerjaan->nama,'satuan' => $subpekerjaan->satuan, 'harga_satuan' => $subpekerjaan->harga_satuan,'volume' => $subpekerjaan->volume,'total_harga' => $subpekerjaan->pengeluaran);
      }
    }
    print_r($data[12]);
  }
}
?>