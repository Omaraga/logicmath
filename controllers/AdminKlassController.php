<?php


class AdminKlassController extends AdminBase
{
    /**
     * Action для страницы "Управление категориями"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $klassList = Klass::getKlassList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_klass/index.php');
        return true;
    }

    /**
     * Action для страницы "Добавить категорию"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];

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
                $id = Klass::createKlass($name_ru, $name_kz);


                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/klass");
            }
        }

        require_once(ROOT . '/views/admin_klass/create.php');
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
        $klass = Klass::getKlassById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];

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
            Klass::updateKlassById($id, $name_ru, $name_kz);


            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/klass");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_klass/update.php');
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
            Klass::deleteKlassById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/klass");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_klass/delete.php');
        return true;
    }
}