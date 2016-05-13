<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$cnt = count($arResult["ITEMS"]["AnDelCanBuy"]);
?>
<div class="my-cart-col">
			<div class="my-cart-head">
				<span class="title"><?=GetMessage("IGIMA_MODDOS_MOA_KORZINA")?></span>
				<span class="cost"><?=$arResult["allSum"]?><span class="rur">i</span></span>
				<span class="number"><?=$cnt?> <?=GetMessage("IGIMA_MODDOS_ST")?></span>
				<div class="clear"></div>
			</div> <!-- end my-cart-head -->
		
<? if ($cnt==0):?>
    <div class="cart-goods error"><?=GetMessage("IGIMA_MODDOS_VASA_KORZINA_PUSTA")?></div>
<?else:?>
    <div class="cart-goods item-scroll">
				<div class="item">
					<div class="image">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/my-cart-item-1.png" alt=""/>
						<div class="new-item"><?=GetMessage("NOVEL")?></div>
					</div>
					<div class="item-info">
						<p><span class="bl-color"><?=GetMessage("IGIMA_MODDOS_PLATQE")?></span></p>
						<p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color">Oasis</span></p>
						<p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color">42</span></p>
						<span class="color-line">
							<p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
							<span class="color">
								<span></span>
							</span>
						</span> <!-- end color-line -->
						<p><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color">2</span></p>
						<div class="cost-info">
							<span class="old-cost">
								5300<span class="rur">i</span>
							</span>
						</div> <!-- end cost-info -->
					</div> <!-- end item-info -->
					<div class="item-line"></div>
				</div> <!-- end item -->
				<div class="item item-2">
					<div class="image">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/my-cart-item-2.png" alt=""/>
						<div class="discount-item">-20%</div>
					</div>
					<div class="item-info">
						<p><span class="bl-color"><?=GetMessage("IGIMA_MODDOS_PLATQE")?></span></p>
						<p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color">Oasis</span></p>
						<p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color">42</span></p>
						<span class="color-line">
							<p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
							<span class="color">
								<span></span>
							</span>
						</span> <!-- end color-line -->
						<p><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color">2</span></p>
						<div class="cost-info">
							<span class="new-cost">
								4300<span class="rur">i</span>
							</span>
							<span class="old-cost">
								5300<span class="rur">i</span>
								<span class="cost-line"></span>
							</span>
						</div> <!-- end cost-info -->
					</div> <!-- end item-info -->
					<div class="item-line"></div>
				</div> <!-- end item -->
				<div class="item item-3">
					<div class="image">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/my-cart-item-3.png" alt=""/>
					</div>
					<div class="item-info">
						<p><span class="bl-color"><?=GetMessage("IGIMA_MODDOS_PLATQE")?></span></p>
						<p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color">Oasis</span></p>
						<p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color">42</span></p>
						<span class="color-line">
							<p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
							<span class="color">
								<span></span>
							</span>
						</span> <!-- end color-line -->
						<p><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color">2</span></p>
						<div class="cost-info">
							<span class="old-cost">
								5300<span class="rur">i</span>
							</span>
						</div> <!-- end cost-info -->
					</div> <!-- end item-info -->
					<div class="item-line"></div>
				</div> <!-- end item -->
				<div class="item">
					<div class="image">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/my-cart-item-1.png" alt=""/>
						<div class="new-item"><?=GetMessage("NOVEL")?></div>
					</div>
					<div class="item-info">
						<p><span class="bl-color"><?=GetMessage("IGIMA_MODDOS_PLATQE")?></span></p>
						<p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color">Oasis</span></p>
						<p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color">42</span></p>
						<span class="color-line">
							<p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
							<span class="color">
								<span></span>
							</span>
						</span> <!-- end color-line -->
						<p><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color">2</span></p>
						<div class="cost-info">
							<span class="old-cost">
								5300<span class="rur">i</span>
							</span>
						</div> <!-- end cost-info -->
					</div> <!-- end item-info -->
					<div class="item-line"></div>
				</div> <!-- end item -->
				<div class="item">
					<div class="image">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/my-cart-item-1.png" alt=""/>
						<div class="new-item"><?=GetMessage("NOVEL")?></div>
					</div>
					<div class="item-info">
						<p><span class="bl-color"><?=GetMessage("IGIMA_MODDOS_PLATQE")?></span></p>
						<p><?=GetMessage("IGIMA_MODDOS_BREND")?><span class="bl-color">Oasis</span></p>
						<p><?=GetMessage("IGIMA_MODDOS_RAZMER")?><span class="bl-color">42</span></p>
						<span class="color-line">
							<p><?=GetMessage("IGIMA_MODDOS_CVET")?></p>
							<span class="color">
								<span></span>
							</span>
						</span> <!-- end color-line -->
						<p><?=GetMessage("IGIMA_MODDOS_KOL_VO")?><span class="bl-color">2</span></p>
						<div class="cost-info">
							<span class="old-cost">
								5300<span class="rur">i</span>
							</span>
						</div> <!-- end cost-info -->
					</div> <!-- end item-info -->
				</div> <!-- end item -->
			</div> <!-- end cart-goods -->
			<div class="count">
				<?=GetMessage("IGIMA_MODDOS_SUMMA")?><span class="total-cost">11600<span class="rur">i</span></span>
			</div> <!-- end count -->
			<div class="count">
				<?=GetMessage("IGIMA_MODDOS_KUPON")?><span class="total-cost">-500<span class="rur">i</span></span>
			</div> <!-- end count -->
			<div class="count">
				<?=GetMessage("IGIMA_MODDOS_DOSTAVKA")?><span class="total-cost">640<span class="rur">i</span></span>
			</div> <!-- end count -->
			<div class="count total-value">
				<?=GetMessage("IGIMA_MODDOS_ITOGO_K_OPLATE")?><span class="total-cost">11740<span class="rur">i</span></span>
			</div> <!-- end total-value -->
			<div class="under-my-cart">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/under-my-cart-photo-1.png" alt=""/>
			</div>
			<div class="under-my-cart">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/under-my-cart-photo-2.png" alt=""/>
			</div>
			<div class="under-my-cart">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/under-my-cart-photo-3.png" alt=""/>
			</div>
<? endif; ?>
		</div> <!-- end my-cart-col -->
