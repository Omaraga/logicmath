<?php include ROOT . '/views/layouts/header_cabinet.php'; ?>

    <section>
        <div class="container" id = "proffile">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div class="settings">
                            <h3 style="text-transform: upper-case;">Жеке кабинет</h3>
                        </div>
                        <div class="col-sm-12">
                        <div class="osnInfo col-xs-12 col-sm-6">
                            <div class="form-group col-sm-12">
                                <label for="usr"> <img src="/template/images/home/name.png" alt="" width="20"> Ата-ана аты-жөні</label>
                                <input type="text" name="fioRod" class="form-control" id="usr" value="<?=$user['fioRod'];?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="usr"><img src="/template/images/home/mail.png" alt="" width="20"> EMAIL</label>
                                <input type="text" name="email" class="form-control" id="email" value="<?=$user['email'];?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="usr"><img src="/template/images/home/phone-input.png" alt="" width="20"> Ұялы телефон</label>
                                <input type="text" name="phone" class="form-control" id="phone" value="<?=$user['telephone'];?>">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="usr"><img src="/template/images/home/state.png" alt="" width="20"> Мемлекет</label>
                                <input type="text" name="state" class="form-control" id="state" value="<?=$userAndCity['city'];?>">
                            </div>
                            <!-- <div class="region col-sm-8">
                                <h3>Сіздің мемлекетіңіз: <?=$userAndCity['city'];?></h3>
                                <p>Мемлекетті өзгертіңіз келеді ме? office@logicmath.kz почтасына хат жазыңыз.</p>
                            </div> -->
<!--                            <div class="changepass col-sm-4">-->
<!--                                <a href=""><i class="fa fa-lock"></i>  Изменить пароль</a>-->
<!--                            </div>-->
                        </div>
                        
                        <div class="students col-xs-12 col-sm-6">
                            <div class="student">
                                <div class="row">
                                    <div class="userName">
                                        <p><span style="color: #FFF383 ">№<?=$userId;?></span> <?=$userAndCity['fio'];?></p>
                                    </div>
                                    <span style="color: #FFF ">Оқушының суреті</span>
                                </div>
                                <div class="userPhotos" style="background-color: #fff">
                                <div class="row">
                                     <ul>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile1.png" onclick="alert('1')" alt="" width="30"></li>
                                        <li class="col-xs-2  col-sm-3"><img src="template/images/home/smile2.png" onclick="alert('2')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile3.png" onclick="alert('3')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile4.png" onclick="alert('4')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile5.png" onclick="alert('5')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile6.png" onclick="alert('6')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile7.png" onclick="alert('7')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile8.png" onclick="alert('8')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile9.png" onclick="alert('9')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile10.png" onclick="alert('10')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile11.png" onclick="alert('11')" alt="" width="30"></li>
                                        <li class="col-xs-2 col-sm-3"><img src="template/images/home/smile12.png" onclick="alert('12')" alt="" width="30"></li>
                                    </ul> 
                                </div>
                                <div class="center">
                                <div class="image-upload">
                                        <label for="file-input">
                                        <img src="template/images/home/camera.png" alt="" width="60">
<!--                                            <img src="https://goo.gl/pB9rpQ"/>-->
                                        </label>

                                        <input id="file-input" name="image" type="file"/>
                                    </div>
                                   
                                </div>   
                                </div>
                            </div>
                        </div>
                        <br>
                        </div>
                        <div class="studentsText col-sm-12">
                            <h3>Жеке мәліметтер:</h3>
                        </div>
                        <div class="col-sm-12">
                        
                        <div class="students-info row" >
                                <div class="studentInfo col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="usr">Тегі:</label>
                                            <input type="text" name="surname" class="form-control" id="fam" value="<?=$user['surname'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Аты:</label>
                                            <input type="text" name="name" class="form-control" id="name" value="<?=$user['name'];?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Әкесінің аты:</label>
                                            <input type="text" name="middleName" class="form-control" id="middleName" value="<?=$user['middlename'];?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                    <label for="sel1">Қала</label>
                                    <select class="form-control" name="city_id" id="sel1">
                                        <?php if (is_array($cityList)): ?>
                                            <?php foreach ($cityList as $city): ?>
                                                <option value="<?php echo $city['id']; ?>" <?php if ($user['city_id'] == $city['id']) echo ' selected="selected"'; ?>>
                                                    <?php echo $city['name_ru']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="0">
                                                Тізімде жоқ
                                            </option>
                                        <?php endif; ?>
                                    </select>
                                    <br>
                                    <input type="text" name="otherCity" id="otherCity" class="form-control" style="display: none;" placeholder="Қаланы енгізіңіз">
                                </div>
                                <div class="form-group">
                                    <label for="sel1">Оқу орны:</label>
                                    <select class="form-control" name="placeOfStudy" id="sel1">
                                        <option value="Мектеп" <?php if ($user['placeOfStudy'] == 'Школа') echo ' selected="selected"'; ?>>Мектеп</option>
                                        <option value="Гимназия" <?php if ($user['placeOfStudy'] == 'Гимназия') echo ' selected="selected"'; ?>>Гимназия</option>
                                        <option value="Лицей" <?php if ($user['placeOfStudy'] == 'Лицей') echo ' selected="selected"'; ?>>Лицей</option>
                                        <option value="Ұйым" <?php if ($user['placeOfStudy'] == 'Компания') echo ' selected="selected"'; ?>>Ұйым</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-8 col-xs-7">
                                    <label for="sel3">№/Атауы</label>
                                    <select class="form-control" name="school_id" id="sel3">
                                        <?php if (is_array($schoolList)): ?>
                                            <?php foreach ($schoolList as $school): ?>
                                                <option value="<?php echo $school['id']; ?>" <?php if ($user['school_id'] == $school['id']) echo ' selected="selected"'; ?>>
                                                    <?php echo $school['name_ru']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="0">
                                                Тізімде жоқ
                                            </option>
                                        <?php endif; ?>
                                    </select>
                                    <br>
                                    <input type="text" name="otherSchool" id="otherSchool" class="form-control" style="display: none;" placeholder="Мектепті енгізіңіз">
                                </div>
                                <div class="form-group col-sm-4 col-xs-5">
                                    <label for="sel1">Сынып:</label>
                                    <select class="form-control" name="klass" id="sel2">
                                        <?php foreach ($klassList as $klass):?>
                                            <option value="<?=$klass['id'];?>" <?php if ($user['klass_id'] == $klass['id']) echo ' selected="selected"'; ?>><?=$klass['name_kz'];?></option>
                                        <?endforeach;?>
                                    </select>
                                </div>
                                    </div>
                               
                                

                            </div>
                        </div>
    <!--                    <div class="addStudent">-->
    <!--                        <a href="" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить ученика</a>-->
    <!--                    </div>-->
                        <div class="saveChange row">
                            <input type="submit" name="submit" class="btn btn-default" value="Өзгерістерді сақтау">
                        </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_cabinet.php'; ?>