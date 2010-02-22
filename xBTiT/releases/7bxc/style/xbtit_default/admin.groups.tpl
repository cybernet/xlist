<if:add_new>

<form action="<tag:frm_action />" name="level" method="post">

  <table class="lista" width="100%" align="center">

    <tr>

      <td class="header"><tag:language.GROUP_NAME /></td>

      <td class="lista"><input type="text" name="gname" value="" size="40" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_BASE_LEVEL /></td>

      <td class="lista"><tag:groups_combo /></td>

    </tr>

    <tr>

      <td align="center" class="header"><input type="submit" class="btn" name="write" value="<tag:language.FRM_CONFIRM />" /></td>

      <td align="center" class="header"><input type="submit" class="btn" name="write" value="<tag:language.FRM_CANCEL />" /></td>

    </tr>

  </table>

</form>

<else:add_new>

<if:list>

<table class="lista" width="100%" align="center">

  <tr>

    <td class="header" align="center"><tag:language.GROUP /></td>

    <td class="header" align="center"><tag:language.MNU_TORRENT /><br /><tag:language.VIEW_EDIT_DEL /></td>

    <td class="header" align="center"><tag:language.MEMBERS /><br /><tag:language.VIEW_EDIT_DEL /></td>

    <td class="header" align="center"><tag:language.MNU_NEWS /><br /><tag:language.VIEW_EDIT_DEL /></td>

    <td class="header" align="center"><tag:language.MNU_FORUM /><br /><tag:language.VIEW_EDIT_DEL /></td>

    <td class="header" align="center"><tag:language.TRUSTED /></td>

    <td class="header" align="center"><tag:language.TRUSTED_MODERATION /></td>

    <td class="header" align="center"><tag:language.MNU_UPLOAD /></td>

    <td class="header" align="center"><tag:language.DOWNLOAD /></td>

    <td class="header" align="center"><tag:language.STYLE /></td>

    <td class="header" align="center"><tag:language.ADMIN_CPANEL /></td>

    <td class="header" align="center"><tag:language.WT /></td>

    <td class="header" align="center"><tag:language.DELETE /></td>

    <td class="header" align="center"><tag:language.BYPASS_DLCHECK /></td>

    <td class="header" align="center"><tag:language.AUTORANK_STATE /></td>

    <td class="header" align="center"><tag:language.AUTORANK_POSITION /></td>

    <td class="header" align="center"><tag:language.AUTORANK_MIN_UPLOAD /></td>

    <td class="header" align="center"><tag:language.AUTORANK_MIN_RATIO /></td>
    
    <td class="header" align="center"><tag:language.AUTORANK_SMF_MIRROR /></td>


  </tr>

  <loop:groups>

  <tr>

    <td class="lista" align="center"><tag:groups[].user /></td>

    <td class="lista" align="center"><tag:groups[].torrent_aut /></td>

    <td class="lista" align="center"><tag:groups[].users_aut /></td>

    <td class="lista" align="center"><tag:groups[].news_aut /></td>

    <td class="lista" align="center"><tag:groups[].forum_aut /></td>

    <td class="lista" align="center"><tag:groups[].trusted /></td>

    <td class="lista" align="center"><tag:groups[].moderate_trusted /></td>

    <td class="lista" align="center"><tag:groups[].can_upload /></td>

    <td class="lista" align="center"><tag:groups[].can_download /></td>

    <td class="lista" align="center"><tag:groups[].STYLE /></td>

    <td class="lista" align="center"><tag:groups[].admin_access /></td>

    <td class="lista" align="center"><tag:groups[].WT /></td>

    <td class="lista" align="center"><tag:groups[].delete /></td>

    <td class="lista" align="center"><tag:groups[].bypass_dlcheck /></td>

    <td class="lista" align="center"><tag:groups[].arstate /></td>

    <td class="lista" align="center"><tag:groups[].arpos /></td>

    <td class="lista" align="center"><tag:groups[].arupdowntrig /></td>

    <td class="lista" align="center"><tag:groups[].arratiotrig /></td>
    
    <td class="lista" align="center"><tag:groups[].arsmfmirr /></td>


  </tr>

  </loop:groups>

  <tr>

    <td class="header" align="center" colspan="19"><tag:group_add_new /></td>

  </tr>

</table>

<else:list>

<form action="<tag:frm_action />" name="level" method="post">

  <table class="lista" width="100%" align="center">

    <tr>

      <td class="header"><tag:language.GROUP_NAME /></td>

      <td class="lista"><input type="text" name="gname" value="<tag:group.level />" size="40" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_PCOLOR />&lt;span style='color:red'&gt;):</td>

      <td class="lista"><input type="text" name="pcolor" value="<tag:group.prefixcolor />" size="40" maxlength="150" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_SCOLOR />&lt;/span&gt;):</td>

      <td class="lista"><input type="text" name="scolor" value="<tag:group.suffixcolor />" size="40" maxlength="150" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.STYLE /></td>

      <td class="lista"><input type="text" name="STYLE" value="<tag:group.STYLE />" size="10" maxlength="10" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_WT />&nbsp;(hours):</td>

      <td class="lista"><input type="text" name="waiting" value="<tag:group.WT />" size="20" maxlength="10" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.MNU_TORRENT /></td>

      <td class="lista">

        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vtorrents" <tag:group.view_torrents /> />&nbsp;&nbsp;

        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="etorrents" <tag:group.edit_torrents /> />&nbsp;&nbsp;

        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dtorrents" <tag:group.delete_torrents /> />

      </td>

    </tr>

    <tr>

      <td class="header"><tag:language.MEMBERS /></td>

      <td class="lista">

        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vusers" <tag:group.view_users /> />&nbsp;&nbsp;

        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="eusers" <tag:group.edit_users /> />&nbsp;&nbsp;

        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dusers" <tag:group.delete_users /> />

      </td>

    </tr>

    <tr>

      <td class="header"><tag:language.MNU_NEWS /></td>

      <td class="lista">

        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vnews" <tag:group.view_news /> />&nbsp;&nbsp;

        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="enews" <tag:group.edit_news /> />&nbsp;&nbsp;

        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dnews" <tag:group.delete_news /> />

      </td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_VIEW_FORUM /></td>

      <td class="lista">

        <tag:language.GROUP_VIEW />&nbsp;<input type="checkbox" name="vforum" <tag:group.view_forum /> />&nbsp;&nbsp;

        <tag:language.GROUP_EDIT />&nbsp;<input type="checkbox" name="eforum" <tag:group.edit_forum /> />&nbsp;&nbsp;

        <tag:language.GROUP_DELETE />&nbsp;<input type="checkbox" name="dforum" <tag:group.delete_forum /> />

      </td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_UPLOAD /></td>

      <td class="lista"><input type="checkbox" name="upload" <tag:group.can_upload /> /></td>

    </tr>

    <tr>

       <td class="header"><tag:language.TRUSTED /></td>
    
       <td class="lista"><input type="checkbox" name="trusted" <tag:group.trusted /> /></td>
    
    </tr>
    <tr>
  
       <td class="header"><tag:language.TRUSTED_MODERATION /></td>
    
       <td class="lista"><input type="checkbox" name="moderate_trusted" <tag:group.moderate_trusted /> /></td>

   </tr>

   <tr>

      <td class="header"><tag:language.GROUP_DOWNLOAD /></td>

      <td class="lista"><input type="checkbox" name="down" <tag:group.can_download /> /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.GROUP_GO_CP /></td>

      <td class="lista"><input type="checkbox" name="admincp" <tag:group.admin_access /> /></td>
    </tr>

    <tr>

      <td class="header"><tag:language.BYPASS_DLCHECK /></td>

      <td class="lista"><input type="checkbox" name="bypass_dlcheck" <tag:group.bypass_dlcheck /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.AUTORANK_STATE /></td>

      <td class="lista"><select name='arstate'><tag:group.autorank_state />\n</select></td>

    </tr>

    <tr>

      <td class="header"><tag:language.AUTORANK_POSITION /></td>

      <td class="lista"><input type="text" name="arpos" value="<tag:group.autorank_position />" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.AUTORANK_MIN_UPLOAD /><b><tag:language.AUTORANK_IN_BYTES /></b></td>

      <td class="lista"><input type="text" name="arminup" value="<tag:group.autorank_min_upload />" /></td>

    </tr>

    <tr>

      <td class="header"><tag:language.AUTORANK_MIN_RATIO /></td>

      <td class="lista"><input type="text" name="arminratio" value="<tag:group.autorank_minratio />" /></td>

    </tr>
    
    <tr>

      <td class="header"><tag:language.AUTORANK_SMF_MIRROR /></td>

      <td class="lista"><tag:group.forumlist /><input type="text" name="arsmfmirr" value="<tag:group.autorank_smf_group_mirror />" /></td>

    </tr>

    <tr>

      <td align="center" class="header"><input type="submit" class="btn" name="write" value="<tag:language.FRM_CONFIRM />" /></td>

      <td align="center" class="header"><input type="submit" class="btn" name="write" value="<tag:language.FRM_CANCEL />" /></td>

    </tr>

  </table>

</form>

</if:list>

</if:add_new>
