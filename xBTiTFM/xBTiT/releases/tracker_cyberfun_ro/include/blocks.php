<?
// CyBerFuN.ro & xList.ro

global $USERLANG;
require_once(load_language('lang_blocks.php'));

function get_menu($pos) {
  global $TABLE_PREFIX, $CURUSER, $FORUMLINK, $CACHE_DURATION, $language;
  $blocks = get_result('SELECT title, content, cache FROM '.$TABLE_PREFIX.'blocks WHERE position="'.$pos.'" AND status=1 AND '.$CURUSER['id_level'].'>=minclassview  AND '.$CURUSER['id_level'].'<=maxclassview '.(($FORUMLINK == ''||$FORUMLINK == 'internal'||$FORUMLINK == 'smf')?'':' AND content!="forum"').' ORDER BY sortid', true, $CACHE_DURATION);
  $return = '';
  foreach ($blocks as $entry)
		$return .= get_block($language[$entry['title']],'justify',$entry['content'],$entry['cache'] == 'yes');
  return $return;
}

function main_menu() {
  global $TABLE_PREFIX, $CURUSER, $tpl;

  $blocks = get_result('SELECT content FROM '.$TABLE_PREFIX.'blocks WHERE position="t" AND status=1 AND '.$CURUSER['id_level'].'>=minclassview  AND '.$CURUSER['id_level'].'<=maxclassview '.(($FORUMLINK == ''||$FORUMLINK == 'internal'||$FORUMLINK == 'smf')?'':' AND content!="forum"').' ORDER BY sortid', true, $CACHE_DURATION);
  $return = '';
  foreach ($blocks as $entry)
    $return .= get_content(realpath(dirname(__FILE__).'/..').'/blocks/'.$entry['content'].'_block.php');

  return set_block('','justify',$return);
}

function center_menu() {
  return get_menu('c');
}

function side_menu() {
  return get_menu('l');
}

function right_menu() {
  return get_menu('r');
}

function bottom_menu() {
  return get_menu('b');
}
?>
