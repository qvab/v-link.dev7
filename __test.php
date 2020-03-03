<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
CModule::IncludeModule("sale");
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


$locationId = $arResult["PROPERTIES"]["ID_LOCATION"]["VALUE"];
$sNameLocation = '';
$arSelectLocation = CSaleLocation::GetByID($locationId);

$sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
if ($arSelectLocation["REGION_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
} elseif ($arSelectLocation["CITY_ID"] == $locationId) {
  $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
}

function prop($k)
{
  global $arResult;
  return $arResult["PROPERTIES"][$k]["VALUE"];
}

$arProp = [
  "user" => CUser::GetByID($arResult["PROPERTIES"]["ID_USER"]["VALUE"])->arResult[0]["NAME"],
  "location" => $sNameLocation,
  "payment" => $arResult["PROPERTIES"]["PAYMENT"]["VALUE"],
  "image" => !empty($arResult["DETAIL_PICTURE"]["SRC"]) ? $arResult["DETAIL_PICTURE"]["SRC"] : ""
];

//vd($arResult, true);
$arKeyWords = getKeywordsByIds(prop("KEY_WORDS"));
?>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      <img src="<?=$arProp["image"]?>" alt="">
    </div>

    <div class="col-xs-12 col-sm-8 header-detail">
      <div class="hgroup">
        <h1><?=$arResult["NAME"]?></h1>
        <h3><?=$arProp["user"]?></h3>
      </div>
      <hr>
      <p class="lead"><?=$arResult["DETAIL_TEXT"]?></p>

      <ul class="details cols-2">
        <li>
          <i class="fa fa-map-marker"></i>
          <span><?=$arProp["location"]?></span>
        </li>

        <li>
          <i class="fa fa-globe"></i>
          <a href="#"><?=prop("EMAIL")?></a>
        </li>

        <li>
          <i class="fa fa-money"></i>
          <span><?=number_format($arProp["payment"], 0, ".", " ")?> руб. / мес.</span>
        </li>

        <li>
          <i class="fa fa-birthday-cake"></i>
          <span>26 лет</span>
        </li>

        <li>
          <i class="fa fa-phone"></i>
          <span><?=prop("PHONE")?></span>
        </li>

        <li>
          <i class="fa fa-envelope"></i>
          <a href="#"><?=prop("EMAIL")?></a>
        </li>
      </ul>

      <div class="tag-list">
        <?php foreach ($arKeyWords as $sName) {
          echo "<span>".$sName."</span>";
        } ?>
      </div>
    </div>
  </div>

  <div class="button-group">
    <div class="action-buttons">
      <a class="btn btn-success" href="#get-contact">Получить контакт</a>
    </div>
  </div>
</div>
</header>
<!-- END Page header -->


<!-- Main container -->
<main>


  <!-- Education -->
  <section>
    <div class="container">

      <header class="section-header">
        <h2>Образование</h2>
      </header>

      <div class="row">
        <div class="col-xs-12">
          <div class="item-block">
            <header>
              <img src="assets/img/logo-mit.png" alt="">
              <div class="hgroup">
                <h4>Master
                  <small>Computer Science</small>
                </h4>
                <h5>Massachusetts Institute of Technology</h5>
              </div>
              <h6 class="time">2012 - 2014</h6>
            </header>
            <div class="item-body">
              <p>The Massachusetts Institute of Technology (MIT) is a private research university in Cambridge,
                Massachusetts. Founded in 1861 in response to the increasing industrialization of the United States, MIT
                adopted a European polytechnic university model and stressed laboratory instruction in applied science
                and engineering.</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- END Education -->


  <!-- Work Experience -->
  <section class="bg-alt">
    <div class="container">
      <header class="section-header">
        <h2>Последнее места работы</h2>
      </header>

      <div class="row">

        <!-- Work item -->
        <div class="col-xs-12">
          <div class="item-block">
            <header>
              <img src="assets/img/logo-envato.png" alt="">
              <div class="hgroup">
                <h4>Envato</h4>
                <h5>Quality assurance engineer</h5>
              </div>
              <h6 class="time">Mar 2012 - Jun 2014</h6>
            </header>
            <div class="item-body">
              <p>Responsibilities:</p>
              <ul>
                <li>Software testing in a Web Applications/Mobile environment.</li>
                <li>Software Test Plans from Business Requirement Specifications for test engineering group.</li>
                <li>Run production tests as part of software implementation; Create, deliver and support test plans for
                  testing group to execute.
                </li>
                <li>Software testing in a Web Applications environment.</li>
              </ul>
            </div>
          </div>
        </div>
        <!-- END Work item -->


      </div>

    </div>
  </section>
  <!-- END Work Experience -->


  <!-- Skills -->
  <section>
    <div class="container">
      <header class="section-header">
        <h2>Уровень навыков</h2>
      </header>

      <br>
      <ul class="skills cols-3">
        <li>
          <div>
            <span class="skill-name">HTML</span>
            <span class="skill-value">100%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 100%;"></div>
          </div>
        </li>

        <li>
          <div>
            <span class="skill-name">CSS</span>
            <span class="skill-value">95%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 95%;"></div>
          </div>
        </li>

        <li>
          <div>
            <span class="skill-name">Javascript</span>
            <span class="skill-value">80%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 80%;"></div>
          </div>
        </li>

        <li>
          <div>
            <span class="skill-name">Photoshop</span>
            <span class="skill-value">60%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 60%;"></div>
          </div>
        </li>

        <li>
          <div>
            <span class="skill-name">ReactJS</span>
            <span class="skill-value">70%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 70%;"></div>
          </div>
        </li>

        <li>
          <div>
            <span class="skill-name">Team work</span>
            <span class="skill-value">90%</span>
          </div>
          <div class="progress">
            <div class="progress-bar" style="width: 90%;"></div>
          </div>
        </li>
      </ul>

    </div>
  </section>
  <!-- END Skills -->


</main>
