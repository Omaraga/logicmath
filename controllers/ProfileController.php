<?php


class ProfileController
{
    public function actionIndex(){
        $userId = User::checkLogged();
        $user = User::getUserById($userId);
        $userAndCity = User::getFioAndCityByUserId($userId);
        $cityList = City::getCityList($user['country_id']);
        $rating = Rating::getRatingByUserId($userId);
        $schoolList = City::getSchoolList($user['city_id']);
        $klassList = Klass::getKlassList();
        $myScore = $rating['score'];
        $currClass = 'profile';
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $fioRod = $_POST['fioRod'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $surname = $_POST['surname'];
            $name = $_POST['name'];
            $middlename = $_POST['middleName'];
            $placeOfStudy = $_POST['placeOfStudy'];
            $class = intval($_POST['klass']);
            $city_id = $_POST['city_id'];
            if (isset($city_id) && $city_id != null){
                $city_id = intval($city_id);
                if ($city_id == 0){
                    $cityName = $_POST['otherCity'];
                    if (!isset($cityName)){
                        $errors[] = 'Қаланы енгізіңіз';
                    }else{
                        $city_id = City::createCity($cityName, $user['country_id']);
                    }
                }
            }else{
                $errors[] = 'Выберите город';
            }
            $school_id = $_POST['school_id'];
            if (isset($school_id) && $school_id != null){
                $school_id = intval($school_id);
                if ($school_id == 0){
                    $schoolName = $_POST['otherSchool'];
                    if (!isset($schoolName)){
                        $errors[] = 'Мектепті енгізіңіз';
                    }else{
                        $school_id = City::createSchool($schoolName, $user['city_id']);
                    }
                }
            }else{
                $errors[] = 'Мектепті енгізіңіз';
            }

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
            User::getUpdateUserDataByUserId($userId, $surname, $name, $middlename, $email, $phone, $fioRod, '', $city_id, $placeOfStudy, $class, $school_id);
            if (is_uploaded_file($_FILES["image"]["tmp_name"])) {

                // Если загружалось, переместим его в нужную папке, дадим новое имя
                move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/user/{$userId}.jpg");
            }

            // Перенаправляем пользователя на страницу управлениями категориями
            header("Location: /cabinet");
        }
        // Подключаем вид
        require_once(ROOT . '/views/profile/index.php');
        return true;
    }

}