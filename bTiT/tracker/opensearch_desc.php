<?php
require_once ('include/functions.php');
require_once ('include/config.php');
header('Content-type: text/xml; charset=' . $GLOBALS['charset']);
echo '<?xml version="1.0" encoding="' . $GLOBALS['charset'] . '" ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/">
<ShortName>' . unesc($SITENAME) . '</ShortName>
<Description>' . unesc($SITENAME) . '</Description>
<Image height="16" width="16" type="image/x-icon">' . $BASEURL . '/favicon.ico</Image>
<Url type="text/html" method="get" template="' . $BASEURL . '/torrents.php?search={searchTerms}&amp;category=0&amp;active=0"/>
<OutputEncoding>' . $GLOBALS['charset'] . '</OutputEncoding>
<InputEncoding>' . $GLOBALS['charset'] . '</InputEncoding>
</OpenSearchDescription>';
?>