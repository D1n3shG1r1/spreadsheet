<?php
class Admin extends CI_Model{

  function savebatchcountries($data){
    $this->db->insert_batch('countries', $data);
  }

  function getCountries(){
    $countries = $this->db->get("countries")->result_array();
    return $countries;
  }

  function getCountryZones($cntryId){

    $this->db->where("countryId", $cntryId);
    $states = $this->db->get("states")->result_array();
    return $states;

  }

  function savebatchstates($data){
    $this->db->insert_batch("states", $data);
  }

  function saveCompany($data,$newrecord){

    if($newrecord > 0){
      //insert new entry
      $this->db->insert("superset_portfolio_companies", $data);
    }else{
      //update row
      $id = $data["id"];
      $userId = $data["userId"]; 
      unset($data["id"]);
      unset($data["userId"]);
      $this->db->where("id", $id);
      $this->db->where("userId", $userId);
      $this->db->update("superset_portfolio_companies", $data);
    }

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }
  }

  function getCompaniesDropdownList($userId){
    $this->db->select("id, companyName");
    $this->db->where("userId", $userId);
    $companies = $this->db->get("superset_portfolio_companies")->result();
    return $companies;
  }

  function getCompaniesList($p,$userId){
    $limit = 10;
    $offset = 0;
    // $this->db->limit($limit, $offset);
    $this->db->where("userId", $userId);
    $companies = $this->db->get("superset_portfolio_companies")->result_array();
    return $companies;
  }

  function getCompanById($id){
    $this->db->where("id", $id);
    $companyData = $this->db->get("superset_portfolio_companies")->row_array();
    return $companyData;
  }

  function removeCompany($companyId){

    $this->db->where('id', $companyId);
    $this->db->delete('superset_portfolio_companies');
    return 1;
  }

	/*Excel Report Functions*/
	function getReportsList($userId){

		$this->db->where("userId", $userId);
    $reports = $this->db->get("superset_companies_excel_sheet")->result_array();

		foreach($reports as $key => $report){
			$this->db->where("id", $report['porfolio_company_id']);
			$companyData = $this->db->get("superset_portfolio_companies")->row_array();

			$reports[$key]['companyName'] = $companyData['companyName'];
			
		}
    return $reports;
	}

	function removeReport($reportId){

    // remove report from excel table
    $this->db->where('id', $reportId);
    $this->db->delete('superset_companies_excel_sheet');

    // remove report charts from chart reports
    $this->db->where('excelSheetId', $reportId);
    $this->db->delete('company_chart_reports');


    return 1;
  }

	function InsertExcelData($data){

		$this->db->insert("superset_companies_excel_sheet", $data);

    if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }
	}


	function UpdateExcelData($id, $data)
	{
		$this->db->where("id", $id);
    $this->db->update("superset_companies_excel_sheet", $data);

		if($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 0;
    }
	}

	function getExcelData($id)
	{
		$this->db->where("id", $id);
    $excelData = $this->db->get("superset_companies_excel_sheet")->row_array();
    return $excelData;
	}


  function saveZipzumReport($data){
    
    $this->db->insert("company_pages", $data);
    // die;
    if($this->db->affected_rows() > 0){
      return $data["id"];
    }else{
      return 0;
    }

  }

  function updateZipzumReport($data, $id){
    $this->db->where("id", $id);
    $this->db->update("company_pages", $data);
    return $id;
  }


  function zipzumReportsByCompany($companyId){
    //$this->db->where("companyId", $companyId);
    $this->db->select("id, companyId, pageTitle");
    $result = $this->db->get("company_pages")->result_array();
  
    return $result;
  }

  function zipzumReportsByUser($userId){
    $this->db->where("user_id", $userId);
    $this->db->select("id, companyId, pageTitle");
    $result = $this->db->get("company_pages")->result_array();
  
    return $result;
  }

  
  function zipzumReportDetail($reportId){
    
    $this->db->where("id", $reportId);
    $result = $this->db->get("company_pages")->row_array();
  
    return $result;
  }


	function saveTeaserReport($data){
    
    $this->db->insert("company_teaser_reports", $data);
    // die;
    if($this->db->affected_rows() > 0){
      return $data["id"];
    }else{
      return 0;
    }

  }

	public function updateTeaserReport($data, $id)
	{
		$this->db->where("id", $id);
    $this->db->update("company_teaser_reports", $data);
    return $id;
	}

	public function getTeaserReports($userId)
	{
		$this->db->select("*");
    $this->db->where("user_id",$userId);
    $result = $this->db->get("company_teaser_reports")->result_array();
  
    return $result;
	}

	function teaserReportDetail($reportId){
    
    $this->db->where("id", $reportId);
    $result = $this->db->get("company_teaser_reports")->row_array();
  
    return $result;
  }


  function saveChartData($data){

    //-- insert chart data configured by user
    $this->db->insert("company_chart_reports",$data);

    if($this->db->affected_rows() > 0){
      return $data["id"];
    }else{
      return 0;
    }

  }

  function getChartReports($sheetId){

    $this->db->where("excelSheetId", $sheetId);
    $result = $this->db->get("company_chart_reports")->result_array();    

    return $result;
  }

  function updateChartsOrder($updateArray, $keyColumn){
    
    $this->db->update_batch('company_chart_reports',$updateArray, $keyColumn);

    return 1;
  }

  function login($data){
  
    $email = $data["email"];
    $password = $data["password"];
    $password = sha1($password);

    $this->db->select("id, password");
    $this->db->where("email", $email);
    $response = $this->db->get("report_tool_user_table")->row();
    
    if(!empty($response)){
      
      if($password == $response->password){
      
        $this->session->set_userdata("loginId", $response->id);
        return $response->id;
      
      }else{
        return 0;
      
      }

    }else{
      
      return 0;
    }

  }

  function checkEmailExist($email){

    $this->db->select("id");
    $this->db->where("email", $email);
    $response = $this->db->get("report_tool_user_table")->result();

    if(!empty($response)){
      return 1;
    }else{
      return 0;
    }
  }

  function register($data){
  
   $this->db->insert("report_tool_user_table", $data);

    if($this->db->affected_rows() > 0){
      //auto login
      $this->session->set_userdata("loginId", $data["id"]);
      return $data["id"];
    }else{
      return 0;
    }
  }

}
?>
