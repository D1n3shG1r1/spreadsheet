<?php include("header.php");?>

<div class="container">
	<div class="pagecontent mt-2">
		<h3>Portfolio Companies <a class="float-end btn btn-primary" href="<?php echo custom_siteurl(); ?>companies/addcompany">Add Company</a></h3>
		<table class="table table-bordered mt-3">
			<thead>
				<tr>
					<th>Sr no.</th>
					<th>Company Name</th>
					<th>Company Group</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($companies)){
					$srNo = 1;
					foreach ($companies as $key => $company) {
	
						$tmpId = $company["id"];
						$tmpCmpnyNm = $company["companyName"];
						$tmpCmpnyGrp = $company["companyGroup"];
						$tmpCmpnyEml = $company["primaryEmail"];
					?>
	
						<tr id="row_<?php echo $tmpId; ?>">
							<td><?php echo $srNo; ?></td>
							<td><?php echo $tmpCmpnyNm; ?></td>
							<td><?php echo $tmpCmpnyGrp; ?></td>
							<td><?php echo $tmpCmpnyEml; ?></td>
							<td><a href="javascript:void(0);" onclick="confirmRemoveCompany('<?php echo $tmpId; ?>');">Remove</a> | <a href="<?php echo site_url("companies/company/".$tmpId); ?>" target="_blank">Edit</a></td>
						</tr>
						<?php
						$srNo++;
					}
	
				}else{
				?>
					<tr id="row_norecord">
						<td>No companies added yet.</td>
				<?php
				}
				?>
	
			</tbody>
		</table>
	</div>
</div>
<?php include("scripts.php");?>
<script>

function confirmRemoveCompany(companyId){
  $.confirm({
      title: 'Delete',
      content: 'Are you sure? You want to delete this company',
      buttons: {
          confirm: function () {
            //show loader
            var path = "companies/removeCompany";
            var data = {"companyId":companyId};
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
