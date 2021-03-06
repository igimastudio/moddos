<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
global $DB;
/** @global CUser $USER */
global $USER;
/** @global CMain $APPLICATION */
global $APPLICATION;
/** @global CCacheManager $CACHE_MANAGER */
global $CACHE_MANAGER;
/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;
if(!CModule::IncludeModule("igima.moddos")) return;
CJSCore::Init(array("quick_view","popup"));
CPageOption::SetOptionString("main", "nav_page_in_session", "N");

/*************************************************************************
	Processing of received parameters
*************************************************************************/
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;
if(strlen($GLOBALS['BY_LINK'])>0)
    $arParams["BY_LINK"] = $GLOBALS['BY_LINK'];
if(strlen($GLOBALS['SHOW_ADV_BLOCK'])>0)
    $arParams["SHOW_ADV_BLOCK"] = $GLOBALS['SHOW_ADV_BLOCK'];
if(strlen($GLOBALS['FILTER_DISCOUNT'])>0)
    $arParams["FILTER_DISCOUNT"] = $GLOBALS['FILTER_DISCOUNT'];
if(strlen($GLOBALS['FILTER_NOVELTY'])>0)
    $arParams["FILTER_NOVELTY"] = $GLOBALS['FILTER_NOVELTY'];
if(strlen($GLOBALS['FILTER_NOVELTY_COUNT'])>0)
    $arParams["FILTER_NOVELTY_COUNT"] = $GLOBALS['FILTER_NOVELTY_COUNT'];
$arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["~SECTION_ID"]);
if($arParams["SECTION_ID"] > 0 && $arParams["SECTION_ID"]."" != $arParams["~SECTION_ID"])
{
	ShowError(GetMessage("CATALOG_SECTION_NOT_FOUND"));
	@define("ERROR_404", "Y");
	if($arParams["SET_STATUS_404"]==="Y")
		CHTTP::SetStatus("404 Not Found");
	return;
}
if(strlen($_REQUEST["ELEMENT_CODE"]) > 0)
{
    $arParams["ELEMENT_CODE"]=$_REQUEST["ELEMENT_CODE"];
}
if(strlen($_REQUEST["SECTION_CODE"]) > 0)
{
    $arParams["SECTION_CODE"]=$_REQUEST["SECTION_CODE"];
}
if(strlen($_REQUEST["ELEMENT_ID"]) > 0)
{
    $arParams["ELEMENT_ID"]=$_REQUEST["ELEMENT_ID"];
}
if (!in_array($arParams["INCLUDE_SUBSECTIONS"], array('Y', 'A', 'N')))
	$arParams["INCLUDE_SUBSECTIONS"] = 'Y';
$arParams["SHOW_ALL_WO_SECTION"] = $arParams["SHOW_ALL_WO_SECTION"]==="Y";

if (empty($arParams["ELEMENT_SORT_FIELD"]))
	$arParams["ELEMENT_SORT_FIELD"] = "sort";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["ELEMENT_SORT_ORDER"]))
	$arParams["ELEMENT_SORT_ORDER"] = "asc";
if (empty($arParams["ELEMENT_SORT_FIELD2"]))
	$arParams["ELEMENT_SORT_FIELD2"] = "id";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["ELEMENT_SORT_ORDER2"]))
	$arParams["ELEMENT_SORT_ORDER2"] = "desc";
if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	global ${$arParams["FILTER_NAME"]};
	$arrFilter = ${$arParams["FILTER_NAME"]};
	if(!is_array($arrFilter))
		$arrFilter = array();
}
$arParams["SECTION_URL"]=trim($arParams["SECTION_URL"]);
$arParams["DETAIL_URL"]=trim($arParams["DETAIL_URL"]);
$arParams["BASKET_URL"]=trim($arParams["BASKET_URL"]);
if(strlen($arParams["BASKET_URL"])<=0)
	$arParams["BASKET_URL"] = "/personal/basket.php";

$arParams["ACTION_VARIABLE"]=trim($arParams["ACTION_VARIABLE"]);
if(strlen($arParams["ACTION_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["ACTION_VARIABLE"]))
	$arParams["ACTION_VARIABLE"] = "action";

$arParams["PRODUCT_ID_VARIABLE"]=trim($arParams["PRODUCT_ID_VARIABLE"]);
if(strlen($arParams["PRODUCT_ID_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_ID_VARIABLE"]))
	$arParams["PRODUCT_ID_VARIABLE"] = "id";

$arParams["PRODUCT_QUANTITY_VARIABLE"]=trim($arParams["PRODUCT_QUANTITY_VARIABLE"]);
if(strlen($arParams["PRODUCT_QUANTITY_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_QUANTITY_VARIABLE"]))
	$arParams["PRODUCT_QUANTITY_VARIABLE"] = "quantity";

$arParams["PRODUCT_PROPS_VARIABLE"]=trim($arParams["PRODUCT_PROPS_VARIABLE"]);
if(strlen($arParams["PRODUCT_PROPS_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["PRODUCT_PROPS_VARIABLE"]))
	$arParams["PRODUCT_PROPS_VARIABLE"] = "prop";

$arParams["SECTION_ID_VARIABLE"]=trim($arParams["SECTION_ID_VARIABLE"]);
if(strlen($arParams["SECTION_ID_VARIABLE"])<=0|| !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["SECTION_ID_VARIABLE"]))
	$arParams["SECTION_ID_VARIABLE"] = "SECTION_ID";

$arParams["SET_TITLE"] = $arParams["SET_TITLE"]!="N";
$arParams["ADD_SECTIONS_CHAIN"] = $arParams["ADD_SECTIONS_CHAIN"]==="Y"; //Turn off by default
$arParams["DISPLAY_COMPARE"] = $arParams["DISPLAY_COMPARE"]=="Y";

$arParams["PAGE_ELEMENT_COUNT"] = intval($arParams["PAGE_ELEMENT_COUNT"]);
if($arParams["PAGE_ELEMENT_COUNT"]<=0)
	$arParams["PAGE_ELEMENT_COUNT"]=20;
$arParams["LINE_ELEMENT_COUNT"] = intval($arParams["LINE_ELEMENT_COUNT"]);
if($arParams["LINE_ELEMENT_COUNT"]<=0)
	$arParams["LINE_ELEMENT_COUNT"]=3;

if(!is_array($arParams["PROPERTY_CODE"]))
	$arParams["PROPERTY_CODE"] = array();
foreach($arParams["PROPERTY_CODE"] as $k=>$v)
	if($v==="")
		unset($arParams["PROPERTY_CODE"][$k]);

if(!is_array($arParams["PRICE_CODE"]))
	$arParams["PRICE_CODE"] = array();
$arParams["USE_PRICE_COUNT"] = $arParams["USE_PRICE_COUNT"]=="Y";
$arParams["SHOW_PRICE_COUNT"] = intval($arParams["SHOW_PRICE_COUNT"]);
if($arParams["SHOW_PRICE_COUNT"]<=0)
	$arParams["SHOW_PRICE_COUNT"]=1;
$arParams["USE_PRODUCT_QUANTITY"] = $arParams["USE_PRODUCT_QUANTITY"]==="Y";
if (empty($arParams['HIDE_NOT_AVAILABLE']))
	$arParams['HIDE_NOT_AVAILABLE'] = 'N';
elseif ('Y' != $arParams['HIDE_NOT_AVAILABLE'])
	$arParams['HIDE_NOT_AVAILABLE'] = 'N';

if(!is_array($arParams["PRODUCT_PROPERTIES"]))
	$arParams["PRODUCT_PROPERTIES"] = array();
foreach($arParams["PRODUCT_PROPERTIES"] as $k=>$v)
	if($v==="")
		unset($arParams["PRODUCT_PROPERTIES"][$k]);

if (!is_array($arParams["OFFERS_CART_PROPERTIES"]))
	$arParams["OFFERS_CART_PROPERTIES"] = array();
foreach($arParams["OFFERS_CART_PROPERTIES"] as $i => $pid)
	if ($pid === "")
		unset($arParams["OFFERS_CART_PROPERTIES"][$i]);

if (empty($arParams["OFFERS_SORT_FIELD"]))
	$arParams["OFFERS_SORT_FIELD"] = "sort";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER"]))
	$arParams["OFFERS_SORT_ORDER"] = "asc";
if (empty($arParams["OFFERS_SORT_FIELD2"]))
	$arParams["OFFERS_SORT_FIELD2"] = "id";
if (!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["OFFERS_SORT_ORDER2"]))
	$arParams["OFFERS_SORT_ORDER2"] = "desc";

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]!="N";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]!=="N";

$arNavParams = array(
	"nPageSize" => $arParams["PAGE_ELEMENT_COUNT"],
	"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
	"bShowAll" => $arParams["PAGER_SHOW_ALL"],
);
$arNavigation = CDBResult::GetNavParams($arNavParams);
if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
	$arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];

$arParams['CACHE_GROUPS'] = trim($arParams['CACHE_GROUPS']);
if ('N' != $arParams['CACHE_GROUPS'])
	$arParams['CACHE_GROUPS'] = 'Y';

$arParams["CACHE_FILTER"]=$arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
	$arParams["CACHE_TIME"] = 0;

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";

$arParams['CONVERT_CURRENCY'] = (isset($arParams['CONVERT_CURRENCY']) && 'Y' == $arParams['CONVERT_CURRENCY'] ? 'Y' : 'N');
$arParams['CURRENCY_ID'] = trim(strval($arParams['CURRENCY_ID']));
if ('' == $arParams['CURRENCY_ID'])
{
	$arParams['CONVERT_CURRENCY'] = 'N';
}
elseif ('N' == $arParams['CONVERT_CURRENCY'])
{
	$arParams['CURRENCY_ID'] = '';
}
$arParams["OFFERS_LIMIT"] = intval($arParams["OFFERS_LIMIT"]);
if (0 > $arParams["OFFERS_LIMIT"])
	$arParams["OFFERS_LIMIT"] = 0;
//Filter
if (empty($arParams['FILTER_NOVELTY']))
	$arParams['FILTER_NOVELTY'] = 'N';
if (empty($arParams['FILTER_DISCOUNT']))
	$arParams['FILTER_DISCOUNT'] = 'N';
if (empty($arParams['FILTER_NOVELTY_COUNT']))
	$arParams['FILTER_NOVELTY_COUNT'] = 30;

/*************************************************************************
			Processing of the Buy link
*************************************************************************/
$strError = "";
if (array_key_exists($arParams["ACTION_VARIABLE"], $_REQUEST) && array_key_exists($arParams["PRODUCT_ID_VARIABLE"], $_REQUEST))
{
	if(array_key_exists($arParams["ACTION_VARIABLE"]."BUY", $_REQUEST))
		$action = "BUY";
	elseif(array_key_exists($arParams["ACTION_VARIABLE"]."ADD2BASKET", $_REQUEST))
		$action = "ADD2BASKET";
	else
		$action = strtoupper($_REQUEST[$arParams["ACTION_VARIABLE"]]);

	$productID = intval($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]);
	if(($action == "ADD2BASKET" || $action == "BUY" || $action == "SUBSCRIBE_PRODUCT") && $productID > 0)
	{
		if (CModule::IncludeModule("sale") && CModule::IncludeModule("catalog"))
		{
			$QUANTITY = 0;
			$product_properties = array();
			$intProductIBlockID = intval(CIBlockElement::GetIBlockByID($productID));
			if (0 < $intProductIBlockID)
			{
				if ($intProductIBlockID == $arParams["IBLOCK_ID"])
				{
					if (!empty($arParams["PRODUCT_PROPERTIES"]))
					{
						if (
							array_key_exists($arParams["PRODUCT_PROPS_VARIABLE"], $_REQUEST)
							&& is_array($_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]])
						)
						{
							$product_properties = CIBlockPriceTools::CheckProductProperties(
								$arParams["IBLOCK_ID"],
								$productID,
								$arParams["PRODUCT_PROPERTIES"],
								$_REQUEST[$arParams["PRODUCT_PROPS_VARIABLE"]]
							);
							if (!is_array($product_properties))
								$strError = GetMessage("CATALOG_ERROR2BASKET").".";
						}
						else
						{
							$strError = GetMessage("CATALOG_ERROR2BASKET").".";
						}
					}
				}
				else
				{
					if (!empty($arParams["OFFERS_CART_PROPERTIES"]))
					{
						$product_properties = CIBlockPriceTools::GetOfferProperties(
							$productID,
							$arParams["IBLOCK_ID"],
							$arParams["OFFERS_CART_PROPERTIES"]
						);
					}
				}
				if ($arParams["USE_PRODUCT_QUANTITY"])
				{
					if (isset($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]))
					{
						$QUANTITY = doubleval($_REQUEST[$arParams["PRODUCT_QUANTITY_VARIABLE"]]);
					}
				}
				if (0 >= $QUANTITY)
				{
					$rsRatios = CCatalogMeasureRatio::getList(
						array(),
						array('PRODUCT_ID' => $productID),
						false,
						false,
						array('PRODUCT_ID', 'RATIO')
					);
					if ($arRatio = $rsRatios->Fetch())
					{
						$intRatio = intval($arRatio['RATIO']);
						$dblRatio = doubleval($arRatio['RATIO']);
						$QUANTITY = ($dblRatio > $intRatio ? $dblRatio : $intRatio);
					}
				}
				if (0 >= $QUANTITY)
					$QUANTITY = 1;
			}
			else
			{
				$strError = GetMessage('CATALOG_PRODUCT_NOT_FOUND').".";
			}

			$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
			$arNotify = unserialize($notifyOption);
			$arRewriteFields = array();
			if ($action == "SUBSCRIBE_PRODUCT" && $arNotify[SITE_ID]['use'] == 'Y')
			{
				$arRewriteFields["SUBSCRIBE"] = "Y";
				$arRewriteFields["CAN_BUY"] = "N";
			}

			if (isset($_REQUEST['ajax_basket']) && 'Y' == $_REQUEST['ajax_basket'])
			{
				if(!$strError && Add2BasketByProductID($productID, $QUANTITY, $arRewriteFields, $product_properties))
				{
					$arAddResult = array(
						'STATUS' => 'OK',
						'MESSAGE' => ''
					);
				}
				else
				{
					$arAddResult = array(
						'STATUS' => 'ERROR',
						'MESSAGE' => $strError
					);
				}
				$APPLICATION->RestartBuffer();
				echo CUtil::PhpToJSObject($arAddResult);
				die();
			}
			else
			{
				if(!$strError && Add2BasketByProductID($productID, $QUANTITY, $arRewriteFields, $product_properties))
				{
					if($action == "BUY")
						LocalRedirect($arParams["BASKET_URL"]);
					else
						LocalRedirect($APPLICATION->GetCurPageParam("", array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"])));
				}
				else
				{
					if($ex = $APPLICATION->GetException())
						$strError = $ex->GetString();
					else
						$strError = GetMessage("CATALOG_ERROR2BASKET").".";
				}
			}
		}
	}
}
if(strlen($strError)>0)
{
	ShowError($strError);
	return;
}
/*************************************************************************
			Work with cache
*************************************************************************/
if($this->StartResultCache(false, array($arrFilter, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), $arNavigation)))
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
		ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
		return;
	}

	$arResultModules = array(
		'iblock' => true,
		'catalog' => false,
		'currency' => false
	);

	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$arResultModules['currency'] = true;
			$arCurrencyInfo = CCurrency::GetByID($arParams['CURRENCY_ID']);
			if (!empty($arCurrencyInfo) && is_array($arCurrencyInfo))
			{
				$arParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $arCurrencyInfo['CURRENCY'];
			}
			else
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
		}
	}

	$arSelect = array();
	if(isset($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
	{
		foreach($arParams["SECTION_USER_FIELDS"] as $field)
			if(is_string($field) && preg_match("/^UF_/", $field))
				$arSelect[] = $field;
	}
	if(preg_match("/^UF_/", $arParams["META_KEYWORDS"])) $arSelect[] = $arParams["META_KEYWORDS"];
	if(preg_match("/^UF_/", $arParams["META_DESCRIPTION"])) $arSelect[] = $arParams["META_DESCRIPTION"];
	if(preg_match("/^UF_/", $arParams["BROWSER_TITLE"])) $arSelect[] = $arParams["BROWSER_TITLE"];

	$arFilter = array(
		"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
		"IBLOCK_ACTIVE"=>"Y",
		"ACTIVE"=>"Y",
		"GLOBAL_ACTIVE"=>"Y",
	);
	$bSectionFound = false;
	//Hidden triky parameter USED to display linked
	//by default it is not set
	if($arParams["BY_LINK"]==="Y" && strlen($arParams["SECTION_CODE"]) == 0)
	{
		$arResult = array(
			"ID" => 0,
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		);
		$bSectionFound = true;
	}
	elseif($arParams["SECTION_ID"] > 0)
	{
		$arFilter["ID"]=$arParams["SECTION_ID"];
		$rsSection = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
		$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
		$arResult = $rsSection->GetNext();
		if($arResult)
			$bSectionFound = true;
	}
	elseif(strlen($arParams["SECTION_CODE"]) > 0)
	{
		$arFilter["=CODE"]=$arParams["SECTION_CODE"];
		$rsSection = CIBlockSection::GetList(Array(), $arFilter, false, $arSelect);
		$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
		$arResult = $rsSection->GetNext();
		if($arResult)
			$bSectionFound = true;
	}
	else
	{
		//Root section (no section filter)
		$arResult = array(
			"ID" => 0,
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		);
		$bSectionFound = true;
	}
	if(!$bSectionFound)
	{
		$this->AbortResultCache();
		ShowError(GetMessage("CATALOG_SECTION_NOT_FOUND"));
		@define("ERROR_404", "Y");
		if($arParams["SET_STATUS_404"]==="Y")
			CHTTP::SetStatus("404 Not Found");
		return;
	}
	elseif($arResult["ID"] > 0 && $arParams["ADD_SECTIONS_CHAIN"])
	{
           
		$arResult["PATH"] = array();
		$rsPath = CIBlockSection::GetNavChain($arResult["IBLOCK_ID"], $arResult["ID"]);
		$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
		while($arPath = $rsPath->GetNext())
		{
			$arResult["PATH"][]=$arPath;
		}
	}

	$bIBlockCatalog = false;
	$arCatalog = false;
	$boolPropCacheExist = false;
	$bCatalog = CModule::IncludeModule('catalog');
	if ($bCatalog)
	{
		$arResultModules['catalog'] = true;
		$rsCatalogs = CCatalog::GetList(
			array(),
			array('IBLOCK_ID' => $arParams["IBLOCK_ID"]),
			false,
			false,
			array('IBLOCK_ID', 'PRODUCT_IBLOCK_ID', 'SKU_PROPERTY_ID')
		);
		$arCatalog = $rsCatalogs->Fetch();
		if (!empty($arCatalog) && is_array($arCatalog))
			$bIBlockCatalog = true;
		$boolPropCacheExist = method_exists('CCatalogDiscount', 'SetProductPropertiesCache');
	}
	$arResult['CATALOG'] = $arCatalog;
	//This function returns array with prices description and access rights
	//in case catalog module n/a prices get values from element properties
	$arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices($arParams["IBLOCK_ID"], $arParams["PRICE_CODE"]);
	$arResult['PRICES_ALLOW'] = CIBlockPriceTools::GetAllowCatalogPrices($arResult["PRICES"]);

	if ($bCatalog && !empty($arResult['PRICES_ALLOW']))
	{
		$boolDiscountFilterCache = CIBlockPriceTools::SetCatalogDiscountCache($arResult['PRICES_ALLOW'], $USER->GetUserGroupArray());
	}

	$arResult['CONVERT_CURRENCY'] = $arConvertParams;

	if ($arResult["ID"] > 0)
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arResult["IBLOCK_ID"], $arResult["ID"]);
		$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
	}
	else
	{
		$arResult["IPROPERTY_VALUES"] = array();
	}

	$arResult["PICTURE"] = CFile::GetFileArray($arResult["PICTURE"]);
	if ($arResult["PICTURE"] )
	{
		if ($arResult["ID"] > 0)
			$arResult["PICTURE"]["ALT"] = $arResult["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"];
		if ($arResult["PICTURE"]["ALT"] == "")
			$arResult["PICTURE"]["ALT"] = $arResult["NAME"];
		if ($arResult["ID"] > 0)
			$arResult["PICTURE"]["TITLE"] = $arResult["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"];
		if ($arResult["PICTURE"]["TITLE"] == "")
			$arResult["PICTURE"]["TITLE"] = $arResult["NAME"];
	}
	$arResult["DETAIL_PICTURE"] = CFile::GetFileArray($arResult["DETAIL_PICTURE"]);
	if ($arResult["DETAIL_PICTURE"] && $arResult["ID"] > 0)
	{
		if ($arResult["ID"] > 0)
			$arResult["DETAIL_PICTURE"]["ALT"] = $arResult["IPROPERTY_VALUES"]["SECTION_DETAIL_PICTURE_FILE_ALT"];
		if ($arResult["DETAIL_PICTURE"]["ALT"] == "")
			$arResult["DETAIL_PICTURE"]["ALT"] = $arResult["NAME"];
		if ($arResult["ID"] > 0)
			$arResult["DETAIL_PICTURE"]["TITLE"] = $arResult["IPROPERTY_VALUES"]["SECTION_DETAIL_PICTURE_FILE_TITLE"];
		if ($arResult["DETAIL_PICTURE"]["TITLE"] == "")
			$arResult["DETAIL_PICTURE"]["TITLE"] = $arResult["NAME"];
	}

	$bGetPropertyCodes = !empty($arParams["PROPERTY_CODE"]);
	$bGetProductProperties = !empty($arParams["PRODUCT_PROPERTIES"]);
	$bGetProperties = $bGetPropertyCodes || $bGetProductProperties;

	// list of the element fields that will be used in selection
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"CODE",
		"XML_ID",
		"NAME",
		"ACTIVE",
		"DATE_ACTIVE_FROM",
		"DATE_ACTIVE_TO",
		"SORT",
		"PREVIEW_TEXT",
		"PREVIEW_TEXT_TYPE",
		"DETAIL_TEXT",
		"DETAIL_TEXT_TYPE",
		"DATE_CREATE",
		"CREATED_BY",
		"TIMESTAMP_X",
		"MODIFIED_BY",
		"TAGS",
		"IBLOCK_SECTION_ID",
		"DETAIL_PAGE_URL",
		"DETAIL_PICTURE",
		"PREVIEW_PICTURE",
		"PROPERTY_*"
	);
	if ($bIBlockCatalog)
		$arSelect[] = "CATALOG_QUANTITY";
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
		"INCLUDE_SUBSECTIONS" => ($arParams["INCLUDE_SUBSECTIONS"] == 'N' ? 'N' : 'Y'),
	);
	if ($arParams["INCLUDE_SUBSECTIONS"] == 'A')
		$arFilter["SECTION_GLOBAL_ACTIVE"] = "Y";
	if ($bIBlockCatalog && 'Y' == $arParams['HIDE_NOT_AVAILABLE'])
		$arFilter['CATALOG_AVAILABLE'] = 'Y';

	if($arParams["BY_LINK"]!=="Y")
	{
		if($arResult["ID"])
			$arFilter["SECTION_ID"] = $arResult["ID"];
		elseif(!$arParams["SHOW_ALL_WO_SECTION"])
			$arFilter["SECTION_ID"] = 0;
		else
		{
			if (is_set($arFilter, 'INCLUDE_SUBSECTIONS'))
				unset($arFilter["INCLUDE_SUBSECTIONS"]);
			if (is_set($arFilter, 'SECTION_GLOBAL_ACTIVE'))
				unset($arFilter["SECTION_GLOBAL_ACTIVE"]);
		}
	}

	if($bCatalog && is_array($arrFilter["OFFERS"]))
	{
		$arOffersIBlock = CIBlockPriceTools::GetOffersIBlock($arParams["IBLOCK_ID"]);
		if(is_array($arOffersIBlock))
		{
			$arPriceFilter = array();
			foreach($arrFilter as $key => $value)
			{
				if(preg_match('/^(>=|<=|><)CATALOG_PRICE_/', $key))
				{
					$arPriceFilter[$key] = $value;
					unset($arrFilter[$key]);
				}
			}

			if(!empty($arPriceFilter) && !empty($arPriceFilter))
			{
				$arSubFilter = array_merge($arrFilter["OFFERS"], $arPriceFilter);
				$arSubFilter["IBLOCK_ID"] = $arOffersIBlock["OFFERS_IBLOCK_ID"];
				$arSubFilter["ACTIVE_DATE"] = "Y";
				$arSubFilter["ACTIVE"] = "Y";
				if ('Y' == $arParams['HIDE_NOT_AVAILABLE'])
					$arSubFilter['CATALOG_AVAILABLE'] = 'Y';
				$arFilter[] = array(
					"LOGIC" => "AND",
					array($arPriceFilter),
					"=ID" => CIBlockElement::SubQuery("PROPERTY_".$arOffersIBlock["OFFERS_PROPERTY_ID"], $arSubFilter),
				);
			}
			elseif(!empty($arrFilter["OFFERS"]))
			{
				$arSubFilter = $arrFilter["OFFERS"];
				$arSubFilter["IBLOCK_ID"] = $arOffersIBlock["OFFERS_IBLOCK_ID"];
				$arSubFilter["ACTIVE_DATE"] = "Y";
				$arSubFilter["ACTIVE"] = "Y";
				if ('Y' == $arParams['HIDE_NOT_AVAILABLE'])
					$arSubFilter['CATALOG_AVAILABLE'] = 'Y';
				$arFilter["=ID"] = CIBlockElement::SubQuery("PROPERTY_".$arOffersIBlock["OFFERS_PROPERTY_ID"], $arSubFilter);
			}
			elseif(!empty($arPriceFilter))
			{
				$arSubFilter = $arPriceFilter;
				$arSubFilter["IBLOCK_ID"] = $arOffersIBlock["OFFERS_IBLOCK_ID"];
				$arSubFilter["ACTIVE_DATE"] = "Y";
				$arSubFilter["ACTIVE"] = "Y";
				$arFilter[] = array(
					"LOGIC" => "OR",
					array($arPriceFilter),
					"=ID" => CIBlockElement::SubQuery("PROPERTY_".$arOffersIBlock["OFFERS_PROPERTY_ID"], $arSubFilter),
				);
			}
		}
	}

	//PRICES
	$arPriceTypeID = array();
	if(!$arParams["USE_PRICE_COUNT"])
	{
		foreach($arResult["PRICES"] as &$value)
		{
			if (!$value['CAN_VIEW'] && !$value['CAN_BUY'])
				continue;
			$arSelect[] = $value["SELECT"];
			$arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = $arParams["SHOW_PRICE_COUNT"];
		}
		if (isset($value))
			unset($value);
	}
	else
	{
		foreach ($arResult["PRICES"] as &$value)
		{
			if (!$value['CAN_VIEW'] && !$value['CAN_BUY'])
				continue;
			$arPriceTypeID[] = $value["ID"];
		}
		if (isset($value))
			unset($value);
	}

	$arSort = array(
		$arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"],
		$arParams["ELEMENT_SORT_FIELD2"] => $arParams["ELEMENT_SORT_ORDER2"],
	);

	$arDefaultMeasure = array();
	if ($bIBlockCatalog)
		$arDefaultMeasure = CIBlockPriceTools::GetDefaultMeasure();
	$arCurrencyList = array();
	$arSections = array();
        //Discount Filter
        if ($arParams['FILTER_DISCOUNT'] == 'Y')
            $arFilter[">PROPERTY_SALE"] = 0;
        $stmp = AddToTimeStamp(array("DD"=>-$arParams['FILTER_NOVELTY_COUNT']));
        //Novelty Filter
        if ($arParams['FILTER_NOVELTY'] == 'Y' && $arParams['FILTER_NOVELTY_COUNT']>0)
            $arrFilter['>DATE_ACTIVE_FROM'] = date("d.m.Y", $stmp);
        //Get Discount Prop
        $db_enum_list = CIBlockProperty::GetPropertyEnum("SALE", Array(), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"]));
        if($ar_enum_list = $db_enum_list->GetNext())
            $PropSale = $ar_enum_list["ID"];
	//EXECUTE
	$rsElements = CIBlockElement::GetList($arSort, array_merge($arrFilter, $arFilter), false, $arNavParams, $arSelect);
	$rsElements->SetUrlTemplates($arParams["DETAIL_URL"]);
	if($arParams["BY_LINK"]!=="Y" && !$arParams["SHOW_ALL_WO_SECTION"])
		$rsElements->SetSectionContext($arResult);
	$arResult["ITEMS"] = array();
	$arKeyMap = array();
	$arMeasureMap = array();
	$intKey = 0;
	while($obElement = $rsElements->GetNextElement())
	{
		$arItem = $obElement->GetFields();
		$arItem['ID'] = intval($arItem['ID']);
                if(MakeTimeStamp($arItem['DATE_ACTIVE_FROM']) > $stmp)
                        $arItem['NOVELTY'] = "Y";
		$arItem['ACTIVE_FROM'] = $arItem['DATE_ACTIVE_FROM'];
		$arItem['ACTIVE_TO'] = $arItem['DATE_ACTIVE_TO'];

		if($arResult["ID"])
			$arItem["IBLOCK_SECTION_ID"] = $arResult["ID"];

		$arButtons = CIBlock::GetPanelButtons(
			$arItem["IBLOCK_ID"],
			$arItem["ID"],
			$arResult["ID"],
			array("SECTION_BUTTONS"=>false, "SESSID"=>false, "CATALOG"=>true)
		);
		$arItem["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arItem["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

		$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arItem["IBLOCK_ID"], $arItem["ID"]);
		$arItem["IPROPERTY_VALUES"] = $ipropValues->getValues();

		$arItem["PREVIEW_PICTURE"] = (0 < $arItem["PREVIEW_PICTURE"] ? CFile::GetFileArray($arItem["PREVIEW_PICTURE"]) : false);
		if ($arItem["PREVIEW_PICTURE"])
		{
			$arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"];
			if ($arItem["PREVIEW_PICTURE"]["ALT"] == "")
				$arItem["PREVIEW_PICTURE"]["ALT"] = $arItem["NAME"];
			$arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"];
			if ($arItem["PREVIEW_PICTURE"]["TITLE"] == "")
				$arItem["PREVIEW_PICTURE"]["TITLE"] = $arItem["NAME"];
		}
		$arItem["DETAIL_PICTURE"] = (0 < $arItem["DETAIL_PICTURE"] ? CFile::GetFileArray($arItem["DETAIL_PICTURE"]) : false);
		if ($arItem["DETAIL_PICTURE"])
		{
			$arItem["DETAIL_PICTURE"]["ALT"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"];
			if ($arItem["DETAIL_PICTURE"]["ALT"] == "")
				$arItem["DETAIL_PICTURE"]["ALT"] = $arItem["NAME"];
			$arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"];
			if ($arItem["DETAIL_PICTURE"]["TITLE"] == "")
				$arItem["DETAIL_PICTURE"]["TITLE"] = $arItem["NAME"];
		}

		$arItem["PROPERTIES"] = array();
		if ($bGetProperties)
		{
			$arItem["PROPERTIES"] = $obElement->GetProperties();
			if ($bCatalog && $boolPropCacheExist)
				CCatalogDiscount::SetProductPropertiesCache($arItem['ID'], $arItem["PROPERTIES"]);
		}

		$arItem["DISPLAY_PROPERTIES"] = array();
		foreach($arParams["PROPERTY_CODE"] as $pid)
		{
			if (!isset($arItem["PROPERTIES"][$pid]))
				continue;
			$prop = &$arItem["PROPERTIES"][$pid];
			$boolArr = is_array($prop["VALUE"]);
			if(
				($boolArr && !empty($prop["VALUE"]))
				|| (!$boolArr && strlen($prop["VALUE"]) > 0)
			)
			{
				$arItem["DISPLAY_PROPERTIES"][$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop, "catalog_out");
			}
		}

		$arItem["PRODUCT_PROPERTIES"] = array();
		if ($bGetProductProperties)
		{
			$arItem["PRODUCT_PROPERTIES"] = CIBlockPriceTools::GetProductProperties(
				$arParams["IBLOCK_ID"],
				$arItem["ID"],
				$arParams["PRODUCT_PROPERTIES"],
				$arItem["PROPERTIES"]
			);
		}

		if (!isset($arItem["CATALOG_MEASURE_RATIO"]))
			$arItem["CATALOG_MEASURE_RATIO"] = 1;
		if (!isset($arItem['CATALOG_MEASURE']))
			$arItem['CATALOG_MEASURE'] = 0;
		$arItem['CATALOG_MEASURE'] = intval($arItem['CATALOG_MEASURE']);
		if (0 > $arItem['CATALOG_MEASURE'])
			$arItem['CATALOG_MEASURE'] = 0;
		if (!isset($arItem['CATALOG_MEASURE_NAME']))
			$arItem['CATALOG_MEASURE_NAME'] = '';
		if ($bIBlockCatalog)
		{
			$arItem['CATALOG_MEASURE_NAME'] = $arDefaultMeasure['SYMBOL_RUS'];
			$arItem['~CATALOG_MEASURE_NAME'] = $arDefaultMeasure['~SYMBOL_RUS'];
			if (0 < $arItem['CATALOG_MEASURE'])
			{
				if (!isset($arMeasureMap[$arItem['CATALOG_MEASURE']]))
					$arMeasureMap[$arItem['CATALOG_MEASURE']] = array();
				$arMeasureMap[$arItem['CATALOG_MEASURE']][] = $intKey;
			}
		}
		$arResult["ITEMS"][$intKey] = $arItem;
		$arResult["ELEMENTS"][$intKey] = $arItem["ID"];
		$arKeyMap[$arItem['ID']] = $intKey;
		$intKey++;
	}
	$arResult['MODULES'] = $arResultModules;
	$arResult["NAV_STRING"] = $rsElements->GetPageNavStringEx($navComponentObject, $arParams["PAGER_TITLE"], $arParams["PAGER_TEMPLATE"], $arParams["PAGER_SHOW_ALWAYS"]);
	$arResult["NAV_CACHED_DATA"] = $navComponentObject->GetTemplateCachedData();
	$arResult["NAV_RESULT"] = $rsElements;

	if ($bIBlockCatalog)
	{
		if (!empty($arKeyMap))
		{
			$rsRatios = CCatalogMeasureRatio::getList(
				array(),
				array('@PRODUCT_ID' => array_keys($arKeyMap)),
				false,
				false,
				array('PRODUCT_ID', 'RATIO')
			);
			while ($arRatio = $rsRatios->Fetch())
			{
				if (isset($arKeyMap[$arRatio['PRODUCT_ID']]))
				{
					$intRatio = intval($arRatio['RATIO']);
					$dblRatio = doubleval($arRatio['RATIO']);
					$mxRatio = ($dblRatio > $intRatio ? $dblRatio : $intRatio);
					if (CATALOG_VALUE_EPSILON > abs($mxRatio))
						$mxRatio = 1;
					elseif (0 > $mxRatio)
						$mxRatio = 1;
					$arResult["ITEMS"][$arKeyMap[$arRatio['PRODUCT_ID']]]['CATALOG_MEASURE_RATIO'] = $mxRatio;
				}
			}
		}
		if (!empty($arMeasureMap))
		{
			$rsMeasures = CCatalogMeasure::getList(
				array(),
				array('@ID' => array_keys($arMeasureMap)),
				false,
				false,
				array()
			);
			while ($arMeasure = $rsMeasures->GetNext())
			{
				$arMeasure['ID'] = intval($arMeasure['ID']);
				if (isset($arMeasureMap[$arMeasure['ID']]) && !empty($arMeasureMap[$arMeasure['ID']]))
				{
					foreach ($arMeasureMap[$arMeasure['ID']] as &$intOneKey)
					{
						$arResult['ITEMS'][$intOneKey]['CATALOG_MEASURE_NAME'] = $arMeasure['SYMBOL_RUS'];
						$arResult['ITEMS'][$intOneKey]['~CATALOG_MEASURE_NAME'] = $arMeasure['~SYMBOL_RUS'];
					}
					unset($intOneKey);
				}
			}
		}
	}
	if ($bCatalog && !empty($arResult["ELEMENTS"]))
	{
		if (method_exists('CCatalogDiscount', 'SetProductSectionsCache'))
			CCatalogDiscount::SetProductSectionsCache($arResult["ELEMENTS"]);
	}
	if (isset($arItem))
		unset($arItem);
	foreach ($arResult["ITEMS"] as &$arItem)
	{
		$arItem["PRICES"] = array();
		$arItem["PRICE_MATRIX"] = false;
		$arItem['MIN_PRICE'] = false;
		if($arParams["USE_PRICE_COUNT"])
		{
			if ($bCatalog)
			{
				$arItem["PRICE_MATRIX"] = CatalogGetPriceTableEx($arItem["ID"], 0, $arPriceTypeID, 'Y', $arConvertParams);
				foreach($arItem["PRICE_MATRIX"]["COLS"] as $keyColumn=>$arColumn)
					$arItem["PRICE_MATRIX"]["COLS"][$keyColumn]["NAME_LANG"] = htmlspecialcharsex($arColumn["NAME_LANG"]);
			}
		}
		else
		{
			$arItem["PRICES"] = CIBlockPriceTools::GetItemPrices($arParams["IBLOCK_ID"], $arResult["PRICES"], $arItem, $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);
			if (!empty($arItem["PRICES"]))
			{
				foreach ($arItem['PRICES'] as &$arOnePrice)
				{
					if ('Y' == $arOnePrice['MIN_PRICE'])
					{
						$arItem['MIN_PRICE'] = $arOnePrice;
						break;
					}
				}
                                //Set Discount Flag
                                foreach ($arItem['PRICES'] as &$Discount)
				{
                                        if (strlen($Discount["DISCOUNT_DIFF"])>0 && $Discount["DISCOUNT_DIFF"]>0)
                                            CIBlockElement::SetPropertyValuesEx($arItem["ID"], false, array("SALE" => $PropSale));
                                        
				}        
				unset($arOnePrice);
			}
		}
		$arItem["CAN_BUY"] = CIBlockPriceTools::CanBuy($arParams["IBLOCK_ID"], $arResult["PRICES"], $arItem);
		$arItem["~BUY_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=BUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
		$arItem["BUY_URL"] = htmlspecialcharsbx($arItem["~BUY_URL"]);
		$arItem["~ADD_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=ADD2BASKET&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
		$arItem["ADD_URL"] = htmlspecialcharsbx($arItem["~ADD_URL"]);
		$arItem["~COMPARE_URL"] = $APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arItem["ID"], array("action", "id"));
		$arItem["COMPARE_URL"] = htmlspecialcharsbx($arItem["~COMPARE_URL"]);
		$arItem["~SUBSCRIBE_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=SUBSCRIBE_PRODUCT&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arItem["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
		$arItem["SUBSCRIBE_URL"] = htmlspecialcharsbx($arItem["~SUBSCRIBE_URL"]);

		if ($arParams["BY_LINK"] === "Y")
		{
			if (!isset($arSections[$arItem["IBLOCK_SECTION_ID"]]))
			{
				$arSections[$arItem["IBLOCK_SECTION_ID"]] = array();
				$rsPath = CIBlockSection::GetNavChain($arItem["IBLOCK_ID"], $arItem["IBLOCK_SECTION_ID"]);
				$rsPath->SetUrlTemplates("", $arParams["SECTION_URL"]);
				while ($arPath = $rsPath->GetNext())
				{
					$arSections[$arItem["IBLOCK_SECTION_ID"]][] = $arPath;
				}
			}
			$arItem["SECTION"]["PATH"] = $arSections[$arItem["IBLOCK_SECTION_ID"]];
		}
		else
		{
			$arItem["SECTION"]["PATH"] = array();
		}

		if ('Y' == $arParams['CONVERT_CURRENCY'])
		{
			if ($arParams["USE_PRICE_COUNT"])
			{
				if (!empty($arItem["PRICE_MATRIX"]) && is_array($arItem["PRICE_MATRIX"]))
				{
					if (isset($arItem["PRICE_MATRIX"]['CURRENCY_LIST']) && is_array($arItem["PRICE_MATRIX"]['CURRENCY_LIST']))
						$arCurrencyList = array_merge($arCurrencyList, $arItem["PRICE_MATRIX"]['CURRENCY_LIST']);
				}
			}
			else
			{
				if (!empty($arItem["PRICES"]))
				{
					foreach ($arItem["PRICES"] as &$arOnePrices)
					{
						if (isset($arOnePrices['ORIG_CURRENCY']))
							$arCurrencyList[] = $arOnePrices['ORIG_CURRENCY'];
					}
					if (isset($arOnePrices))
						unset($arOnePrices);
				}
			}
		}
	}
	if (isset($arItem))
		unset($arItem);

	if(!isset($arParams["OFFERS_FIELD_CODE"]))
		$arParams["OFFERS_FIELD_CODE"] = array();
	elseif (!is_array($arParams["OFFERS_FIELD_CODE"]))
		$arParams["OFFERS_FIELD_CODE"] = array($arParams["OFFERS_FIELD_CODE"]);
	foreach($arParams["OFFERS_FIELD_CODE"] as $key => $value)
		if($value === "")
			unset($arParams["OFFERS_FIELD_CODE"][$key]);

	if(!isset($arParams["OFFERS_PROPERTY_CODE"]))
		$arParams["OFFERS_PROPERTY_CODE"] = array();
	elseif (!is_array($arParams["OFFERS_PROPERTY_CODE"]))
		$arParams["OFFERS_PROPERTY_CODE"] = array($arParams["OFFERS_PROPERTY_CODE"]);
	foreach($arParams["OFFERS_PROPERTY_CODE"] as $key => $value)
		if($value === "")
			unset($arParams["OFFERS_PROPERTY_CODE"][$key]);

	if(
		$bCatalog
		&& !empty($arResult["ELEMENTS"])
		&& (
			!empty($arParams["OFFERS_FIELD_CODE"])
			|| !empty($arParams["OFFERS_PROPERTY_CODE"])
		)
	)
	{
		$arOffers = CIBlockPriceTools::GetOffersArray(
			array(
				'IBLOCK_ID' => $arParams["IBLOCK_ID"],
				'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			)
			,$arResult["ELEMENTS"]
			,array(
				$arParams["OFFERS_SORT_FIELD"] => $arParams["OFFERS_SORT_ORDER"],
				$arParams["OFFERS_SORT_FIELD2"] => $arParams["OFFERS_SORT_ORDER2"],
			)
			,$arParams["OFFERS_FIELD_CODE"]
			,$arParams["OFFERS_PROPERTY_CODE"]
			,$arParams["OFFERS_LIMIT"]
			,$arResult["PRICES"]
			,$arParams['PRICE_VAT_INCLUDE']
			,$arConvertParams
		);
		if(!empty($arOffers))
		{
			$arElementOffer = array();
			foreach($arResult["ELEMENTS"] as $i => $id)
			{
				$arResult["ITEMS"][$i]["OFFERS"] = array();
				$arElementOffer[$id] = &$arResult["ITEMS"][$i]["OFFERS"];
			}

			foreach($arOffers as $arOffer)
			{
				if(array_key_exists($arOffer["LINK_ELEMENT_ID"], $arElementOffer))
				{
					$arOffer["~BUY_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=BUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["BUY_URL"] = htmlspecialcharsbx($arOffer["~BUY_URL"]);
					$arOffer["~ADD_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=ADD2BASKET&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["ADD_URL"] = htmlspecialcharsbx($arOffer["~ADD_URL"]);
					$arOffer["~COMPARE_URL"] = $APPLICATION->GetCurPageParam("action=ADD_TO_COMPARE_LIST&id=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["COMPARE_URL"] = htmlspecialcharsbx($arOffer["~COMPARE_URL"]);
					$arOffer["~SUBSCRIBE_URL"] = $APPLICATION->GetCurPageParam($arParams["ACTION_VARIABLE"]."=SUBSCRIBE_PRODUCT&id=".$arOffer["ID"], array($arParams["PRODUCT_ID_VARIABLE"], $arParams["ACTION_VARIABLE"]));
					$arOffer["SUBSCRIBE_URL"] = htmlspecialcharsbx($arOffer["~SUBSCRIBE_URL"]);

					$arElementOffer[$arOffer["LINK_ELEMENT_ID"]][] = $arOffer;

					if ('Y' == $arParams['CONVERT_CURRENCY'])
					{
						if (!empty($arOffer['PRICES']))
						{
							foreach ($arOffer['PRICES'] as &$arOnePrices)
							{
								if (isset($arOnePrices['ORIG_CURRENCY']))
									$arCurrencyList[] = $arOnePrices['ORIG_CURRENCY'];
							}
							if (isset($arOnePrices))
								unset($arOnePrices);
						}
					}
				}
			}
		}
	}

	if (
		'Y' == $arParams['CONVERT_CURRENCY']
		&& !empty($arCurrencyList)
		&& defined("BX_COMP_MANAGED_CACHE")
	)
	{
		$arCurrencyList[] = $arConvertParams['CURRENCY_ID'];
		$arCurrencyList = array_unique($arCurrencyList);
		$CACHE_MANAGER->StartTagCache($this->GetCachePath());
		foreach ($arCurrencyList as &$strOneCurrency)
		{
			$CACHE_MANAGER->RegisterTag("currency_id_".$strOneCurrency);
		}
		if (isset($strOneCurrency))
			unset($strOneCurrency);
		$CACHE_MANAGER->EndTagCache();
	}

	$this->SetResultCacheKeys(array(
		"ID",
		"NAV_CACHED_DATA",
		$arParams["META_KEYWORDS"],
		$arParams["META_DESCRIPTION"],
		$arParams["BROWSER_TITLE"],
		"NAME",
		"PATH",
		"IBLOCK_SECTION_ID",
		"IPROPERTY_VALUES",
	));

	$this->IncludeComponentTemplate();

	if ($bCatalog && method_exists('CCatalogDiscount', 'ClearDiscountCache'))
	{
		CCatalogDiscount::ClearDiscountCache(array(
			'PRODUCT' => true,
			'SECTIONS' => true,
			'PROPERTIES' => true
		));
	}
}

$arTitleOptions = null;
if($USER->IsAuthorized())
{
	if(
		$APPLICATION->GetShowIncludeAreas()
		|| (is_object($INTRANET_TOOLBAR) && $arParams["INTRANET_TOOLBAR"]!=="N")
		|| $arParams["SET_TITLE"]
		|| isset($arResult[$arParams["BROWSER_TITLE"]])
	)
	{
		if(CModule::IncludeModule("iblock"))
		{
			$UrlDeleteSectionButton = "";
			if($arResult["IBLOCK_SECTION_ID"] > 0)
			{
				$rsSection = CIBlockSection::GetList(
					array(),
					array("=ID" => $arResult["IBLOCK_SECTION_ID"]),
					false,
					array("SECTION_PAGE_URL")
				);
				$rsSection->SetUrlTemplates("", $arParams["SECTION_URL"]);
				$arSection = $rsSection->GetNext();
				$UrlDeleteSectionButton = $arSection["SECTION_PAGE_URL"];
			}

			if(empty($UrlDeleteSectionButton))
			{
				$url_template = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "LIST_PAGE_URL");
				$arIBlock = CIBlock::GetArrayByID($arParams["IBLOCK_ID"]);
				$arIBlock["IBLOCK_CODE"] = $arIBlock["CODE"];
				$UrlDeleteSectionButton = CIBlock::ReplaceDetailURL($url_template, $arIBlock, true, false);
			}

			$arReturnUrl = array(
				"add_section" => (
					strlen($arParams["SECTION_URL"])?
					$arParams["SECTION_URL"]:
					CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_PAGE_URL")
				),
				"delete_section" => $UrlDeleteSectionButton,
			);
			$arButtons = CIBlock::GetPanelButtons(
				$arParams["IBLOCK_ID"],
				0,
				$arResult["ID"],
				array("RETURN_URL" =>  $arReturnUrl, "CATALOG"=>true)
			);

			if($APPLICATION->GetShowIncludeAreas())
				$this->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));

			if(
				is_array($arButtons["intranet"])
				&& is_object($INTRANET_TOOLBAR)
				&& $arParams["INTRANET_TOOLBAR"]!=="N"
			)
			{
				$APPLICATION->AddHeadScript('/bitrix/js/main/utils.js');
				foreach($arButtons["intranet"] as $arButton)
					$INTRANET_TOOLBAR->AddButton($arButton);
			}

			if($arParams["SET_TITLE"] || isset($arResult[$arParams["BROWSER_TITLE"]]))
			{
				$arTitleOptions = array(
					'ADMIN_EDIT_LINK' => $arButtons["submenu"]["edit_section"]["ACTION"],
					'PUBLIC_EDIT_LINK' => $arButtons["edit"]["edit_section"]["ACTION"],
					'COMPONENT_NAME' => $this->GetName(),
				);
			}
		}
	}
}
$this->SetTemplateCachedData($arResult["NAV_CACHED_DATA"]);

if($arParams["SET_TITLE"])
{
	if ($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != "")
		$APPLICATION->SetTitle($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"], $arTitleOptions);
	elseif(isset($arResult["NAME"]))
		$APPLICATION->SetTitle($arResult["NAME"], $arTitleOptions);
}

$browserTitle = \Bitrix\Main\Type\Collection::firstNotEmpty(
	$arResult, $arParams["BROWSER_TITLE"]
	,$arResult["IPROPERTY_VALUES"], "SECTION_META_TITLE"
);
if (is_array($browserTitle))
	$APPLICATION->SetPageProperty("title", implode(" ", $browserTitle), $arTitleOptions);
elseif ($browserTitle != "")
	$APPLICATION->SetPageProperty("title", $browserTitle, $arTitleOptions);

if ($arParams["SET_META_KEYWORDS"] !== "N")
{
	$metaKeywords = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult, $arParams["META_KEYWORDS"]
		,$arResult["IPROPERTY_VALUES"], "SECTION_META_KEYWORDS"
	);
	if (is_array($metaKeywords))
		$APPLICATION->SetPageProperty("keywords", implode(" ", $metaKeywords), $arTitleOptions);
	elseif ($metaKeywords != "")
		$APPLICATION->SetPageProperty("keywords", $metaKeywords, $arTitleOptions);
}

if ($arParams["SET_META_DESCRIPTION"] !== "N")
{
	$metaDescription = \Bitrix\Main\Type\Collection::firstNotEmpty(
		$arResult, $arParams["META_DESCRIPTION"]
		,$arResult["IPROPERTY_VALUES"], "SECTION_META_DESCRIPTION"
	);
	if (is_array($metaDescription))
		$APPLICATION->SetPageProperty("description", implode(" ", $metaDescription), $arTitleOptions);
	elseif ($metaDescription != "")
		$APPLICATION->SetPageProperty("description", $metaDescription, $arTitleOptions);
}
if($arParams["ADD_SECTIONS_CHAIN"] && isset($arResult["PATH"]) && is_array($arResult["PATH"]))
{
	foreach($arResult["PATH"] as $arPath)
	{
		$APPLICATION->AddChainItem($arPath["NAME"], $arPath["~SECTION_PAGE_URL"]);
	}
}

return $arResult["ID"];
?>