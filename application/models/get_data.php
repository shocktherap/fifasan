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
  
  public function get_nama_status($id_status)
  {
    $this->db->where('id', $id_status);
    $query = $this->db->get('status', 1);
    return $query->row();
  }
    
  public function get_pekerjaan()
  {
    $this->db->where('id >=', 2);
    $this->db->order_by('id', 'asc');
    $query = $this->db->get('pekerjaan');
    return $query->result();
  }
  public function get_pekerjaan_row()
  {
    $this->db->where('id >=', 2);
    $query = $this->db->get('pekerjaan');
    return $query->num_rows();
  }
  public function get_all_subpekerjaan()
  {
    $query = $this->db->get('subpekerjaan');
    return $query->result();
  }
  public function get_subpekerjaan_rows()
  {
    $query = $this->db->get('subpekerjaan');
    return $query->num_rows();
  }
  public function get_subpekerjaan_by($pekerjaan_id)
  {
    $this->db->order_by('id', 'asc');
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
    $this->db->order_by('id', 'asc');
    $this->db->where('subpekerjaan_id', $id_sub);
    $query = $this->db->get('formula');
    return $query->result();
  }
  public function subproject_pekerjaan($id_project)
  {
    $this->db->where('project_id', $id_project);
    $query = $this->db->get('project_subpekerjaans');
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

  public function get_pekerjaan_by($params, $value)
  {
    $this->db->where($params, $value);
    $query = $this->db->get('pekerjaan',1);
    return $query->row();
  }
  
  function get_pagin_pekerjaan($limit = array()) {
  $this->db->where('id >=', 2);
    if ($limit == NULL){
      $this->db->order_by('id', 'asc');
      $query = $this->db->get('pekerjaan');
      return $query->result();
    }else{
      return $this->db->limit(
        $limit['perpage'], 
        $limit['offset'])->get('pekerjaan')->result();
    }
  }

  public function get_project_subpekerjaan_row($params, $value, $project_id)
  {
    $this->db->where($params, $value);
    $this->db->where('project_id', $project_id);
    $query = $this->db->get('project_subpekerjaans');
    return $query->num_rows();
  }

  public function get_row_value($project_id, $subpekerjaan_id)
  {
    $this->db->where('project_id', $project_id);
    $this->db->where('subpekerjaan_id', $subpekerjaan_id);
    $query = $this->db->get('project_subpekerjaans', 1);
    return $query->row();
  }
  public function check_project($id_project)
  {
    $this->db->where('project_id', $id_project);
    $this->db->where('volume >=', 0);
    $query = $this->db->get('project_subpekerjaans');
    if ($query->result()) {
      return true;
    } else {
      return false;
    }
  }
  public function project_sub_count($pekerjaan_id, $id_project)
  {
    $this->db->where('pekerjaan_id', $pekerjaan_id);
    $this->db->where('project_id', $id_project);
    $query = $this->db->get('project_subpekerjaans');
    return $query->result();
  }
  public function get_subtotal($id_project, $pekerjaan_id)
  {
    $this->db->where('project_id', $id_project);
    $this->db->where('pekerjaan_id', $pekerjaan_id);
    $query = $this->db->get('subtotal',1);
    return $query->row();
  }
  
  public function get_total($id_project)
  {
    $this->db->where('project_id', $id_project);
    $query = $this->db->get('pengeluaran', 1);
    return $query->row();
  }
  
  public function last_milestone($project_id)
  {
    $this->db->where('project_id', $project_id);
    $this->db->order_by('tanggal', 'desc');
    $query = $this->db->get('milestone', 1);
    return $query->row();
  }

  public function status_row()
  {
    $query = $this->db->get('status');
    return $query->num_rows();
  }

  public function get_milestone($id_project, $status_id)
  {
    $this->db->where('project_id', $id_project);
    $this->db->where('status_id', $status_id);
    $this->db->order_by('tanggal', 'desc');
    $query = $this->db->get('milestone', 1);
    return $query->row();
  }

  public function get_multiple_by($branch_id, $formula_id)
  {
    $this->db->where('branch_id', $branch_id);
    $this->db->where('formula_id', $formula_id);
    $query = $this->db->get('multiple_formula');
    return $query->row();
  }
  
  public function get_all_formula()
  {
    $query = $this->db->get('formula');
    return $query->result();
  }

  public function get_branch_formula($branch_id, $subpekerjaan_id)
  {
    $this->db->where('branch_id', $branch_id);
    $this->db->where('subpekerjaan_id', $subpekerjaan_id);
    $query = $this->db->get('formula_branch');
    return $query->row();
  }

  public function get_comment_using($params, $value)
  {
    $this->db->where($params, $value);
    $this->db->order_by('time', 'desc');
    $query = $this->db->get('comments');
    return $query->result();
  }
}
?>