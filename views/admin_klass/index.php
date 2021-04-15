<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление классами</li>
                </ol>
            </div>

            <a href="/admin/klass/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить класс</a>
            
            <h4>Список классов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID класса</th>
                    <th>Наименование на казахском</th>
                    <th>Наименование на русском</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($klassList as $klass): ?>
                    <tr>
                        <td><?php echo $klass['id']; ?></td>
                        <td><?php echo $klass['name_kz']; ?></td>
                        <td><?php echo $klass['name_ru']; ?></td>
                        <td><a href="/admin/klass/update/<?php echo $klass['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/klass/delete/<?php echo $klass['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

