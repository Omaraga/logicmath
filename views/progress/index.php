<?php include ROOT . '/views/layouts/header_cabinet.php'; ?>

    <section>
        <div class="container" id = "progress">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1 col-xs-12 p-0" id="headerProg">
                    <div class="headerProg" id="headerPr">
                        <a href="/profile" class="prof">
                        <div class="userAvatarq col-sm-2 col-xs-3">
                                <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/user/".$userId.".jpg"; ?>
                                <?if(file_exists($fileName)):?>
                                    <img src="/upload/images/user/<?=$userId;?>.jpg" alt="">
                                <?else:?>
                                    <img src="/upload/images/user/default.png" alt="">
                                <?endif;?>
                        </div>
                        <div class="userName col-sm-10  col-xs-9"><a href="/profile"><?=$userAndCity['fio'];?></a></div>
                        <div class="userclass col-sm-10  col-xs-8"><img src="<?php if($userAndCity['city']=="Казахстан")echo('/template/images/home/kz.png');?>" alt="" width="20"> <?//=$klass['name_kz']?></div>
                        </a>
                        <img class="tab-Prog" src="/template/images/home/tab-1.png" alt=""> 
                    </div>
                                       
                </div>
            </div>
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1 col-xs-12 p-0" id="progressNav">
                    <ul class="nav nav-pills">
                        <li class="active mobP" style="width:50%;">
                        <img src="/template/images/home/progress.png" alt="" class="imgP" >
                            <a class="progressText" data-toggle="pill" href="#progress_tap" onclick="changePhoto('tab-1.png')">                                
                                <span>Прогресс</span>
                            </a>
                        </li>
                        <li class="" style="width:49%;">
                        <img src="/template/images/home/certificate.png" alt=""  >
                            <a data-toggle="pill" href="#Cert_tab" class="progressText" onclick="changePhoto('tab-2.png')">                               
                                <span>Сертификаттар</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="progress_tap" class="tab-pane fade in active">
                        <div class="col-sm-6" style="margin-top: 5px">
                    <div class="progressTask col-xs-12">                        
                    <div class="taskTotal col-sm-8 col-xs-6">                            
                        <span class="taskImg">
                                <div class="tox-progress" data-size="60" data-thickness="5" data-color="#A15AC4" data-background="#fff" data-progress="<?=$sizeZapOtv;?>" data-speed="<?=$taskSize;?>">
                                <div class="tox-progress-content" data-vcenter="true">
                                    <img src="/template/images/home/mytask.png" alt=""><span class="imgtext" style="color: #000"><?=$sizeZapOtv;?> тапсырма орындалды</span>
                                </div>
                            </div>
                         </span>    
                    </div>
                    <div class="taskTotal col-sm-4 col-xs-6">
                        <span class="taskImg imgtask">
                            <img src="/template/images/home/star.png" alt=""><?=$myScore;?>
                        </span>
                    </div>                         
                </div>
                <div class="categories col-xs-12">
                <div class="categoriesText">
                                <h3>Сертификаттар</h3>                            
                                <div class="viewCert row">                             
                                <?$i=1 ?>                      
                                    <div class="col-xs-5 certV1">
                                        <img src="/upload/images/certs/<?=$certList[0]['id']?>.jpg" id="certChecked" alt="">
                                    </div>
                                    <div class="col-xs-7 certProgText">
                                        <h4 id="certName"><?=$certList[0]['name_kz']?></h4>
                                        <span id="taskCount" class="text-primary"><?=$certList[0]['count_task']?> сабақ</span>
                                        <?
                                            $count = $certList[0]['count_task'];
                                            $procCert = intval($sizeZapOtv/$count*100);
                                            if ($procCert > 100) {
                                                $procCert = 100;
                                            }
                                        ?>
                                        <div class="progress" id="progressBar" style="background-color: #d2e1d1;">
                                            <div class="progress-bar progress-bar-primary" id="progCert" style="width:<?=$procCert;?>%">
                                                <span id="certPer" style="font-weight: 600;"><?=$procCert;?>%</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <?foreach($certList as $cert):?>                               
                                    <div class="category col-sm-4 col-xs-4 col-md-4 certV2">
                                        <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/certs/".$cert['id'].".jpg"; ?>
                                        <?if(file_exists($fileName)):?>    
                                            <input type="text" hidden value="">
                                            <label>
                                                <?if($i<2):?>
                                                <input type="radio" id="certn" name="cert" onchange="takeId(<?=$i?>,'<?=$cert['name_kz'];?>',<?=$cert['count_task']?> , <?=$sizeZapOtv?>)" value="<?=$i++ ?>"  checked>
                                                <img src="/upload/images/certs/<?=$cert['id'];?>.jpg" alt="">
                                                <?else:?>
                                                <input type="radio" id="certn" name="cert" onclick="takeId(<?=$i?>,'<?=$cert['name_kz'];?>',<?=$cert['count_task']?>, <?=$sizeZapOtv?> )" value="<?=$i++ ?>"  >
                                                <img src="/upload/images/certs/<?=$cert['id'];?>.jpg" alt="">
                                                <?endif;?>
                                            </label>                                         
                                           
                                        <?endif;?>
                                    </div>                                
                            <?endforeach;?>
                            </div>
                </div>
                    </div>
                    <div class="col-sm-6 prog">
                    <div class="catBar col-xs-12" >
                    <div class="categoriesText col-sm-12 col-xs-12">
                                <h3>Курстың <?=intval($sizeZapOtv/$taskSize*100);?>% аяқталды.</h3>
                            </div>
                            <?foreach ($categoryList as $category):?>
                                <div class="col-sm-12 listCat  col-xs-12">
                                    <div class="category col-sm-2 col-xs-3">
                                        <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/category/".$category['id'].".jpg"; ?>
                                        <?if(file_exists($fileName)):?>
                                            <img src="/upload/images/category/<?=$category['id'];?>.jpg" alt="">
                                        <?endif;?>

                                    </div>
                                    <div class="col-xs-7 col-sm-8">
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


                                            ?>
                                            <div class="progress-bar progress-bar-success" style="width: <?=$proc;?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2">
                                        <p style="color:#fff">Solved</p>
                                        
                                        <p style="font-weight: 600;" class="text-primary">
                                            <?=$mySolvedTasks?>/<?=$total?>
                                        </p>
                                    </div>
                                    
    <!--                                <p>--><?//=$proc;?><!-- t=--><?//=$total;?><!-- m=--><?//=$mySolvedTasks;?><!-- c=--><?//=$userId;?><!--</p>-->
                                </div>
                            <?endforeach;?>
                    </div>
                    </div>
                        </div>
                        <div id="Cert_tab" class="tab-pane fade" style="background-color: #fff;">
                        <div class="col-sm-12 certContent">
                            <div class="categoriesText" style="text-align: center;">
                                    <h3 style="text-align: center; font-weight: 400">Курс өту барысында сіздің жетістіктеріңізді растайтын сертификаттар береміз <br><b><?=$sizeZapOtv;?></b> тапсырма орындалды</h3>
                                    <div class="center">
                                        <div class="progress" id="DoneProg">
                                            <div class="progress-bar progress-bar-purple" style="width: <?=intval($sizeZapOtv/$taskSize*100);?>%">
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $certColor = array(
                                            "text-primary", 
                                            "text-danger",
                                            "text-success",
                                        );
                                        $j=0;
                                    ?>
                                    <?foreach($certList as $cert):?>                               
                                        <div class="category col-sm-4 col-md-4 certV2">
                                            <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/certs/".$cert['id'].".jpg"; ?>
                                            <?if(file_exists($fileName)):?>    
                                                <input type="text" hidden value="">                                             
                                              <img src="/upload/images/certs/<?=$cert['id'];?>.jpg" alt="">
                                              <h4 style="text-align: center"><?=$cert['name_kz']?></h4>
                                              <p class="<?=$certColor[$j]; $j++;?>" style="text-align: center; font-weight: 500"><?=$cert['count_task']?> сабақ</p>                                                   
                                            <?endif;?>
                                        </div>                                
                                <?endforeach;?>
                                </div>
                                <div class="footer-purple col-sm-12 col-xs-12">
                                    <div class="col-sm-2" style="text-align: center">
                                            <img class="footer-cert" src="/template/images/home/footer-cert.png" alt="" >
                                    </div>
                                    <div class="col-sm-6 footerText">
                                    <span>
                                            Сертификатты электронды нұсқада немесе
                                            түпнұсқасын тапсырыс беріп алуға болады.
                                            </span>
                                    </div>
                                    <div class="col-sm-4 granted" style="color: #fff;">
                                        <?php $granted =5348;
                                             $count = 0; 
                                             $array = array();
                                             while ($granted != 0)  
                                             {  
                                                $array[++$count] = $granted % 10 ;
                                                 $granted = $granted / 10;
                                                 $granted = intval($granted);
                                             } 
                                            $reversed = array_reverse($array);                                    
                                        for($k=0;$k<$count;$k++){
                                            echo "<digit class='digit'>".$reversed[$k]."</digit>";
                                        }
                                        ?>
                                        
                                        <p class="grantedText">Сертификат берілді</p>

                                    </div>
                                </div>                               
                        </div>
                            
                    </div>
                        </div>
                    </div>
                </div>
            </div>           
            </div>
            
            <br>
        </div>
    </section>

    <img src="/template/images/home/tab-2.png" alt="" srcset="" hidden>

<?php include ROOT . '/views/layouts/footer_cabinet.php'; ?>

