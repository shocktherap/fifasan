<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class User extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function inputnewuser()
  {
    $object = array(
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'name' => $this->input->post('leader'),
      'level' => 'branch'
    );
    $this->db->insert('users', $object);
  }

  public function inputnewemploye($branch_id)
  {
    $object = array(
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'name' => $this->input->post('name'),
      'phone_number' => $this->input->post('phone_number'),
      'level' => 'employe',
      'branch_id' => $branch_id
    );
    $this->db->insert('users', $object);
  }

  public function getleaderby($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('users');
    return $query->row();
  }

  public function getuserusing($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('users');
    return $query->result();
  }

  public function edituser($id)
  {
    $this->db->where('id', $id);
    $object = array(
      'username' => $this->input->post('username'),
      'password' => $this->input->post('password'),
      'name' => $this->input->post('leader')
    );
    $this->db->update('users', $object);
  }

  public function delete_user($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('users');
  }

  public function resetpassword($id)
  {
    $this->db->where('id', $id);
    $object = array('password' => 12345);
    $this->db->update('users', $object);
  }
}


/* End of file user.php */
/* Location: ./application/models/user.php */
?>