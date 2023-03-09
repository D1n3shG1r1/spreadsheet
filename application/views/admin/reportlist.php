<?php include("header.php");?>

<div class="container">
	<div class="pagecontent mt-2">
		<h3>Reports <a class="float-end btn btn-primary" href="<?php echo custom_siteurl(); ?>companies/uploadxlssheet">Make Report</a></h3>
		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>Sr no.</th>
					<th>Company Name</th>
					<th>Company Group</th>
					<th>Report Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($reports)){
					$srNo = 1;
					foreach ($reports as $key => $report) {
	
						$tmpId = $report["id"];
						$tmpCmpnyNm = $report["companyName"];
						$porfolio_company_id = $report["porfolio_company_id"];
						
						$tmpCmpnyGrp = $report["company_group"];
						$tmpCmpnyEml = $report["report_date"];
					?>
	
						<tr id="row_<?php echo $tmpId; ?>">
							<td><?php echo $srNo; ?></td>
							<td><?php echo $tmpCmpnyNm; ?></td>
							<td><?php echo $tmpCmpnyGrp; ?></td>
							<td><?php echo $tmpCmpnyEml; ?></td>
							<td>
								<a href="javascript:void(0);" onclick="confirmRemoveReport('<?php echo $tmpId; ?>','<?php echo $porfolio_company_id; ?>');">Remove</a> | <a href="<?php echo custom_siteurl()."companies/showexcelsheet/".$tmpId; ?>" target="_blank">View</a> | <a href="<?php echo custom_siteurl()."companies/charts/".$tmpId; ?>">Charts</a>
							</td>
						</tr>
						<?php
						$srNo++;
					}
	
				}else{
				?>
					<tr id="row_norecord">
						<td colspan=5; style="text-align: center;">No Report added yet.</td>
				<?php
				}
				?>
	
			</tbody>
		</table>
	</div>
</div>
<?php include("scripts.php");?>
<script>

function confirmRemoveReport(reportId, companyId){
  $.confirm({
      title: 'Delete',
      content: 'Are you sure? You want to delete this Report',
      buttons: {
          confirm: function () {
            //show loader
            var path = "companies/removeReport";
            var data = {"reportId":reportId, "companyId":companyId};
            callAjax(data, path, function(response){
              var code = response.C;
              var resp = response.R;
              if(code == 100){
                $("#row_"+resp.id).remove();
              }else{

              }
                //hide loader
            });
          },
          cancel: function () {
              //Perform No Action
          }
      }
  });

}

</script>
<?php include("footer.php");?>
