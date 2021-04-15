<?php include ROOT . '/views/layouts/header_cabinet.php'; ?>

    <section>

        <div class="container-fluid" id="lessons">
            <div class="row">


                <div class="col-sm-9">
                    <div class="container">
                        <div class="row">
                            <? $counterVal = 1;?>
                            <?foreach ($levels as $level):?>
                                <?php $counter = 0;?>
                                <div class="level row">
                                    <div class="col-sm-12">
                                        <h2><? echo $level['name_kz'];?></h2>+++
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <div class="row">
                                            <?foreach ($level['razdel_id'] as $razdel):?>
                                                <?

                                                $razdelKLasses = explode('~', $razdel['klass_ids']);
                                                if(!in_array($myKlass, $razdelKLasses)){
                                                    continue;
                                                }
                                                ?>

                                                <div class="col-sm-2 <?php echo getOffSet($counter);?> <?=($razdelMaps[$razdel['id']] == 1)?'':'disableRazdel';?> col-xs-6 <?=in_array($razdel['id'], $myZapRazdelList)?'razdelSolved':'chapter';?>">
                                                    <?$firstTask = Task::getFirstTaskIdByRazdelId($razdel['id']);?>
                                                    <?$url = isset($firstTask) ?"/cabinet/razdel/".$razdel['id']."/".$firstTask  : '/cabinet';?>
                                                    <a href="<?=($razdelMaps[$razdel['id']] == 1)?$url:'/cabinet';?>">
                                                        <div class="logo"><img src="../../upload/images/razdel/<? echo $razdel['id'];?>.jpg" alt="<? echo $razdel['name_kz'];?>"></div>
                                                        <? if ($razdelMaps[$razdel['id']] == 1):?>
                                                            <h4 style="height: 40px"><?=in_array($razdel['id'], $myZapRazdelList)?'<i class="fa fa-check-circle" aria-hidden="true" style="color: gold;"></i>':'';?> <? echo $razdel['name_kz'];?></h4>
                                                        <?else:?>
                                                            <h4 style="height: 40px"><i class="fa fa-lock" aria-hidden="true" style="color: #ffd950"></i> <? echo $razdel['name_kz'];?></h4>
                                                        <?endif;?>
                                                    </a>
                                                </div>
                                                <?php $counter++;?>
                                                <? $counterVal++;?>
                                            <?endforeach;?>
                                        </div>
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 hidden-xs">
                    <div class="row" id="categoryes">
                        <div class="col-sm-12" style="background-color: #523f9f; border-radius: 10px;">
                            <div class="col-sm-3" id="category">
                                <img src="/template/images/home/defaultCategory.png" alt="" style="width: 95%">
                            </div>
                            <div style="padding: 5px">
                            <h4>Жалпы прогресс</h4>
                            <div class="progress" style="background-color: #d2e1d1;">
                                <div class="progress-bar progress-bar-success" style="width: <?=$progressProc;?>%">
                                    <span style="font-weight: 600;"><?=$progressProc;?>%</span>
                                </div>
                            </div>
                            </div>
                        </div>
                        <? $counterCat = 0?>
                        <?foreach ($categoryList as $category):?>
                            <div class="col-sm-12">
                                <?
                                if ($counterCat >= 8){
                                    break;
                                }
                                ?>
                                <div class="col-sm-3" id="category">
                                    <img src="/upload/images/category/<?=$category['id'];?>.jpg" alt="">
                                </div>
                                <h4><?=$category['name_kz'];?></h4>
                                <div class="progress" style="background-color: #d2e1d1;">
                                    <?
                                    $total = intval($category['size']);
                                    $mySolvedTasks = Zap_otvetov::getRigthZapOtvetByCategoryId($userId, $category['id']);
                                    if (!isset($mySolvedTasks) || $mySolvedTasks == 0) {
                                        $mySolvedTasks = 0;
                                        $proc = 0;
                                    }else{
                                        $proc = $mySolvedTasks * 100/$total;
                                    }
                                    $proc = intval($proc);
                                    $counterCat++;
                                    ?>
                                    <div class="progress-bar progress-bar-success" style="width: <?=$proc;?>%">
                                        <span style="font-weight: 600;"><?=$proc;?>%</span>
                                    </div>
                                </div>
                            </div>
                        <?endforeach;?>
                        <div class="myUspeh">
                            <a href="/progress">Менің жетістіктерім</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_cabinet.php'; ?>