<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
			<div class="head">
				<div class="title"><?=GetMessage('DISCOUNT_THIS_WEEK');?></div>
				<div class="all"><a href="#"><?=GetMessage('ALL_DISCOUNT');?></a></div>
				<div class="rotator-button">
					<a class="prev" href="#"><span></span></a>
					<a class="next" href="#"><span></span></a>
				</div> <!-- end rotator-button -->
			</div> <!-- end head -->
                        <div class="slides_container">
					<div class="sl-in">
<?
foreach ($arResult['ITEMS'] as $key => $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);
        $quant = 0;
?>
                                            <div class="product" id="prod_<?=$arItem['ID']?>">
							<div class="product-block" id="<?=$strMainID?>">
								<a href="#" class="product-link">
									<span class="photo">
										
                                                                                <? if (!empty($arItem["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"])):?>
                                                                                <span class="discount">-<?=$arItem["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"]?>%</span>
                                                                                <?endif;?>
										<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
									</span>
									<span class="title"><?=$arItem["NAME"]?></span>
									<span class="brand"><?=$arItem["DISPLAY_PROPERTIES"]["BRA"]["DISPLAY_VALUE"]?></span>
                                                                        <? if ($arItem["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"]>0):?>
                                                                        <span class="price">
										<span class="price-new"><?=$arItem["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?><span class="rur">i</span></span>
										<span class="price-old">
											<span class="erase"><span><?=$arItem["PRICES"]["BASE"]["PRINT_VALUE"]?></span></span><span class="rur">i</span>
										</span>
									</span>
                                                                        <? else:?>
                                                                        <span class="price"><?=$arItem["PRICES"]["BASE"]["PRINT_VALUE"]?><span class="rur">i</span></span>
                                                                        <?endif;?>
								</a> <!-- end product-link -->
								<a href="#" class="view-btn"><?=GetMessage('QUICK_VIEW');?></a>
								<span class="arrow"></span>
							</div> <!-- end  product-block -->
							<div class="view">
								<div class="view-head">
									<a href="#" class="viem-prev"><i></i><?=GetMessage('PREVIEW_MODEL');?></a> |
									<a href="#" class="viem-next"><?=GetMessage('NEXT_MODEL');?><i></i></a>
									<a href="#" class="close"></a>
								</div> <!-- end view-head -->
								<div class="view-block">
									<table>
										<tr>
											<td class="image-block">
												<div class="zoom-block">
                                                                                                    <? if (!empty($arItem["PROPERTIES"]["DIM"]["VALUE"])):?>
													<div class="zoom-left">
                                                                                                            <? foreach ($arItem["PROPERTIES"]["DIM"]["VALUE"] as $dopPhoto):?>
                                                                                                                <?$srcPhoto = CFile::GetPath($dopPhoto);?>
                                                                                                                    <a href="#"><i></i><span><img src="<?=$srcPhoto?>" alt="" /></span></a>
                                                                                                                <?endforeach;?>
													</div> <!-- end zoom-left -->
                                                                                                        <?endif;?>
													<div class="zoom-right">
                                                                                                            <div class="main-img">
														<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
                                                                                                                <div class="product-zoom-map"></div>
                                                                                                            </div>
														<span class="new"><?=GetMessage('NOVELTY');?></span>
														<a href="#" class="video-ico"></a>
                                                                                                                <div class="poto-full">
															<div><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="" /></div>
														</div>
													</div> <!-- end  zoom-right-->
													<div class="clear"></div>
												</div> <!-- end zoom-block -->
												<div class="share">
													<div class="social">
														<span class="text"><?=GetMessage("IGIMA_MODDOS_PONRAVILOSQ_RASSKAJ")?></span>
														<a href="#" class="vk"></a>
														<a href="#" class="od"></a>
														<a href="#" class="facebook"></a>
														<a href="#" class="twitter"></a>
														<a href="#" class="google"></a>
														<a href="#" class="mail"></a>
														<a href="#" class="soc"></a>
														<a href="#" class="plus"></a>
														<span class="amount"><span class="left"><span>35558</span></span></span>
													</div> <!-- end social -->
													<div class="clear"></div>
												</div> <!-- end share -->
											</td>
											<td class="descript">
												<h2><a href="#"><?=$arItem["NAME"]?></a></h2>
												<div class="data">
													<div class="data-left">
                                                                                                            <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pcod => $arProp):?>
                                                                                                            <?if ($pcod != "COL"):?>
                                                                                                                <? if ($pcod == "BRA"):?>
                                                                                                                    <p class="line"><span class="data-name"><?=$arProp["NAME"]?>:</span><a href="<?=$arProp["UF_LINK"]?>"><?=$arProp["DISPLAY_VALUE"]?></a></p>
                                                                                                                <? else:?>
                                                                                                                    <p class="line"><span class="data-name"><?=$arProp["NAME"]?>:</span><span class="data-text"><?=$arProp["DISPLAY_VALUE"]?></span></p>
                                                                                                                <? endif;?>
                                                                                                              <? endif;?>
                                                                                                            <? endforeach;?>
													</div> <!-- end data-left -->
                                                                                                        <? if ($arItem["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"]>0):?>
													<div class="data-price data-price-old">
                                                                                                            <?=$arItem["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE"]?><span class="rur">i</span>
                                                                                                            <span class="price-old">
                                                                                                                <span class="erase">
                                                                                                                    <span><?=$arItem["PRICES"]["BASE"]["PRINT_VALUE"]?></span>
                                                                                                                </span>
                                                                                                                <span class="rur">i</span>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                        <?else:?>
                                                                                                        <div class="data-price"><?=$arItem["PRICES"]["BASE"]["PRINT_VALUE"]?><span class="rur">i</span></div>
                                                                                                        <?endif;?>
													<div class="clear"></div>
												</div> <!-- end data -->
												<div class="description-block"><p><?=$arItem["PREVIEW_TEXT"]?>  <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=GetMessage('DETAIL_TEXT');?></a></p></div>
												<div class="size">
													<a href="#" class="choose"><?=GetMessage('HOW_TO_SIZE');?></a>
													<?=GetMessage('SIZE');?> <span class="available"> <?=GetMessage('AVAIL');?></span>
													<span class="waiting"> <?=GetMessage('WAITING');?></span>
													<ul class="sizech">
                                                                                                            <? foreach ($arItem["OFFERS"] as $arOffers):?>
                                                                                                                <? if ($arOffers["CATALOG_QUANTITY"]>0):?>
                                                                                                                    <li><a data-offer="<?=$arOffers["ID"]?>" href="#"><?=$arOffers["DISPLAY_PROPERTIES"]["SIZ"]["DISPLAY_VALUE"]?></a></li>
                                                                                                                    <?$quant = $quant + $arOffers["CATALOG_QUANTITY"];?>
                                                                                                                <? else:?>
                                                                                                                    <li>
                                                                                                                        <a class="no-available" data-offer="<?=$arOffers["ID"]?>" href="#"><?=$arOffers["DISPLAY_PROPERTIES"]["SIZ"]["DISPLAY_VALUE"]?></a>
                                                                                                                        <div class="hints">
																<span class="hints-arrow"></span>
                                                                                                                                    <?=GetMessage('CHOOSE_SIZE');?>
															</div>
                                                                                                                    </li>
                                                                                                                <? endif;?>
                                                                                                            <? endforeach;?>
													</ul>
													<div class="clear"></div>
												</div> <!-- end size -->
												<div class="color">
                                                                                                    <?=GetMessage('COLOR');?><? if ($quant>0):?>
                                                                                                        <span class="available disin"> <?=GetMessage('AVAIL');?></span>
                                                                                                    <?else:?>
													<span class="waiting disin"> <?=GetMessage('WAITING');?></span>
                                                                                                    <?endif;?>
													<ul>
                                                                                                            <? if ($quant>0):?>
                                                                                                                    <li><a href="#" class="active"><span style="background-color: <?=$arItem["DISPLAY_PROPERTIES"]["COL"]["UF_COLCODE"]?>"></span></a>
                                                                                                                    <? if (!empty($arItem["DISPLAY_PROPERTIES"]["COL"]["DISPLAY_VALUE"])):?>
                                                                                                                    <div class="hints">
																<span class="hints-arrow"></span>
                                                                                                                                    <?=$arItem["DISPLAY_PROPERTIES"]["COL"]["DISPLAY_VALUE"]?>
															</div>
                                                                                                                    <? endif;?>
                                                                                                                    </li>
                                                                                                                <? else:?>
														<li><a class="no-available active" href="javascript:void(0);">
															<span style="background-color: <?=$arItem["DISPLAY_PROPERTIES"]["COL"]["UF_COLCODE"]?>"></span><i class="diagonal"></i></a>
															<div class="hints">
																<span class="hints-arrow"></span>
																	<?=$arItem["DISPLAY_PROPERTIES"]["COL"]["DISPLAY_VALUE"]?>
															</div> <!-- end hints -->
														</li>
                                                                                                                <? endif;?>
													</ul>
													<div class="clear"></div>
												</div> <!-- end color -->
                                                                                                <div class="button-wrap">
                                                                                                    <div class="hints hints-right">
                                                                                                        <span class="hints-arrow"></span>
                                                                                                           <?=GetMessage('NO_SIZE');?>
                                                                                                    </div>
                                                                                                    <div class="hints hints-left">
														<span class="hints-arrow"></span>
														<?=GetMessage('NO_SIZE');?>
                                                                                                    </div>
                                                                                                    <a href="#" class="add-elected-btn" prod-id="<?=$arItem["ID"]?>" offer-id=""><span class="ico"><i></i></span><span class="text"><?=GetMessage('ADD_TO_FAV');?></span></a>
                                                                                                    <? if ($quant>0):?>
                                                                                                        <a href="#" class="add-cart-btn" prod-id="<?=$arItem["ID"]?>" offer-id=""><span class="ico"><i></i></span><span class="text"><?=GetMessage('ADD_TO_CART');?></span></a>
                                                                                                        <a href="#<? if (!$USER->IsAuthorized()):?>inform-receipt<?endif;?>" class="inform-button<? if (!$USER->IsAuthorized()):?> inform-unlogin<?endif;?>" prod-id="<?=$arItem["ID"]?>" offer-id="" user-auth="<? if ($USER->IsAuthorized()):?>Y<?else:?>N<?endif;?>"><span class="ico"><i></i></span><?=GetMessage('REP_TO_COL');?></a>
                                                                                                    <?else:?>
                                                                                                        <a href="#<? if (!$USER->IsAuthorized()):?>inform-receipt<?endif;?>" class="inform-button disbl<? if (!$USER->IsAuthorized()):?> inform-unlogin<?endif;?>" prod-id="<?=$arItem["ID"]?>" offer-id="" user-auth="<? if ($USER->IsAuthorized()):?>Y<?else:?>N<?endif;?>"><span class="ico"><i></i></span><?=GetMessage('REP_TO_COL');?></a>
                                                                                                    <?endif;?>
                                                                                                    <div class="clear"></div>
                                                                                                </div> <!-- end button-wrap -->
											</td>
											<td class="edit">
                                                                                            <? $APPLICATION->IncludeComponent(
                                                                                                "bitrix:main.include",
                                                                                                "",
                                                                                                Array(
                                                                                                    "AREA_FILE_SHOW" => "file",
                                                                                                    "PATH" => "".SITE_TEMPLATE_PATH."/include_areas/grey_area.php",
                                                                                                    "EDIT_TEMPLATE" => "standard.php"
                                                                                                ),
                                                                                                false
                                                                                            );?>
                                                                                        </td>
										</tr>
									</table>
								</div> <!-- end view-block -->
							</div> <!-- end veiw -->
						</div> <!-- end product -->
<?endforeach;?>
						
					</div> <!-- end sl-in -->
				</div> <!-- end slides_container -->
				<div class="clear"></div>