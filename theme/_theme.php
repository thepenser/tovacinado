<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <title><?=$title?></title>

    <meta http-equiv="content-language" content="pt-br">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta property="og:title" content="<?=$title?>" />

    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?php echo URL_BASE . '/?cl=' . CLIENT_KEY; ?>" />
    <meta property="og:image" content="<?php echo URL_BASE . '/' . WORK_DIR . '/imgClube.jpg'; ?>" />
    <meta property="og:site_name" content="<?php echo SITE_NAME; ?>" />

    <meta name="keywords" content="sócio torcedor, torcedor, totalplayer, futebol, esporte">
    <link rel="shortcut icon"  href="<?=url("theme/portal/image/favicon.png");?>">
    <link rel="icon"  href="<?=url("theme/portal/image/favicon.png");?>">
    <meta name="robots" content="index, follow">
    <meta name="revisit-after" content="30 days">
    <!-- **Favicon** -->
    <link href="<?=url("theme/images/favicon.ico");?>" rel="shortcut icon" type="image/x-icon" />

    <!-- **CSS THEME**-->
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="<?=url("theme/assets/css/bootstrap.min.css")?>" rel="stylesheet" />
    <link href="<?=url("theme/assets/css/material-bootstrap-wizard.css")?>" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?=url("theme/assets/css/demo.css")?>" rel="stylesheet" />
    <!-- **END CSS THEME**-->
    <?php
    if($v->section("style"))
        echo $v->section("style");
    ?>
</head>
<body>
<div class="image-container set-full-height" style="background-image: url('<?=url("theme/assets/img/wizard-book.jpg'");?>)">
    <div class="inner-wrapper">
        <?php $v->insert("header");?>
        <div id="main">
            <?=$v->section("content")?>
        </div>


    <?php
    if($v->section("modals"))
        echo $v->section("modals");
    ?>

    <script type="text/javascript" src="<?=url("theme/assets/js/jquery.plugins.min.js");?>"></script>
    <!--   Core JS Files   -->
        <!--
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        -->
    <script src="<?=url("theme/assets/js/jquery-2.2.4.min.js");?>" type="text/javascript"></script>
    <script src="<?=url("theme/assets/js/bootstrap.min.js");?>" type="text/javascript"></script>
    <script src="<?=url("theme/assets/js/jquery.bootstrap.js");?>" type="text/javascript"></script>

    <!--  Plugin for the Wizard -->
    <script src="<?=url("theme/assets/js/material-bootstrap-wizard.js");?>"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
    <script src="<?=url("theme/assets/js/jquery.validate.min.js");?>"></script>

    <?php
        if($v->section("scripts"))
            echo $v->section("scripts");
    ?>
</body>
</html>
