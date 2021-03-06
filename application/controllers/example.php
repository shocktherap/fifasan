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
        print_r($dbobj);
		    // print_r($this->session->userdata('oauth_token'));
        // print_r($dbobj);
        // $path1 = 'basmol-branch/branch';
        // $data1 = $this->dropbox->create_folder($path1, $root='dropbox');
        // $path2 = 'depok-branch/branch';
        // $data2 = $this->dropbox->create_folder($path2, $root='dropbox')basmol-branch/branch;
        // $path = 'Jakarta-branch/nama/Kartu_Hasil_Studi_19_Desember_2011(4).pdf';
        // $dbpath = 'Jakarta-branch/branch/15.jpg';
        // $filepath = 'filestorage/15.jpg';
          // $path = 'uin-branch';
          // $data = $this->dropbox->delete($path, $root='dropbox');
          // print_r($data);
        // $data = $this->dropbox->add($dbpath, $filepath, array(), $root='dropbox');
        // print_r($data);
        // $data1 = $this->dropbox->metadata($dbpath, array(), $root='dropbox');
        // print_r($data1);
        // $destination = 'downloads/a.jpg';
        // $c = $this->dropbox->get($destination, $dbpath, $root='dropbox');
        // print_r($c);
        $path = 'Jakarta-branch/nama/format.docx';
        $link = $this->dropbox->media($path, $root='dropbox');
        print_r($link);

	}

  public function excel_call()
  {
    
  }
}

/* End of file example.php */
/* Location: ./application/controllers/welcome.php */