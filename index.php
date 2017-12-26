<!--
 Page de supervision
 **********************
 v1.0
 L. RIOU
-->

<h2>Hello</h2>

<?php
echo "<table><tr>";
$log_file = fopen("/share/scripts/status.log", "r");
if ($log_file) {
	$first=1;
	while (($line = fgets($log_file)) !== false) {
	   if (strpos($line, '●') !== false) {
               if ($first !== 1) {
                   echo "</td>";
	       }       
	       $first=0;
	       echo nl2br("<td>Service :");
           }
	   echo nl2br($line);
   }
   fclose($log_file);
}
echo "</td></tr></table>";

//echo file_get_contents("status.log")
?> 
