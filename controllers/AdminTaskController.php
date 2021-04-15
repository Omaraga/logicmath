<?php


class AdminTaskController extends AdminBase
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список товаров
        $taskList = Task::getTaskList();
        foreach ($taskList as $task){
            $category_id = $task['category_id'];
            Category::updateCategorySizeById($category_id);
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_task/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        $razdelList = Razdel::getRazdelList();
        $glavaList = Level::getLevelList();
        $courceList = Cource::getCourceList();


        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['title_kz'] = $_POST['title_kz'];
            $options['title_ru'] = $_POST['title_ru'];
            $options['score'] = $_POST['score'];
            $options['category_id'] = $_POST['category_id'];
            $options['razdel_id'] = $_POST['razdel_id'];
            $options['task_type'] = intval($_POST['task_type']);
            if (isset($_POST['helpText'])){
                $options['helpText'] = $_POST['helpText'];
            }else{
                $options['helpText'] = "";
            }
            if (isset($_POST['solveText'])){
                $options['solveText'] = $_POST['solveText'];
            }else{
                $options['solveText'] = "";
            }
//            $options['question'] = $_POST['question'];

            // Флаг ошибок в форме
            $errors = false;
            $answers = array();
            if ($options['task_type'] == 1){
                if (isset($_POST['answer1']) && !empty($_POST['answer1'])) {
                    $answers[] = $_POST['answer1'];
                } else{
                    $errors[] = 'Заполните поля Правильный ответ';
                }
                if (isset($_POST['answer2']) && !empty($_POST['answer2'])) {
                    $answers[1] = $_POST['answer2'];
                }
                if (isset($_POST['answer3']) && !empty($_POST['answer3'])) {
                    $answers[2] = $_POST['answer3'];
                }
                if (isset($_POST['answer4']) && !empty($_POST['answer4'])) {
                    $answers[3] = $_POST['answer4'];
                }
                if (isset($_POST['answer2']) && !empty($_POST['answer5'])) {
                    $answers[4] = $_POST['answer5'];
                }

                $answersStr = implode('~', $answers);
                $options['answers'] = $answersStr;
            }elseif ($options['task_type'] == 2){
                if (is_uploaded_file($_FILES["answer1Img"]["tmp_name"])) {
                    $answers[] = "1";
                }
                if (is_uploaded_file($_FILES["answer2Img"]["tmp_name"])) {
                    $answers[1] = "2";
                }
                if (is_uploaded_file($_FILES["answer3Img"]["tmp_name"])) {
                    $answers[2] = "3";
                }
                if (is_uploaded_file($_FILES["answer4Img"]["tmp_name"])) {
                    $answers[3] = "4";
                }
                if (is_uploaded_file($_FILES["answer5Img"]["tmp_name"])) {
                    $answers[4] = "5";
                }
                $answersStr = implode('~', $answers);
                $options['answers'] = $answersStr;
            }elseif($options['task_type'] == 4){
                if (isset($_POST['string-size']) && !empty($_POST['string-size'])) {
                    $colSize = intval($_POST['string-size']);
                    $table = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableRight'];
                            $table[] = $cell;
                        }
                    }
                    $wrTable = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableWrong'];
                            $wrTable[] = $cell;
                        }
                    }
                    $tableStr = implode('~', $table);
                    $options['answers'] = $tableStr;
                    $wrTableStr = implode('~', $wrTable);
                    $options['question'] = $wrTableStr;

                }else{
                    $errors[] = 'Заполните поля количество строк и столбцов';
                }

            }elseif ($options['task_type'] == 5){
                if (isset($_POST['string-size-image']) && !empty($_POST['string-size-image'])) {
                    $colSize = intval($_POST['string-size-image']);
                    for ($i = 0; $i < $colSize; $i++){
                        if (!is_uploaded_file($_FILES["tableImage".$i]["tmp_name"])) {
                            $errors[] = 'Загрузите картинки для судоку';
                        }
                    }
                    $table = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableRightImage'];
                            $table[] = $cell;
                        }
                    }
                    $wrTable = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableWrongImage'];
                            $wrTable[] = $cell;
                        }
                    }
                    $tableStr = implode('~', $table);
                    $options['answers'] = $tableStr;
                    $wrTableStr = implode('~', $wrTable);
                    $options['question'] = $wrTableStr;

                }else{
                    $errors[] = 'Заполните поля количество строк и столбцов';
                }
            }elseif($options['task_type'] == 6){
                $question = $_POST['arifTaskWithZnak'];
                $znak = $_POST['znak'];
                $znakList = array();
                if (!(isset($znak) && !empty($znak))){
                    $errors[] = 'Выберите знак';
                }else{
                    $znakSize = sizeof($znak);
                    for ($i = 0; $i < $znakSize; $i++){
                        $znakList[] = $znak[$i];
                    }
                }
                $options['question'] = $question;
                $options['answers'] = implode('~', $znakList);
            } elseif($options['task_type'] == 7){
                $question = $_POST['arifTaskWithChislo'];
                $chislo = $_POST['chislo'];
                $chisloList = array();
                if (!(isset($chislo) && !empty($chislo))){
                    $errors[] = 'Выберите знак';
                }else{
                    $chisloSize = sizeof($chislo);
                    for ($i = 0; $i < $chisloSize; $i++){
                        $chisloList[] = $chislo[$i];
                    }
                }
                $options['question'] = $question;
                $options['answers'] = implode('~', $chisloList);
            } elseif ($options['task_type'] == 8){
                $kolvo = intval($_POST['rebus-input-kolvo']);
                $rebusInp = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $rebusInp[] = $_POST['rebus-input'.$i];
                }
                $kolvoZnak = $kolvo - 1;
                $rebusZnak = array();
                for ($i = 0; $i < $kolvoZnak; $i++){
                    $rebusZnak[] = $_POST['rebus-znak'.$i];
                }
                $rebusZnak[] = "=";
                $question = array();
                for ($i = 0; $i < $kolvo; $i++){
                    $question[] = $rebusInp[$i];
                    $question[] = $rebusZnak[$i];
                }

                $result = $_POST['rebus-result'];
                $question[] = $result;
                $options['question'] = implode('~', $question);
                $options['answers'] = $_POST['rebus-right'];

            } elseif ($options['task_type'] == 9){
                $kolvo = intval($_POST['rebus-input-kolvo-сhislo']);
                $rebusInp = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $rebusInp[] = $_POST['rebus-input'.$i];
                }
                $kolvoZnak = $kolvo - 1;
                $rebusZnak = array();
                for ($i = 0; $i < $kolvoZnak; $i++){
                    $rebusZnak[] = $_POST['rebus-znak'.$i];
                }
                $rebusZnak[] = "=";
                $question = array();
                for ($i = 0; $i < $kolvo; $i++){
                    $question[] = $rebusInp[$i];
                    $question[] = $rebusZnak[$i];
                }

                $result = $_POST['rebus-result'];
                $question[] = $result;
                $options['question'] = implode('~', $question);
                $options['answers'] = $_POST['rebus-right-сhislo'];

            }elseif($options['task_type'] == 10){
                $kolvo = intval($_POST['rebus-input-kolvo-figure']);
                $question = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $question[] = $_POST['rebus-input'.$i];
                }
                $options['question'] = implode('~', $question);
                $options['answers'] = "";
            }

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['title_ru']) || empty($options['title_ru'])) {
                $errors[] = 'Заполните поля Наименование на русском';
            }
            if (!isset($options['title_kz']) || empty($options['title_kz'])) {
                $errors[] = 'Заполните поля Наименование на казахском';
            }
            if (!isset($options['score']) || empty($options['score'])) {
                $errors[] = 'Заполните поля Балл';
            }elseif($options['task_type'] == 11){
                $options['answers'] = $_POST['answer1'];
            }elseif($options['task_type'] == 12){
                $options['answers'] = $_POST['answer1'];
            }


            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар

                $id = Task::createTask($options);

                // Если запись добавлена
                if ($id) {
                    Category::updateCategorySizeById($options['category_id']);
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["question"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["question"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}.jpg");
                    }
                    if (is_uploaded_file($_FILES["questionImg"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["questionImg"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}.jpg");
                    }
                    if (is_uploaded_file($_FILES["helpPhoto"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["helpPhoto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-help.jpg");
                    }
                    if (is_uploaded_file($_FILES["solvePhoto"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["solvePhoto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-solve.jpg");
                    }
                    if ($options['task_type'] == 2){
                        if (is_uploaded_file($_FILES["answer1Img"]["tmp_name"])) {
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["answer1Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-1.jpg");
                        }

                        if (is_uploaded_file($_FILES["answer2Img"]["tmp_name"])) {
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["answer2Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-2.jpg");
                        }
                        if (is_uploaded_file($_FILES["answer3Img"]["tmp_name"])) {
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["answer3Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-3.jpg");
                        }
                        if (is_uploaded_file($_FILES["answer4Img"]["tmp_name"])) {
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["answer4Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-4.jpg");
                        }
                        if (is_uploaded_file($_FILES["answer5Img"]["tmp_name"])) {
                            // Если загружалось, переместим его в нужную папке, дадим новое имя
                            move_uploaded_file($_FILES["answer5Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-5.jpg");
                        }
                    }elseif ($options['task_type'] == 5){
                        if (!isset($colSize)){
                            $colSize = intval($_POST['string-size-image']);
                        }
                        for ($i = 0; $i < $colSize; $i++){
                            if (is_uploaded_file($_FILES["tableImage".$i]["tmp_name"])) {
                                $codeImg = $i + 1;
                                move_uploaded_file($_FILES["tableImage".$i]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-".$codeImg.".jpg");
                            }
                        }
                    }
                }

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/task");
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_task/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {
        function getTwoLevelArray($array, $size, $colSize){
            $newArray = array();
            $j = -1;
            $k = 0;
            for ($i = 0; $i < $size; $i++){
                if($i % $colSize == 0){
                    $j++;
                    $k = 0;
                }else{
                    $k++;
                }
                $newArray[$j][$k] = intval($array[$i]);
            }
            return $newArray;
        }
        function getTable($task){
            $ansArray = $task['answers'];
            $quesArray = explode('~', $task['question']);
            $size = intval(sizeof($ansArray));
            $colSize = intval(sqrt($size));
            $table = "<p>Введите правильный ответ</p><table class='table table-bordered' id='taskSudoku'>";
            $ansArray = getTwoLevelArray($ansArray, $size, $colSize);
            $quesArray = getTwoLevelArray($quesArray, $size, $colSize);
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    if ($quesArray[$i][$j] == 0){
                        $table = $table . '<td class="checkMe" adress="'.$i.'-'.$j.'"><input type="text" value="'.$ansArray[$i][$j].'" name="'.$i.'-'.$j.'tableRight"></td>';
                    }else{
                        $table = $table . '<td><input type="text" value="'.$ansArray[$i][$j].'" name="'.$i.'-'.$j.'tableRight"></td>';
                    }
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            $table = $table . "<p>Введите 1 и 0 (0 - пустое место, 1 - будет отображаться)</p><table class='table table-bordered' id='taskSudoku'>";
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    $table = $table . '<td><input type="text" value="'.$quesArray[$i][$j].'" name="'.$i.'-'.$j.'tableWrong"></td>';
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            return $table;
        }
        function getTableImg($task){
            $ansArray = $task['answers'];
            $quesArray = explode('~', $task['question']);
            $size = intval(sizeof($ansArray));
            $colSize = intval(sqrt($size));
            $table = "<p>Введите правильный ответ</p><table class='table table-bordered' id='taskSudoku'>";
            $ansArray = getTwoLevelArray($ansArray, $size, $colSize);
            $quesArray = getTwoLevelArray($quesArray, $size, $colSize);
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    if ($quesArray[$i][$j] == 0){
                        $table = $table . '<td class="checkMe" adress="'.$i.'-'.$j.'"><input type="text" value="'.$ansArray[$i][$j].'" name="'.$i.'-'.$j.'tableRightImage"></td>';
                    }else{
                        $table = $table . '<td><input type="text" value="'.$ansArray[$i][$j].'" name="'.$i.'-'.$j.'tableRightImage"></td>';
                    }
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            $table = $table . "<p>Введите 1 и 0 (0 - пустое место, 1 - будет отображаться)</p><table class='table table-bordered' id='taskSudoku'>";
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    $table = $table . '<td><input type="text" value="'.$quesArray[$i][$j].'" name="'.$i.'-'.$j.'tableWrongImage"></td>';
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            return $table;
        }
        function getRebus($task){
            $question = explode('~', $task['question']);
            $html = "";
            $counter = 0;
            $isResult = false;
            foreach ($question as $item){
                if ($item == "+"){
                    $html .= '<select name="rebus-znak'.$counter.'" id="select_type_task"><option value="+" selected="selected">+</option><option value="-">-</option><option value="X">X</option><option value="/">/</option></select>';
                    $counter++;
                }elseif ($item == "-"){
                    $html .= '<select name="rebus-znak'.$counter.'" id="select_type_task"><option value="+">+</option><option value="-" selected="selected">-</option><option value="X">X</option><option value="/">/</option></select>';
                    $counter++;
                }elseif ($item == "X"){
                    $html .= '<select name="rebus-znak'.$counter.'" id="select_type_task"><option value="+">+</option><option value="-">-</option><option value="X" selected="selected">X</option><option value="/">/</option></select>';
                    $counter++;
                }elseif ($item == "/") {
                    $html .= '<select name="rebus-znak' . $counter . '" id="select_type_task"><option value="+">+</option><option value="-">-</option><option value="X">X</option><option value="/"  selected="selected">/</option></select>';
                    $counter++;
                }elseif($item == "=") {
                    $isResult = true;
                    continue;
                }else{
                    if ($isResult){
                        $html .= '<hr><span>Результат</span><input type="text" name="rebus-result" value = "'.$item.'">';
                    }else{
                        if ($counter == 0){
                            $html .= '<span>Введите значение строк</span><input type="text" name="rebus-input'.$counter.'" value = "'.$item.'">';
                        }else{
                            $html .= '<input type="text" name="rebus-input'.$counter.'" value = "'.$item.'">';
                        }

                    }
                }

            }
            $html = "<label for='rebus-input-kolvo'>Введите количество строк</label><input type='text' name='rebus-input-kolvo' value='".++$counter."'>".$html;
            return $html;
        }
        function getRebusFigure($task){
            $question = explode('~', $task['question']);
            $html = "";
            $counter = 0;
            $isResult = false;
            foreach ($question as $item){
                $html .= '<input type="text" name="rebus-input'.$counter.'" value = "'.$item.'">';
                $counter++;
            }
            $html = "<label for='rebus-input-kolvo'>Введите количество строк</label><input type='text' name='rebus-input-kolvo' value='".$counter."'>".$html;
            return $html;
        }
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesListAdmin();
        $razdelList = Razdel::getRazdelList();
        $glavaList = Level::getLevelList();
        $courceList = Cource::getCourceList();

        // Получаем данные о конкретном заказе
        $task = Task::getTaskById($id);
        $currRazdel = Razdel::getRazdelById($task['razdel_id']);
        $currParentRazdelId = $currRazdel['parent'];
        $currLevel = $currRazdel['level_id'];
        $razdelList = Razdel::getRazdelList();
        $ansArray = $task['answers'];
        $size = intval(sizeof($ansArray));
        $colSize = intval(sqrt($size));
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['title_kz'] = $_POST['title_kz'];
            $options['title_ru'] = $_POST['title_ru'];
            $options['score'] = $_POST['score'];
            $options['category_id'] = $_POST['category_id'];
            $options['razdel_id'] = $_POST['razdel_id'];
            $options['task_type'] = intval($_POST['task_type']);
            if (isset($_POST['helpText'])){
                $options['helpText'] = $_POST['helpText'];
            }else{
                $options['helpText'] = "";
            }
            if (isset($_POST['solveText'])){
                $options['solveText'] = $_POST['solveText'];
            }else{
                $options['solveText'] = "";
            }
//            $options['question'] = $_POST['question'];

            // Флаг ошибок в форме
            $errors = false;
            $answers = array();
            if ($options['task_type'] == 1){
                if (isset($_POST['answer1']) && !empty($_POST['answer1'])) {
                    $answers[] = $_POST['answer1'];
                } else{
                    $errors[] = 'Заполните поля Правильный ответ';
                }
                if (isset($_POST['answer2']) && !empty($_POST['answer2'])) {
                    $answers[1] = $_POST['answer2'];
                }
                if (isset($_POST['answer3']) && !empty($_POST['answer3'])) {
                    $answers[2] = $_POST['answer3'];
                }
                if (isset($_POST['answer4']) && !empty($_POST['answer4'])) {
                    $answers[3] = $_POST['answer4'];
                }
                if (isset($_POST['answer2']) && !empty($_POST['answer5'])) {
                    $answers[4] = $_POST['answer5'];
                }
                $answersStr = implode('~', $answers);
                $options['answers'] = $answersStr;
            }elseif ($options['task_type'] == 2){
                if (isset($_FILES["answer1Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer1Img"]["tmp_name"])) {
                    $answers[] = "1";
                }
                if (isset($_FILES["answer2Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer2Img"]["tmp_name"])) {
                    $answers[1] = "2";
                }
                if (isset($_FILES["answer3Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer3Img"]["tmp_name"])) {
                    $answers[2] = "3";
                }
                if (isset($_FILES["answer4Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer4Img"]["tmp_name"])) {
                    $answers[3] = "4";
                }
                if (isset($_FILES["answer5Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer5Img"]["tmp_name"])) {
                    $answers[4] = "5";
                }
                $answersStr = implode('~', $task['answers']);
                $options['answers'] = $answersStr;
//                if (sizeof($answers) > 0){
//                    print_r($answers);
//                    $answersStr = implode('~', $answers);
//                    $options['answers'] = $answersStr;
//                }else{
//                    $answersStr = implode('~', $task['answers']);
//                    $options['answers'] = $answersStr;
//                }


            }elseif($options['task_type'] == 4){
                if (isset($_POST['string-size']) && !empty($_POST['string-size'])) {
                    $colSize = intval($_POST['string-size']);
                    $table = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableRight'];
                            $table[] = $cell;
                        }
                    }
                    $wrTable = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableWrong'];
                            $wrTable[] = $cell;
                        }
                    }
                    $tableStr = implode('~', $table);
                    $options['answers'] = $tableStr;
                    $wrTableStr = implode('~', $wrTable);
                    $options['question'] = $wrTableStr;

                }else{
                    $errors[] = 'Заполните поля количество строк и столбцов';
                }

            }elseif ($options['task_type'] == 5){
                if (isset($_POST['string-size-image']) && !empty($_POST['string-size-image'])) {
                    $colSize = intval($_POST['string-size-image']);
                    $table = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableRightImage'];
                            $table[] = $cell;
                        }
                    }
                    $wrTable = array();
                    for ($i = 0; $i < $colSize; $i++){
                        for ($j = 0; $j < $colSize; $j++){
                            $cell = $_POST[$i.'-'.$j.'tableWrongImage'];
                            $wrTable[] = $cell;
                        }
                    }
                    $tableStr = implode('~', $table);
                    $options['answers'] = $tableStr;
                    $wrTableStr = implode('~', $wrTable);
                    $options['question'] = $wrTableStr;

                }else{
                    $errors[] = 'Заполните поля количество строк и столбцов';
                }
            }elseif($options['task_type'] == 6){
                $question = $_POST['arifTaskWithZnak'];
                $znak = $_POST['znak'];
                $znakList = array();
                if (!(isset($znak) && !empty($znak))){
                    $errors[] = 'Выберите знак';
                }else{
                    $znakSize = sizeof($znak);
                    for ($i = 0; $i < $znakSize; $i++){
                        $znakList[] = $znak[$i];
                    }
                }
                $options['question'] = $question;
                $options['answers'] = implode('~', $znakList);
            }
            elseif($options['task_type'] == 7){
                $question = $_POST['arifTaskWithChislo'];
                $chislo = $_POST['chislo'];
                $chisloList = array();
                if (!(isset($chislo) && !empty($chislo))){
                    $errors[] = 'Выберите число';
                }else{
                    $chisloSize = sizeof($chislo);
                    for ($i = 0; $i < $chisloSize; $i++){
                        $chisloList[] = $chislo[$i];
                    }
                }
                $options['question'] = $question;
                $options['answers'] = implode('~', $chisloList);
            } elseif ($options['task_type'] == 8){
                $kolvo = intval($_POST['rebus-input-kolvo']);
                $rebusInp = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $rebusInp[] = $_POST['rebus-input'.$i];
                }
                $kolvoZnak = $kolvo - 1;
                $rebusZnak = array();
                for ($i = 0; $i < $kolvoZnak; $i++){
                    $rebusZnak[] = $_POST['rebus-znak'.$i];
                }
                $rebusZnak[] = "=";
                $question = array();
                for ($i = 0; $i < $kolvo; $i++){
                    $question[] = $rebusInp[$i];
                    $question[] = $rebusZnak[$i];
                }

                $result = $_POST['rebus-result'];
                $question[] = $result;
                $options['question'] = implode('~', $question);
                $options['answers'] = $_POST['rebus-right'];
            }elseif ($options['task_type'] == 9){
                $kolvo = intval($_POST['rebus-input-kolvo']);
                $rebusInp = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $rebusInp[] = $_POST['rebus-input'.$i];
                }
                $kolvoZnak = $kolvo - 1;
                $rebusZnak = array();
                for ($i = 0; $i < $kolvoZnak; $i++){
                    $rebusZnak[] = $_POST['rebus-znak'.$i];
                }
                $rebusZnak[] = "=";
                $question = array();
                for ($i = 0; $i < $kolvo; $i++){
                    $question[] = $rebusInp[$i];
                    $question[] = $rebusZnak[$i];
                }

                $result = $_POST['rebus-result'];
                $question[] = $result;
                $options['question'] = implode('~', $question);
                $options['answers'] = $_POST['rebus-right'];
            }elseif($options['task_type'] == 10){
                $kolvo = intval($_POST['rebus-input-kolvo-figure']);
                $question = array();
                for ($i = 0;$i < $kolvo; $i++){
                    $question[] = $_POST['rebus-input'.$i];
                }
                $options['question'] = implode('~', $question);
                $options['answers'] = "";
            }elseif ($options['task_type'] == 11){
                $options['answers'] = $_POST['answer1'];
            }elseif ($options['task_type'] == 12){
                $options['answers'] = $_POST['answer1'];
            }

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['title_ru']) || empty($options['title_ru'])) {
                $errors[] = 'Заполните поля Наименование на русском';
            }
            if (!isset($options['title_kz']) || empty($options['title_kz'])) {
                $errors[] = 'Заполните поля Наименование на казахском';
            }
            if (!isset($options['score']) || empty($options['score'])) {
                $errors[] = 'Заполните поля Балл';
            }

            // Сохраняем изменения
            if (Task::updateTaskById($id, $options)) {

                Category::updateCategorySizeById($options['category_id']);
                // Если запись сохранена
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["question"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["question"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}.jpg");
                }
                if (is_uploaded_file($_FILES["questionImg"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["questionImg"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}.jpg");
                }
                if (is_uploaded_file($_FILES["helpPhoto"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["helpPhoto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-help.jpg");
                }
                if (is_uploaded_file($_FILES["solvePhoto"]["tmp_name"])) {
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["solvePhoto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-solve.jpg");
                }
                if ($options['task_type'] == 2){
                    if (isset($_FILES["answer1Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer1Img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["answer1Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-1.jpg");
                    }
                    if (isset($_FILES["answer2Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer2Img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["answer2Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-2.jpg");
                    }
                    if (isset($_FILES["answer3Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer3Img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["answer3Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-3.jpg");
                    }
                    if (isset($_FILES["answer4Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer4Img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["answer4Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-4.jpg");
                    }
                    if (isset($_FILES["answer5Img"]["tmp_name"]) && is_uploaded_file($_FILES["answer5Img"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["answer5Img"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-5.jpg");
                    }
                }elseif ($options['task_type'] == 5){
                    if (!isset($colSize)){
                        $colSize = intval($_POST['string-size-image']);
                    }
                    for ($i = 0; $i < $colSize; $i++){
                        if (is_uploaded_file($_FILES["tableImage".$i]["tmp_name"])) {
                            $codeImg = $i + 1;
                            move_uploaded_file($_FILES["tableImage".$i]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/task/{$id}-".$codeImg.".jpg");
                        }
                    }
                }
            }

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/task");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_task/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Task::deleteTaskById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/task");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_task/delete.php');
        return true;
    }
    public function actionGetRazdel(){
        $glavaId = intval($_POST['id']);
        $razdels = Razdel::getRazdelByLevelId($glavaId, true);


        $jsonOtvet = array();
        $i = 0;

        foreach ($razdels as $razdel) {
            $jsonOtvet[$i]['id'] = $razdel['id'];
            $jsonOtvet[$i]['name_kz'] = $razdel['name_kz'];
            $jsonOtvet[$i]['name_ru'] = $razdel['name_ru'];
            $jsonOtvet[$i]['order_num'] = $razdel['order_num'];
            $jsonOtvet[$i]['klass_ids'] = $razdel['klass_ids'];
            $i++;
        }

        echo json_encode($jsonOtvet);

        return true;
    }
    public function actionGetLevel(){
        $courceId = intval($_POST['id']);
        $cource = Cource::getCourceById($courceId);
        $levels = Level::getCourceLevels($cource);



        $jsonOtvet = array();
        $i = 0;

        foreach ($levels as $level) {
            $jsonOtvet[$i]['id'] = $level['id'];
            $jsonOtvet[$i]['name_kz'] = $level['name_kz'];
            $jsonOtvet[$i]['name_ru'] = $level['name_ru'];
            $i++;
        }

        echo json_encode($jsonOtvet);

        return true;
    }

}
