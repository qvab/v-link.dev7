<?php

define("ROOT_TEMPLATE", $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/");

function vd($data, $bPrint = false) {
  echo "<pre>";
  if (!empty($bPrint)) {
   print_r($data);
  } else {
    var_dump($data);
  }
  echo "</pre>";
}