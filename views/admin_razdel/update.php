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


            <h4>Редактировать раздел #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название раздела на русском</p>
                        <input type="text" name="name_ru" placeholder="" value="<?php echo $razdel['name_ru']; ?>">

                        <p>Название раздела на казахском</p>
                        <input type="text" name="name_kz" placeholder="" value="<?php echo $razdel['name_kz']; ?>">
                        <p>Порядоковый номер раздела</p>
                        <input type="text" name="order_num" placeholder="" value="<?php echo $razdel['order_num']; ?>">
                        <p>Категория</p>
                        <select name="level_id">
                            <?php if (is_array($levelList)): ?>
                                <?php foreach ($levelList as $level): ?>
                                    <option value="<?php echo $level['id']; ?>" <?php if ($razdel['level_id'] == $level['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $level['name_ru'].'-'.$level['cource']['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <br>
                        <div class="radio">
                            <label><input type="radio" name="child1"  <?php if (intval($razdel['is_parent']) == 1) echo 'checked';?> class="isChild" value="0">Раздел</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="child1" <?php if (intval($razdel['is_parent']) == 0) echo 'checked';?> class="isChild" value="1">Подраздел</label>
                        </div>
                        <div id="parentRazdelBlock">
                            <p>Выберите раздел выше стоящий
                                <select name="parentRazdel" id="parentRazdelSel" attr-curr-razdel = "<?=$razdel['id'];?>">
                                <?php foreach ($razdels as $currRazdel):?>
                                    <option value="<?=$currRazdel['id'];?>" <?php if (intval($currRazdel['id']) == intval($razdel['parent'])) echo 'selected';?>><?=$currRazdel['name_kz'];?></option>
                                <?endforeach;?>
                                </select>
                            </p>

                            <p>Сложность
                                <select name="razdel_dif" >
                                    <option value="1" <? if(intval($razdel['difficult'])== 1) echo 'selected';?>>Бастапқы</option>
                                    <option value="2" <? if(intval($razdel['difficult'])== 2) echo 'selected';?>>Орта</option>
                                    <option value="3" <? if(intval($razdel['difficult'])== 3) echo 'selected';?>>Жоғары</option>
                                </select>
                            </p>
                            <br>

                        </div>

                        <p>Изображение раздела</p>
                        <input type="file" name="image" placeholder="" value="">
                        <div class="taskUpdateImg">
                            <img src="/upload/images/razdel/<?= $razdel['id'];?>.jpg" alt="">
                        </div>
                        <br>
                        <div class="row" id="adminKlass">
                            <?foreach ($klassList as $klass):?>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">

                                    <input type="checkbox" name="klass[]" value="<?=$klass['id'];?>" id="klass-<?=$klass['id'];?>" <?echo in_array($klass['id'], $razdelKlass)?'checked= "checked"':''?>>
                                    <br>
                                </div>
                                <div class="col-sm-10 col-lg-10" style="height: 50px">
                                    <label for="klass-<?=$klass['id'];?>"><?=$klass['name_kz'];?></label>
                                </div>

                            <?endforeach;?>


                        </div>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

