<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление разделами</li>
                </ol>
            </div>
            <a href="/admin/razdel/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить раздел</a>

            <h4>Список разделов</h4>

            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#olimp">Олимпиада және логика</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#matem">Математика</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="olimp">
                    <?=getTreeRazdel($cource1);?>
                </div>
                <div class="tab-pane" id="matem">
                    <?=getTreeRazdel($cource2);?>
                </div>

            </div>


            <br/>


            


        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

