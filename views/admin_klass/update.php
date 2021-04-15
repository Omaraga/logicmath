<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление классами</a></li>
                    <li class="active">Редактировать класс</li>
                </ol>
            </div>


            <h4>Редактировать класс "<?php echo $klass['id']; ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post">

                        <p>Наименование на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="<?php echo $klass['name_kz']; ?>">

                        <p>Наименование на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="<?php echo $klass['name_ru']; ?>">

                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

