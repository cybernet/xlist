<br />
<form name="free" action="<tag:frm_action />" method="post">
<table class="header" width="100%" align="center">
  		<tr>
			<td class="header" colspan="5" width="100%"align="center"><b><img src=images/freeleech.gif>Free Leech , if enabled , all torrents ( also new uploads ) will be free Leech , no download will be recorded , only upload<img src=images/freeleech.gif></b></td>
        </tr>
        <tr>
			<td class="header" width="20%" >Date to expire </td>
            <td class="lista"><input type="text" name="expire_date" value="<tag:expire_date />"><small> [0000-00-00][Y/M/D] must be in this format</small></td>
      </tr>
	  <tr>
			<td class="header" width="20%" >Time to expire</td>
			<td class="lista"><input type="text" name="expire_time" value="<tag:expire_time />"><small> [00] must be in whole hours</small></td>
     </tr>
     <tr>
    <td class="header" width="20%">Enable</td>
    <td class="lista"><input type="checkbox" name="free" <tag:free_checked />/></td>
  </tr>
  <tr>
    <td colspan="2" class="lista" style="text-align:center;"><input type="submit" class="btn" name="confirm" value="<tag:language.FRM_CONFIRM />" /></td>
  </tr>
</table>
</form>
