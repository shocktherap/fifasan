<?php
/**
* 
*/
class Get_data extends CI_Model
{
  
  function __construct()
  {
   parent::__construct();
  }

  public function get_level_user($username)
  {
    $this->db->where('username', $username);
    $query = $this->db->get('users', 1);
    return $query->row();
  }

  public function get_all_project()
  {
    $query = $this->db->get('projects');
    return $query->result();
  }
  public function get_nama_status($id_status)
  {
    $this->db->where('id', $id_status);
    $query = $this->db->get('status', 1);
    return $query->row();
  }
  public function get_project_by_id($project_id)
  {
    $this->db->where('project_id', $project_id);
    $query = $this->db->get('projects', 1);
    return $query->row();
  }
  public function get_status()
  {
    $query = $this->db->get('status');
    return $query->result();
  }
  public function get_pekerjaan()
  {
    $this->db->where('id >=', 2);
    $query = $this->db->get('pekerjaan');
    return $query->result();
  }
  public function get_pekerjaan_row()
  {
    $this->db->where('id >=', 2);
    $query = $this->db->get('pekerjaan');
    return $query->num_rows();
  }
  public function get_subpekerjaan_rows()
  {
    $query = $this->db->get('subpekerjaan');
    return $query->num_rows();
  }
  public function get_subpekerjaan_by($pekerjaan_id)
  {
    $this->db->where('pekerjaan_id', $pekerjaan_id);
    $query = $this->db->get('subpekerjaan');
    return $query->result();
  }
  public function get_subpekerjaan_by_id($id)
  {
    $this->db->select('nama');
    $this->db->where('id', $id);
    $query = $this->db->get('subpekerjaan', 1);
    return $query->row();
  }
  public function get_subpekerjaan_by_params($params, $value, $which)
  {
    $this->db->select($which);
    $this->db->where($params, $value);
    $query = $this->db->get('subpekerjaan', 1);
    return $query->row();
  }
  public function get_detail_user($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('users', 1);
    return $query->row();  
  }
  public function get_daftar_subpekerjaan($project_id)
  {
    $this->db->where('project_id', $project_id);
    $query = $this->db->get('project_subpekerjaans');
    return $query->result();   
  }
  public function get_sub_by($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('subpekerjaan');
    return $query->row();
  }
  public function get_sub_formula($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('formula', 1);
    return $query->row();
  }
  public function get_sub_formula_all($id)
  {
    $this->db->where('subpekerjaan_id', $id);
    $query = $this->db->get('formula');
    return $query->result();
  }
  public function get_sub_in_formula($id_sub)
  {
    $this->db->where('subpekerjaan_id', $id_sub);
    $query = $this->db->get('formula');
    return $query->result();
  }
  public function get_subprojectpekerjaan($id)
  {
    $query = $this->db->query("select * from project_subpekerjaans p join subpekerjaan q on p.subpekerjaan_id = q.id  where p.project_id ='$id' ORDER BY p.project_id");
    return $query->result();
  }
  public function get_subprojectpekerjaan2($id, $pekerjaan_id)
  {
    $query = $this->db->query("select * from project_subpekerjaans p join subpekerjaan q on p.subpekerjaan_id = q.id  where p.project_id ='$id' and q.pekerjaan_id = '$pekerjaan_id' ORDER BY p.project_id");
    return $query->result();
  }
  public function get_pekerjaan_rows()
  {
    $this->db->where('id >=', 2);
    $query = $this->db->get('pekerjaan');
    return $query->num_rows();
  }
  
  function get_pagin_pekerjaan($limit = array()) {
  $this->db->where('id >=', 2);
    if ($limit == NULL)
      return $this->db->get('pekerjaan')->result();
    else
      return $this->db->limit($limit['perpage'], $limit['offset'])->get('pekerjaan')->result();
  }

  public function get_project_subpekerjaan_row($params, $value, $project_id)
  {
    $this->db->where($params, $value);
    $this->db->where('project_id', $project_id);
    $query = $this->db->get('project_subpekerjaans');
    return $query->num_rows();
  }
}
?>