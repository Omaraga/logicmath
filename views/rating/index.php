<?php include ROOT . '/views/layouts/header_cabinet.php'; ?>

    <section>
        <div class="container" id = "rating">
            <div class="row">
                <div class="col-sm-12 col-xs-12" id="ratTop">
                    <div class="col-xs-4 col-sm-6 p-0 ratingPlace1">
                        <img src="/template/images/home/rating-top.png" alt="">
                        <span>
                            <?if ($country_id == -2):?>
                                <h4><? echo $myRatingPlace!=false ? "Сіз ".$myRatingPlace['school_place']." орындасыз.":'Рейтингке кіру үшін тапсырма орындау қажет';?> </h4>
                            <?elseif ($country_id == -1):?>
                                <h4><? echo $myRatingPlace!=false ? "Сіз ".$myRatingPlace['city_place']." орындасыз.":'Рейтингке кіру үшін тапсырма орындау қажет';?> </h4>
                            <?elseif ($country_id == 0):?>
                                <h4><? echo $myRatingPlace!=false ? "Сіз ".$myRatingPlace['place']." орындасыз.":'Рейтингке кіру үшін тапсырма орындау қажет';?> </h4>
                            <?else:?>
                                <h4><? echo $myRatingPlace!=false ? "Сіз ".$myRatingPlace['country_place']." орындасыз.":'Рейтингке кіру үшін тапсырма орындау қажет';?> </h4>
                            <?endif;?>
                        </span>                        
                    </div>
                    <div class="col-xs-4 col-sm-4  ratingPlace topPad">
                        <h4>0 жане 1 сынып</h4>
                    </div>
                    <div class="col-xs-2 col-sm-2 center topPad">
                        <div class="bgrad <? echo intval($country_id) > 0? 'activ':'';?>">
                            <a  href="/cabinet/rating/<?=$user['country_id']?>"><img src="/template/images/coutnry/<?=$user['country_id']?>.png" alt=""></a>
                        </div>
                        <div class="bgrad <? echo intval($country_id) == 0? 'activ':'';?>">
                            <a  href="/cabinet/rating/0"><img src="/template/images/coutnry/0.png" alt=""></a>
                        </div>
                        
                    </div>


                        

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                        <div id="country">
                            <div class="col-sm-4 col-xs-4 ratNav activ" id="active">
                                <a href="/cabinet/rating" class="ratbtn"><img src="/template/images/home/children.png" class="ratImg" alt=""><br class="visible-xs"><span class="btn">Оқушылар</span></a>
                            </div>
                            <div class="col-sm-4 col-xs-4 <? echo $country_id ==-1? 'activ':'';?> ratNav">
                                <a href="/cabinet/rating/-1" class="ratbtn"><img src="/template/images/home/city.png" class="ratImg" alt=""><span class="btn">Қалалар</span> </a>
                            </div>
                            <div class="col-sm-4 col-xs-4 <? echo $country_id ==-2? 'activ':'';?> ratNav">
                                <a href="/cabinet/rating/-2" class="ratbtn"><img src="/template/images/home/school.png" class="ratImg" alt=""><span class="btn">Мектептер</span></a>
                            </div>
                        </div>
                </div>
            </div>
                    <div class="row">
                        <div class="col-sm-12 participantsTable">

                            <table class = "table">

                                <? foreach ($ratingList as $rating):?>
                                    <tr style="<?echo $rating['user_id'] == $userId?'font-weight:600; background-color: #FFCE00':'';?>">
                                        <?if ($country_id == -2):?>
                                            <td id="num" width="5%"><?=$rating['school_place'];?></td>
                                        <?elseif ($country_id == -1):?>
                                            <td id="num" width="5%"><?=$rating['city_place'];?></td>
                                        <?elseif ($country_id == 0):?>
                                            <td id="num" width="5%"><?=$rating['place'];?></td>
                                        <?else:?>
                                            <td id="num" width="5%"><?=$rating['country_place'];?></td>
                                        <?endif;?>

                                        <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/user/".$rating['user_id'].".jpg"; ?>
                                        <td id="name" style="text-align: right; <?echo $rating['user_id'] == $userId?' font-weight:600; background-color: #FFF383':'';?>" width="10%" >
                                            <?if(file_exists($fileName)):?>
                                                <img src="/upload/images/user/<?=$rating['user_id'];?>.jpg" alt="">
                                            <?else:?>
                                                <img src="/upload/images/user/default.png" alt="">
                                            <?endif;?>
                                        </td>
                                        <td id="city" width="40%" style="text-align:left; <?echo $rating['user_id'] == $userId?' font-weight:600;line-height:40px; background-color: #FFF383':'';?>">
                                            <?=$rating['fio'];?>                                            
                                        </td>
                                        <td id="city" width="10%" style="text-align:left; <?echo $rating['user_id'] == $userId?' font-weight:600; line-height:40px;background-color: #FFF383':'';?>">
                                            <p class="flagRating">
                                                <img src="/template/images/coutnry/<?=$user['country_id']?>.png" alt=""> 
                                            </p>                                            
                                        </td>
                                        <td id="score" width="20%"style="<?echo $rating['user_id'] == $userId?'font-weight:600; background-color: #FFF383':'';?>" >
                                            <div class="scoreRating">
                                                <img src="/template/images/home/star.png" alt="">
                                                <span><?=$rating['score'];?></span>                                                
                                            </div>                                          
                                            
                                        </td>

                                    </tr>
                                <?endforeach;?>
                            </table>

                            <div id="paginationOfRating">
                                <ul>
                                    <li>
                                         <a href="#"><img src="/template/images/home/left.png" alt=""></a>
                                    </li>
                                    <li>
                                        <p> Көшбасшылар </p>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/template/images/home/right.png" alt=""></a>
                                    </li>
                                </ul>
                    </div>

                        </div>
                        
                    </div>
                <div class="row">
                    <div class="col-sm-12" id="paginationRating " style="display: none;">
                        <?php echo $pagination->get(); ?>
                    </div>
                </div>
                    
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_cabinet.php'; ?>