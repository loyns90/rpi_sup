<?php
require 'Utils/Misc.class.php';

$datas = array(
    'ip' => Misc::getIp(),
);

echo json_encode($datas);