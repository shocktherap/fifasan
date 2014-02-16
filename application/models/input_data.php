<?php
/**
* 
*/
class Input_data extends CI_Model
{
  
  function __construct()
  {
    $this->load->model('branch');
    parent::__construct();
  }

  public function create_new_project($id)
  {
    $data = array(  
      'nama'      => $this->input->post('nama'),
      'jenis'     => $this->input->post('jenis'),
      'lokasi'    => $this->input->post('lokasi'),
      'pemilik'   => $this->input->post('owner'),
      'tahun'     => $this->input->post('tahun'),
      'alamat'     => $this->input->post('alamat'),
      'subpekerjaan' => 0,
      'status_id' => 1,
      'aggreement' => 0,
      'branch_id' => $id,
      'employe_id' => $this->input->post('employe')
    );
    $this->db->insert('projects', $data);
  }

  public function initmilestone($id_project)
  {
    $this->load->helper('date');
    $now = time();
    $timestamp = $now;
    $timezone = 'UP7';
    $daylight_saving = FALSE;
    $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
    $human = unix_to_human($GMY);

    $object = array(
      'status_id'   => 1, 
      'tanggal'     => $human,
      'project_id'  => $id_project
    );
    $this->db->insert('milestone', $object);
  }

  public function create_milestone($id_project)
  {
    $this->load->helper('date');
    $now = time();
    $timestamp = $now;
    $timezone = 'UP7';
    $daylight_saving = FALSE;
    $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
    $human = unix_to_human($GMY);

    $object = array(
      'project_id'  => $id_project,
      'status_id'   => $this->input->post('status'),
      'tanggal'     => $human
    );
    $this->db->insert('milestone', $object);
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
  public function input_data_project_subpekerjaans($id_project, $key, $id_pekerjaan)
  {
    $data = array(  
      'project_id'        => $id_project,
      'subpekerjaan_id'   => $key,
      'pekerjaan_id'      => $id_pekerjaan
    );
    $this->db->insert('project_subpekerjaans', $data);
  }
  public function delete_sub($project_id)
  {
    $this->db->where('project_id', $project_id);
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

  public function input_rab($project_id, $subpekerjaan_id, $jumlah, $volume)
  {
    $object = array('pengeluaran' => $jumlah,
                    'volume'      => $volume
                    );
    $this->db->where('project_id', $project_id);
    $this->db->where('subpekerjaan_id', $subpekerjaan_id);
    $this->db->update('project_subpekerjaans', $object);
  }
  public function delete_subtotal($id_project)
  {
    $this->db->where('project_id', $id_project);
    $this->db->delete('subtotal');
  }
  public function input_subtotal($id_project, $pekerjaan_id, $value)
  {
    $object = array(
      'project_id'    => $id_project,
      'pekerjaan_id'  => $pekerjaan_id,
      'subtotal'      => $value
    );
    $this->db->insert('subtotal', $object);
  }
  public function input_total($id_project, $total)
  {
    $this->db->where('project_id', $id_project);
    $object = array('total_rab' => $total);
    $this->db->update('projects', $object);
  }
  public function new_pekerjaan()
  {
    $object = array('nama' => $this->input->post('nama'));
    $this->db->insert('pekerjaan', $object);
  }
  public function edit_pekerjaan($id)
  {
    $object = array('nama' => $this->input->post('nama'));
    $this->db->where('id', $id);
    $this->db->update('pekerjaan', $object);
  }
  public function new_subpekerjaan($pekerjaan_id)
  {
    $object = array(
      'nama' => $this->input->post('nama'),
      'keterangan_peraturan' => $this->input->post('keterangan'),
      'pekerjaan_id' => $pekerjaan_id,
      'satuan' => $this->input->post('satuan')
    );
    $this->db->insert('subpekerjaan', $object);
  }
  public function edit_subpekerjaan($id)
  {
    $this->db->where('id', $id);
    $object = array(
      'nama' => $this->input->post('nama'),
      'keterangan_peraturan' => $this->input->post('keterangan'),
      'satuan' => $this->input->post('satuan')
    );
    $this->db->update('subpekerjaan', $object);
  }
  public function delete_subpekerjaan($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('subpekerjaan');
  }
  public function delete_pekerjaan($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('pekerjaan');
  }
  public function input_pengeluaran($id_project)
  {
    $object = array('project_id' => $id_project);
    $this->db->insert('pengeluaran', $object);
  }
  public function input_data_pengeluaran($id_project)
  {
    $object = array(
      'total_kotor' => $this->input->post('total_kotor'), 
      'total_bersih' => $this->input->post('total_bersih'), 
      'jasa' => $this->input->post('jasa'), 
      'pembulatan' => $this->input->post('pembulatan'), 
    );
    $this->db->where('project_id', $id_project);
    $this->db->update('pengeluaran', $object);
  }
  public function insert_file($project_id, $file_name, $file_type, $user_id)
  {
    $this->load->helper('date');
    $now = time();
    $timestamp = $now;
    $timezone = 'UP7';
    $daylight_saving = FALSE;
    $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
    $human = unix_to_human($GMY);

    $object = array(
      'project_id'  => $project_id,
      'description' => $this->input->post('description'),
      'file'        => $file_name,
      'tipe'        => $file_type,
      'user_id'     => $user_id,
      'date'        => $human
    );
    $this->db->insert('storage', $object);
  }
  public function delete_file($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('storage');
  }

  public function init_multiple_formula($branch_id, $formula_id, $harga_dasar, $harga_item )
  {
    $object = array(
      'formula_id'        => $formula_id,
      'branch_id'         => $branch_id,
      'harga_dasar'       => $harga_dasar,
      'harga_item'        => $harga_item
    );
    $this->db->insert('multiple_formula', $object);
  }

  public function delete_multiple($branch_id)
  {
    $this->db->where('branch_id', $branch_id);
    $this->db->delete('multiple_formula');
  }

  public function update_multiple($formula_id)
  {
    $branch = $this->branch->get_all_branch();
    foreach ($branch as $key) {
      $object = array(
        'harga_dasar'         => $this->input->post('formula'.$key->id),
        'harga_item'          => $this->input->post('total'.$key->id),
      );
      $this->db->where('formula_id', $formula_id);
      $this->db->where('branch_id', $key->id);
      $this->db->update('multiple_formula', $object);
    }
  }

  public function init_formula_branch($branch_id, $subpekerjaan_id, $harga_satuan)
  {
    $object = array(
      'branch_id' => $branch_id, 
      'subpekerjaan_id' => $subpekerjaan_id,
      'harga_satuan'  => $harga_satuan
    );
    $this->db->insert('formula_branch', $object);
  }

  public function input_formula_branch($subpekerjaan_id, $branch_id, $harga_satuan)
  {
    $this->db->where('subpekerjaan_id', $subpekerjaan_id);
    $this->db->where('branch_id', $branch_id);
    $object = array('harga_satuan' => $harga_satuan);
    $this->db->update('formula_branch', $object);
  }

  public function delete_formula_branch($branch_id)
  {
    $this->db->where('branch_id', $branch_id);
    $this->db->delete('formula_branch');
  }

  public function init_comment($id_project, $user_id)
  {
    $this->load->helper('date');
    $now = time();
    $timestamp = $now;
    $timezone = 'UP7';
    $daylight_saving = FALSE;
    $GMY = gmt_to_local($timestamp, $timezone, $daylight_saving);
    $human = unix_to_human($GMY);

    $object = array(
      'project_id'  => $id_project, 
      'user_id'     => $user_id,
      'comment'     => $this->input->post('comment'),
      'time'        => $human
    );
    $this->db->insert('comments', $object);
  }
}
?>
