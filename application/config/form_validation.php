<?php
$config = array(
    'login' => array(
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|required'
             ),
        array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
             )
        ),
    'create_project' => array(
        array(
                'field' => 'nama',
                'label' => 'Nama Project',
                'rules' => 'required|max_length[40]'
             ),
        array(
                'field' => 'jenis',
                'label' => 'Jenis Project',
                'rules' => 'required|max_length[30]'
             ),
        array(
                'field' => 'lokasi',
                'label' => 'Lokasi Pelaksanaan Project',
                'rules' => 'required'
             ),
        array(
                'field' => 'alamat',
                'label' => 'Alamat Pelaksanaan Project',
                'rules' => 'required|max_length[60]'
             ),
        array(
                'field' => 'owner',
                'label' => 'Owner Project',
                'rules' => 'required|max_length[30]'
             ),
        array(
                'field' => 'tahun',
                'label' => 'Tahun Anggaran Project',
                'rules' => 'required|max_length[4]'
             )
        ),
    'change_password' => array(
        array(
                'field' => 'old_password',
                'label' => 'Password Lama',
                'rules' => 'required|min_length[5]|max_length[12]'
             ),
        array(
                'field' => 'new_password',
                'label' => 'Password Baru',
                'rules' => 'required|matches[confirm_password]|min_length[5]|max_length[12]'
             ),
        array(
                'field' => 'confirm_password',
                'label' => 'Confirmasi Password Baru',
                'rules' => 'required|min_length[5]|max_length[12]'
             ),
        ),
    'formula' => array(
        array(
                'field' => 'rumus',
                'label' => 'Rumus',
                'rules' => 'required'
             ),
        array(
                'field' => 'satuan',
                'label' => 'Satuan',
                'rules' => 'required'
             ),
        array(
                'field' => 'nama_item',
                'label' => 'Nama Item',
                'rules' => 'required'
             ),
        array(
                'field' => 'harga_dasar',
                'label' => 'Harga Dasar',
                'rules' => 'required'
             ),
        array(
                'field' => 'harga_item',
                'label' => 'Harga Item',
                'rules' => 'required'
             ),
        ),
    'pekerjaan' => array(
        array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
             ),
        ),
    'upload' => array(
        array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
             ),
        ),
    'subpekerjaan' => array(
        array(
                'field' => 'nama',
                'label' => 'Nama',
                'rules' => 'required'
             ),
        array(
                'field' => 'peraturan',
                'label' => 'peraturan',
                'rules' => ''
             ),
        ),
    'branch' => array(
        array(
                'field' => 'name',
                'label' => 'Nama Cabang',
                'rules' => 'required'
             ),
        array(
                'field' => 'address',
                'label' => 'Alamat Cabang',
                'rules' => 'required'
             ),
        array(
                'field' => 'phone_number',
                'label' => 'Nomer Telepon',
                'rules' => 'required'
             ),
        array(
                'field' => 'leader',
                'label' => 'Nama Pimpinan Cabang',
                'rules' => 'required'
             ),
        array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
             ),
        array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required'
             ),
        ),
);

?>