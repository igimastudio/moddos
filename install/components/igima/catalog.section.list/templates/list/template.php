<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="sidebar">
        <?
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;

	foreach($arResult["SECTIONS"] as $arSection)
	{
		if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
		{
			echo "<ul>";
		}
		elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
		{
			echo "</li>";
		}
		else
		{
			while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
			{
				echo "</li>";
				echo "</ul>";
				$CURRENT_DEPTH--;
			}
			echo "</li>";
		}
		?>
            <li><a href="<?=$arSection["SECTION_PAGE_URL"]?>"<?if ($arSection["SELECTED"]):?> class="active"<?endif;?>><?=$arSection["NAME"]?><?if($arParams["COUNT_ELEMENTS"]):?>&nbsp;(<?=$arSection["ELEMENT_CNT"]?>)<?endif;?></a>
                <?
		$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
	}
	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</li>";
		echo "</ul>";
		$CURRENT_DEPTH--;
	}
	?>
</div>