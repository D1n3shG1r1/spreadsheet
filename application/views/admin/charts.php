<?php

include("header.php"); 
include_once('scripts.php');

?>


<style>
	

	#chartsTitle{
		font-size: 22px;
    	font-weight: 500;
    	width: 100%;
    	text-align: center;
	}

	#chartsMainContainer{
		padding: 1px;
		float: left;
    	width: 100%;
	}
	
	#chartsMainContainer .chartContainer{
		float: left;
	    width: 49% !important;
	    border: 1px solid #cecece;
	    border-radius: 5px;
	    padding: 10px;
	    margin-left: 8px;
	    margin-top: 8px;
	}

	.actionContainer{
		width: 100%;
   		float: left;
   		padding: 10px;
	}

	#saveChartOrderBttn{
		width: 100px;
	}

	canvas
	{
		height: 100% !important;
		width: 100% !important;
		object-fit: contain;
	}
	

</style>

<script src="<?php echo base_url("assets/chart js/chart.min.js"); ?>"></script>

<script>

var SHEET_NAME = "<?php echo $sheetName; ?>";
var CHARTS_DATA = <?php echo json_encode($chartsdata); ?>;


$(function(){

	if(SHEET_NAME != null && SHEET_NAME != ""){
		$("#chartsTitle").html(SHEET_NAME+" Analytics");
	}

	createCharts();

	initDrag();

});

function initDrag() {

	$(".chartsMainContainer").sortable({
		connectWith: ".chartsMainContainer",
		stack: '.chartsMainContainer .chartContainer',
		update: function( event, ui ) {
			
			setChartsOrder();

		}
	}).disableSelection();
}	



function createCharts(){

	if(CHARTS_DATA != null && CHARTS_DATA != '' && CHARTS_DATA.length > 0){

		$.each(CHARTS_DATA, function(i,v){

			var chartId = v.chartId;
			var chartSequence = v.chartSequence;
			var chartType = v.chartType;
			var chartTitle = v.chartTitle;
			var companyId = v.companyId;
			var configData = JSON.parse(v.configData);
			var createDate = v.createDate;
			var excelSheetId = v.excelSheetId;
			var id = v.id;
			var userId = v.userId;


			$("#chartsTitle").text(chartTitle);


			$('<div/>',{
			    'text': '',
			    'id': chartId+"_container",
			    'data-sequence':chartSequence,
			    'class': "chartContainer",
			    'height':400,
			    'width':700

			}).appendTo('#chartsMainContainer');

			$('<a/>',{
				'html':'<i class="fa fa-times" aria-hidden="true"></i>',
				'data-bs-toggle':'tooltip',
				'data-bs-placement':'right',
				'title':'Delete',
				'id':chartId+'_delete',
				'class':'chartDelete',
				'onclick':'removeChart(\''+chartId+'\');'
			}).appendTo('#chartsMainContainer #'+chartId+'_container');

			$('<canvas/>',{
			    'text': '',
			    'id': chartId,
			    'class': chartId,
			    'data-dbid': id,
			    'height':400,
			    'width':700

			}).appendTo('#chartsMainContainer #'+chartId+'_container');

			var chartCtx = $("#"+chartId);

			var myChart = new Chart(chartCtx, configData);

		});


		setTimeout(function(){

			//sort elements by their data-sequence
			var $wrapper = $('.chartsMainContainer');

			$wrapper.find('.chartContainer').sort(function(a, b) {
			    return +a.dataset.sequence - +b.dataset.sequence;
			}).appendTo($wrapper);

		}, 500);

	}else{
		
		$('<div/>',{
		    html: '<span>It seems that you have not created any chart yet</span>',
		    id: "NoCharts",
		    class: "NoCharts",
		    height:400,
		    width:700

		}).appendTo('#chartsMainContainer');
	}

}

function removeChart(parmChartId){

	var r = window.confirm("Are you sure? You want to delete this.");
	
	if(r == true){

		$.each(CHARTS_DATA, function(i,v){


			if(parmChartId == v.chartId){

				var chartId = v.chartId;
				var chartSequence = v.chartSequence;
				var chartType = v.chartType;
				var chartTitle = v.chartTitle;
				var companyId = v.companyId;
				var configData = JSON.parse(v.configData);
				var createDate = v.createDate;
				var excelSheetId = v.excelSheetId;
				var id = v.id;
				var userId = v.userId;	
				
				CHARTS_DATA.splice(i,1);

				$("#"+chartId+"_container").remove();

				return false;
			}

		});

	}

}

function setChartsOrder(){

	$(".chartContainer").each(function(i, v){

		var sequence = i + 1;
		$(v).attr("data-sequence", sequence);
		
	});

}

function saveChartsOrder(){
	
	var newChartTitle = $("#chartsTitle").text();

	//update data-sequence in array
	$.each(CHARTS_DATA, function(i,v){
	
		var tmpChrtId = v.chartId;
	
		var dataSequence = $("#"+tmpChrtId+"_container").attr("data-sequence");
		v.chartSequence = dataSequence;

	});

	var postData = [];
	$(".chartContainer").each(function(i, v){

		var chartId = $(v).find('canvas').attr("id");
		var dbId = $(v).find('canvas').attr("data-dbid");
		var sequence = $(v).attr("data-sequence");
		
		var tmpDta = {"id":dbId,"chartId":chartId,"chartSequence":sequence};
		postData.push(tmpDta);

	});


	var loaderElmId = "saveChartOrderBttn";
	var preLoaderContent = $("#saveChartOrderBttn").html();
	showLoader(loaderElmId);

	setTimeout(function(){
		
		var path = 'companies/saveChartsOrder';

		var data = {"CHARTS_DATA":postData, "ChartTitle":newChartTitle};

		callAjax(data, path, function(response){

			var error = 0;
			var msg = '';
			var C = response.C;
			if(C == 100){
				//success msg
				error = 0;
				msg = 'Settings saved successfully.';	
			}else{
				//erro msg
				error = 1;
				msg = 'It seems something went wrong. Please try again later.';	
			}
			
			hideLoader(loaderElmId, preLoaderContent);
			showError(msg, error);

		});


	}, 500);

}

</script>

<div>
	<h1 id="chartsTitle" contenteditable="true">My Charts</h1>
	<div id="chartsMainContainer" class="chartsMainContainer"></div>
	<div id="actionContainer" class="actionContainer">
		<a id="saveChartOrderBttn" href="javascript:void(0);" class="float-end btn btn-primary" onclick="saveChartsOrder();">Save</a>
	</div>
</div>

<?php include("footer.php"); ?>