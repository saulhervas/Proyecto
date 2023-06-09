<?php 

$ch = curl_init();
$url = '/oauth/token';

$params = array(
    'grant_type' => 'authorization_code',
    'client_id' => '3',
    'client_secret' => '1Rybv6ZUl6W2EChQujo7VjvU1160jo6YOBvUkD2k',
    'redirect_uri' => '/auth/callback.php',
    'code' => $_REQUEST['code']
);

//var_dump($params);
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
$params_string = '';
 
if (is_array($params) && count($params))
{
    foreach($params as $key=>$value) {
        $params_string .= $key.'='.$value.'&';
    }
 
    rtrim($params_string, '&');
 
    curl_setopt($ch,CURLOPT_POST, count($params));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
}
 
$result = curl_exec($ch);
curl_close($ch);
$response = json_decode($result);

var_dump($response);
return $response;
