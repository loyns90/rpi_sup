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
	       $cpt=0;	   
	       if ($first !== 1) {
                   echo "</td>";
	       }       
	       $first=0;
	       echo nl2br("<td>Service : ");
	   }
	   if ($cpt == 0){
	       //echo nl2br($line);
	       list($service, $service_name) = explode("-", $line);
	       echo nl2br($service_name);
	       $cpt=1;
	   }
	   if (strpos($line, 'dead') !== false) {
               echo nl2br($line);
	   }
	   if (strpos($line, 'running') !== false) {
	       echo nl2br($line);
	   }
	   //echo nl2br($line);
   }
   fclose($log_file);
}
echo "</td></tr></table>";

//echo file_get_contents("status.log")
?> 
