<?php
require 'Utils/Config.class.php';
$Config = new Config();

$datas = array();
$all_services_cmd = shell_exec('sudo service --status-all');
$all_services = array();

while ($all_services_cmd != "")
{
    list($service_cut) = explode(PHP_EOL,$all_services_cmd);

    $all_services[] = $service_cut;
    $var = str_replace($service_cut.PHP_EOL, '', $all_services_cmd);
    $all_services_cmd = substr($var,-strlen($var)+1);
    unset($service_cut);
    unset($var);
}

unset($all_services_cmd);

if (count($Config->get('services')) > 0)
{
    foreach ($Config->get('services') as $service)
    {
        $host = $service['host'];
        $sock = @fsockopen($host, $service['port'], $num, $error, 5);
	//$ip = shell_exec('ifconfig  | grep "inet "| grep -v "127.0.0.1" | cut -d: -f2 | awk \'{ print $2}\'');
	if ($sock)
	{
            $datas[] = array(
                'port'      => $service['port'],
                'name'      => $service['name'],
                'status'    => 1,
            );
            
            fclose($sock);
        }
        else
        {
            $datas[] = array(
                'port'      => $service['port'],
                'name'      => $service['name'],
                'status'    => 0,
            );
        }
	$sport = shell_exec('sudo netstat -laputen | grep ":'.$service['port'].' " | awk \'{print $9}\'');
        list($serviceligne) = explode(PHP_EOL,$sport);
        list($pid,$servicename) = explode("/",$serviceligne);
        echo $service['port'].' - '.$servicename.'<br>';
	$nbfirst=1;
	foreach ($all_services as $listed_service)
	{
	    list($cr1,$ls_status,$cr2,$ls_name,$end) = preg_split('/\s+/',$listed_service);
	    if ($nbfirst == 1)
	    {
	        $ls_name = $end;
	        $nbfirst=0;
	    }
	    if (strpos($ls_name, $servicename) !== false)
	    {
		echo $ls_name;
		$sstatus = shell_exec('sudo service '.$ls_name.' status');
	    }
	    else
	    {
		if (strpos($servicename, $ls_name) !== false)
		{
		    echo $servicename;
                    $sstatus = shell_exec('sudo service '.$servicename.' status');
		}
	    }
	}

	echo $sstatus.'<br>';

	unset($listed_service);
	unset($sstatus);
        unset($serviceligne);
        unset($servicename);
        unset($pid);
        unset($sport);
    }
}

unset($all_services);

echo json_encode($datas);
