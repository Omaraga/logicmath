<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            
            <br/>
            <div class="admText">
                <h4>Добрый день, администратор!</h4>
            </div>
            <br/>
            <div class="admText">
                <p>Вам доступны такие возможности:</p>
            </div>
            <br/>
            <div class="menuAdmin col-sm-12">
                <div class="col-sm-3">
                    <a href="/admin/task">
                        <h4>Задачи</h4>
                        <span style="color: #4b3a91"><?=$taskListSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/category">
                        <h4>Категории</h4>
                        <span style="color: #2e9948"><?=$categoryListSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/razdel">
                        <h4>Разделы</h4>
                        <span style="color: #6d58c1"><?=$razdelListSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/level">
                        <h4>Уровни</h4>
                        <span style="color: #FF4518"><?=$levelListSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/cert">
                        <h4>Сертифкаты</h4>
                        <span style="color: #000"><?=$certSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/klass">
                        <h4>Классы</h4>
                        <span style="color: #000"><?=$klassSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/request">
                        <h4>Запросы</h4>
                        <span style="color: red"><?=$requestSize;?></span><br>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/admin/users">
                        <h4>Пользователи</h4>
                        <span style="color: #6d58c1"><?=$userSize;?></span><br>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

