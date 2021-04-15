<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/cert">Управление сертификатами</a></li>
                    <li class="active">Редактировать сертификат</li>
                </ol>
            </div>


            <h4>Редактировать категорию "<?php echo $cert['id']; ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Наименование на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="<?php echo $cert['name_kz']; ?>">

                        <p>Наименование на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="<?php echo $cert['name_ru']; ?>">
                        <p>Колисчество решенных задач для получение сертификата</p>
                        <input type="text" name="count_task" placeholder="" value="<?php echo $cert['count_task']; ?>">


                        <br><br>
                        <p>Изображение категории</p>
                        <input type="file" name="image" placeholder="" value="">
                        <div class="taskUpdateImg">
                            <img src="/upload/images/certs/<?=$cert['id'];?>.jpg" alt="">
                        </div>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

