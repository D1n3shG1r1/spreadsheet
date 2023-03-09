<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index() {
		/*
			$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
			$this->google_spreadsheet->init(
				'ya29.a0AVA9y1s9TlUgfQ-lKVuIlHL16Hkb4T7L4aW0v_A8_Y3ua7OikKE4O64P2ZtdqasoxnpCoDE0wNjOYw41n3YQ4Lp-vFjzAoQISzG5UNRe93fEC4fSZD24f8KMRvufjsnTlb99ZZTO-ZHUBre-DncWDsO0QKdoaCgYKATASAQASFQE65dr8aTzaR0Y13u7Fyud_TaubwQ0163',
				'1//0gEex2CLLF-v6CgYIARAAGBASNwF-L9IrjBHil3LE4NO6kmgaRIEdEXoCRDxGkQ7EWQc5LVUHfK3DUF9a-DCmh9Bw0P3AZBgzwbk',
				'224356960281-pboup2jd2k185p2ct5miqtrgmdlvgfln.apps.googleusercontent.com',
				'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'
			);

			echo($this->google_spreadsheet->find_spreadsheet('MySpreadsheetsName'));die;

			if (true === $this->google_spreadsheet->find_spreadsheet('MySpreadsheetsName')) {
				echo "pass find_spreadsheet \n";
				echo "heelo"; die;
				if (true === $this->google_spreadsheet->find_worksheet('MyWorksheet', true)) {	// true: create if not exists
					echo "pass find_worksheet \n";
					if (true === $this->google_spreadsheet->update_cell(1, 1, date('Y-m-d H:i:s'))) {
						echo "pass update_cell \n";
					}

					if (true === $this->google_spreadsheet->update_cells(array(
						array( 1, 1, date('Y-m-d H:i:s') ),
						array( 1, 2, 'Hello' ),
						array( 1, 3, 'World' ),
						
					))) {
						echo "pass update_cells \n";
					}
				}
			}
		*/

		$this->load->view("home");
	}

	public function oauth() {
		
		$current_url = "http://localhost/ci/google-sheets/index.php/";
		$this->load->helper('url');
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
		$ret = $this->google_spreadsheet->oauth_request_handler(
			'224356960281-pboup2jd2k185p2ct5miqtrgmdlvgfln.apps.googleusercontent.com',
			'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',
			// scope
			array(
				'https://www.googleapis.com/auth/spreadsheets', 
				'https://spreadsheets.google.com/feeds',
			),
			// enable offline
			true,
			$current_url
		);

		/*if ($ret['action'] == 'redirect') {
			redirect($ret['data'], 'location', 301);
			return;
		}*/

		print_r($ret);
		// Array ( [action] => done [data] => Array ( [access_token] => UsersAceessToken [token_type] => Bearer [expires_in] => 3600 [created] => 1466331600 ) )
	}
}
