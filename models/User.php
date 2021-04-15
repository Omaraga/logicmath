<?php

/**
 * Класс User - модель для работы с пользователями
 */
class User
{

    /**
     * Регистрация пользователя 
     * @param string $name <p>Имя</p>
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function register($name, $email, $password, $surname, $middlename, $telephone, $countryId, $klass_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO user (name, email, password, surname, middlename, telephone, role_id, my_cource_id, country_id, klass_id) '
                . 'VALUES (:name, :email, :password, :surname, :middlename, :telephone, 2, 1, :country_id, :klass_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':middlename', $middlename, PDO::PARAM_STR);
        $result->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':country_id', $countryId, PDO::PARAM_INT);
        $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирование данных пользователя
     * @param integer $id <p>id пользователя</p>
     * @param string $name <p>Имя</p>
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function edit($id, $name, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $email <p>E-mail</p>
     * @param string $password <p>Пароль</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserData($email, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();

        // Обращаемся к записи
        $user = $result->fetch();

        if ($user) {
            // Если запись существует, возвращаем id пользователя
            return $user['id'];
        }
        return false;
    }

    /**
     * Запоминаем пользователя
     * @param integer $userId <p>id пользователя</p>
     */
    public static function auth($userId)
    {
        // Записываем идентификатор пользователя в сессию
        $_SESSION['user'] = $userId;
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }


    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет телефон: не меньше, чем 10 символов
     * @param string $phone <p>Телефон</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email
     * @param string $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет не занят ли email другим пользователем
     * @param type $email <p>E-mail</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmailExists($email)
    {
        // Соединение с БД        
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn())
            return true;
        return false;
    }

    /**
     * Возвращает пользователя с указанным id
     * @param integer $id <p>id пользователя</p>
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function getUserById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getFioAndCityByUserId($id){
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user inner join country on user.country_id = country.id WHERE user.id = :id ';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $user = $result->fetch();
        $userList = array();
        $fio = $user['surname'].' '.$user['name'].' '.$user['middlename'];
        $city = $user['name_kz'];
        $userList['fio'] = $fio;
        $userList['photo'] = $user['photo'];
        $userList['email'] = $user['email'];
        $userList['telephone'] = $user['telephone'];
        $userList['city'] = $city;
        $userList['city_ru'] = $user['name_ru'];
//        $userList['country'] = $user['country'];
        return $userList;
    }

    public static function getUpdateUserDataByUserId($id, $surname, $name, $middlename, $email, $telephone, $fioRod, $nameOfStudy='', $city_id, $placeOfStudy, $class, $school_id){
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user
            SET 
                name = :name,
                surname = :surname,
                middlename = :middlename,
                email = :email,
                telephone = :telephone,
                fioRod = :fioRod,
                nameOfStudy = :nameOfStudy,
                city_id = :city_id,
                placeOfStudy = :placeOfStudy,
                klass_id = :klass_id,
                school_id = :school_id
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':middlename', $middlename, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $result->bindParam(':fioRod', $fioRod, PDO::PARAM_STR);
        $result->bindParam(':placeOfStudy', $placeOfStudy, PDO::PARAM_STR);
        $result->bindParam(':nameOfStudy', $nameOfStudy, PDO::PARAM_STR);
        $result->bindParam(':klass_id', $class, PDO::PARAM_INT);
        $result->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        $result->bindParam(':school_id', $school_id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function updateUsersCerts($id, $myCerts)
    {
        $myCerts = implode('~', $myCerts);
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user 
            SET certificate_ids = :certificate_ids 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':certificate_ids', $myCerts, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function updateUsersZapRazdels($id, $zapRazdelList)
    {
        $myZapRazdel = implode('~', $zapRazdelList);
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user 
            SET zap_razdel = :zap_razdel 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':zap_razdel', $myZapRazdel, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function getUserByEmail($email)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM user WHERE email = :email';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function recoveryPass($email){
        $to  = $email ;
        $user = self::getUserByEmail($email);
        $subject = "Восстановление пароля logicmath.kz";

        $message = ' <p>Данные для входа!</p> </br> <b>Ваш логин: '.$user['email'] .'</b> </br><i>Ваш пароль: '.$user['password'].' </i> </br>';

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: LogicMath.kz платформасы <info@logicmath.kz>\r\n";
        $headers .= "Reply-To: info@logicmath.kz\r\n";

        mail($to, $subject, $message, $headers);
    }
    public static function getUserList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM user ORDER BY id ASC');
        $userList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $userList[$i]['id'] = $row['id'];
            $userList[$i]['name'] = $row['name'];
            $userList[$i]['surname'] = $row['surname'];
            $userList[$i]['role_id'] = $row['role_id'];
            $userList[$i]['password'] = $row['password'];
            $userList[$i]['email'] = $row['email'];
            $userList[$i]['telephone'] = $row['telephone'];
            $userList[$i]['fioRod'] = $row['fioRod'];
            $userList[$i]['placeOfStudy'] = $row['placeOfStudy'];
            $userList[$i]['nameOfStudy'] = $row['nameOfStudy'];
            $userList[$i]['klass_id'] = $row['klass_id'];
            $userList[$i]['country_id'] = $row['country_id'];
            $userList[$i]['certificate_ids'] = $row['certificate_ids'];
            $userList[$i]['zap_razdel'] = $row['zap_razdel'];
            $i++;
        }
        return $userList;
    }

    public static function updateUserById($id, $role_id, $password)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE user
            SET 
                role_id = :role_id, 
                password = :password 
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getRoleList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM role ORDER BY id ASC');
        $roleList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $roleList[$i]['id'] = $row['id'];
            $roleList[$i]['name_kz'] = $row['name_kz'];
            $roleList[$i]['name_ru'] = $row['name_ru'];
            $i++;
        }
        return $roleList;
    }

    public static function getRoleById($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM role WHERE id=:id';

        // Получение результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->execute();

        // Обращаемся к записи
        $role = $result->fetch();

        return $role['name_kz'];
    }


    public static function deleteUserById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM user WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }



}
