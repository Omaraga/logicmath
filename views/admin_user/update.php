<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/category">Управление пользователями</a></li>
                    <li class="active">Редактировать пользователя</li>
                </ol>
            </div>


            <h4>Редактировать пользователя "<?php echo $user['id']; ?>"</h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>Роль</p>
                        <select name="role_id">
                            <?php if (is_array($roleList)): ?>
                                <?php foreach ($roleList as $role): ?>
                                    <option value="<?php echo $role['id']; ?>" <?php if ($user['role_id'] == $role['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $role['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <p>Пароль</p>
                        <input type="text" name="password" placeholder="" value="<?php echo $user['password']; ?>">


                        <br><br>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

