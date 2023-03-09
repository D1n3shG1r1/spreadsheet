<?php include("header.php");?>
<style>
	.tox-notification.tox-notification--in.tox-notification--warning {
		display: none !important;
	}
	.tox-statusbar__branding {
		display:none !important;
	}

	.noPageArea{

	}
	
	.pageAttributes{
		display:none;
	}

	#savePageButton{
		display:none;
	}

	#pageList .side--menu.active{
		text-decoration: underline;
		text-decoration-color: #0a58ca;
		text-decoration-thickness: 2px;
	}

	#pageList li{
		cursor: pointer;
	}

	#view_excel_kendo .k-spreadsheet-tabstrip, #view_excel_kendo .k-spreadsheet-quick-access-toolbar{
		display:none !important;
	}


	.xlsDropdown{
		width: 51.2%;
    float: left;
	}

	.xlsDropdownBttn{
		float: left;
    width: auto;
	}

</style>

<div class="">
	<div class="row m-0">
		<div class="col-lg-2 ps-0">
			<div id="leftPane" class="span2 sidebar">
				
				<ul id="pageList" class="pageList list-unstyled">
				<?php
						if(!empty($reports)){
							foreach($reports as $k => $rprt){
									$rprtId = $rprt["id"];	
									$cpnyId = $rprt["companyId"];	
									$pgTtl = $rprt["teaserTitle"];	
									$active = '';
									if ($k == 0) {
										$active = 'active';
									}
									echo '<li class="side--menu '.$active.'" onclick="openPageReport(\''.$rprtId.'\', this);">'.$pgTtl.'</li>';
							}
						}
					?>
					<li onclick="openPageModal();"><i class="fa fa-plus"></i>Add Page</li>
				</ul>
			</div>
		</div>
		<div class="col-lg-10">
			<div id="rightPane" class="right-panel">
				<div class="card box">
					<div class="card-body">
						<div class="noPageArea">You have no Teasure Report Yet!</div>
						<div class="pageAttributes" id="pageAttributes">
							<input type="text" id="pageTitle" class="form-control w-50 mb-2" placeholder="Enter Teaser Report Title" />
							<select id="portfolioCompany" name="portfolioCompany" class="form-control w-50 mb-2" required>
								<option value="">Select Company</option>
								<?php
									foreach ($companies as $key => $companyData) {

											$tmpCmpId = $companyData->id;
											$tmpCmpnyNm = $companyData->companyName;

											echo '<option value="'.$tmpCmpId.'">'.ucfirst($tmpCmpnyNm).'</option>';
									}
								?>
							</select>
							<div class="row">
								<div class="col-6 xlsDropdown">
									<select name="excel_report" id="excel_report" class="form-select mb-2">
										<option value="">Select Excel report</option>
										<?php
											foreach ($getExcelReports as $k => $report) {
												if ($report['new_excel_file']) {
													$file_name = $report['excel_new_file_name'];
													$file_path = $report['new_excel_file'];
												}else{
													$file_name = $report['excel_old_file_name'];
													$file_path = $report['old_excel_file'];
												}
												?>
												<option value="<?php echo $file_path ?>"><?php echo $file_name; ?></option>
												<?php
											}
										?>
									</select>
								</div>
								<div class="col-6 xlsDropdownBttn">
									<a href="#" id="view_excel_report" class="btn btn-primary disabled">View Excel Report</a>
								</div>
							</div>
							
							<div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i>Add Section</div>
							<div id="main-container" class="main-content my-3 teaser-report-main-container"></div>
							<a id="savePageButton" class="btn btn-primary float-end" href="javascript:void(0);" onclick="savePage();">Save & Export</a>
							
							<!---- Source Element  ---->
							<div class="all--data all-data-title d-none">
								<!---
								<figure data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i></figure>
								--->
								<div class="custom-dropdown text-secondary">
									<div class="row">
										<div class="col-lg-2 content--head">
										</div>
										<div class="col-lg-10 align-self-center">
											<div class="dropdown-content show">
												<div class="dropdown float-end">
													<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
														<i class="fa-solid fa-bars"></i>
													</button>
													<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<li><a class="dropdown-item" id="edit--div" href="javascript:void(0);" onclick="editMe(this);"><i class="fa fa-pen-to-square"></i> Edit</a></li>
														<li><a class="dropdown-item" id="delete--div" href="javascript:void(0);" onclick="removeMe(this,1);"><i class="fa fa-trash"></i> Delete</a></li>
														<li><a class="dropdown-item" id="duplicate--div" href="javascript:void(0);" onclick="duplicateMe(this);"><i class="fa fa-clone"></i> Duplicate</a></li>
														<li><a class="dropdown-item" id="add--space-bw-div" href="javascript:void(0);" onclick="addSpace(this);"><i class="fa fa-download"></i> Add Blank Space</a></li>
													</ul>
												</div> 
											</div>
										</div>
									</div>
								</div>
								<!---<figure onclick="removeMe(this,0);"><i class="fa fa-trash"></i></figure>--->
							</div>
							<!---- / Source Element  ---->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Section</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-6">
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Scip Comment" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa fa-comments" aria-hidden="true"></i><span> Scip comment</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Elevator Comment" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-users"></i><span> Elevator Comment</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Elevator Pitch" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-object-group"></i><span> Elevator pitch</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Bussiness Overview" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-chart-pie"></i><span> Bussiness overview</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Industry Overview" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-industry"></i><span> Industry overview</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Customer Pain Point" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-user-injured"></i><span>Customer pain point</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Service-Products-Technology" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-server"></i><span>Service/Products/Technology</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Traction Metrics" onclick="openElemntor(this);"  data-bs-dismiss="modal"> <i class="fa-solid fa-gauge-high"></i><span> Traction and other perfomance metrics</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Bussiness Modal" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-briefcase"></i><span>Bussiness Modal</span> </button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Revenue Modal" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-brain"></i><span>Revenue modal/Go-to-market strategy</span></button>
				
				<!-- <button class="btn btn-primary w-100 mb-2 font-type" data-font_type="img">Add an Image</button> -->
			</div>
			<div class="col-6">
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Financials" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-coins"></i><span>Financials</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Key Assumptions" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-key"></i><span> Key Assumptions</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Roadmap" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-road"></i><span>Roadmap</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Shareholder Pattern" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-chart-line"></i><span>Shareholder pattern</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Funding History" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-filter-circle-dollar"></i> <span>Funding history</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Ask & Fund Utilization" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-filter-circle-dollar"></i><span> Ask & Fund utilization</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Exit Strategy" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-door-open"></i><span> Exit strategy</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Company's Customer Pitch" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-users"></i><span> Your company's customer pitch</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Impact Of COVID" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-virus-covid"></i><span> Impact of COVID on demand near term & long term</span></button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="Teaser Document" onclick="openElemntor(this);"  data-bs-dismiss="modal"><i class="fa-solid fa-cube"></i><span>Teaser Document</span></button>
				
				<!--
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type = "document">Upload a Document</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type = "video">Video</button>
				-->
			</div>
		</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="text-editor" aria-labelledby="text-editorLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="">
	  	<textarea name="text-editor-content" id="text-editor-content"></textarea>
      </div>
	  <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		  <button type="button" class="btn btn-primary" id="save-tiny-val" onclick="saveMe(this);">Save</button>
		</div>
    </div>
</div>
</div>

<div class="modal fade" id="view_excel_modal" tabindex="-1" aria-labelledby="view_excel_modalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0" id="excel_kendo_body">
      </div>
    </div>
  </div>
</div>



<?php include("scripts.php");?>
</script>
<script src="<?php echo base_url("assets/tinymce/tinymce.min.js"); ?>" referrerpolicy="origin"></script>
<script src="<?php echo base_url("assets/kento/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/kendo.all.min.js"); ?>"></script>
<!---
<script src="<?php echo base_url()."assets/jspdf/jspdf.min.js";?>" type="text/javascript"></script>
--->


<script>
var TMP_REPORTID = 0;
var TMP_ATTCHARR = {};
var TMP_PrevATTCHFILES = [];
var FileCount = 0;
var TMP_FOLDERID = 0;

$(function(){

	initDrag();
	$(".side--menu.active").click();

			const options = {
			  margin: 1,
			  filename: 'codepen-test.pdf',
			  image: { 
			    type: 'jpeg', 
			    quality: 0.98 
			  },
			  html2canvas: { 
			    scale: 2 
			  },
			  jsPDF: { 
			    unit: 'in', 
			    format: 'letter', 
			    orientation: 'portrait' 
			  }
			}

			
});




$(document).ready(function(){	
	var _relode = 0;
	$(document).on('click', '.font-type', function(){
		/*
		var _this = $(this);
		var _text_dropdown = $(".all--data").clone();
		var count_div = $(".main-content .all-data-title").length;
		_text_dropdown.attr('data-div_len', count_div);
		_text_dropdown.removeClass('all--data d-none');
		_text_dropdown.addClass('div-main-'+count_div);
		var beforeText = _text_dropdown.find(".dropdown-content");
		var font_type = $(this).data('font_type');
		var font_type_text = $(this).text();
		var _font_val = jQuery('<'+font_type+'>', {
							id: 'some-id',
							class: 'dropbtn',
							title: 'Add Text to your '+font_type_text,
							text: font_type_text
						});
		var _data = $(_font_val).insertBefore(beforeText);
		_text_dropdown.appendTo(".main-content");
		$(".starting-btns").addClass('d-none');
		$("#exampleModal").modal('hide');
		_relode = 1;
		// debugger
		*/
	});

	/*
	$(document).on('click', "#delete--div", function(){
		$(this).parents(".all-data-title").remove();

		if($(".main-content").html() == '' || $(".main-content").html() == "\n\t\t\t\n\t"){
			$(".starting-btns").removeClass('d-none');
			_relode = 0;
		}
	});
	
	$(document).on('click', "#edit--div", function(){
		var _div_len = $(this).parents(".all-data-title").data("div_len");
		var s = $(this).parents(".all-data-title").find('#some-id').html(); 
		tinyMCE.activeEditor.setContent(s);
		// debugger
		$("#text-editor").modal('show');
		$("#text-editor").removeAttr("data-div_texts");
		$("#text-editor").attr('data-div_texts', 'div-main-'+_div_len);
	});

	$(document).on('click', '#save-tiny-val', function(){
		var div_text = $(this).parents("#text-editor").attr('data-div_texts');
		if (tinyMCE.get('text-editor-content').getContent() == '') {
			toastr.error("Please add Text...");
			return false;
		}
		$("."+div_text).find("#some-id").html(tinyMCE.get('text-editor-content').getContent());
		$(this).parents("#text-editor").modal('hide');
	});

	$(document).on('click', "#duplicate--div", function(){
		var _text_dropdown = $(this).parents('.all-data-title').clone();
		var count_div = $(".main-content .all-data-title").length;
		_text_dropdown.attr('data-div_len', count_div);
		_text_dropdown.removeAttr('class');
		_text_dropdown.addClass('all-data-title div-main-'+count_div);
		$(this).parents('.all-data-title').after(_text_dropdown);
	});

	$(document).on('click', '#add--space-bw-div', function(){
		$(this).parents('.all-data-title').after('<br>');
	});
*/

	document.addEventListener('focusin', function (e) { 
		if (e.target.closest('.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root') !== null) { 
			e.stopImmediatePropagation();
		} 
	});

	tinymce.init({
		selector:'textarea',
		plugins: 'anchor autolink charmap codesample emoticons image code link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
      	toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough emoticons | link image media table mergetags code | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | charmap | removeformat',
		setup: function(editor) {
			editor.on('init', function() {
			});
		},
		/* enable title field in the Image dialog*/
		image_title: true,
		/* enable automatic uploads of images represented by blob or data URIs*/
		automatic_uploads: true,
		/*
			URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
			images_upload_url: 'postAcceptor.php',
			here we add custom filepicker only to Image dialog
		*/
		file_picker_types: 'image',
		/* and here's our custom image picker*/
		file_picker_callback: function (cb, value, meta) {
			var input = document.createElement('input');
			input.setAttribute('type', 'file');
			input.setAttribute('accept', 'image/*');

			/*
			Note: In modern browsers input[type="file"] is functional without
			even adding it to the DOM, but that might not be the case in some older
			or quirky browsers like IE, so you might want to add it to the DOM
			just in case, and visually hide it. And do not forget do remove it
			once you do not need it anymore.
			*/

			input.onchange = function () {
			var file = this.files[0];

			var reader = new FileReader();
			reader.onload = function () {
				/*
				Note: Now we need to register the blob in TinyMCEs image blob
				registry. In the next release this part hopefully won't be
				necessary, as we are looking to handle it internally.
				*/
				var id = 'blobid' + (new Date()).getTime();
				var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
				var base64 = reader.result.split(',')[1];
				var blobInfo = blobCache.create(id, file, base64);
				blobCache.add(blobInfo);

				/* call the callback and populate the Title field with the file name */
				cb(blobInfo.blobUri(), { title: file.name });
			};
			reader.readAsDataURL(file);
			};

			input.click();
		}
	});
	window.onbeforeunload = function() {
		if (_relode != 0) {
			return "Data will be lost if you leave the page, are you sure?";
		}
	};
});



	function openElemntor(obj){
		
			var dataElementType = $(obj).attr("data-element-type");
			
			console.log("dataElementType");
			console.log(dataElementType);

			var _this = $(obj);
			var _text_dropdown = $(".all--data").clone();
			var count_div = $(".main-content .all-data-title").length;
			_text_dropdown.attr('data-div_len', count_div);
			_text_dropdown.removeClass('all--data d-none');
			_text_dropdown.addClass('div-main-'+count_div);

			if(dataElementType == "Teaser Document"){
			
				_text_dropdown.attr('id','documentSection');
			}

			var beforeText = _text_dropdown.find(".dropdown-content");
			var content__head = _text_dropdown.find(".content--head");
			content__head.empty();
			var font_type = $(obj).data('font_type');
			var font_type_text = $(obj).text();
			var main_comment_head  = $(obj).html();
			
			var textContentHolder = $('<div>', {
			    class: 'textContentHolder'
			});

			var _font_val = jQuery('<p>', {
								id: 'some-id',
								class: 'dropbtn',
								title: 'Add Text to your '+font_type_text,
								text: font_type_text
							});



			if(dataElementType == "Teaser Document"){
				
				//var secLen = $("#main-container #documentSection").length;
				var secLen = $("#documentSection").length;
				
				if(secLen == 0){
					$(main_comment_head).appendTo(content__head);
					var _data = $(textContentHolder).insertBefore(beforeText);
					//var _data = $(_font_val).appendTo(textContentHolder);
					//_text_dropdown.appendTo(".main-content");
					$(".main-content").after(_text_dropdown);
				
					
					var upldSecInnrHtml = `<span id="AddNewFile" class="attachSpan"><a href="javascript:void(0);" onclick="upload();"><i class="fa-solid fa-file-arrow-up"></i>Upload File</a>
						<span class="fileNameSpan">Only 5 files can be upload.</span>
					<input type="file" id="fileupload" style="opacity:0; height:1px; width:1px;" onchange="fileUpload(event);" accept=".csv,.doc,.docx,.odp,.ods,.odt,.pdf,.ppt,.pptx,.rtf,.txt,.xls,.xlsx"/></span>`;

					//$("#main-container #documentSection .textContentHolder").html(upldSecInnrHtml);
					$("#documentSection .textContentHolder").html(upldSecInnrHtml);

					//--- remove options
					$("#documentSection .custom-dropdown .row .dropdown-content.show").remove();

				}

			}else{
				
				$(main_comment_head).appendTo(content__head);
				
				var _data = $(textContentHolder).insertBefore(beforeText);
				
				var _data = $(_font_val).appendTo(textContentHolder);
				
				_text_dropdown.appendTo(".main-content");
			
			}

			$(".starting-btns").addClass('d-none');
			// debugger
			$("#exampleModal").modal('hide');
			_relode = 1;


			var hasData = $("#main-container").html();
			if(hasData != null && hasData != ""){
				$("#savePageButton").show();
			}

	}

 
  function initDrag() {

		$( ".main-content").sortable({
			connectWith: ".main-content",
			stack: '.main-content .all-data-title'
		}).disableSelection();
	}

	function removeMe(obj,c){
		if(c == 0){
			$(obj).parent().remove();		
		}else{
			$(obj).parents(".all-data-title").remove();
		}


		if($(".main-content").html() == '' || $(".main-content").html() == "\n\t\t\t\n\t"){
			$(".starting-btns").removeClass('d-none');
			_relode = 0;
		}
		

		//documentSection

		var attrId = $(obj).parents(".all-data-title").attr('id');
		if (typeof attrId !== 'undefined' && attrId !== false && attrId == "documentSection") {
		  //--- reset TMP_ATTCHARR & FileCount
		  TMP_ATTCHARR = {};
		  FileCount = 0;
		}

	}

	function editMe(obj){
		var _div_len = $(obj).parents(".all-data-title").data("div_len");
		var s = $(obj).parents(".all-data-title").find('.textContentHolder').html(); 
		tinyMCE.activeEditor.setContent(s);
		// debugger
		$("#text-editor").modal('show');
		$("#text-editor").removeAttr("data-div_texts");
		$("#text-editor").attr('data-div_texts', 'div-main-'+_div_len);
	}


	function addSpace(obj){
		$(obj).parents('.all-data-title').after('<br>');
	}

	function saveMe(obj){
		var div_text = $(obj).parents("#text-editor").attr('data-div_texts');
		if (tinyMCE.get('text-editor-content').getContent() == '') {
			toastr.error("Please add Text...");
			return false;
		}
		$("."+div_text).find("#some-id").html(tinyMCE.get('text-editor-content').getContent());
		$(obj).parents("#text-editor").modal('hide');
	}

	function duplicateMe(obj){
		var _text_dropdown = $(obj).parents('.all-data-title').clone();
		var count_div = $(".main-content .all-data-title").length;
		_text_dropdown.attr('data-div_len', count_div);
		_text_dropdown.removeAttr('class');
		_text_dropdown.addClass('all-data-title div-main-'+count_div);
		$(obj).parents('.all-data-title').after(_text_dropdown);
	}

	
	function openPageModal(){
		TMP_REPORTID = 0;
		$(".side--menu").removeClass('active');
		$(".noPageArea").hide();
		$(".pageAttributes").show();
		$("#savePageButton").hide();
		$("#pageTitle").val("");
		$("#portfolioCompany").val("");
		$("#main-container").html("");
	}

	function savePage(){
		
		var msg = "";
		var pageHtml = $("#main-container");
		var pageTitle = $("#pageTitle").val();
		var portfolioCompany = $("#portfolioCompany").val();
		//var textContentHolderArr = $("#main-container .all-data-title");
		var textContentHolderArr = $("#main-container .all-data-title .textContentHolder");
		var titleContentHolderArr = $("#main-container .all-data-title .content--head");
		
		var mainArr = [];
		
		
		$(titleContentHolderArr).each(function(idx, vl){
			
			var tmpHtm = textContentHolderArr[idx];
			
			var tmparr = {};
			tmparr["title"] = vl.innerHTML;
			tmparr["html"] = tmpHtm.innerHTML;
			mainArr.push(tmparr);
			// debugger
			//paheHtmlArr.push($(vl).html());
		});

		if(pageTitle == ""){
			msg = "please enter the page title";
			showError(msg, 1);
			return false;
		}else if(portfolioCompany == ''){
			msg = 'Please Select Company!';
			showError(msg, 1);
			return false;
		}else if(mainArr.length == 0){
			msg = "please fill the page content";
			showError(msg, 1);
			return false;
		}else{
			


			var loaderElmId = "savePageButton";
			var preLoaderContent = $("#savePageButton").html();
			showLoader(loaderElmId);

			setTimeout(function(){

				//TMP_REPORTID TMP_FOLDERID

				var data = {"pageTitle":pageTitle, "portfolioCompany": portfolioCompany, "pageHtml":mainArr, "teaserId":TMP_REPORTID, "attachments":TMP_ATTCHARR, "folderId":TMP_FOLDERID, "PrevATTCHFILES":TMP_PrevATTCHFILES};
				
				var path = "companies/saveTeaserReport";
				
				callAjax(data, path, function(resp){
					
					var code = resp.C;
	        var response = resp.R;
					
					if(code == 100){
						if (TMP_REPORTID > 0) {
							//toastr.success('Report Updated Successfully!');
							var msg = 'Report Updated Successfully!';
							showError(msg, 0);
						}else {
							//toastr.success('Report Saved Successfully!');
							var msg = 'Report Saved Successfully!';
							showError(msg, 0);
						}
						
						exportAsPdf("main-container", pageTitle);

						setTimeout(function(){
							window.location.href = window.location.href;
						}, 1000);
					}else{
						//toastr.error('Something went wrong...');
						var msg = 'Something went wrong...';
						showError(msg, 1);
					}

					hideLoader(loaderElmId, preLoaderContent);

				});
			
			}, 1000);

		}
	}

	function exportAsPdf(divId, title){
		const options = {
		  margin: 1,
		  filename: title+'.pdf',
		  image: { 
		    type: 'jpeg', 
		    quality: 0.98 
		  },
		  html2canvas: { 
		    scale: 2 
		  },
		  jsPDF: { 
		    unit: 'in', 
		    format: 'letter', 
		    orientation: 'portrait' 
		  }
		}
  
		var element = document.getElementById('main-container');
		$(element).find(".dropdown-content").remove();		
		$(element).find("figure").remove();
			  
		var allDataTitles = $(element).find(".all-data-title");
		var pageTitleHtml = '<h3 style="text-align: center;">'+title+'</h3>';

		$(allDataTitles[0]).before(pageTitleHtml);

		html2pdf().from(element).set(options).save();
			
	}

	function openPageReport(reportId, _this){
		
		TMP_REPORTID = reportId;
		var data = {"reportId":reportId};
		var path = "companies/teaserReportDetail";
		$(".side--menu").removeClass('active');
		_this.classList.add("active");
		callAjax(data, path, function(resp){
			if(resp.C == 100){
				
				var result = resp.R;
				var companyId = result["companyId"];
				var id = result["id"];
				var pageTitle = result["teaserTitle"];
				var pageHtml = result["pageHtml"];
				var files = result["files"];
				
				var userId = result["user_id"];

				$("#pageTitle").val(pageTitle);
				$("#portfolioCompany").val(companyId);
				$("#main-container").empty();
				//textContentHolder
				var tmpHtml = "";
				$.each(pageHtml, function(idx, vl){
					
					var _text_dropdown = $(".all--data").clone();
					_text_dropdown.attr('data-div_len', idx);
					_text_dropdown.removeClass('all--data d-none');
					_text_dropdown.addClass('div-main-'+idx);
					var beforeText = _text_dropdown.find(".dropdown-content");
					var content__head = _text_dropdown.find(".content--head");
					content__head.empty();
					
					var font_type_text = vl.title;
					var main_comment_head  = vl.html;

					var textContentHolder = $('<div>', {
						class: 'textContentHolder'
					});

					content__head.append(font_type_text);
					textContentHolder.insertBefore(beforeText);
					$(main_comment_head).appendTo(textContentHolder);
					_text_dropdown.appendTo(".main-content");
				});

				
				setTimeout(function(){

					if(files.length > 0){
						
						var siteUrl = '<?php echo base_url("user_assets"); ?>';

						var filesHtml = `<div class="all-data-title div-main-3" data-div_len="3" id="documentSection">
								<div class="custom-dropdown text-secondary">
									<div class="row">
										<div class="col-lg-2 content--head">
											<i class="fa-solid fa-cube"></i>
											<span>Teaser Document</span>
										</div>
										<div class="col-lg-10 align-self-center">
											<div class="textContentHolder">
												<span id="AddNewFile" class="attachSpan" style="display: none;"><a href="javascript:void(0);" onclick="upload();"><i class="fa-solid fa-file-arrow-up"></i>Upload File</a>
													<span class="fileNameSpan">Only 5 files can be upload.</span>
													<input type="file" id="fileupload" style="opacity:0; height:1px; width:1px;" onchange="fileUpload(event);" accept=".csv,.doc,.docx,.odp,.ods,.odt,.pdf,.ppt,.pptx,.rtf,.txt,.xls,.xlsx"/></span>`;


						$.each(files, function(fIdx,fVal){

							var fValParts = fVal.split("_");
							var tmpFolderId = fValParts[0];
							var tmpFileId = fValParts[1];
							var tmpFileName = fValParts[2];
							var tmpId = getUniqeId(0);
							TMP_FOLDERID = tmpFolderId;

							var tmpFlUrl = siteUrl +'/'+tmpFolderId+'/'+tmpFileId+'_'+tmpFileName;

							var tmpFileNameParts = tmpFileName.split(".");
							var tmpFlXt = tmpFileNameParts[tmpFileNameParts.length - 1];
							var fileIcon = ICONS_ARR[tmpFlXt];

							TMP_PrevATTCHFILES.push(fVal);

							filesHtml += `<span class="attachSpan" id="`+tmpId+`_attch">\
							<a class="ImageDotBttn" href="javascript:void(0);" onclick="showHideImgOpt(\'`+tmpId+`_attch\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Options"><i class="fa-solid fa-ellipsis-vertical"></i></a>\
				<ul class="ImagedotMenu">\
					<li>\
						<a href="`+tmpFlUrl+`" download id="`+tmpId+`_attchDwnld" class="removeAttachFile"><i class="fa fa-download" aria-hidden="true"></i></a>\
					</li>\
					<li>\
					<a href="JavaScript:void(0);" id="'+attchClsId+'" class="removeAttachFile" onclick="removeAttcment('`+tmpId+`');" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>\
					</li>\
				</ul>\
					<a href="javascript:void(0);">`+fileIcon+tmpFileName+`</a>\
					<!---<progress class="progressBar" value="100" max="100" style="width:80%;"></progress>--->\
						<!---<span class="fileNameSpan">`+tmpFileName+`</span>---></span>`;

							FileCount++;

						});

						filesHtml += `</div>
										</div>
									</div>
								</div>
								<!---<figure onclick="removeMe(this,0);"><i class="fa fa-trash"></i></figure>--->
							</div>`;
					

							$(".main-content").after(filesHtml);

							/*
							if(FileCount >= 5){
								$("#AddNewFile").hide();
							}else{
								$("#AddNewFile").show();
							}
							*/
					}

					// $("#main-container").html(tmpHtml);
				
					$(".noPageArea").hide();
					$("#pageAttributes").show();
					$("#savePageButton").show();
				}, 100);
			}
		});
	}

	function getUniqeId(isNow){
		var length = 22;
		var result = '';
		var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }

    return result;

    /*
		
		var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();
		
		if(isNow != undefined && isNow == 1){
				return Date.now();
		}else{

				console.log("timeStampInMs1:"+timeStampInMs);
				
				var regx = /\./g;
				timeStampInMs = timeStampInMs.toString();
				console.log("timeStampInMs2:"+timeStampInMs);

				timeStampInMs = timeStampInMs.replace(regx,'');
				console.log("timeStampInMs3:"+timeStampInMs);
				return timeStampInMs;
		}
		
		*/
	}	

	function upload(){
		if(FileCount >= 5){
			toastr.error('Max 5 files are allowed to be upload.');	
		}else{
			$('#fileupload').val('');
			$("#fileupload").trigger("click");	
		}
		
	}
	
	function fileUpload(event){
		
		var files = event.target.files;
		
		var fileIdx = 0;
		for (var i = 0; i <= files.length-1; i++) {
			
			var file = files[fileIdx];
			var fileName = file.name;
			var fileSize = file.size;
			var fileType = file.type;

			var tmpId = getUniqeId(0);
			var prgId = tmpId+"_attch";
			var attchClsId = tmpId+"_attchClose";
			var progressBarHtml = '<span class="attachSpan" id="'+prgId+'" >\
			<a class="ImageDotBttn" href="javascript:void(0);" onclick="showHideImgOpt(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Options"><i class="fa-solid fa-ellipsis-vertical"></i></a>\
				<ul class="ImagedotMenu">\
					<li>\
						<a href="JavaScript:void(0);" id="'+attchClsId+'" class="removeAttachFile" onclick="removeAttcment(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>\
					</li>\
				</ul>\
			<progress class="progressBar" value="0" max="100" style="width:80%;"></progress>\
			<span class="fileNameSpan">'+fileName+'</span></span>';
			//$('#main-container #documentSection .textContentHolder').append(progressBarHtml);
			$('#documentSection .textContentHolder').prepend(progressBarHtml);

			//setTimeout(function(){

					var reader = new FileReader(); // Creating reader instance from FileReader() API

					reader.onload = function (event) {
						 //demoImage.src = reader.result;
						 var fileBs64Data = reader.result;
						 var percent = (event.loaded / event.total) * 100;
					   $("#"+prgId+" .progressBar").val(Math.round(percent));

						TMP_ATTCHARR[prgId] = {"fileName":fileName, "fileSize":fileSize, "fileType":fileType, "fileBs64Data":fileBs64Data};
					}


					reader.readAsDataURL(file);

				//},100);
			
			fileIdx++;
			FileCount++;
			console.log("FileCount:" + FileCount);

			if(FileCount >= 5){
				$("#AddNewFile").hide();
			}
		}

	}

	function removeAttcment(attchClsId){

		var attchClsIdprts =  attchClsId.split("_");
		var arrKy  = attchClsIdprts[0] + "_attch";

		$("#"+arrKy).remove();

		//TMP_ATTCHARR.splice(arrKy, 1);

		delete TMP_ATTCHARR[arrKy];
		
		FileCount--;
		
		if(FileCount < 5){
			$("#AddNewFile").show();
		}

		console.log('TMP_ATTCHARR');
		console.log(TMP_ATTCHARR);
	}
	
	function removeFile(obj){
		$(obj).parent().remove();
	}

	function showHideImgOpt(prgId){

		$("#"+prgId+" .ImagedotMenu").toggle();
	}




	//View Excel Report
	$(document).on('change', "#excel_report", function(){
		// debugger
		if($(this).val() !== ""){
			$("#view_excel_report").removeClass('disabled');
		}else {
			$("#view_excel_report").addClass('disabled');
		}
	})

	$(document).on('click', '#view_excel_report', function(e){
		e.preventDefault();
		var excel_path = "<?php echo base_url("company_assets"); ?>";
		var excel_report_path = $("#excel_report").val();
		var full_excel_path = excel_path+'/'+excel_report_path;
		var exportExcelToFolderPath = "companies/SaveUpdatedExcelSheetToFolder"; 
		$("#excel_kendo_body").empty();

		$('<div>', {
			id: 'view_excel_kendo',
			class: 'w-100'
		}).appendTo('#excel_kendo_body');

		$("#view_excel_kendo").kendoSpreadsheet({
			excel: {
				proxyURL: "<?php echo custom_siteurl(); ?>"+exportExcelToFolderPath
			}
		});
		var spreadsheet = $("#view_excel_kendo").data("kendoSpreadsheet");

		var oReq = new XMLHttpRequest();
		oReq.open('get', full_excel_path, true);
		oReq.responseType = 'blob';
		oReq.onload = function () {
			var blob = oReq.response;
			var workbook = new kendo.spreadsheet.Workbook({});
			// debugger
			workbook.fromFile(blob).then(function(){
				jsonContent = workbook.toJSON();
				spreadsheet.fromJSON(jsonContent);
			});
		};
		oReq.send(null);
		$("#view_excel_modal").modal("show");
	});

</script>

<?php include("footer.php");?>
