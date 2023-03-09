<?php include("header.php");?>

<div class="container-fluid mt-3">	
	<!-- <div class="configurator">
		<div class="box-col">
			<button id='export-excel' class="btn btn-primary mt-3">Export Excel</button>
		</div> -->

		<div id="spreadsheet" style="width: 100%;"></div>
	</div>
</div>

<?php include_once('scripts.php');?>
<script src="<?php echo base_url("assets/kento/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/kendo.all.min.js"); ?>"></script>
<script>
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
</script>

<?php include("footer.php");?>
