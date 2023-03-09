<?php include("header.php");?>
<?php 
	/*if (!array_key_exists('drive_auth', $this->session->userdata)) {
		$this->session->set_flashdata('error', 'Please Authenticate your APP first.');
		redirect(custom_siteurl()); 
	} */
?>
<style>
@import url("https://fonts.googleapis.com/css?family=Spartan&display=swap");
* {
margin: 0;
padding: 0;
}

body {
background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-2044837-jpeg.jpg") center center no-repeat;
background-size: cover;
width: 100vw;
height: 100vh;
/* display: grid; */
align-items: center;
justify-items: center;
font-size: 12pt;
font-family: "Spartan";
color: #2A293E;
}

.contact-us {
background: #f8f4e5;
padding: 50px 100px;
border-top: 10px solid #f45702;
}

label, input, textarea, select {
display: block;
width: 100%;
font-size: 12pt;
line-height: 24pt;
font-family: "Spartan";
}

.inputFields{
margin-bottom: 24pt;
}

h3 {
font-weight: normal;
font-size: 10pt;
line-height: 24pt;
font-style: italic;
margin: 0 0 0.5em 0;
}

span {
font-size: 8pt;
}

em {
color: #f45702;
font-weight: bold;
}

.inputFields{
border: none;
border: 1px solid rgba(0, 0, 0, 0.1);
border-radius: 2px;
background: #f8f4e5;
padding-left: 5px;
outline: none;
}

input:focus, textarea:focus {
border: 1px solid #6bd4b1;
}

textarea {
resize: none;
}

button {
display: block;
float: right;
line-height: 24pt;
padding: 0 20px;
border: none;
background: #f45702;
color: white;
letter-spacing: 2px;
transition: 0.2s all ease-in-out;
border-bottom: 2px solid transparent;
outline: none;
}
button:hover {
background: inherit;
color: #f45702;
border-bottom: 2px solid #f45702;
}

::selection {
background: #ffc7b8;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus {
border: 1px solid #6bd4b1;
-webkit-text-fill-color: #2A293E;
-webkit-box-shadow: 0 0 0px 1000px #f8f4e5 inset;
transition: background-color 5000s ease-in-out 0s;
}
</style>

<div class="pagecontent contact-us">

  <form id="companyForm">

      <span>
        <label>Company Name<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Company Name" id="companyName" name="companyName" required/>
      </span>

      <span>
        <label>Company Group<em>&#x2a;</em></label>
        <select class="inputFields" id="companyGroup" name="companyGroup">
            <option value="">Select Company</option>
            <option value="textiles">Textiles</option>
            <option value="electronics">Electronics</option>
            <option value="computer software">Computer Software</option>
        </select>
      </span>

      <span>

        <label>Country<em>&#x2a;</em></label>
        <select class="inputFields" id="country" name="country" onchange="getCountryZones();">
          <option value="">Select country</option>
          <?php
          foreach ($countries as $ctryKey => $ctryVal) {
            echo '<option value="'.$ctryVal["id"].'">'.$ctryVal["name"].'</option>';
          }
          ?>
        </select>
      </span>

      <span>
        <label>Province<em>&#x2a;</em></label>
        <select class="inputFields" id="province" name="province">
          <option value="">Select province</option>
        </select>
      </span>


      <span>
        <label>City<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="City" id="city" name="city"/>
      </span>

      <span>
        <label>Address Line 1<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Address Line 1" id="companyAddress1" name="companyAddress1"/>
      </span>

      <span>
        <label>Address Line 2<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Address Line 2" id="companyAddress2" name="companyAddress2"/>
      </span>

      <span>
        <label>Phone 1<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Phone 1" id="phone1" name="phone1"/>
      </span>

      <span>
        <label>Phone 2<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Phone 2" id="phone2" name="phone2"/>
      </span>

      <span>
        <label>Primary Email<em>&#x2a;</em></label>
        <input class="inputFields" type="text" placeholder="Primary Email" id="primaryEmail" name="primaryEmail"/>
      </span>

      <span>
        <label>Secondary Email</label>
        <input class="inputFields" type="text" placeholder="Secondary Email" id="secondaryEmail" name="secondaryEmail"/>
      </span>

      <span>
          <label>Industry</label>
          <input class="inputFields" type="text" placeholder="Industry" id="industry" name="industry"/>
      </span>

      <span>
          <label>Technology</label>
          <input class="inputFields" type="text" placeholder="Technology" id="technology" name="technology"/>
      </span>

      <span>
          <label>Revenue Model</label>
          <input class="inputFields" type="text" placeholder="Revenue Model" id="revenueModel" name="revenueModel"/>
      </span>

      <span>
        <button onclick="saveCompany();">Save</button>
      </span>

  </form>

</div>
<?php include("scripts.php");?>
<script>

  $(function(){

    initTagit();

  });


  function initTagit(){

  	 var sampleTags = [];

      $("#industry").tagit({
          availableTags: sampleTags
      });

  	  $("#technology").tagit({
          availableTags: sampleTags
      });

      $("#revenueModel").tagit({
          availableTags: sampleTags
      });

  }

  function saveCompany(){

    var companyName = $("#companyName").val();
    var companyGroup = $("#companyGroup").val();
    var country = $("#country").val();
    var province = $("#province").val();
    var city = $("#city").val();
    var companyAddress1 = $("#companyAddress1").val();
    var companyAddress2 = $("#companyAddress2").val();
    var phone1 = $("#phone1").val();
    var phone2 = $("#phone2").val();
    var primaryEmail = $("#primaryEmail").val();
    var secondaryEmail = $("#secondaryEmail").val();
    var industry = $("#industry").val();
    var technology = $("#technology").val();
    var revenueModel = $("#revenueModel").val();

    if(companyName == ""){
      var msg = "Please enter the company name";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(companyGroup == ""){
      var msg = "Please select the company group";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(country == ""){
      var msg = "Please select the country";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(province == ""){
      var msg = "Please select the state/province";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(city == ""){
      var msg = "Please enter the city";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(companyAddress1 == ""){
      var msg = "Please enter address line 1";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(companyAddress2 == ""){
      var msg = "Please enter address line 2";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(phone1 == ""){
      var msg = "Please enter phone 1";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(primaryEmail == ""){
      var msg = "Please enter primary email address";
      var error = 1;
      showError(msg, error);
      return false;
    }else{
      //post data to server

      var data = {
        "companyName":companyName,
        "companyGroup":companyGroup,
        "country":country,
        "province":province,
        "city":city,
        "companyAddress1":companyAddress1,
        "companyAddress2":companyAddress2,
        "companyName":companyName,
        "companyGroup":companyGroup,
        "country":country,
        "province":province,
        "city":city,
        "phone1":phone1,
        "phone2":phone2,
        "primaryEmail":primaryEmail,
        "secondaryEmail":secondaryEmail,
        "industry":industry,
        "technology":technology,
        "revenueModel":revenueModel
      };

      var path = "companies/savecompany";

			$.ajax({
            type: "POST",
            url: "<?php echo custom_siteurl(); ?>" + path,
            data: data,
            success: function(response)
            {
                var jsonData = JSON.parse(response);

                if (jsonData.C == "100")
                {
									var redirect = "<?php echo custom_siteurl(); ?>" + jsonData.redirect;
									
                    location.href = redirect;
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
			/*
				callAjax(data, path, function(response){
					var jsonData = JSON.parse(response);
					debugger
					var code = jsonData.C;
					var resp = jsonData.R;
					var redirect = "<?php echo custom_siteurl(); ?>" + resp.companies;
					// debugger
					if(code == 100){
						window.location = redirect;
					}else{
						alert("else");
					}

				});
			*/
    }

  }

  function getCountryZones(){

    var countryId = $("#country").val();
    if(countryId != "" && countryId != null){

      var path = "companies/getCountryZones";
      var data = {"countryId":countryId};



      callAjax(data, path, function(response){

        var code = response.C;
        var resp = response.R;

        var provinceHtml = '<option value="">Select province</option>';

        if(code == 100){
          $.each(resp, function(idx, vl){

              var provId = vl.id;
              var provName = vl.name;
              provinceHtml += '<option value="'+provId+'">'+provName+'</option>';

          });


          setTimeout(function(){
            $("#province").html(provinceHtml);
          }, 300);

        }else{
          $("#province").html(provinceHtml);
        }

      });

    }

  }

</script>
<?php include("footer.php"); ?>
