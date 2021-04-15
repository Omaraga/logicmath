<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление запросами</li>
                </ol>
            </div>


            
            <h4>Список категорий</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Задача</th>
                    <th>Текст</th>
                    <th>Время</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($requestList as $request): ?>
                    <tr>
                        <td><?php echo $request['id']; ?></td>
                        <?
                        $reqUser = User::getUserById($request['user_id']);
                        $email = $reqUser['email'];
                        ?>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $request['task_id']; ?></td>
                        <td><?php echo $request['message']; ?></td>
                        <td><?php echo $request['time']; ?></td>
                        <td><a href="/admin/task/update/<?php echo $request['task_id']; ?>" title="К задае"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/request/delete/<?php echo $request['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

