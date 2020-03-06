<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
include_once $_SERVER["DOCUMENT_ROOT"]."/include/constants.php";


$arMessage = [];
if (!$USER->IsAuthorized()) {
  $arMessage["message"] = "Для получение контакта, Вам нужно авторизоваться";
} else {

  $arVacancy = getVacancyByUser();
  $sSelect = '<h5>Выберите вакансию:</h5><br /><div class="input-group"><select class="form-control" name="job[vacancy]">';
  foreach ($arVacancy as $idItem => $arItem) {
    $sSelect .= '<option value="'.$idItem.'">'.$arItem["name"].'</option>';
  }
  $sSelect .= "</select></div>";
  $arMessage["form"] = <<<METKA_1
  <div id="error"></div>
 <form id="form-ajax-job" action="?get_invitation" method="POST">
 <div class="row">
 <div class="col-12">
  <h5>Текст приглашения</h5><br />
 <div class="input-group">
 <textarea class="form-control" rows="4" name="job[description]"></textarea>
 </div>
 </div>
  <div class="col-12">{$sSelect}</div>
 </div>
<div class="col-12">
<br />
<input type="hidden" name="job[resume]" value="{$_GET['id']}" />
<input type="submit" class="btn btn-success btn-xl" value="Отправить приглашение">
</div>
 </form>
 
METKA_1;

}
echo json_encode($arMessage, JSON_UNESCAPED_UNICODE);