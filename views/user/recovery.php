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
                                    <h3 style="color: #2e3033; text-align: center"><i class="fa fa-sign-in" aria-hidden="true"></i> Құпия сөзді еске түсіру</h3>
                                </div>
                                <div class="contRecovery col-sm-10 col-sm-offset-1">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-4">
                                            <div class="form-group">
                                                <img src="/template/images/home/message.png" alt=""><label for="email">E-mail</label>
                                                <input type="text" name="email" class="form-control" id="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="regAndauth row">
                                    <input type="submit" name="submit" class="btn btn-default" value="Жіберу">
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


