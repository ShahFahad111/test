<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '847487836348-oel2dktcsh61iqocp6ndkuv71q7si7da.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'FwMScRDczUzz-5odRoxi6teC'; //Google client secret
$redirectURL = 'https://csasallotment.000webhostapp.com/update/csas/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('CSAS');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>