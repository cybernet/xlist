#!/usr/local/bin/php
<?

/*
 *   Almost all of this code is copied from torrage - We just modified it to run at the cmd-line instead of handling uploads.
 *
 *   The lists of working and non-working and obsolete trackers were compiled by them.
 *   We just use them as is, so look at the lists if there is something you don't agree with and change it.
 *
 *   IMPORTANT LEGAL NOTICE:
 *
 *     # Don't add the OBT tracker to torrents resulting in unauthorized distribution of copyrighted content.
 *
 *     # Don't add the OBT tracker to massive amounts of torrents without first contacting OBT.
 *
 */



/*
 *     Config - 1 to enable, 0 to disable, the functionality.
 */


// Basic sanity - Remove trackers not starting with udp:// http:// dht://
//                or having double protocol prefixes or illegall characters
//                in the url.
//
//                Strict removes any url not having /announce or /tracker
$basicsanity = 1;
$basicsanity_strict = 1;

// Removal of IP-only trackers
$removeiponly = 1;


// Detection of several large trackers known to support UDP, and add the udp:// tracker url.
$add_udp_url = 1;


// Add a comment to the torrent
$add_comment = 0;
$comment_to_add = "This is and example comment";


// Remove existing comments
$rem_comment = 1;


// Are the .torrent files stored on disk in gzip format (most will have 0 here)
$gz_storage = 0;


// Tracker patterns known to support the udp:// protocol
# $udp_patterns[]="example.tracker.com";
# $udp_patterns[]="othertracker.doman.com:1234";


// Additional trackers to be added to each torrent
# $add_trackers[]="http://tracker.publicbt.com/announce";
# $add_trackers[]="udp://tracker.publicbt.com:80/announce";


// Remove trackers know not to exist anymore
$useblacklist = 1;


// Tracker patterns we want to remove
$rem_patterns[]="moviex.info";             // Abusive tracker



/*
 *  End of configure options
 */








// Usage
if ((!$argv[1]) || ($argv[1] == "-h") || ($argv[1] == "--help")) {
  echo "\nUsage: $argv[0] torrent_to_clean.torrent\n\n";
  echo "To clean mutiple files try someting like:\n";
  echo "  find /path/to/torrentfiles/ -type f -name \*.torrent | xargs -n1 $argv[0]\n\n";
  exit(0);
}

$torr = new Torrent();

if (!file_exists($argv[1]))
 die("Error: File not found: $argv[1]\n");

if ($gz_storage) {
  if (!$torr->load(gzdecode(file_get_contents($argv[1]))))
   die("Error: Could not open file (not a torrent file ?): $argv[1]\n");
} else {
  if (!$torr->load(file_get_contents($argv[1])))
   die("Error: Could not open file (not a torrent file ?): $argv[1]\n");
}
$tr=$torr->getTrackers();
$trackers=array_unique($tr);

$rem_patterns[]="openbittorrent";        // We always set the openbittorrent tracker so remove any duplicates.
$rem_patterns[]="/scrape";               // No scrape in announce URL's

// Trackers used by The Pirate Bay in the past
$rem_patterns[]="thepiratebay";
$rem_patterns[]="piratebay.";
$rem_patterns[]=".prq.to/";
$rem_patterns[]=".prq.to:";
if (!$removeiponly) {
  $rem_patterns[]="p://217.75.120.";     // IP range of TPB tracker in 2003-2004
  $rem_patterns[]="p://83.140.";         // IP range of TPB tracker in 2004-2005
  $rem_patterns[]="p://85.17.40.";       // IP range of TPB tracker in 2006 (After the raid)
  $rem_patterns[]="p://77.247.176.";     // IP range of TPB tracker in 2007-2008 move from LeaseWeb to NForce
  $rem_patterns[]="p://91.191.138.";     // IP range of TPB tracker in 2009 
  $rem_patterns[]="p://192.121.86.";     // Current IP range of TPB tracker (IP's should never be used only DNS names)
}

if ($useblacklist) use_blacklist();

// Trackers known to support UDP
$udp_patterns[]="denis.stalker.h3q.com:6969";
$udp_patterns[]="tracker.publicbt.com";
$udp_patterns[]="inferno.demonoid.com";
$udp_patterns[]="tracker.torrentbox.com:2710";
$udp_patterns[]="tracker.istole.it";
$udp_patterns[]="tntvillage.org";
$udp_patterns[]="colombo-bt.org";
$udp_patterns[]="www.lamsoft.net:6969";
$udp_patterns[]="bt.cngba.com:6969";
$udp_patterns[]="mongo56.org";
$udp_patterns[]=".125a.net";
$udp_patterns[]=".btme.net";
$udp_patterns[]=".btally.net";
$udp_patterns[]="btbeat.com:2710";
$udp_patterns[]="tracker.tntvillage.scambioetico.org:2710";
$udp_patterns[]="bt.btbbt.com:7272";
$udp_patterns[]=".tgbus.com";
$udp_patterns[]="tracker2.torrentbox.com:2710";


/* Decoding loop - Start */
reset($trackers);
foreach ($trackers AS $id => $tracker) {

  // Updated tracker url's  -  tracker{1-5}.istole.it:60500 to tracker.istole.it:80
  if (stristr($tracker, ".istole.it:60500/")) {
    $trackers[$id]="http://tracker.istole.it/announce";
    continue;
  }

  // Updated tracker url's  -  tracker.sladinki007.net to tracker.istole.it:80
  if (stristr($tracker, "sladinki007.net")) {
    $trackers[$id]="http://tracker.istole.it/announce";
    continue;
  }

  // Updated tracker url's  -  eztv trackers to tracker.istole.it:80
  if (stristr($tracker, "eztv")) {
    $trackers[$id]="http://tracker.istole.it/announce";
    continue;
  }

  // Miss spelled annonce => announce
  if (stristr($tracker, "annonce")) {
    $trackers[$id]=str_replace("annonce", "announce", trim(urldecode($tracker)));
    continue;
  }

  // Detect typo /announce
  if ((!stristr($tracker, "dht://")) && (stristr($tracker, "/an"))) {
    unset($l, $p, $have_php);
    $l=strlen($tracker);
    $p=stripos($tracker, "/an", 15);
    if (stristr(substr($tracker, $p), ".php")) $have_php=1;
    // Make sure we are at the end.
    if (($l-$p < 16) && ($have_php)) {
      $trackers[$id]=substr($tracker, 0, $p) . "/announce.php";
      continue;
    } elseif ($l-$p < 12) {
      $trackers[$id]=substr($tracker, 0, $p) . "/announce";
      continue;
    }
  }

  $trackers[$id]=trim(urldecode($tracker));
}
/* Decoding loop - End */


/* Sanity loop - Start */
unset($tr_add);
reset($trackers);
foreach ($trackers AS $id => $tracker) {

  // Remove :80 from http URL's
  if ( (stristr($tracker, "http://")) && (strstr($tracker, ":80/")) ) {
    unset($trackers[$id]);
    $tr_add[] = str_replace(":80/", "/", $tracker);
  }

  // Add :80 to udp:// url's with no port
  if ( (stristr($tracker, "udp://")) && (!strstr(substr($tracker, 6), ":")) ) {
    unset($trackers[$id]);
    $tr_add[] = substr($tracker, 0, strpos($tracker, "/", 6)).":80".substr($tracker, strpos($tracker, "/", 6))."\n";
  }
}
$trackers=merge_trackers($trackers, $tr_add);
/* Sanity loop - End */


/* Removal loop - Start */
unset($tr_add);
reset($trackers);
foreach ($trackers AS $id => $tracker) {
  reset($rem_patterns);

  // Remove trackers specified in $rem_patterns.
  foreach ($rem_patterns AS $rem_pattern) {
    if (stristr($tracker, $rem_pattern)) {
      unset($trackers[$id]);
      continue;
    }
  }

  // Get host part
  unset($s, $e);
  if (!stristr($tracker, "dht://")) {
    $s=stripos($tracker, "p://")+4;
    $e=stripos($tracker, ":", $s);
    if ($e === false) $e=strpos($tracker, "/", $s);
    $trhost=substr($tracker, $s, $e-$s);
  }

  // Basic sanity - remove failing tracker URL's
  if ($basicsanity) {

    // Remove too short urls, "udp://aa.aa/announce" beeing the minimum for non dht
    if ((!stristr($tracker, "dht://")) && (strlen($tracker) < 20)) {
      unset($trackers[$id]);
      continue;
    }

    // A dht:// url is always 59 bytes 
    if ((stristr($tracker, "dht://")) && (strlen($tracker) != 59 )) {
      unset($trackers[$id]);
      continue;
    }

    // Require a /announce or /tracker in the url
    if ($basicsanity_strict) {
      if ((!stristr($tracker, "dht://")) && (!(stristr($tracker, "/announce")) || (stristr(substr($tracker, 8), "/tracker")))) {
        /*
         *  TODO: Add check in whitelist to find matching tracker
         */
        unset($trackers[$id]);
        continue;
      }
    }

    // Check that we have atleast 3 slashes, not including a / as last character
    if ((!stristr($tracker, "dht://")) && (substr_count(substr($tracker, 0, strlen($tracker)-1), "/") < 3)) {
      unset($trackers[$id]);
      continue;
    }

    // url having www. but no /announce
    if ((!stristr($tracker, "dht://")) && ((stristr($tracker, "www.")) && (!stristr($tracker, "/announce")))) {
      /*
       *  TODO: Add check in whitelist to find matching tracker
       */
      unset($trackers[$id]);
      continue;
    }

    // Remove trackers not starting with udp:// http:// dht://
    if (!( (stripos(" ".$tracker, "udp://")  == 1) ||
           (stripos(" ".$tracker, "dht://")  == 1) ||
           (stripos(" ".$tracker, "http://") == 1) )) {
      unset($trackers[$id]);
      continue;
    }

    // Check for double protocol prefixes.
    if (stripos($tracker, "://", 5) !== FALSE) {
      unset($trackers[$id]);
      continue;
    }

    // Check for illegal characters.
    if (!is_valid_url($tracker)) {
      unset($trackers[$id]);
      continue;
    }

    // Remove url's with two .. (dots) in a row..
    if (strstr($trhost, "..")) {
      unset($trackers[$id]);
      continue;
    }

    // Remove url's where any of the last 3 charrs is a number
    if ( (is_numeric(substr($trhost, strlen($trhost)-1, 1))) ||
         (is_numeric(substr($trhost, strlen($trhost)-2, 1))) ||
         (is_numeric(substr($trhost, strlen($trhost)-3, 1))) ) {
      unset($trackers[$id]);
      continue;
    }

    // Remove url's that have no . (dot) in the host part
    if (!strstr($trhost, ".")) {
      unset($trackers[$id]);
      continue;
    }
  }

  // Removal of IP-only trackers
  if ($removeiponly) {
    if (ip2long($trhost) !== FALSE) {
      unset($trackers[$id]);
    }
  }
}
/* Removal loop - End */


/* UDP tracker Loop - Start */
unset($tr_add);
reset($trackers);
foreach ($trackers AS $id => $tracker) {

  // Detection of several large trackers known to support UDP, and add the udp:// tracker url.
  if ($add_udp_url) {
    reset($udp_patterns);
    foreach($udp_patterns AS $udp_pattern) {
      unset($s, $e);
      if (stristr($tracker, $udp_pattern)) {
        unset($trackers[$id]);
        $s=stripos($tracker, "p://");
        $e=stripos($tracker, ":", $s+4);
        if ($e === false) {
          $e=strpos($tracker, "/", $s+4);
          $port=80;
          $p=$e;
        } else {
          $p=strpos($tracker, "/", $e);
          $port=substr($tracker, $e+1, $p-$e-1);
        }

        // Add - http://
        if ($port == 80) $tr_add[] = "htt".substr($tracker, $s, $e-$s).substr($tracker, $p);
          else           $tr_add[] = "htt".substr($tracker, $s, $e-$s).":$port".substr($tracker, $p);

        // Add - udp://
                         $tr_add[] =  "ud".substr($tracker, $s, $e-$s).":$port".substr($tracker, $p);

      }
    }
  }
}
$trackers=merge_trackers($trackers, $tr_add);
/* UDP tracker Loop - END */


// Add the aditional trackers
if (is_array($add_trackers)) {
  $trackers=merge_trackers($trackers, $add_trackers);
}


// Make sure we don't have any duplicate trackers
$trackers=array_unique($trackers);


// Set the OBT trackers.
array_push($trackers, "udp://tracker.openbittorrent.com:80/announce");
array_push($trackers, "http://tracker.openbittorrent.com/announce");
$trackers=array_reverse($trackers);


// Clear existing comments
if ($rem_comment) {
  $torr->torrent->remove("comment.utf-8");
  $torr->torrent->remove("comment");
}


// Set a custom comment
if ($add_comment) {
  $torr->setComment($comment_to_add);
  $torr->torrent->remove("comment.utf-8");
}

$torr->setTrackers($trackers);
$tdata=$torr->bencode();

if (!$tdata)
  die("Error: We did not produce valid torrent data\n");

if ($gz_storage) {
  if (!file_put_contents($argv[1],gzencode($tdata,9)))
   die("Error writing file\n");
} else {
  if (!file_put_contents($argv[1], $tdata))
   die("Error writing file\n");
}

echo "Successfully updated $argv[1]\n";
exit(0);


/* Functions - Start */
function merge_trackers($tr, $tr_add) {
  if (is_array($tr_add)) {
    foreach ($tr_add AS $a) {
      $tr[]=$a;
    }
  }
  unset($a, $tr_add);
  return array_unique($tr);
}

function is_valid_char($c) {
  // Valid chars   37-38, 43, 45-58, 61, 63, 65-90, 95, 97-122

  $char=ord($c);
  if ($char == 37) return true;
  if ($char == 38) return true;
  if ($char == 43) return true;
  if (($char >= 45) && ($char <= 58)) return true;
  if ($char == 61) return true;
  if ($char == 63) return true;
  if (($char >= 65) && ($char <= 90)) return true;
  if ($char == 95) return true;
  if (($char >= 97) && ($char <= 122)) return true;

  return false;
}

function is_valid_url($url) {
  for ($i=0 ; $i < strlen($url) ; $i++) {
    if (!is_valid_char($url[$i])) return false;
  }
  return true;
}

function write_trackerfile($tr) {
  if (!is_array($tr)) return false;
  $fp=fopen("/trackerfile.txt", "a+");
  foreach ($tr as $t) {
    fwrite($fp, "$t\n");
  }
  fclose($fp);
  return true;
}

function gzdecode($data) {
  $g=tempnam('/tmp', 'php-gz');
  @file_put_contents($g, $data);
  ob_start();
  readgzfile($g);
  $d=ob_get_clean();
  unlink($g);
  return $d;
}
/* Functions - End */


/* Third party stuff from torrenteditor.com - Start */
class Torrent
{
    public $torrent;
    public $info;
    public $error;
    
    public function load( &$data )
    {
        $this->torrent = BEncode::decode( $data );

        if ( $this->torrent->get_type() == 'error' )
        {
            $this->error = $this->torrent->get_plain();
            return false;
        }
        else if ( $this->torrent->get_type() != 'dictionary' )
        {
            $this->error = 'The file was not a valid torrent file.';
            return false;
        }
        
        $this->info = $this->torrent->get_value('info');
        if ( !$this->info )
        {
            $this->error = 'Could not find info dictionary.';
            return false;
        }
        
        return true;
    }
    
    public function loadPost( &$post )
    {
        // Decode
        if ( $this->load( base64_decode( $post['raw'] ) ) == false ) {
            return false;
        }
        
        $this->setComment( $post['comment'] );
        $this->setCreatedBy( $post['created_by'] );
        $this->setPrivate( $post['private'] );
        
        if ( isset( $post['creation_date'] ) )
        {
            @list( $date, $time ) = explode( ' ', $post['creation_date'] );
            @list( $month, $day, $year ) = explode( '/', $date );
            @list( $hour, $minute, $second ) = explode( ':', $time );
            $this->setCreationDate( @mktime( $hour, $minute, $second, $month, $day, $year ) );
        } else
        {
            $this->setCreationDate( null );
        }
        
        // Set Directory
        if ( isset( $_POST['name'] ) )
        {
            $string = new BEncode_String( $_POST['name'] );
            $this->info->set( 'name', $string );
        }

        // Load files
        $files = array();
        while ( list( $key, $value) = each( $post ) )
        {
            @list( $name, $num ) = explode( '_', $key );
            if ( $name == 'file' )
            {
                array_push( $files, $value );
            }
        }
        $this->setFiles( $files );

        // Load tracker list
        $trackerlist = array();
        
        reset( $post );
        while ( list( $key, $value) = each( $post ) )
        {
            @list( $name, $num ) = explode( '_', $key );
            if ( $name == 'tracker' )
            {
                if ( $value )
                {
                    array_push( $trackerlist, $value );
                }
            }
        }
        $this->setTrackers( $trackerlist );
        
        return true;
    }
    
    public function getComment() {
        return $this->torrent->get_value('comment') ? $this->torrent->get_value('comment')->get_plain() : null;
    }
    
    public function getCreationDate() {
        return  $this->torrent->get_value('creation date') ? $this->torrent->get_value('creation date')->get_plain() : null;
    }
    
    public function getCreatedBy() {
        return $this->torrent->get_value('created by') ? $this->torrent->get_value('created by')->get_plain() : null;
    }
    
    public function getName() {
        return $this->info->get_value('name')->get_plain();
    }
    
    public function getPieceLength() {
        return $this->info->get_value('piece length')->get_plain();
    }
    
    public function getPieces() {
        return $this->info->get_value('pieces')->get_plain();
    }
    
    public function getPrivate() {
        if ( $this->info->get_value('private') )
        {
            return $this->info->get_value('private')->get_plain();
        }
        return -1;
    }
    
    public function getFiles() {
        // Load files
        $filelist = array();
        $length = $this->info->get_value('length');
        
        if ( $length )
        {
            $file = new Torrent_File();
            $file->name = $this->info->get_value('name')->get_plain();
            $file->length =  $this->info->get_value('length')->get_plain();
            array_push( $filelist, $file );
        }
        else if ( $this->info->get_value('files') )
        {
            $files = $this->info->get_value('files')->get_plain();
            while ( list( $key, $value ) = each( $files ) )
            {
                $file = new Torrent_File();

                $path = $value->get_value('path')->get_plain();
                while ( list( $key, $value2 ) = each( $path ) )
                {
                    $file->name .= "/" . $value2->get_plain();
                }
                $file->name = ltrim( $file->name, '/' );
                $file->length =  $value->get_value('length')->get_plain();

                array_push( $filelist, $file );
            }
        }
        
        return $filelist;
    }
    
    public function getTrackers() {
        // Load tracker list
        $trackerlist = array();
        
        if ( $this->torrent->get_value('announce-list') )
        {
            $trackers = $this->torrent->get_value('announce-list')->get_plain();
            while ( list( $key, $value ) = each( $trackers ) )
            {
                if ( is_array( $value->get_plain() ) ) {
                    while ( list( $key, $value2 ) = each( $value ) )
                    {
                        while ( list( $key, $value3 ) = each( $value2 ) )
                        {
                            array_push( $trackerlist, $value3->get_plain() );
                        }
                    }
                } else {
                    array_push( $trackerlist, $value->get_plain() );
                }
            }
        }
        else if ( $this->torrent->get_value('announce') )
        {
            array_push( $trackerlist, $this->torrent->get_value('announce')->get_plain() );
        }
        
        return $trackerlist;
    }
    
    ////////////
    // SET
    ///////////
    
    public function setTrackers( $trackerlist )
    {
        if ( count( $trackerlist ) >= 1 )
        {
            $this->torrent->remove('announce-list');
            $string = new BEncode_String( $trackerlist[0] );
            $this->torrent->set( 'announce', $string );
        }
            
        if ( count( $trackerlist ) > 1 )
        {
            $list = new BEncode_List();
            

            while ( list( $key, $value ) = each( $trackerlist ) )
            {
                $list2 = new BEncode_List();
                $string = new BEncode_String( $value );
                $list2->add( $string );
                $list->add( $list2 );
            }
            
            $this->torrent->set( 'announce-list', $list );
        }
    }
    
    public function setFiles( $filelist )
    {
        // Load files
        $length = $this->info->get_value('length');

        if ( $length )
        {
            $filelist[0] = str_replace( '\\', '/', $filelist[0] );
            $string = new BEncode_String( $filelist[0] );
            $this->info->set( 'name', $string );
        }
        else if ( $this->info->get_value('files') )
        {
            $files = $this->info->get_value('files')->get_plain();
            for ( $i = 0; $i < count( $files ); ++$i )
            {
                $file_parts = split( '/', $filelist[$i] );
                $path = new BEncode_List();
                foreach ( $file_parts as $part )
                {
                    $string = new BEncode_String( $part );
                    $path->add( $string );
                }
                $files[$i]->set( 'path', $path );
            }
        }
    }
    
    public function setComment( $value )
    {
        $type = 'comment';
        $key = $this->torrent->get_value( $type );
        if ( $value == '' ) {
            $this->torrent->remove( $type );
        } elseif ( $key ) {
            $key->set( $value );
        } else {
            $string = new BEncode_String( $value );
            $this->torrent->set( $type, $string );
        }
    }
    
    public function setCreatedBy( $value )
    {
        $type = 'created by';
        $key = $this->torrent->get_value( $type );
        if ( $value == '' ) {
            $this->torrent->remove( $type );
        } elseif ( $key ) {
            $key->set( $value );
        } else {
            $string = new BEncode_String( $value );
            $this->torrent->set( $type, $string );
        }
    }
    
    public function setCreationDate( $value )
    {
        $type = 'creation date';
        $key = $this->torrent->get_value( $type );
        if ( $value == '' ) {
            $this->torrent->remove( $type );
        } elseif ( $key ) {
            $key->set( $value );
        } else {
            $int = new BEncode_Int( $value );
            $this->torrent->set( $type, $int );
        }
    }
    
    public function setPrivate( $value )
    {
        if ( $value == -1 ) {
            $this->info->remove( 'private' );
        } else {
            $int = new BEncode_Int( $value );
            $this->info->set( 'private', $int );
        }
    }
    
    public function bencode()
    {
        return $this->torrent->encode();
    }
    
    public function get_hash()
    {
        return strtoupper( sha1( $this->info->encode() ) );
    }
}

class Torrent_File
{
    public $name;
    public $length;
}

class BEncode
{
    public static function &decode( &$raw, &$offset=0 )
    {   
        if ( $offset >= strlen( &$raw ) )
        {
            return new BEncode_Error( "Decoder exceeded max length." ) ;
        }
        
        $char = $raw[$offset];
        switch ( $char )
        {
            case 'i':
                $int = new BEncode_Int();
                $int->decode( &$raw, $offset );
                return $int;
                
            case 'd':
                $dict = new BEncode_Dictionary();

                if ( $check = $dict->decode( &$raw, $offset ) )
                {
                    return $check;
                }
                return $dict;
                
            case 'l':
                $list = new BEncode_List();
                $list->decode( &$raw, $offset );
                return $list;
                
            case 'e':
                return new BEncode_End();
                
            case '0':
            case is_numeric( $char ):
                $str = new BEncode_String();
                $str->decode( &$raw, $offset );
                return $str;

            default:
                return new BEncode_Error( "Decoder encountered unknown char '$char' at offset $offset." );
        }
    }
}

class BEncode_End
{
    public function get_type()
    {
        return 'end';
    }
}

class BEncode_Error
{
    private $error;
    
    public function BEncode_Error( $error )
    {
        $this->error = $error;
    }
    
    public function get_plain()
    {
        return $this->error;
    }
    
    public function get_type()
    {
        return 'error';
    }
}

class BEncode_Int
{
    private $value;
    
    public function BEncode_Int( $value = null )
    {
        $this->value = $value;
    }

    public function decode( &$raw, &$offset )
    {
            $end = strpos( &$raw, 'e', $offset );
            $this->value = substr( &$raw, ++$offset, $end - $offset );
            $offset += ( $end - $offset );
    }

    public function get_plain()
    {
        return $this->value;
    }

    public function get_type()
    {
        return 'int';
    }
    
    public function encode()
    {
        return "i{$this->value}e";
    }
    
    public function set( $value )
    {
        $this->value = $value;
    }
}

class BEncode_Dictionary
{
    public $value = array();
    
    public function decode( &$raw, &$offset )
    {
            $dictionary = array();

            while ( true )
            {
                $name = BEncode::decode( &$raw, ++$offset );

                if ( $name->get_type() == 'end' )
                {
                    break;
                }
                else if ( $name->get_type() == 'error' )
                {
                    return $name;
                }
                else if ( $name->get_type() != 'string' )
                {
                    return new BEncode_Error( "Key name in dictionary was not a string." );
                }

                $value = BEncode::decode( &$raw, ++$offset );

                if ( $value->get_type() == 'error' )
                {
                    return $value;
                }

                $dictionary[$name->get_plain()] = $value;
            }

            $this->value = $dictionary;
    }
    
    public function get_value( $key )
    {
        if ( isset( $this->value[$key] ) )
        {
            return $this->value[$key];
        }
        else
        {
            return null;
        }
    }
    
    public function encode()
    {
        $this->sort();

        $encoded = 'd';
        while ( list( $key, $value ) = each( $this->value ) )
        {
            $bstr = new BEncode_String();
            $bstr->set( $key );
            $encoded .= $bstr->encode();
            $encoded .= $value->encode();
        }
        $encoded .= 'e';
        return $encoded;
    }

    public function get_type()
    {
        return 'dictionary';
    }
    
    public function remove( $key )
    {
        unset( $this->value[$key] );
    }
    
    public function set( $key, $value )
    {
        $this->value[$key] = $value;
    }
    
    private function sort()
    {
        ksort( $this->value );
    }
    
    public function count()
    {
        return count( $this->value );
    }
}

class BEncode_List
{
    private $value = array();
    
    public function add( $bval )
    {
        array_push( $this->value, $bval );
    }

    public function decode( &$raw, &$offset )
    {
            $list = array();

            while ( true )
            {
                $value = BEncode::decode( &$raw, ++$offset );

                if ( $value->get_type() == 'end' )
                {
                    break;
                }
                else if ( $value->get_type() == 'error' )
                {
                    return $value;
                }
                array_push( $list, $value );
            }

            $this->value = $list;
    }
    
    public function encode()
    {
        $encoded = 'l';
        
        for ( $i = 0; $i < count( $this->value ); ++$i )
        {
            $encoded .= $this->value[$i]->encode();
        }
        $encoded .= 'e';
        return $encoded;
    }
    
    public function get_plain()
    {
        return $this->value;
    }

    public function get_type()
    {
        return 'list';
    }
}

class BEncode_String
{
    private $value;
    
    public function BEncode_String( $value = null )
    {
        $this->value = $value;
    }
    
    public function decode( &$raw, &$offset )
    {
            $end = strpos( &$raw, ':', $offset );
            $len = substr( &$raw, $offset, $end - $offset );
            $offset += ($len + ($end - $offset));
            $end++;
            $this->value = substr( &$raw, $end, $len );
    }
    
    public function get_plain()
    {
        return $this->value;
    }
    
    public function get_type()
    {
        return 'string';
    }
    
    public function encode()
    {
        $len = strlen($this->value);
        return  "$len:{$this->value}";
    }
    
    public function set( $value )
    {
        $this->value = $value;
    }
}
/* Third party stuff from torrenteditor.com - End */

/* Blacklist - Start */
function use_blacklist() {
  global $rem_patterns;

  // DNS Error
  $rem_patterns[]="tracker.torrent.to";
  $rem_patterns[]="tracker.zerotracker.com";
  $rem_patterns[]="tk2.greedland.net";
  $rem_patterns[]="tracker.bitcomet.net";
  $rem_patterns[]="tracker.bt-chat.com";
  $rem_patterns[]="tracker.ydy.com";
  $rem_patterns[]="www.torrentrealm.com";
  $rem_patterns[]="100-percent-dvd.ath.cx";
  $rem_patterns[]="a-classic.dragoneye.ca";
  $rem_patterns[]="a4y.netaiwan.com";
  $rem_patterns[]="acidflux.ath.cx";
  $rem_patterns[]="any.crystalnova.net";
  $rem_patterns[]="assetz.dns2go.com";
  $rem_patterns[]="assetz.dns2go.com";
  $rem_patterns[]="attica.shyper.com";
  $rem_patterns[]="bitfrozen.mybesthost.com";
  $rem_patterns[]="blasphemous.no-ip.org";
  $rem_patterns[]="braincylinder.net";
  $rem_patterns[]="bt.lanspirit.net";
  $rem_patterns[]="btracker.myip.us";
  $rem_patterns[]="clandest1.blogdns.org";
  $rem_patterns[]="cuf.ath.cx";
  $rem_patterns[]="dammkar.dyndns.org";
  $rem_patterns[]="dc.flamevault.com";
  $rem_patterns[]="deadbanger.homeip.net";
  $rem_patterns[]="denis.stalker.h3q";
  $rem_patterns[]="dolphingod.homeip.net";
  $rem_patterns[]="dopetracker.ath.cx";
  $rem_patterns[]="dopetracker.shacknet.nu";
  $rem_patterns[]="e-xtreme.ath.cx";
  $rem_patterns[]="fastloads.ddns.me.uk";
  $rem_patterns[]="george.mopoke.co.uk";
  $rem_patterns[]="gigatorrents.ath.cx";
  $rem_patterns[]="hunted1.mancu.org";
  $rem_patterns[]="josefinefan.dyndns.org";
  $rem_patterns[]="k-neko.info";
  $rem_patterns[]="lastorrent.zapto.org";
  $rem_patterns[]="magikseeder.dyndns.org";
  $rem_patterns[]="manga-fiends.kicks-ass.net";
  $rem_patterns[]="mongo56.mine.nu";
  $rem_patterns[]="music-videos.zapto.org";
  $rem_patterns[]="mustracker.tbmoscow.ru";
  $rem_patterns[]="open-tracker.ath.cx";
  $rem_patterns[]="otg.homedns.org";
  $rem_patterns[]="privatemovieworld.com";
  $rem_patterns[]="ratiofree.com";
  $rem_patterns[]="s93054240.onlinehome.us";
  $rem_patterns[]="stuff.dnsdojo.com";
  $rem_patterns[]="sukamedeek.wtf.la";
  $rem_patterns[]="tf-tracker.mine.nu";
  $rem_patterns[]="torrent.desireactor.com";
  $rem_patterns[]="torresmobtt.dyndns.org";
  $rem_patterns[]="torrstream.com";
  $rem_patterns[]="tracker-b.digital-update.com";
  $rem_patterns[]="tracker-btc-net.dnsdojo.org";
  $rem_patterns[]="tracker-menace.ItemDB.com";
  $rem_patterns[]="tracker.bunglefever.com";
  $rem_patterns[]="tracker.ishtar.ca";
  $rem_patterns[]="tracker.mufftorrent.com";
  $rem_patterns[]="tracker.torrent-force.com";
  $rem_patterns[]="tracker.umt.pl";
  $rem_patterns[]="tracker2.punktorrents.com";
  $rem_patterns[]="tracker4.bol.bg";
  $rem_patterns[]="tracker421.gotdns.org";
  $rem_patterns[]="tracker5.zcultfm.com";
  $rem_patterns[]="trackerhe11bit.getmyip.com";
  $rem_patterns[]="wtf2004.bounceme.net";
  $rem_patterns[]="www.adictobt.net";
  $rem_patterns[]="www.at.trancetraffic.com";
  $rem_patterns[]="www.camfrog-paradise.fr";
  $rem_patterns[]="www.donlilo.com";
  $rem_patterns[]="www.f-cksega2.com";
  $rem_patterns[]="www.g-s-online.org";
  $rem_patterns[]="www.hawkies-one.com";
  $rem_patterns[]="www.mvgroup.org.2710";
  $rem_patterns[]="www.supremetorrents.co.uk";
  $rem_patterns[]="www.torrent-core.com";
  $rem_patterns[]="www.torrent.downloads.to";
  $rem_patterns[]="www.zone2u.net";
  $rem_patterns[]="yahaa.no-ip.org";
  $rem_patterns[]="animetsuki.ath.cx";
  $rem_patterns[]="bitseeker.sixth.biz";
  $rem_patterns[]="box.chapter59.com";
  $rem_patterns[]="bretsatan.is-a-geek.com";
  $rem_patterns[]="bt.ampx.net";
  $rem_patterns[]="bt.diva.ro";
  $rem_patterns[]="bt3.shinsen-subs.be";
  $rem_patterns[]="btwasteland.optus.nu";
  $rem_patterns[]="bunko.theppn.org";
  $rem_patterns[]="code9-kicks-ass.net";
  $rem_patterns[]="dataocean.hopto.org";
  $rem_patterns[]="degrassitorrents.ath.cx";
  $rem_patterns[]="dyntrac.cable.nu";
  $rem_patterns[]="e-xtreme-tracker.ath.cx";
  $rem_patterns[]="football.hn.org";
  $rem_patterns[]="italodance.freesuperhost.com";
  $rem_patterns[]="juani.colirioteam.com.ar";
  $rem_patterns[]="jungletorrents.bounceme.net";
  $rem_patterns[]="justtheboss.dyndns.org";
  $rem_patterns[]="kandyland.dnsalias.net";
  $rem_patterns[]="mame.zapto.org";
  $rem_patterns[]="mizugi.nihon07.es";
  $rem_patterns[]="moviestogo.purehype.net";
  $rem_patterns[]="murfy.dyndns.tv";
  $rem_patterns[]="mysticblue.kicks-ass.org";
  $rem_patterns[]="poseidon.net-addicts.net";
  $rem_patterns[]="royalpalace.ath.cx";
  $rem_patterns[]="slofs-tracker.org";
  $rem_patterns[]="sm-tracker.no-ip.org";
  $rem_patterns[]="souncazzo.altervista.org";
  $rem_patterns[]="space.bscn.com";
  $rem_patterns[]="sumotracker.better-than.tv";
  $rem_patterns[]="tamilmp3site.net";
  $rem_patterns[]="torrents.colirioteam.com.ar";
  $rem_patterns[]="torrents.zaeleus.org";
  $rem_patterns[]="torrentxecution.com";
  $rem_patterns[]="tracker.morkedcram.com";
  $rem_patterns[]="tracker.torrentsrus.co.uk";
  $rem_patterns[]="tracker.unrealmac.com";
  $rem_patterns[]="tracker1.tvtorrents.net";
  $rem_patterns[]="tracker3.zcultfm.com";
  $rem_patterns[]="tracker4.tvtorrents.net";
  $rem_patterns[]="tracker4usall.dyndns.org";
  $rem_patterns[]="tracker5.tvtorrents.net";
  $rem_patterns[]="unrealbittorrents.dnsdojo.com";
  $rem_patterns[]="users.cwi.hu";
  $rem_patterns[]="vip-the-piratebay.homelinux.com";
  $rem_patterns[]="www.0daybrasil.com";
  $rem_patterns[]="www.designs.ravenzoth.com";
  $rem_patterns[]="www.free4fun.org";
  $rem_patterns[]="www.inforlinea.com";
  $rem_patterns[]="www.speed-palace.de";
  $rem_patterns[]="www.storage-dump.biz";
  $rem_patterns[]="www.super-torrents.co.uk";
  $rem_patterns[]="www.team-undertaker7030.net";
  $rem_patterns[]="www.torrents4ever.info";
  $rem_patterns[]="www.tracker.steadyhosting.co.uk";
  $rem_patterns[]="1.tk.btcomic.h3q.com";
  $rem_patterns[]="Hentai-Legacy-BT.dyndns.org";
  $rem_patterns[]="Sp33d.myZ.info";
  $rem_patterns[]="bittorrentfiles.ath.cx";
  $rem_patterns[]="bt.21dx.com";
  $rem_patterns[]="bt.cnmmm.com";
  $rem_patterns[]="bt.nanashi.thedune.ru";
  $rem_patterns[]="e1cd71a748b77ed7efee0a99269cd0abb68ffd35.bthub.com";
  $rem_patterns[]="jenwood.net";
  $rem_patterns[]="kronick.is-a-chef.org";
  $rem_patterns[]="letitburn.titrenium.com";
  $rem_patterns[]="madtracker.advancenetworking.com";
  $rem_patterns[]="novatorrents.dyn.pl";
  $rem_patterns[]="predator2004.ath.cx";
  $rem_patterns[]="rl-tracker.dyndns.org";
  $rem_patterns[]="seedertrack.mydyn.net";
  $rem_patterns[]="tarcker.toptorrent.org";
  $rem_patterns[]="thistorrent.kicks-ass.net";
  $rem_patterns[]="titmouse.gentoo.org";
  $rem_patterns[]="torrential.kicks-ass.net";
  $rem_patterns[]="torrents.pornmovietorrents.info";
  $rem_patterns[]="tracker.audiofarm.cc";
  $rem_patterns[]="tracker.indymedia.org";
  $rem_patterns[]="tracker.ip-cloak.com";
  $rem_patterns[]="tracker2.tvtorrents.net";
  $rem_patterns[]="trackerfree.dyndns.org";
  $rem_patterns[]="trackerw.sytes.net.violation.noiptos.com";
  $rem_patterns[]="www.bigbrotherfans.org";
  $rem_patterns[]="www.darkobox.com";
  $rem_patterns[]="www.ratsheaven.com";
  $rem_patterns[]="www.riojatracker.com";
  $rem_patterns[]="www.team-influx.com";
  $rem_patterns[]="www.wetspunk.net";
  $rem_patterns[]="www.zccustoms.net";
  $rem_patterns[]="zcultfm4.no-ip.org";
  $rem_patterns[]="zionteam.ultrahost.pl";
  $rem_patterns[]="asgaard.area11.net";
  $rem_patterns[]="blackcat.kicks-ass.net";
  $rem_patterns[]="bt.miriamyeung.com.tw";
  $rem_patterns[]="bt.netshowbbs.com";
  $rem_patterns[]="bt.sumisora.com";
  $rem_patterns[]="captian.shacknet.nu";
  $rem_patterns[]="cddvdseeder.com";
  $rem_patterns[]="coxy1987.kicks-ass.org";
  $rem_patterns[]="designs.ravenzoth.com";
  $rem_patterns[]="mininova.hacked.in";
  $rem_patterns[]="mininova.strangled.net";
  $rem_patterns[]="niteshdw.dyndns.org";
  $rem_patterns[]="oandafiles.com";
  $rem_patterns[]="oasis.bscn.com";
  $rem_patterns[]="pokermovieworld.com";
  $rem_patterns[]="rl-tracker1.dyndns.org";
  $rem_patterns[]="tamilp2p.com";
  $rem_patterns[]="tiredsradio.dyndns.org";
  $rem_patterns[]="torrent.chelloo.com";
  $rem_patterns[]="torrentrealm.dyndns.org";
  $rem_patterns[]="tracker.anirev.net";
  $rem_patterns[]="tracker.binural.ru";
  $rem_patterns[]="tracker.emperortorrents.com";
  $rem_patterns[]="tracker.majin2007.com";
  $rem_patterns[]="tracker.rorikon.net";
  $rem_patterns[]="tracker.traasje.nl";
  $rem_patterns[]="tracker2.mufftorrent.com";
  $rem_patterns[]="trackertdt.podzone.net";
  $rem_patterns[]="www.golden-torrent.info";
  $rem_patterns[]="www.myomegatracker.com";
  $rem_patterns[]="www.newnova.org";
  $rem_patterns[]="www.tracker-mp3.fr";
  $rem_patterns[]="www.xgab.ca";
  $rem_patterns[]="asgaard.server.us";
  $rem_patterns[]="btcyberstorm.sytes.net";
  $rem_patterns[]="exeem.to";
  $rem_patterns[]="eztorrents.scrapping.cc";
  $rem_patterns[]="fileagency.ath.cx";
  $rem_patterns[]="fileagency.cable.nu";
  $rem_patterns[]="hifi-torrents.serveftp.com";
  $rem_patterns[]="justtorrents.gr8domain.biz";
  $rem_patterns[]="kenny.my3website.net";
  $rem_patterns[]="larktorrents.dyndns.org";
  $rem_patterns[]="madmaster.hopto.org";
  $rem_patterns[]="midnightcabbie.com";
  $rem_patterns[]="prime-ports.info";
  $rem_patterns[]="riverrhine.homelinux.net";
  $rem_patterns[]="shardtorrents.no-ip.org";
  $rem_patterns[]="snarfbt.shacknet.nu";
  $rem_patterns[]="torentfiend.ath.cx";
  $rem_patterns[]="torrents.credit4repair.net";
  $rem_patterns[]="torz.repairscredit.net";
  $rem_patterns[]="tracker.casonova.org";
  $rem_patterns[]="tracker.de-bruin.net";
  $rem_patterns[]="tracker.devilz-crew.org";
  $rem_patterns[]="tracker.dontexist.com";
  $rem_patterns[]="tracker.nwfr-board.org";
  $rem_patterns[]="tracker0.bol.bg";
  $rem_patterns[]="tracker1.bol.bg";
  $rem_patterns[]="tracker2.ktxp.com";
  $rem_patterns[]="www.elitenova.net";
  $rem_patterns[]="www.lucky-tracker.com";
  $rem_patterns[]="www.must-suck.net";
  $rem_patterns[]="www.reputationrebel.org";
  $rem_patterns[]="www.seederheaven.co.uk";
  $rem_patterns[]="aplustorrents.qHigh.com";
  $rem_patterns[]="b00b.blogdns.net";
  $rem_patterns[]="bt.heha.org";
  $rem_patterns[]="cheesemuffin.podzone.net";
  $rem_patterns[]="crazymazeys.kicks-ass.org";
  $rem_patterns[]="e1.ath.cx";
  $rem_patterns[]="energiebox.no-ip.biz";
  $rem_patterns[]="freelikeiwanttobe.dynalias.net";
  $rem_patterns[]="site.tuxwarez.info";
  $rem_patterns[]="speedtorrents.tv";
  $rem_patterns[]="thedaddyman.no-ip.info";
  $rem_patterns[]="torrent-zone.ath.cx";
  $rem_patterns[]="torrentit.mine.nu";
  $rem_patterns[]="torrentum.longmusic.com";
  $rem_patterns[]="tracker.fallen-angel.dyndns.org";
  $rem_patterns[]="tracker.niteshdw.com";
  $rem_patterns[]="tracker.prq.t80";
  $rem_patterns[]="trackerN.zcultfm.com";
  $rem_patterns[]="www.3realms-torrents.net";
  $rem_patterns[]="www.animex.be";
  $rem_patterns[]="www.ar3a51.org";
  $rem_patterns[]="www.digitaltv.bwayne.net";
  $rem_patterns[]="www.killerzone-torrents.org";
  $rem_patterns[]="www.pbnova.us";
  $rem_patterns[]="blackcats.myftp.org";
  $rem_patterns[]="bt.iqcrew.net";
  $rem_patterns[]="cooltrack.no-ip.org.violation.noiptos.com";
  $rem_patterns[]="dark-rebells.ath.cx";
  $rem_patterns[]="ddaimaku.no-ip.info";
  $rem_patterns[]="frankyflip.dnyp.com";
  $rem_patterns[]="kraytracker.pwner.info";
  $rem_patterns[]="luclin.bscn.com";
  $rem_patterns[]="nevelover.free.fr";
  $rem_patterns[]="peteparker.redirectme.net";
  $rem_patterns[]="planet-of-torrent.no-ip.biz";
  $rem_patterns[]="premiumscene.org";
  $rem_patterns[]="torrent-baba.ath.cx";
  $rem_patterns[]="torrents.ebrain.com.br";
  $rem_patterns[]="tracker.freshtorrentz.com";
  $rem_patterns[]="tracker.r3v3ng.net";
  $rem_patterns[]="tracker1.zcultfm.com";
  $rem_patterns[]="tracker4.zcultfm.com";
  $rem_patterns[]="united-nation.ath.cx";
  $rem_patterns[]="www.future-tracker.de";
  $rem_patterns[]="www.kurau.info";
  $rem_patterns[]="www.numpski.co.uk";
  $rem_patterns[]="www.wareztotal.com";
  $rem_patterns[]="atlantis-stargate.no-ip.info";
  $rem_patterns[]="bit-bytes.co.uk";
  $rem_patterns[]="coptang.hn.org";
  $rem_patterns[]="cp-bt-track2.from-tx.com";
  $rem_patterns[]="ddram.kicks-ass.org";
  $rem_patterns[]="dont.make-crack.info";
  $rem_patterns[]="eldirnet.no-ip.info";
  $rem_patterns[]="elite-team.blogdns.net";
  $rem_patterns[]="elmo.emaraties.net";
  $rem_patterns[]="final-bits.ath.cx";
  $rem_patterns[]="mp3powa.is-a-chef.com";
  $rem_patterns[]="pornobits.se";
  $rem_patterns[]="servitude.mypets.ws";
  $rem_patterns[]="todotorrente.net";
  $rem_patterns[]="torrent-downloads.shacknet.nu";
  $rem_patterns[]="torrenttrader.zapto.org";
  $rem_patterns[]="wardencliffe.mine.nu";
  $rem_patterns[]="www.scenezone.net";
  $rem_patterns[]="bittorrent.cruise247.net";
  $rem_patterns[]="btit.ceramic.es";
  $rem_patterns[]="ozone-torrents.net";
  $rem_patterns[]="qload-torrentz.epac.to";
  $rem_patterns[]="starfiret.vicp.net";
  $rem_patterns[]="torrentit.shacknet.nu";
  $rem_patterns[]="torrentpirates.org";
  $rem_patterns[]="torrentvalley.servebbs.org";
  $rem_patterns[]="tracker5.bol.bg";
  $rem_patterns[]="www.exeem.to";
  $rem_patterns[]="www.pornobits.se";
  $rem_patterns[]="www.scifi-classics.net";
  $rem_patterns[]="www.yahaa.info";
  $rem_patterns[]="xbttest.dvdquorum.es";
  $rem_patterns[]="animeiji.fansub.org";
  $rem_patterns[]="bt.nerae.com";
  $rem_patterns[]="bt.so-ga.com";
  $rem_patterns[]="btr.myvnc.com";
  $rem_patterns[]="conspiracy.hopto.org";
  $rem_patterns[]="downloadin.wtf.la";
  $rem_patterns[]="hkp2p.homeip.net";
  $rem_patterns[]="sierra117";
  $rem_patterns[]="tc.cyber-planet.org";
  $rem_patterns[]="torrent.autopatcher5.mirror.ineedhosting.net";
  $rem_patterns[]="torrentuniverse.mine.nu";
  $rem_patterns[]="tracker.slax0rz.net";
  $rem_patterns[]="tracker1.homeip.net";
  $rem_patterns[]="tstracker.no-ip.org";
  $rem_patterns[]="wander.thruhere.net";
  $rem_patterns[]="www.scrapcomputers.busydizzys.com";
  $rem_patterns[]="www.torrentbr.org";
  $rem_patterns[]="asgaard.to";
  $rem_patterns[]="bittorrent.anime-supreme.com";
  $rem_patterns[]="bt.leoboard.com";
  $rem_patterns[]="filehunt.wikaba.com";
  $rem_patterns[]="frankyflip.dynamic-dns.net";
  $rem_patterns[]="fulltransfers.cockeyed.com";
  $rem_patterns[]="inferno-demonoid.servebbs.com";
  $rem_patterns[]="prototype24.ath.cx";
  $rem_patterns[]="smk.rapidspace.com";
  $rem_patterns[]="torrent.podzone.org";
  $rem_patterns[]="torrent.raq2.com";
  $rem_patterns[]="tracker.hightorrent.to";
  $rem_patterns[]="tracker.odigopl.dlk.pl";
  $rem_patterns[]="tracker2.reprobate.se";
  $rem_patterns[]="uk-tracker.bol.bg";
  $rem_patterns[]="www.infohash.net";
  $rem_patterns[]="www.wwtorrents.net";
  $rem_patterns[]="bt.joyyang.com";
  $rem_patterns[]="bt.zingking";
  $rem_patterns[]="forum.digimonhimitsu.com";
  $rem_patterns[]="geo.bbtt.tv";
  $rem_patterns[]="h732605.serverkompetenz.net";
  $rem_patterns[]="lightningspeed.info";
  $rem_patterns[]="psychotorrents.com";
  $rem_patterns[]="rotorrentmania.lx.ro";
  $rem_patterns[]="teamapex.myftp.org";
  $rem_patterns[]="torrents.onlinepharmacy1234.com";
  $rem_patterns[]="tracker.area51.org.il";
  $rem_patterns[]="tracker.bitstop.to";
  $rem_patterns[]="tracker.malomania.com.ar";
  $rem_patterns[]="tracker.rainbowfc.com";
  $rem_patterns[]="tracker.requiem-storm.com";
  $rem_patterns[]="www.badgerworld.org";
  $rem_patterns[]="www.bb-torrents.net";
  $rem_patterns[]="www.dataloretracker.com";
  $rem_patterns[]="www.maxi-team.net";
  $rem_patterns[]="anime-legion.elandal.org";
  $rem_patterns[]="books.no-ip.org";
  $rem_patterns[]="bt3.uglab.org";
  $rem_patterns[]="bytepusher.info";
  $rem_patterns[]="champ2220.dyndns.biz";
  $rem_patterns[]="minipirate.eliteguild.info";
  $rem_patterns[]="pt-is-the-biz.com";
  $rem_patterns[]="torrent.hetetieners.eu";
  $rem_patterns[]="tracker.meganova.org";
  $rem_patterns[]="warezxploit.org";
  $rem_patterns[]="welltech.ath.cx";
  $rem_patterns[]="wollnik.homeip.net";
  $rem_patterns[]="www.larktorrents.info";
  $rem_patterns[]="a-bt.ath.cx";
  $rem_patterns[]="abetterplace2b.biz";
  $rem_patterns[]="dc-scene.wrzhost.com";
  $rem_patterns[]="jonnyfavorite.servebeer.com";
  $rem_patterns[]="sladinki007.eu";
  $rem_patterns[]="smokin.indoserver.org";
  $rem_patterns[]="t.arminter.net";
  $rem_patterns[]="thisisanopentracker.com";
  $rem_patterns[]="tracker-torrentbox.is-a-geek.com";
  $rem_patterns[]="verkemer.ath.cx";
  $rem_patterns[]="www.gravesilent.net";
  $rem_patterns[]="www.reload-tracker.net";
  $rem_patterns[]="bt.luao.net";
  $rem_patterns[]="bt.luao.net";
  $rem_patterns[]="chaos-wasteland.dyndns.org";
  $rem_patterns[]="dromedatracker.sytes.net";
  $rem_patterns[]="rl-tracker.2mydns.com";
  $rem_patterns[]="seed-freak.org";
  $rem_patterns[]="seedorbleed.org";
  $rem_patterns[]="tracker-zerotracker.servebbs.com";
  $rem_patterns[]="tracker.bakadownloads.com";
  $rem_patterns[]="tracker.hknd.com";
  $rem_patterns[]="tracker.homeunix.net";
  $rem_patterns[]="tracker.packy.se";
  $rem_patterns[]="bittorrenttracker.org";
  $rem_patterns[]="bt3.eastgame.net";
  $rem_patterns[]="easydl.fabolo.us";
  $rem_patterns[]="gate-2-paradies-city.mine.nu";
  $rem_patterns[]="krackerjack.servegame.org";
  $rem_patterns[]="miriamyeung.com.tw";
  $rem_patterns[]="pirateazy.org";
  $rem_patterns[]="show.no-ip.org";
  $rem_patterns[]="thezone.scrapping.cc";
  $rem_patterns[]="tracker.btjunkie.org";
  $rem_patterns[]="tracker.manga-ton1x.net";
  $rem_patterns[]="www.adriandaz.host.sk";
  $rem_patterns[]="www.scifitorrents.x8web.com";
  $rem_patterns[]="61.175.209.125.6969";
  $rem_patterns[]="dragon-torrent-world.biz";
  $rem_patterns[]="dvdseeders.gotdns.org";
  $rem_patterns[]="tracker.cartoon-world.org";
  $rem_patterns[]="tracker.polskie-torrenty.pl";
  $rem_patterns[]="www.fuzionteam.net";
  $rem_patterns[]="www.nonuspoker.info";
  $rem_patterns[]="www.spiricomtracks.net";
  $rem_patterns[]="bit-torrents.ath.cx";
  $rem_patterns[]="bt2.eastgame.net";
  $rem_patterns[]="eztvisladinki007.shacknet.nu";
  $rem_patterns[]="flasxitracker.mine.nu";
  $rem_patterns[]="makavelli2003.gotdns.com";
  $rem_patterns[]="nonstopdirekt.servebbs.com";
  $rem_patterns[]="torrent.pills-diets.com";
  $rem_patterns[]="tracker.hetetieners.eu";
  $rem_patterns[]="tracker1.rainbowfc.com";
  $rem_patterns[]="viewtrackerz.merseine.nu";
  $rem_patterns[]="www.cooltorrents.com";
  $rem_patterns[]="www.darks-torrent-world.goldentorrent.net";
  $rem_patterns[]="www.thespongeclub.net";
  $rem_patterns[]="beta.thathustle.com";
  $rem_patterns[]="bt.055.cn";
  $rem_patterns[]="flux-tracker.mine.nu";
  $rem_patterns[]="midnightbits.xxuz.com";
  $rem_patterns[]="minidix.fbi.be";
  $rem_patterns[]="smartorrent.dvrdns.org";
  $rem_patterns[]="torrent-hackers.co.uk";
  $rem_patterns[]="tracker.so-ga.com";
  $rem_patterns[]="waretree.org";
  $rem_patterns[]="www.demonicsouls.net";
  $rem_patterns[]="www.devil-tracker.net";
  $rem_patterns[]="www.dinmamma.be";
  $rem_patterns[]="www.srilankaw-bt.org";
  $rem_patterns[]="zerotracker.servegame.org";
  $rem_patterns[]="azurean-logic.net";
  $rem_patterns[]="bt-tracker.mine.nu";
  $rem_patterns[]="gshk.happy-host.com";
  $rem_patterns[]="perpetualnight-tracker-2.no-ip.info";
  $rem_patterns[]="teamfx.no-ip.org";
  $rem_patterns[]="torrent.potorro.com";
  $rem_patterns[]="tracker.starteamfansub.net";
  $rem_patterns[]="www.ugstorrents.net";
  $rem_patterns[]="appleguru.dyndns.org";
  $rem_patterns[]="www.consoleheaven.in";
  $rem_patterns[]="alphaport-networks.com";
  $rem_patterns[]="bt.yhcmovie.com";
  $rem_patterns[]="driv.dyndns.biz";
  $rem_patterns[]="hth-tracker.mine.nu";
  $rem_patterns[]="public.torrent-kingdom.net";
  $rem_patterns[]="tracker.prg.to";
  $rem_patterns[]="tus.sladinki007.eu";
  $rem_patterns[]="animephobia.bizarre-host.com";
  $rem_patterns[]="torrent.lag.in";
  $rem_patterns[]="tracker.desitirrebts.com";
  $rem_patterns[]="www.torrentmafia.info";
  $rem_patterns[]="torrentq.thecredit-scores.com";
  $rem_patterns[]="tracker.tbfiles.org";
  $rem_patterns[]="www.blackstarbt.co.uk";
  $rem_patterns[]="bit-evolution.ath.cx";
  $rem_patterns[]="latinotorrent.com";
  $rem_patterns[]="www.azureusworld.com";
  $rem_patterns[]="baulwarez.ath.cx";
  $rem_patterns[]="mega-loads.biz";
  $rem_patterns[]="suprnova.dyndns.org";
  $rem_patterns[]="torrent-comet.club-23.org";
  $rem_patterns[]="waretree.homedns.org";
  $rem_patterns[]="when.pigscanfly.ca";
  $rem_patterns[]="www.clawtorrents.org";
  $rem_patterns[]="www.gangters.be";
  $rem_patterns[]="www.genei-ryodan.cl";
  $rem_patterns[]="www.torrentsyndrome.com";
  $rem_patterns[]="www.torrentsyndrome.com";
  $rem_patterns[]="xxxtorrent.kicks-ass.net";
  $rem_patterns[]="bt.itbbs.net";
  $rem_patterns[]="bt.newmov.com";
  $rem_patterns[]="mpaa.servehttp.com";
  $rem_patterns[]="ripper.dnsdojo.net";
  $rem_patterns[]="tracker.stfu.ca";
  $rem_patterns[]="www.3rdrev.com";
  $rem_patterns[]="only-guiness.servebeer.com";
  $rem_patterns[]="speedtracker.lightcast.tv";
  $rem_patterns[]="tpb.tracker.pqr.to";
  $rem_patterns[]="tracker.shadowtech.biz";
  $rem_patterns[]="www.pn5.epac.to";
  $rem_patterns[]="bridged-networks.org";
  $rem_patterns[]="hollybytes.com";
  $rem_patterns[]="newtorrent.apocalypsenet.net";
  $rem_patterns[]="newtorrents.shacknet.nu";
  $rem_patterns[]="shaka.servebbs.com";
  $rem_patterns[]="spirit-of-torrents.redirectme.net";
  $rem_patterns[]="torrents.autos-loans.net";
  $rem_patterns[]="tracker.workisboring.com";
  $rem_patterns[]="bittorment.oCry.com";
  $rem_patterns[]="bt.mindwerks.net";
  $rem_patterns[]="file-world.net";
  $rem_patterns[]="perpetualnight-tracker-3.no-ip.org";
  $rem_patterns[]="tracker.spartacuslives.org";
  $rem_patterns[]="www.giga-bitz.org";
  $rem_patterns[]="www.ugstorrents.com";
  $rem_patterns[]="golinux.co.il";
  $rem_patterns[]="madcow.sytes.net";
  $rem_patterns[]="skyland.sytes.net";
  $rem_patterns[]="www.supaboards.co.uk";
  $rem_patterns[]="www.torrentmx.org";
  $rem_patterns[]="www.yikuai.com";
  $rem_patterns[]="btt.myvnc.com";
  $rem_patterns[]="queuezilla.net";
  $rem_patterns[]="tracker.playtunes.net";
  $rem_patterns[]="arbor.bounceme.net";
  $rem_patterns[]="eztv.kicks-ass.org";
  $rem_patterns[]="farmlyte.tv";
  $rem_patterns[]="tracker.dvdmenubacks.com";
  $rem_patterns[]="tracker.losslessone.org";
  $rem_patterns[]="www.kompletly.com";
  $rem_patterns[]="bt4.eastgame.net";
  $rem_patterns[]="hipostfiles.net";
  $rem_patterns[]="myfusion.no-ip.biz";
  $rem_patterns[]="torrentsunami.mine.nu";
  $rem_patterns[]="ukisok.servehttp.com";
  $rem_patterns[]="www.trackback.ath.cx";
  $rem_patterns[]="bt2.92wy.com";
  $rem_patterns[]="ourfile.163.com";
  $rem_patterns[]="trackera.zcultfm.com";
  $rem_patterns[]="www.tracker.torrentportal.com";
  $rem_patterns[]="estandardtracker.com";
  $rem_patterns[]="17yy.com";
  $rem_patterns[]="agent99.servebbs.net";
  $rem_patterns[]="darkerbytes.org";
  $rem_patterns[]="moviesb4time.info";
  $rem_patterns[]="bt.f234.com";
  $rem_patterns[]="pc5.knoppix-unet.ocn.ne.jp";
  $rem_patterns[]="www.billymck.co.uk";
  $rem_patterns[]="2old2r-r.no-ip.org";
  $rem_patterns[]="matterik.getmyip.com";
  $rem_patterns[]="publictracker.info";
  $rem_patterns[]="sot.kicks-ass.org";
  $rem_patterns[]="bt.yikuai.com";
  $rem_patterns[]="champ1.dyndns.biz";
  $rem_patterns[]="dontcha-generation.no-ip.biz";
  $rem_patterns[]="tracker.mundo-anime.org";
  $rem_patterns[]="www.console-delight.co.uk";
  $rem_patterns[]="sors-tracker.depthstrike.com";
  $rem_patterns[]="superusenet.no-ip.info.violation.noiptos.com";
  $rem_patterns[]="taelva.awardspace.com";
  $rem_patterns[]="www.torrents4us.com";
  $rem_patterns[]="darmeth.ath.cx";
  $rem_patterns[]="yahaaer.dyndns.org";
  $rem_patterns[]="campodelturia.awardspace.com";
  $rem_patterns[]="sharkattacktorrents.shacknet.nu";
  $rem_patterns[]="toylet.homeip.net";
  $rem_patterns[]="devilz-crew.dyndns.org";
  $rem_patterns[]="twighlight-zone.ath.cx";
  $rem_patterns[]="btbypass.edwardk.info";
  $rem_patterns[]="torrents.shexnet.com";
  $rem_patterns[]="tracker.sharetv.org";
  $rem_patterns[]="vtv.sladinki007.eu";
  $rem_patterns[]="bttracker.game.vtc.vn";
  $rem_patterns[]="p2pworld.ulmb.com";
  $rem_patterns[]="princes-of-darkness.redirectme.net";
  $rem_patterns[]="trackersurfer.fr";
  $rem_patterns[]="yahaa.info";
  $rem_patterns[]="bttracker.servebeer.com";
  $rem_patterns[]="novatelbt.net";
  $rem_patterns[]="alchemyrg.sladinki007.net";
  $rem_patterns[]="cyberseeders.ath.cx";
  $rem_patterns[]="deadbeats.acreditrepair.net";
  $rem_patterns[]="smirky.wtf.la";
  $rem_patterns[]="torrents.cashloans247.net";
  $rem_patterns[]="tracker.holyplanets.com";
  $rem_patterns[]="bt1.maopian.com";
  $rem_patterns[]="conspiracycentralx.net";
  $rem_patterns[]="tc-alt.ath.cx";
  $rem_patterns[]="www.sstorrents.co.uk";
  $rem_patterns[]="eazygrab.myftp.org";
  $rem_patterns[]="www.certcity.net";
  $rem_patterns[]="torrent-delight.co.uk";
  $rem_patterns[]="tracker3.digital-update.com";
  $rem_patterns[]="2do4u2.com";
  $rem_patterns[]="eztv2.sladinki007.eu";
  $rem_patterns[]="fin-ii.no-ip.org";
  $rem_patterns[]="matchfile.biz";
  $rem_patterns[]="realable.net";
  $rem_patterns[]="darmeth.kicks-ass.net";
  $rem_patterns[]="trackern.zcultfm.com";
  $rem_patterns[]="booya.fullcontactzone.com";
  $rem_patterns[]="www.cp.torrentbr.org";
  $rem_patterns[]="rl-tracker.2mydns.org";
  $rem_patterns[]="sors-tracker.enlist-a-distro.net";
  $rem_patterns[]="trackerhellbit.podzone.net";
  $rem_patterns[]="www.gobbles-swamp.net";
  $rem_patterns[]="the-snake-pit.co.uk";
  $rem_patterns[]="www.thugracing.com";
  $rem_patterns[]="darksiderg.sladinki007.net";
  $rem_patterns[]="hstorrents.com";
  $rem_patterns[]="alt.team-undertaker7030.net";
  $rem_patterns[]="b00bs.hobby-site.com";
  $rem_patterns[]="torrent.the-creditscore.com";
  $rem_patterns[]="tracker1.digital-update.com";
  $rem_patterns[]="porntracker.no-ip.org";
  $rem_patterns[]="torrents.aphonevoip.com";
  $rem_patterns[]="tracker.digital-corruption.net";
  $rem_patterns[]="dragon-temple.ath.cx";
  $rem_patterns[]="tracker.net-addicts.net";
  $rem_patterns[]="xtorrent.xgab.ca";
  $rem_patterns[]="filehouse.scrapping.cc";
  $rem_patterns[]="torrent1.voip22.net";
  $rem_patterns[]="destroshouse.com";
  $rem_patterns[]="torrents.car2loan.net";
  $rem_patterns[]="www.d-mworld.com";
  $rem_patterns[]="bt.hkserver.org";
  $rem_patterns[]="cyberfun-tracker-001.cyberfun.ro";
  $rem_patterns[]="tracker.torobt.com.ar";
  $rem_patterns[]="tracker2.anirena.com";
  $rem_patterns[]="www.tk80.net";
  $rem_patterns[]="blackcats.filesoup.com";
  $rem_patterns[]="lords-of-darkness.redirectme.net";
  $rem_patterns[]="minitalk.no-ip.org";
  $rem_patterns[]="onii-chan.ath.cx";
  $rem_patterns[]="tzt.ath.cx";
  $rem_patterns[]="tracker2.lokitorrent.com";
  $rem_patterns[]="www.doctorwhotorrents.com";
  $rem_patterns[]="bt1.ali213.net";
  $rem_patterns[]="tracker.mundovob.eu";
  $rem_patterns[]="treehorn.mine.nu";
  $rem_patterns[]="bt.lhvod.com";
  $rem_patterns[]="tracker.ycbt.com";
  $rem_patterns[]="btbtbt.vicp.net";
  $rem_patterns[]="www.power-generation.biz";
  $rem_patterns[]="hpd-crew.homeftp.net";
  $rem_patterns[]="rl-tracker.no-ip.org";
  $rem_patterns[]="bt.51soft.com";
  $rem_patterns[]="gremlinslair.ath.cx";
  $rem_patterns[]="thespongeclub.net";
  $rem_patterns[]="tracker.hot-cell.org";
  $rem_patterns[]="tracker.kaicn.com";
  $rem_patterns[]="bt.chinabtbbt.com";
  $rem_patterns[]="montel.isa-geek.org";
  $rem_patterns[]="jedi.sladinki007.eu";
  $rem_patterns[]="www.mediatorrents.org";
  $rem_patterns[]="boyz.selfip.com";
  $rem_patterns[]="pnyxtr.b33r.net";
  $rem_patterns[]="buccaneer.boldlygoingnowhere.org";
  $rem_patterns[]="minitalk.net";
  $rem_patterns[]="sstorrents.co.uk";
  $rem_patterns[]="bittown.ath.cx";
  $rem_patterns[]="tracker.metrotorrents.info";
  $rem_patterns[]="trackerb.zcultfm.com";
  $rem_patterns[]="blackspeed.mine.nu";
  $rem_patterns[]="pron-now.no-ip.org";
  $rem_patterns[]="bt.newwise.com";
  $rem_patterns[]="serenity.xtc.tc";
  $rem_patterns[]="www.torrent-delight.co.uk";
  $rem_patterns[]="bt.ppxbbs.com";
  $rem_patterns[]="tracker.92wy.com";
  $rem_patterns[]="www.mgatorrents.co.uk";
  $rem_patterns[]="trackerB.zcultfm.com";
  $rem_patterns[]="tracker.so-ga.net";
  $rem_patterns[]="coretracker.no-ip.org";
  $rem_patterns[]="teamfx.kicks-ass.org";
  $rem_patterns[]="ticose.no-ip.org";
  $rem_patterns[]="hockeyphan.mine.nu";
  $rem_patterns[]="tk.chinapsp.net";
  $rem_patterns[]="hellraiserrg.sladinki007.eu";
  $rem_patterns[]="fire-reloaded.ath.cx";
  $rem_patterns[]="spankys.game-server.cc";
  $rem_patterns[]="tp-tracker.ath.cx";
  $rem_patterns[]="bt.skke.net";
  $rem_patterns[]="hollywoodst4u.com";
  $rem_patterns[]="wdb-group-tracker.ath.cx";
  $rem_patterns[]="musicandvideo.myftpsite.net";
  $rem_patterns[]="musicandvideo.myftpsite.net";
  $rem_patterns[]="best-of-torrent.ath.cx";
  $rem_patterns[]="phantombitz.info";
  $rem_patterns[]="bt2.uglab.org";
  $rem_patterns[]="alt.d-t-d.cc";
  $rem_patterns[]="the.nwotracker.info";
  $rem_patterns[]="torrent-space.hopto.org";
  $rem_patterns[]="tracker-a.digital-update.com";
  $rem_patterns[]="mongo56.souptracker.com";
  $rem_patterns[]="tracker.hkorz.com";
  $rem_patterns[]="arktos.ath.cx";
  $rem_patterns[]="sabre-torrents.com";
  $rem_patterns[]="tracker.freaktorrent.net";
  $rem_patterns[]="bt.ydy.com";
  $rem_patterns[]="www.torrentwallpaper.com";
  $rem_patterns[]="downloadpublic.myphotos.cc";
  $rem_patterns[]="tr.ydy.com";
  $rem_patterns[]="tracker.lokitorrent.com";
  $rem_patterns[]="bt.uglab.org";
  $rem_patterns[]="altimit-dev.net";
  $rem_patterns[]="inp2p.247freeringtone.net";
  $rem_patterns[]="www.tracker.torrentspain.com";
  $rem_patterns[]="torrents.a2buyxanax.com";
  $rem_patterns[]="bt.chdtv.net";
  $rem_patterns[]="ww.legittorrents.info";
  $rem_patterns[]="torrents.a-creditrepair.net";
  $rem_patterns[]="molinezja.ota.pl";
  $rem_patterns[]="speed-of-torrents.ath.cx";
  $rem_patterns[]="taelva.no-ip.org";
  $rem_patterns[]="bt.no-sekai.de";
  $rem_patterns[]="tracker.danomac.org";
  $rem_patterns[]="tvnihon.dragoneye.ca";
  $rem_patterns[]="odyssey.acreditrepair2001.com";
  $rem_patterns[]="torrentdealer.mine.nu";
  $rem_patterns[]="ut-tracker.biz";
  $rem_patterns[]="torrent-force.mine.nu";
  $rem_patterns[]="ds-empire.ath.cx";
  $rem_patterns[]="torrential.kicks-ass.org";
  $rem_patterns[]="lossless.servehttp.com";
  $rem_patterns[]="tracker2.rpgtechnologies.com";
  $rem_patterns[]="bt.kaicn.com";
  $rem_patterns[]="www.trackerhellbit.com";
  $rem_patterns[]="homergrown.is-a-chef.com";
  $rem_patterns[]="torrential.dontexist.org";
  $rem_patterns[]="tracker.sladinki007.eu";
  $rem_patterns[]="www.flushtorrents.com";
  $rem_patterns[]="kaffee-wellblech.no-ip.info";
  $rem_patterns[]="ripper.dyn-o-saur.com";
  $rem_patterns[]="localhost";
  $rem_patterns[]="ddong.mine.nu";
  $rem_patterns[]="ddram.kicks-ass.net";
  $rem_patterns[]="bt.ahcomic.com";
  $rem_patterns[]="seedy.mine.nu";
  $rem_patterns[]="boorstar.org";
  $rem_patterns[]="www.xxxforyou.org";
  $rem_patterns[]="bt.zingking.com";
  $rem_patterns[]="rock.sladinki007.eu";
  $rem_patterns[]="tracker.idesir.com";
  $rem_patterns[]="kakburk.ath.cx";
  $rem_patterns[]="bt.btren.net";
  $rem_patterns[]="byteshop.alrocks.com";
  $rem_patterns[]="torrent-dimension.ath.cx";
  $rem_patterns[]="ijerked.it";
  $rem_patterns[]="saturn.merseine.nu";
  $rem_patterns[]="souptracker.eggdrop.bz";
  $rem_patterns[]="bitpirates-tracker.ath.cx";
  $rem_patterns[]="b3st.b33r.net";
  $rem_patterns[]="midnightbits.boxbsd.com";
  $rem_patterns[]="l-f-t.no-ip.org";
  $rem_patterns[]="opentracker1.rarbg.com";
  $rem_patterns[]="torrent-kingdom.net";
  $rem_patterns[]="eztv2.sladinki007.net";
  $rem_patterns[]="pn5.epac.to";
  $rem_patterns[]="hurcules.serveftp.net";
  $rem_patterns[]="trackerA.zcultfm.com";
  $rem_patterns[]="tracker9.bol.bg";
  $rem_patterns[]="helltorrent.no-ip.biz";
  $rem_patterns[]="modernmodem.no-ip.org";
  $rem_patterns[]="bt.cn5566.com";
  $rem_patterns[]="helltorrent.selfip.net";
  $rem_patterns[]="tunebully.com";
  $rem_patterns[]="tracker.ppnow.com";
  $rem_patterns[]="torrentdealer.ath.cx";
  $rem_patterns[]="tracker.piecesnbits.net";
  $rem_patterns[]="www.ebookvortex.com";
  $rem_patterns[]="empire-of-torrents.hopto.org";
  $rem_patterns[]="bimonscificon.mybttracker.net";
  $rem_patterns[]="my.tracker";
  $rem_patterns[]="tracker.torrentlounge.com";
  $rem_patterns[]="www.ultimate-bit-board.to";
  $rem_patterns[]="tracker.udp.at";
  $rem_patterns[]="bt.cnxp.com";
  $rem_patterns[]="www.minitalk.net";
  $rem_patterns[]="tracker.riojatracker.com";
  $rem_patterns[]="bt.citymore.com";
  $rem_patterns[]="ukbkvcd.sladinki007.net";
  $rem_patterns[]="d-c-t.ath.cx";
  $rem_patterns[]="trackerenator.minitalk.net";
  $rem_patterns[]="centraldownload.mine.nu";
  $rem_patterns[]="vtv2.sladinki007.net";
  $rem_patterns[]="tracker.cnxp.com";
  $rem_patterns[]="www.hashish.ath.cx";
  $rem_patterns[]="tlfbt.3322.org";
  $rem_patterns[]="vtv.sladinki007.net";
  $rem_patterns[]="els.ath.cx";
  $rem_patterns[]="tracker.minitalk.net";
  $rem_patterns[]="eztv.sladinki007.eu";
  $rem_patterns[]="www.escom.biz";
  $rem_patterns[]="bt.romman.net";
  $rem_patterns[]="bugz.sladinki007.net";
  $rem_patterns[]="tftracker.kicks-ass.org";
  $rem_patterns[]="www.ardent.tv";
  $rem_patterns[]="neontorrents.org";
  $rem_patterns[]="tracker.btminer.com";
  $rem_patterns[]="tracker.toptorrents.org";
  $rem_patterns[]="root-torrents.to";
  $rem_patterns[]="tracker.denness.net";
  $rem_patterns[]="kid.sladinki007.net";
  $rem_patterns[]="tracker.bitnova.info";
  $rem_patterns[]="bandit.ukb-kvcd.com";
  $rem_patterns[]="torrent-downloads.deants.com";
  $rem_patterns[]="up2p.3322.org";
  $rem_patterns[]="share.dmhy.net";
  $rem_patterns[]="tv.sladinki007.net";
  $rem_patterns[]="power-mp3-world.ath.cx";
  $rem_patterns[]="anderssons.ath.cx";
  $rem_patterns[]="wreckingcrew.hopto.org";
  $rem_patterns[]="porn.sladinki007.net";
  $rem_patterns[]="gamebt.ali213.net";
  $rem_patterns[]="axxo.sladinki007.net";
  $rem_patterns[]="eztv.sladinki007.net";
  $rem_patterns[]="gauss.indymedia.org";
  $rem_patterns[]="tracker.reprobate.se";
  $rem_patterns[]="bittorrent.dyndns.org";
  $rem_patterns[]="tracker.bitenova.nl";
  $rem_patterns[]="tracker2.bt-chat.com";
  $rem_patterns[]="tk2.greedland.net";
  $rem_patterns[]="tracker.bitcomet.net";
  $rem_patterns[]="tracker.bt-chat.com";
  $rem_patterns[]="tracker.sladinki007.net";
  $rem_patterns[]="tracker.ydy.com";
  $rem_patterns[]="www.torrentrealm.com";
}
/* Blacklist - End */
?>
