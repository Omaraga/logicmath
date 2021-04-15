<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/razdel">Управление разделами</a></li>
                    <li class="active">Редактировать раздел</li>
                </ol>
            </div>


            <h4>Добавить новый раздел</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4 col-sm-4" >
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Введите раздел на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="">
                        <p>Введите раздел на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="">
                        <p>Введите порядок</p>
                        <input type="text" name="order_num" placeholder="" value="">
                        <p>Уровень</p>
                        <select name="level_id" id="razdelLevel">
                            <?php if (is_array($levelList)): ?>
                                <?php foreach ($levelList as $level): ?>
                                    <option value="<?php echo $level['id']; ?>">
                                        <?php echo $level['name_ru'].'-'.$level['cource']['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br>
                        <div class="radio">
                            <label><input type="radio" name="child1"  checked class="isChild" value="0">Раздел</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="child1"  class="isChild" value="1">Подраздел</label>
                        </div>
                        <div id="parentRazdelBlock">
                            <p>Выберите раздел выше стоящий
                            <select name="parentRazdel" id="parentRazdelSel">

                            </select>
                            </p>

                            <p>Сложность
                            <select name="razdel_dif" >
                                <option value="1">Бастапқы</option>
                                <option value="2">Орта</option>
                                <option value="3">Жоғары</option>
                            </select>
                            </p>
                            <br>

                        </div>

                        <p>Изображение раздела</p>
                        <input type="file" name="image" placeholder="" value="">
                        <br><br>
                        <div class="row" id="adminKlass">
                            <?foreach ($klassList as $klass):?>
                            <div class="col-sm-2 col-lg-2" style="height: 50px">

                                <input type="checkbox" name="klass[]" value="<?=$klass['id'];?>" id="klass-<?=$klass['id'];?>">
                                <br>
                            </div>
                            <div class="col-sm-10 col-lg-10" style="height: 50px">
                                <label for="klass-<?=$klass['id'];?>"><?=$klass['name_kz'];?></label>
                            </div>

                            <?endforeach;?>


                        </div>


                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

