<?php
  /**
  * 
  */
  class Upload extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('get_data');
      $this->load->model('general');
      $this->load->model('projects');
      $this->load->model('input_data');
      $this->load->model('managers');
      session_start();
    }

    public function form_new($id_project)
    {
      $session_data = $this->session->userdata('login');
      $branch = $this->managers->get_branch_by('id',$session_data['branch_id']);
      $project = $this->projects->get_project_by('project_id', $id_project);
      $this->general->setValidation();
      $data['id_project'] = $id_project;
      $data['content'] = "upload/new";
      $data['error'] = "";

      if($this->form_validation->run('upload') == FALSE) {
        $this->load->view('template',$data);
      } else { 
        $config['upload_path'] = './filestorage/';
        $config['allowed_types'] = 'doc|xls|pdf|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()){
          $data['error'] = $this->upload->display_errors('<p>', '</p>');
          $this->load->view('template', $data);
        } else {
          $upload_data = $this->upload->data();
          delete_files('filestorage/'.$upload_data['file_name']);
          $this->load->helper('file');
          $this->input_data->insert_file($id_project, $upload_data['file_name'], $upload_data['file_type'], $session_data['id']);

          $this->general->start_engine();
          $dbpath = $branch->name.'-branch/'.$project->nama;
          $filepath = $upload_data['full_path'];
          $data = $this->dropbox->add($dbpath, $filepath, array(), $root='dropbox');
          
          $info = "File Berhasil di tambah";
          $this->general->informationSuccess($info);
          redirect('home/show_project/'.$id_project);
        }
        
      }
    }
    
  }
?>