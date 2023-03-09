<?php include("header.php");?>

<style>
	
	#main-container-holder{
		width: 100%;
		float: left;
	}

	#main-container .rightPanel{
		width: 40%;
		float: left;
	} 
	
	#main-container .leftPanel{
		width: 60%;
		float: left;
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


#portfolioCompany{ margin-top: 8px; }

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
									$pgTtl = $rprt["pageTitle"];	
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
						<div id="noPageArea" class="noPageArea">You have no page yet</div>
						<div class="pageAttributes" id="pageAttributes">
							<input type="text" id="pageTitle" class="form-control w-50" placeholder="Enter page title" /> 
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
										<option value="" disabled selected>View Excel report</option>
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
							<div class="mt-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i>Add Section</div>
							
							<div id="main-container-holder" class="zipzum-main-container-holder">
								<!---<div id="main-container" class="main-content mt-3"></div>--->
							</div>

							<a id="savePageButton" class="btn btn-primary float-end" href="javascript:void(0);" onclick="savePage();">Save & Export</a>

							<!---- Source Element  ---->
							<div class="all--data all-data-title d-none">
								<!---
								<figure data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i></figure>
								--->
								<div class="custom-dropdown text-secondary">
									
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
								
								<!---<div onclick="removeMe(this,0);"><i class="fa fa-trash"></i></div>--->
							</div>
							<!---- / Source Element  ---->
					</div>
				</div>
		</div>
	</div>		
</div>
		
		
	


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog"><<<<<<< HEAD
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Text Format</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-6">
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="h1" data-element-type="h1" onclick="openElemntor(this);" data-bs-dismiss="modal">Heading 1</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="h2" data-element-type="h2" onclick="openElemntor(this);" data-bs-dismiss="modal">Heading 2</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="h3" data-element-type="h3" onclick="openElemntor(this);" data-bs-dismiss="modal">Heading 3</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type="p" data-element-type="p" onclick="openElemntor(this);" data-bs-dismiss="modal">Add Text</button>
				<!-- <button class="btn btn-primary w-100 mb-2 font-type" data-font_type="img">Add an Image</button> -->
			</div>
			<div class="col-6">
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type = "h4" data-element-type="h4" onclick="openElemntor(this);" data-bs-dismiss="modal">Sub Heading 1</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type = "h5" data-element-type="h5" onclick="openElemntor(this);" data-bs-dismiss="modal">Sub Heading 2</button>
				<button class="btn btn-primary w-100 mb-2 font-type" data-font_type = "h6" data-element-type="h6" onclick="openElemntor(this);" data-bs-dismiss="modal">Sub Heading 3</button>
				<button class="btn btn-primary w-100 mb-2 font-type"<<<<<<< HEAD data-font_type = "image" data-element-type="image" onclick="openElemntor(this);" data-bs-dismiss="modal">Upload Image</button>
				<!--
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


<!---- upload Modal ---->
<div class="modal fade" id="imageUploadModal" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Upload Image</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<ul class="uploadContainer">
				<li>
					<a class="btn btn-primary" href="javascript:void(0);" onclick="upload();">Computer</a>
					<input type="file" id="fileupload" style="opacity:0; height:1px; width:1px;" onchange="fileUpload(event);" accept=".png,.jpg,.jpeg"/>
				</li>
				<li>
					<label class="orLbl">OR</label>	
				</li>
				<li>
					<span>
						<input type="text" id="imageUrlInput" placeholder="Paste the image url">
						<a class="btn btn-primary" id="imageUrlUpldBttn" href="javascript:void(0);" onclick="uploadFromUrl();">Go</a>
					</span>

				</li>
			</ul>	
		</div>
    </div>

</div>
</div>



<!---/- upload Modal ---->

<!---- Crop Modal --->

<div class="modal fade" id="cropBox" aria-labelledby="cropBoxModalLabel" aria-hidden="true">
  <div class="modal-dialog cropBox">
    <div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">Crop</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		<div class="row imagesContainer">
			<div class="col-6">
				<div class="left-cropper">
					<div class="left">
						<img src="" />
					</div>
					<a id="cropBoxCropBttn" class="btn btn-primary" href="javascript:void(0);" >Crop</a>
				</div>
			</div>
			<div class="col-6">
				<div class="right img-result d-none">
					<img src="" class="cropped" width="100%" />
				</div>
			</div>

		</div>
		</div>
    </div>

</div>
</div>

<!---/- Crop Modal --->

<!--- Template type modal full-page or half-page --->

<div class="modal fade" id="templateOptionModal" tabindex="-1" aria-labelledby="templateOptionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="templateOptionModalLabel">Layout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span>
	        <input type="radio" id="fullPageOpt" name="templateType" value="0" onclick="setTemplateType('fullPageOpt');"/>
	        <label for="fullPageOpt" data-bs-toggle="tooltip" data-bs-placement="right" title="Text and image in same column">One Column</label>
	      </span>
	      <span>
	        <input type="radio" id="halfPageOpt" name="templateType" value="1" onclick="setTemplateType('halfPageOpt');"/>
	        <label for="halfPageOpt" data-bs-toggle="tooltip" data-bs-placement="right" title="Text in first column and images in second column">Two Column</label>
	      </span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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


<!---/- Template type modal full-page or half-page --->



<?php include("scripts.php");?>
<script src="<?php echo base_url("assets/tinymce/tinymce.min.js"); ?>" referrerpolicy="origin"></script>

<!---- Cropper Js Plugins ---->
<script src="<?php echo base_url("assets/cropper-js/cropper.min.js"); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="<?php echo base_url("assets/cropper-js/cropper.css"); ?>" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="<?php echo base_url("assets/cropper-js/cropper.js"); ?>" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" href="<?php echo base_url("assets/cropper-js/cropper.min.css"); ?>" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="<?php echo base_url("assets/kento/jszip.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/kento/kendo.all.min.js"); ?>"></script>
<!---/- Cropper Js Plugins ---->

<script>

var TMP_REPORTID = 0;
var TMP_ATTCHARR = {};
var TMP_PrevATTCHFILES = [];
var FileCount = 0;
var TMP_FOLDERID = 0;
var TMP_CROPPER = null;
var TMP_TEMPLATE_TYPE = 0;

$(function(){

	initDrag();
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

			//console.log("dataElementType");
			//console.log(dataElementType);
		
			var _this = $(obj);
			var _text_dropdown = $(".all--data").clone();
			var count_div = $(".main-content .all-data-title").length;
			_text_dropdown.attr('data-div_len', count_div);
			_text_dropdown.removeClass('all--data d-none');
			_text_dropdown.addClass('div-main-'+count_div);

			if(dataElementType == "image"){
			
				_text_dropdown.attr('id','imageSection');
			}

			var beforeText = _text_dropdown.find(".dropdown-content");
			var font_type = $(obj).data('font_type');
			var font_type_text = $(obj).text();

			var textContentHolder = $('<div>', {
			    class: 'textContentHolder'
			});

			var _font_val = jQuery('<'+font_type+'>', {
								id: 'some-id',
								class: 'dropbtn',
								title: 'Add Text to your '+font_type_text,
								text: font_type_text
							});

			
			if(dataElementType == "image"){
				//--- image
				
				//var secLen = $("#main-container #documentSection").length;
				var secLen = $("#imageSection").length;
				
				if(secLen == 0){
					
					var _data = $(textContentHolder).insertBefore(beforeText);
				
					//var _data = $(_font_val).appendTo(textContentHolder);	

					
				
					if(TMP_TEMPLATE_TYPE == 1){
						//_text_dropdown.appendTo(".main-content .rightPanel");
						$(".main-content .rightPanel").html(_text_dropdown);
					}else{
						$(".main-content").after(_text_dropdown);
					}

					
					var upldSecInnrHtml = `<span id="AddNewFile" class="attachSpan"><a class="btnn btn-primaryy" href="javascript:void(0);"type="button" data-bs-toggle="modal" data-bs-target="#imageUploadModal"><i class="fa fa-picture-o" aria-hidden="true"></i>Add Image</a>
						<span class="fileNameSpan">Only 5 images can be upload.</span>

					</span>`;

					$("#imageSection .textContentHolder").html(upldSecInnrHtml);

					//--- remove options
					$("#imageSection .custom-dropdown .row .dropdown-content.show").remove();

				}

			}else{
				//--- non attachment
				var _data = $(textContentHolder).insertBefore(beforeText);
				var _data = $(_font_val).appendTo(textContentHolder);
				


				if(TMP_TEMPLATE_TYPE == 1){
					_text_dropdown.appendTo(".main-content .leftPanel");
				}else{
					_text_dropdown.appendTo(".main-content");	
				}


			}
			
			$(".starting-btns").addClass('d-none');
			$("#exampleModal").modal('hide');
			_relode = 1;

			var hasData = $("#main-container").html();
			if(hasData != null && hasData != ""){
				$("#savePageButton").show();
			}
	}


  function initDrag() {


  	if(TMP_TEMPLATE_TYPE == 1){
  		
  		$(".main-content .leftPanel").sortable({
				connectWith: ".main-content .leftPanel",
				stack: '.main-content .leftPanel .all-data-title'
			}).disableSelection();
  		
  		$(".main-content .rightPanel .custom-dropdown .textContentHolder").sortable({
				connectWith: ".main-content .rightPanel .custom-dropdown .textContentHolder",
				stack: ".main-content .rightPanel .custom-dropdown .textContentHolder .attachSpan"
			}).disableSelection();

  	}else{
  		$(".main-content").sortable({
				connectWith: ".main-content",
				stack: '.main-content .all-data-title'
			}).disableSelection();	
  	}
		
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
		
	}

	function editMe(obj){
		var _div_len = $(obj).parents(".all-data-title").data("div_len");
		var s = $(obj).parents(".all-data-title").find('#some-id').html(); 
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

		//ask for template type i.e full page or half page
		$("#templateOptionModal").modal("show");

		TMP_REPORTID = 0;
		$(".noPageArea").hide();
		$(".pageAttributes").show();
		$("#savePageButton").hide();
		$("#pageTitle").val("");
		$("#main-container").html("");

}

function setTemplateType(id){

	if($("#"+id).is(":checked")){
		var typ = $("#"+id).val();
		TMP_TEMPLATE_TYPE = typ;
	
	}

	if(TMP_TEMPLATE_TYPE == 0){
		
		//<div id="main-container" class="main-content mt-3"></div>
		var htmlStr = '<div id="main-container" class="main-content mt-3"></div>';
	
	}else{
		
		//<div id="main-container" class="main-content mt-3"></div>		
		var htmlStr = `<div id="main-container" class="main-content mt-3">
		<div class="leftPanel"></div>
		<div class="rightPanel"></div>
		</div>`;
	
	}
	
	$("#main-container-holder").html(htmlStr);

	setTimeout(function(){
		initDrag();
	},500);
	
}


	function savePage(){
		
		var msg = "";
		var pageHtml = $("#main-container");
		var pageTitle = $("#pageTitle").val();
		var paheHtmlArr = [];
		var paheHtmlArr_1 = [];
		var paheHtmlArr_2 = [];
		//var textContentHolderArr = $("#main-container .all-data-title");
		
		if(TMP_TEMPLATE_TYPE == 0){
			
			var textContentHolderArr = $("#main-container .all-data-title .textContentHolder");
			
			$(textContentHolderArr).each(function(idx, vl){
			
					paheHtmlArr_1.push($(vl).html());
			});

		}else{


			var textContentHolderArr = $("#main-container .leftPanel .all-data-title .textContentHolder");
			var textContentHolderArr_2 = $("#main-container .rightPanel .all-data-title .textContentHolder");
		
			$(textContentHolderArr).each(function(idx, vl){
		
				paheHtmlArr_1.push($(vl).html());
			});

			$(textContentHolderArr_2).each(function(idx, vl){
		
				paheHtmlArr_2.push($(vl).html());
			});

		}

		paheHtmlArr.push(paheHtmlArr_1);
		paheHtmlArr.push(paheHtmlArr_2);


		// setTimeout(function(){
		// 	console.log("paheHtmlArr:");
		// 	console.log(paheHtmlArr);

		// },100);

		

		if(pageTitle == ""){
			msg = "please enter the page title";
			showError(msg, 1);
			return false;
		}else if(paheHtmlArr.length == 0){
			msg = "please fill the page content";
			showError(msg, 1);
			return false;
		}else{

			var loaderElmId = "savePageButton";
			var preLoaderContent = $("#savePageButton").html();
			showLoader(loaderElmId);

			setTimeout(function(){
				
				var data = {"pageTitle":pageTitle, "pageHtml":paheHtmlArr, "pageId":TMP_REPORTID, "columnType":TMP_TEMPLATE_TYPE};
				var path = "companies/saveZipzumReport";

				callAjax(data, path, function(resp){

						if(resp.C == 100){
							
							msg = "Zipzum page saved successfully";
							toastr.success(msg);

							exportAsPdf("main-container", pageTitle);
								
							setTimeout(function(){
								//location.reload();
								window.location.href = window.location.href;	
								
							},1000);		
							

						}else{
							
							msg = "Please try again";
							toastr.error(msg);
						}

						hideLoader(loaderElmId, preLoaderContent);

				});
			
			}, 1000);

		}

	}

	
	function exportAsPdf(divId, title){
		const options = {
		  margin: [0.5,1,0.5,1],
		  filename: title+'.pdf',
		  image: { 
		    type: 'jpeg', 
		    quality: 0.98 
		  },
		  html2canvas: { 
		    scale: 2,
		    dpi: 192,
		    letterRendering: true,
		    useCORS: true
			},
		  jsPDF: { 
		    unit: 'pt',
		    format: 'A4',
		    orientation: 'portrait',
		    autosize : false
		  }
		}
  
		var element = document.getElementById('main-container');
		$(element).find(".dropdown-content").remove();		
		$(element).find("figure").remove();
			  
		
		var pageTitleHtml = '<h3 class="tmpReportTitle" style="width:100%; float:left; text-align: center;">'+title+'</h3>';
		if(TMP_TEMPLATE_TYPE == 0){

			//var htmlStr = '<div id="main-container" class="main-content mt-3"></div>';
			var allDataTitles = $(element).find(".all-data-title");
			$(allDataTitles[0]).before(pageTitleHtml);
		}else{
			
			$("#main-container .leftPanel").before(pageTitleHtml);
		}

		html2pdf().from(element).set(options).save();
			
	}


	function openPageReport(reportId, _this){
		
		TMP_REPORTID = reportId;
		var data = {"reportId":reportId};
		var path = "companies/zipzumReportDetail";
		$(".side--menu").removeClass('active');
		_this.classList.add("active");
		callAjax(data, path, function(resp){

				if(resp.C == 100){
					
					var result = resp.R;

						var companyId = result["companyId"];
						var id = result["id"];
						var pageTitle = result["pageTitle"];
						var pageHtml = result["pageHtml"];
						var userId = result["user_id"];
						TMP_TEMPLATE_TYPE = result["columnType"];

						$("#pageTitle").val(pageTitle);

						//textContentHolder
						
						var tmpHtml = "";
						var tmpHtml2 = "";

						if(TMP_TEMPLATE_TYPE == 1){
							
							//double coulmn
							
							$.each(pageHtml[0], function(idx, vl){
								
								tmpHtml += `<div class="all-data-title div-main-`+idx+`" data-div_len="`+idx+`">
															<div class="custom-dropdown text-secondary">
																<div class="textContentHolder">`+vl+`</div>
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
															<!---<figure onclick="removeMe(this,0);"><i class="fa fa-trash"></i></figure>--->
															</div>`;

							});

							$.each(pageHtml[1], function(idx, vl){
								
								tmpHtml2 += `<div class="all-data-title div-main-`+idx+`" data-div_len="`+idx+`">
															<div class="custom-dropdown text-secondary">
																<div class="textContentHolder">`+vl+`</div>
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
															<!---<figure onclick="removeMe(this,0);"><i class="fa fa-trash"></i></figure>--->
															</div>`;

							});

						}else{
							
							//single column
							$.each(pageHtml[0], function(idx, vl){
								
								tmpHtml += `<div class="all-data-title div-main-`+idx+`" data-div_len="`+idx+`">
															<div class="custom-dropdown text-secondary">
																<div class="textContentHolder">`+vl+`</div>
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
															<!---<figure onclick="removeMe(this,0);"><i class="fa fa-trash"></i></figure>--->
															</div>`;

							});

						}

						setTimeout(function(){
							
							if(TMP_TEMPLATE_TYPE == 0){
		
								var htmlStr = '<div id="main-container" class="main-content mt-3"></div>';
							
							}else{
								
								var htmlStr = `<div id="main-container" class="main-content mt-3">
								<div class="leftPanel"></div>
								<div class="rightPanel"></div>
								</div>`;
							
							}

							$("#main-container-holder").html(htmlStr);

							setTimeout(function(){

								if(TMP_TEMPLATE_TYPE == 0){
									$("#main-container").html(tmpHtml);								
								}else{
									$("#main-container .leftPanel").html(tmpHtml);	
									$("#main-container .rightPanel").html(tmpHtml2);	
								}

								$("#noPageArea").hide();
								$("#pageAttributes").show();
								$("#savePageButton").show();


								setTimeout(function(){
									initDrag();
								},100);

							},100);

							
						}, 100);

				}else{
						//error try again

						var msg = "Please try again.";
						var error = 1;
						showError(msg, error);
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
				
				var regx = /\./g;
				timeStampInMs = timeStampInMs.toString();
				timeStampInMs = timeStampInMs.replace(regx,'');
				
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
	
	function uploadFromUrl(){

		var imgUrl = $("#imageUrlInput").val();

		//var imgUrl = "https://images.pexels.com/photos/39517/rose-flower-blossom-bloom-39517.jpeg?cs=srgb&dl=pexels-pixabay-39517.jpg&fm=jpg";

		if(imgUrl == "" || imgUrl == null || imgUrl == undefined){
			
			$("#imageUrlInput").addClass("err");
			
			$("#imageUrlInput").keyup(function(){
				$("#imageUrlInput").removeClass("err");
			});

			return false;
		
		}else{

			var loaderElmId = "imageUrlUpldBttn";
			var preLoaderContent = $("#imageUrlUpldBttn").html();
			showLoader(loaderElmId);

			setTimeout(function(){

				imgUrl = encodeURI(imgUrl);


				var data = {"imgUrl":imgUrl};
				var path = "companies/downloadImageByUrl";

				callAjax(data, path, function(resp){

						
						if(resp.C == 100){
							//msg = "Zipzum page saved successfully";
							//toastr.success(msg);

							var result = resp.R;
							var fileBs64Data = result.base64Data;
							var fileName = result.fileName;
							var tmpId = getUniqeId(0);
							var prgId = tmpId+"_attch";
							var attchClsId = tmpId+"_attchClose";

							var imgHtml = 
							'<span class="attachSpan" id="'+prgId+'" >\
								<a class="ImageDotBttn" href="javascript:void(0);" onclick="showHideImgOpt(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Options"><i class="fa-solid fa-ellipsis-vertical"></i></a>\
					   		<ul class="ImagedotMenu">\
					   			<li>\
					   				<a class="cropIcon" href="javascript:void(0);" onclick="cropImage(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Crop"><i class="fa fa-crop" aria-hidden="true"></i></a>\
									</li>\
									<li>\
										<a href="JavaScript:void(0);" id="'+attchClsId+'" class="removeAttach" onclick="removeAttcment(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>\
									</li>\
								</ul>\
								<img id="'+prgId+'_img" src="'+fileBs64Data+'" style="width: 100%;" />\
								<span class="fileNameSpan">'+fileName+'</span>\
							</span>';
							
							//$('#imageSection .textContentHolder').append(imgHtml);	
							$('#imageSection .textContentHolder #AddNewFile').before(imgHtml);	
							$("#imageUploadModal").modal('hide');
							
							closeImageUploadModel();
							
							setTimeout(function(){
								initDrag(); //add drag drop option to images		
							},500);

					var result = resp.R;
					var fileBs64Data = result.base64Data;
					var fileName = result.fileName;
					var tmpId = getUniqeId(1);
					var prgId = tmpId+"_attch";
					var attchClsId = tmpId+"_attchClose";

					var imgHtml = '<span class="attachSpan" id="'+prgId+'" >\
						<a href="JavaScript:void(0);" id="'+attchClsId+'" class="removeAttach" onclick="removeAttcment(\''+prgId+'\');"><i class="fa fa-times" aria-hidden="true"></i></a>\
						<img id="'+prgId+'_img" src="'+fileBs64Data+'" style="width: 100%;" />\
						<span class="fileNameSpan">'+fileName+'</span>\
						<a class="btn btn-primary" href="javascript:void(0);" onclick="cropImage(\''+prgId+'\');">Crop</a>\
					</span>';
					
					$('#imageSection .textContentHolder').append(imgHtml);	
					$("#imageUploadModal").modal('hide');
					closeImageUploadModel();



						}else{
							
							var msg = "Please try again.";
							var error = 1;
							showError(msg, error);

						}
						
				});

				hideLoader(loaderElmId, preLoaderContent);

			}, 1000);

		}

	}

	function closeImageUploadModel(){
		$('#imageUrlInput').val('');
		$('#fileupload').val('');
		$("#imageUploadModal").modal('hide');
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
			
			//setTimeout(function(){

					var reader = new FileReader(); // Creating reader instance from FileReader() API

					reader.onload = function (event) {
						 //demoImage.src = reader.result;
						 var fileBs64Data = reader.result;
						 var percent = (event.loaded / event.total) * 100;
					   $("#"+prgId+" .progressBar").val(Math.round(percent));

							//fileBs64Data

					   	var imgHtml = '<span class="attachSpan" id="'+prgId+'" >\
					   	<a class="ImageDotBttn" href="javascript:void(0);" onclick="showHideImgOpt(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Options"><i class="fa-solid fa-ellipsis-vertical"></i></a>\
					   		<ul class="ImagedotMenu">\
					   		<li>\
					   		<a class="cropIcon" href="javascript:void(0);" onclick="cropImage(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Crop"><i class="fa fa-crop" aria-hidden="true"></i></a>\
								</li>\
								<li>\
								<a href="JavaScript:void(0);" id="'+attchClsId+'" class="removeAttach" onclick="removeAttcment(\''+prgId+'\');" data-bs-toggle="tooltip" data-bs-placement="right" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>\
								</li>\
								</ul>\
								<img id="'+prgId+'_img" src="'+fileBs64Data+'" style="width: 100%;" />\
								<span class="fileNameSpan">'+fileName+'</span>\
							</span>';
							
							//$('#imageSection .textContentHolder').append(imgHtml);
							$('#imageSection .textContentHolder #AddNewFile').before(imgHtml);	

							setTimeout(function(){
								initDrag(); //add drag drop option to images		
							},500);
							 
					}


					reader.readAsDataURL(file);

				//},100);
			
			fileIdx++;
			FileCount++;
			// console.log("FileCount:" + FileCount);
			$("#imageUploadModal").modal('hide');
			if(FileCount >= 5){
				$("#AddNewFile").hide();
			}
		}

	}

	function showHideImgOpt(prgId){

		$("#"+prgId+" .ImagedotMenu").toggle();
	}

	function removeAttcment(attchClsId){

		$(".ImagedotMenu").hide();

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

	function cropImage(prgId){


		$(".ImagedotMenu").hide();

		/*
		<div id="cropBox" class="cropBox">
			<span class="cropHead" >Crop</span>
			<ul class="imagesContainer">
				<li class="left">
					<img src="" />
				</li>
				<li class="right">
					<img src="" />
				</li>
			</ul>
		</div>
		*/


		//var tmpImg = $("#"+prgId+"_img");
		
		var imgsrc = $("#"+prgId+"_img").attr("src");

		$("#cropBox .imagesContainer .left img").attr("src", imgsrc);

		$("#cropBox").modal('show');
		
		$("#cropBox #cropBoxCropBttn").attr("onclick","saveCroppedImage(\'"+prgId+"\');");

		var tmpImgArr = $("#cropBox .imagesContainer .left img");
		var tmpImg = tmpImgArr[0];

		// console.log("tmpImg:");
		// console.log(tmpImg);

		// init cropper
		TMP_CROPPER = new Cropper(tmpImg, {
                viewMode: 1,
                aspectRatio: 1,
                minContainerWidth: 400,
                minContainerHeight: 400,
                movable: true,
                ready: function () {
                    // console.log('ready');
                    // console.log(TMP_CROPPER.ready);
                }
            });
    // TMP_CROPPER = new Cropper(tmpImg, cropOptions);

    // console.log("TMP_CROPPER:");
    // console.log(TMP_CROPPER);
	}

	function saveCroppedImage(prgId){


		var loaderElmId = "cropBoxCropBttn";
		var preLoaderContent = $("#cropBoxCropBttn").html();
		showLoader(loaderElmId);

		setTimeout(function(){
			var imgSrc = TMP_CROPPER
	    .getCroppedCanvas({
	      width: "600px" // input value
	    }).toDataURL();

	    // console.log("imgSrc:");
	    // console.log(imgSrc);

	    $("#cropBox .imagesContainer .right img").attr("src", imgSrc);

		$("#cropBox .imagesContainer .right").removeClass("d-none");
	    var param = prgId;
	    var saveBttnHtml = '<a href="javascript:void(0);" id="cropResultBttn" class="cropResultBttn btn btn-primary" onclick="setCroppedResult(\''+param+'\');">Save</a>';
	    $("#cropBox .imagesContainer .right a.cropResultBttn").remove();
	    $("#cropBox .imagesContainer .right").append(saveBttnHtml);

	    hideLoader(loaderElmId, preLoaderContent);
	   },1000);
	}

	function setCroppedResult(param){

		var loaderElmId = "cropResultBttn";
		var preLoaderContent = $("#cropResultBttn").html();
		showLoader(loaderElmId);

		setTimeout(function(){


			var imgSrc = $(".right img").attr("src");
			$("#cropBox .imagesContainer .left img").attr("src", "");
			$("#cropBox .imagesContainer .right img").attr("src", "");
			$("#cropBox .imagesContainer .right #cropResultBttn").remove();


			$("#"+param+"_img").attr("src", imgSrc);

			$("#cropBox").modal('hide');

			$("body").removeClass("cropper-open");

			hideLoader(loaderElmId, preLoaderContent);
		},1000);
	}


	function closeCropper(){
		//reset modal
		$("#cropBox .imagesContainer .left img").attr("src", "");
		$("#cropBox .imagesContainer .right img").attr("src", "");
		$("#cropBox .imagesContainer .right a.cropResultBttn").remove();
		$("#cropBox .imagesContainer .right #cropResultBttn").remove();		
		$("#cropBox").modal('hide');
		$("body").removeClass("cropper-open");
	}

	// Show report on page load.... if have any...
	$(document).ready(function(){
		$(".side--menu.active").click();
	});


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
