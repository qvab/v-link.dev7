<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании"); ?><div class="container no-shadow">
 <br>
	<h1 class="text-center">О компании</h1>
 <br>
</div>
</header>
 <main>
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "about",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/area/index_about.php"
	)
);?>
</div>
 <br>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>