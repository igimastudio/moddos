<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
    <ul>
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat('</ul><span class="arrow-submenu"></span></div> <!-- end wrap --></li>', ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="submenu"><span class="top-line"></span><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?>class="active"<?endif?>><?=$arItem["TEXT"]?></a><span class="arrow"></span>
                            <div class="wrap">
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li><span class="top-line"></span><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?>class="active"<?endif?>><?=$arItem["TEXT"]?></a></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif?>


	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat('</ul><span class="arrow-submenu"></span></div> <!-- end wrap --></li>', ($previousLevel-1) );?>
<?endif?>
</ul>
<?endif?>