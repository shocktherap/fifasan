<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Verify extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function checkuserbranch($username)
  {
    $this->db->where('username', $username);
    $query = $this->db->get('users');
    if ($query->result()) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function checknamebranch($name)
  {
    $this->db->where('name', $name);
    $query = $this->db->get('branch');
    if ($query->result()) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function checknameproject($name, $id)
  {
    $this->db->where('nama', $name);
    $this->db->where('branch_id', $id);
    $query = $this->db->get('projects');
    if ($query->result()) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

}


/* End of file verify.php */
/* Location: ./application/models/verify.php */
?>