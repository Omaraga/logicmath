<?php


class AdminCertificateController extends AdminBase
{
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $certList = Certificate::getCertificateListAdmin();

        // Подключаем вид
        require_once(ROOT . '/views/admin_certificate/index.php');
        return true;
    }
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
            $count_task = $_POST['count_task'];
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name_ru) || empty($name_ru)) {
                $errors[] = 'Заполните поле Наименование на русском';
            }
            if (!isset($name_kz) || empty($name_kz)) {
                $errors[] = 'Заполните поле Наименование на казахском';
            }
            if (!isset($count_task) || empty($count_task)) {
                $errors[] = 'Заполните поле Количество задач';
            }

            $id = Certificate::createCertificate($name_ru, $name_kz, $count_task);
            if ($errors == false) {
                // Если ошибок нет
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/certs/{$id}.jpg");
                    }

                // Перенаправляем пользователя на страницу управлениями категориями
                header("Location: /admin/cert");
            }
        }

        require_once(ROOT . '/views/admin_certificate/create.php');
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
        $cert = Certificate::getCertificateById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $name_kz = $_POST['name_kz'];
            $name_ru = $_POST['name_ru'];
            $count_task = $_POST['count_task'];
            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($name_ru) || empty($name_ru)) {
                $errors[] = 'Заполните поле Наименование на русском';
            }
            if (!isset($name_kz) || empty($name_kz)) {
                $errors[] = 'Заполните поле Наименование на казахском';
            }
            if (!isset($count_task) || empty($count_task)) {
                $errors[] = 'Заполните поле Количество задач';
            }

            // Сохраняем изменения
            Certificate::updateCertificateById($id, $name_ru, $name_kz, $count_task);
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                // Если загружалось, переместим его в нужную папке, дадим новое имя
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/certs/{$id}.jpg");
            }

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/cert");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_certificate/update.php');
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
            Certificate::deleteCertificateById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/cert");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_certificate/delete.php');
        return true;
    }
}