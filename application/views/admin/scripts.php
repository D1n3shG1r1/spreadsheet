<script type="application/javascript" src="<?php echo base_url("assets/jquery/jquery.min.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/jquery-ui-1.13.1/jquery-ui.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/jquery/jquery-confirm.min.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/tagit/tag-it.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/toastr/toastr.min.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/jquery/popper.min.js"); ?>"></script>
<script type="application/javascript" src="<?php echo base_url("assets/jquery/bootstrap.min.js"); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4.2.5/dist/es6-promise.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/html2pdf.js@0.9.0/dist/html2pdf.min.js" type="text/javascript"></script>
<script>

	var ICONS_ARR = {
		'csv': '<i class="fa-solid fa-file-csv"></i>',
		'doc':'<i class="fa-solid fa-file-word"></i>',
		'docx':'<i class="fa-solid fa-file-word"></i>',
		'odp':'<i class="fa-solid fa-file-powerpoint"></i>',
		'ppt':'<i class="fa-solid fa-file-powerpoint"></i>',
		'pptx':'<i class="fa-solid fa-file-powerpoint"></i>',
		'ods':'<i class="fa-solid fa-file-excel"></i>',
		'odt':'<i class="fa-solid fa-file-word"></i>',
		'pdf':'<i class="fa-solid fa-file-pdf"></i>',
		'rtf':'<i class="fa-solid fa-file-lines"></i>',
		'txt':'<i class="fa-solid fa-file-lines"></i>',
		'xls':'<i class="fa-solid fa-file-excel"></i>',
		'xlsx':'<i class="fa-solid fa-file-excel"></i>'
	};
	
	$(function(){
		//$("#ModalForm").modal({ backdrop: "static ", keyboard: false });
		//$("#ModalForm").modal('show');
	});

function callAjax(data, path, callback){
  var postData = data;
  var requestUrl = "<?php echo custom_siteurl(); ?>" + path;

	$.ajax({
	  url:requestUrl,
	  data:postData,
	  dataType:'json',
	  type:'POST',
	  async:false,
	  tryCount : 0,
	  retryLimit : 3,
	  success:function(response){
		return callback(response);
	  },
	  error:function(xhr, textStatus, errorThrown ) {
		  if (textStatus == 'timeout') {
			  this.tryCount++;
			  if (this.tryCount <= this.retryLimit) {
				  //try again
				  $.ajax(this);
				  //return;
			  }else{
				var errResp = {"C":502, "R":xhr, "M":"error"}
				return callback(errResp);
			  }
			  //return;
		  }
		  if (xhr.status == 500) {
			  //handle error
			  var errResp = {"C":500, "R":xhr, "M":"error"}
			  return callback(errResp);
		  } else {
			  //handle error
			  var errResp = {"C":501, "R":xhr, "M":"error"}
			  return callback(errResp);
		  }
	  }
	});

}


function showError(msg, error){

  if(error == 1){
		$("#alertMessage").addClass("alert-danger");
  	$("#alertMessage").removeClass("alert-success");
  }else{
  	$("#alertMessage").addClass("alert-success");
  	$("#alertMessage").removeClass("alert-danger");
  }

  $("#alertMessage").html(msg);
  $("#alertMessage").fadeIn("slow");
  

  setTimeout(function(){
  	$("#alertMessage").fadeOut("slow");
  },2000);

}


function showLoader(elmId){
  
  var loaderHtml = `<div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div>`;

  var loaderHtml = `<div class="spinner-border text-light" role="status"></div>`;
  $("#"+elmId).html(loaderHtml);

}

function hideLoader(elmId, content){
  $("#"+elmId).html(content);
}


function validateEmail(email){
  return email.match(
    /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  );
}

</script>
