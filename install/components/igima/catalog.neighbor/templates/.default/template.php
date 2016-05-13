<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if ($arResult["ELEMENT_CNT"] > 2):?>
    <?
    $prev = $arResult["ITEMS"][$arParams["PAGE_ELEMENT_COUNT"] - 1];
    $next = $arResult["ITEMS"][$arParams["PAGE_ELEMENT_COUNT"] + 1];
    ?>
    <span id="show-adv-block" data-val="<?=$arParams["SHOW_ADV_BLOCK"]?>"></span>

    <div class="prev-preview">
        <a href="#" class="prev" data-id="<?=$prev["ID"]?>"><i></i></a>
        <a href="#" class="preview"><i></i>
            <?if (!empty($prev["PREVIEW_PICTURE"]["SRC"])):?>
                <img src="<?=$prev["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
            <?endif;?>
        </a>
    </div> <!-- end prev-preview -->
    <div class="next-preview">
        <a href="#" class="next" data-id="<?=$next["ID"]?>"><i></i></a>
        <a href="#" class="preview"><i></i>
            <?if (!empty($next["PREVIEW_PICTURE"]["SRC"])):?>
                <img src="<?=$next["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
            <?endif;?>
        </a>
    </div> <!-- end prev-preview -->
    <?=$arResult["ITEMS"][$arParams["PAGE_ELEMENT_COUNT"]]["RANK"];?> <?=GetMessage('IGIMA_MODDOS_NEIG_FROM');?> <?=$arResult["ELEMENT_CNT"];?>
    <div class="clear"></div>
    <div class="veil" id="veil-neighbor"></div>
<?endif;?>