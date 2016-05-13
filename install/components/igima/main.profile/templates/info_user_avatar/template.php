<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="avatar">
    <form method="post" name="form1"  enctype="multipart/form-data">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
        <input type="hidden" name="EMAIL" maxlength="50" value="<?echo $arResult["arUser"]["EMAIL"]?>" />
        <input type="hidden" name="LOGIN" maxlength="50" value="<?echo $arResult["arUser"]["LOGIN"]?>" />
        <?if (strlen($arResult["arUser"]["PERSONAL_PHOTO"]) <= 0):?>
            <div class="noavatar ava">
                <label class="upload-photo">
                    <?=GetMessage("IGIMA_MODDOS_LOAD_PHOTO")?>

                    <input class="typefile noava" type="file" size="20" name="PERSONAL_PHOTO">
                </label>
            </div> <!-- end noavatar -->

        <?else:?>

            <div class="noavatar ava" style="display:none">
                <label class="upload-photo">
                    <?=GetMessage("IGIMA_MODDOS_LOAD_PHOTO")?>
                    <input class="typefile noava" type="file" size="20" name="PERSONAL_PHOTO">
                </label>
            </div> <!-- end noavatar -->

            <div class="yesavatar ava" style="background: url('<?=CFile::GetPath($arResult["arUser"]["PERSONAL_PHOTO"]);?>') center no-repeat">
                <a href="" class="remove-avatar" name="avatar-remove"></a>
                <label class="upload-new-avatar">
                    <?=GetMessage("IGIMA_MODDOS_LOAD_PHOTO")?>
                    <input class="typefile yesava" type="file" size="20" name="PERSONAL_PHOTO">
                </label>
            </div> <!-- end yesavatar -->
        <?endif?>
</div> <!-- end avatar -->

<div class="photo-name">
    <input type="hidden" name="save" value="1">
    <p><a href="#" class="button-green" id="avatar-save"><?=GetMessage("IGIMA_MODDOS_SAVE_CHANGES")?></a></p>
</div>
</form>