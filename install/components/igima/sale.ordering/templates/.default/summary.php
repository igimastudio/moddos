<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$cnt = count($arResult["BASKET_ITEMS"]);?>
<div class="my-cart-col">
	<div class="my-cart-head">
		<span class="title"><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_MY_CART")?></span>
		<span class="cost"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?><span class="rur">i</span></span>
		<span class="number"><?=$cnt?> <?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_UNIT")?></span>
		<div class="clear"></div>
	</div> <!-- end my-cart-head -->
        <div class="cart-goods item-scroll">
        <?foreach ($arResult["BASKET_ITEMS"] as $c => $arItems):?>
                <div class="item item-2">
			<div class="image">
				<img src="<?=$arItems["DETAIL_PICTURE_SRC"]?>" alt=""/>
				<?if(!empty($arItems["DISCOUNT_PRICE_PERCENT"])):?>
                                <div class="discount-item">-<?=$arItems["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
                                <?endif;?>
			</div>
			<div class="item-info">
				<p><span class="bl-color"><?=$arItems["NAME"]?></span></p>
				<p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_BRAND")?> 
                                    <span class="bl-color"><?=$arItems["PROPERTY_BRAND_NAME"]?></span>
                                </p>
				<p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SIZE")?> 
                                    <span class="bl-color"><?=$arItems["PROPERTY_SIZE_NAME"]?></span>
                                </p>
				<span class="color-line">
					<p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_COLOR")?></p>
					<span class="color">
						<span style='background-color: <?=$arItems["PROPERTY_COLOR_COLCODE"]?>'></span>
					</span>
				</span> <!-- end color-line -->
				<p><?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_QUANTITY")?> 
                                    <span class="bl-color"><?=$arItems["QUANTITY"]?></span>
                                </p>
				<div class="cost-info">
                                <?if ($arItems["DISCOUNT_PRICE_PERCENT"]>0):?>
                                        <span class="new-cost">
                                                <?=$arItems["SUM"]?><span class="rur">i</span>
                                        </span>
                                        <span class="old-cost">
                                                <?=SaleFormatCurrency(($arItems["PRICE"]*$arItems["QUANTITY"])+($arItems["DISCOUNT_PRICE"]*$arItems["QUANTITY"]), $arItems["CURRENCY"]);?><span class="rur">i</span>
                                                <span class="cost-line"></span>
                                        </span>
                                <?else:?>
                                        <span class="old-cost">
                                                <?=$arItems["SUM"]?><span class="rur">i</span>
                                        </span>
                                <?endif;?>
                                </div> <!-- end cost-info -->
                        </div> <!-- end item-info -->
                        <? if ($c < $cnt-1):?>
                        <div class="item-line"></div>
                        <?endif;?>
                </div> <!-- end item -->
        <?endforeach?>
        </div> <!-- end cart-goods -->
	<div class="count">
		<?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_SUMM")?>
		<span class="total-cost"><?=$arResult["PRICE_WITHOUT_DISCOUNT"]?><span class="rur">i</span></span>
	</div> <!-- end count -->
        <?if ($arResult['DISCOUNT_PRICE_ALL']>0):?>
	<div class="count">
		<?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DISCOUNT")?>
		<span class="total-cost">-<?=$arResult['DISCOUNT_PRICE_ALL_FORMATED']?><span class="rur">i</span></span>
	</div> <!-- end count -->
        <?endif;?>
        <?if ($arResult["DELIVERY_PRICE"]>0):?>
	<div class="count">
		<?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_DELIVERY")?>
		<span class="total-cost"><?=$arResult["DELIVERY_PRICE_FORMATED"]?><span class="rur">i</span></span>
	</div> <!-- end count -->
        <?endif;?>
	<div class="count total-value">
		<?=GetMessage("IGIMA_MODDOS_SALE_ORDERING_TOTAL")?>
		<span class="total-cost"><?=$arResult["ORDER_TOTAL_PRICE_FORMATED"]?><span class="rur">i</span></span>
	</div> <!-- end total-value -->
	<div class="under-my-cart">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/under-my-cart-1.php",
                                "EDIT_TEMPLATE" => "standard.php"
                        ),
                        false
                );?>
	</div>
	<div class="under-my-cart">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/under-my-cart-2.php",
                                "EDIT_TEMPLATE" => "standard.php"
                        ),
                        false
                );?>
	</div>
	<div class="under-my-cart">
                <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/under-my-cart-3.php",
                                "EDIT_TEMPLATE" => "standard.php"
                        ),
                        false
                );?>
	</div>
</div> <!-- end my-cart-col -->