<?php
// include("/var/www/html/ci/google-sheets/vendor/autoload.php");
require_once ("/var/www/html/ci/google-sheets/vendor/autoload.php");

class Google_Spreadsheet {
	// https://sheets.googleapis.com/$discovery/rest?version=v4
	// https://developers.google.com/sheets/reference/rest/v4/spreadsheets/request
	public $OAUTH2_TOKEN_URI = "https://oauth2.googleapis.com/token"; 
    public $DRIVE_FILE_UPLOAD_URI = "https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart"; 
    public $DRIVE_FILE_META_URI = "https://www.googleapis.com/drive/v3/files/"; 
    public $DRIVE_FILE_URI = "https://www.googleapis.com/drive/v3/files/"; 
	
	public function __construct()
    {
        // session_start();
    }
	var $client_id;
	var $client_secret_key;
	var $access_token;
	var $spreadsheet;
	var $worksheet;
	
	function _build_request($path, $method, $get_params = array(), $post_params = array(), $ret_type = 'json') {
		$request_url = strstr($path, 'https://') === false ? 'https://sheets.googleapis.com/v4/spreadsheets/'. $path : $path ;

		if (count($get_params))
			$request_url. '?' . http_build_query($get_params);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		if ($this->session->auth('access_token'))
			$headers[] = "Authorization: OAuth " . $this->session->auth('access_token');
			//$headers[] = "Authorization: Bearer  " . $this->session->auth('access_token');

		if ($method == 'POST' || $method == 'PUT') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			//$post_data = http_build_query($post_params);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			//$headers[] = "Content-Length: " . strlen($post_data);
			$headers[] = "Content-Type: application/json";
			if (is_array($post_params) && count($post_params) > 0) {
				$post_data = json_encode($post_params);
				$headers[] = "Content-Length: " . strlen($post_data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			} else {
				$headers[] = "Content-Length: 0";
			}
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$raw = curl_exec($ch);
		curl_close($ch);

		if ($ret_type == 'json') {
			$ret = @json_decode($raw, true);
		} else if ($ret_type == 'xml') {
			$ret = simplexml_load_string($raw);
		} else {
			$ret = $raw;
		}
		return $ret;
	}

	// public function create_spreadsheet($name) {
	// 	$ret = $this->_build_request('', 'POST', array(), array());
	// 	if (isset($ret['spreadsheetId']) && $this->rename_spreadsheet($ret['spreadsheetId'], $name)) {
	// 		$ret['properties']['title'] = $name;
	// 		return $ret;
	// 	}
	// 	return false;
	// }

	public function create_spreadsheet($post_params, $method = 'POST', $ret_type = 'json') {
		// Get the API client and construct the service object
		$request_url = "https://sheets.googleapis.com/v4/spreadsheets/" ;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		if ($this->session->auth('access_token'))
			$headers[] = "Authorization: OAuth " . $this->session->auth('access_token');
			//$headers[] = "Authorization: Bearer  " . $this->session->auth('access_token');

		if ($method == 'POST' || $method == 'PUT') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			//$post_data = http_build_query($post_params);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			//$headers[] = "Content-Length: " . strlen($post_data);

			$headers[] = "Content-Type: application/json";
			if (is_array($post_params) && count($post_params) > 0) {
				$post_data = json_encode($post_params);
				$headers[] = "Content-Length: " . strlen($post_data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			} else {
				$headers[] = "Content-Length: 0";
			}
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$raw = curl_exec($ch);
		curl_close($ch);

		if ($ret_type == 'json') {
			$ret = @json_decode($raw, true);
		} else if ($ret_type == 'xml') {
			$ret = simplexml_load_string($raw);
		} else {
			$ret = $raw;
		}
		return $ret;
	}

	function getData($spreadsheetId, $range, $method = 'GET', $post_params = array(), $ret_type = 'json'){
		// Get the API client and construct the service object
		$request_url = "https://sheets.googleapis.com/v4/spreadsheets/".$spreadsheetId."/values/".$range ;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		if ($this->session->auth('access_token'))
			$headers[] = "Authorization: OAuth " . $this->session->auth('access_token');
			//$headers[] = "Authorization: Bearer  " . $this->session->auth('access_token');

		if ($method == 'POST' || $method == 'PUT') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			//$post_data = http_build_query($post_params);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			//$headers[] = "Content-Length: " . strlen($post_data);
			$headers[] = "Content-Type: application/json";
			if (is_array($post_params) && count($post_params) > 0) {
				$post_data = json_encode($post_params);
				$headers[] = "Content-Length: " . strlen($post_data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			} else {
				$headers[] = "Content-Length: 0";
			}
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$raw = curl_exec($ch);
		curl_close($ch);

		if ($ret_type == 'json') {
			$ret = @json_decode($raw, true);
		} else if ($ret_type == 'xml') {
			$ret = simplexml_load_string($raw);
		} else {
			$ret = $raw;
		}
		return $ret;
	
	}

	function AppendDataToExcel($spreadsheetId, $post_params = array(), $method='POST', $ret_type = 'json')
	{
		$request_url = "https://sheets.googleapis.com/v4/spreadsheets/".$spreadsheetId."/values:batchUpdate" ;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$headers = array();
		if ($this->session->auth('access_token'))
			$headers[] = "Authorization: OAuth " . $this->session->auth('access_token');
			//$headers[] = "Authorization: Bearer  " . $this->session->auth('access_token');

		if ($method == 'POST' || $method == 'PUT') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			//$post_data = http_build_query($post_params);
			//curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			//$headers[] = "Content-Length: " . strlen($post_data);
			$headers[] = "Content-Type: application/json";
			if (is_array($post_params) && count($post_params) > 0) {
			// 	echo "<pre>";
			// print_r(json_encode($post_params, JSON_UNESCAPED_SLASHES));
			// die;
				$post_data = json_encode($post_params, JSON_UNESCAPED_SLASHES);
				$headers[] = "Content-Length: " . strlen($post_data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			} else {
				$headers[] = "Content-Length: 0";
			}
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$raw = curl_exec($ch);
		curl_close($ch);

		if ($ret_type == 'json') {
			$ret = @json_decode($raw, true);
		} else if ($ret_type == 'xml') {
			$ret = simplexml_load_string($raw);
		} else {
			$ret = $raw;
		}
		return $ret;
	}

	public function reset() {
		$this->client_id = false;
		$this->client_secret_key = false;
		$this->access_token = false;
		$this->spreadsheet = false;
		$this->worksheet = false;
	}

	public function init($access_token, $refresh_token, $client_id, $client_secret_key) {
		$this->reset();
		// $this->load->library('session');

		if (!$this->oauth_check_token($access_token) && false == ($access_token = $this->oauth_renew_access_token($client_id , $client_secret_key, $refresh_token)) ) {
			return 'ACCESS_TOKEN ERROR';
		}

		$this->client_id = $client_id;
		$this->client_secret_key = $client_secret_key;
		$this->access_token = $access_token;
		$this->refresh_token = $refresh_token;

		$newdata = array( 
			'client_id'  		=> $client_id, 
			'client_secret_key' => $client_secret_key, 
			'access_token' 		=> $access_token,
			'refresh_token' 	=> $refresh_token,
		);
		
		$this->session->set_userdata("sheet_auth", $newdata);

		return true;
	}

	public function get_spreadsheets_properties($spreadsheetId) {
		$ret = $this->_build_request($spreadsheetId, 'GET');
		if (isset($ret['spreadsheetId']) && $ret['spreadsheetId'] == $spreadsheetId)
			return $ret;
		return false;
	}

	// v3 api
	// https://developers.google.com/google-apps/spreadsheets/worksheets#retrieve_a_list_of_spreadsheets
	public function get_spreadsheets_list() {
		$ret = $this->_build_request('https://spreadsheets.google.com/feeds/spreadsheets/private/full', 'GET', array(), array(), 'json');
		if (!isset($ret->entry))
			return false;
		$output = array();
		foreach($ret->entry as $item) {
			$data = array(
				'url' => (string)$item->id,
				'id' => str_replace('https://spreadsheets.google.com/feeds/spreadsheets/private/full/', '' , (string)$item->id),
				'title' => (string)$item->title,
			);
			if (isset($item->author) && isset($item->author->name) && isset($item->author->email)) {
				$data['author'] = array(
					'name' => (string)$item->author->name,
					'email' => (string)$item->author->email,
				);
			}
			array_push($output, $data);
		}
		return $output;
	}

	// https://developers.google.com/sheets/reference/rest/v4/spreadsheets/create
	// https://developers.google.com/sheets/reference/rest/v4/spreadsheets#spreadsheetproperties

	public function rename_spreadsheet($spreadsheetId, $name) {
		$ret = $this->_build_request($spreadsheetId.':batchUpdate', 'POST', array(), array(
			'requests' => array(
				array(
					'updateSpreadsheetProperties' => array(
						'properties' => array(
							'title' => $name
						),
						'fields' => 'title'
					)
				)
			)
		));
		if (isset($ret['spreadsheetId']))
			return true;
		return false;
	}

	public function create_worksheet($spreadsheetId, $name) {
		$ret = $this->_build_request($spreadsheetId.':batchUpdate', 'POST', array(), array(
			'requests' => array(
				array(
					'addSheet' => array(
						'properties' => array(
							'title' => $name
						),
					)
				)
			)
		));
		if (isset($ret['spreadsheetId']))
			return true;
		return false;
	}

	public function delete_worksheet($spreadsheetId, $sheetId) {
		$ret = $this->_build_request($spreadsheetId.':batchUpdate', 'POST', array(), array(
			'requests' => array(
				array(
					'deleteSheet' => array(
						'sheetId' => $sheetId
					)
				)
			)
		));
		if (isset($ret['spreadsheetId']))
			return true;
		return false;
	}

	public function delete_current_worksheet() {
		if ($this->spreadsheet == false || $this->worksheet == false)
			return false;
		return $this->delete_worksheet($this->spreadsheet['id'], $this->worksheet['id']);
	}

	// https://developers.google.com/sheets/reference/rest/v4/spreadsheets#gridproperties
	public function frozen_worksheet($spreadsheetId, $sheetId, $row = 0, $column = 0) {
		$ret = $this->_build_request($spreadsheetId.':batchUpdate', 'POST', array(), array(
			'requests' => array(
				array(
					'updateSheetProperties' => array(
						'properties' => array(
							'sheetId' => $sheetId,
							'gridProperties' => array(
								'frozenRowCount' => (int)$row,
								'frozenColumnCount' => (int)$column,
							)
						),
						'fields' => 'gridProperties.frozenRowCount,gridProperties.frozenColumnCount',
					)
				)
			)
		));
		if (isset($ret['spreadsheetId']))
			return true;
		return false;
	}

	public function frozen_current_worksheet($row = 0, $column = 0) {
		if ($this->spreadsheet == false || $this->worksheet == false)
			return false;
		return $this->frozen_worksheet($this->spreadsheet['id'], $this->worksheet['id'], $row, $column);
	}

	public function find_spreadsheet($name, $auto_create = false) {
		$this->spreadsheet = false;
		echo "<pre>";
		print_r($auto_create);die;
		do {
			if (!isset($this->access_token) || false === ($ret = $this->get_spreadsheets_list()) || !is_array($ret) )
				return false;

			foreach($ret as $item) {
				if (isset($item['title']) && !strcmp($item['title'], $name)) {
					$this->spreadsheet = $item;
					return true;
				}
			}

			if (!$auto_create)
				break;
			$auto_create = false;
			if (!$this->create_spreadsheet($name))
				break;
		} while(true);

		return false;
	}

	public function find_worksheet($name, $auto_create = false) {
		if ($this->spreadsheet === false)
			return false;
		$worksheet = false;
		do {
			$ret = $this->get_spreadsheets_properties($this->spreadsheet['id']);
			if (!isset($ret['sheets']) || !is_array($ret['sheets'])) {
				return false;
			}
			foreach($ret['sheets'] as $item) {
				if (isset($item['properties']) && isset($item['properties']['title']) && !strcmp($item['properties']['title'], $name)) {
					$this->worksheet = $item['properties'];
					$this->worksheet['id'] =  $this->worksheet['sheetId'];
					break;
				}
			}
			if ($this->worksheet != false || !$auto_create)
				break;
			if ($auto_create) {
				$auto_create = false;
				if (!$this->create_worksheet($this->spreadsheet['id'], $name))
					break;
			}
		} while( true );
		return $this->worksheet !== false;
	}

	public function update_cell($row, $column, $value) {
		return $this->update_cells( array(array($row, $column, $value)) );
	}

	public function update_cells($data = array()) {
		if ($this->spreadsheet === false || $this->worksheet === false || !is_array($data))
			return false;

		$cells = array();
		foreach($data as $cell) {
			if (count($cell) == 3) {
				array_push($cells, array(
					'range' => chr($cell[1]%26+ord('A') - 1).$cell[0] . ':' . chr($cell[1]%26+ ord('A') - 1).$cell[0] ,
					'majorDimension' => 'ROWS',
					'values' => array(
						array( $cell[2] )
					)
				));
			}
		}

		$ret = $this->_build_request($this->spreadsheet['id'].'/values:batchUpdate', 'POST', array(), array(
			'valueInputOption' => 'RAW',
			'data' => $cells
		));

		if (isset($ret['spreadsheetId']) && isset($ret['totalUpdatedSheets']) && isset($ret['totalUpdatedCells']))
			return $ret['totalUpdatedSheets'] > 1 && $ret['totalUpdatedCells'] > 1;

		return false;
	}

	public function oauth_request_handler($client_id, $client_secret_key, $scope, $offline = true, $redirect = NULL, $state = NULL) {
		$output = array('action' => 'none');
		//$client = new Google_Client();
		$client = new Google\Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret_key);
		// https://developers.google.com/sheets/guides/authorizing#OAuth2Authorizing
		$client->setScopes($scope);
		if ($offline)
			$client->setAccessType('offline');
		if (empty($redirect))
			$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			$redirect = filter_var($redirect, FILTER_SANITIZE_URL);

		$client->setRedirectUri($redirect);
		if (!empty($state)) {
			$output['state'] = $state;
			if (!is_array($state))
				$state = http_build_query($state);
			$client->setState($state);
		}
	
		try{
			if (isset($_GET['code'])) {
				$client->authenticate($_GET['code']);
				if (!empty($client->getAccessToken())) {
					$output['action'] = 'done';
					$output['data'] = $client->getAccessToken();
					return $output;
				}
			}
		} catch (Exception $e) {
		}

		if (!isset($_GET['error'])) {
			$output['action'] = 'redirect';
			$output['data'] = $client->createAuthUrl();
		} else {
			$output['action'] = 'error';
			$output['data'] = $_GET['error'];
		}
		return $output;
	}


	
	function oauth_check_token($token, $min_expire_time = 600) {
		$ret = @json_decode(@file_get_contents(
			'https://www.googleapis.com/oauth2/v1/tokeninfo' . '?' . http_build_query( array(
				'access_token' => $token
			))
		));
		return isset($ret->expires_in) && $ret->expires_in > $min_expire_time;
	}

	function oauth_renew_access_token($client_id, $client_secret_key, $refresh_token) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/oauth2/v4/token');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
			'refresh_token' => $refresh_token,
			'client_id' => $client_id,
			'client_secret' => $client_secret_key,
			'grant_type' => 'refresh_token',
		))); 
		$ret = @json_decode(curl_exec($ch));
		curl_close($ch);
		if (isset($ret->access_token))
		return $ret->access_token;
		return false;
	}

	/*Google Drive API  */

	public function GetDriveAccessToken($client_id, $redirect_uri, $client_secret, $code) {
		$curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code'; 
	
		// echo '<pre>';
		// print_r($curlPost);
		// die;
		$ch = curl_init();         
		curl_setopt($ch, CURLOPT_URL, $this->OAUTH2_TOKEN_URI);         
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);         
		curl_setopt($ch, CURLOPT_POST, 1);         
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);     
		$data = json_decode(curl_exec($ch), true); 
		$http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE); 
		 
		if ($http_code != 200) { 
			$error_msg = 'Failed to receieve access token'; 
			if (curl_errno($ch)) { 
				$error_msg = curl_error($ch); 
			} 
			throw new Exception('Error '.$http_code.': '.$error_msg); 
		} 
			 
		return $data; 
	}

	function UploadFileToDrive($access_token, $file_content, $mime_type) { 
        $apiURL = $this->DRIVE_FILE_UPLOAD_URI; 
        $ch = curl_init();         
        curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/upload/drive/v3/files?uploadType=media");         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);         
        curl_setopt($ch, CURLOPT_POST, 1);         
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: '.$mime_type, 'Authorization: Bearer '. $access_token)); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $file_content); 
        $data = json_decode(curl_exec($ch), true); 

        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);         
         
        if ($http_code != 200) { 
            $error_msg = 'Failed to upload file to Google Drive'; 
            if (curl_errno($ch)) { 
                $error_msg = curl_error($ch); 
            } 
            throw new Exception('Error '.$http_code.': '.$error_msg); 
        } 
 
        return $data['id']; 
    } 
     
    function UpdateFileMeta($access_token, $file_id, $file_meatadata) { 
        $apiURL = $this->DRIVE_FILE_META_URI.$file_id; 
         
        $ch = curl_init();         
        curl_setopt($ch, CURLOPT_URL, $apiURL);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);         
        curl_setopt($ch, CURLOPT_POST, 1);         
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '. $access_token)); 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH'); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($file_meatadata)); 
        $data = json_decode(curl_exec($ch), true); 
        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);         
         
        if ($http_code != 200) { 
            $error_msg = 'Failed to update file metadata'; 
            if (curl_errno($ch)) { 
                $error_msg = curl_error($ch); 
            } 
            throw new Exception('Error '.$http_code.': '.$error_msg); 
        } 
 
        return $data; 
    } 

	function UpdateFilePermissions($access_token, $file_id, $filePermission)
	{

		$apiURL = $this->DRIVE_FILE_URI.$file_id.'/permissions'; 
         
        $ch = curl_init();         
        curl_setopt($ch, CURLOPT_URL, $apiURL);         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);         
        curl_setopt($ch, CURLOPT_POST, 1);         
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer '. $access_token)); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($filePermission)); 
        $data = json_decode(curl_exec($ch), true); 
        $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);         
         
        if ($http_code != 200) { 
            $error_msg = 'Failed to update file metadata'; 
            if (curl_errno($ch)) { 
                $error_msg = curl_error($ch); 
            } 
            throw new Exception('Error '.$http_code.': '.$error_msg); 
        } 
 
        return $data; 
	}

	function DeleteDriveFile($access_token, $file_id){
		// Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.googleapis.com/drive/v3/files/1YXjJi3FGlTZPrzvSTFaHzOWwuJiYEB8X?key=AIzaSyDl8zTRpWiAmWhHQe3vH24R5DvyKgw6PRA');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');

		curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

		$headers = array();
		$headers[] = 'Authorization: Bearer '.$access_token;
		$headers[] = 'Accept: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}

		curl_close($ch);
 
        return true; 
	}
}

