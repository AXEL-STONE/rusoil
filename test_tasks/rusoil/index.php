<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тествое задание для ООО РУСОЙЛ");
?>

<?php
$APPLICATION->IncludeComponent(
	"rusoil:form", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"EMAIL_TO" => "re-or@ya.ru",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CATEGORY_FIELD" => array(
			0 => "Масла, автохимия, фильтры.",
			1 => "Шины, диски",
			2 => "",
		),
		"VIEW_FIELD" => array(
			0 => "Запрос цены и сроков поставки",
			1 => "Пополнение складов",
			2 => "Спецзаказ",
			3 => "",
		),
		"STOCK_FIELD" => array(
			0 => "Склад 1",
			1 => "Склад 2",
			2 => "Склад 3",
			3 => "",
		),
		"BRAND_FIELD" => array(
			0 => "Mobil",
			1 => "Лукойл",
			2 => "Sintec",
			3 => "",
		),
		"MAKE_FIELD" => array(
			0 => "Наименование",
			1 => "Количество",
			2 => "Фасовка",
			3 => "Клиент",
			4 => "",
		)
	),
	false
);
?>


<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>