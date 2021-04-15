<?php


class AdminLevelController extends AdminBase
{
    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $levelList = Level::getLevelList();
        // Подключаем вид
        require_once(ROOT . '/views/admin_level/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();
        $courceList = Cource::getCourceList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];
            $courceId = $_POST['cource_id'];
//            $razdel_id = $_POST['razdel_id'];

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
               $levelId = Level::createLevel($name_ru, $name_kz);


               Cource::updateCourceLevels($courceId , $levelId);

                // Перенаправляем пользователя на страницу управлениями категориями
               header("Location: /admin/level");
            }
        }

        require_once(ROOT . '/views/admin_level/create.php');
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
        $courceList = Cource::getCourceList();
        $currLevel = Level::getLevelById($id);
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];
            $courceId = $_POST['cource_id'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name_ru) || empty($name_ru)) {
                $errors[] = 'Заполните поле Наименование на русском';
            }
            if (!isset($name_kz) || empty($name_kz)) {
                $errors[] = 'Заполните поле Наименование на казахском';
            }

            // Сохраняем изменения
            Level::updateLevelById(intval($id), $name_ru, $name_kz);

            Cource::updateCourceLevels($courceId , $id);

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/level");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_level/update.php');
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
            Level::deleteLevelById($id);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/level");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_level/delete.php');
        return true;
    }

}