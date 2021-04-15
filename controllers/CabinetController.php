<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        function getOffSet($counter){
            if ($counter == 0){
                return "col-sm-offset-5";
            }elseif ($counter % 5 == 1){
                return "col-sm-offset-4";
            }elseif ($counter % 5 == 3){
                return "col-sm-offset-3";
            }else{
                return "";
            }
        }
        $currClass = 'cabinet';
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        Rating::updateRatingList($userId);
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        Razdel::checkZapRazdelov($userId);
        $myKlass = strval($user['klass_id']);
        $myCourceId = intval($user['my_cource_id']);
        $myZapRazdelList = explode('~', $user['zap_razdel']);
        $cource = Cource::getCourceById(1);
        $cource1 = Cource::getCourceById(2);

        $levels = Level::getCourceLevels($cource);
        $i = 0;
        $razdelMaps = array();
        $j = -1;
        foreach ($levels as $level){
            foreach ($level['razdel_id'] as $razdel){
                $razdelKLasses = explode('~', $razdel['klass_ids']);
                if(!in_array($myKlass, $razdelKLasses)){
                    continue;
                }
                if (in_array(strval($razdel['id']), $myZapRazdelList)){
                    $j = $i;
                }
                $i++;
            }
        }
        $i = 0;
        foreach ($levels as $level){
            foreach ($level['razdel_id'] as $razdel){
                $razdelKLasses = explode('~', $razdel['klass_ids']);
                if(!in_array($myKlass, $razdelKLasses)){
                    continue;
                }
                if ($i < $j + 3){
                    $razdelMaps[$razdel['id']] = 1;
                }else{
                    $razdelMaps[$razdel['id']] = 0;
                }
                $i++;
            }

        }

        $levels1 = Level::getCourceLevels($cource1);
        $i = 0;
        $razdelMaps1 = array();
        $j = -1;
        foreach ($levels1 as $level){
            foreach ($level['razdel_id'] as $razdel){
                $razdelKLasses = explode('~', $razdel['klass_ids']);
                if(!in_array($myKlass, $razdelKLasses)){
                    continue;
                }
                if (in_array(strval($razdel['id']), $myZapRazdelList)){
                    $j = $i;
                }
                $i++;
            }
        }
        $i = 0;
        foreach ($levels1 as $level){
            foreach ($level['razdel_id'] as $razdel){
                $razdelKLasses = explode('~', $razdel['klass_ids']);
                if(!in_array($myKlass, $razdelKLasses)){
                    continue;
                }
                if ($i < $j + 3){
                    $razdelMaps1[$razdel['id']] = 1;
                }else{
                    $razdelMaps1[$razdel['id']] = 0;
                }
                $i++;
            }

        }
//        echo $j;
//    print_r($razdelMaps);
        $categoryList = Category::getCategoriesList();
        $rating = Rating::getRatingByUserId($userId);
        $myScore = $rating['score'];
        $zap_otvetov = Zap_otvetov::getRightZapOtvetUserId($userId);
        $taskSize = Task::getCountTasks();
        $sizeZapOtv = sizeof($zap_otvetov);
        if ($taskSize > 0){
            $progressProc = round($sizeZapOtv/$taskSize*100);
        }else{
            $progressProc = 0;
        }


        $lastSolvedRazdel = 0;
        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionRating($country_id = 0, $page = 1)
    {
        $userId = User::checkLogged();
        $page = intval($page);

        $currClass = 'rating';
        // Получаем информацию о пользователе из БД
        $rating = Rating::getRatingByUserId($userId);
        $myScore = $rating['score'];
        $user = User::getUserById($userId);
        $userKlassId = $user['klass_id'];
        Rating::updateRatingList($userId);
        Rating::updateRatingPlace();
        $countryList = City::getCountryList();
        foreach ($countryList as $country){
            Rating::updateRatingPlace($country['id'], null, null);
        }
        $cityList = City::getFullCityList();
        foreach ($cityList as $city){
            Rating::updateRatingPlace(null, $city['id'], null);
        }
        $schoolList = City::getFullSchoolList();
        foreach ($schoolList as $school){
            Rating::updateRatingPlace(null, null, $school['id']);
        }

        $myRatingPlace = Rating::getRatingByUserId($userId);
        $limit = Rating::PAGE_DEFAULT;

        // Создаем объект Pagination - постраничная навигация
        if ($country_id == -2){
            $total = Rating::getTotalRating(-2, $user['school_id'], $userKlassId);
            $ratingList = Rating::getRatingList($page, $country_id, $userKlassId, null, $user['school_id']);
        }elseif ($country_id == -1){
            $total = Rating::getTotalRating(-1, $user['city_id'], $userKlassId);
            $ratingList = Rating::getRatingList($page, $country_id, $userKlassId, $user['city_id'], null);
        }elseif ($country_id == 0){
            $total = Rating::getTotalRating(0,$user['country_id'], $userKlassId);
            $ratingList = Rating::getRatingList($page, $country_id, $userKlassId);
        }else{
            $total = Rating::getTotalRating(1,null, $userKlassId);
            $ratingList = Rating::getRatingList($page, $country_id, $userKlassId);
        }


        $pagination = new Pagination($total, $page, $limit, 'page-');
        // Подключаем вид
        require_once(ROOT . '/views/rating/index.php');
        return true;
    }
    public function actionGetTasks(){
        $razdelId = intval($_POST['razdelId']);
        $razdels = Razdel::getRazdelByParentId($razdelId);

        $jsonOtvet = array();
        $i = 0;

        foreach ($razdels as $razdel) {
            $jsonOtvet[$i]['id'] = $razdel['id'];
            $jsonOtvet[$i]['short_name'] = $razdel['name_kz'];
            $firstTask = Task::getFirstTaskIdByRazdelId($razdel['id']);
            if(isset($firstTask)){
                $jsonOtvet[$i]['task_id'] = $firstTask;
            }else{
                $jsonOtvet[$i]['task_id'] = "";
            }
            $jsonOtvet[$i]['image'] = $razdel['image'];
            $jsonOtvet[$i]['difficult'] = $razdel['difficult'];
            $i++;
        }



        echo json_encode($jsonOtvet);

        return true;
    }

}
