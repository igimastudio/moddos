<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
?>
<div class="sorty-block" data-sec="<?=$arParams["SECTION_CODE"]?>" data-sort="<?=$_REQUEST["CATALOG_SORT"]?>">
    <span><?=GetMessage("IGIMA_MODDOS_CATALOG_SORT_BY");?></span>
    <div class="sorty">
        <a href="#" class="ico<?if (!empty($_REQUEST["CATALOG_SORT"])):?> sorty-reset<?endif;?>"></a>
        <span class="text"><?if (empty($_REQUEST["CATALOG_SORT"])):?><?=GetMessage("IGIMA_MODDOS_CATALOG_SORT_CHOOSE");?><?else:?><?=GetMessage("IGIMA_MODDOS_CATALOG_SORT_".$_REQUEST["CATALOG_SORT"]."");?><?endif;?></span>
        <ul>
            <?foreach ($arParams["SORT_LIST"] as $arSort):?>
                <li><a href="#" data-id="<?=$arSort?>"><?=GetMessage("IGIMA_MODDOS_CATALOG_SORT_".$arSort."");?></a></li>
            <?endforeach;?>
        </ul>
    </div> <!-- end sorty -->
</div> <!-- end sorty-block -->
