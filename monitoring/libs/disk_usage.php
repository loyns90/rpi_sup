<?php
$datas = array();

$ff = shell_exec('ls / | grep -ve share -ve proc');
$listff = preg_split ("/\s+/",$ff);
$nb = 1;

foreach($listff as $dir)
{
    if ($nb < sizeof($listff)) {
        $d_usage_cmd = "du -sh /".$dir;
        $result = shell_exec($d_usage_cmd);
        list($usage,$folder) = preg_split ("/\s+/",$result);
        $datas[] = array(
            'folder'  => $folder,
            'usage'   => $usage,
        );
    }
    $nb = $nb + 1;

}
unset($dir);
echo json_encode($datas);
