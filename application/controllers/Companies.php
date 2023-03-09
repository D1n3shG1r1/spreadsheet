<?php
/*
  https://whatsapp.scip.co/projectsuperset/index.php/companies/addcompany
*/

//require_once ("/var/www/html/ci/google-sheets/vendor/autoload.php");

class Companies extends CI_Controller {
		
		var $LOGINUSERID;
    
    function __construct(){

        parent::__construct();

        //$this->load->config("google_config");
        $this->load->model("Admin");
        
        if(!$this->session->userdata("loginId") || $this->session->userdata("loginId") == ""  || $this->session->userdata("loginId") == null || $this->session->userdata("loginId") == "undefined"){

        	redirect("login");

        }else{
        	$this->LOGINUSERID = $this->session->userdata("loginId");

        }

        
    }

    function index($p=1){

    	$userId = $this->LOGINUSERID;
      $companies = $this->Admin->getCompaniesList($p=1, $userId);

      $data = array();	
      $data["pageTitle"] = "Companies";
      $data['companies'] = $companies;

      $this->load->view("admin/companylist", $data);

    }

    function addcompany(){

    	$homePath = FCPATH;		
		 	$dirPath = $homePath . "assets/datafiles/";
      $fileName = "companygroups.txt";
			$filePath = $dirPath . $fileName;

    	$companiesGroupsList = fileRead($filePath);

    	if($companiesGroupsList != ""){
    		$companyGroups = explode(",",$companiesGroupsList);
    	}else{
    		$companyGroups = array();
    	}

      $countries = $this->Admin->getCountries();

      $data = array();
      $data["pageTitle"] = "Add Company";
      $data["countries"] = $countries;
      $data["companyGroups"] = $companyGroups;
      $this->load->view("admin/addcompanyform", $data);

    }

    function getCountryZones(){

      $countryId = $this->input->post("countryId");

      $countryZones = $this->Admin->getCountryZones($countryId);

      if(!empty($countryZones)){
        $result = array("C" => 100, "R" => $countryZones, "M" => "success");
      }else{
        $result = array("C" => 101, "R" => $countryZones, "M" => "error");
      }
      echo json_encode($result); die;

    }

    function company($id){

      if($id){

          $companyData = $this->Admin->getCompanById($id);

          $countries = $this->Admin->getCountries();
          $countryZones = $this->Admin->getCountryZones($companyData["country"]);

          
          $homePath = FCPATH;		
				 	$dirPath = $homePath . "assets/datafiles/";
		      $fileName = "companygroups.txt";
					$filePath = $dirPath . $fileName;
          
          $companiesGroupsList = fileRead($filePath);

		    	if($companiesGroupsList != ""){
		    		$companyGroups = explode(",",$companiesGroupsList);
		    	}else{
		    		$companyGroups = array();
		    	}


          $data = array();
          $data["pageTitle"] = "Edit Company";
          $data["countries"] = $countries;
          $data["countryZones"] = $countryZones;
          $data["companyData"] = $companyData;
          $data["companyGroups"] = $companyGroups;
          $this->load->view("admin/editcompanyform", $data);

      }else{
        redirect('companies/index/');
      }

    }

    function savecompany(){


        if($this->input->post("companyId")){
            $companyId = $this->input->post("companyId");
        }else{
          $companyId = 0;
        }

        $companyName = $this->input->post("companyName");
        $companyGroup = $this->input->post("companyGroup");
        $country = $this->input->post("country");
        $province = $this->input->post("province");
        $city = $this->input->post("city");
        $companyAddress1 = $this->input->post("companyAddress1");
        $companyAddress2 = $this->input->post("companyAddress2");
        $phone1 = $this->input->post("phone1");
        $phone2 = $this->input->post("phone2");
        $primaryEmail = $this->input->post("primaryEmail");
        $secondaryEmail = $this->input->post("secondaryEmail");
        $industry = $this->input->post("industry");
        $technology = $this->input->post("technology");
        $revenueModel = $this->input->post("revenueModel");

        //superset_portfolio_companies
        $newrecord = 0;
        if($companyId > 0){
            $id = $companyId;
            $newrecord = 0;
        }else{
            $id = db_randomnumber();
            $newrecord = 1;
        }

        $addedDateTime = date("Y-m-d H:i:s");
        $saveData = array();
        $saveData["id"] = $id;
        $saveData["userId"] = $this->LOGINUSERID;
        $saveData["companyName"] = $companyName;
        $saveData["companyGroup"] = $companyGroup;
        $saveData["addedDateTime"] = $addedDateTime;
        $saveData["companyAddress1"] = $companyAddress1;
        $saveData["companyAddress2"] = $companyAddress2;
        $saveData["city"] = $city;
        $saveData["province"] = $province;
        $saveData["country"] = $country;
        $saveData["phone1"] = $phone1;
        $saveData["phone2"] = $phone2;
        $saveData["primaryEmail"] = $primaryEmail;
        $saveData["secondaryEmail"] = $secondaryEmail;
        $saveData["industry"] = $industry;
        $saveData["technology"] = $technology;
        $saveData["revenueModel"] = $revenueModel;

        $save = $this->Admin->saveCompany($saveData,$newrecord);
        if($save > 0){
          $result = array(
            "C" => 100,
            "R" => array("id" => $id, 'companies' => 'companies'),
						"redirect" => "companies",
            "M" => "success"
          );
        }else{
          $result = array(
            "C" => 101,
            "R" => array(),
            "M" => "error"
          );
        }
				// redirect('companies/index/');

        echo json_encode($result); die;

    }


    function removeCompany(){
        $companyId = $this->input->post("companyId");

        $removed = $this->Admin->removeCompany($companyId);

        if($removed > 0){
          $result = array(
            "C" => 100,
            "R" => array("id" => $companyId),
            "M" => "success"
          );
        }else{
          $result = array(
            "C" => 101,
            "R" => array(),
            "M" => "error"
          );
        }

        echo json_encode($result); die;
    }

	function reports(){
			$userId = $this->LOGINUSERID;
      $reports = $this->Admin->getReportsList($userId);
			
      $data = array();
      $data["pageTitle"] = "Reports";
      $data['reports'] = $reports;
    //   echo "data:<pre>"; print_r($data); die;
      $this->load->view("admin/reportlist", $data);
	}

	function removeReport(){
			
		$reportId = $this->input->post("reportId");
		$companyId = $this->input->post("companyId");


		$excelData = $this->Admin->getExcelData($reportId);

		if(!empty($excelData)){
			
			$oldFileName = $excelData["excel_old_file_name"];
			$newFileName = $excelData["excel_new_file_name"];
		

			//remove related files from directory	
			$file = FCPATH . "company_assets/".$companyId."/".$oldFileName;
			removeFile($file);
			$file = FCPATH . "company_assets/".$companyId."/".$newFileName;
			removeFile($file);


			$removed = $this->Admin->removeReport($reportId);

			if($removed > 0){
				
				$result = array(
					"C" => 100,
					"R" => array("id" => $reportId),
					"M" => "success"
				);
			
			}else{
				
				$result = array(
					"C" => 101,
					"R" => array(),
					"M" => "error"
				);
			}

		}else{

			$result = array(
				"C" => 101,
				"R" => array(),
				"M" => "error"
			);
		
		}

		echo json_encode($result); die;
	}

    function uploadxlssheet(){
    		$userId  = $this->LOGINUSERID;
        $ver = db_randomnumber();
        
        $homePath = FCPATH;		
			 	$dirPath = $homePath . "assets/datafiles/";
	      $fileName = "companygroups.txt";
				$filePath = $dirPath . $fileName;

	    	$companiesGroupsList = fileRead($filePath);

	    	if($companiesGroupsList != ""){
	    		$companyGroups = explode(",",$companiesGroupsList);
	    	}else{
	    		$companyGroups = array();
	    	}

        //---
        $companies = $this->Admin->getCompaniesDropdownList($userId);

        $data = array();
        $data["pageTitle"] = "File upload";
        $data["companies"] = $companies;
        $data["companyGroups"] = $companyGroups;

        // echo "<pre>"; print_r($this->session);
        // die;
        //$this->load->view("admin/uploadXlsSheets", $data);
        // $this->load->view("admin/xlssheet", $data);
        $this->load->view("admin/excelsheet", $data);

    }

    function saveReport(){
		$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
		$excel_dir_path = $_SERVER["DOCUMENT_ROOT"].'/ci/google-sheets/company_assets';
		// die;
		$portfolioCompany = $this->input->post("portfolioCompany");
        $portfolioCompanyGroup = $this->input->post("portfolioCompanyGroup");
        $reportdate = $this->input->post("reportdate");
        $upload_file = $this->input->post("upload_file");

		$date  = strtotime($reportdate);

		$newformat = date('m/d/Y',$date);

		if($portfolioCompany == 0 || $portfolioCompany == null || $portfolioCompany == "") {
				$portfolioCompany = db_randomnumber();
				$folderPath = $excel_dir_path."/".$portfolioCompany;
				create_local_folder($folderPath);
			}else{
				$folderPath = $excel_dir_path."/".$portfolioCompany;
				create_local_folder($folderPath);
		}

		$fileName = $upload_file["fileName"];
		$fileSize = $upload_file["fileSize"];
		$fileType = $upload_file["fileType"]; //mime type
		$fileBs64Data = $upload_file["fileBs64Data"];

		$fileDataUrlParts = explode("base64,", $fileBs64Data);
		$fileDecodeData = base64_decode($fileDataUrlParts[1], true);

		$fpath = $folderPath."/".$fileName;

		fileWrite($fpath,$fileDecodeData);
		
		$file_name = explode(".",$fileName); 
		$spreadsheet_name = $file_name[0];

		$file_content = file_get_contents($fpath);
		// $access_token = $this->session->userdata('drive_auth');
		// echo "<pre>";
		// print_r($fpath);
		// die;
		
		// $drive_file_id = $this->google_spreadsheet->UploadFileToDrive($access_token, $file_content, $fileType);
		// if ($drive_file_id) {
		// 	$file_meta = array( 
		// 		'name' => basename($fileName)
		// 	);
		// $drive_upload_meta = $this->google_spreadsheet->UpdateFileMeta($access_token, $drive_file_id, $file_meta); 

		$id = db_randomnumber();
		$userId = $this->LOGINUSERID;
		$old_excel_file = $portfolioCompany.'/'.$fileName;

		$saveData = array();
		$saveData['id'] = $id;
		$saveData['userId'] = $userId;
		$saveData['porfolio_company_id'] = $portfolioCompany;
		$saveData['company_group'] = $portfolioCompanyGroup;
		$saveData['report_date'] = $newformat;
		// $saveData['old_excel_json'] = $reportData;
		$saveData['old_excel_file'] = $old_excel_file;
		$saveData['excel_old_file_name'] = $fileName;

		$save = $this->Admin->InsertExcelData($saveData);

		$result = array(
			"C" => 100,
			"status" => "success",
			"id" => $id,
			"message" => "Excel sheet saved Successfully!",
			"redirect" => "companies/showexcelsheet/".$id
		);

		echo json_encode($result);die;

    }

		function SaveExcelSheetToFolder()
		{ die("access denied."); 
			$excel_dir_path = $_SERVER["DOCUMENT_ROOT"].'/ci/google-sheets/company_assets';
			$portfolioCompany = 1663046676825801;
			if($portfolioCompany == 0 || $portfolioCompany == null || $portfolioCompany == "") {
					$portfolioCompany = db_randomnumber();
					$folderPath = $excel_dir_path."/".$portfolioCompany;
					create_local_folder($folderPath);
				}else{
					$folderPath = $excel_dir_path."/".$portfolioCompany;
					create_local_folder($folderPath);
			}

			if(!empty($_FILES["file"]["name"])){ 
			
			// $spreadsheet = new \Kendo\UI\Spreadsheet('spreadsheet');
			// echo "<pre>";
			// print_r($spreadsheet->get(excelImport));
			// die;
				// File path config 
				$fileName = basename($_FILES["file"]["name"]); 
				// $fileNameExp = explode('.', $fileName);
				// $fileNameWithoutext = $fileNameExp[0].'_org';
				// $fileNameArray = array($fileNameWithoutext, $fileNameExp[1]);

				// $fileOrgName = implode(".", $fileNameArray);

				$targetFilePath = $folderPath .'/'. $fileName; 
				$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
				$uploadedFile = '';
				if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
						$uploadedFile = $fileName; 
				}else{ 
						$uploadStatus = 0; 
						$response['message'] = 'Sorry, there was an error uploading your file.'; 
				} 
		
				if($uploadedFile != ''){ 
						$response['status'] = 'success'; 
						$response['message'] = 'File uploaded successfully!'; 
						$response['folder_name'] = $portfolioCompany;
						$response['file_name'] = $fileName;
				} else {
						$response['status'] = 'error'; 
						$response['message'] = 'File upload failed!'; 
				}
		
				echo json_encode($response);
				die;
			}
		}


		public function SaveUpdatedExcelSheetToFolder()
		{
			//$this->load->library('codeigniter-library-google-spreadsheet/Google_Spreadsheet');
			$base64 = $this->input->post('base64');
			$excelId = $this->input->post('excelId');
			
			$excel_dir_path = $_SERVER["DOCUMENT_ROOT"].'/ci/google-sheets/company_assets';
			$excelData = $this->Admin->getExcelData($excelId);
			
			
			$portfolioCompany = $excelData['porfolio_company_id'];
			if($portfolioCompany == 0 || $portfolioCompany == null || $portfolioCompany == "") {
				$portfolioCompany = db_randomnumber();
					$folderPath = $excel_dir_path."/".$portfolioCompany;
					create_local_folder($folderPath);
				}else{
					$folderPath = $excel_dir_path."/".$portfolioCompany;
					create_local_folder($folderPath);
				}
				
			$file = $excelData['excel_old_file_name'];
			$fileExplode = explode(".", $file);
			$fileName = $fileExplode[0];
			$newFileName = $fileName."_NEW";
			
			$newFile = array(
				$newFileName, $fileExplode[1]
			);
			$newFileImplode = implode(".", $newFile);

			$fileDecodeData = base64_decode($base64, true);

			$fpath = $folderPath."/".$newFileImplode;

			/*if (array_key_exists('drive_auth', $this->session->userdata)) {*/
				fileWrite($fpath,$fileDecodeData);

				$new_excel_file = $portfolioCompany.'/'.$newFileImplode;
				$file_content = file_get_contents($fpath);
				$targetFilePath = $folderPath .'/'. $newFileImplode; 

				$fileType = mime_content_type($targetFilePath); 

				/*
				$access_token = $this->session->userdata['drive_auth']['access_token'];

				if (isset($excelData['spreadsheet_id_from_google_sheet'])) {
					$drive_file_id = $this->google_spreadsheet->DeleteDriveFile($access_token, $excelData['spreadsheet_id_from_google_sheet']);
					$drive_file_id = $this->google_spreadsheet->UploadFileToDrive($access_token, $file_content, $fileType);
				}else {
					$drive_file_id = $this->google_spreadsheet->UploadFileToDrive($access_token, $file_content, $fileType);
				}
				if ($drive_file_id) {
					$file_meta = array( 
						'name' => basename($fileName), 
					);
					$filePermission = array(
						"role" =>"writer",
						"type" => "anyone",
						"withLink" => true
					);
					$drive_upload_meta = $this->google_spreadsheet->UpdateFileMeta($access_token, $drive_file_id, $file_meta); 
					$drive_file_permissions = $this->google_spreadsheet->UpdateFilePermissions($access_token, $drive_file_id, $filePermission); 
				}*/

				$drive_file_id = "";

				$saveData = array();
				$saveData['new_excel_file'] = $new_excel_file;
				$saveData['excel_new_file_name'] = $newFileImplode;
				$saveData['spreadsheet_id_from_google_sheet'] = $drive_file_id;

				$save = $this->Admin->UpdateExcelData($excelId,$saveData);

				$response['status'] = 'success'; 
				$response['message'] = 'File updated successfully!'; 
				$response['folder_name'] = $portfolioCompany;
				$response['file_name'] = $newFileImplode;

				echo json_encode($response);
				die;

			/*}else {
				$response['status'] = 'error'; 
				$response['message'] = 'Authenticate your App with Google Drive API!'; 

				echo json_encode($response);
				die;
			}*/
			
		}

		public function showexcelsheet($id)
		{
			if($id){

				$excelData = $this->Admin->getExcelData($id);
				$data['excelData'] = $excelData;
				//echo "<pre>"; print_r($data); die;
				$this->load->view("admin/showexcelsheet", $data);

			}else{
				redirect('companies/index/');
			}

		}

		function zipzum(){
			
			//$companyId = 123;
			$userId = $this->LOGINUSERID;

			//$reports = $this->Admin->zipzumReportsByCompany($companyId);

			$userId = $this->LOGINUSERID;

			$companies = $this->Admin->getCompaniesDropdownList($userId);
			$reports = $this->Admin->zipzumReportsByUser($userId);
			$excelReports = $this->Admin->getReportsList($userId);
			$data = array();
			$data["pageTitle"] = "File upload";
			$data["reports"] = $reports;
			$data["companies"] = $companies;
			$data["getExcelReports"] = $excelReports;
			//id companyId
      //echo "<pre>"; print_r($reports); die;

			$this->load->view("admin/zipzumReport", $data);
		}

		function zipzumReportDetail(){
			
			$reportId = $this->input->post("reportId");
			$result = $this->Admin->zipzumReportDetail($reportId);
		

			// echo "result:<pre>"; print_r($result); die;

			if(!empty($result)){


				$homePath = FCPATH;		
        
        $fileId = $reportId;
        $dirPath = $homePath . "zipzum_reports/";
        
				$fileName = $fileId.".txt";
				$filePath = $dirPath . $fileName;
				$pageHtmlJson = fileRead($filePath);
        $pageHtml = json_decode($pageHtmlJson, true);
        
				$result["pageHtml"] = $pageHtml;
				

				$response = array(
					"C" => 100,
					"R" => $result,
					"M" => "success"
				);

			}else{
				
				$response = array(
					"C" => 101,
					"R" => array(),
					"M" => "error"
				);
			
			}

			echo json_encode($response); die;
			
		}
		
		function saveZipzumReport(){
			
			//save teaser report to db
			$pageTitle = $this->input->post("pageTitle");
			$pageHtml = $this->input->post("pageHtml");
			$pageId = $this->input->post("pageId");
			$columnType = $this->input->post("columnType");

			if($pageId > 0){
				//update
				$id = $pageId;

				$saveData = array();
				//$saveData["companyId"] = 123;
				$saveData["pageTitle"] = $pageTitle;
				//$saveData["pageHtml"] =  json_encode($pageHtml);
				//$saveData["pageHtml"] =  $pageHtml;
	 
				$saveId = $this->Admin->updateZipzumReport($saveData, $id);

				//write html file
				$homePath = FCPATH;	
				$fileId = $id;
				$dirPath = $homePath . "zipzum_reports/";
				
				$fileName = $fileId.".txt";
				$fileData = json_encode($pageHtml);
				$file = $dirPath . $fileName;
				fileWrite($file, $fileData);

			}else{
				//insert
			
				$id = db_randomnumber();
				$userId = $this->LOGINUSERID;
				
				$saveData = array();
				
				$saveData["id"] = $id;
				//$saveData["companyId"] = 123;
				$saveData["user_id"] = $userId;
				$saveData["pageTitle"] = $pageTitle;
				//$saveData["pageHtml"] =  json_encode($pageHtml);
				//$saveData["pageHtml"] =  $pageHtml;
				$saveData["columnType"] =  $columnType;
	 
				$saveId = $this->Admin->saveZipzumReport($saveData);

				//write html file

				$homePath = FCPATH;		
				$fileId = $id;
				$dirPath = $homePath . "zipzum_reports/";
        
				$fileName = $fileId.".txt";
				$fileData = json_encode($pageHtml);
				$file = $dirPath . $fileName;
				fileWrite($file, $fileData);

			}
			
			if($saveId > 0){
				$result = array(
					"C" => 100,
					"R" => array("id" => $saveId),
					"M" => "success"
				);
			}else{
				$result = array(
					"C" => 101,
					"R" => array(),
					"M" => "error"
				);
			}

			echo json_encode($result); die;

		}	

		public function TeaserReport(){

			$userId = $this->LOGINUSERID;

			$companies = $this->Admin->getCompaniesDropdownList($userId);
			$reports = $this->Admin->getTeaserReports($userId);
			$excelReports = $this->Admin->getReportsList($userId);
			$data = array();
			$data["companies"] = $companies;
			$data["reports"] = $reports;
			$data["getExcelReports"] = $excelReports;
			
			// echo "<pre>"; print_r($data); die;

			$this->load->view("admin/TeaserReport", $data);

		}

		function saveTeaserReport(){
		
			$userId = $this->LOGINUSERID;

			//save teaser report to db
			$pageTitle = $this->input->post("pageTitle");
			$portfolioCompany = $this->input->post("portfolioCompany");
			$pageHtml = $this->input->post("pageHtml");
			$teaserId = $this->input->post("teaserId");
			$attachments = $this->input->post("attachments");
			$folderId = $this->input->post("folderId");
			$PrevATTCHFILES = $this->input->post("PrevATTCHFILES");
			$filesArr = array();


			//echo "Post:<pre>"; print_r($this->input->post()); die;

			if(!empty($attachments)){
				
				if($folderId == 0 || $folderId == null || $folderId == false){
					$folderId = db_randomnumber();
				}
				
				foreach($attachments as $attachment){

					$fileBs64Data = $attachment["fileBs64Data"];
					$fileName = $attachment["fileName"];
					$fileSize = $attachment["fileSize"];
					$fileType = $attachment["fileType"];
				
					$fileBs64DataArr = explode("base64,", $fileBs64Data);
					$fileBs64Cont = $fileBs64DataArr[1];
					$fileBs64DecodeData = base64_decode($fileBs64Cont);
					
					$homePath = FCPATH;		
	        
	        $fileId = db_randomnumber();
	        $dirPath = $homePath . "user_assets/" . $folderId . "/";
	        create_local_folder($dirPath);

	        $fileName = $fileId."_".$fileName;
	        $fileData = $fileBs64DecodeData;
	        $file = $dirPath . $fileName;
	        fileWrite($file, $fileData);

	        $filesArr[] = $folderId."_".$fileName;
				}

			}

			//echo "filesArr:<pre>"; print_r($filesArr); die;

			if ($teaserId > 0) {

				if(!empty($PrevATTCHFILES) && COUNT($PrevATTCHFILES) > 0){
					
					foreach($PrevATTCHFILES as $tmpPrevAttchFl){
						$filesArr[] = $tmpPrevAttchFl;
					}

				}
				
				$saveData = array();
			
				$saveData["id"] = $teaserId;
				$saveData["companyId"] = $portfolioCompany;
				$saveData["teaserTitle"] = $pageTitle;
				$saveData["teaserHtml"] = serialize($pageHtml);
				$saveData["files"] = json_encode($filesArr);
		
				$save = $this->Admin->updateTeaserReport($saveData, $teaserId);
				
			}else {
				
				$id = db_randomnumber();
		
				$saveData = array();
				
				$saveData["id"] = $id;
				$saveData["user_id"] = $userId;
				$saveData["companyId"] = $portfolioCompany;
				$saveData["teaserTitle"] = $pageTitle;
				$saveData["teaserHtml"] = serialize($pageHtml);
				$saveData["files"] = json_encode($filesArr);

				$save = $this->Admin->saveTeaserReport($saveData);
			}
			
			//echo "saveData:<pre>"; print_r($saveData); die;

			if($save > 0){
				$result = array(
					"C" => 100,
					"R" => array("id" => $save),
					"M" => "success"
				);
			}else{
				$result = array(
					"C" => 101,
					"R" => array(),
					"M" => "error"
				);
			}

			echo json_encode($result);
			die;
	
		}

		function teaserReportDetail(){
			
			$reportId = $this->input->post("reportId");
			$result = $this->Admin->teaserReportDetail($reportId);

			//echo "result:<pre>"; print_r($result); die;

			if(!empty($result)){
				
				$result["pageHtml"] =  unserialize($result["teaserHtml"]);
				
				if($result["files"] != null && $result["files"] != ""){
					$result["files"] = json_decode($result["files"], true);
				}else{
					$result["files"] = array();
				}

				$response = array(
					"C" => 100,
					"R" => $result,
					"M" => "success"
				);

			}else{
				
				$response = array(
					"C" => 101,
					"R" => array(),
					"M" => "error"
				);
			
			}

			//echo "result:<pre>"; print_r($result); die;

			echo json_encode($response); die;
		
		}

		function downloadImageByUrl(){
			
			$imgUrl = $this->input->post("imgUrl");
			$decodedUrl = urldecode($imgUrl);
			

			$imgUrlParts = explode("/", $decodedUrl);
			$lastElement = end($imgUrlParts);


			if(strpos($lastElement,"?")){
				$lastElementParts = explode("?", $lastElement);
				$fileName = $lastElementParts[0]; //file name
			}else{
				$fileName = $lastElement;
			}


			$localFilePath  = FCPATH . 'tmp_assets/';
			
			$targetfile = $localFilePath."test.jpg";
			exec('curl -o "'.$targetfile.'" "'.$decodedUrl.'"', $output);
			
			//echo "output:<pre>"; print_r($output); echo "</pre>";

			$content = file_get_contents($targetfile);

			if($content != ""){
				$base64Encode = base64_encode($content);
				$base64Data = "data:image/jpeg;base64,".$base64Encode;
				
				$result = array("C" => 100, "R" => array("base64Data" => $base64Data, "fileName" => $fileName), "M" => "success");

			}else{
				
				$result = array("C" => 101, "R" => array(), "M" => "error");
			}
			
			exec('rm -f "'.$targetfile.'"', $output2);

			echo json_encode($result); die;

		}

		function publishCharts(){

			$excelId = $this->input->post("sheetDbId");
			$companyId = $this->input->post("sheetCompanyID");
			$chartId = $this->input->post("chartId");
			$chartType = $this->input->post("chartType");
			$configData = $this->input->post("config");
			$chartSequence = $this->input->post("chartSequence");

			$postData = array();
			$postData["id"] = db_randomnumber();
			$postData["userId"] = "";	
			$postData["companyId"] = $companyId;
			$postData["excelSheetId"] = $excelId;
			$postData["chartId"] = $chartId;
			$postData["chartType"] = $chartType;
			$postData["configData"] = json_encode($configData);
			$postData["chartSequence"] = $chartSequence;
			$postData["createDate"] = date("Y-m-d");

			$rowId = $this->Admin->saveChartData($postData);


			if($rowId > 0){
				$result = array("C" => 100, "R" => array("rowId" => $rowId), "M" => "success");
			}else{
				$result = array("C" => 101, "R" => array("rowId" => 0), "M" => "error");
			}

			echo json_encode($result); die;

		}

		function charts($sheetId){
			//echo "sheetId:" . $sheetId; die;
			
			if($sheetId){
			
				$sheetData = $this->Admin->getExcelData($sheetId);
				$chartsdata = $this->Admin->getChartReports($sheetId);
				
				if(empty($chartsdata)){
					$chartsdata = array();
				}


				$data = array();
				$data["sheetName"] = $sheetData["excel_old_file_name"];
				$data["chartsdata"] = $chartsdata;
				
				$this->load->view("admin/charts", $data);
			}else{
				echo "Access denied"; die;
			}
		}

		function saveChartsOrder(){

			$CHARTS_DATA = $this->input->post("CHARTS_DATA");
			$ChartTitle = $this->input->post("ChartTitle");

			//echo "CHARTS_DATA:<pre>"; print_r($CHARTS_DATA); die;

			if(!empty($CHARTS_DATA)){

				$updateArray = array();
				
				foreach($CHARTS_DATA as $CHART_DATA){

					$id = $CHART_DATA["id"];
					$chartId = $CHART_DATA["chartId"];
					$chartSequence = $CHART_DATA["chartSequence"];


					$updateArray[] = array(
						"id" => $id,
						"chartSequence" => $chartSequence,
						"chartTitle" => $ChartTitle
					);

				}

				$updated = $this->Admin->updateChartsOrder($updateArray, "id");

				if($updated > 0){
						$result = array("C" => 100, "R" => $updateArray, "M" => "success");
				}else{
						$result = array("C" => 101, "R" => array(), "M" => "error");
				}

			}else{
				$result = array("C" => 102, "R" => array(), "M" => "error");
			}

			echo json_encode($result); die;

		}

	 }

?>
