<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление сертификатами</li>
                </ol>
            </div>

            <a href="/admin/cert/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить сертификат</a>
            
            <h4>Список сертификатов</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID</th>
                    <th>Наименование на казахском</th>
                    <th>Наименование на русском</th>
                    <th>Количество задач <br>для получение сертификата</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($certList as $cert): ?>
                    <tr>
                        <td><?php echo $cert['id']; ?></td>
                        <td><?php echo $cert['name_kz']; ?></td>
                        <td><?php echo $cert['name_ru']; ?></td>
                        <td><?php echo $cert['count_task']; ?></td>
                        <td><a href="/admin/cert/update/<?php echo $cert['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/cert/delete/<?php echo $cert['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

