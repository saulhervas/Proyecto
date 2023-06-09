<?php
$query = http_build_query(array(
    'client_id' => '3',
    'redirect_uri' => '/oauth2_client/callback.php',
    'response_type' => 'code',
    'scope' => '',
));
 
header('Location: /oauth/authorize?'.$query);