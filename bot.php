<?php
/* Copyright (C) 2013 jumoog vBulletin-phpbot

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License. */

include("LIB_parse.php");

function login($username, $password, $site)
{
$post_password = md5($password);
$targetlogin = $site . "/login.php?do=login";
$ch          = curl_init();
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookies.txt');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
curl_setopt($ch, CURLOPT_URL, $targetlogin);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'vb_login_username=' . $username . '&vb_login_password=&s=&do=login&vb_login_md5password=' . $post_password . '&vb_login_md5password_utf=' . $post_password . '');
curl_exec($ch);
sleep(2);
}


function editpost($id, $title, $message, $iconid)
{
$post_password = md5($password);
$target = $site . "/showpost.php?p=" . $id;
curl_setopt($ch, CURLOPT_POST, false);
$gotPage = curl_exec($ch);

$securitytoken_tag = return_between($string = $gotPage, $start = "<input type=\"hidden\" name=\"securitytoken\"", $end = " />", $type = EXCL);
$securitytoken     = str_replace("\"", "", $securitytoken_tag);
$securitytoken     = str_replace("value=", "", $securitytoken);

$t_tag = return_between($string = $gotPage, $start = "<input type=\"hidden\" name=\"t\"", $end = " />", $type = EXCL);
$t     = str_replace("\"", "", $t_tag);
$t     = str_replace("value=", "", $t);

$posthash_tag = return_between($string = $gotPage, $start = "<input type=\"hidden\" name=\"posthash\"", $end = " />", $type = EXCL);
$posthash     = str_replace("\"", "", $posthash_tag);
$posthash     = str_replace("value=", "", $posthash);

$poststarttime_tag = return_between($string = $gotPage, $start = "<input type=\"hidden\" name=\"poststarttime\"", $end = " />", $type = EXCL);
$poststarttime     = str_replace("\"", "", $poststarttime_tag);
$poststarttime     = str_replace("value=", "", $poststarttime);

$loggedinuser_tag = return_between($string = $gotPage, $start = "<input type=\"hidden\" name=\"loggedinuser\"", $end = " />", $type = EXCL);
$loggedinuser     = str_replace("\"", "", $loggedinuser_tag);
$loggedinuser     = str_replace("value=", "", $loggedinuser);

$ptarget = $site . "/editpost.php?do=updatepost&postid=" . $id;
curl_setopt($ch, CURLOPT_URL, $ptarget);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'reason=&title=' . $title . '&message=' . $message . '&wysiwyg=0&iconid=' . $iconid . '&s=&securitytoken=' . $securitytoken . '&do=updatepost&t=' . $t . '&p=' . $id . '&posthash=' . $posthash . '&poststarttime=' . $poststarttime . '&sbutton=Save+Changes&signature=1&parseurl=1&emailupdate=9999');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);
}
?>