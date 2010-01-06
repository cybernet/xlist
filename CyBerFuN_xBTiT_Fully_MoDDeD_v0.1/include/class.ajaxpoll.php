<?php
// CyBerFuN.ro & xList.ro

// CyBerFuN .::. ajaxpoll
// http://tracker.cyberfun.ro/
// http://www.cyberfun.ro/
// http://xlist.ro/
// Modified By cybernet2u

class poll {
  var $ID;
  var $pollerTitle;
  var $table_prefix;

  function poll() {
    global $TABLE_PREFIX;
    $this->ID = '';
    $this->pollerTitle = '';
    $this->table_prefix = $TABLE_PREFIX;
  }

  function setId($id) {
    $this->ID = $id;
  }

  function getDataById($id) {
    $res = do_sqlquery("select * from {$this->table_prefix}poller where ID='$id'");
    if($inf = mysql_fetch_array($res)) {
      $this->ID = $inf['ID'];
      $this->pollerTitle = $inf['pollerTitle'];
      $this->active = $inf['active'];
    }
  }

  /* This method returns poller options as an associative array */
  function getOptionsAsArray() {
    $retArray = array();
    $res = do_sqlquery("select * from {$this->table_prefix}poller_option where pollerID='".$this->ID."' order by pollerOrder");
    while($inf = mysql_fetch_array($res))
      $retArray[$inf['ID']] = array($inf['optionText'],$inf['pollerOrder']);
    return $retArray;
  }

  /* This method returns number of votes as an associative array */
  function getVotesAsArray() {
    $retArray = array();
    $res = do_sqlquery("select v.optionID,count(v.ID) as countVotes from {$this->table_prefix}poller_vote v,{$this->table_prefix}poller_option o where v.optionID = o.ID and o.pollerID = '".$this->ID."' group by v.optionID");
    while($inf = mysql_fetch_array($res))
      $retArray[$inf['optionID']] = $inf['countVotes'];
    return $retArray;
  }

  /* Create new poller and return ID of new poller */
  function createNewPoller($pollerTitle, $userid, $active) {
    global $db;

    $pollerTitle = mysql_real_escape_string($pollerTitle);

    if ($active == 'yes') {
      quickQuery("UPDATE {$this->table_prefix}poller SET active='no', endDate=UNIX_TIMESTAMP() WHERE poller.active='yes'");
      quickQuery("insert into {$this->table_prefix}poller(pollerTitle,starterID,active,startDate)values('$pollerTitle','$userid','yes',UNIX_TIMESTAMP())") or die(mysql_error());
    } elseif  ($active == 'no')
      quickQuery("insert into {$this->table_prefix}poller(pollerTitle,endDate,starterID,active,startDate)values('$pollerTitle',UNIX_TIMESTAMP(),'$userid','no',UNIX_TIMESTAMP())") or die(mysql_error());

    $this->ID = mysql_insert_id();
    return $this->ID;
  }

  /* Add poller options */
  function addPollerOption($optionText, $pollerOrder) {
    $optionText = mysql_real_escape_string($optionText);
    quickQuery("insert into {$this->table_prefix}poller_option(pollerID,optionText,pollerOrder)values('".$this->ID."','".$optionText."','".$pollerOrder."')") or die(mysql_error());
    return mysql_insert_id();
  }

  /* Delete a poll, options in the poll and votes */
  function deletePoll($pollId) {
    quickQuery("delete from {$this->table_prefix}poller where ID='$pollId'");
    $res = do_sqlquery("select * from {$this->table_prefix}poller_option where pollerID='".$pollId."'");
    while($inf = mysql_fetch_array($res)) {
      quickQuery("delete from {$this->table_prefix}poller_vote where optionID='".$inf['ID']."'");
      quickQuery("delete from {$this->table_prefix}poller_option where ID='".$inf['ID']."'");
    }
  }

  /* Updating poll title */
  function setPollerTitle($pollerTitle) {
    $pollerTitle = mysql_escape_string($pollerTitle);
    quickQuery("update {$this->table_prefix}poller set pollerTitle='$pollerTitle' where ID='".$this->ID."'");
  }

  function setPollerActive($pollerActive) {
    if ($pollerActive == 'yes')
      quickQuery("UPDATE {$this->table_prefix}poller SET endDate=UNIX_TIMESTAMP(), active='no' WHERE poller.active='yes'");
    quickQuery("UPDATE {$this->table_prefix}poller SET endDate='0', active='$pollerActive' WHERE ID='".$this->ID."'");
  }

  /* Update option label */
  function setOptionData($newText, $order,$optionId) {
    $newText = mysql_real_escape_string($newText);
    quickQuery("update {$this->table_prefix}poller_option set optionText='".$newText."',pollerOrder='$order' where ID='".$optionId."'");
  }

  /* Get position of the last option, i.e. to append a new option at the bottom of the list */
  function getMaxOptionOrder() {
    $res = do_sqlquery("select max(pollerOrder) as maxOrder from {$this->table_prefix}poller_option where pollerID='".$this->ID."'") or die(mysql_error());
    if($inf = mysql_fetch_array($res))
      return $inf['maxOrder'];
    return 0;
  }
}
?>