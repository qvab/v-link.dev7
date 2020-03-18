<?php

class RVAccount
{
  private
    $req,
    $obUser,
    $idFile = false,
    $arGetKeywords = [],
    $arKeywords = [],
    $arAllEducation = [],
    $arAllPrevWorks = [];

  /**
   * RVAccount constructor.
   */
  function __construct()
  {
    global $USER;
    $this->obUser = $USER;
    $this->req = $_POST;
    $this->iblock = new CIBlockElement;
    $this->cfile = new CFile;
    $this->date = new \Bitrix\Main\Type\DateTime;
  }

  /**
   * Выборка резюме по ID
   * @param $id
   * @return array
   */
  public function getResumeByID($id)
  {
    global $USER;
    $idUser = $USER->GetID();
    $res = CIBlockElement::GetList(
      ["ACTIVE"],
      [
        "IBLOCK_ID" => 35,
        "PROPRERTY_USER_ID_VALUE" => $idUser,
        "ID" => $id
      ],
      false,
      ["nPageSize" => 1],
      ["ID", "NAME", "ACTIVE", "IBLOCK_ID", "PROPERTY_*", "DETAIL_PICTURE", "DETAIL_TEXT", "PREVIEW_TEXT"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arGetKeywords = [
          "ID" => $arFields["ID"],
          "NAME" => $arFields["NAME"],
          "DETAIL_PICTURE" => CFile::GetPath($arFields["DETAIL_PICTURE"]),
          "DETAIL_TEXT" => $arFields["DETAIL_TEXT"],
          "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
          "USER_NAME" => $USER->GetFirstName()
        ];

        foreach ($ob->GetProperties() as $keyProp => $arProp) {
          switch ($keyProp) {
            case "EMAIL":
            case "PHONE":
            case "ID_LOCATION":
            case "SITE":
            case "PAYMENT":
              $arGetKeywords[$keyProp] = $arProp["VALUE"];
              break;
            case "CATEGORIES":
            case "SCHEDULE":
            case "TYPE_OF_EMP":
              if (gettype($arProp["VALUE"]) != "array") {
                $arGetKeywords[$keyProp][] = $arProp["VALUE"];
              } else {
                $arGetKeywords[$keyProp] = $arProp["VALUE"];
              }
              break;
            case "HAPPY_DAY":
              $arGetKeywords[$keyProp] = date("d.m.Y", strtotime($arProp["VALUE"]));
              break;
            case "GENDER":
              $arGetKeywords[$keyProp] = $arProp["VALUE_ENUM_ID"];
              break;
            case "KEY_WORDS":
              $arKeyNames = getKeywordsByIds($arProp["VALUE"]);
              $arGetKeywords[$keyProp] = !empty($arKeyNames) ? implode(",", $arKeyNames) : "";
              break;
            case "EDUCATIONS":
              $arGetKeywords[$keyProp] = getSchedule($arProp["VALUE"]);
              break;
            case "PREV_WORKS":
              $arGetKeywords[$keyProp] = getTypeOfEmp($arProp["VALUE"]);
              break;

          }

        }


      }
    }
    if (!empty($arGetKeywords)) {
      return $arGetKeywords;
    } else {
      return [];
    }

  }

  /**
   * Выборка списка всех резюме текущего пользователя
   */
  public function resumeGetList()
  {

    global $USER;
    $id = $USER->GetID();
    $res = CIBlockElement::GetList(
      ["ACTIVE"],
      [
        "IBLOCK_ID" => 35,
        "PROPRERTY_USER_ID_VALUE" => $id
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME", "ACTIVE", "IBLOCK_ID", "PROPERTY_*"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arGetKeywords[$arFields["ID"]] = [
          "fields" => $arFields,
          "name" => $arFields["NAME"],
          "prop" => $ob->GetProperties()
        ];
      }
    }
    if (!empty($arGetKeywords)) {
      return $arGetKeywords;
    } else {
      return [];
    }

  }

  /**
   * Получение вакансии по ID
   * @param $id
   * @return array
   */

  public function getVacancyByID($id)
  {
    global $USER;
    $idUser = $USER->GetID();
    $res = CIBlockElement::GetList(
      ["ACTIVE"],
      [
        "IBLOCK_ID" => 34,
        "PROPRERTY_USER_ID_VALUE" => $idUser,
        "ID" => $id
      ],
      false,
      ["nPageSize" => 1],
      ["ID", "NAME", "ACTIVE", "IBLOCK_ID", "PROPERTY_*", "DETAIL_PICTURE", "DETAIL_TEXT", "PREVIEW_TEXT"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arGetKeywords = [
          "ID" => $arFields["ID"],
          "NAME" => $arFields["NAME"],
          "DETAIL_PICTURE" => CFile::GetPath($arFields["DETAIL_PICTURE"]),
          "DETAIL_TEXT" => $arFields["DETAIL_TEXT"],
          "PREVIEW_TEXT" => $arFields["PREVIEW_TEXT"],
          "PROPERTY" => []
        ];

        foreach ($ob->GetProperties() as $keyProp => $arProp) {
          $arGetKeywords["PROPERTY"][$keyProp] = $arProp["VALUE"];
          if ($keyProp == "KEY_WORDS") {
            $arKeyNames = getKeywordsByIds($arProp["VALUE"]);
            $arGetKeywords["PROPERTY"][$keyProp] = !empty($arKeyNames) ? implode(",", $arKeyNames) : "";
          }
        }
      }
    }
    if (!empty($arGetKeywords)) {
      return $arGetKeywords;
    } else {
      return [];
    }
  }

  /**
   * Выборка списка всех вакансий текущего пользователя
   */
  public function vacancyGetList()
  {
    global $USER;
    $id = $USER->GetID();
    $res = CIBlockElement::GetList(
      ["ACTIVE"],
      [
        "IBLOCK_ID" => 34,
        "PROPRERTY_USER_ID_VALUE" => $id
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME", "ACTIVE", "IBLOCK_ID", "PROPERTY_*"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arGetKeywords[$arFields["ID"]] = [
          "fields" => $arFields,
          "name" => $arFields["NAME"],
          "prop" => $ob->GetProperties()
        ];
      }
    }
    if (!empty($arGetKeywords)) {
      return $arGetKeywords;
    } else {
      return [];
    }
  }

  /**
   * @param string $sType
   */
  public function getInvitation($sType = "for_resume")
  {


  }

  /**
   * Скрытие элемента
   * @param $id
   * @return array
   */
  public function hideItem($id)
  {
    $el = new CIBlockElement;
    $res = $el->Update($id, ["ACTIVE" => "N"]);
    if (empty($res)) {
      return ["error" => $el->LAST_ERROR];
    } else {
      return ["success" => 1];
    }
  }

  /**
   * Включение активности элемента
   * @param $id
   * @return array
   */
  public function showItem($id)
  {
    $el = new CIBlockElement;
    $res = $el->Update($id, ["ACTIVE" => "Y"]);
    if (empty($res)) {
      return ["error" => $el->LAST_ERROR];
    } else {
      return ["success" => 1];
    }
  }

  /**
   * Удаление элемента
   * @param $id
   * @return array
   */
  public function deleteItem($id)
  {
    $el = new CIBlockElement;
    $res = $el->Delete($id);
    if (empty($res)) {
      return ["error" => $el->LAST_ERROR];
    } else {
      return ["success" => 1];
    }
  }

  /**
   * Обновление резюме
   */
  public function updateResume()
  {


    $r = $this->req["resume"];
    //vd($r);
    $arKeyWords = "";
    if (!empty($r["PROPERTY"]["KEY_WORDS"])) {
      $this->__addKeyWords($r["PROPERTY"]["KEY_WORDS"]);
      $arKeyWords = $this->arGetKeywords;
    }

    // Обновляем имя
    $this->__updateUser();

    // Обновялем образование
    $arEducation = $this->__updateEducation($r);
    $arPrevWork = $this->__updatePrevWork($r);
    $arFields = [
      "NAME" => $r["NAME"],
      "DETAIL_TEXT" => $r["DETAIL_TEXT"],
      "PROPERTY_VALUES" => [
        "ID_USER" => $this->obUser->GetID(),
        "CATEGORIES" => $r["PROPERTY"]["CATEGORIES"],
        "SITE" => $r["PROPERTY"]["SITE"],
        "HAPPY_DAY" => $this->date->add($r["PROPERTY"]["HAPPY_DAY"]),
        "PHONE" => $r["PROPERTY"]["PHONE"],
        "EMAIL" => $r["PROPERTY"]["CATEGORIES"],
        "SCHEDULE" => $r["PROPERTY"]["SCHEDULE"],
        "TYPE_OF_EMP" => $r["PROPERTY"]["TYPE_OF_EMP"],
        "ID_LOCATION" => $r["PROPERTY"]["ID_LOCATION"],
        "GENDER" => $r["PROPERTY"]["GENDER"],
        "PAYMENT" => $r["PROPERTY"]["PAYMENT"],
        "KEY_WORDS" => $arKeyWords,
        "EDUCATIONS" => $arEducation,
        "PREV_WORKS" => $arPrevWork
      ]
    ];

    /**
     * Обновлем аватарку
     */
    $this->__uploadFile();
    if (!empty($this->idFile)) {
      $arFields["DETAIL_PICTURE"] = $this->cfile->MakeFileArray($this->idFile);
      $arFields["PREVIEW_PICTURE"] = $this->cfile->MakeFileArray($this->idFile);
    }
    $bUpdateResume = $this->iblock->Update($this->req["update_resume_id"], $arFields);
    return $bUpdateResume;
  }

  /**
   * Обновление вакансии
   */
  public function updateVacancy()
  {
    $this->saveCompany(false);
    $r = $this->req["vacancy"];
    $arKeyWords = "";
    if (!empty($r["PROPERTY"]["KEY_WORDS"])) {
      $this->__addKeyWords($r["PROPERTY"]["KEY_WORDS"]);
      $arKeyWords = $this->arGetKeywords;
    }

    $arFields = [
      "NAME" => $r["NAME"],
      "DETAIL_TEXT" => $r["DETAIL_TEXT"],
      "PREVIEW_TEXT" => $r["PREVIEW_TEXT"],
      "PROPERTY_VALUES" => [
        "COMPANY" => $r["PROPERTY"]["COMPANY"],
        "CATEGORIES" => $r["PROPERTY"]["CATEGORIES"],
        "PHONE" => $r["PROPERTY"]["PHONE"],
        "EMAIL" => $r["PROPERTY"]["CATEGORIES"],
        "SCHEDULE" => $r["PROPERTY"]["SCHEDULE"],
        "TYPE_OF_EMP" => $r["PROPERTY"]["TYPE_OF_EMP"],
        "CITY" => $r["PROPERTY"]["CITY"],
        "MIN_PAYMENT" => $r["PROPERTY"]["MIN_PAYMENT"],
        "MAX_PAYMENT" => $r["PROPERTY"]["MAX_PAYMENT"],
        "KEY_WORDS" => $arKeyWords,
      ]
    ];

    $bUpdateResume = $this->iblock->Update($this->req["update_vacancy_id"], $arFields);

    if (!empty($bUpdateResume)) {
      header("Location: ?success_vacancy&id=".$this->req["update_vacancy_id"]);
    } else {
      header("Location: ?error_vacancy&id=".$this->req["update_vacancy_id"]);
    }
    //return $bUpdateResume;
  }

  /**
   * Сохранение компании
   * @param bool $redirect = выполнять ли редирект
   * @return mixed
   */
  public function saveCompany($redirect = true)
  {
    $this->__uploadFile();
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
        header("Location: ?success_company&new_add&id=".$this->req["update_vacancy_id"]);
      } else {
        header("Location: ?error_company&id=".$this->req["update_vacancy_id"]);
      }
    } else {
      return $el === true ? $arCompany["fields"]["ID"] : $el;
    }
  }


  /**
   * Получение списка откликов
   * @param string $sType
   */
  public function getFeedbackList($sType = "user")
  {
    global $USER;

    if ($sType == "user") {

    } else {

    }

    $id = $USER->GetID();
    $res = CIBlockElement::GetList(
      ["ACTIVE"],
      [
        "IBLOCK_ID" => 34,
        "PROPRERTY_USER_ID_VALUE" => $id
      ],
      false,
      ["nPageSize" => 999],
      ["ID", "NAME", "ACTIVE", "IBLOCK_ID", "PROPERTY_*"]
    );
    $arNames = [];
    while ($ob = $res->GetNextElement()) {
      $arFields = $ob->GetFields();
      if (!in_array($arFields["NAME"], $arNames)) {
        $arGetKeywords[$arFields["ID"]] = [
          "fields" => $arFields,
          "name" => $arFields["NAME"],
          "prop" => $ob->GetProperties()
        ];
      }
    }
    if (!empty($arGetKeywords)) {
      return $arGetKeywords;
    } else {
      return [];
    }

  }


  /***************** внутрений методы ********************/
  /**
   * Обновление имени профиля
   */
  private function __updateUser()
  {
    $user = new CUser;
    return $user->Update($user->GetID(), ["NAME" => $this->req["user"]["USER_NAME"]]);
  }

  /**
   * Добавление ключевых слов
   * @param $sKeyWords
   */
  private function __addKeyWords($sKeyWords)
  {
    $this->__getKeyWords($sKeyWords);
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
  private function __getKeyWords($sKeyWords)
  {
    if (!empty($sKeyWords)) {
      $arKeys = explode(",", $sKeyWords);
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

  /**
   * Сохранение файла
   */
  private function __uploadFile()
  {
    if (!empty($_FILES)) {
      $arImage = [
        "name" => $_FILES["file"]["name"],
        "size" => $_FILES["file"]["size"],
        "tmp_name" => $_FILES["file"]["tmp_name"],
        "type" => $_FILES["file"]["type"],
      ];
      $this->idFile = CFile::SaveFile($arImage, "resume_avatars");
    }
  }


  /**
   * Обновляем места образования
   * @param $r
   * @return array|string
   */
  private function __updateEducation(&$r)
  {
    if (!empty($r["education"])) {
      $arEducationIndex = array_keys($r["edit-vacancy"]["education"]["index"]);
      $arEducationIds = $r["edit-vacancy"]["education"]["id"];
      $arEducationAdd = $arEducationUpdate = [];
      foreach ($r["education"]["DETAIL_TEXT"] as $indexEducation => $sDetailText) {
        if (!empty($sDetailText)) {
          $arItem = [
            "DETAIL_TEXT" => $r["education"]["DETAIL_TEXT"][$indexEducation],
            "IBLOCK_ID" => 38,
            "PROPERTY_VALUES" => [
              "LEVEL" => $r["education"]["PROPERTY"]["LEVEL"][$indexEducation],
              "SPECIAL" => $r["education"]["PROPERTY"]["SPECIAL"][$indexEducation],
              "NAME_EDUCATION" => $r["education"]["PROPERTY"]["NAME_EDUCATION"][$indexEducation],
              "DATE_START" => $this->date->add($r["education"]["PROPERTY"]["DATE_START"][$indexEducation]),
              "DATE_END" => $this->date->add($r["education"]["PROPERTY"]["DATE_END"][$indexEducation]),
            ]
          ];
          if (!in_array($indexEducation, $arEducationIndex)) {
            $arItem["NAME"] = $this->obUser->GetLogin()." (".$this->obUser->GetID().") ".$r["education"]["PROPERTY"]["NAME_EDUCATION"][$indexEducation];
            $arEducationAdd[] = $arItem;
          } else {
            $arEducationUpdate[$arEducationIds[$indexEducation]] = $arItem;
          }
        }
      }

      if (!empty($arEducationAdd)) {
        foreach ($arEducationAdd as $arItem) {
          $el = $this->iblock->Add($arItem);
          if (!empty($el)) {
            $arEducationIds[] = $el;
          }
        }
      }

      if (!empty($arEducationUpdate)) {
        foreach ($arEducationUpdate as $idItem => $arItem) {
          $bUpdate = $this->iblock->Update($idItem, $arItem);
        }
      }
      return $arEducationIds;
    }
    return "";
  }


  /**
   * Обновляем места образования
   * @param $r
   * @return array|string
   */
  private function __updatePrevWork(&$r)
  {
    if (!empty($r["works"])) {
      $arEducationIndex = array_keys($r["edit-vacancy"]["prev_work"]["index"]);
      $arEducationIds = $r["edit-vacancy"]["prev_work"]["id"];
      $arEducationAdd = $arEducationUpdate = [];
      foreach ($r["works"]["DETAIL_TEXT"] as $indexEducation => $sDetailText) {
        if (!empty($sDetailText)) {
          $arItem = [
            "DETAIL_TEXT" => $r["works"]["DETAIL_TEXT"][$indexEducation],
            "IBLOCK_ID" => 38,
            "PROPERTY_VALUES" => [
              "LEVEL" => $r["works"]["PROPERTY"]["LEVEL"][$indexEducation],
              "LOCATION" => $r["works"]["PROPERTY"]["LOCATION"][$indexEducation],
              "NAME_ORG" => $r["works"]["PROPERTY"]["NAME_ORG"][$indexEducation],
              "DATE_START" => $this->date->add($r["works"]["PROPERTY"]["DATE_START"][$indexEducation]),
              "DATE_END" => $this->date->add($r["works"]["PROPERTY"]["DATE_END"][$indexEducation]),
            ]
          ];
          if (!in_array($indexEducation, $arEducationIndex)) {
            $arItem["NAME"] = $this->obUser->GetLogin()." (".$this->obUser->GetID().") ".$r["works"]["PROPERTY"]["NAME_ORG"][$indexEducation];
            $arEducationAdd[] = $arItem;
          } else {
            $arEducationUpdate[$arEducationIds[$indexEducation]] = $arItem;
          }
        }
      }

      if (!empty($arEducationAdd)) {
        foreach ($arEducationAdd as $arItem) {
          $el = $this->iblock->Add($arItem);
          if (!empty($el)) {
            $arEducationIds[] = $el;
          }
        }
      }

      if (!empty($arEducationUpdate)) {
        foreach ($arEducationUpdate as $idItem => $arItem) {
          $bUpdate = $this->iblock->Update($idItem, $arItem);
        }
      }
      return $arEducationIds;
    }
    return "";
  }


}