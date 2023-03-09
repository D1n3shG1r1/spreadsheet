<?php include("header.php");?>

<div class="container-fluid mt-3">
	<div class="container">

<!-- <input id="importUrl" value="http://localhost/ci/google-sheets/company_assets/1663046676825801/Workbook.xlsx" />
<input id="btnExcelUpload" type="button" value="Load Excel File" /> -->
		<div class="h1 mb-4 text-center">Make Report</div>
		<form method = "POST" action="" enctype="multipart/form-data" id="upload_excel">
			<div class="mb-3 row">
				<label for="portfolioCompany" class="col-4 col-form-label">Portfolio Company:</label>
				<div class="col-8">
				<select id="portfolioCompany" name="portfolioCompany" class="form-control" >
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
				<select id="portfolioCompanyGroup" name="portfolioCompanyGroup" class="form-control" >
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
					<input type="text" id="reportdate" name='reportdate' class="form-control" placeholder="yyyy/mm/dd" value="" />
				</div>
			</div>
			<div class="mb-3 row">
				<label for="inputName" class="col-4 col-form-label">Upload File:</label>
				<div class="col-8">
					<input type="file" name="file" id="files" class="form-control"  accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  />
				</div>
			</div>
			<div class="mb-3 row">
				<div class="offset-sm-4 col-sm-8">
					<button id="saveButton" class="btn btn-primary">Save</button>
					<a href="" class="btn btn-success d-none" id="viewReport">View Your Report</a>
				</div>
			</div>
		</form>
	</div>
	<!-- <div class="configurator">
		<div class="box-col">
			<button id='export-excel' class="btn btn-primary mt-3">Export Excel</button>
		</div>

		<div id="spreadsheet" style="width: 100%;"></div>
	</div> -->
</div>

<?php include_once('scripts.php');?>
<script src="<?php echo base_url("assets/kento/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/kendo.all.min.js"); ?>"></script>
<!-- <script>
	// $(document).ready(function() {
	//     $("#files").kendoUpload({
	//         async: {
	//             saveUrl: "save.php",
	//             removeUrl: "remove",
	//             autoUpload: true
	//         }
	//     });
	// });

	var folder_name = '';
	var file_name = "Workbook.xlsx";
	var exportExcelToFolderPath = "companies/SaveUpdatedExcelSheetToFolder"; 
	$(function() {
		/* Geting Excel data from url.
		$("#spreadsheet").kendoSpreadsheet({
			excel: {
				proxyURL: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath
			}
		});
		var spreadsheet = $("#spreadsheet").data("kendoSpreadsheet");
		$(document).on('click', '#btnExcelUpload', function(){
			var excelUrl = document.getElementById("importUrl").value;
			console.log(excelUrl);
			var oReq = new XMLHttpRequest();
			oReq.open('get', excelUrl, true);
			oReq.responseType = 'blob';
			oReq.onload = function () {
				var blob = oReq.response;
				var workbook = new kendo.spreadsheet.Workbook({});
				debugger
				workbook.fromFile(blob).then(function(){
					jsonContent = workbook.toJSON();
					console.log(jsonContent);
					spreadsheet.fromJSON(jsonContent);
					$("#spreadsheet").show();
				});
				// excelIo.open(blob, function (json) {
				// 	jsonData = json;
				// 	workbook.fromJSON(json);
				// }, function (message) {
				// 	console.log(message);
				// });
			};
			oReq.send(null);
		});
		*/
		
		$("#spreadsheet").kendoSpreadsheet({
			excel: {
				proxyURL: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath
			}
		});
		
		var spreadsheet = $("#spreadsheet").data("kendoSpreadsheet");
		
		// $.getJSON("products.json")
		// .done(function (sheets) {
		//     // debugger;
		//     spreadsheet.fromJSON({ sheets: sheets.sheets });
		// });
		$("#spreadsheet").hide();
		var path = "companies/SaveExcelSheetToFolder";
		$("#files").on('change', function(){
			// debugger
			//http://localhost/ci/google-sheets/company_assets/1663046676825801/Yearly Investor MIS FY23 .xlsx
			// var file = "http://localhost/ci/google-sheets/company_assets/1663046676825801/Yearly Investor MIS FY23 .xlsx";
			var file = document.getElementById("files").files[0];
			console.log(file);
			if (file) {
				var workbook = new kendo.spreadsheet.Workbook({});
				workbook.fromFile(file).then(function(){
					jsonContent = workbook.toJSON();
					// console.log(jsonContent);
					spreadsheet.fromJSON(jsonContent);
					$("#spreadsheet").show();
				});

				var form = new FormData();

				// Adding the image to the form
				form.append("file", file);

				// The AJAX call
				$.ajax({
					url: "<?php echo custom_siteurl(); ?>"+path,
					type: "POST",
					data:  form,
					contentType: false,
					processData:false,
					success: function(result){
						folder_name = result.folder_name;
						file_name = result.file_name;
					}
				});
			}
		})
		// var path = "companies/SaveExcelSheetToFolder";
		// var removepath = "companies/RemoveExcelSheetFromFolder";
		// $("#files").kendoUpload({
		// 	async: {
		// 		saveUrl: "<?php echo custom_siteurl(); ?>"+path,
		// 		removeUrl: "<?php echo custom_siteurl(); ?>"+removepath,
		// 	},
		// 	multiple: false,
		// 	localization: {
		// 		"select": "Select file to import..."
		// 	},
		// 	select: function(e) {
		// 		var extension = e.files[0].extension.toLowerCase();
		// 		if (ALLOWED_EXTENSIONS.indexOf(extension) == -1) {
		// 			alert("Please, select a supported file format");
		// 			e.preventDefault();
		// 		}
		// 	},
		// 	success: function(e) {
		// 		// Load the converted document into the spreadsheet
		// 		folder_name = e.response.folder_name;
		// 		file_name = e.response.file_name;
		// 	}
		// });

		$(".download").click(function () {
			$("#download-data").val(JSON.stringify(spreadsheet.toJSON()));
			$("#download-extension").val($(this).data("extension"));
		});

		$(document).on('click', "#export-excel", function(e){
			// Prevent the default behavior which will prompt the user to save the generated file.
			e.preventDefault();
			// Get the Excel file as a data URL.
			var dataURL = new kendo.ooxml.Workbook(spreadsheet.toJSON()).toDataURL();
			// Strip the data URL prologue.
			var base64 = dataURL.split(";base64,")[1];
			
			debugger
			// Post the base64 encoded content to the server which can save it.
			$.post("<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath, {
				base64: base64,
				fileName: file_name
			});
		})
	});
</script> -->

<script>
	var TMP_SHEETS_DATA = {};
	var TMP_WORKBOOK = "";
	var TMP_ATTCHARR = '';
	var count = 0;
	var invalid_file = 0;
	var excel_file = 0;
	function checkfile(sender) {
		var validExts = new Array(".xlsx");
		var fileExt = sender.target.files[0]['name'];
		fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
		if (validExts.indexOf(fileExt) < 0) {
				invalid_file = 1;
				console.log(invalid_file);
		return false;
		}else{
			invalid_file = 0;
			return true;	
		}
	}

	function upload(event){
	//TMP_ATTCHARR
	var files = event.target.files;
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

	$('#upload_excel').submit(function(e) {
		e.preventDefault();
		var _this = $(this);
		var file_data = $("#files").prop('files')[0]; 

    var portfolioCompany = $("#portfolioCompany").val();
    var portfolioCompanyGroup = $("#portfolioCompanyGroup").val();
    var reportdate = $("#reportdate").val();
	var excel_file = TMP_ATTCHARR;
	// debugger
    //---- save to db
    if(portfolioCompany == null){
      var msg = "Please select the portfolio company";
      var error = 1;
	  toastr.error(msg);
	 
    }else if(portfolioCompanyGroup == null){
      var msg = "Please select the company group";
      var error = 1;
	  toastr.error(msg);
      return false;
    }else if(reportdate == ""){
      var msg = "Please enter the report date";
      var error = 1;
      toastr.error(msg);
      return false;
    }else if(invalid_file != 0){
      var msg = "Please upload only xlsx sheet";
      var error = 1;
      toastr.error(msg);
      return false;
    }else if(excel_file == ""){
		var msg = "Please upload xlsx sheet";
		var error = 1;
		toastr.error(msg);
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
					$("#saveButton").attr("disabled", true);
					toastr.success(jsonData.message);
					var redirect = "<?php echo custom_siteurl(); ?>" + jsonData.redirect;		
					$("#viewReport").removeClass("d-none");
					$("#viewReport").attr("href", redirect);
                    // location.href = redirect;
                }
                else
                {
					toastr.error('There are some Errors. Please try again!');
                }
           }
       });
    }
})

$(function(){
  document.getElementById('files').addEventListener('change', checkfile, false);
  document.getElementById('files').addEventListener('change', upload, false);
  $("#reportdate").datepicker();
});
</script>

<?php include("footer.php");?>
