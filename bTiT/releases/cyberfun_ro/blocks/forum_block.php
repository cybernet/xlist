<?php
global $CURUSER;
if (!$CURUSER || $CURUSER["view_forum"]=="no")
   {
    // do nothing
   }
else
    {

    block_begin(FORUM_INFO);

     $res = mysql_query("SELECT COUNT(*) AS topic_total FROM topics");
     if ($res)
    {
      $row = mysql_fetch_array($res);
      $topics = $row['topic_total'];

    $res1 = mysql_query("SELECT COUNT(*) AS post_total FROM posts");
       if ($res1)
      {
        $row = mysql_fetch_array($res1);
        $posts = $row['post_total'];
        if ($posts>0)
           $posts_avg = number_format(($topics/$posts) * 100, 0);
        else
            $posts_avg = 0;
      }
    }
     else
    {
      $topics = 0;
      $posts = 0;
    $posts_avg = 0;
  }

     print("<table cellpadding='4' cellspacing='1' width='100%'>\n<tr><td class='lista'>\n");
     print("<table width='100%' cellspacing='2' cellpading='2'>\n");

  print("<tr><td>" . TOPICS . ":</td><td align='right'>" . number_format($topics) . "</td></tr>\n");
  print("<tr><td>" . POSTS . ":</td><td align='right'>" . number_format($posts) . "</td></tr>\n");
  print("<tr><td>" . TOPICS . "/" . POSTS . ":</td><td align='right'>" . $posts_avg . " %</td></tr>\n");

  print("</table>\n</td></tr>\n");

  if ( $topics > 0 )
  {
       if (isset($GLOBALS["block_forumlimit"]))
           $limit="LIMIT " . $GLOBALS["block_forumlimit"];
       else
           $limit="LIMIT 5";

      //$tres = mysql_query("SELECT id, subject FROM topics ORDER BY lastpost DESC $limit") or die(mysql_error());
       $tres = mysql_query("SELECT topics.id, topics.subject,topics.lastpost FROM topics inner join forums on forums.id=topics.forumid WHERE forums.minclassread<=".$CURUSER["id_level"]." ORDER BY lastpost DESC $limit") or die(mysql_error());

    while ($trow = mysql_fetch_array($tres))
    {
      $lpres = mysql_query("SELECT p.added, p.userid, u.username, u.id_level, prefixcolor, suffixcolor
        FROM posts p, users u inner join users_level on u.id_level=users_level.id
           WHERE p.userid = u.id
             AND p.topicid = " . $trow['id'] ." ORDER BY p.added") or die(mysql_error());
      while ($lprow = mysql_fetch_array($lpres))
      {
        $last_post_userid = $lprow['userid'];
        $last_poster = $lprow['username'];
        $last_post_time = get_date_time($lprow['added']);

        $pcolor=unesc($lprow["prefixcolor"]);
        $scolor=unesc($lprow["suffixcolor"]);

     }

      if ($trow['lastpost'])
         print("<tr><td class='lista'><b><a href='forum.php?action=viewtopic&amp;topicid=" . $trow['id'] . "&amp;page=last#" . $trow['lastpost'] . "'>" . htmlspecialchars(unesc($trow['subject'])) . "</a></b><br />".LAST_POST_BY." <a href='userdetails.php?id=" . $last_post_userid . "'>" . $pcolor . $last_poster . $scolor ."</a>".$donor."".Warn_disabled($last_post_userid)."<br />On " . $last_post_time . "</td></tr>\n");
      else
         print("<tr><td class='lista'><b><a href='forum.php?action=viewtopic&amp;topicid=" . $trow['id'] . "&amp;page=last'>" . htmlspecialchars(unesc($trow['subject'])) . "</a></b><br />".LAST_POST_BY." <a href='userdetails.php?id=" . $last_post_userid . "'>" . $pcolor . $last_poster . $scolor ."</a>".$donor."".Warn_disabled($last_post_userid)."<br />On " . $last_post_time . "</td></tr>\n");
    }
  }
  else
  {
    print("<tr><td class='lista'>" . NO_TOPIC . "</td></tr>\n");
  }

  print("</table>\n");

  block_end();

} // end if user can view
?>
