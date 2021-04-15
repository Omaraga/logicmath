<?php


class AdminRazdelController extends AdminBase
{
    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        function getClasses($razdel){
            $classes = "";
            $klassListIds = explode("~",$razdel['klass_ids']);
            if (is_array($klassListIds)){
                foreach ($klassListIds as $klassId){
                    $klass = Klass::getKlassById($klassId);
                    $classes = $classes . $klass['name_kz']."; ";
                }
            }

            return $classes;
        }
        function getDiffName($razdel){
            if (isset($razdel['difficult'])){
                $difId = intval($razdel['difficult']);
                if ($difId == 1){
                    $difName = "Бастапқы";
                }elseif ($difId == 2) {
                    $difName = "Орта";
                }else{
                    $difName = "Жоғары";
                }
                return $difName;
            }else{
                return "";
            }
        }
        function getTreeRazdel($cource){



            $levels = Level::getCourceLevels($cource);
            $html = "<table class='table-bordered table-striped table'>";
            foreach ($levels as $level){
                $html = $html."<tr><td width='5%'><b>".$level['name_kz']."</b></td><tr>";
                $razdels = Razdel::getRazdelByLevelId($level['id'], true);
                foreach ($razdels as $razdel){
                    $classes = getClasses($razdel);
                    $html = $html."<tr><td style='background-color: #a0a9b2'></td><td style='color: darkblue; font-weight: bold; text-transform: uppercase;'>".$razdel['name_kz']."-".$razdel['id']."</td><td><span style='color: #c9302c;'>Классы:</span> ".$classes."</td><td>Порядок-".$razdel['order_num']."</td><td><a href='/admin/razdel/update/".$razdel['id']."' title='Редактировать'><i class='fa fa-pencil-square-o'></i></a></td><td><a href='/admin/razdel/delete/".$razdel['id']."' title='Удалить'><i class='fa fa-times'></i></a></td>"."<tr>";
                    $childs = Razdel::getRazdelByParentId($razdel['id']);
                    foreach ($childs as $child){
                        $diff = getDiffName($child);
                        $html = $html."<tr><td style='background-color: #a0a9b2'></td><td style='background-color: #a0a9b2'></td><td style='color: #285e8e; font-weight: bold; text-transform: uppercase;'>".$child['name_kz']."-".$child['id']."</td><td><span style='color: #c9302c;'>Сложность: </span>".$diff."</td><td>Порядок-".$child['order_num']."</td><td><a href='/admin/razdel/update/".$child['id']."' title='Редактировать'><i class='fa fa-pencil-square-o'></i></a></td><td><a href='/admin/razdel/delete/".$child['id']."' title='Удалить'><i class='fa fa-times'></i></a></td>"."<tr>";

                    }

                }

            }
            $html.="</table>";
            return $html;
        }
        $cource1 = Cource::getCourceById(1);
        $cource2 = Cource::getCourceById(2);
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $categoriesList = Category::getCategoriesListAdmin();
        $razdelList = Razdel::getRazdelList();
        // Подключаем вид
        require_once(ROOT . '/views/admin_razdel/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        $levelList = Level::getLevelList();
        $klassList = Klass::getKlassList();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];
            $level_id = $_POST['level_id'];
            $is_child = intval($_POST['child1']);
            if ($is_child == 1){
                $parent_razdel = $_POST['parentRazdel'];
                $razdel_dif = $_POST['razdel_dif'];
                $is_parent = 0;
            }else{
                $parent_razdel = null;
                $razdel_dif = null;
                $is_parent =  1;
            }
            $number = $_POST['order_num'];
            $klass = $_POST['klass'];
            $razdelKlassList = array();
//            print_r($klass);
            if (!(isset($klass) && !empty($klass))){
                $errors[] = 'Выберите класс';
            }else{
                $klassSize = sizeof($klass);
                for ($i = 0; $i < $klassSize; $i++){
                    $razdelKlassList[] = $klass[$i];
                }
            }
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name_ru) || empty($name_ru)) {
                $errors[] = 'Заполните поле Наименование на русском';
            }
            if (!isset($name_kz) || empty($name_kz)) {
                $errors[] = 'Заполните поле Наименование на казахском';
            }


            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новую категорию
                $id = Razdel::createRazdel($name_ru, $name_kz, $level_id, $number, $razdelKlassList, $parent_razdel, $razdel_dif, $is_parent);
                if ($id) {
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/razdel/{$id}.jpg");
                    }
                    Razdel::sortRazdel($id);
                }
                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/razdel");
            }
        }

        require_once(ROOT . '/views/admin_razdel/create.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретной категории
        $levelList = Level::getLevelList();
        $razdel = Razdel::getRazdelById($id);
        $razdelKlass = explode('~', $razdel['klass_ids']);
        $klassList = Klass::getKlassList();
        $razdels = Razdel::getRazdelByLevelId($razdel['level_id'], true);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            $options['name_kz'] = $_POST['name_kz'];
            $options['name_ru'] = $_POST['name_ru'];
            $options['level_id'] = $_POST['level_id'];
            $options['order_num'] = $_POST['order_num'];
            $is_child = intval($_POST['child1']);
            if ($is_child == 1){
                $options['parent_razdel'] = $_POST['parentRazdel'];
                $options['razdel_dif'] = $_POST['razdel_dif'];
                $options['is_parent'] = 0;
            }else{
                $options['parent_razdel'] = null;
                $options['razdel_dif']= null;
                $options['is_parent'] =  1;
            }
            $klass = $_POST['klass'];
            $razdelKlassList = array();
//            print_r($klass);
            if (!(isset($klass) && !empty($klass))){
                $errors[] = 'Выберите класс';
            }else{
                $klassSize = sizeof($klass);
                for ($i = 0; $i < $klassSize; $i++){
                    $razdelKlassList[] = $klass[$i];
                }
            }
            $options['klass_ids'] = $razdelKlassList;
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name_kz']) || empty($options['name_kz'])) {
                $errors[] = 'Заполните поле Наименование на казахском';
            }
            if (!isset($options['name_kz']) || empty($options['name_kz'])) {
                $errors[] = 'Заполните поле Наименование на русском';
            }

            // Сохраняем изменения
            Razdel::updateRazdelById($id, $options);

            if ($id) {
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/razdel/{$id}.jpg");
                }
            }
            Razdel::sortRazdel($id);

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/razdel");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_razdel/update.php');
        return true;
    }

    /**
     * Action для страницы "Удалить категорию"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            Razdel::deleteRazdelById($id);
            Razdel::sortRazdel($id);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/razdel");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_razdel/delete.php');
        return true;
    }

    public function actionParentrazdel(){
        $levelId = $_POST['id'];
        $razdels = Razdel::getRazdelByLevelId($levelId, true);
        $jsonOtvet = array();
        $i = 0;


        foreach ($razdels as $razdel) {
            $jsonOtvet[$i]['id'] = $razdel['id'];
            $jsonOtvet[$i]['name_kz'] = $razdel['name_kz'];
            $jsonOtvet[$i]['name_ru'] = $razdel['name_ru'];
            $i++;
        }

        echo json_encode($jsonOtvet);

        return true;

    }
    public function actionSubrazdel(){
        $parentId = $_POST['id'];
        $razdels = Razdel::getRazdelByParentId($parentId);
        $jsonOtvet = array();
        $i = 0;


        foreach ($razdels as $razdel) {
            $jsonOtvet[$i]['id'] = $razdel['id'];
            $jsonOtvet[$i]['name_kz'] = $razdel['name_kz'];
            $jsonOtvet[$i]['name_ru'] = $razdel['name_ru'];
            $i++;
        }

        echo json_encode($jsonOtvet);

        return true;
    }



}