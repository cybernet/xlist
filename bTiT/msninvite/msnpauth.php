<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
Inviter Note:
Orginal Code of this inviter is from TBDEV, fixed
for PB Edition By FatePower
********/
class MSNPAuth
{
var $_key;
function MSNPAuth($passport, $password, $challenge)
{
$i = strpos($passport, "@");
switch (substr($passport, $i))
{
case "@hotmail.com":
$authURL = "ssl://loginnet.passport.com";
break;
case "@hotmail.co.uk":
$authURL = "ssl://loginnet.passport.com";
break;
case "@msn.com":
$authURL = "ssl://msnialogin.passport.com";
break;
default:
$authURL = "ssl://login.passport.com";
break;
}
$fp = fsockopen($authURL, 443);
$req = array();
$data = '';
$req[] = 'GET /login2.srf HTTP/1.1';
$req[] = 'Authorization: Passport1.4 OrgVerb=GET,OrgURL=http%3A%2F%2Fmessenger%2Emsn%2Ecom, sign-in='.str_replace('@', '%40', $passport).',pwd='.urlencode($password).','.$challenge;
$req[] = 'Host: login.passport.com';
$req[] = 'Connection: Close';
foreach ($req as $v)
{
fputs($fp, "$v\r\n");
}
fputs($fp, "\r\n");
while (!feof($fp))
{
$data .= @fgets($fp);
}
fclose($fp);
$headers = explode("\r\n", $data);
foreach ($headers as $header)
{
if (strpos($header, ':') === false)
{
continue;
}
list($name, $value) = explode(':', $header);
switch ($name)
{
case 'WWW-Authenticate':
$this->_key = false;
break;
case 'Authentication-Info':
$start = (strpos($value, "'") + 1);
$end = (strrpos($value, "'") - $start);
$this->_key = substr($value, $start, $end);
break;
}
}
}
function getKey()
{
return $this->_key;
}
}
?>