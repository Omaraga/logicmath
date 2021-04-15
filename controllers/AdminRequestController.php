<?php


class AdminRequestController extends AdminBase
{
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий
        $requestList = Request::getRequestList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_request/index.php');
        return true;
    }

    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем категорию
            Request::deleteRequestById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/request");
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_request/delete.php');
        return true;
    }

    public function actionCreate(){
        $taskId = intval($_POST['task']);
        $message = $_POST['message'];
        $userId = intval(User::checkLogged());
        $id = Request::createRequest($userId, $taskId, "", $message);


        $jsonOtvet = array();
        $jsonOtvet['id'] = $id;


        echo json_encode($jsonOtvet);

        return true;
    }
}