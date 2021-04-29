<?php include ROOT . '/views/layouts/header_cabinet.php'; ?>

    <section>

        <div class="container-fluid">
            <div class="row">
            <div class="col-sm-10" >
                    
                <div class="div" id="btn-light">
                    <ul class="nav nav-pills">
                        <li class="active navBar1"><a data-toggle="pill" href="#home" class=" btn btn-light">Олимпиада және логика</a></li>
                        <li class="navBar2"><a data-toggle="pill" href="#matem" class=" btn btn-light">Математика</a></li>
                        <li class="navBar3" id = "showTask"><a data-toggle="pill" href="#menu1" class=" btn btn-light"></a></li>
                    </ul>
                </div>
                
                
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="col-sm-9" id="lessons">
                            <div class="">
                                <div class="">
                                    <? $counterVal = 1;?>
                                    <?foreach ($levels as $level):?>
                                        <?php $counter = 0;?>
                                        <div class="level row">
                                            <div class="col-sm-12">
                                                <h2><? echo $level['name_kz'];?></h2>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <?foreach ($level['razdel_id'] as $razdel):?>
                                                        <?

                                                        $razdelKLasses = explode('~', $razdel['klass_ids']);
                                                        if(!in_array($myKlass, $razdelKLasses)){
                                                            continue;
                                                        }
                                                        ?>

                                                        <div class="col-sm-3 col-xs-3">
                                                            <?$firstTask = Task::getFirstTaskIdByRazdelId($razdel['id']);?>
                                                            <?$url = isset($firstTask) ?"/cabinet/razdel/".$razdel['id']."/".$firstTask  : '/cabinet';?>
                                                            <a href="<?=($razdelMaps[$razdel['id']] == 1)?$url:'/cabinet';?>" class="razdelLink" attr-razdel-id="<?=$razdel['id'];?>" attr-razdel-name="<?=$razdel['name_kz'];?>">
                                                                
                                                                <? if ($razdelMaps[$razdel['id']] == 1):?>
                                                                    <div class="leo"><img src="/template/images/home/enable-task.png" alt="<? echo $razdel['name_kz'];?>"></div>
                                                                    <h4 style=""><?=in_array($razdel['id'], $myZapRazdelList)?'<i class="fa fa-check-circle" aria-hidden="true" style="color: gold;"></i>':'';?> <? echo $razdel['name_kz'];?></h4>
                                                                <?else:?>
                                                                    <div class="leo"><img src="/template/images/home/locked-task.png" alt="<? echo $razdel['name_kz'];?>"></div>
                                                                    <h4 style=""><? echo $razdel['name_kz'];?></h4>
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
                    </div>
                    <div id="matem" class="tab-pane fade">





                        <div class="col-sm-9" id="lessons">
                            <div class="">
                                <div class="">
                                    <? $counterVal = 1;?>
                                    <?foreach ($levels1 as $level):?>
                                        <?php $counter = 0;?>
                                        <div class="level row">
                                            <div class="col-sm-12">
                                                <h2><? echo $level['name_kz'];?></h2>
                                            </div>
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <?foreach ($level['razdel_id'] as $razdel):?>
                                                        <?

                                                        $razdelKLasses = explode('~', $razdel['klass_ids']);
                                                        if(!in_array($myKlass, $razdelKLasses)){
                                                            continue;
                                                        }
                                                        ?>

                                                        <div class="col-sm-3 col-xs-3">
                                                            <?$firstTask = Task::getFirstTaskIdByRazdelId($razdel['id']);?>
                                                            <?$url = isset($firstTask) ?"/cabinet/razdel/".$razdel['id']."/".$firstTask  : '/cabinet';?>
                                                            <a href="<?=($razdelMaps1[$razdel['id']] == 1)?$url:'/cabinet';?>" class="razdelLink" attr-razdel-id="<?=$razdel['id'];?>" attr-razdel-name="<?=$razdel['name_kz'];?>">

                                                                <? if ($razdelMaps1[$razdel['id']] == 1):?>
                                                                    <div class="leo"><img src="/template/images/home/enable-task.png" alt="<? echo $razdel['name_kz'];?>"></div>
                                                                    <h4 style=""><?=in_array($razdel['id'], $myZapRazdelList)?'<i class="fa fa-check-circle" aria-hidden="true" style="color: gold;"></i>':'';?> <? echo $razdel['name_kz'];?></h4>
                                                                <?else:?>
                                                                    <div class="leo"><img src="/template/images/home/locked-task.png" alt="<? echo $razdel['name_kz'];?>"></div>
                                                                    <h4 style=""><? echo $razdel['name_kz'];?></h4>
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
                    </div>
                    <div id="menu1" class="tab-pane fade">
                            <h3 class="center">Жорамалау тәсілі</h3>
                            <ul class="nav nav-pills">
                              <li class="active "><img src="/template/images/home/begin.png" class="navImg" alt=""><a data-toggle="pill" href="#begin" class="btn">Бастапқы</a></li>
                              <li class=""><img src="/template/images/home/inter.png" class="navImg" alt=""><a data-toggle="pill" href="#intermediate" class="btn">Орта</a></li>
                              <li class=""><img src="/template/images/home/advanced.png" class="navImg" alt=""><a data-toggle="pill" href="#advanced" class="btn">Жоғары</a></li>
                          </ul>
                          <div class="tab-content col-sm-12">
                              <div id="begin" class="tab-pane fade in active level row">

                              </div>
                              <div id="intermediate" class="tab-pane fade level row">

                              </div>
                              <div id="advanced" class="tab-pane fade level row">

                              </div>

                    </div>
                </div>
            </div>               

            </div>
        </div>
        <div class="leftbar hidden-xs">
                    <div class="rightMenu">
                        <div class="group">
                            <a href="/profile">                                    
                                    <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/user/".$userId.".jpg"; ?>
                                    <?if(file_exists($fileName)):?>
                                        <img class="userPhoto2" src="/upload/images/user/<?=$userId;?>.jpg" alt="">
                                    <?else:?>
                                        <img class="userPhoto2" src="/upload/images/user/default.png" alt="">
                                    <?endif;?>
                                <span><?=$user['name'];?> </span>
                            </a>
                        </div>
                        <div class="group">
                            <a href="/cabinet/rating">                                    
                                <img src="/template/images/home/star-right.png" alt="" >                        
                                <span><?=$myScore;?> </span>
                            </a>
                        </div>
                        <div class="group">
                            <a href="/cabinet/rating">                                    
                                <img src="/template/images/home/molnya.png" alt="">                        
                                <span>5</span>
                            </a>
                        </div>
                        <div class="group t-15">
                            <a href="/cabinet/rating">                                    
                                <img src="/template/images/home/progress-right.png" alt="" >                       
                                <span>1</span>
                            </a>
                        </div>
                        <div class="group ">
                            <a href="/progress">                                    
                                <img src="/template/images/home/cert-right.png" alt="" >                        
                                <span>1 из 3 </span>
                            </a>
                        </div>                      
                    </div>
                </div>
    </section>

<?php include ROOT . '/views/layouts/footer_cabinet.php'; ?>