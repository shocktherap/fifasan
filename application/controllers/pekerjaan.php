<?php
  /**
  * 
  */
  class Pekerjaan extends CI_Controller
  {
    
    function __construct()
    {
      parent::__construct();
      $this->load->model('get_data');
      $this->load->model('general');
      $this->load->model('input_data');
      session_start();
    }

    public function index($offset = 0){
      // $perpage = 15;
      $this->load->library('pagination');
      $config['base_url'] = base_url('pekerjaan/index');
      // $config['total_rows'] = $this->get_data->get_pekerjaan_rows();
      // $config['per_page'] = $perpage; 
      // $this->pagination->initialize($config); 

      // $data['link'] = $this->pagination->create_links();
      // $data['pekerjaan'] = $this->get_data->get_pagin_pekerjaan(array('perpage' => $perpage, 'offset' => $offset));
      $data['pekerjaan'] = $this->get_data->get_pekerjaan();
      $data['content'] = "pekerjaan/index";
      $this->load->view('template',$data);
    }

    public function create()
    {
      $this->general->setValidation();
      $data['content'] = "pekerjaan/create";
      if($this->form_validation->run('pekerjaan') == true) {
        $this->input_data->new_pekerjaan();
        $info = "Pekerjaan Berhasil di Tambah";
        $this->general->informationSuccess($info);
        redirect('pekerjaan/index');
      } else {
        $this->load->view('template',$data);  
      }
    }

    public function delete($id)
    {
      $this->input_data->delete_pekerjaan($id);
      $info = "Pekerjaan Berhasil di hapus";
      $this->general->informationSuccess($info);
      redirect('pekerjaan/index');
    }

    public function edit($id)
    {
      $this->general->setValidation();
      $data['pekerjaan'] = $this->get_data->get_pekerjaan_by('id', $id);
      $data['content'] = "pekerjaan/edit";
      if($this->form_validation->run('pekerjaan') == true) {
        $this->input_data->edit_pekerjaan($id);
        $info = "Pekerjaan Berhasil di Ubah";
        $this->general->informationSuccess($info);
        redirect('pekerjaan/index');
      } else {
        $this->load->view('template',$data);  
      }
    }

  }

?>