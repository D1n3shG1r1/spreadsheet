<?php include("header.php");

	$sheetDbID = $excelData['id'];
	$sheetCompanyID = $excelData['porfolio_company_id'];

?>

<style>
/*	#tmpChartContainer{
	  border: 1px solid red;
    width: 800px;
    position: absolute;
    z-index: 10;
    left: 18%;
    top: 15%;
    background-color: #fff;
    display: none;
  }*/

	/*#tmpChartContainer .chartBox{
    border: 1px solid;
    width: 75%;
    height: 498px;
    float: left;
	}

	#tmpChartContainer .chartOptionsBox{
		border: 1px solid;
    width: 25%;
    height: 498px;
    float: left;
	}

	#tmpChartContainer .chartBox canvas{
		width: 100%;
    height: auto;
    margin-top: 5%;
  }


  #tmpChartContainer .chartTitleBox{
  	float: left;
    border: 1px solid;
    width: 100%;
  }

  #tmpChartContainer .chartTitleBox a{
	  float: right;
	}

  #tmpChartContainer .chartActionButtons{
  	float: left;
    border: 1px solid;
    width: 100%;
    text-align: right;
  }

  #tmpChartContainer .chartOptionsBox .propertiesHead{
    float: left;
    width: 100%;
	}

	
	#tmpChartContainer .chartOptionsBox .property{
	  float: left;
    width: 100%;
	}

	#tmpChartContainer .chartOptionsBox .property input{
	  width: 100%;
	}*/

	#tmpChartContainer .chartBox{
    width: 100%;
    height: 500px;
    float: left;
	}

	#tmpChartContainer .sidebar-modal{
		border-left: 1px solid #dee2e6;
	}

	#tmpChartContainer .chartOptionsBox{
    height: auto;
    float: left;
    padding: 10px;

	}

	#tmpChartContainer .chartBox canvas{
		width: 100% !important;
    height: 100% !important;
    object-fit: contain;
  }

  #tmpChartContainer .modal-body {
  	padding: 0;
  }


	#seriesBox select {
    float: left;
    width: 100%;
    margin-top: 15px;
    border: 1px solid #dee2e6;
    border-radius: 3px;
    padding: 5px;
	}

	#LegendsPosition{
		float: left;
    width: 100%;
    margin-top: 15px;
    border: 1px solid #dee2e6;
    border-radius: 3px;
    padding: 5px;
	}

	.chartTypeBox{
    border: 1px solid #e1e0e0;
    margin-left: 10px;
    width: 30%;
    margin-top: 10px;
    height: 55px;
    cursor: pointer;
    border-radius: 5px;
	}
	
	.chartTypeBox:hover{
		background-color: #f1f1f1;	
	}
	

	.charts-inner{
		padding: 10px;
	}

	.charts-inner i{
		width: 100%;
    float: left;
    text-align: center;
  }

  .charts-inner span{
		width: 100%;
    float: left;
    text-align: center;
    font-size: 12px;
  }

  .modal-footer{
  	margin-top: 10px;
  }
 
  #tmpChartContainer .modal-footer{
  	margin: 0px;
  }


  .propertiesHead{
  	font-weight: 500;
    font-size: 16px;
  }

  .property{
  	border-bottom: 1px solid #dee2e6;
    width: 100%;
    float: left;
    font-size: 12px;
    margin-top: 10px;
    font-weight: 500;
    padding-bottom: 10px;
  }


  .property #chartProp_title{
  	width: 100%;
  	border: 1px solid #dee2e6;
    border-radius: 3px;
    padding: 5px;
  }

	.chartTitleBox .modal-title{
		font-size: 20px;
    font-weight: 500;
  }

  .publishChartBttn{
  	/*cursor: not-allowed !important;*/
  }

</style>

<div class="modal fade" id="tmpChartContainer" aria-hidden="true" aria-labelledby="tmpChartContainerLabel2" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
      	<div class="chartTitleBox"><span class="modal-title"></span></div>
        <button type="button" class="btn-close" id="chartCrossBttn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="row">
      		<div class="col-9">
      			<div class="chartBox"></div>
      		</div>
      		<div class="col-3 sidebar-modal">
      			<div class="chartOptionsBox">
							<span class="propertiesHead">Properties</span>
							<span class="property">
								<lable>Title</lable>
								<input type="text" id="chartProp_title" placeholder="Chart Title" />
							</span>
							<span class="property">
								<lable>Show Title</lable>
								<input type="checkbox" checked id="chartProp_showTitle"/>
							</span>
							<span class="property">
								<lable>Legends Position</lable>
								<select id="LegendsPosition">
									<option value="top">Top</option>
									<option value="bottom">Bottom</option>
									<option value="left">Left</option>
									<option value="right">Right</option>
								</select>
							</span>
							<span class="property">
									<lable>Series</lable>
									<span id="seriesBox"></span>
							</span>
						</div>
      		</div>
      	</div>        
      </div>
      <div class="modal-footer">
        <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Back to first</button> -->

        <div class="chartActionButtons">
					<a href="javascript:void(0);" class="btn btn-secondary" id="chartCancelBttn">Cancel</a>
					<a href="javascript:void(0);" class="btn btn-primary" id="chartSaveBttn" onclick="saveChartData();">Save</a>
				</div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="publish_chart" aria-hidden="true" aria-labelledby="publish_chartLabel2" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      	<h4>Publish Charts</h4>
      </div>
      <div class="modal-body">
      	Please do not reload or close the page while we are publishing your charts.
				<div class="snippet" data-title=".dot-floating">
          <div class="stage">
            <div class="dot-floating"></div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>


<!--- 
Charts documentation
https://docs.telerik.com/kendo-ui/controls/charts/chart-types/area-charts

//supported chart types
1. Categorical
2. Scatter
3. Heatmap
4. Area
5. Bar
6. Box Plot
7. Bubble
8. Bullet
9. Funnel
10. Line
11. Pie
--->

<div class="container-fluid mt-3">	
<?php 
	/*if (!array_key_exists('drive_auth', $this->session->userdata)) {
		$this->session->set_flashdata('error', 'Please Authenticate your APP first.');
		redirect(custom_siteurl()); 
	} */

if($excelData['new_excel_file'] != "" && $excelData['new_excel_file'] != null){
	$new_excel_file = $excelData['new_excel_file'];
}else{
	$new_excel_file = $excelData['old_excel_file'];	
}


$new_excel_file = "1669633434760007/Yearly Investor MIS FY23 .xlsx";
?>

<input type="hidden" name="importUrl" id="importUrl" value="<?php echo base_url()."company_assets/".$new_excel_file; ?>">
	<div class="configurator">
		<div class="box-col d-flex justify-content-between">
			<h3 class="m-2">View Reports</h3>
			<button id='export-excel' class="btn btn-primary m-2 float-end">Save</button>
		</div>

		<div id="spreadsheet" style="width: 100%; height: 700px;"></div>
	</div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Charts</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="#ChartListModal">
				<div class="row WebComponentsIcons">
							

							<!----- New chart types ---->
  						<div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('bar');">
  							<div class="charts-inner">
		            	<i class="k-icon k-i-chart-bar-clustered"></i>
		            	<span>Bar Chart</span>
		            </div>
		          </div>

		          <div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('area');">
		          	<div class="charts-inner">
		            	<i class="k-icon k-i-chart-area-clustered"></i>
		            	<span>Area Chart</span>
		            </div>
		          </div>	

		          <div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('line');">
		          	<div class="charts-inner">
		            	<i class="k-icon k-i-chart-line"></i>
		            	<span>Line Chart</span>
		            </div>
		          </div>

		           <div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('pie');">
		           	<div class="charts-inner">
		            	<i class="k-icon k-i-chart-pie"></i>
		            	<span>Pie Chart</span>
		            </div>
		          </div>

		          <div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('bubble');">
		          	<div class="charts-inner">
		            	<i class="k-icon k-i-chart-bubble"></i>
		            	<span>Bubble Chart</span>
		            </div>
		          </div>
		            

		          <div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('doughnut');">
		          	<div class="charts-inner">
	            		<i class="k-icon k-i-chart-doughnut"></i>
	            		<span>Doughnut Chart</span>
	            	</div>
	          	</div>

							<!---
							<div class="chartTypeBox col-1" data-bs-dismiss="modal" onclick="createChart('scatter');">
		          	<div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter-straight-lines"></i>
		            	<span>Scatter Chart</span>
		            </div>
		          </div>
		          --->


							<!----/- New chart types ---->
							<!----
							<div class="col-4"><div class="charts-inner">
								<i class="k-icon k-i-graph"></i><span>
		            	graph
								</span></div>
							</div>
		          
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-column-clustered"></i><span>
		            	chart-column-clustered
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-column-stacked"></i><span>
		            	chart-column-stacked
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-column-stacked100"></i><span>chart-column-stacked100
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-column-range"></i><span>
		            	chart-column-range
		            </span></div></div>

		          
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-bar-clustered"></i><span>
		            	chart-bar-clustered
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner"><i class="k-icon k-i-chart-bar-stacked"></i><span>
		            	chart-bar-stacked
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-bar-stacked100"></i><span>
		            	chart-bar-stacked100
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-bar-range"></i><span>
		            	chart-bar-range
		            </span></div></div>

		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-area-clustered"></i><span>
		            	chart-area-clustered
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-area-stacked"></i><span>
		            	chart-area-stacked
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-area-stacked100"></i><span>
		            	chart-area-stacked100
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-area-range"></i><span>
		            	chart-area-range
		            </span></div></div>

		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line"></i><span>
		            	chart-line
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line-stacked"></i><span>
		            	chart-line-stacked
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line-stacked100"></i><span>
		            	chart-line-stacked100
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line-markers"></i><span>
		            	chart-line-markers
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line-stacked-markers"></i><span>
		            	chart-line-stacked-markers
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-line-stacked100-markers"></i><span>
		            	chart-line-stacked100-markers
		            </span></div></div>

		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-pie"></i><span>
		            	chart-pie
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-doughnut"></i><span>
		            	chart-doughnut
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter"></i><span>
		            	chart-scatter
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter-smooth-lines-markers"></i><span>
		            	chart-scatter-smooth-lines-markers
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter-smooth-lines"></i><span>
		            	chart-scatter-smooth-lines
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter-straight-lines-markers"></i><span>
		            	chart-scatter-straight-lines-markers
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-scatter-straight-lines"></i><span>
		            	chart-scatter-straight-lines
		            </span></div></div>

		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-bubble"></i><span>
		            	chart-bubble
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-candlestick"></i><span>
		            	chart-candlestick
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-ohlc"></i><span>
		            	chart-ohlc
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-radar"></i><span>
		            	chart-radar
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-radar-markers"></i><span>
		            	chart-radar-markers
		            </span></div></div>
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-radar-filled"></i><span>
		            	chart-radar-filled
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-rose"></i><span>
		            	chart-rose
		            </span></div></div>
		            
		            <div class="col-4"><div class="charts-inner">
		            	<i class="k-icon k-i-chart-choropleth"></i><span>
		            	chart-choropleth
		            </div>
		        </div>
		        ---->
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!---<button type="button" class="btn btn-primary">Next</button>--->
      </div>
    </div>
  </div>
</div>
<div class="spinner-div" style="display: none;">
	<div class="spinner-border" role="status">
	  <span class="visually-hidden">Loading...</i><span>
	</div>	
</div>



<?php include_once('scripts.php');?>
<script src="<?php echo base_url("assets/chart js/chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/kendo.all.min.js"); ?>"></script>
<script>
	var LOCALDBOBJ = '';
	var folder_name = '';
	var file_name = "Workbook.xlsx";
	var SPREADSHEETOBJ = '';
	var TMPACTIVESHEETNAME = '';
	var TMPSELECTEDDATARANGE = '';
	var TMPSELECTEDDATARANGEVAL = '';
	var exportExcelToFolderPath = "companies/SaveUpdatedExcelSheetToFolder"; 
	$(function() {
		

		/* Geting Excel data from url. */
		$("#spreadsheet").kendoSpreadsheet({
			excel: {
				proxyURL: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath
			},
			select: onSelect
		});
		var spreadsheet = $("#spreadsheet").data("kendoSpreadsheet");
		var excelUrl = document.getElementById("importUrl").value;
		// console.log(excelUrl);
		var oReq = new XMLHttpRequest();
		oReq.open('get', excelUrl, true);
		oReq.responseType = 'blob';
		oReq.onload = function () {
			var blob = oReq.response;
			var workbook = new kendo.spreadsheet.Workbook({});
			// debugger
			workbook.fromFile(blob).then(function(){
				jsonContent = workbook.toJSON();
				console.log(jsonContent);
				spreadsheet.fromJSON(jsonContent);
				
				SPREADSHEETOBJ = spreadsheet;

				createDB();
				$("#spreadsheet").show();
				appendCustomMenuButtons();
				getDataRange(spreadsheet);

			});
		};
		oReq.send(null);
		
		// $("#spreadsheet").kendoSpreadsheet({
		// 	excel: {
		// 		proxyURL: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath
		// 	}
		// });
		
		// var spreadsheet = $("#spreadsheet").data("kendoSpreadsheet");
		
		// $.getJSON("products.json")
		// .done(function (sheets) {
		//     // debugger;
		//     spreadsheet.fromJSON({ sheets: sheets.sheets });
		// });
		// $("#spreadsheet").hide();
		var path = "companies/SaveExcelSheetToFolder";
		// $("#files").on('change', function(){
		// 	// debugger
		// 	//http://localhost/ci/google-sheets/company_assets/1663046676825801/Yearly Investor MIS FY23 .xlsx
		// 	// var file = "http://localhost/ci/google-sheets/company_assets/1663046676825801/Yearly Investor MIS FY23 .xlsx";
		// 	var file = document.getElementById("files").files[0];
		// 	console.log(file);
		// 	if (file) {
		// 		var workbook = new kendo.spreadsheet.Workbook({});
		// 		workbook.fromFile(file).then(function(){
		// 			jsonContent = workbook.toJSON();
		// 			// console.log(jsonContent);
		// 			spreadsheet.fromJSON(jsonContent);
		// 			$("#spreadsheet").show();
		// 		});

		// 		var form = new FormData();

		// 		// Adding the image to the form
		// 		form.append("file", file);

		// 		// The AJAX call
		// 		$.ajax({
		// 			url: "<?php echo custom_siteurl(); ?>"+path,
		// 			type: "POST",
		// 			data:  form,
		// 			contentType: false,
		// 			processData:false,
		// 			success: function(result){
		// 				folder_name = result.folder_name;
		// 				file_name = result.file_name;
		// 			}
		// 		});
		// 	}
		// })
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
			$(".spinner-div").removeAttr('style');
			$('body').addClass('overflow-hidden');
			$("#export-excel").attr('disabled', true);
			$("#export-excel").text("Saving... Please wait");
			var data = {
				"base64":base64,
				"excelId": <?php echo $excelData['id']; ?>
				};
			$.ajax({
					url: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath,
					type: "POST",
					data:  data,
					dataType:"json",
					success: function(result){
						
						if (result.status == 'success' ) {
							toastr.success(result.message);
							$("#export-excel").removeAttr('disabled');
							$("#export-excel").text("Save");
							$(".spinner-div").hide();
							$('body').removeClass('overflow-hidden');
						}else {
							// debugger
							toastr.error(result.message);
							setTimeout(() => {
								window.location = "<?php echo custom_siteurl(); ?>"
							}, 2000);
						}
						
					}
				});
		})
	});


	function getDataRange(spreadsheet){

		$("div.k-spreadsheet-name-editor input.k-input-inner").on("keydown", function(event){
			if(event.which == 13){
				getDataSelection(spreadsheet,this);	
			}
			
		});

	}

	function getDataSelection(sheetObj,inpObj){
		
		var dataRange = $(inpObj).val();		
		var tmpdataValues = sheetObj.activeSheet().selection().values();
		var dataValues = JSON.stringify(tmpdataValues);
		var sheetName = sheetObj.activeSheet()._sheetName;
		var id = randomNumber();
		
		//save data range in local storage
		
		var cmd = "INSERT INTO datarange (id, sheetName, dataRange, dataValues) VALUES (?, ?, ?, ?)";
		
		var valuesObj = {id, sheetName, dataRange, dataValues};
		

		saveItemInLocalDb(cmd, valuesObj, function(r){
		
		});

	}


	function appendCustomMenuButtons(){
		var tabStrips = $("#spreadsheet div.k-widget.k-tabstrip.k-floatwrap.k-tabstrip-top.k-spreadsheet-tabstrip div.k-tabstrip-content.k-content");

		var bttnHtml = `<span class="k-separator"></span>
		<div><a role="button" href="javascript:void(0);" onclick="openChartList();" class="k-button k-button-md k-rounded-md k-button-solid k-button-solid-base k-toolbar-last-visible" type="button" data-overflow="auto" aria-disabled="false"><i class="k-icon k-i-graph"></i><span class="k-button-text">Create Charts<span><i class="k-icon k-i-caret-alt-right"></i>
		</a></div>
		<span class="k-separator"></span>
		<div><a role="button" href="javascript:void(0);" onclick="publishCharts();" class="publishChartBttn k-button k-button-md k-rounded-md k-button-solid k-button-solid-base k-toolbar-last-visible" type="button" data-overflow="auto" aria-disabled="false"><i class="fa fa-book" aria-hidden="true"></i><span class="k-button-text">Publish Charts<span>
		</a></div>`;

		var toolbar = $(tabStrips[1]).find("div.k-toolbar.k-widget.k-toolbar-resizable.k-spreadsheet-toolbar");

		$(toolbar).append(bttnHtml);

	}

	function openChartList(){
		

		var rangeVal = $("div.k-spreadsheet-name-editor input.k-input-inner").val();
		
		var rangeValParts = rangeVal.split(":");
		var lastclm = rangeValParts[1];
		if(lastclm != undefined && lastclm != null && lastclm != ""){

		/*
		var number = lastclm.replace(/[^0-9]/gi, '');
		number = parseInt(number) + 1;
		var alphabet = lastclm.replace(/[^A-Z]/gi, '');
		rangeVal = rangeValParts[0]+":"+alphabet+""+number;
*/
		var sheetName = SPREADSHEETOBJ.activeSheet()._sheetName;
		//var tmpdataSelection = SPREADSHEETOBJ.activeSheet().selection();
		//var tmpdataValueskalwala = SPREADSHEETOBJ.activeSheet().selection().values();
		var tmpdataValues = SPREADSHEETOBJ.activeSheet().range(rangeVal).values();


		TMPSELECTEDDATARANGE = rangeVal 
		TMPSELECTEDDATARANGEVAL = tmpdataValues;
		TMPACTIVESHEETNAME = sheetName;

		console.log("TMPSELECTEDDATARANGE:");
		console.log(TMPSELECTEDDATARANGE);
		console.log("TMPSELECTEDDATARANGEVAL:");
		console.log(TMPSELECTEDDATARANGEVAL);
	}

		//show chart list modal

 
		var rangeVal = TMPSELECTEDDATARANGE;
		var colonIdx = rangeVal.indexOf(":");
		var okReport = 0;

		if(rangeVal == "" || rangeVal == null || rangeVal == undefined){
			okReport = 0;	
		}else if(colonIdx != -1){
			var rangeValParts = rangeVal.split(":");
		
			if((rangeValParts[0] != "" && rangeValParts[0] != null && rangeValParts[0] != undefined) && (rangeValParts[1] != "" && rangeValParts[1] != null && rangeValParts[1] != undefined)){
				okReport = 1;
			}else{
				okReport = 0;
			}
		}

		if(okReport > 0){
			showchartModal();
		}else{
			//show err to please create at least one chart
			var msg = "Please select the valid data range for creating charts.";
			var error = 1;
			showError(msg, error);
			return false;
		}

	}

	function showchartModal() {
		$("#staticBackdrop").modal('show');
	}

	function onSelect(e) {  
		/*
		var rangeVal = $("div.k-spreadsheet-name-editor input.k-input-inner").val();
		
		var rangeValParts = rangeVal.split(":");
		var lastclm = rangeValParts[1];
		if(lastclm != undefined && lastclm != null && lastclm != ""){

		var number = lastclm.replace(/[^0-9]/gi, '');
		number = parseInt(number) + 1;
		var alphabet = lastclm.replace(/[^A-Z]/gi, '');
		rangeVal = rangeValParts[0]+":"+alphabet+""+number;

		var sheetName = SPREADSHEETOBJ.activeSheet()._sheetName;
		//var tmpdataSelection = SPREADSHEETOBJ.activeSheet().selection();
		//var tmpdataValueskalwala = SPREADSHEETOBJ.activeSheet().selection().values();
		var tmpdataValues = SPREADSHEETOBJ.activeSheet().range(rangeVal).values();


		TMPSELECTEDDATARANGE = rangeVal 
		TMPSELECTEDDATARANGEVAL = tmpdataValues;
		TMPACTIVESHEETNAME = sheetName;

		console.log("TMPSELECTEDDATARANGE:");
		console.log(TMPSELECTEDDATARANGE);
		console.log("TMPSELECTEDDATARANGEVAL:");
		console.log(TMPSELECTEDDATARANGEVAL);

	}
*/
		
/*	function showChartListModal(){
		$("#ChartListModal").show();
	}
*/


	}  

	function showChartListModal(){
		$("#ChartListModal").show();
	}

	/*---- Web Sql ----*/

function randomNumber(){
	//--- generate unique random number	
	var x = new Date();
	var UTCseconds = (x.getTime() + x.getTimezoneOffset()*60*1000);
	return UTCseconds;
}

function createDB(){
	LOCALDBOBJ = openDatabase("scip", "1.0", "Wrinkles Of The World", 32678);
	createTable('datarange');
}

function createTable(tblnm){
	
	if(tblnm == 'datarange'){
			
		var txnCmd = 'CREATE TABLE IF NOT EXISTS datarange(`id` INTEGER, `sheetName` TEXT, `dataRange` TEXT, `dataValues` TEXT)';
		
		LOCALDBOBJ.transaction(function(transaction){
			transaction.executeSql(txnCmd);
		});
	
	}
	
}


function saveItemInLocalDb(cmd, itemObj, cb){
	
	// This is the SAVE function
	var r = 0; 
	var Values = [];
	$.each(itemObj, function(idx, itmVl){
		Values.push(itmVl);
	});
	
	
	console.log("cmd:" + cmd);
	console.log("itemObj:");
	console.log(itemObj);
	console.log("Values:");
	console.log(Values);

	
	
	LOCALDBOBJ.transaction(function(transaction) {
		
		transaction.executeSql(cmd, 
		Values, function(tx, result) {
			console.log('Inserted');
			console.log(result);
			r = 1;
			return cb(r);
		},
		function(error) {
			console.log('error: ');
			console.log(error);
			r = 2;
			return cb(r);
		});
	});
	
}

function deleteFromTable(tbl){
	
	var dltCmd = "DELETE FROM "+tbl;
	var values = [];
	
	LOCALDBOBJ.transaction(function(transaction){
		transaction.executeSql((dltCmd), values, function(tx, result){
		});
	});
}

function dropTable(tbl){
	
	var dltCmd = "DROP TABLE "+tbl;
	var values = [];
	
	LOCALDBOBJ.transaction(function(transaction){
		transaction.executeSql((dltCmd), values, function(tx, result){
		});
	});
}


function selectData(){

	//var slctCmd = "SELECT * FROM "+tab+" WHERE tab=?";
	//var values = [tab];
	var slctCmd = "SELECT * FROM datarange";
	var values = [];
	
	LOCALDBOBJ.transaction(function(transaction){
		transaction.executeSql((slctCmd), values, function(tx, result){
				
			console.log('result');	
			console.log(result);	
			
		});
	});
}

	/*---\- Web Sql ----*/

function getStaticColors(idx){
	/*
		#FF0000	//Red
		#FFFFFF //White
		#00FFFF //Cyan
		#C0C0C0 //Silver
		#0000FF	//Blue
		#808080 //Gray or Grey
		#00008B	//DarkBlue
		#000000	//Black
		#ADD8E6	//LightBlue
		#FFA500	//Orange
		#800080	//Purple
		#A52A2A	//Brown
		#FFFF00	//Yellow
		#800000	//Maroon
		#00FF00	//Lime
		#008000	//Green
		#FF00FF	//Magenta
		#808000	//Olive
		#FFC0CB	//Pink
		#7FFFD4 //Aquamarine
	*/

	var colorsArray = ["#A52A2A","#FF0000", "#800000","#00FFFF", "#800080","#0000FF", "#808000", "#00008B", "#000000", "#ADD8E6", "#FFA500", "#00FF00", "#008000", "#FFFF00", "#7FFFD4", "#FF00FF", "#FFC0CB"];
	
	return colorsArray[idx];
}

function getRandomHexColor() {  
	
	
		var hex = [0, "E", "F", 1, 2, 3,"A", 4, 5, 6, 9,  "B", "C",  7, 8, "D"];  
	  
		var hexColor = "#";  

		for (var i = 0; i < 6; i++) {

			var randString = Math.floor(Math.random() * hex.length);
	  	hexColor += hex[randString];  

	  }

	  return hexColor;
	
  
}


function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function setChartProperty(chartId, chartType){
	
	//#chartProp_title
	//#chartProp_showTitle
	//#chartProp_switchRowsCols
//chartDivId
	createChart(chartType);

	/*
	var propType = "";
	if(propType == "tl"){
		//$("#chartProp_title").val();
	}else if(propType == "st"){
		//$("#chartProp_showTitle").val();
	}else if(propType == "sw"){
		//$("#chartProp_switchRowsCols").val();
	}else{

	}
	*/
}  	

function createChart(chartType){
	
	var chartDivId = chartType+"_"+randomNumber();
	
	//---- Default options for properties (very first time they will blank)

	var propTitle = $("#chartProp_title").val();
	var propShowTitle = $("#chartProp_showTitle");
	//var propSwtchRC = $("#chartProp_switchRowsCols");
	var propSwtchRC = "";
	var propSeriesDrpdwns = $("#seriesBox select");
	var LegendsPosition = $("#LegendsPosition").val();


	$("#chartCancelBttn").attr("onclick", "cancelChart(\""+chartDivId+"\")");
	$("#chartCrossBttn").attr("onclick", "cancelChart(\""+chartDivId+"\")");

	//chart.js

	var defaultLables = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];


	$("main #tmpChartContainer .chartBox").html('');

	$('<canvas/>',{
	    text: '',
	    id: chartDivId,
	    class: chartDivId,
	    height:400,
	    width:700

	}).appendTo('main #tmpChartContainer .chartBox');

	var onclickHtml = 'setChartProperty(\''+chartDivId+'\',\''+chartType+'\')';
	$("#chartProp_title").attr("onkeyup", onclickHtml);
	$("#chartProp_showTitle").attr("onclick", onclickHtml);
	$("#LegendsPosition").attr("onchange", onclickHtml);
	
	


	$("#tmpChartContainer").modal('show');
	// $("#tmpChartContainer").show();

	var chartCtx = document.getElementById(chartDivId);

	setTimeout(function(){
		
		var ChartOptions;

		//TMPSELECTEDDATARANGE = rangeVal 
		//TMPSELECTEDDATARANGEVAL = tmpdataValues;
		//TMPACTIVESHEETNAME = sheetName;


		if(propTitle != null && propTitle != "" && propTitle != undefined){
			var tmpChartTitle = propTitle;
		}else{
			var tmpChartTitle = TMPACTIVESHEETNAME;
			$("#chartProp_title").val(tmpChartTitle);
		}


		var tmpChrtType = capitalizeFirstLetter(chartType)+' Chart';
		
		$("#tmpChartContainer .chartTitleBox span").html(tmpChrtType);

		if($(propShowTitle).is(":checked") == true){
				var tmpShowTitle = true;
		}else{
			var tmpShowTitle = false;
		}


		if($(propSwtchRC).is(":checked") == true){
			var switchColumns = 1;
		}else{
			var switchColumns = 0;
		}

		var tmpChartDataSource = TMPSELECTEDDATARANGEVAL;

		if(chartType == "line"){
		
				var title = tmpChartTitle;
				var showTitle = tmpShowTitle;
				var position = LegendsPosition;

				var DATA_COUNT = tmpChartDataSource.length;
				

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						var tmpLbl = LnIdx;
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});


				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];

				if(tmpDataSet.length > 0){

					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
								
							finalDataSetValArr["label"] = tmpXaxisLbl; 	
							categories.push(tmpClmLst[tmpDataSetIdx]);
							seriesArr.push(tmpXaxisLbl);
							
							var tmpClr = getRandomHexColor();
							var loopTmpData = [];
							
							$.each(tmpDataSetValsArr, function(i,v){
								
								if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
										
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									
									loopTmpData.push(tmpV);
								
								}
							});

							finalDataSetValArr["data"] = loopTmpData; //tmpDataSetValsArr.shift();
							finalDataSetValArr["borderColor"] = tmpClr;
							finalDataSetValArr["backgroundColor"] = tmpClr;

							finalDataSet.push(finalDataSetValArr);

						}


					});

				}


				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}



				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				var labels = categories;
				
				var chartData = {
				  "labels": labels,
				  "datasets": finalDataSet
				};

				var config = {
				  type: 'line',
				  data: chartData,
				  options: {
				    responsive: true,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};

				//console.log("config");	
				//console.log(config);	
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);	

			}else if(chartType == "bar"){

				var position = LegendsPosition;
				var showTitle = tmpShowTitle;
				var title = tmpChartTitle;

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						//var tmpLbl = LnIdx;
						var tmpLbl = "";
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});


				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				
				console.log("tmpDataSet.length:"+tmpDataSet.length);
				console.log("tmpDataSet");
				console.log(tmpDataSet);

				
				if(tmpDataSet.length > 0){
						
						
					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						
					//	if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
							
							if(switchColumns > 0){
								finalDataSetValArr["label"] = tmpClmLst[tmpDataSetIdx]; 	
								categories.push(tmpXaxisLbl);
							}else{
								finalDataSetValArr["label"] = tmpXaxisLbl; 	
								categories.push(tmpClmLst[tmpDataSetIdx]);
								seriesArr.push(tmpXaxisLbl);
							}

								
							//var tmpClr = getRandomHexColor();
							var tmpClr = getStaticColors(tmpDataSetIdx);
							var loopTmpData = [];
							
							$.each(tmpDataSetValsArr, function(i,v){
								
								//if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
											tmpV = tmpV / 100;
											tmpV = parseFloat(tmpV); 
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									
									loopTmpData.push(tmpV);
								
								//}
							});

							
							finalDataSetValArr["data"] = loopTmpData; //tmpDataSetValsArr.shift();
							finalDataSetValArr["borderColor"] = tmpClr;
							finalDataSetValArr["backgroundColor"] = tmpClr;

							finalDataSet.push(finalDataSetValArr);
						
						//}


					});

				}

				
				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}




				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				var labels = categories;
				var data = {
				  labels: labels,
				  datasets: finalDataSet
				};


				var config = {
				  type: 'bar',
				  data: data,
				  options: {
				    responsive: true,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};

				
				//console.log("config");	
				//console.log(config);	
				//return false;
				
				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);

			}else if(chartType == "pieold"){

				var position = LegendsPosition;
				var showTitle = tmpShowTitle;
				var title = tmpChartTitle;


				var DATA_COUNT = tmpChartDataSource.length;
				var NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						var tmpLbl = LnIdx;
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});


				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				

				console.log("tmpDataSet:");
				console.log(tmpDataSet);




				if(tmpDataSet.length > 0){

					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
								
							finalDataSetValArr["label"] = tmpXaxisLbl; 

							seriesArr.push(tmpClmLst[tmpDataSetIdx]);	
							categories.push(tmpClmLst[tmpDataSetIdx]);
							//finalDataSetValArr["label"] = tmpClmLst[tmpDataSetIdx]; 	
							//categories.push(tmpXaxisLbl);
							
							//var tmpClr = getRandomHexColor();
							var colorsArr = [];
							var loopTmpData = [];
							
							$.each(tmpDataSetValsArr, function(i,v){
								
								if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
											tmpV = tmpV / 100;
											tmpV = parseFloat(tmpV); 
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									

									loopTmpData.push(tmpV);
									//var tmpClr = getRandomHexColor();
									//var tmpClr = getStaticColors(tmpDataSetIdx);
									var tmpClr = getStaticColors(i);
									colorsArr.push(tmpClr);		
								}
							});


							finalDataSetValArr["data"] = loopTmpData; //tmpDataSetValsArr.shift();
							//finalDataSetValArr["borderColor"] = tmpClr;
							finalDataSetValArr["backgroundColor"] = colorsArr;


							finalDataSet.push(finalDataSetValArr);

						}


					});

				}	




				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}

				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				// $("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				console.log("finalDataSet");
				console.log(finalDataSet);



				var data = {
				  labels: categories,
				  datasets: finalDataSet
				};

				

				var config = {
				  type: 'pie',
				  data: data,
				  options: {
				    responsive: true,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};


				console.log("config");	
				console.log(config);
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);	

			}else if(chartType == "pie"){
				/*Dinesh*/

				var position = LegendsPosition;
				var showTitle = tmpShowTitle;
				var title = tmpChartTitle;


				var DATA_COUNT = tmpChartDataSource.length;
				var NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				

				var tmpDataSet = tmpChartDataSource;
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				

				console.log("tmpDataSet:");
				console.log(tmpDataSet);

				var finalDataSetValArr = {};
				finalDataSetValArr["label"] = []; 
				finalDataSetValArr["backgroundColor"] = [];
				finalDataSetValArr["data"] = [];
				

				if(tmpDataSet.length > 0){


					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						var tmpClr = getStaticColors(tmpDataSetIdx);
						finalDataSetValArr["backgroundColor"].push(tmpClr);

						var tmpXaxisLbl = tmpDataSetValsArr[0];
						seriesArr.push(tmpXaxisLbl);

						var tmpXaxisVal = tmpDataSetValsArr[1];

						finalDataSetValArr["data"].push(tmpXaxisVal);
						
					});

				}	




				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

				}


				//update labels according to user selection
				
				finalDataSetValArr["label"] = seriesArr;

				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				// $("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				finalDataSet.push(finalDataSetValArr);

				console.log("finalDataSet");
				console.log(finalDataSet);



				var data = {
				  labels: categories,
				  datasets: finalDataSet
				};

				var config = {
				  type: 'pie',
				  data: data,
				  options: {
				    responsive: false,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};


				console.log("config");	
				console.log(config);
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);	

			}else if(chartType == "bubble"){


				var position = LegendsPosition;
				var showTitle = tmpShowTitle;
				var title = tmpChartTitle;


				var DATA_COUNT = tmpChartDataSource.length;
				var NUMBER_CFG = {count: DATA_COUNT, min: -100, max: 100};

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						var tmpLbl = LnIdx;
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});

				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				
				if(tmpDataSet.length > 0){

					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
								
							finalDataSetValArr["label"] = tmpXaxisLbl;
							seriesArr.push(tmpXaxisLbl); 	
							categories.push(tmpClmLst[tmpDataSetIdx]);
							//finalDataSetValArr["label"] = tmpClmLst[tmpDataSetIdx]; 	
							//categories.push(tmpXaxisLbl);
							
							var tmpClr = getRandomHexColor();
							var colorsArr = [];
							var loopTmpData = [];
							
							var tmpDataObj = {"x":tmpDataSetValsArr[1],"y":tmpDataSetValsArr[2],"r":tmpDataSetValsArr[3]};

							loopTmpData.push(tmpDataObj);


							/*
							$.each(tmpDataSetValsArr, function(i,v){
								
								if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
											tmpV = tmpV / 100;
											tmpV = parseFloat(tmpV); 
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									

									loopTmpData.push(tmpV);
									//var tmpClr = getRandomHexColor();
									//colorsArr.push(tmpClr);		
								}

							});
							*/


							finalDataSetValArr["data"] = loopTmpData; //tmpDataSetValsArr.shift();
							finalDataSetValArr["borderColor"] = tmpClr;
							finalDataSetValArr["backgroundColor"] = tmpClr;

							finalDataSet.push(finalDataSetValArr);

						}


					});

				}	




				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}




				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);

				var data = {
				  labels: categories,
				  datasets: finalDataSet
				};

				var config = {
				  type: 'bubble',
				  data: data,
				  options: {
				    responsive: true,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};

				//console.log("config");	
				//console.log(config);
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);	

			}else if(chartType == "area"){

				var title = tmpChartTitle;
				var showTitle = tmpShowTitle;
				var position = LegendsPosition;

				var DATA_COUNT = tmpChartDataSource.length;
				

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						var tmpLbl = LnIdx;
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});


				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				
				if(tmpDataSet.length > 0){

					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
								
							finalDataSetValArr["label"] = tmpXaxisLbl; 	
							categories.push(tmpClmLst[tmpDataSetIdx]);
							seriesArr.push(tmpXaxisLbl);
							
							var tmpClr = getRandomHexColor();
							var loopTmpData = [];
							
							$.each(tmpDataSetValsArr, function(i,v){
								
								if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
										
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									
									loopTmpData.push(tmpV);
								
								}
							});

							finalDataSetValArr["data"] = loopTmpData; //tmpDataSetValsArr.shift();
							finalDataSetValArr["borderColor"] = tmpClr;
							finalDataSetValArr["backgroundColor"] = tmpClr;
							finalDataSetValArr["fill"] = '-1';
							

							finalDataSet.push(finalDataSetValArr);

						}


					});

				}



				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}

				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				var labels = categories;
				
				var data = {
				  "labels": labels,
				  "datasets": finalDataSet
				};

				
				var config = {
				  type: 'line',
				  data: data,
				  options: {
				    scales: {
				      y: {
				        stacked: true
				      }
				    },
				    plugins: {
				      filler: {
				        propagate: false
				      },
				      'samples-filler-analyser': {
				        target: 'chart-analyser'
				      },
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
						},
				    interaction: {
				      intersect: false,
				    },
				  },
				};

				//console.log("config");	
				//console.log(config);
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);	

			}else if(chartType == "doughnut"){


				var title = tmpChartTitle;
				var showTitle = tmpShowTitle;
				var position = LegendsPosition;

				var DATA_COUNT = tmpChartDataSource.length;
				

				//--- create data columns
				var zeroIdx = tmpChartDataSource[0];
				var tmpClmLst = [];
				var cnt = 0;
				
				$.each(zeroIdx, function(LnIdx, LnVl){

					//tmpClmLst
					//if(LnVl != null && LnVl != "" && LnVl != undefined){
					if(LnVl != null && LnVl != undefined){
						
						/*
						if($.isNumeric(LnVl) == false){
								var tmpLbl = LnVl;
						}else{
								var tmpLbl = defaultLables[cnt];
						}
						*/

						var tmpLbl = LnVl.toString();
						tmpClmLst.push(tmpLbl);

					}else{
						//var tmpLbl = defaultLables[cnt];
						var tmpLbl = LnIdx;
					
						//if(LnIdx > 0){
							tmpClmLst.push(tmpLbl);
						//}
						
					}
					
					
					cnt++;
				});


				var tmpDataSet = tmpChartDataSource;
				//tmpDataSet.shift(); //remove 0 index
				var x_axisLables = [];
				var finalDataSet = [];
				var categories = [];
				var seriesArr = [];
				var colorsArr = [];

				if(tmpDataSet.length > 0){


					$.each(tmpDataSet, function(tmpDataSetIdx, tmpDataSetValsArr){

						if(tmpDataSetIdx > 0){
						
							var finalDataSetValArr = {};

							var tmpXaxisLbl = tmpDataSetValsArr[0];
								
							finalDataSetValArr["label"] = tmpXaxisLbl;
							seriesArr.push(tmpXaxisLbl); 	
							categories.push(tmpClmLst[tmpDataSetIdx]);
							
							var tmpClr = getRandomHexColor();
							var loopTmpData = [];
							
							$.each(tmpDataSetValsArr, function(i,v){
								
								if(i > 0){
									
									if(v != null && v != undefined){
										

										if(typeof v == "number"){
											
											var tmpV = parseFloat(v); 

											tmpV = tmpV * 100;
											tmpV = Math.ceil(tmpV);
										
										}else{
											
											var tmpV = v; 

										}

										//var tmpV = v.toString();
									
									}else{
									
										var tmpV = v;
									
									}
									
									loopTmpData.push(tmpV);
								
								}
							});

						
							if(tmpDataSetIdx == 1){

								var noOfColorsToGenrt = loopTmpData.length;
								
								for(var ii = 0; ii <= noOfColorsToGenrt; ii++){
									var tmpClr = getRandomHexColor();
									colorsArr.push(tmpClr);
								}

							}


							finalDataSetValArr["data"] = loopTmpData;
							finalDataSetValArr["backgroundColor"] = colorsArr;
							
							finalDataSet.push(finalDataSetValArr);

						}


					});

				}


				if($(propSeriesDrpdwns).length > 0){

					//set series array according to user selection
					seriesArr = [];
					
					$(propSeriesDrpdwns).each(function(si, sv){
						
						var tmpSrs = $(sv).val();

						seriesArr.push(tmpSrs);

					});

					
					//update labels according to user selection
					$.each(finalDataSet, function(fdi, fdv){

							finalDataSet[fdi]["label"] = seriesArr[fdi];
					});

				}


				//create series dropdown
				var seriesHtml = '';
				$.each(seriesArr,function(i1,v1){
						seriesHtml += '<select onchange="'+onclickHtml+'">';
						$.each(seriesArr,function(i2,v2){
							if(v1 == v2){
								var slctd = 'selected="selected"';
							}else{
								var slctd = '';
							}
							seriesHtml += '<option value="'+v2+'" '+slctd+'>'+v2+'</option>';
						});
						seriesHtml += '</select>';
				});

				$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html(seriesHtml);


				var labels = categories;
				
				var data = {
				  "labels": labels,
				  "datasets": finalDataSet
				};

				var config = {
				  type: 'doughnut',
				  data: data,
				  options: {
				    responsive: true,
				    plugins: {
				      legend: {
				        position: position,
				      },
				      title: {
				        display: showTitle,
				        text: title
				      }
				    }
				  },
				};
			

				console.log("config");	
				console.log(config);
				//return false;

				$("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val", JSON.stringify(config));

				myChart = new Chart(chartCtx, config);
				
			}

	}, 500);

}

function cancelChart(chartId){

	//remove chart data from storage
	var key = chartId;
	
	localStorage.removeItem(key);

	//reset chart box and close
	$("#tmpChartContainer .chartTitleBox span").html("");
	$("#tmpChartContainer .chartBox").html("");
	$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html("");
	$("#tmpChartContainer .chartActionButtons #chartSaveBttn").removeAttr("data-val");
	$("#tmpChartContainer").modal('hide');
	// $("#tmpChartContainer").hide();

}

function saveChartData(){
	
	var canvasId = $("#tmpChartContainer .chartBox canvas").attr("id");
	var canvasIdParts = canvasId.split("_");
	var chartType = canvasIdParts[0];
	var chartId = canvasIdParts[1];
	var chartConfigData = $("#tmpChartContainer .chartActionButtons #chartSaveBttn").attr("data-val");


	//save this in local storage

	localStorage.setItem(canvasId, chartConfigData);
	var lskeys = Object.keys(localStorage);
	
	//reset chart box and close
	$("#tmpChartContainer .chartTitleBox span").html("");
	$("#tmpChartContainer .chartBox").html("");
	$("#tmpChartContainer .chartOptionsBox .property #seriesBox").html("");
	$("#tmpChartContainer .chartActionButtons #chartSaveBttn").removeAttr("data-val");
	// $("#tmpChartContainer").hide();
	$("#tmpChartContainer").modal('hide');


}

function publishCharts(){

	//get all the chart data one-by-one and put it in db
	var lskeys = Object.keys(localStorage);
	
	if(lskeys.length > 0){

		$("#publish_chart").modal('show')
		
		var count = lskeys.length;

		$.each(lskeys, function(lskIdx, lskVal){

				var chartSequence = lskIdx + 1;
				var currntIdx = chartSequence;
				var sheetDbId = '<?php echo $sheetDbID; ?>';
				var sheetCompanyID = '<?php echo $sheetCompanyID; ?>';
				var chartId = lskVal;
				var chartIdParts = lskVal.split("_");
				var chartType = chartIdParts[0];

				var tmpChartConfigData = localStorage.getItem(lskVal);

				var tmpChartConfigDataJson = JSON.parse(tmpChartConfigData);
				if(tmpChartConfigData != '' && tmpChartConfigData != null && tmpChartConfigData != undefined){

					var data = {
											"sheetDbId": sheetDbId,
											"sheetCompanyID": sheetCompanyID,
											"chartId": chartId,
											"chartType": chartType,
											"config":tmpChartConfigDataJson,
											"chartSequence":chartSequence
										};

					var path = 'companies/publishCharts';

					callAjax(data, path, function(response){
						
						console.log("response");
						console.log(response);

						var c = response.C;
						var r = response.R;
						var m = response.M;

						if(c == 100){
							
							//-- remove from local storage
							localStorage.removeItem(lskVal);

							if(count == currntIdx){
								//redirect to analytics dashboard
								window.location.href = '<?php echo site_url("companies/charts/$sheetDbID"); ?>';

							}

						}else{
								$("#publish_chart").modal('hide');
						}

					});

				}

		});

	}else{

		
		//show err to please create at least one chart
		var msg = "Please create atleast one chart to publish.";
		var error = 1;
		showError(msg, error);

	}

}


function swapKeysAndValues(obj) {
  
  var swapped = Object.entries(obj).map(
    ([key, value]) => ({[value]: key})
  );

  return Object.assign({}, ...swapped);
}

</script>

<?php include("footer.php");?>
