<?php


class City
{
    public static function getCityById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM city WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }

    public static function getCityList($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM city where country_id = :id ORDER BY name_ru ASC';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $cityList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $cityList[$i]['id'] = $row['id'];
            $cityList[$i]['name_kz'] = $row['name_kz'];
            $cityList[$i]['name_ru'] = $row['name_ru'];
            $cityList[$i]['country_id'] = $row['country_id'];
            $i++;
        }
        return $cityList;
    }
    public static function getCountryList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM country ORDER BY name_kz ASC';
        $result = $db->prepare($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $countryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $countryList[$i]['id'] = $row['id'];
            $countryList[$i]['name_kz'] = $row['name_kz'];
            $countryList[$i]['name_ru'] = $row['name_ru'];
            $i++;
        }
        return $countryList;
    }
    public static function getFullCityList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM city ORDER BY name_kz ASC';
        $result = $db->prepare($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $cityList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $cityList[$i]['id'] = $row['id'];
            $cityList[$i]['name_kz'] = $row['name_kz'];
            $cityList[$i]['name_ru'] = $row['name_ru'];
            $i++;
        }
        return $cityList;
    }

    public static function getFullSchoolList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM school ORDER BY name_kz ASC';
        $result = $db->prepare($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $schoolList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $schoolList[$i]['id'] = $row['id'];
            $schoolList[$i]['name_kz'] = $row['name_kz'];
            $schoolList[$i]['name_ru'] = $row['name_ru'];
            $i++;
        }
        return $schoolList;
    }
    public static function createCity($name_ru, $country_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO city (name_kz, name_ru, country_id) '
            . 'VALUES (:name_kz, :name_ru, :country_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':name_kz', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':country_id', $country_id, PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }

    public static function createSchool($name_ru, $city_id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO school (name_kz, name_ru, city_id) '
            . 'VALUES (:name_kz, :name_ru, :city_id)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':name_kz', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }

    public static function getSchoolList($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM school where city_id = :id ORDER BY name_ru ASC';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $cityList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $cityList[$i]['id'] = $row['id'];
            $cityList[$i]['name_kz'] = $row['name_kz'];
            $cityList[$i]['name_ru'] = $row['name_ru'];
            $cityList[$i]['city_id'] = $row['city_id'];
            $i++;
        }
        return $cityList;
    }



}