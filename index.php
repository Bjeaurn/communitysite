<?php require_once("includes/config.php"); ?>
<html>
<head>
    <base href="<?=__ROUTING__?>" />
    <title><?=__UNIT_NAME?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="stylesheet/master.css" />
    <script src="libs/datepicker/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="libs/datepicker/bootstrap-datepicker3.min.css" />

    <!-- 1. Load libraries -->
    <!-- IE required polyfill -->
    <script src="node_modules/core-js/client/shim.min.js"></script>
    <script src="node_modules/zone.js/dist/zone.js"></script>
    <script src="node_modules/reflect-metadata/Reflect.js"></script>
    <script src="node_modules/rxjs/bundles/Rx.js"></script>
    <script src="node_modules/@angular/core/bundles/core.umd.js"></script>
    <script src="node_modules/@angular/common/bundles/common.umd.js"></script>
    <script src="node_modules/@angular/compiler/bundles/compiler.umd.js"></script>
    <script src="node_modules/@angular/platform-browser/bundles/platform-browser.umd.js"></script>
    <script src="node_modules/@angular/platform-browser-dynamic/bundles/platform-browser-dynamic.umd.js"></script>

    <!-- 2. Load our 'modules' -->
    <script src='app/app.component.js'></script>
    <script src='app/app.module.js'></script>
    <script src='app/main.js'></script>
</head>
<body>
    <?php $page->getView() ?>
</body>
</html>

<script src="https://static.tsviewer.com/short_expire/js/ts3viewer_loader.js"></script>
<script>
var ts3v_url_1 = "https://www.tsviewer.com/ts3viewer.php?ID=1093657&text=757575&text_size=11&text_family=1&text_s_color=000000&text_s_weight=normal&text_s_style=normal&text_s_variant=normal&text_s_decoration=none&text_i_color=&text_i_weight=normal&text_i_style=normal&text_i_variant=normal&text_i_decoration=none&text_c_color=&text_c_weight=normal&text_c_style=normal&text_c_variant=normal&text_c_decoration=none&text_u_color=000000&text_u_weight=normal&text_u_style=normal&text_u_variant=normal&text_u_decoration=none&text_s_color_h=&text_s_weight_h=bold&text_s_style_h=normal&text_s_variant_h=normal&text_s_decoration_h=none&text_i_color_h=000000&text_i_weight_h=bold&text_i_style_h=normal&text_i_variant_h=normal&text_i_decoration_h=none&text_c_color_h=&text_c_weight_h=normal&text_c_style_h=normal&text_c_variant_h=normal&text_c_decoration_h=none&text_u_color_h=&text_u_weight_h=bold&text_u_style_h=normal&text_u_variant_h=normal&text_u_decoration_h=none&iconset=default_colored_2014_tsv";
ts3v_display.init(ts3v_url_1, 1093657, 100);
</script>
