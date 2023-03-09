<?php
include("header.php");
include("scripts.php");

 ?>

<style>
@import url("https://fonts.googleapis.com/css?family=Spartan&display=swap");

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
  line-height: 24pt;
  padding: 0 20px;
  border: none;
  color: white;
  letter-spacing: 2px;
  transition: 0.2s all ease-in-out;
  border-bottom: 2px solid transparent;
  outline: none;
}

select {
  background-color: #fff;
}


.container .pagecontent form{
  padding-left: 130px;
  padding-right: 130px;
  padding-bottom: 20px;
  border-radius: 3px;
  box-shadow: 0px 1px 4px 2px #a5a5a5;
}

 .formTitle{
    text-align: center;
    padding-top: 20px;
    color: #000;
    font-weight: 500;
    border-bottom: 1px solid#a5a5a5;
    margin-bottom: 20px;
    font-size: 22px;
}

.formTitle h2{
  font-size: 22px;
}

form .row .form-label, form .row .form-control, form .row .form-select{
  font-size: 13px;
}

.actionBox .btn{
  width: 100px;
  margin-left: auto;
}

</style>


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

      var loaderElmId = "saveCmpnyBttn";
      var preLoaderContent = $("#saveCmpnyBttn").html();
      showLoader(loaderElmId);

      setTimeout(function(){

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
        callAjax(data, path, function(response){

          var code = response.C;
          var resp = response.R;

          if(code == 100){
              var msg = "Settings saved successfully.";
              var error = 0;
              showError(msg, error);
          }else{
              var msg = "Please try again";
              var error = 1;
              showError(msg, error);
          }

          hideLoader(loaderElmId, preLoaderContent);

        });

      }, 1000);

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
<div class="container">
  <div class="pagecontent contact-us m-5">

  <form id="companyForm" action="javascript:void(0);">
    <div class="row formTitle">
      <h2>Add Company</h2>
    </div>
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="staticEmail" class="form-label">Company Name<em>&#x2a;</em></label>
          <div>
            <input class="form-control" type="text" placeholder="Company Name" id="companyName" name="companyName"/>
          </div>
        </div>
        <div class="mb-3">
          <label for="staticEmail" class="form-label">Country<em>&#x2a;</em></label>
          <div>
            <select class="form-select" aria-label="Default select example" id="country" name="country" onchange="getCountryZones();">
              <option value="">Select country</option>
              <?php
              foreach ($countries as $ctryKey => $ctryVal) {
                  echo '<option value="'.$ctryVal["id"].'">'.$ctryVal["name"].'</option>';
              }
              ?>
            </select>
          </div>
        </div>

         <div class="mb-3">
          <label for="staticEmail" class="form-label">Province<em>&#x2a;</em></label>
          <div>
            <select class="form-select" aria-label="Default select example" id="province" name="province">
              <option value="">Select province</option>
            </select>
          </div>
        </div> 
      
        <div class="mb-3">
        <label for="staticEmail" class="form-label">Address Line 1<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="Address Line 1" id="companyAddress1" name="companyAddress1"/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Phone 1<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="Phone 1" id="phone1" name="phone1" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Primary Email<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="Primary Email" id="primaryEmail" name="primaryEmail" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Industry</label>
        <div>
          <input class="form-control" type="text" placeholder="Industry" id="industry" name="industry" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Revenue Model</label>
        <div>
          <input class="form-control" type="text" placeholder="Revenue Model" id="revenueModel" name="revenueModel" value=""/>
        </div>
      </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
        <label for="staticEmail" class="form-label">Company Group<em>&#x2a;</em></label>
        <div>
          <select class="form-select" aria-label="Default select example" id="companyGroup" name="companyGroup">
              <option value="">Select Company</option>
              <?php foreach ($companyGroups as $tmpGrpKey => $tmpGrpNm) {
               echo '<option value="'.$tmpGrpNm.'">'.ucfirst($tmpGrpNm).'</option>';
              }?>
          </select>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">City<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="City" id="city" name="city" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Address Line 2<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="Address Line 2" id="companyAddress2" name="companyAddress2"/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Phone 2<em>&#x2a;</em></label>
        <div>
          <input class="form-control" type="text" placeholder="Phone 2" id="phone2" name="phone2" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Secondary Email</label>
        <div>
          <input class="form-control" type="text" placeholder="Secondary Email" id="secondaryEmail" name="secondaryEmail" value=""/>
        </div>
      </div>
      <div class="mb-3">
        <label for="staticEmail" class="form-label">Technology</label>
        <div>
          <input class="form-control" type="text" placeholder="Technology" id="technology" name="technology" value=""/>
        </div>
      </div>
    </div>
      </div>
      <div class="row actionBox">
        <button id="saveCmpnyBttn" class="btn btn-primary " onclick="saveCompany();">Save</button>
    </div>
  </form>
</div>
</div>
<?php include("footer.php"); ?>
