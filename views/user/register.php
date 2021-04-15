<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container-fluid" id = "proffile">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <?php if ($result): ?>
                            <h2>Сіз тіркелдіңіз!</h2>
                        <?php else: ?>
                            <?php if (isset($errors) && is_array($errors)): ?>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        <div class="col-sm-12">
                            <div class="row">
                                <form action="#" method="post" enctype="multipart/form-data">
                                    <div class="settings col-sm-12">
                                        <h3 style="color: #2e3033; text-align: center"><img src="/template/images/home/reg.png" alt="" style="width: 25px;">Тіркелу</h3>
                                    </div>
                                    <div class="contReg col-sm-10 col-sm-offset-1">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-group">
                                                    <img src="/template/images/home/message.png" alt=""><label for="email">E-mail</label>
                                                    <input type="text" name="email" class="form-control" id="email" value="<?=$email;?>">
                                                </div>
                                                <div class="form-group">
                                                    <img src="/template/images/home/phone-reg.png" alt="" style="width: 10px;"><label for="phone">Ұялы телефон</label>
                                                    <input type="text" name="telephone" class="form-control" id="phone" value="<?=$telephone;?>">
                                                </div>

                                                <img src="/template/images/home/pass.png" alt=""><label for="password">Құпия сөз</label>
                                                <div class="input-group">
                                                    <input id="password" type="password" class="form-control" name="password"/>
                                                    <div class="input-group-addon" id="s-h-pass"><span class="glyphicon glyphicon-eye-open" title="Показать пароль"></span></div>
                                                </div>
                                                <div class="form-group">
                                                    <img src="/template/images/home/flag.png" alt=""><label for="sel1">Мемлекет</label>
                                                        <select class="form-control" name="country_id" id="sel1">
                                                            <?php if (is_array($countryList)): ?>
                                                                <?php foreach ($countryList as $country): ?>
                                                                    <option value="<?php echo $country['id']; ?>">
                                                                        <?php echo $country['name_kz']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="studentsText col-sm-12" >
                                        <h3 style="color: #2e3033;text-align: center"><img src="/template/images/home/reg-acc.png" alt="" style="width: 25px;">Жеке мәліметтер:</h3>
                                    </div>
                                    <div class="contReg col-sm-10 col-sm-offset-1">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-group">
                                                    <label for="fam">Тегі</label>
                                                    <input type="text" name="surname" class="form-control" id="fam" value="<?=$surname;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Аты</label>
                                                    <input type="text" name="name" class="form-control" id="name" value="<?=$name;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="middleName">Әкесінің аты</label>
                                                    <input type="text" name="middlename" class="form-control" id="middleName" value="<?=$middlename;?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sel1">Сынып</label>
                                                    <select class="form-control" name="klass_id" id="sel1">
                                                        <?php if (is_array($klassList)): ?>
                                                            <?php foreach ($klassList as $klass): ?>
                                                                <option value="<?php echo $klass['id']; ?>">
                                                                    <?php echo $klass['name_kz']; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="regAndauth row">
                                        <input type="submit" name="submit" class="btn btn-default" value="Тіркелу">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php include ROOT . '/views/layouts/footer.php'; ?>