<?php


class Cource
{
    public static function getCourceById($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД

        $sql = 'SELECT * FROM cource WHERE id = :id';

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
    public static function getCourceList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM cource ORDER BY id ASC');
        $levelList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $levelList[$i]['id'] = $row['id'];
            $levelList[$i]['name_kz'] = $row['name_kz'];
            $levelList[$i]['name_ru'] = $row['name_ru'];
            $levelList[$i]['level_id'] = $row['level_id'];
            $i++;
        }
        return $levelList;
    }
    public static function getCourceByLevelId($levelId, $full = true){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM cource ORDER BY id ASC');
        $courceList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $courceList[$i]['id'] = $row['id'];
            $courceList[$i]['name_kz'] = $row['name_kz'];
            $courceList[$i]['name_ru'] = $row['name_ru'];
            $courceList[$i]['level_id'] = $row['level_id'];
            $i++;
        }
        $result = null;
        foreach ($courceList as $cource){
            $levels = explode('~', $cource['level_id']);
            if (in_array($levelId, $levels)){
                $result = $cource;
                break;
            }
        }
        if ($full){
            return $result;
        }else{
            return $result['name_ru'];
        }

    }

    public static function updateCourceLevels($courceId, $level){
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД

        $sql = 'SELECT * FROM cource WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $courceId, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $cource = $result->fetch();
        $levels = explode('~', $cource['level_id']);

        if (!in_array($level, $levels)){

            array_push($levels, $level);

            $levelsStr = implode('~', $levels);

            // Текст запроса к БД
            $db = Db::getConnection();
            $sql = "UPDATE cource
            SET 
                level_id = :level_id
            WHERE id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $courceId, PDO::PARAM_INT);
            $result->bindParam(':level_id', $levelsStr, PDO::PARAM_STR);

            $result->execute();
            $otherCource = self::getCourceList();
            foreach ($otherCource as $currCource){
                if ($currCource['id'] == $courceId){
                    continue;
                }else{
                    $currLevels = explode('~', $currCource['level_id']);

                    if (in_array($level, $currLevels)){
                        foreach (array_keys($currLevels, $level) as $key) {
                            unset($currLevels[$key]);
                        }

                        $currLevelsStr = implode('~', $currLevels);
                        $db = Db::getConnection();
                        $sql = "UPDATE cource
                                SET 
                                    level_id = :level_id
                                WHERE id = :id";

                        // Получение и возврат результатов. Используется подготовленный запрос
                        $result = $db->prepare($sql);
                        $result->bindParam(':id', $currCource['id'], PDO::PARAM_INT);
                        $result->bindParam(':level_id', $currLevelsStr, PDO::PARAM_STR);

                        $result->execute();
                    }
                }
            }
        }
    }
}