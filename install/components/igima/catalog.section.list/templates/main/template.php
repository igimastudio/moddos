<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<ul class="menu">
    <?
    $previousLevel = 0;
    $sec_cnt = 0;
    $adv = 0;
    $ban = 0;
    foreach ($arResult["SECTIONS"] as $cnt => $arSection):
        if ($arSection["SECTIONS_COUNT"])
            $sec_cnt = $arSection["SECTIONS_COUNT"];
        ?>
        <?if ($previousLevel && (($arSection["DEPTH_LEVEL"] + 1) == $previousLevel)):?>
            <?if ($previousLevel == 3):?>
            </ul></td>
        <?endif;?>
        <?if ($previousLevel == 2):?>
            <?for ($i = 1; $i < 3; $i++)
            {?>
                <td class="pict">
                    <?$adv++;?>
                <?=$UF_INNERBAN[$adv];?>
                </td>
                <? }?>
            </tr></table><div class="info">
                <?for ($j = 1; $j < 4; $j++)
                {
                    $ban++;
                    echo $UF_OUTER[$ban];
                }?>
                <div class="clear"></div></div></div></div></li>
        <?endif;?>
    <?else:?>
        <?if ($previousLevel && (($arSection["DEPTH_LEVEL"] + 2) == $previousLevel)):?>
            </ul></td>
                <?for ($i = 1; $i < 3; $i++)
                {?>
                <td class="pict">
                <?$adv++;?>
                    <?=$UF_INNERBAN[$adv];?>
                </td>
                <? }?>
            </tr></table><div class="info">
                <?for ($j = 1; $j < 4; $j++)
                {
                    $ban++;
                    echo $UF_OUTER[$ban];
                }?>
                <div class="clear"></div></div></div></div></li>
        <?endif?>
    <?endif?>
    <?if ($arSection["DEPTH_LEVEL"] < $arResult["SECTIONS"][$cnt + 1]["DEPTH_LEVEL"]):?>
        <?if ($arSection["DEPTH_LEVEL"] == 1):?>
            <?
            $b = 0;
            $adv = 0;
            $ban = 0;
            $UF_INNERBAN = array();
            $UF_OUTER = array();
            for ($k = 1; $k < 5; $k++)
            {
                if (!empty($arSection["UF_INNERBAN".$k.""]))
                    $UF_INNERBAN[$k] = $arSection["UF_INNERBAN".$k.""];
            }
            for ($m = 1; $m < 5; $m++)
            {
                if (!empty($arSection["UF_OUTER".$m.""]))
                    $UF_OUTER[$m] = $arSection["UF_OUTER".$m.""];
            }
            ?>
            <li<?if ($_REQUEST["SECTION_CODE"] == $arSection["CODE"]):?> class="active"<?endif;?>><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><span class="text"><?=$arSection["NAME"]?></span><span class="arrow"></span><span class="darkening"></span></a>
                <div class="submenu"><div class="content"><table><tr>
                                <?else:?>
                                    <?if (ceil($sec_cnt / 2) == $b):?>
                                    <?for ($i = 1; $i < 3; $i++)
                                    {?>
                                        <td class="pict">
                                            <?$adv++;?>
                                            <?=$UF_INNERBAN[$adv];?>
                                        </td>
                                            <? }?>
                                </tr><tr>
                                        <?endif;?>
                                <td><div class="ico"><img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["PICTURE"]["ALT"]?>" /></div><a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="category"><?=$arSection["NAME"]?></a><ul> 
                                        <?$b++;?>
                                        <?endif?>
                                    <?else:?>
                                        <?if ($arSection["DEPTH_LEVEL"] == 2):?>
                                        <?if (ceil($sec_cnt / 2) == $b):?>
                                            <?for ($i = 1; $i < 3; $i++)
                                            {?>
                                                <td class="pict">
                                            <?$adv++;?>
                                            <?=$UF_INNERBAN[$adv];?>
                                                </td>
                                <? }?>
                                </tr><tr>
                            <?endif;?>
                                <td><div class="ico"><img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["PICTURE"]["ALT"]?>" /></div><a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="category"><?=$arSection["NAME"]?></a>
                            <?$b++;?>
                        <?else:?>
                            <li id="<?=$this->GetEditAreaId($arSection['ID']);?>"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></li>
                        <?endif?>
                    <?endif?>
                    <?$previousLevel = $arSection["DEPTH_LEVEL"];?>
                        <?
                    endforeach;
                    ?>
                <?if ($previousLevel > 1)://close last item tags?>
                    </ul></td>
                    <?for ($i = 1; $i < 3; $i++)
                    {?>
                        <td class="pict">
                        <?$adv++;?>
                        <?=$UF_INNERBAN[$adv];?>
                        </td>
    <? }?>
                    </tr></table><div class="info">
    <?for ($j = 1; $j < 4; $j++)
    {
        $ban++;
        echo $UF_OUTER[$ban];
    }?>
                    <div class="clear"></div></div>
            </div>
        </div>
    </li>
<?endif?>
</ul>