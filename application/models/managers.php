<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Managers extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function inputnewbrach($id)
  {
    $object = array(
      'name' => $this->input->post('name'),
      'address' => $this->input->post('address'),
      'phone_number' => $this->input->post('phone_number'),
      'leader_id' => $id
    );
    $this->db->insert('branch', $object);
  }
  public function get_branch()
  {
    $query = $this->db->get('branch');
    return $query->result();
  }

  public function get_branch_by($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('branch');
    return $query->row();
  }

  public function get_branch_using($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('branch');
    return $query->result();
  }

  public function editbranch($id)
  {
    $this->db->where('id', $id);
    $object = array(
      'name' => $this->input->post('name'),
      'address' => $this->input->post('address'),
      'phone_number' => $this->input->post('phone_number')
    );
    $this->db->update('branch', $object);
  }

  public function delete_branch($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('branch');
  }

}


/* End of file user.php */
/* Location: ./application/models/user.php */
?>