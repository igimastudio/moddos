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

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval($arParams["ID"]);
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["SECTION_ID"] = intval($arParams["SECTION_ID"]);
$arParams["SECTION_CODE"] = trim($arParams["SECTION_CODE"]);
$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0)
	$arParams["DEPTH_LEVEL"]=1;

$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"]
		);
		$arOrder = array(
			"left_margin"=>"asc",
		);
                if(array_key_exists("SECTION_FIELDS", $arParams) && !empty($arParams["SECTION_FIELDS"]) && is_array($arParams["SECTION_FIELDS"]))
                {
                    foreach($arParams["SECTION_FIELDS"] as &$field)
                    {
			if (!empty($field) && is_string($field))
				$arSelect[] = $field;
                    }
                    if (isset($field))
			unset($field);
                }
                if(!empty($arSelect))
                {
                    $arSelect[] = "ID";
                    $arSelect[] = "NAME";
                    $arSelect[] = "LEFT_MARGIN";
                    $arSelect[] = "RIGHT_MARGIN";
                    $arSelect[] = "DEPTH_LEVEL";
                    $arSelect[] = "IBLOCK_ID";
                    $arSelect[] = "IBLOCK_SECTION_ID";
                    $arSelect[] = "LIST_PAGE_URL";
                    $arSelect[] = "SECTION_PAGE_URL";
                }
                if(array_key_exists('SECTION_USER_FIELDS', $arParams) && !empty($arParams["SECTION_USER_FIELDS"]) && is_array($arParams["SECTION_USER_FIELDS"]))
                {
                    foreach($arParams["SECTION_USER_FIELDS"] as &$field)
                    {
			if(is_string($field) && preg_match("/^UF_/", $field))
				$arSelect[] = $field;
                    }
                    if (isset($field))
			unset($field);
                }
                $arResult = false;
                if($arParams["SECTION_ID"]>0)
                {
                    $arFilter["ID"] = $arParams["SECTION_ID"];
                    $arSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
                    $arResult = $arSections->GetNext();
                }
                elseif('' != $arParams["SECTION_CODE"])
                {
                    
                    $reSections = CIBlockSection::GetList(array(),array('IBLOCK_ID' => $arParams["IBLOCK_ID"], '=CODE' => $arParams["SECTION_CODE"], false, array("ID")));
                    if ($reSection = $reSections->Fetch())
                    {
                        $nav = CIBlockSection::GetNavChain($arParams["IBLOCK_ID"], $reSection["ID"], Array("DEPTH_LEVEL","ID","CODE"));
				if($ar_nav = $nav->GetNext())
				{
					if ($ar_nav["DEPTH_LEVEL"] == 1)
					{
						$arFilter["=CODE"] = $ar_nav["CODE"];
					}
				}
                                else 
                                {
                                    $arFilter["=CODE"] = $arParams["SECTION_CODE"];
                                }
                    }
                    $arSections = CIBlockSection::GetList(array(), $arFilter, false, $arSelect);
                    $arResult = $arSections->GetNext();
                }
                if(is_array($arResult))
                {
                    unset($arFilter["ID"]);
                    unset($arFilter["=CODE"]);
                    $arFilter["LEFT_MARGIN"]=$arResult["LEFT_MARGIN"]+1;
                    $arFilter["RIGHT_MARGIN"]=$arResult["RIGHT_MARGIN"];
                }
		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
		if($arParams["IS_SEF"] !== "Y")
			$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		else
			$rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);
		while($arSection = $rsSections->GetNext())
		{
                    $arResult["SECTIONS"][] = $arSection;
                    $arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
		}
		$this->EndResultCache();
	}
}

//In "SEF" mode we'll try to parse URL and get ELEMENT_ID from it
if($arParams["IS_SEF"] === "Y")
{
	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_BASE_URL"],
		array(
			"section" => $arParams["SECTION_PAGE_URL"],
			"detail" => $arParams["DETAIL_PAGE_URL"],
		),
		$arVariables
	);
	if($componentPage === "detail")
	{
		CComponentEngine::InitComponentVariables(
			$componentPage,
			array("SECTION_ID", "ELEMENT_ID"),
			array(
				"section" => array("SECTION_ID" => "SECTION_ID"),
				"detail" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID"),
			),
			$arVariables
		);
		$arParams["ID"] = intval($arVariables["ELEMENT_ID"]);
	}
}

if(($arParams["ID"] > 0) && (intval($arVariables["SECTION_ID"]) <= 0) && CModule::IncludeModule("iblock"))
{
	$arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID");
	$arFilter = array(
		"ID" => $arParams["ID"],
		"ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	);
	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	if(($arParams["IS_SEF"] === "Y") && (strlen($arParams["DETAIL_PAGE_URL"]) > 0))
		$rsElements->SetUrlTemplates($arParams["SEF_BASE_URL"].$arParams["DETAIL_PAGE_URL"]);
	while($arElement = $rsElements->GetNext())
	{
		$arResult["ELEMENT_LINKS"][$arElement["IBLOCK_SECTION_ID"]][] = $arElement["~DETAIL_PAGE_URL"];
	}
}
$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
if(CModule::IncludeModule("iblock"))
{
    foreach($arResult["SECTIONS"] as $cnt => $arSection)
    {
        if ($arSection["DEPTH_LEVEL"] == 1)
        {
            $arrFilter = Array(
                "IBLOCK_ID"=>$arSection["IBLOCK_ID"],
                "SECTION_ID"=>$arSection["ID"]
            );
            $arResult["SECTIONS"][$cnt]["SECTIONS_COUNT"] = CIBlockSection::GetCount($arrFilter);

        }
        for ($i=1;$i<5;$i++)
        {     
            if (!empty($arSection["UF_INNERBAN".$i.""]))
            {
                $res = CIBlockElement::GetByID($arSection["UF_INNERBAN".$i.""]);
                if($ar_res = $res->GetNext())
                {
                    $arResult['SECTIONS'][$cnt]["UF_INNERBAN".$i.""] = $ar_res['DETAIL_TEXT'];
                    $arResult['SECTIONS'][$cnt]["~UF_INNERBAN".$i.""] = $ar_res['~DETAIL_TEXT'];
                }
            }
            if ($i<4)
            {
                if (!empty($arSection["UF_OUTER".$i.""]))
                {
                    $res = CIBlockElement::GetByID($arSection["UF_OUTER".$i.""]);
                    if($ar_res = $res->GetNext())
                    {
                        $arResult['SECTIONS'][$cnt]["UF_OUTER".$i.""] = $ar_res['DETAIL_TEXT'];
                        $arResult['SECTIONS'][$cnt]["~UF_OUTER".$i.""] = $ar_res['~DETAIL_TEXT'];
                    }
                }
            }
        }
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];

	$arResult["ELEMENT_LINKS"][$arSection["ID"]][] = urldecode($arSection["~SECTION_PAGE_URL"]);
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$arSection["~SECTION_PAGE_URL"],
		$arResult["ELEMENT_LINKS"][$arSection["ID"]],
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
                        "SECTIONS" => $arResult['SECTIONS'][$cnt]
		),
	);
    }
}
return $aMenuLinksNew;
?>