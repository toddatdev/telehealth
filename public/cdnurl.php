<?php

$imageid = $_GET['cdnidnum'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://upload.uploadcare.com/info/?pub_key=67aad6b7c86ba578b3d0&file_id=".$imageid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "error";
} else {
	$response_dt = json_decode($response);
	$file_data = $response_dt->mime_type;
	$file_type = str_replace("image/","", $file_data );
	echo $file_type;
} 

?>


