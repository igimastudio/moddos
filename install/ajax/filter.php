<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
?>
<?
ob_start();
$APPLICATION->IncludeComponent("igima:smart.filter", "visual_vertical", array(
	"IBLOCK_TYPE" => "mds",
	"IBLOCK_ID" => "#CATALOG_IBLOCK_ID#",
	"SECTION_ID" => "",
        "SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"FILTER_NAME" => "arrFilter",
	"HIDE_NOT_AVAILABLE" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"SAVE_IN_SESSION" => "N",
	"INSTANT_RELOAD" => "Y",
	"PRICE_CODE" => array(
		0 => "BASE",
	),
	"XML_EXPORT" => "N",
	"SECTION_TITLE" => "-",
	"SECTION_DESCRIPTION" => "-"
	),
	false
    );
$filter = ob_get_contents();
ob_end_clean();
ob_start();
$APPLICATION->IncludeFile(SITE_TEMPLATE_PATH."/include/showcase.php");
$showcase = ob_get_contents();
ob_end_clean();
echo json_encode(array("filter"=>$filter,"showcase"=>$showcase));