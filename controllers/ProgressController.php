<?php


class ProgressController
{
    public function actionIndex(){

        $userId = User::checkLogged();
        Certificate::checkAproveCertificate($userId);
        $certList = Certificate::getCertificateListAdmin();
        $user = User::getUserById($userId);
        $userAndCity = User::getFioAndCityByUserId($userId);
        $categoryList = Category::getCategoriesList();
        $zap_otvetov = Zap_otvetov::getRightZapOtvetUserId($userId);
        $taskSize = Task::getCountTasks();
        $sizeZapOtv = sizeof($zap_otvetov);
        $currClass = 'progress';
//        print_r($zap_otvetov);
//        Certificate::createCertificateFile($userId, 3);
        $rating = Rating::getRatingByUserId($userId);
        $myScore = $rating['score'];
        if (isset($user['certificate_ids']) && strlen($user['certificate_ids']) > 0){
            $myCerts = explode('~', $user['certificate_ids']);
        }else{
            $myCerts = array();
        }
        // Подключаем вид
        require_once(ROOT . '/views/progress/index.php');
        return true;
    }
}