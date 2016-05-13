<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("igima.moddos")) return;
//Clean URL
if (strlen($_REQUEST["SECTION_CODE3"]) > 0)
{
    $arParams["SECTION_CODE"]=$_REQUEST["SECTION_CODE3"];
}
elseif(strlen($_REQUEST["SECTION_CODE2"]) > 0)
{
    $arParams["SECTION_CODE"]=$_REQUEST["SECTION_CODE2"];
}
elseif(strlen($_REQUEST["SECTION_CODE"]) > 0)
{
    $arParams["SECTION_CODE"]=$_REQUEST["SECTION_CODE"];
}

CJSCore::Init(array("catalog_sort"));

$this->IncludeComponentTemplate();
?>