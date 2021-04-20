<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/task">Управление задачами</a></li>
                    <li class="active">Редактировать задачу</li>
                </ol>
            </div>


            <h4>Редактировать задачу #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-8">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data" class="form-group">
                        <p>Введите вопрос на казахском</p>
                        <textarea  name="title_kz" id="title_kz"><?=$task['title_kz'];?></textarea>
                        <p>Введите вопрос на русском</p>
                        <textarea  name="title_ru" id="title_ru"><?=$task['title_ru'];?></textarea>

                        <p>Введите баллы</p>
                        <input type="text" name="score" placeholder="" value="<?=$task['score'];?>" class="form-control">
                        <p>Тип задачи</p>
                        <select name="task_type" id="select_type_task" readonly class="form-control">
                            <option value="1" <?php if (intval($task['task_type']) == 1) echo ' selected="selected"'; ?>>Тест с ответами</option>
                            <option value="2" <?php if (intval($task['task_type']) == 2) echo ' selected="selected"'; ?>>Тест с картинками</option>
                            <option value="3" <?php if (intval($task['task_type']) == 3) echo ' selected="selected"'; ?>>Перетаскивание</option>
                            <option value="4" <?php if (intval($task['task_type']) == 4) echo ' selected="selected"'; ?>>Судоку с числами</option>
                            <option value="5" <?php if (intval($task['task_type']) == 5) echo ' selected="selected"'; ?>>Судоку с картинками</option>
                            <option value="6" <?php if (intval($task['task_type']) == 6) echo ' selected="selected"'; ?>>Арифметика со знаками</option>
                            <option value="7" <?php if (intval($task['task_type']) == 7) echo ' selected="selected"'; ?>>Арифметика с числами</option>
                            <option value="8" <?php if (intval($task['task_type']) == 8) echo ' selected="selected"'; ?>>Математический ребус с буквами</option>
                            <option value="9" <?php if (intval($task['task_type']) == 9) echo ' selected="selected"'; ?>>Математический ребус с числами</option>
                            <option value="10" <?php if (intval($task['task_type']) == 10) echo ' selected="selected"'; ?>>Математический ребус с фигурами</option>
                        </select>

                        <p>Категория</p>
                        <select name="category_id" class="form-control">
                            <?php if (is_array($categoriesList)): ?>
                                <?php foreach ($categoriesList as $category): ?>
                                    <option value="<?php echo $category['id']; ?>" <?php if ($task['category_id'] == $category['id']) echo ' selected="selected"'; ?>>
                                        <?php echo $category['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <p>Курс</p>
                        <select name="cource" id = "courceId" class="form-control">
                            <?php if (is_array($courceList)): ?>
                                <?php foreach ($courceList as $cource): ?>
                                    <option value="<?php echo $cource['id']; ?>">
                                        <?php echo $cource['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <p>Глава</p>
                        <select name="glava_id" id = "glavaId" class="form-control">
                            <?php if (is_array($glavaList)): ?>
                                <?php foreach ($glavaList as $glava): ?>
                                    <option value="<?php echo $glava['id']; ?>" <?php if ($glava['id'] == $currLevel) echo 'selected';?>>
                                        <?php echo $glava['name_ru']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/><br/>
                        <p>Раздел</p>
                        <select name="subrazdel_id" id = 'razdel_id' class="form-control">
                            <?php if (is_array($razdelList)): ?>
                                <?php foreach ($razdelList as $razdel): ?>
                                    <option value="<?php echo $razdel['id']; ?>" <?php if ($razdel['id'] == $currParentRazdelId) echo 'selected';?>>
                                        <?php echo $razdel['name_ru'].'-'.$razdel['order_num']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <p>Подраздел</p>
                        <select name="razdel_id" id="podrazdel" class="form-control">
                            <?php if (is_array($razdelList)): ?>
                                <?php foreach ($razdelList as $razdel): ?>
                                    <option value="<?php echo $razdel['id']; ?>" <?php if ($razdel['id']== $task['razdel_id']) echo 'selected';?>>
                                        <?php echo $razdel['name_ru'].'-'.$razdel['order_num']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>

                        <br/>



                        <div class="type_task" type-task-val="1">
                            <p>Изображение вопроса</p>
                            <input type="file" name="question" placeholder="" value="">
                            <div class="taskUpdateImg">
                                <img src="/upload/images/task/<?= $task['id'];?>.jpg" alt="">
                            </div>
                            <? $counterAns = 1;?>
                            <?foreach ($task['answers'] as $answer): ?>
                                <?if($counterAns == 1):?>
                                    <p>Введите правильный ответ</p>
                                <?elseif ($counterAns == 2):?>
                                    <p>Введите другие ответы</p>
                                <?endif;?>
                                <input type="text" name="answer<?=$counterAns;?>" placeholder="" value="<?=$answer;?>">
                                <? $counterAns++;?>
                            <?endforeach;?>
                            <br/><br/>
                        </div>
                        <div class="type_task" type-task-val="2" style="display: none">
                            <p>Изображение вопроса</p>
                            <input type="file" name="questionImg" placeholder="" value="">
                            <div class="taskUpdateImg">
                                <img src="/upload/images/task/<?= $task['id'];?>.jpg" alt="">
                            </div>
                            <? $counterAns = 1;?>
                            <?foreach ($task['answers'] as $answer): ?>
                                <?if($counterAns == 1):?>
                                    <p>Загрузите правильный ответ</p>
                                <?elseif ($counterAns == 2):?>
                                    <p>Загрузите другие ответы</p>
                                <?endif;?>
                                <div class="answerUpdateImg">
                                    <img src="/upload/images/task/<?= $task['id'].'-'.$counterAns;?>.jpg" alt="">
                                </div>
                                <input type="file" name="answer<?=$counterAns;?>Img">

                                <? $counterAns++;?>
                            <?endforeach;?>
                        </div>
                        <div class="type_task" type-task-val="3" style="display: none">
                            <p>Изображение вопроса</p>
                            <div class="taskUpdateImg">
                                <img src="/upload/images/task/<?= $task['id'];?>.jpg" alt="">
                            </div>
                            <input type="file" name="question" placeholder="" value="" class="form-control">
                            <p>Введите правильный ответ</p>
                            <input type="text" name="rightAnswer" placeholder="" value="<?=$task['answers'][0];?>" class="form-control">
                        </div>
                        <div class="type_task" type-task-val="4" style="display: none">
                            <input type="text" name = "string-size" placeholder="Количество строк и столбцов" id="string-size" value="<?=$colSize;?>" readonly>
                            <?=getTable($task);?>
                        </div>
                        <div class="type_task" type-task-val="5" style="display: none">

                            <input type="text" name = "string-size-image" placeholder="Количество строк и столбцов" id="string-size" value="<?=$colSize;?>" readonly>
                            <? for ($i = 1; $i <= $colSize; $i++):?>
                                <div class="col-sm-<?=12/$colSize;?>">
                                        <p>Картинка под номером №<?=$i;?></p>
                                        <img src="/upload/images/task/<?=$task['id'].'-'.$i;?>.jpg" alt="" style="width: 100%;">
                                        <input type='file' name='tableImage<?=$i-1;?>'>
                                </div>
                            <?endfor;?>
                            <?=getTableImg($task);?>
                        </div>
                        <div class="type_task" type-task-val="6">
                            <label for="arif-soznak-input">Введите задачу</label>
                            <input type="text" name = "arifTaskWithZnak" placeholder="пример 1+2=3" id="arif-soznak-input" value="<?=$task['question'];?>">
                            <p>Выберите знаки:</p>
                            <div class="row" id="adminKlass">
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="0" id="klass-plus" <?echo in_array("0", $ansArray)?'checked= "checked"':''?>>
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-plus">плюс</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="1" id="klass-minus" <?echo in_array("1", $ansArray)?'checked= "checked"':''?>>
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-minus">минус</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="2" id="klass-del" <?echo in_array("2", $ansArray)?'checked= "checked"':''?>>
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-del">деление</label>
                                </div>
                                <br>
                                <div class="col-sm-2 col-lg-2" style="height: 50px">
                                    <input type="checkbox" name="znak[]" value="3" id="klass-umn" <?echo in_array("3", $ansArray)?'checked= "checked"':''?>>
                                </div>
                                <div class="col-sm-4 col-lg-4" style="height: 50px">
                                    <label for="klass-umn">умножение</label>
                                </div>
                            </div>

                        </div>
                        <div class="type_task" type-task-val="7">
                            <label for="arif-soznak-input">Введите задачу</label>
                            <input type="text" name = "arifTaskWithChislo" placeholder="пример 1+2=3" id="arif-soznak-input" value="<?=$task['question'];?>">
                            <p>Выберите числа:</p>
                            <div class="row" id="adminKlass">
                                <div class="col-sm-6">
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="0" id="num0" <?echo in_array("0", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num0">0 - ноль</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="1" id="num1" <?echo in_array("1", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num1">1 - один</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="2" id="num2" <?echo in_array("2", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num2">2 - два</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="3" id="num3" <?echo in_array("3", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num3">3 - три</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="4" id="num4" <?echo in_array("4", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num4">4 - четыре</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="5" id="num5" <?echo in_array("5", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num5">5 - пять</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="6" id="num6" <?echo in_array("6", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num6">6 - шесть</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="7" id="num7" <?echo in_array("7", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num7">7 - семь</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="8" id="num8" <?echo in_array("8", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num8">8 - восемь</label>
                                    </div>
                                    <br>
                                    <div class="col-sm-2 col-lg-2" style="height: 50px">
                                        <input type="checkbox" name="chislo[]" value="9" id="num9" <?echo in_array("9", $ansArray)?'checked= "checked"':''?>>
                                    </div>
                                    <div class="col-sm-4 col-lg-4" style="height: 50px">
                                        <label for="num9">9 - девять</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="type_task" type-task-val="8">

                            <label for="rebus-right">Введите правильный ответ</label>
                            <input type="text" name = "rebus-right" placeholder="123+456-147=432" value="<?=$task['answers'][0];?>">
                            <div id="rebus-place">
                                <?=getRebus($task);?>
                            </div>
                        </div>
                        <div class="type_task" type-task-val="9">

                            <label for="rebus-right">Введите правильный ответ</label>
                            <input type="text" name = "rebus-right" placeholder="123+456-147=432" value="<?=$task['answers'][0];?>">
                            <div id="rebus-place">
                                <?=getRebus($task);?>
                            </div>
                        </div>
                        <div class="type_task" type-task-val="10">

                            <div id="rebus-place">
                                <?=getRebusFigure($task);?>
                            </div>
                        </div>
                        <br/><br/>
                        <label for="helpText">Текст раздела помощи</label><br>
                        <textarea name="helpText" id="helpText" cols="30" rows="10" class="form-control"><?=$task['helpText'];?></textarea><br><br>
                        <label for="helpText">Картина раздела помощь</label><br>
                        <img src="/upload/images/task/<?=$task['id'];?>-help.jpg" alt="" style="width: 50%;">
                        <input type="file" name="helpPhoto" id="helpPhoto" class="form-control"><br>
                        <label for="solveText">Текст раздела решения</label><br>
                        <textarea name="solveText" id="solveText" cols="30" rows="10" class="form-control"><?=$task['solveText'];?></textarea><br><br>
                        <label for="solveText">Картина раздела решения</label><br>
                        <img src="/upload/images/task/<?=$task['id'];?>-solve.jpg" alt="" style="width: 50%;">
                        <input type="file" name="solvePhoto" id="solvePhoto" class="form-control"><br>
                        <input type="submit" name="submit" class="btn btn-default form-control" value="Сохранить">

                        <br/><br/>

                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>


