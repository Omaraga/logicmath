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


            <h4>Редактировать уровень #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-8">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Введите вопрос на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="<?=$currLevel['name_kz'];?>">
                        <p>Введите вопрос на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="<?=$currLevel['name_ru'];?>">
                        <p>Курс</p>
                        <select name="cource_id">
                            <?php if (is_array($courceList)): ?>
                                <?php foreach ($courceList as $cource): ?>
                                    <?php $levels = explode('~',$cource['level_id']);?>
                                    <option value="<?php echo $cource['id']; ?>" <?php if (in_array($currLevel['id'], $levels)) echo ' selected="selected"'; ?>>
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

