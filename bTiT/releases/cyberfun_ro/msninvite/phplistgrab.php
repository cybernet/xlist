<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
Inviter Note:
Orginal Code of this inviter is from TBDEV, fixed
for PB Edition By FatePower
********/
require_once ("msnpauth.php");
define('LIST_ALLOW', 'AL');
define('LIST_BLOCK', 'BL');
define('LIST_FORWARD', 'FL');
define('LIST_REVERSE', 'RL');
class phpListGrab
{
var $_passport = '';
var $_password = '';
var $_result = 0;
var $lists = array(
LIST_ALLOW => array(),
LIST_BLOCK => array(),
LIST_FORWARD => array(),
LIST_REVERSE => array(),
);
var $_contacts = array();
var $_socket = NULL;
var $_lst_count = 0;
function phpListGrab($passport, $password)
{
$this->_passport = $passport;
$this->_password = $password;
}
function grab($server = 'messenger.hotmail.com')
{
$this->_socket = fsockopen($server, 1863);
$this->_send('VER 0 MSNP8');
while (!feof($this->_socket))
{
$data = fgets($this->_socket);
$data = substr($data, 0, -2);
$this->_parse($data);
}
}
function _send($data)
{
fputs($this->_socket, "$data\r\n");
}
function _parse($data)
{
$params = explode(' ', $data);
switch ($params[0])
{
case 'VER':
$this->_send('CVR 1 0x0409 winnt 5.1 i386 MSNMSGR 6.0.0254 MSMSGS '.$this->_passport);
break;
case 'CVR':
$this->_send('USR 2 TWN I '.$this->_passport);
break;
case 'XFR':
$subparams = explode(':', $params[3]);
$this->Grab($subparams[0]);
break;
case 'USR':
if ($params[2] == 'TWN')
{
$msnpauth = new MSNPAuth($this->_passport, $this->_password, $params[4]);
$hash = $msnpauth->getKey();
if (!$hash)
{
$this->_result = 911;
$this->_send('OUT');
return false;
}
$this->_send('USR 3 TWN S '.$hash);
}
elseif ($params[2] == 'OK')
{
$this->_send('SYN 4 0');
}
break;
case 'SYN':
$this->_lst_count = $params[3];
break;
case 'LST':
$this->_lst_count--;
if (!isset($this->_contacts[$params[1]]))
{
$this->_contacts[$params[1]] = array(
'passport' => $params[1],
'name' => urldecode(utf8_decode($params[2])),
'lists' => $params[3],
);
}
if (($params[3] & 2) > 0)
{
$this->lists[LIST_ALLOW][$params[1]] = &$this->_contacts[$params[1]];
}
if (($params[3] & 1) > 0)
{
$this->lists[LIST_FORWARD][$params[1]] = &$this->_contacts[$params[1]];
}
if (($params[3] & 4) > 0)
{
$this->lists[LIST_BLOCK][$params[1]] = &$this->_contacts[$params[1]];
}
if (($params[3] & 8) > 0)
{
$this->lists[LIST_REVERSE][$params[1]] = &$this->_contacts[$params[1]];
}
if ($this->_lst_count == 0)
{
$this->_send('OUT');
$this->result = 'OK';
}
break;
}
}
}
?>