<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<?
if (!empty($arResult["ERRORS"]))
{
    echo json_encode(array('error'=>$arResult["ERRORS"]));
}
else
    echo json_encode(array('OK'=>'Y'));  
?>