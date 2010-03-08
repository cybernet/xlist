<?php

if (!defined('IN_ACP'))
    die('non direct access!');

include(load_language('lang_usercp.php'));

if (!function_exists('get_user_combo'))
{
  function get_user_combo($select, $opts=array()) {
    $name=(isset($opts['name']))?' name="'.$opts['name'].'" id="'.$opts['name'].'"':'';
    $complete=(isset($opts['complete']))?(bool)$opts['complete']:false;
    $default=(isset($opts['default']))?$opts['default']:NULL;
    $id=(isset($opts['id']))?$opts['id']:'id';
    $value=(isset($opts['value']))?$opts['value']:'value';
    $combo='';

    if ($complete)
      $combo.='<select'.$name.'>';

    foreach ($select as $option) {
      $combo.="\n".'<option ';
      if ( (!is_null($default)) && ($option[$id]==$default) )
        $combo.='selected="selected" ';
      $combo.='value="'.$option[$id].'">'.unesc($option[$value]).'</option>';
    }

    if ($complete)
      $combo.='</select>';

    return $combo;
  }
}



switch ($action) {
    case 'save_ok':
         success_msg($language['SUCCESS'], 'New user has been added in our database<br /><a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'">'.$language['MNU_ADMINCP'].'</a>');
         stdfoot(true,false);
         die();
         break;

    case 'save_pb':
         information_msg($language['SUCCESS'], 'New user has been added in our database<br />but a problem occured sending him the confirm email<br /><a href="index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'">'.$language['MNU_ADMINCP'].'</a>');
         stdfoot(true,false);
         die();
         break;

    case '':
    default:
         # init options
         $opts['name']='level';
         $opts['id']='id';
         $opts['value']='level';
         $opts['complete']=true;
         $opts['default']=3;
         # rank list
         $ranks=rank_list();
         $admintpl->set('rank_combo',get_user_combo($ranks, $opts));
         # lang list
         $opts['name']='language';
         $opts['id']='id';
         $opts['value']='language';
         $opts['default']=$btit_settings['default_language'];
         $opts['complete']=true;
         $langs=language_list();
         $admintpl->set('language_combo',get_user_combo($langs, $opts));
         # style list
         $opts['name']='style';
         $opts['id']='id';
         $opts['value']='style';
         $opts['default']=$btit_settings['default_style'];
         $opts['complete']=true;
         $styles=style_list();
         $admintpl->set('style_combo',get_user_combo($styles, $opts));
         break;
}

# set template info
$admintpl->set('frm_action','index.php?page=admin&amp;user='.$CURUSER['uid'].'&amp;code='.$CURUSER['random'].'&amp;do=newuser');
$admintpl->set('frm_cancel','index.php?page=admin&user='.$CURUSER['uid'].'&code='.$CURUSER['random']);
$admintpl->set('insert_ok','index.php?page=admin&user='.$CURUSER['uid'].'&code='.$CURUSER['random'].'&do=newuser&action=save_ok');
$admintpl->set('insert_pb','index.php?page=admin&user='.$CURUSER['uid'].'&code='.$CURUSER['random'].'&do=newuser&action=save_pb');
$admintpl->set('tracker_url',$btit_settings['url']);
$admintpl->set('user_id',$CURUSER['uid']);
$admintpl->set('user_code',$CURUSER['random']);
$admintpl->set('language',$language);
$admintpl->set('edit_user',$edit,true);
?>