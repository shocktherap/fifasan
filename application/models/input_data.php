<?php
/**
* 
*/
class Input_data extends CI_Model
{
  
  function __construct()
  {
    parent::__construct();
  }

  public function create_new_project()
  {
    $data = array(  
      'nama'      => $this->input->post('nama'),
      'jenis'     => $this->input->post('jenis'),
      'lokasi'    => $this->input->post('lokasi'),
      'pemilik'   => $this->input->post('owner'),
      'tahun'     => $this->input->post('tahun'),
      'status_id' => 1,
      'subpekerjaan' => 0
    );
    $this->db->insert('projects', $data);
  }
  public function delete_project($id_project)
  {
    $this->db->where('project_id', $id_project);
    $this->db->delete('projects');
  }
  public function update_project($project_id)
  {
    $data = array(  
      'nama'      => $this->input->post('nama'),
      'jenis'     => $this->input->post('jenis'),
      'lokasi'    => $this->input->post('lokasi'),
      'pemilik'   => $this->input->post('owner'),
      'tahun'     => $this->input->post('tahun'),
      'status_id' => $this->input->post('status')
    );
    $this->db->where('project_id', $project_id);
    $this->db->update('projects', $data);
  }
  public function update_status_project($id)
  {
    $data = array(  
      'subpekerjaan' => 1
    );
    $this->db->where('project_id', $id);
    $this->db->update('projects', $data);
  }
  public function input_data_project_subpekerjaans($id_project, $key)
  {
    $data = array(  
      'project_id'        => $id_project,
      'subpekerjaan_id'   => $key
    );
    $this->db->insert('project_subpekerjaans', $data);
  }
  public function delete_sub($project_id, $subpekerjaan_id)
  {
    $this->db->where('project_id', $project_id);
    $this->db->where('subpekerjaan_id', $subpekerjaan_id);
    $this->db->delete('project_subpekerjaans');
  }
  public function edit_formula($id)
  {
    $object = array(
      'rumus' => $this->input->post('rumus'),
      'satuan' => $this->input->post('satuan'),
      'nama_item' => $this->input->post('nama_item'),
      'harga_dasar' => $this->input->post('harga_dasar'),
      'harga_item' => $this->input->post('harga_item'),
      'keterangan' => $this->input->post('keterangan')
    );
    $this->db->where('id', $id);
    $this->db->update('formula', $object);
  }
  public function create_formula($id_sub)
  {
    $object = array(
      'rumus' => $this->input->post('rumus'),
      'satuan' => $this->input->post('satuan'),
      'subpekerjaan_id' => $id_sub,
      'nama_item' => $this->input->post('nama_item'),
      'harga_dasar' => $this->input->post('harga_dasar'),
      'harga_item' => $this->input->post('harga_item'),
      'keterangan' => $this->input->post('keterangan')
    );
    $this->db->insert('formula', $object);
  }
  public function delete_formula($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('formula');
  }
  public function input_harga_satuan($id_sub, $harga_satuan)
  {
    $object = array('harga_satuan' => $harga_satuan);
    $this->db->where('id', $id_sub);
    $this->db->update('subpekerjaan', $object);
  }
}
?>