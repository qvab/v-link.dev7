<?

IncludeTemplateLangFile(__FILE__);
define("PATH_TEMP_INC", $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/inc");
if (defined("IS_DOBRO_HOME") && !empty(IS_DOBRO_HOME)) {
  require_once PATH_TEMP_INC."/header.php";
} else {
  require_once PATH_TEMP_INC."/header_other.php";
}