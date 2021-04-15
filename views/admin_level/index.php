<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление уровнями</li>
                </ol>
            </div>

            <a href="/admin/level/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить уровень</a>

            <h4>Список уровней</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID задачи</th>
                    <th>Наименование на казахском</th>
                    <th>Наименованеи на русском</th>
                    <th>Курс</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($levelList as $level): ?>
                    <tr>
                        <td><?php echo $level['id']; ?></td>
                        <td><?php echo $level['name_kz']; ?></td>
                        <td><?php echo $level['name_ru']; ?></td>
                        <td><?php echo Cource::getCourceByLevelId($level['id'], false); ?></td>
                        <td><a href="/admin/level/update/<?php echo $level['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/level/delete/<?php echo $level['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

