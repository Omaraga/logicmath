<?php


class AdminUserController extends AdminBase
{
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $userList = User::getUserList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактировать категорию"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();
        $user = User::getUserById($id);

        // Получаем данные о конкретной категории
        $category = Category::getCategoryById($id);
        $roleList = User::getRoleList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $role_id = $_POST['role_id'];
            $password = $_POST['password'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
//            if (!isset($name_ru) || empty($name_ru)) {
//                $errors[] = 'Заполните поле Наименование на русском';
//            }
//            if (!isset($name_kz) || empty($name_kz)) {
//                $errors[] = 'Заполните поле Наименование на казахском';
//            }

            // Сохраняем изменения
            User::updateUserById($id, $role_id, $password);

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /admin/users");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/update.php');
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
            User::deleteUserById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/users");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_user/delete.php');
        return true;
    }

}