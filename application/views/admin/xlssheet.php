<?php include("header.php");?>

<div class="container mt-4">
	<form method = "POST" action="" enctype="multipart/form-data" id="upload_excel">
		<div class="mb-3 row">
			<label for="portfolioCompany" class="col-4 col-form-label">Portfolio Company:</label>
			<div class="col-8">
			<select id="portfolioCompany" name="portfolioCompany" class="form-control" required>
				<option value="" disabled selected>Select Company</option>
				<?php
					foreach ($companies as $key => $companyData) {

							$tmpCmpId = $companyData->id;
							$tmpCmpnyNm = $companyData->companyName;

							echo '<option value="'.$tmpCmpId.'">'.ucfirst($tmpCmpnyNm).'</option>';
					}
				?>
			</select>
			</div>
		</div>
		<div class="mb-3 row">
			<label for="portfolioCompany" class="col-4 col-form-label">Group:</label>
			<div class="col-8">
			<select id="portfolioCompanyGroup" name="portfolioCompanyGroup" class="form-control" required>
				<option value="" disabled selected>Select Company Group</option>
				<?php
					foreach ($companyGroups as $companyGroup) {

						echo '<option value="'.strtolower($companyGroup).'">'.ucfirst($companyGroup).'</option>';
				}
				?>
			</select>
			</div>
		</div>
		<div class="mb-3 row">
			<label for="inputName" class="col-4 col-form-label">Report Date:</label>
			<div class="col-8">
				<input type="text" id="reportdate" name='reportdate' class="form-control" placeholder="yyyy/mm/dd" value="" required/>
			</div>
		</div>
		<div class="mb-3 row">
			<label for="inputName" class="col-4 col-form-label">Upload File:</label>
			<div class="col-8">
				<input id="upload" class="form-control" type="file" name="files" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="offset-sm-4 col-sm-8">
				<button id="saveButton" class="btn btn-primary">Save</button>
			</div>
		</div>
	</form>
</div>

<?php
include_once('scripts.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>

<script src="https://bossanova.uk/jspreadsheet/v4/jexcel.js"></script>
<link rel="stylesheet" href="https://bossanova.uk/jspreadsheet/v4/jexcel.css" type="text/css" />

<script src="https://jsuites.net/v4/jsuites.js"></script>
<link rel="stylesheet" href="https://jsuites.net/v4/jsuites.css" type="text/css" />

<script>
	var TMP_SHEETS_DATA = {};
	var TMP_WORKBOOK = "";
	var TMP_ATTCHARR = '';
	var count = 0;
	var invalid_file = 0;

var ExcelToJSON = function() {

  this.parseExcel = function(file) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var data = e.target.result;
      var workbook = XLSX.read(data, {
        type: 'binary'
      });

      TMP_WORKBOOK = workbook;
      console.log("workbook:");
      console.log(workbook);

			var tmpSheetNames = workbook.SheetNames;
			var tmpSheets = workbook.Sheets;
			
			console.log("tmpSheetNames");
			console.log(tmpSheetNames);
			console.log("tmpSheets");
			console.log(tmpSheets);
			TMP_SHEETS_DATA = {"sheet_name":tmpSheetNames, "sheets":tmpSheets};

			for(let key in TMP_SHEETS_DATA) {
				++count;
			}
			/*

			// debugger

      //workbook.SheetNames.forEach(function(sheetName) {
        var sheetName = "Dinesh";
        // Here is your object
        var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
        var json_object = JSON.stringify(XL_row_object);
        console.log("sheetName:"+sheetName);
        console.log(JSON.parse(json_object));
        jQuery('#xlx_json').val(json_object);
        editor(JSON.parse(json_object));
      //})
			*/
    };

    reader.onerror = function(ex) {
      console.log(ex);
    };

    reader.readAsBinaryString(file);
  };
};

function checkfile(sender) {
    var validExts = new Array(".xlsx");
    var fileExt = sender.target.files[0]['name'];
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
			invalid_file = 1;
			console.log(invalid_file);
      return false;
    }
    else return true;
}

function upload(event){
	//TMP_ATTCHARR
	var files = event.target.files;
	console.log('files');
	console.log(files);

	var file = files[0];
	var fileName = file.name;
	var fileSize = file.size;
	var fileType = file.type;
	setTimeout(function(){

		var reader = new FileReader(); // Creating reader instance from FileReader() API

		reader.onload = function (event) {
			 //demoImage.src = reader.result;
			 var fileBs64Data = reader.result;
			 var percent = (event.loaded / event.total) * 100;

			 TMP_ATTCHARR = {"fileName":fileName, "fileSize":fileSize, "fileType":fileType, "fileBs64Data":fileBs64Data};
			
			 console.log('TMP_ATTCHARR');
			 console.log(TMP_ATTCHARR);


		}


		reader.readAsDataURL(file);

	},1000);
}

$(function(){
  // document.getElementById('upload').addEventListener('change', handleFileSelect, false);
  document.getElementById('upload').addEventListener('change', checkfile, false);
  document.getElementById('upload').addEventListener('change', upload, false);
  $("#reportdate").datepicker();

});


function handleFileSelect(evt) {

  var files = evt.target.files; // FileList object
  var xl2json = new ExcelToJSON();
  xl2json.parseExcel(files[0]);
}


function editor(jsonDta){

    console.log("jsonDta");
    console.log(jsonDta);

    var data = jsonDta;

    if(data != null){

        var coulmnsArr = [];
        $.each(data, function(idx, vl){

          console.log("idx");
          console.log(idx);
          console.log("vl");
          console.log(vl);

            if(idx == 0){
              $.each(vl, function(k,v){

                var valtyp = typeof v;
                var tmpColObj = {'type': valtyp, 'title':k, 'width':90};

                if(valtyp.toLowerCase() == 'numeric'){
                  tmpColObj['mask'] = '$ #.##,00';
                  tmpColObj['decimal'] = ',';
                }else if(valtyp.toLowerCase() == 'dropdown'){
                  tmpColObj['source'] = [];
                }

                coulmnsArr.push(tmpColObj);

              });
            }

        });

        console.log("coulmnsArr:");
        console.log(coulmnsArr);

        jspreadsheet(document.getElementById('spreadsheet'), {
            data:data,
            columns: coulmnsArr
        });

    }else{

        var msg = "It seems you uploaded an empty sheet";
        var error = 1;
        showError(msg, error);
    }

}


// loop through each key/value



var FinalSaveDataArr = [];

$('#upload_excel').submit(function(e) {
		e.preventDefault();
		var _this = $(this);
		var file_data = $("#upload").prop('files')[0]; 

    var portfolioCompany = $("#portfolioCompany").val();
    var portfolioCompanyGroup = $("#portfolioCompanyGroup").val();
    var reportdate = $("#reportdate").val();
		var excel_file = TMP_ATTCHARR;

    //---- save to db
    if(portfolioCompany == ""){
      var msg = "Please select the portfolio company";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(portfolioCompanyGroup == ""){
      var msg = "Please select the company group";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(reportdate == ""){
      var msg = "Please enter the report date";
      var error = 1;
      showError(msg, error);
      return false;
    }else if(invalid_file != 0){
      var msg = "Please upload only xlsx sheet";
      var error = 1;
      showError(msg, error);
      return false;
    }else{
      //post data to server
			// debugger;
				var data = {
          "portfolioCompany":portfolioCompany,
          "portfolioCompanyGroup":portfolioCompanyGroup,
          "reportdate":reportdate,
					"upload_file": excel_file
        };

        var path = "companies/saveReport";

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

        // callAjax(data, path, function(response){

        //   console.log("response");
        //   console.log(response);

        //   var code = response.C;
				// 	debugger;
        //   if(code == 100){
						
				// 		window.location = response.redirect;
				// 		console.log(window.location);
        //   }else{
				// 		alert(response.error);
        //   }

        // });
    }

})





</script>

<?php include("footer.php");?>
