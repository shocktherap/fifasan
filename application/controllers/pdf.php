<?php

class Pdf extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('input_data');
    $this->load->model('get_data');
    $this->load->model('projects');
  }

  public function index() {
     $html = '<html>
         <body>
         <?php echo 1;?>
           <table border="1">
           <tr>
           <td>No</td>
           <td>Nama</td>
           <td>Pengeluaran</td>
           <td>Keterangan</td>
           </tr>
           </table>
         </body>
         </html>
         ';
    $data = 1;
    $print = $this->load->view('print', $data, TRUE);

    $pdf_filename  = 'report.pdf';
    $this->load->library('dompdf_lib');
    $this->dompdf_lib->convert_html_to_pdf($print, $pdf_filename, true);
  }
}

/* End of file pdf.php */
/* Location: ./application/controllers/pdf.php */?>