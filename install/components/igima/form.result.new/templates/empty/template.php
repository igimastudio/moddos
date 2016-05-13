<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
if(!empty($arResult["FORM_ERRORS_TEXT"]))
echo json_encode(array('error'=>$arResult["FORM_ERRORS_TEXT"]));
?>
<?if(empty($arResult["FORM_ERRORS_TEXT"])):?>
<?echo json_encode(array('ok'=>'Y'));?>
<?endif?>