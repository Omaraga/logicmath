<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/cert">Управление сертификатами</a></li>
                    <li class="active">Добавить сертификат</li>
                </ol>
            </div>


            <h4>Добавить сертификат</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Наименование на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="">

                        <p>Наименование на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="">
                        <p>Колисчество решенных задач для получение сертификата</p>
                        <input type="text" name="count_task" placeholder="" value="">
                        <br><br>
                        <p>Изображение категории</p>
                        <input type="file" name="image" placeholder="" value="">
                        <br><br>

                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>


        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

