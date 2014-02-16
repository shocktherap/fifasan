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
    $this->load->model('verify');
    $this->load->model('managers');
    $this->load->model('projects');
    $this->load->model('general');
    $this->load->model('input_data');
    $this->load->helper('download');
    $this->load->model('user');    
    session_start();
  }

  public function index()
  {
    $session_data = $this->session->userdata('login');
    if ($session_data['level'] == 'branch') {
      $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);
      $data['list_project'] = $this->projects->get_project_using('branch_id', $branch->id);
    } elseif($session_data['level'] == 'employe') {
      $data['list_project'] = $this->projects->get_project_using('employe_id', $session_data['id']);
    }
    
    $data['content'] = "home/list_of_project";
    $this->load->view('template',$data);
  }
  public function create_project()
  {
    $session_data = $this->session->userdata('login');
    if ($session_data['level'] == 'branch') {
      $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);
    } elseif($session_data['level'] == 'employe') {
      $branch = $this->managers->get_branch_by('id',$session_data['branch_id']);
    }
    $data['branch'] = $branch;
    $this->load->library('googlemaps');
    $config['center']     = $branch->address;
    $config['zoom']       = 'auto';
    $config['onclick']    = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->initialize($config);
    $marker = array();
    $marker['position']   = $branch->address;
    $marker['draggable']  = true;
    $marker['ondragend']  = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->add_marker($marker);
    
    $data['map'] = $this->googlemaps->create_map();

    $this->general->setValidation();
    
    if($this->form_validation->run('create_project') == TRUE) {
      if ($this->verify->checknameproject($this->input->post('nama'), $branch->id) == TRUE ) {
        $this->input_data->create_new_project($branch->id);
        $this->user->update_project($this->input->post('employe'));
        $data = $this->projects->get_last_project();
        
        $this->input_data->input_pengeluaran($data->project_id);
        $this->input_data->initmilestone($data->project_id);

        $this->general->start_engine();
        $path1 = $branch->name.'-branch/'.$this->input->post('nama');
        $data1 = $this->dropbox->create_folder($path1, $root='dropbox');

        $info = "Project Berhasil di tambah";
        $this->general->informationSuccess($info);
        redirect('home/index');
      } else {
        $info = "Nama Project Telah Terdaftar";
        $this->general->information($info);
        $data['content'] = "manager/form_create_branch";  
      }
    } else { 
      $data['content'] = "home/form_create_project";  
    }
    $this->load->view('template',$data);
  }
  public function delete_project($id_project)
  {
    $project = $this->projects->get_project_by('project_id', $id_project);

    $this->input_data->delete_sub($id_project);
    $this->input_data->delete_project($id_project);
    $this->input_data->delete_subtotal($id_project);
    $this->user->reset_on_project($project->employe_id);
    $info = "Project Berhasil di hapus";
    $this->general->informationSuccess($info);
    redirect('home/index');
  }
  public function show_project($id_project)
  {
    $data['id_project'] = $id_project;
    $data['storage'] =  $this->projects->get_storage('project_id',$id_project);
    $data['data_project'] = $this->projects->get_project_by('project_id', $id_project);
    $project = $this->projects->get_project_by('project_id', $id_project);

    $this->load->library('googlemaps');
    $config['center'] = $project->lokasi;
    $config['zoom'] = 'auto';
    $this->googlemaps->initialize($config);
    $marker = array();
    $marker['position'] = $project->lokasi;
    $this->googlemaps->add_marker($marker);
    $data['map'] = $this->googlemaps->create_map();


    $data['content'] = "home/show_of_project";
    $this->load->view('template',$data);
  }
  public function edit_project($id_project)
  {
    $project = $this->projects->get_project_by('project_id', $id_project);
    $this->load->library('googlemaps');
    $config['center'] = $project->lokasi;
    $config['zoom'] = 'auto';
    $config['onclick'] = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->initialize($config);
    $marker = array();
    $marker['position'] = $project->lokasi;
    $marker['draggable'] = true;
    $marker['ondragend'] = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->add_marker($marker);
    
    $data['map'] = $this->googlemaps->create_map();
    $this->general->setValidation();
    $data['status'] = $this->projects->get_status();
    $data_project = $this->projects->get_project_by('project_id', $id_project);

    $data['data_project'] = $this->projects->get_project_by('project_id', $id_project);
    $data['content'] = "home/update_of_project";
    if($this->form_validation->run('create_project') == FALSE) {
      $this->load->view('template',$data);
    } else { 
      $this->input_data->update_project($id_project);
      $this->input_data->create_milestone($id_project);
      if ($this->input->post('status') == 5) {
        $this->user->reset_on_project($data_project->employe_id);
      }
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
        $this->user->change_password($session_data['id']);
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
    $key = $this->projects->download_data($id);
    $session_data = $this->session->userdata('login');
    $branch = $this->managers->get_branch_by('id',$session_data['branch_id']);
    $project = $this->projects->get_project_by('project_id', $key->project_id);
    $this->general->start_engine();
    $path = $branch->name.'-branch/'.$project->nama.'/'.$key->file;  
    $link = $this->dropbox->media($path, $root='dropbox');
    $data = file_get_contents($link->url);
    $name = $key->file;
    force_download($name, $data);
  }

  public function delete_file($id, $id_project)
  {
    $this->general->start_engine();
    $key = $this->projects->download_data($id);

    $project = $this->projects->get_project_by('project_id', $id_project);
    $branch  = $this->managers->get_branch_by('id', $project->branch_id);
    $path = $branch->name.'-branch/'.$project->nama.'/'.$key->file;
    $data = $this->dropbox->delete($path, $root='dropbox');
    
    $string = 'filestorage/'.$key->file;
    unlink($string);

    $this->input_data->delete_file($id);
    $info = "File Berhasil Dihapus";
    $this->general->informationSuccess($info);
    redirect('home/show_project/'.$id_project);   
  }

  public function onthemap()
  {
    $this->load->library('googlemaps');      
    $config['zoom'] = 'auto';
    $session_data = $this->session->userdata('login');
    
    if ($session_data['level'] == 'branch') {
      $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);
      $project = $this->projects->get_project_using('branch_id', $branch->id);  
    } elseif ($session_data['level'] == 'employe') {
      $project = $this->projects->get_project_using('employe_id', $session_data['id']);  
    }
    $this->googlemaps->initialize($config);
    foreach ($project as $key) {

      $marker = array();
      $marker['position'] = $key->lokasi;
      $marker['infowindow_content'] = anchor('home/show_project/'.$key->project_id, $key->nama);
      $this->googlemaps->add_marker($marker);
    }
    
    $data['map'] = $this->googlemaps->create_map();
    $data['content'] = "home/onthemap";
    $this->load->view('template', $data);
  }
  public function agreement($id)
  {
   $this->projects->agreement($id);
    $info = "RAB Telah Disetujui";
    $this->general->informationSuccess($info);
    redirect('home/show_project/'.$id);   
  }

  public function createcomment($id_project, $user_id)
  {
    $this->input_data->init_comment($id_project, $user_id);
    $info = "Comment Telah ditambah";
    $this->general->informationSuccess($info);
    redirect('home/show_project/'.$id_project);   
  }

  public function deletepo()
  {
    $data = "filestorage/-_!_2.jpg";
    unlink($data);
  }

  public function excel_print($id_project)
  {
    $project = $this->projects->get_project_by('project_id', $id_project);
    $this->load->library('excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Rencana Anggaran Belanja');
    $this->excel->getActiveSheet()->setCellValue('A1', 'Rencana Anggaran Belanja');
    $this->excel->getActiveSheet()->setCellValue('A2', '');
    $this->excel->getActiveSheet()->setCellValue('A3', 'Nama Project');
    $this->excel->getActiveSheet()->setCellValue('A4', 'Jenis Project');
    $this->excel->getActiveSheet()->setCellValue('A5', 'Alamat Project');
    $this->excel->getActiveSheet()->setCellValue('A6', 'Owner Project');
    $this->excel->getActiveSheet()->setCellValue('A7', 'Pekerja Project');
    $this->excel->getActiveSheet()->setCellValue('B3', $project->nama);
    $this->excel->getActiveSheet()->setCellValue('B4', $project->jenis);
    $this->excel->getActiveSheet()->setCellValue('B5', $project->lokasi);
    $this->excel->getActiveSheet()->setCellValue('B6', $project->pemilik);
    
    $pekerjaan = $this->get_data->get_pekerjaan();
    $number = 9;
    foreach ($pekerjaan as $key) {
      $number+=2;
      $this->excel->getActiveSheet()->setCellValue('A'.$number, $key->nama);
      $number+=1;
      $this->excel->getActiveSheet()->setCellValue('A'.$number, 'Nama Subproject');
      $this->excel->getActiveSheet()->setCellValue('B'.$number, 'Aturan');
      $this->excel->getActiveSheet()->setCellValue('C'.$number, 'Satuan');
      $this->excel->getActiveSheet()->setCellValue('D'.$number, 'Harga Satuan');
      $this->excel->getActiveSheet()->setCellValue('E'.$number, 'Volume');
      $this->excel->getActiveSheet()->setCellValue('F'.$number, 'Harga Item');
      $pekerjaan_data = $this->get_data->get_subprojectpekerjaan2($id_project, $key->id);
      $count = 0;
      foreach ($pekerjaan_data as $key2) {
        $number+=1;
        $this->excel->getActiveSheet()->setCellValue('A'.$number, $key2->nama);    
        $this->excel->getActiveSheet()->setCellValue('B'.$number, $key2->keterangan_peraturan);    
        $this->excel->getActiveSheet()->setCellValue('C'.$number, $key2->satuan);    
        $this->excel->getActiveSheet()->setCellValue('D'.$number, $key2->harga_satuan);    
        $this->excel->getActiveSheet()->setCellValue('E'.$number, $key2->volume);    
        $this->excel->getActiveSheet()->setCellValue('F'.$number, $key2->pengeluaran);    
        $count+=$key2->pengeluaran;
        }
      $number+=1;
      $this->excel->getActiveSheet()->setCellValue('E'.$number, 'Subtotal');    
      $this->excel->getActiveSheet()->setCellValue('F'.$number, $count);    
    }
    
    $rab = $this->get_data->get_total($id_project);
    $number+=2;
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, 'Total Kotor');
    $this->excel->getActiveSheet()->setCellValue('B'.$number, $rab->total_kotor);
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, 'Jasa');
    $this->excel->getActiveSheet()->setCellValue('B'.$number, $rab->jasa.'%');
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, 'Total Bersih');
    $this->excel->getActiveSheet()->setCellValue('B'.$number, $rab->total_bersih);
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, 'Pembulatan');
    $this->excel->getActiveSheet()->setCellValue('B'.$number, $rab->pembulatan);

    $number+=2;
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, 'Harga Diatas Belum Termasuk');
    $this->excel->getActiveSheet()->setCellValue('A'.$number+=1, '1. Pemasangan Instalasi Listrik PLN');
    $number+=2;
    $this->excel->getActiveSheet()->setCellValue('D'.$number+=1, 'Moelia Graha Estetika');
    $number+=2;
    $this->excel->getActiveSheet()->setCellValue('D'.$number+=1, 'Ir. Masyuri Kurniawan');


    $filename = 'Rencana Anggaran Belanja.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
  }
}
?>