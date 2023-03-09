<?php

class Companies extends CI_Controller {
    
    function __construct(){

        parent::__construct();

        $this->load->config("google_config");
        $this->load->model("Admin");
        /*
        echo "baseurl:" . base_url();
        echo "<br>";
        echo "siteurl:" . site_url();
        echo "<br>";
        echo "custom_siteurl:" . custom_siteurl();
        */
    }


    function teaser(){
    	
    	$data = array();
      $data["pageTitle"] = "Teaser";
      
      $this->load->view("admin/teasers", $data);
    }
 
  }

?>
