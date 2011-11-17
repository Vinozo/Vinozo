<?php
/*
 * Function to post to James' API
 * 
 */

function getFBLogin($uid){
//open connection
$ch = curl_init();

// Set URL (TODO: abstract this whole thing later)
$url = "http://172.16.101.142:8080/user/userFB/";
$fields_string = "uid=".$uid;

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);
return;
}
?>
