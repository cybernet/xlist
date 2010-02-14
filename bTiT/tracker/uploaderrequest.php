<?php
//Uploader Request by CobraCRK
//made for Btitracker
//www.extremeshare.org, cobracrk@yahoo.org
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader('Uploader Request');

if(!$CURUSER || $CURUSER["view_torrents"]!="yes" || $CURUSER["level"]!="Members")
{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
    stdfoot();
    exit();
}


block_begin("Uploader Request");

?>
<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	color: #000000;
}
.style8 {font-size: 10px; color: #000000; font-weight: bold; }
-->
</style>

<form id="form1" name="form1" method="post" action="upload_request_2.php">
  <table width="331" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="330"><div align="center"><strong><span class="style1">A T T E N T I O N !</span><br />
            <span>If you do not pass the conditions below, do not apply!!</span></strong></div></td>
    </tr>
  </table>
  <table width="511" border="1" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <td><span class="style8">Connection:</span></td>
      <td><strong>
	  	- internal  .
	  	    <select name="intern">
	  	              <option value="0" selected="selected">0 KB/s</option>
	  	              <option value="&lt; 64 KB/s">&lt; 64 KB/s</option>
	  	              <option value="64 - 128 KB/s">64 - 128 KB/s</option>
	  	              <option value="128 - 256 KB/s">128 - 256 KB/s</option>
	  	              <option value="256 - 512 KB/s">256 - 512 KB/s</option>
	  	              <option value="512 - 1024 KB/s">512 - 1024 KB/s</option>
	  	              <option value="1 - 2 MB/s">1 - 2 MB/s</option>
	  	              <option value="2 - 5 MB/s">2 - 5 MB/s</option>
	  	              <option value="5 - 10 MB/s">5 - 10 MB/s</option>
	  	              <option value="&gt; 10 MB/s">&gt; 10 MB/s</option>
                    </select>
        <br />
        - external&nbsp;
	        <select name="extern">
	                  <option value="0" selected="selected">0 KB/s</option>
	                  <option value="&lt; 64 KB/s">&lt; 64 KB/s</option>
	                  <option value="64 - 128 KB/s">64 - 128 KB/s</option>
	                  <option value="128 - 256 KB/s">128 - 256 KB/s</option>
	                  <option value="256 - 512 KB/s">256 - 512 KB/s</option>
	                  <option value="512 - 1024 KB/s">512 - 1024 KB/s</option>
	                  <option value="1 - 2 MB/s">1 - 2 MB/s</option>
	                  <option value="2 - 5 MB/s">2 - 5 MB/s</option>
	                  <option value="5 - 10 MB/s">5 - 10 MB/s</option>
	                  <option value="&gt; 10 MB/s">&gt; 10 MB/s</option>
                    </select>
            </strong></td>
    </tr>
    <tr>
      <td><span class="style8">What you intend to upload:</span></td>
      <td><strong>
        <label>
        <textarea name="intentioneaza" cols="40" rows="4" id="intentioneaza"></textarea>
          </label>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Torrent Source</span></td>
      <td><strong>
        <textarea name="sursa" cols="40" rows="4" id="sursa"></textarea>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Do you upload on other site (wich?)</span></td>
      <td><strong>
        <textarea name="altsite" cols="40" rows="4" id="altsite"></textarea>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Do you know how to make a torrent?</span></td>
      <td>
	    <strong>
	    <select name="facetorrent">
	          <option value="Yes" selected="selected">Yes</option>
	          <option value="No" >No</option>
            </select>
        </strong> </td>
    </tr>
    <tr>
      <td><span class="style8">Do you know to make rar archives?</span></td>
      <td><strong>
        <select name="facerar" id="facerar">
          <option value="Yes" selected="selected">Yes</option>
          <option value="No" >No</option>
          </select>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Do you know how to make SFV?</span></td>
      <td><strong>
        <select name="facesfv" id="facesfv">
          <option value="Yes" selected="selected">Yes</option>
          <option value="No">No</option>
          </select>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Do you know how to make NFO?</span></td>
      <td><strong>
        <select name="facenfo" id="facenfo">
          <option value="Yes" selected="selected">Yes</option>
          <option value="No">No</option>
          </select>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Why do you wanna upload on this site:</span></td>
      <td><strong>
        <textarea name="motiv" cols="40" rows="4" id="motiv"></textarea>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Where have you heard about this site?</span></td>
      <td><strong>
        <textarea name="stisite" cols="40" rows="4" id="stisite"></textarea>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Have you read the upload rules and do you agree them?</span></td>
      <td><strong>
        <select name="regulament" id="regulament">
          <option value="Yes" selected="selected">Yes</option>
          <option value="No">No</option>
          </select>
      </strong></td>
    </tr>
    <tr>
      <td><span class="style8">Can you upload at least 1 torrent per day, and at least 1 0day per week?</span></td>
      <td><strong>
        <select name="oday" id="oday">
          <option value="Yes" selected="selected">Yes</option>
          <option value="No">No</option>
        </select>
      </strong></td>
    </tr>
  </table>
  <p>
    <label>
    
    <div align="center">
      <input name="Submit" type="submit" id="Submit" value="Request" />
      </div>
    </label>
  </p>
</form>
<p><?php

block_end();





stdfoot();
//Uploader Request by CobraCRK
//made for Btitracker
//www.extremeshare.org, cobracrk@yahoo.org
?>
</p>
