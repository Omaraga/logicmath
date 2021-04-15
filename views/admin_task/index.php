<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление задачами</li>
                </ol>
            </div>

            <a href="/admin/task/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить задачу</a>

            <h4>Список задач</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID задачи</th>
                    <th>Наименование на казахском</th>
                    <th>Раздел</th>
                    <th>Балл</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($taskList as $task): ?>
                    <tr>
                        <td><?php echo $task['id']; ?></td>
                        <td><?php echo $task['title_kz']; ?></td>
                        <?$currRazdel = Razdel::getRazdelById($task['razdel_id']);?>
                        <td><?php echo $currRazdel['name_kz'].'-'.$currRazdel['order_num']; ?></td>
                        <td><?php echo $task['score']; ?></td>
                        <td><a href="/admin/task/update/<?php echo $task['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/task/delete/<?php echo $task['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

