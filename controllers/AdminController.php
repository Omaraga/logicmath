<?php

/**
 * Контроллер AdminController
 * Главная страница в админпанели
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     */
    public function actionIndex()
    {
        // Проверка доступа
        self::checkAdmin();
        $taskList = Task::getTaskList();
        $taskListSize = sizeof($taskList);
        $categoryList = Category::getCategoriesListAdmin();
        $categoryListSize = sizeof($categoryList);
        $razdelList = Razdel::getRazdelList();
        $razdelListSize = sizeof($razdelList);
        $levelList = Level::getLevelList();
        $levelListSize = sizeof($levelList);
        $certList = Certificate::getCertificateListAdmin();
        $certSize = sizeof($certList);
        $klassList = Klass::getKlassList();
        $klassSize = sizeof($klassList);
        $requestList = Request::getRequestList();
        $requestSize = sizeof($requestList);
        $userList = User::getUserList();
        $userSize = sizeof($userList);

         // Подключаем вид
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

}
