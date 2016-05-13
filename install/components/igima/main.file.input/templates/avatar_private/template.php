<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if ($arParams["ALLOW_UPLOAD"] == "N" && empty($arResult['FILES']))
    return "";
$cnt = count($arResult['FILES']);
$js_id = CUtil::JSEscape($arParams['CONTROL_ID']);
?>
<div class="file-input">
    <ol class="webform-field-upload-list" id="file_input_upload_list_<?=$arParams['CONTROL_ID']?>"<?if ($cnt <= 0):?> style="display: none;"<?endif;?>></ol>
<?if ($arParams["ALLOW_UPLOAD"] != "N"):?>
        <div class="webform-field-upload">
            <span class="webform-button webform-button-upload"><?=GetMessage("MFI_LOAD");?></span><span class="webform-button-right"></span></span>
            <input type="file" name="<?=$arParams['INPUT_NAME_UNSAVED']?>" size="1" id="file_input_<?=$arParams['CONTROL_ID']?>" />
        </div>
<?endif;?>
</div>
<script type="text/javascript">
    BX.message({MFI_CONFIRM: '<?=CUtil::JSEscape(GetMessage('MFI_CONFIRM'))?>'});
    window.FILE_INPUT_<?=$js_id?> = new BX.CFileInput('<?=$js_id;?>', '<?=CUtil::JSEscape($arParams['INPUT_NAME'])?>', '<?=$arResult['CONTROL_UID']?>', '<?=CUtil::JSEscape(htmlspecialcharsback(POST_FORM_ACTION_URI))?>', <?='N' == 'N' ? 'false' : 'true'?>);
<?
if ($cnt > 0):
    $arFiles = array();
    foreach ($arResult['FILES'] as $ID => $arFile)
    {
        $arFiles[] = array(
            "fileName" => $arFile["ORIGINAL_NAME"],
            "fileID" => $ID,
            "fileURL" => $arFile['URL'],
            "fileSize" => $arFile['FILE_SIZE_FORMATTED']
        );
    }
    ?>
        window.FILE_INPUT_<?=$js_id?>.setFiles(<?=CUtil::PhpToJsObject($arFiles)?>);
<?endif;?>
</script>