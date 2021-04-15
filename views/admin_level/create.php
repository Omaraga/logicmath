<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/level">Управление уровнями</a></li>
                    <li class="active">Редактировать уровень</li>
                </ol>
            </div>


            <h4>Добавить новый уровень</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-8">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Введите вопрос на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="">
                        <p>Введите вопрос на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="">
                        <p>Курс</p>
                        <select name="cource_id">
                            <?php if (is_array($courceList)): ?>
                                <?php foreach ($courceList as $cource): ?>

                                    <option value="<?php echo $cource['id']; ?>">
                                        <?php echo $cource['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>


                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

