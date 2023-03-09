<?php
function custom_siteurl($param = false){

  if($param){
    $tmpSiteUrl = base_url("index.php/".$param);
  }else{
    $tmpSiteUrl = base_url("index.php/");
  }

  return $tmpSiteUrl;
}

function db_randomnumber(){
  $uniqNum = time().rand(10000,999999);
  return $uniqNum;
}

function create_local_folder($path){
	if(!is_dir($path)){
		mkdir($path,0777);
		exec("chmod 777 $path");
	}
}

function fileWrite($file,$data,$mode='w+'){
	$fp = fopen($file,$mode);
	fwrite($fp,$data);
	fclose($fp);
}

function removeFile($file){

	$cmd = 'rm "'.$file.'"';
	exec($cmd, $out);

}

function fileRead($filePath){
	$contents = file_get_contents($filePath);
	return $contents;
}

?>
