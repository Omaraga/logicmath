<?php


class Razdel
{
    public static  function  getRazdelById($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД

        $sql = 'SELECT * FROM razdel WHERE id = :id';

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

    public static function getRazdelByLevelId($id, $is_parent = false){

        // Соединение с БД
        $db = Db::getConnection();
        if ($is_parent == false){
            $sql = 'SELECT * FROM razdel WHERE level_id = :id order by order_num';
        }else{
            $sql = 'SELECT * FROM razdel WHERE level_id = :id and is_parent = 1 order by order_num';
        }
        $id = intval($id);
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $razdel = array();
        while ($row = $result->fetch()) {
            $razdel[$i]['id'] = $row['id'];
            $razdel[$i]['name_kz'] = $row['name_kz'];
            $razdel[$i]['name_ru'] = $row['name_ru'];
            $razdel[$i]['image'] = $row['image'];
            $razdel[$i]['order_num'] = $row['order_num'];
            $razdel[$i]['klass_ids'] = $row['klass_ids'];
            $razdel[$i]['parent'] = $row['parent'];
            $razdel[$i]['difficult'] = $row['difficult'];
            $razdel[$i]['is_parent'] = $row['is_parent'];
            $i++;
        }
        return $razdel;
    }

    public static function getRazdelByParentId($id){

        // Соединение с БД
        $db = Db::getConnection();

        $sql = 'SELECT * FROM razdel WHERE parent = :id order by order_num';

        $id = intval($id);
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $razdel = array();
        while ($row = $result->fetch()) {
            $razdel[$i]['id'] = $row['id'];
            $razdel[$i]['name_kz'] = $row['name_kz'];
            $razdel[$i]['name_ru'] = $row['name_ru'];
            $razdel[$i]['image'] = $row['image'];
            $razdel[$i]['order_num'] = $row['order_num'];
            $razdel[$i]['difficult'] = $row['difficult'];
            $razdel[$i]['klass_ids'] = $row['klass_ids'];
            $i++;
        }
        return $razdel;
    }


    public static function getRazdelListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT id, name_ru, name_kz FROM razdel ORDER BY id ASC');

        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name_ru'] = $row['name_ru'];
            $categoryList[$i]['name_kz'] = $row['name_kz'];
            $categoryList[$i]['name_kz'] = $row['name_kz'];
            $i++;
        }
        return $categoryList;
    }

    public static function getRazdelList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM razdel ORDER BY level_id ASC, order_num ASC');
        $razdelList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $razdelList[$i]['id'] = $row['id'];
            $razdelList[$i]['name_kz'] = $row['name_kz'];
            $razdelList[$i]['name_ru'] = $row['name_ru'];
            $razdelList[$i]['level_id'] = $row['level_id'];
            $razdelList[$i]['order_num'] = $row['order_num'];
            $razdelList[$i]['image'] = $row['image'];
            $klassList = explode('~', $row['klass_ids']);
            $razdelList[$i]['klass_ids'] = $klassList;
            $i++;
        }
        return $razdelList;
    }

    public static function deleteRazdelById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM razdel WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createRazdel($name_ru, $name_kz, $level_id, $number, $razdelKlassList, $parent_id = null, $difficult = null, $is_parent)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $razdelKlassListStr = implode('~', $razdelKlassList);
        // Текст запроса к БД
        $sql = 'INSERT INTO razdel (name_kz, name_ru, level_id, order_num, klass_ids, parent, is_parent, difficult) '
            . 'VALUES (:name_kz, :name_ru, :level_id, :order_num, :klass_ids, :parent, :is_parent, :difficult)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':name_kz', $name_kz, PDO::PARAM_STR);
        $result->bindParam(':level_id', $level_id, PDO::PARAM_INT);
        $result->bindParam(':order_num', $number, PDO::PARAM_INT);
        $result->bindParam(':is_parent', $is_parent, PDO::PARAM_INT);
        if (!isset($parent_id)){
            $result->bindParam(':parent', $parent_id, PDO::PARAM_NULL);
        }else{
            $result->bindParam(':parent', $parent_id, PDO::PARAM_INT);
        }
        $result->bindParam(':difficult', $difficult, PDO::PARAM_INT);
        $result->bindParam(':klass_ids', $razdelKlassListStr, PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }

    public static function updateRazdelById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        $klass_ids = implode('~', $options['klass_ids']);
        // Текст запроса к БД
        $sql = "UPDATE razdel
            SET 
                name_kz = :name_kz, 
                name_ru = :name_ru,
                level_id = :level_id,
                order_num = :order_num,
                parent = :parent,
                is_parent = :is_parent,
                difficult = :difficult,
                klass_ids = :klass_ids
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name_kz', $options['name_kz'], PDO::PARAM_STR);
        $result->bindParam(':name_ru', $options['name_ru'], PDO::PARAM_STR);
        $result->bindParam(':level_id', $options['level_id'], PDO::PARAM_INT);
        $result->bindParam(':order_num', $options['order_num'], PDO::PARAM_INT);
        $result->bindParam(':parent', $options['parent_razdel'], PDO::PARAM_INT);
        $result->bindParam(':is_parent', $options['is_parent'], PDO::PARAM_INT);
        $result->bindParam(':difficult', $options['razdel_dif'], PDO::PARAM_INT);

        $result->bindParam(':klass_ids', $klass_ids, PDO::PARAM_STR);
        return $result->execute();
    }
    public static function updateRazdelRows($razdelList){
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE razdel
            SET 
                order_num = :order_num
            WHERE id = :id";
        foreach ($razdelList as $razdel){
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $razdel['id'], PDO::PARAM_INT);
            $result->bindParam(':order_num', $razdel['order_num'], PDO::PARAM_INT);
            $result->execute();
        }
    }

    public static function sortRazdel($id){
        $razdelList = self::getRazdelList();
        $id = intval($id);
        $counter = 1;
        $razdelSize = sizeof($razdelList);
        for ($i = 0; $i < $razdelSize; $i ++ ){
            if ($id == intval($razdelList[$i]['id']) && $i > 0){
                if ($razdelList[$i-1]['order_num'] == $razdelList[$i]['order_num']){
                    $razdelList[$i-1]['order_num'] = $counter;
                    $razdelList[$i]['order_num'] = $counter-1;
                    $counter++;
                    continue;
                }
            }
            $razdelList[$i]['order_num'] = $counter;
            $counter++;
        }
        self::updateRazdelRows($razdelList);


    }

    public static function checkZapRazdelov($userId){
        $razdelList = self::getRazdelList();
        $zapRazdelList = array();
        foreach ($razdelList as $razdel){
            $taskList = Task::getTasksByRazdelId($razdel['id']);
            $sizeRazdelTasks = sizeof($taskList);
            $razdelZapOtvet = Zap_otvetov::getRigthZapOtvetByRazdelId($userId, $razdel['id']);
            if ($sizeRazdelTasks == $razdelZapOtvet){
                $zapRazdelList[] = $razdel['id'];
            }
        }
        User::updateUsersZapRazdels($userId, $zapRazdelList);



    }
}