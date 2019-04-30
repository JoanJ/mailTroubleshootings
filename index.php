<?php
// error sets
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
//

include 'getRegistries.inc.php';
include 'getSpfRegistries.inc.php';
$parametres = true;
if (isset($_GET['domain'])) {$domini = $_GET['domain'];}
else {return false;}


GetSpf($domini,$parametres);
print "<p></p>";
GetDmarc($domini);
print "<p></p>";
GetDkim($domini);
?>
