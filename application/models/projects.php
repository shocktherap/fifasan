<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Projects extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function get_all_project()
  {
    $this->db->order_by('project_id', 'asc');
    $query = $this->db->get('projects');
    return $query->result();
  }

  public function get_last_project()
  {
    $this->db->order_by('project_id', 'desc');
    $query = $this->db->get('projects', 1);
    return $query->row();
  }

  public function get_storage($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('storage');
    return $query->result();
  }

  public function get_project_by($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('projects', 1);
    return $query->row();
  }

  public function get_project_using($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('projects');
    return $query->result();
  }

  public function get_status()
  {
    $query = $this->db->get('status');
    return $query->result();
  }

  public function download_data($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('storage', 1);
    return $query->row();
  }

  public function delete_project($id)
  {
    $this->db->where('branch_id', $id);
    $this->db->delete('projects');
  }

  public function agreement($id)
  {
    $this->db->where('project_id', $id);
    $object = array('aggreement' => 1 );
    $this->db->update('projects', $object);
  }
}


/* End of file projects.php */
/* Location: ./application/models/projects.php */
?>