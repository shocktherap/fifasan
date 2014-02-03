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
     // $html = '<html>
     //     <head>
     //      <title>Print Rincian Rencana Anggaran</title>
     //     </head>
     //     <body>
     //       1
     //     </body>
     //     </html>
     //     ';
    $html = $this->load->view('html','', true);
    $pdf_filename  = 'report.pdf';
    $this->load->library('dompdf_lib');
    $this->dompdf_lib->convert_html_to_pdf($html, $pdf_filename, true);
  }
}

/* End of file pdf.php */
/* Location: ./application/controllers/pdf.php */?>