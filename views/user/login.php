<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container-fluid" id = "proffile">
            <div class="row">
                <div class="container">
                    <div class="row">

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
                                            <h3 style="color: #2e3033; text-align: center; font-family: Calibri"><i class="fa fa-sign-in" aria-hidden="true"></i> Жүйеге кіру</h3>
                                        </div>
                                        <div class="contAuth col-sm-10 col-sm-offset-1">
                                            <div class="row">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-group">
                                                        <img src="/template/images/home/message.png" alt=""><label for="email">E-mail</label>
                                                        <input type="text" name="email" class="form-control" id="email" value="<?=$email;?>">
                                                    </div>


                                                    <div class="form-group">
                                                        <img src="/template/images/home/pass.png" alt=""><label for="password">Құпия сөз</label>
                                                        <div class="input-group">
                                                            <input id="password" type="password" class="form-control" name="password"/>
                                                            <div class="input-group-addon" id="s-h-pass"><span class="glyphicon glyphicon-eye-open" title="Показать пароль"></span></div>
                                                        </div>
                                                        <a href="/user/recovery" style="color: #0078bd; font-size: 15px; font-family: Calibri" >Құпия сөзді еске түсіру</a><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="regAndauth row">
                                            <input type="submit" name="submit" class="btn btn-default" value="Кіру">
                                        </div>

                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



<?php include ROOT . '/views/layouts/footer.php'; ?>