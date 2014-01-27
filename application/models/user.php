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
      'level' => 'branch',
      'on_project' => 0
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
      'branch_id' => $branch_id,
      'on_project' => 0
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

  public function delete_member($id)
  {
    $this->db->where('branch_id', $id);
    $this->db->delete('users');
  }

  public function resetpassword($id)
  {
    $this->db->where('id', $id);
    $object = array('password' => 12345);
    $this->db->update('users', $object);
  }

  public function change_password($id)
  {
    $this->db->where('id', $id);
    $object = array('password' => $this->input->post('new_password'));
    $this->db->update('users', $object);
  }

  public function input_branch($id, $branch_id)
  {
    $this->db->where('id', $id);
    $object = array('branch_id' => $branch_id);
    $this->db->update('users', $object);
  }

  public function update_project($id) {
    $this->db->where('id', $id);
    $object = array('on_project' => 1);
    $this->db->update('users', $object); 
  }

  public function check_project($params, $value)
  {
    $this->db->where($params, $value);
    $this->db->where('on_project', 0);
    $query = $this->db->get('users');
    return $query->result();
  }

  public function reset_on_project($id)
  {
    $this->db->where('id', $id);
    $object = array('on_project' => 0);
    $this->db->update('users', $object);  
  }
}


/* End of file user.php */
/* Location: ./application/models/user.php */
?>