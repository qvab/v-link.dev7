<?php

define("ROOT_TEMPLATE", $_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/lpdobra_standart/");
define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

define("IB_COMPANIES", 33);
define("IB_VACANCY", 34);
define("IB_RESUME", 35);


function vd($data, $bPrint = false)
{
  echo "<pre>";
  if (!empty($bPrint)) {
    print_r($data);
  } else {
    var_dump($data);
  }
  echo "</pre>";
}


function getCategories($ids = false)
{
  $arCategories = [];
  $arSections = [];
  $arSelect = ["ID", "IBLOCK_SECTION_ID", "NAME"];
  $arFilter = ["IBLOCK_ID" => 41];
  if (!empty($ids)) {
    $arFilter["ID"] = $ids;
  }
  $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 999), $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arCategories[$arFields["IBLOCK_SECTION_ID"]][$arFields["ID"]] = $arFields["NAME"];
    $arAllCategories[$arFields["ID"]] = $arFields["NAME"];
  }

  $res = CIBlockSection::GetList(
    [],
    ["IBLOCK_ID" => 41],
    false,
    ["ID", "NAME"],
    ["nPageSize" => 999]
  );
  while ($section = $res->GetNextElement()) {
    $arFields = $section->GetFields();
    $arSections[$arFields["ID"]] = $arFields["NAME"];
  }
  return ["sections" => $arSections, "categories" => $arCategories, "all_categories" => $arAllCategories];
}


/**
 * Образование
 * @param bool $ids
 * @return array
 */
function getSchedule($ids = false)
{
  $arCategories = [];
  $arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*"];
  $arFilter = ["IBLOCK_ID" => 38];
  if (!empty($ids)) {
    $arFilter["ID"] = $ids;
  }
  $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 999], $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arCategories[$arFields["ID"]] = [
      "fields" => $arFields,
      "prop" => $ob->GetProperties()
    ];
  }
  return $arCategories;
}

/**
 * Последние места работы
 * @param bool $ids
 * @return array
 */
function getTypeOfEmp($ids = false)
{
  $arCategories = [];
  $arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*"];
  $arFilter = ["IBLOCK_ID" => 39];
  if (!empty($ids)) {
    $arFilter["ID"] = $ids;
  }
  $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 999], $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arCategories[$arFields["ID"]] = [
      "fields" => $arFields,
      "prop" => $ob->GetProperties()
    ];
  }
  return $arCategories;
}

/**
 * Тип занятости
 * @param bool $ids
 * @return array
 */
function getTypeWork($ids = false)
{
  $arCategories = [];
  $arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*"];
  $arFilter = ["IBLOCK_ID" => 43];
  if (!empty($ids)) {
    $arFilter["ID"] = $ids;
  }
  $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 999], $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arCategories[$arFields["ID"]] = [
      "fields" => $arFields,
      "prop" => $ob->GetProperties()
    ];
  }
  return $arCategories;
}

/**
 * Гарфик работы
 * @param bool $ids
 * @return array
 */
function getGrafic($ids = false)
{
  $arCategories = [];
  $arIds = [];
  $arSelect = ["ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*"];
  $arFilter = ["IBLOCK_ID" => 42];
  if (!empty($ids)) {
    $arFilter["ID"] = $ids;
  }
  $res = CIBlockElement::GetList([], $arFilter, false, ["nPageSize" => 999], $arSelect);
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arCategories[$arFields["ID"]] = [
      "fields" => $arFields,
      "prop" => $ob->GetProperties()
    ];
  }
  return $arCategories;
}


function finance($number)
{
  return number_format($number, 0, ".", " ");
}

function countDays($d2)
{
  $d1_ts = strtotime("now");
  $d2_ts = strtotime($d2);

  $seconds = abs($d1_ts - $d2_ts);

  return floor($seconds / 86400);
}

/**
 * Получение текущей компании
 * @return array|bool
 */
function getCurrentCompany()
{
  global $USER;
  $res = CIBlockElement::GetList(
    [],
    [
      "IBLOCK_ID" => 33,
      "PROPERTY_ID_USER" => $USER->GetID()
    ],
    false,
    ["nPageSize" => 1],
    ["ID", "NAME", "IBLOCK_ID", "DETAIL_TEXT", "PROPERTY_*", "DETAIL_PICTURE", "PREVIEW_PICTURE"]
  );
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProperty = $ob->GetProperties();
  }
  if (!empty($arFields)) {
    return ["fields" => $arFields, "property" => $arProperty];
  } else {
    return false;
  }
}

/**
 * Выборка элемента
 * @param $iBlockID
 * @param $id
 * @return array|bool
 */
function getElementIBlock($iBlockID, $id)
{
  $res = CIBlockElement::GetList(
    [],
    [
      "IBLOCK_ID" => $iBlockID,
      "ID" => $id
    ],
    false,
    ["nPageSize" => 1],
    ["ID", "NAME", "IBLOCK_ID", "DETAIL_TEXT", "PROPERTY_*", "DETAIL_PICTURE", "PREVIEW_PICTURE"]
  );
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arProperty = $ob->GetProperties();
  }
  if (!empty($arFields)) {
    return ["fields" => $arFields, "property" => $arProperty];
  } else {
    return false;
  }
}


function getVacancyByUser()
{
  $res = getCurrentCompany();
  if (!empty($res)) {
    $id = $res["fields"]["ID"];
    $res = CIBlockElement::GetList(
      [],
      [
        "IBLOCK_ID" => 34,
        "COMPANY" => $id
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME"]
    );
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      $arGetKeywords[$arFields["ID"]] = [
        "fields" => $arFields,
        "name" => $arFields["NAME"]
      ];
    }
    return $arGetKeywords;
  } else {
    return [];
  }
}


function getResumeByUser()
{

  global $USER;
  $id = $USER->GetID();

  $res = CIBlockElement::GetList(
    [],
    [
      "IBLOCK_ID" => 35,
      "PROPRERTY_USER_ID_VALUE" => $id
    ],
    false,
    ["nPageSize" => 999],
    ["ID", "NAME"]
  );
  $arNames = [];
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    if (!in_array($arFields["NAME"], $arNames)) {
      $arGetKeywords[$arFields["ID"]] = [
        "fields" => $arFields,
        "name" => $arFields["NAME"]
      ];
    }
  }
  if (!empty($arGetKeywords)) {
    return $arGetKeywords;
  } else {
    return [];
  }
}


function getPopularCategories()
{


}


function showBlockMessage($text, $type = "success", $bReturn = false)
{

  if ($type == "success") {
    $res = '<div class="success-resume" style="
    text-align: center;
    color: #fff;
    background-color: #30AB1E;
    padding: 25px;
    margin: 0 auto;
    border-radius: 16px;
">'.$text.'</div>';
  } else {
    $res = '<div class="success-resume" style="
    text-align: center;
    color: #fff;
    background-color: #ff7e00;
    padding: 25px;
    margin: 0 auto;
    border-radius: 16px;
">'.$text.'</div>';
  }
  if (!empty($bReturn)) {
    return $res;
  } else {
    echo $res;
  }

}

/**
 * Считаем возраст
 * @param $birthdayDate
 * @return string
 */
function getFullYears($birthdayDate)
{
  $datetime = new DateTime($birthdayDate);
  $interval = $datetime->diff(new DateTime(date("Y-m-d")));
  return $interval->format("%Y");
}


/**
 * Получение ключевых слов по ID
 * @param $arIds
 * @return array
 */
function getKeywordsByIds($arIds)
{
  $arGetKeywords = [];
  $res = CIBlockElement::GetList(
    [],
    [
      "IBLOCK_ID" => 40,
      "ID" => $arIds
    ],
    false,
    ["nPageSize" => 999],
    ["ID", "NAME"]
  );
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arGetKeywords[$arFields["ID"]] = $arFields["NAME"];
  }
  return $arGetKeywords;
}


function searchKeyWord($sTitle, $bResume = false, $bSelectedId = false)
{
  $arGetKeywords = $arKeyWordsIds = [];
  $arTitle = [];
  if (gettype($sTitle) != "array") {
    $sTitle = $sTitle."%";
  } else {
    foreach ($sTitle as $sName) {
      $arTitle[] = $sName."%";
    }
    $sTitle = $arTitle;
  }

  $res = CIBlockElement::GetList(
    [],
    [
      "IBLOCK_ID" => 40,
      "NAME" => $sTitle
    ],
    false,
    ["nPageSize" => 999],
    ["ID", "NAME"]
  );
  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arGetKeywords[$arFields["ID"]] = [
      "value" => $arFields["NAME"],
      "type" => "key"
    ];
    $arKeyWordsIds[] = $arFields["ID"];
  }
  if (empty($bResume)) {
    $res = CIBlockElement::GetList(
      [],
      [
        "IBLOCK_ID" => 34,
        "NAME" => $sTitle
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arNames[] = $arFields["NAME"];
        $arGetKeywords[$arFields["ID"]] = [
          "value" => $arFields["NAME"],
          "type" => "vacancy"
        ];
      }
    }
  } elseif ($bResume == "resume") {
    $res = CIBlockElement::GetList(
      [],
      [
        "IBLOCK_ID" => 35,
        "NAME" => $sTitle
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arNames[] = $arFields["NAME"];
        $arGetKeywords[$arFields["ID"]] = [
          "value" => $arFields["NAME"],
          "type" => "resume"
        ];
      }
    }
  }
  return empty($bSelectedId) ? $arGetKeywords : $arKeyWordsIds;
}


function getLocationName($id)
{
  CModule::IncludeModule("sale");
  $locationId = $id;
  $sNameLocation = '';
  $arSelectLocation = CSaleLocation::GetByID($locationId);
  $sNameLocation .= $arSelectLocation["COUNTRY_NAME_ORIG"];
  if ($arSelectLocation["REGION_ID"] == $locationId) {
    $sNameLocation .= ", ".$arSelectLocation["REGION_NAME_ORIG"];
  } elseif ($arSelectLocation["CITY_ID"] == $locationId) {
    $sNameLocation .= ", ".$arSelectLocation["CITY_NAME_ORIG"];
  }
  return $sNameLocation;
}


function getPathImg($id)
{

}


function getPayment($minPayment, $maxPayment)
{
  $sPayment = "Не указана";
  if (
    !empty($maxPayment)
    && !empty($minPayment)
  ) {
    $sPayment = finance($minPayment)." - ".finance($maxPayment);
  } elseif (
    !empty($maxPayment)
    && empty($minPayment)
  ) {
    $sPayment = "До ".finance($maxPayment);
  } elseif (
    empty($maxPayment)
    && !empty($minPayment)
  ) {
    $sPayment = "От ".finance($minPayment);
  }
  return $sPayment;
}

/**
 * Добавляет JSON сообьщение в элемент инфоблока по ID
 * @param $idElement = id элемента
 * @param $from = кто отправил сообщение
 * @param $text = текст сообщения
 */
function insertMessage($idElement, $initiator = "user", $typeMessage = "message", $arFrom, $arTo, $text)
{
  $obIBlock = new CIBlockElement;
  $obRes = $obIBlock->GetByID($idElement);
  if ($arRes = $obRes->GetNext()) {
    $arMessages = json_decode(htmlspecialchars_decode($arRes["DETAIL_TEXT"]), true);
    $arAddMessage = [
      "initiator" => $initiator,
      "type_message" => $typeMessage,
      "from_id" => $arFrom["id"],
      "to_id" => $arTo["id"],
      "from_name" => $arFrom["name"],
      "to_name" => $arFrom["name"],
      "created_at" => time(),
      "text" => $text,
      "view" => 0
    ];
    $arMessages[] = $arAddMessage;
    $sUpdateMessages = json_encode($arMessages, JSON_UNESCAPED_UNICODE);
    return $obIBlock->Update($idElement, ["DETAIL_TEXT" => $sUpdateMessages]);
  }
}


/**
 * Добавляет JSON сообьщение в элемент инфоблока по ID
 * @param $idElement = id элемента
 * @param $from = кто отправил сообщение
 * @param $text = текст сообщения
 */
function readMessages($idElement, $initiator = "user")
{
  $obIBlock = new CIBlockElement;
  $obRes = $obIBlock->GetByID($idElement);
  if ($arRes = $obRes->GetNext()) {
    $arMessages = json_decode(htmlspecialchars_decode($arRes["DETAIL_TEXT"]), true);
    // Читаем все сообщения от компании
    if ($initiator == "user") {
      foreach ($arMessages as $k => $val) {
        if ($val["initiator"] == "company") {
          $arMessages[$k]["view"] = 1;
        }
      }
    } elseif ($initiator == "company") {
      foreach ($arMessages as $k => $val) {
        if ($val["initiator"] == "user") {
          $arMessages[$k]["view"] = 1;
        }
      }
    }
    $sUpdateMessages = json_encode($arMessages, JSON_UNESCAPED_UNICODE);
    $obIBlock->Update($idElement, ["DETAIL_TEXT" => $sUpdateMessages]);
  }
}


/**
 * Управление вакансиями
 * Class Vacancy
 */
class Vacancy
{

  private $req;
  private $idFile;
  private $arGetKeywords = [];

  function __construct()
  {
    global $USER;
    $this->req = $_POST;
    $this->obUser = $USER;
    $this->iblock = new CIBlockElement;
    $this->cfile = new CFile;
    $this->date = new \Bitrix\Main\Type\DateTime;
  }


  private function uploadFile()
  {
    if (!empty($_FILES)) {
      $arImage = [
        "name" => $_FILES["company"]["name"]["file"],
        "size" => $_FILES["company"]["size"]["file"],
        "tmp_name" => $_FILES["company"]["tmp_name"]["file"],
        "type" => $_FILES["company"]["type"]["file"],
      ];
      $this->idFile = CFile::SaveFile($arImage, "vacancy_avatars");
    }
  }


  public function addVacancy()
  {
    $company_id = $this->saveCompany(false);
    $this->addKeyWords();
    $arFields = [
      "PROPERTY_VALUES" => [
        "COMPANY" => $company_id,
        "MIN_PAYMENT" => $this->req["vacancy"]["min_payment"],
        "MAX_PAYMENT" => $this->req["vacancy"]["max_payment"],
        "KEY_WORDS" => $this->arGetKeywords,
        "CATEGORIES" => $this->req["vacancy"]["categories"],
        "SCHEDULE" => $this->req["vacancy"]["schedule"],
        "TYPE_OF_EMP" => $this->req["vacancy"]["type_of_emp"],
        "CITY" => $this->req["vacancy"]["city"],
        "PHONE" => $this->req["vacancy"]["phone"]
      ],
      "NAME" => $this->req["vacancy"]["name"],
      "DETAIL_TEXT" => $this->req["vacancy"]["description"],
      "PREVIEW_TEXT" => $this->req["vacancy"]["preview_text"],
      "ACTIVE" => "N",
      "IBLOCK_ID" => 34,
    ];

    $el = $this->iblock->Add($arFields);
    if (!empty($el)) {
      header("Location: /add-vacancy?success_vacancy");
    } else {
      header("Location: /add-vacancy?error_vacancy");
    }


  }


  /**
   * Сохранение компании
   * @param bool $redirect
   * @return mixed
   */
  public function saveCompany($redirect = true)
  {
    $this->uploadFile();
    $arFields = [
      "PROPERTY_VALUES" => [
        "ID_USER" => $this->obUser->GetID(),
        "REGION_COMPANY" => $this->req["company"]["citi"],
        "PHONE_1" => $this->req["company"]["phone_1"],
        "PHONE_2" => $this->req["company"]["phone_2"],
        "EMAIL" => $this->req["company"]["email"],
        "SITE" => $this->req["company"]["site"],
        "YEAR" => $this->req["company"]["year"],
      ],
      "NAME" => $this->req["company"]["name"],
      "DETAIL_TEXT" => $this->req["company"]["description"],
      "DETAIL_PICTURE" => $this->cfile->MakeFileArray($this->idFile),
      "PREVIEW_PICTURE" => $this->cfile->MakeFileArray($this->idFile),
      "ACTIVE" => "Y",
      "IBLOCK_ID" => 35,
    ];

    $arCompany = getCurrentCompany();
    if (!empty($arCompany)) {
      // update
      $el = $this->iblock->Update($arCompany["fields"]["ID"], $arFields);
    } else {
      $el = $this->iblock->Add($arFields);
    }

    if (!empty($redirect)) {
      if (!empty($el)) {
        header("Location: /add-vacancy?success_company");
      } else {
        header("Location: /add-vacancy?error_company");
      }
    } else {
      return $el === true ? $arCompany["fields"]["ID"] : $el;
    }
  }


  /**
   * Добавляем ключевые слова
   */
  private function addKeyWords()
  {

    $this->getKeyWords();
    // Добавляем новые теги
    if (!empty($this->arKeywords)) {
      foreach ($this->arKeywords as $nameKey => $v) {
        $arFields = [
          "NAME" => $nameKey,
          "ACTIVE" => "Y",
          "IBLOCK_ID" => 40,
        ];
        $el = $this->iblock->Add($arFields);
        $this->arGetKeywords[] = $el;
      }
    }
  }

  /**
   * Поиск ключевых слов уже присутствующих в базе
   */
  private function getKeyWords()
  {
    if (!empty($this->req["vacancy"]["keywords"])) {
      $arKeys = explode(",", $this->req["vacancy"]["keywords"]);
      foreach ($arKeys as $v) {
        if (!empty($v)) {
          $this->arKeywords[$v] = false;
          $arSearch[] = $v;
        }
      }
      $res = CIBlockElement::GetList(
        [],
        [
          "IBLOCK_ID" => 40,
          "NAME" => $arSearch
        ],
        false,
        ["nPageSize" => 999],
        ["ID", "NAME"]
      );
      while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $this->arGetKeywords[] = $arFields["ID"];
        unset($this->arKeywords[$arFields["NAME"]]);
      }
    }
  }

}