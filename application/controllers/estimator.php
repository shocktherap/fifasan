<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estimator extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('managers');
  }

  public function index()
  {
    $data['branch'] = $this->managers->get_branch();
    $data['content'] = 'estimator/index';
    $this->load->view('template', $data);
  }

}

/* End of file estimator.php */
/* Location: ./application/controllers/estimator.php */
?>