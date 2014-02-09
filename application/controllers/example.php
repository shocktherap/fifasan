<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller
{
    public function __construct()
    {
    	parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    // Call this method first by visiting http://SITE_URL/example/request_dropbox
    public function request_dropbox()
	{
		$params['key'] = 'xkyyxbuqotb6m81';
		$params['secret'] = 'cnqyeay9b5kaz4w';
		
		$this->load->library('dropbox', $params);
		$data = $this->dropbox->get_request_token(site_url("example/access_dropbox"));
		$this->session->set_userdata('token_secret', $data['token_secret']);
		redirect($data['redirect']);
	}
	//This method should not be called directly, it will be called after 
    //the user approves your application and dropbox redirects to it
	public function access_dropbox()
	{
		$params['key'] = 'xkyyxbuqotb6m81';
		$params['secret'] = 'cnqyeay9b5kaz4w';
		
		$this->load->library('dropbox', $params);
		
		$oauth = $this->dropbox->get_access_token($this->session->userdata('token_secret'));
		
		$this->session->set_userdata('oauth_token', $oauth['oauth_token']);
		$this->session->set_userdata('oauth_token_secret', $oauth['oauth_token_secret']);
        redirect('example/test_dropbox');
	}
	//Once your application is approved you can proceed to load the library
    //with the access token data stored in the session. If you see your account
    //information printed out then you have successfully authenticated with
    //dropbox and can use the library to interact with your account.
	public function test_dropbox()
	{
		$params['key'] = 'xkyyxbuqotb6m81';
		$params['secret'] = 'cnqyeay9b5kaz4w';
		$params['access'] = array('oauth_token'=>urlencode($this->session->userdata('oauth_token')),
								  'oauth_token_secret'=>urlencode($this->session->userdata('oauth_token_secret')));
		
		$this->load->library('dropbox', $params);
		
        $dbobj = $this->dropbox->account();
		    // print_r($this->session->userdata('oauth_token'));
        // print_r($dbobj);
        // $path1 = 'basmol-branch/branch';
        // $data1 = $this->dropbox->create_folder($path1, $root='dropbox');
        // $path2 = 'depok-branch/branch';
        // $data2 = $this->dropbox->create_folder($path2, $root='dropbox')basmol-branch/branch;
        // $path = 'Apps';
        // $dbpath = 'basmol-branch/branch';
        // $filepath = '/home/izqil/Pictures/15.jpg';
          // $path = 'uin-branch';
          // $data = $this->dropbox->delete($path, $root='dropbox');
          // print_r($data);
        // $data = $this->dropbox->add($dbpath, $filepath, array(), $root='dropbox');
        // print_r($data);
        // $data1 = $this->dropbox->metadata($path, array(), $root='dropbox');
        // print_r($data);
        // $destination = 'filestorage/c.jpg';
        // $c = $this->dropbox->get($destination, $path, $root='dropbox');
        // print_r($c);

	}

  public function excel_call()
  {
    $this->load->library('excel');
    $this->excel->setActiveSheetIndex(0);
    $this->excel->getActiveSheet()->setTitle('Rencana Anggaran Belanja');
    $this->excel->getActiveSheet()->setCellValue('A1', 'Rencana Anggaran Belanja');
    $this->excel->getActiveSheet()->setCellValue('A2', '');
    $this->excel->getActiveSheet()->setCellValue('A3', 'Nama Project');
    $this->excel->getActiveSheet()->setCellValue('A4', 'Jenis Project');
    $this->excel->getActiveSheet()->setCellValue('A5', 'Alamat Project');
    $this->excel->getActiveSheet()->setCellValue('A6', 'Owner Project');
    $this->excel->getActiveSheet()->setCellValue('A7', 'Pekerja Project');
    $this->excel->getActiveSheet()->setCellValue('B3', 'TEST');
    $arrayData = array(
      array(NULL, 2010, 2011, 2012),
      array('Q1',   12,   15,   21),
      array('Q2',   56,   73,   86),
      array('Q3',   52,   61,   69),
      array('Q4',   30,   32,    0),
    );
    $this->excel->getActiveSheet()
        ->fromArray(
            $arrayData,  // The data to set
            NULL,        // Array values with this value will not be set
            'C3'         // Top left coordinate of the worksheet range where
                         //    we want to set these values (default is A1)
        );
    $filename = 'Rencana Anggaran Belanja.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');


  }
}

/* End of file example.php */
/* Location: ./application/controllers/welcome.php */