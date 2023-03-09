<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	var $GOOGLE_CLIENT_ID = '';
	var $GOOGLE_CLIENT_SECRET = ""; 
	var $GOOGLE_OAUTH_SCOPE = ""; 
	var $REDIRECT_URI = ""; 

	
	function __construct(){

        parent::__construct();

        $this->load->config("google_config");

		$this->GOOGLE_CLIENT_ID = $this->config->item('GOOGLE_CLIENT_ID'); 
		$this->GOOGLE_CLIENT_SECRET = $this->config->item('GOOGLE_CLIENT_SECRET'); 
		$this->GOOGLE_OAUTH_SCOPE = $this->config->item('GOOGLE_OAUTH_SCOPE'); 
		$this->REDIRECT_URI = $this->config->item('REDIRECT_URI'); 

	}
	

	function downloadFile(){
		
		
		$imgUrl = "https://images.pexels.com/photos/39517/rose-flower-blossom-bloom-39517.jpeg";

		$imgUrl = "https://images.pexels.com/photos/39517/rose-flower-blossom-bloom-39517.jpeg?cs=srgb&dl=pexels-pixabay-39517.jpg&fm=jpg";


		$imgUrlParts = explode("/", $imgUrl);

		//$imgUrlParts[COUNT($imgUrlParts) - 1];
		$lastElement = end($imgUrlParts);


		if(strpos($lastElement,"?")){
			$lastElementParts = explode("?", $lastElement);
			$fileName = $lastElementParts[0]; //file name
		}else{
			$fileName = $lastElement;
		}


		//$decodedUrl = urldecode($url);
		$decodedUrl = $imgUrl;
		$localFilePath  = FCPATH . 'tmp_assets/';
		
		$targetfile = $localFilePath."test.jpg";
		exec('curl -o "'.$targetfile.'" "'.$decodedUrl.'"', $output);
		
		echo "output:<pre>"; print_r($output); echo "</pre>";

		$content = file_get_contents($targetfile);
		if($content != ""){
			$base64Encode = base64_encode($content);
			$base64Data = "data:image/jpeg;base64,".$base64Encode;
			
		}
		
		//exec('rm -f "'.$targetfile.'"', $output2);

	}

	function readTheCdnFile($file){
	if(strpos($file,'http://') !== false || strpos($file,'https://') !== false){
		
		$CDNHIPFILEPATH 	 = CDNHIPFILEPATH;
		$CDNUPFILEPATH  	 = CDNMAINUPFILEPATH;
		$CDN_NONSSL_PATH     = CDN_NONSSL_PATH;
		$CDN_NONSSL_UP_PATH  = CDN_NONSSL_UP_PATH;
		
		if(strpos($file,$CDNHIPFILEPATH) !== false){
			$file = str_replace($CDNHIPFILEPATH,$CDN_NONSSL_PATH,$file);
		} else if(strpos($file,$CDNUPFILEPATH) !== false){
			$file = str_replace($CDNUPFILEPATH,$CDN_NONSSL_UP_PATH,$file);
		}
		//echo $file; die;
		$output = array();
		exec("curl $file",$output);
		
		$data = implode("\n",$output);
		if($data != ''){
			$content = json_decode($data, true);
			if(is_array($content)){
				if($content['status'] == 404){
					$data = "";
				}
			}
		}
	} else {
		$data = file_get_contents($file);
	}
	return $data;
}


	function pdf(){
		echo FCPATH; die;
		$this->load->view("admin/testpdf");
	}

	public function oauth() {
		// die;
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');

		/*Google Sheets integration*/
			$current_url = "http://localhost/ci/google-sheets/index.php/test/oauth";
			$clientId = '282714457122-mcd6vgnbrfqrbm7p3jvk70ivtru1oag2.apps.googleusercontent.com';
			$secretKey = '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';
			$scope = array(
				'https://www.googleapis.com/auth/spreadsheets', 
				'https://spreadsheets.google.com/feeds',
			);
			$offline = true;
			$redirectUrl = $current_url;
			$this->load->helper('url');
			$ret = $this->google_spreadsheet->oauth_request_handler(
				$clientId,
				$secretKey,
				$scope,
				$offline,
				$redirectUrl
			);
			

		/*Google Drive Integration */
		
		if ($ret['action'] == 'redirect') {
			redirect($ret['data'], 'location', 301);
			return;
		}

		if ($ret['action']) {
			$access_token = $ret['data']['access_token'];
			$refresh_token = $ret['data']['refresh_token'];
			$this->google_spreadsheet->init(
				$access_token,
				$refresh_token,
				$clientId,
				$secretKey
			);

			redirect('/', 'refresh');
		}
	}

	public function DriveOauth()
	{
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
		/*Google Sheets integration*/
			if (!empty($_GET['code'])) {

				$data = $this->google_spreadsheet->GetDriveAccessToken($this->GOOGLE_CLIENT_ID, $this->REDIRECT_URI, $this->GOOGLE_CLIENT_SECRET, $_GET['code']); 
				$access_token = $data['access_token']; 
				$refresh_token = $data['refresh_token']; 
				$driveOauth = array(
					'access_token' => $access_token,
					'refresh_token' => $refresh_token
				);

				$this->session->set_userdata('drive_auth', $driveOauth); 
			}else {
				$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode($this->GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' .$this->REDIRECT_URI. '&response_type=code&client_id='. $this->GOOGLE_CLIENT_ID.'&access_type=online';

				header("Location: $googleOauthURL");
			}

		/*Google Drive Integration */

		redirect('/', 'refresh');
	}
}
?>
