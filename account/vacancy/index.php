<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require_once $_SERVER["DOCUMENT_ROOT"]."/account/RVAccount.php";
$RV = new RVAccount();
$arResume = $RV->vacancyGetList();
$APPLICATION->SetTitle("Управление аккаунтом"); ?>
<div class="container no-shadow">
  <br>
  <h1 class="text-center">Список вакансий</h1>
  <br>
</div>
</header>
<main>
  <div class="container">
    <?php if (!$USER->IsAuthorized()) {
      showBlockMessage("Вы не авторизованы!", "error");
    } else { ?>
    <div class="row">
      <?php require_once $_SERVER["DOCUMENT_ROOT"]."/account/menu.php"; ?>
      <div class="col-sm-12 col-md-9">

        <div class="row">

          <div class="col-xs-12 text-right">
            <br>
            <a class="btn btn-primary" href="/add-vacancy/">Добавить вакансию</a>
          </div>

          <?php foreach ($arResume as $idResume => $arResume) {
            $sNameLocation = getLocationName($arResume["prop"]["CITY"]["VALUE"]);
            $sUsername = CUser::GetByID($arResume["prop"]["ID_USER"]["VALUE"])->arResult[0]["NAME"];
            ?>
            <!-- Resume item -->
            <div class="col-xs-12" id="item-<?=$idResume?>" <?=$arResume["fields"]["ACTIVE"] == "N" ? "style='opacity: 0.6;'" : '';?>>
              <div class="item-block">
                <header>
                  <div class="hgroup">
                    <h4><a href="/account/resume/?id=<?=$idResume?>"><?=$arResume["name"]?></a></h4>
                    <h5><?=$sUsername?></h5>
                  </div>
                  <div class="header-meta">
                    <span class="location"><?=$sNameLocation?></span>
                    <span class="rate"><?=getPayment($arResume["prop"]["MIN_PAYMENT"]["VALUE"], $arResume["prop"]["MAX_PAYMENT"]["VALUE"])?></span>
                  </div>
                </header>

                <footer>
                  <div class="action-btn" data-global-id-item="<?=$idResume?>">
                    <?php if ($arResume["fields"]["ACTIVE"] == "N") { ?>
                      <a class="btn btn-xs btn-gray" style="display: none" href="#hide-item">Отключить</a>
                      <a class="btn btn-xs btn-gray" href="#show-item">Включить</a>
                      <?php
                    } else { ?>
                      <a class="btn btn-xs btn-gray" href="#hide-item">Отключить</a>
                      <a class="btn btn-xs btn-gray" style="display: none" href="#show-item">Включить</a>
                      <?php
                    }
                    ?>
                    <a class="btn btn-xs btn-gray" href="/account/vacancy_detail/?id=<?=$idResume?>">Редактировать</a>
                    <a class="btn btn-xs btn-danger" href="#delete-item">Удалить</a>
                  </div>
                </footer>
              </div>
            </div>
            <!-- END Resume item -->
            <?php
          }
          ?>
        </div>


      </div>
    </div>
  </div>
  <?php
  }
  ?>
  <br>
  <script src="/account/account.js"></script>
</main><? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
