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
    $this->load->library('googlemaps');
    $config['center'] = $branch->address;
    $config['zoom'] = 'auto';
    $config['onclick'] = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->initialize($config);
    $marker = array();
    $marker['position'] = $branch->address;
    $marker['draggable'] = true;
    $marker['ondragend'] = 'document.entry.lokasi.value = event.latLng.lat() + \', \' + event.latLng.lng();';
    $this->googlemaps->add_marker($marker);
    
    $data['map'] = $this->googlemaps->create_map();

    $this->general->setValidation();
    
    if($this->form_validation->run('create_project') == TRUE) {
      if ($this->verify->checknameproject($this->input->post('nama'), $branch->id) == TRUE ) {
        $this->input_data->create_new_project($branch->id, $session_data['id']);
        $data = $this->projects->get_last_project();
        $this->input_data->input_pengeluaran($data->project_id);

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
    $data['data_project'] = $this->projects->get_project_by('project_id', $id_project);
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
    $key = $this->projects->download_data($id);
    $session_data = $this->session->userdata('login');
    $branch = $this->managers->get_branch_by('leader_id',$session_data['id']);
    $project = $this->projects->get_project_by('project_id', $key->project_id);

    // $data = file_get_contents(base_url("filestorage/".$key->file)); // Read the file's contents
    // $name = $key->file;

    $this->general->start_engine();
    $path = $branch->name.'-branch/'.$project->nama.'/'.$key->file;
    $destination = 'filestorage/'.$key->file;
    $this->dropbox->get($destination, $path, $root='dropbox');

    // force_download($name, $data);
  }
  public function delete_file($id, $id_project)
  {

    $key = $this->projects->download_data($id);
    $string = base_url('filestorage/'.$key->file);
    unlink($string);
    // $this->input_data->delete_file($id);

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

}
?>