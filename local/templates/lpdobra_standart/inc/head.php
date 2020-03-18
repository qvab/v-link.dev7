<?php
define("TEMPLATE", "/bitrix/templates/lpdobra_standart/test2.aupcontrol.ru/");
define("TEMPLATE_T", "/bitrix/templates/lpdobra_standart/thejobs/");
define("IS_ROSVAKANT", true);
require_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";
CJSCore::Init(array("jquery"));
?><!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
  <?$APPLICATION->ShowHead()?>
  <title><?
    if (defined("ALT_TITLE") && !empty(ALT_TITLE)) {
      echo ALT_TITLE;
    } else {
      $APPLICATION->ShowTitle();
    }
    ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="/favicon.ico">
  <meta name="author" content="CodePixar">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta charset="UTF-8">

  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,800%7COpen+Sans:300,400,500,600,700,800%7CMontserrat:400,700' rel='stylesheet' type='text/css'>


  <link href="/assets/css/app.min.css" rel="stylesheet">
  <link href="/assets/css/custom.css" rel="stylesheet">

  <link rel="stylesheet" href="/assets/css/linearicons.css">
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/nice-select.css">
  <link rel="stylesheet" href="/assets/css/ion.rangeSlider.css"/>
  <link rel="stylesheet" href="/assets/css/ion.rangeSlider.skinFlat.css"/>
  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/css/main.css">
</head>