<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/task">Управление задачами</a></li>
                    <li class="active">Добавить задачу</li>
                </ol>
            </div>


            <h4>Добавить задачу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-8">
                <div class="login-form" id="createTask">
                    <form action="#" method="post" enctype="multipart/form-data" class="form-group">

                        <p>Введите вопрос на казахском</p>
                        <textarea  name="title_kz" id="title_kz"></textarea>
                        <p>Введите вопрос на русском</p>
                        <textarea  name="title_ru" id="title_ru"></textarea>

                        <p>Введите баллы
                        <input type="text" name="score" placeholder="" value="" class="form-control">
                        </p>
                        <p>Тип задачи
                        <select name="task_type" id="select_type_task" class="form-control">
                            <option value="1" selected="selected">Тест с ответами</option>
                            <option value="2">Тест с картинками</option>
                            <option value="3">Перетаскивание</option>
                            <option value="4">Судоку с числами</option>
                            <option value="5">Судоку с картинками</option>
                            <option value="6">Арифметика со знаками</option>
                            <option value="7">Арифметика с цифрами</option>
                            <option value="8">Математический ребус с буквами</option>
                            <option value="9">Математический ребус с цифрами</option>
                            <option value="10">Математический ребус с фигурами</option>
                        </select>
                        </p>
                        <p>Категория:
                        <select name="category_id" class="form-control">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select></p>
                        <p>Курс:
                        <select name="cource" id = "courceId" class="form-control">
                            <?php if (is_array($courceList)): ?>
                                <?php foreach ($courceList as $cource): ?>
                                    <option value="<?php echo $cource['id']; ?>">
                                        <?php echo $cource['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        </p>
                        <p>Глава:
                        <select name="glava_id" id = "glavaId" class="form-control">
                            <?php if (is_array($glavaList)): ?>
                                <?php foreach ($glavaList as $glava): ?>
                                    <option value="<?php echo $glava['id']; ?>">
                                        <?php echo $glava['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        </p>

                        <p>Раздел:
                        <select name="subrazdel_id" id = 'razdel_id' class="form-control">
                            <?php if (is_array($razdelList)): ?>
                                <?php foreach ($razdelList as $razdel): ?>
                                    <option value="<?php echo $razdel['id']; ?>">
                                        <?php echo $razdel['name_ru'].'-'.$razdel['order_num']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        </p>

                        <p>Подраздел:
                        <select name="razdel_id" id="podrazdel" class="form-control">
                            <?php if (is_array($razdelList)): ?>
                                <?php foreach ($razdelList as $razdel): ?>
                                    <option value="<?php echo $razdel['id']; ?>">
                                        <?php echo $razdel['name_ru'].'-'.$razdel['order_num']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select></p>

                        <div class="type_task" type-task-val="1">
                            <p>Изображение вопроса</p>
                            <input type="file" name="question" placeholder="" value="" class="form-control">
                            <p>Введите правильный ответ</p>
                            <input type="text" name="answer1" placeholder="" value="" class="form-control">
                            <p>Введите другие ответы</p>
                            <input type="text" name="answer2" placeholder="" value="" class="form-control">
                            <input type="text" name="answer3" placeholder="" value="" class="form-control">
                            <input type="text" name="answer4" placeholder="" value="" class="form-control">
                            <input type="text" name="answer5" placeholder="" value="" class="form-control">
                        </div>
                        <div class="type_task" type-task-val="2">
                            <p>Изображение вопроса</p>
                            <input type="file" name="questionImg" placeholder="" value="">
                            <p>Загрузите правильный ответ</p>
                            <input type="file" name="answer1Img" placeholder="" value="">
                            <p>Загрузите другие ответы</p>
                            <input type="file" name="answer2Img" placeholder="" value="">
                            <input type="file" name="answer3Img" placeholder="" value="">
                            <input type="file" name="answer4Img" placeholder="" value="">
                            <input type="file" name="answer5Img" placeholder="" value="">
                        </div>
                        <div class="type_task" type-task-val="3">

                        </div>
                        <div class="type_task" type-task-val="4">
                            <input type="text" name = "string-size" placeholder="Количество строк и столбцов" id="string-size">
                            <button class="btn btn-default" id="sudoku-num-create">Создать таблицу</button>
                            <div id="table-place">

                            </div>
                        </div>
                        <div class="type_task" type-task-val="5">
                            <input type="text" name = "string-size-image" placeholder="Количество строк и столбцов" id="string-size-image">
                            <button class="btn btn-default" id="sudoku-num-create-image">Создать таблицу</button>
                            <div id="table-place-image">

                            </div>
                        </div>
                        <div class="type_task" type-task-val="6">
                            <label for="arif-soznak-input">Введите задачу</label>
                            <input type="text" name = "arifTaskWithZnak" placeholder="пример 1+2=3" id="arif-soznak-input">
                            <p>Выберите знаки:</p>
                            <div class="row" id="adminKlass">
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="0" id="klass-plus">
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-plus">плюс</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="1" id="klass-minus">
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-minus">минус</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="2" id="klass-del">
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-del">деление</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="3" id="klass-umn">
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-umn">умножение</label>
                                </div>
                            </div>

                        </div>
                        <div class="type_task" type-task-val="7">
                            <label for="arif-schislami-input">Введите задачу</label>
                            <input type="text" name = "arifTaskWithChislo" placeholder="пример 1+2=3" id="arif-schislami-input">
                            <p>Выберите числа:</p>
                            <div class="row" id="adminKlass">
                                <div class="col-sm-6">
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="0" id="num0" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num0">0 - ноль</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="1" id="num1" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num1">1 - один</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="2" id="num2" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num2">2 - два</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="3" id="num3" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num3">3 - три</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="4" id="num4" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num4">4 - четыре</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="5" id="num5" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num5">5 - пять</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="6" id="num6" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num6">6 - шесть</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="7" id="num7" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num7">7 - семь</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="8" id="num8" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num8">8 - восемь</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="9" id="num9" checked>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num9">9 - девять</label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="type_task" type-task-val="8">

                            <label for="rebus-input-kolvo">Введите количество строк</label>
                            <input type="text" name = "rebus-input-kolvo" placeholder="пример 3" id="rebus-input-kolvo">
                            <button class="btn btn-default" id="rebus-num-create">Создать</button>
                            <label for="rebus-right">Введите правильный ответ</label>
                            <input type="text" name = "rebus-right" placeholder="123+456-147=432">
                            <div id="rebus-place">
                            </div>
                        </div>
                        <div class="type_task" type-task-val="9">

                            <label for="rebus-input-kolvo-сhislo">Введите количество строк</label>
                            <input type="text" name = "rebus-input-kolvo-сhislo" placeholder="пример 3" id="rebus-input-kolvo-сhislo">
                            <button class="btn btn-default" id="rebus-num-create-chislo">Создать</button>
                            <label for="rebus-right-сhislo">Введите правильный ответ</label>
                            <input type="text" name = "rebus-right-сhislo" placeholder="123+456-147=432">
                            <div id="rebus-place-сhislo">
                            </div>
                        </div>
                        <div class="type_task" type-task-val="10">

                            <label for="rebus-input-kolvo-сhislo">Введите количество строк:</label>
                            <input type="text" name = "rebus-input-kolvo-figure" placeholder="пример 3" id="rebus-input-kolvo-figure">
                            <button class="btn btn-default" id="rebus-num-create-figure">Создать</button>

                            <div id="rebus-place-figure">

                            </div>
                        </div>


                        <br/><br/>
                        <label for="helpText">Текст раздела помощи</label><br>
                        <textarea name="helpText" id="helpText" cols="30" rows="10" class="form-control"></textarea><br><br>
                        <label for="helpText">Картина раздела помощь</label><br>
                        <input type="file" name="helpPhoto" id="helpPhoto" class="form-control"><br>


                        <label for="solveText">Текст раздела решение</label><br>
                        <textarea name="solveText" id="solveText" cols="30" rows="10" class="form-control"></textarea><br><br>
                        <label for="solveText">Картина раздела решение</label><br>
                        <input type="file" name="solvePhoto" id="solvePhoto" class="form-control"><br>
                        <input type="submit" name="submit" class="btn btn-default form-control" value="Сохранить">

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


