<?php


class Level
{
    public static function getCourceLevels($cource){
        $levels = array();
        if (isset($cource)){
            $levels_ids = explode('~', $cource['level_id']);
            $levels_ids = implode(',', $levels_ids);


            // Соединение с БД
            $db = Db::getConnection();
            $sql = 'SELECT * FROM level WHERE id IN ('.$levels_ids.')';

            $result = $db->query($sql);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);

            // Получение и возврат результатов
            $i = 0;

            while ($row = $result->fetch()) {
                $levels[$i]['id'] = $row['id'];
                $levels[$i]['name_kz'] = $row['name_kz'];
                $levels[$i]['name_ru'] = $row['name_ru'];
                $razdels = Razdel::getRazdelByLevelId($row['id'], true);
                $levels[$i]['razdel_id'] = $razdels;
                $i++;
            }
        }

        return $levels;
    }

    public static function getLevelList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM level ORDER BY id ASC');
        $levelList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $levelList[$i]['id'] = $row['id'];
            $levelList[$i]['name_kz'] = $row['name_kz'];
            $levelList[$i]['name_ru'] = $row['name_ru'];
            $levelList[$i]['razdel_id'] = $row['razdel_id'];
            $levelList[$i]['cource'] = Cource::getCourceByLevelId($row['id'], true);
            $i++;
        }
        return $levelList;
    }
    public static function createLevel($name_ru, $name_kz)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO level (name_kz, name_ru) '
            . 'VALUES (:name_kz, :name_ru)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':name_kz', $name_kz, PDO::PARAM_STR);
//        $result->bindParam(':razdel_id', $razdel_id, PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }

    public static function updateLevelById($id, $name_ru, $name_kz)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE level
            SET 
                name_kz = :name_kz, 
                name_ru = :name_ru
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name_kz', $name_kz, PDO::PARAM_STR);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
//        $result->bindParam(':razdel_id', $razdel_id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getLevelById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM level WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        // Получение и возврат результатов
        return $result->fetch();
    }

    public static function deleteLevelById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM level WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}