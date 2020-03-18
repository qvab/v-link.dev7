<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="container no-shadow">
  <br />
  <h1 class="text-center white">Блог компании</h1>
  <br />
</div>
</header>

<main>
  <section class="no-padding-top bg-alt">
    <div class="container">

      <div class="row item-blocks-connected">
        <!-- Resume detail -->
        <?php

        foreach ($arResult["ITEMS"] as $arItem) {
          ?>



                  <!-- Job item -->
                  <div class="col-xs-12">
                    <a class="item-block" href="/blog/<?=$arItem["ID"]?>/">
                      <header>
                        <div class="hgroup">
                          <h4><?=$arItem["NAME"]?></h4>
                          <p><?=$arItem["PREVIEW_TEXT"]?></p>
                        </div>
                      </header>
                    </a>
                  </div>
                </div>
              </div>




          <?php
        }
        ?>
        <!-- END Resume detail -->


      </div>
      <div class="row pagination-contain">
        <div class="col-xs-12"><?php echo $arResult["NAV_STRING"] ?></div>
      </div>
    </div>
  </section>
</main>