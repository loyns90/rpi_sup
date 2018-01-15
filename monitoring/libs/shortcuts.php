<?php
require 'Utils/Config.class.php';
$Config = new Config();


$datas = array();

if (count($Config->get('shortcuts')) > 0)
{
    foreach ($Config->get('shortcuts') as $shortcut)
    {
        $datas[] = array(
            'url'      => $shortcut['url'],
            'name'     => $shortcut['name'],
            'target'   => $shortcut['target'],
         );
            
    }
}


echo json_encode($datas);
