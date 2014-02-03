<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Branch extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function get_all_branch()
  {
    $query = $this->db->get('branch');
    return $query->result();
  }

}

/* End of file branch.php */
/* Location: ./application/models/branch.php */?>