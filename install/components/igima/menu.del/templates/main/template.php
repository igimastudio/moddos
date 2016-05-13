<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div class="sidebar">
        <?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult as $arItem)
	{
		if($CURRENT_DEPTH < $arItem["DEPTH_LEVEL"])
		{
			echo "<ul>";
		}
		elseif($CURRENT_DEPTH == $arItem["DEPTH_LEVEL"])
		{
			echo "</li>";
		}
		else
		{
			while($CURRENT_DEPTH > $arItem["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "</ul>";
				$CURRENT_DEPTH--;
			}
			echo "</li>";
		}
		?>
            <li><a href="<?=$arItem["LINK"]?>"<?if ($arItem["SELECTED"]):?> class="active"<?endif;?>><?=$arItem["TEXT"]?></a>
                <?
		$CURRENT_DEPTH = $arItem["DEPTH_LEVEL"];
	}
	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "</ul>";
		$CURRENT_DEPTH--;
	}
	?>
</div>
<?endif?>