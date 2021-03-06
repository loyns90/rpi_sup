<?php
    require 'libs/Utils/Misc.class.php';
    require 'libs/Utils/Config.class.php';
    $Config = new Config();
    $update = $Config->checkUpdate();
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <?php if ($Config->get('esm:auto_refresh') > 0): ?>
        <meta http-equiv="refresh" content="<?php echo $Config->get('esm:auto_refresh'); ?>">
        <?php endif; ?>
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title><?php echo ucfirst(Misc::getHostname()); ?> Monitor</title>
        <link rel="stylesheet" href="web/css/utilities.css" type="text/css">
        <link rel="stylesheet" href="web/css/frontend.css" type="text/css">
        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <!--[if IE]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="js/plugins/jquery-2.1.0.min.js" type="text/javascript"></script>
        <script src="js/plugins/jquery.knob.js" type="text/javascript"></script>
        <script src="js/esm.js" type="text/javascript"></script>
        <script>
            $(function(){
                $('.gauge').knob({
                    'fontWeight': 'normal',
                    'format' : function (value) {
                        return value + '%';
                    }
                });
            
                $('a.reload').click(function(e){
                    e.preventDefault();
                });
            
                esm.getAll();
            });
        </script>
    </head>
    <body>
        <div id="main-container">
	    <div class="box column-left" id="esm-services">
                <div class="box-header">
                    <h1>Services status</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('services');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="box column-right" id="esm-system">
                <div class="box-header">
                    <h1>System</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('system');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table class="firstBold">
                        <tbody>
                            <tr>
                                <td>OS</td>
                                <td id="system-os"></td>
                            </tr>
                            <tr>
                                <td>Kernel version</td>
                                <td id="system-kernel"></td>
                            </tr>
                            <tr>
                                <td>Uptime</td>
                                <td id="system-uptime"></td>
                            </tr>
                            <tr>
                                <td>Last boot</td>
                                <td id="system-last_boot"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box column-right" id="esm-load_average">
                <div class="box-header">
                    <h1>Load Average</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('load_average');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content t-center">
                    <div class="f-left w33p">
                        <h3>1 min</h3>
                        <input type="text" class="gauge" id="load-average_1" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
                    </div>
                    <div class="f-right w33p">
                        <h3>15 min</h3>
                        <input type="text" class="gauge" id="load-average_15" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
                    </div>
                    <div class="t-center">
                        <h3>5 min</h3>
                        <input type="text" class="gauge" id="load-average_5" value="0" data-height="100" data-width="150" data-min="0" data-max="100" data-readOnly="true" data-fgColor="#BED7EB" data-angleOffset="-90" data-angleArc="180">
                    </div>
                </div>
            </div>
            <div class="cls"></div>
            <div class="box" id="esm-diskusage">
                <div class="box-header">
                    <h1>Main Disk Usage</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('diskusage');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="box" id="esm-disk">
                <div class="box-header">
                    <h1>Mounted Points Usage</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('disk');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table>
                        <thead>
                            <tr>
                                <th class="w20p">Mount</th>
                                <th class="w35p">Use</th>
                                <th class="w15p">Free</th>
                                <th class="w15p">Used</th>
                                <th class="w15p">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box column-left" id="esm-memory">
                <div class="box-header">
                    <h1>Memory</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('memory');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table class="firstBold">
                        <tbody>
                            <tr>
                                <td class="w20p">Used %</td>
                                <td>
                                    <div class="progressbar-wrap">
                                        <div class="progressbar" style="width: 0%;">0%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w20p">Used</td>
                                <td id="memory-used"></td>
                            </tr>
                            <tr>
                                <td class="w20p">Free</td>
                                <td id="memory-free"></td>
                            </tr>
                            <tr>
                                <td class="w20p">Total</td>
                                <td id="memory-total"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box column-right" id="esm-swap">
                <div class="box-header">
                    <h1>Swap</h1>
                    <ul>
                        <li><a href="#" class="reload" onclick="esm.reloadBlock('swap');"><span class="icon-cycle"></span></a></li>
                    </ul>
                </div>
                <div class="box-content">
                    <table class="firstBold">
                        <tbody>
                            <tr>
                                <td class="w20p">Used %</td>
                                <td>
                                    <div class="progressbar-wrap">
                                        <div class="progressbar" style="width: 0%;">0%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="w20p">Used</td>
                                <td id="swap-used"></td>
                            </tr>
                            <tr>
                                <td class="w20p">Free</td>
                                <td id="swap-free"></td>
                            </tr>
                            <tr>
                                <td class="w20p">Total</td>
                                <td id="swap-total"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="cls"></div>
        </div>
        <div align="center">
            <a href="https://ezservermonitor.com/esm-web/documentation" target="_blank">Documentation Access</a>
        </div>
    </body>
</html>
