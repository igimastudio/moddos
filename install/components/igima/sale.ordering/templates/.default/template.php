<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$APPLICATION->AddHeadScript($templateFolder."/script.js");
CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>
<? if ($_REQUEST["json"] == 'Y' && !empty($arResult["ERROR"])):?>
<?
echo json_encode(array("error" => $arResult["ERROR"]));
?>
<?else:
if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
{
	if(strlen($arResult["REDIRECT_URL"]) == 0)
		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
}
else
{?>
<div id="order_form_div">
        <div class="bx_order_make">
                <div class='ordering-steps'>
                <?
                if(!$USER->IsAuthorized() && empty($arParams["STEP"]))
                {
                        if(!empty($arResult["ERROR"]))
                        {
                                foreach($arResult["ERROR"] as $v)
                                        echo ShowError($v);
                        }
                        elseif(!empty($arResult["OK_MESSAGE"]))
                        {
                                foreach($arResult["OK_MESSAGE"] as $v)
                                        echo ShowNote($v);
                        }
                        include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
                }
                if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
                {
                        foreach($arResult["ERROR"] as $v)
                                echo ShowError($v);
                }
                include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
                include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
                include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
                include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
                ?>
                </div>
                <?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");?>
                <div class="clear"></div>
        </div>
</div>
<?
}
?>
<?endif;?>