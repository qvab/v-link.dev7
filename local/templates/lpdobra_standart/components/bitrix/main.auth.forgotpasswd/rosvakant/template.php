<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
  die();
}

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

\Bitrix\Main\Page\Asset::getInstance()->addCss(
  '/bitrix/css/main/system.auth/flat/style.css'
);

if ($arResult['AUTHORIZED']) {
  echo "Вы уже авторизованы";
  return;
}
?>


<body class="login-page">
<main>
  <? if ($arResult['ERRORS']): ?>
    <div class="alert alert-danger">
      <? foreach ($arResult['ERRORS'] as $error) {
        echo $error;
      }
      ?>
    </div>
  <? elseif ($arResult['SUCCESS']): ?>
    <div class="alert alert-success">
      <?=$arResult['SUCCESS'];?>
    </div>
  <? endif; ?>
  <div class="login-block">
    <h1>Восстановление пароля</h1>
    <form name="bform" method="post" target="_top" action="<?=POST_FORM_ACTION_URI;?>">

      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" placeholder="Логин" name="<?=$arResult['FIELDS']['login'];?>" maxlength="255"
                 value="<?=\htmlspecialcharsbx($arResult['LAST_LOGIN']);?>"/>
        </div>
      </div>

      <div class="form-group">
        <div class="input-group" style="text-align: center;">
          <label style="width: 100%;">Или</label>
        </div>
      </div>
      <div class="form-group">
        <div class="input-group">
          <span class="input-group-addon"><i class="ti-email"></i></span>
          <input type="text" class="form-control" placeholder="Email" name="<?=$arResult['FIELDS']['email'];?>" maxlength="255" value=""/>
        </div>
      </div>


      <input class="btn btn-primary btn-block"  name="<?=$arResult['FIELDS']['action'];?>" type="submit" value="Восстановить" />
    </form>
  </div>

  <div class="login-links">
    <p class="text-center"><a href="/login">Авторизоваться</a></p>
  </div>

</main>
<script type="text/javascript">
  document.bform.<?= $arResult['FIELDS']['login'];?>.focus();
</script>
