<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arSort = array(
	"SHOWS" => GetMessage("CATALOG_SORT_SHOWS"),
	"PRICE_ASC" => GetMessage("CATALOG_SORT_PRICE_ASC"),
        "PRICE_DESC" => GetMessage("CATALOG_SORT_PRICE_DESC"),
        "NOVELTY" => GetMessage("CATALOG_SORT_NOVELTY"),
        "DISCOUNT" => GetMessage("CATALOG_SORT_DISCOUNT"),
);
$arComponentParameters = array(
	"PARAMETERS" => array(
		"SORT_LIST" => Array(
			"NAME"=>GetMessage("SORT_LIST"),
			"TYPE" => "LIST",
                        "MULTIPLE" => "Y",
			"DEFAULT"=>'-',
			"VALUES" => $arSort,
			"ADDITIONAL_VALUES" => "N",
			"PARENT" => "ADDITIONAL_SETTINGS",
		),
	)
);
?>
