<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['clientId'] = '394758098838-rqj5oknnr4joikhakipfdsb5q274mpeh.apps.googleusercontent.com'; //add your client id

$config['clientSecret'] = '6QMTpTcCiV1-l884L1V7R3Mr'; //add your client secret
$config['redirectUri'] = base_url().'login/loginwithgoogle'; //add your redirect uri
$config['apiKey'] = ''; //add your api key here
$config['applicationName'] = base_url().'login with google'; //application name for the api
$config['dscope'] = "https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email";

?>