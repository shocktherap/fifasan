<?php
  class manager extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('verify');
      $this->load->model('general');
      $this->load->model('managers');
      $this->load->model('user');
      $this->load->model('get_data');
      $this->load->model('projects');
      $this->load->model('input_data');
      session_start();
    }

    public function index()
    {
      $data['branch'] = $this->managers->get_branch();
      $data['content'] = "manager/index";
      $this->load->view('template',$data);
    }

    public function createbranch()
    {
      if($this->form_validation->run('branch') == TRUE) {
        if ($this->verify->checkuserbranch($this->input->post('username')) == TRUE ) {
          if ($this->verify->checknamebranch($this->input->post('name')) == TRUE ) {

            $this->user->inputnewuser();
            $leader = $this->user->getleaderby('username', $this->input->post('username'));
            $this->managers->inputnewbrach($leader->id);
            $data_branch = $this->managers->get_branch_by('leader_id', $leader->id);
            
            $subpekerjaan = $this->get_data->get_all_formula();
            foreach ($subpekerjaan as $key) {
               $this->input_data->init_multiple_formula($data_branch->id, $key->id, 0, 0);
             }
            $subpekerjaan = $this->get_data->get_all_subpekerjaan();
            foreach ($subpekerjaan as $key) {
               $this->input_data->init_formula_branch($data_branch->id, $key->id, 0);
             } 

            $this->user->input_branch($leader->id, $data_branch->id);
            $this->general->start_engine();
            $path1 = $this->input->post('name').'-branch';
            $data1 = $this->dropbox->create_folder($path1, $root='dropbox');

            $info = "Branch Telah Ditambah";
            $this->general->informationSuccess($info);
            redirect('manager/index');
          } else {
            $info = "Nama Cabang Telah Terdaftar";
            $this->general->information($info);
            $data['content'] = "manager/form_create_branch";  
          }    
        } else {
          $info = "Username Telah Terdaftar";
          $this->general->information($info);
          $data['content'] = "manager/form_create_branch";  
        }
      } else {
        $data['content'] = "manager/form_create_branch";
      }
        $this->load->view('template',$data);
    }

    public function show_project($project_id)
    {
      $data['list_project'] = $this->projects->get_project_using('branch_id', $project_id);
      $data['content'] = "manager/show_project";
      $this->load->view('template',$data);
    }

    public function edit_branch($branch_id)
    {
      $data['branch'] = $this->managers->get_branch_by('id', $branch_id);
      $data['content'] = "manager/form_edit_branch";
      if($this->form_validation->run('branch') == TRUE) {
        $this->managers->editbranch($branch_id);
        $branchdata = $this->managers->get_branch_by('id', $branch_id);
        $this->user->edituser($branchdata->leader_id);
        $info = "Data Branch Telah Diubah";
        $this->general->informationSuccess($info);
        redirect('manager/index');
      } else {
        $this->load->view('template',$data);
      }
    }

    public function delete_branch($id)
    {
      $branchdata = $this->managers->get_branch_by('id', $id);
      $this->input_data->delete_multiple($branchdata->id);
      $this->input_data->delete_formula_branch($branchdata->id);
      $this->general->start_engine();
      $path = $branchdata->name.'-branch';
      $data = $this->dropbox->delete($path, $root='dropbox');
      $this->managers->delete_branch($id);
      $this->projects->delete_project($id);
      $this->user->delete_user($branchdata->leader_id);
      $this->user->delete_member($id);
      $info = "Data Branch Telah Dihapus";
      $this->general->informationSuccess($info);
      redirect('manager/index');
    }
    public function onthemap()
    {
      $this->load->library('googlemaps');
      $config['center'] = 'jakarta, indonesia';
      $config['zoom'] = 'auto';
      $this->googlemaps->initialize($config);

      $project = $this->projects->get_all_project();
      foreach ($project as $key) {
        $marker = array();
        $marker['position'] = $key->lokasi;
        $marker['infowindow_content'] = anchor('home/show_project/'.$key->project_id, $key->nama);
        $this->googlemaps->add_marker($marker);
      }
      $data['map'] = $this->googlemaps->create_map();
      $data['content'] = "manager/onthemap";
      $this->load->view('template', $data);
    }
  }
?>