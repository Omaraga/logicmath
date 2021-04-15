<?php


class Zap_otvetov
{
    public static function createZapOtvet($userId, $taskId, $score){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO zap_otvetov '
            . '(task_id, user_id, score)'
            . 'VALUES '
            . '(:task_id, :user_id, :score)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':task_id', $taskId, PDO::PARAM_INT);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':score', $score, PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    public static function getZapOtvetByTaskAndUserId($taskId, $userId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM zap_otvetov WHERE task_id = :task_id AND user_id = :user_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':task_id', $taskId, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Обращаемся к записи
        $row = $result->fetch();

        if ($row) {
            // Если запись существует, возвращаем id пользователя
            return $row;
        }
        return false;

    }
    public static function getZapOtvetById($id){
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM zap_otvetov WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        // Обращаемся к записи
        $row = $result->fetch();

        if ($row) {
            // Если запись существует, возвращаем id пользователя
            return $row;
        }
        return false;
    }

    public static function getZapOtvetId($userId, $taskId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM zap_otvetov WHERE task_id = :task_id and user_id = :user_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':task_id', $taskId, PDO::PARAM_INT);

        $result->execute();
        // Обращаемся к записи
        $row = $result->fetch();

        if ($row) {
            // Если запись существует, возвращаем id пользователя
            return $row['id'];
        }
        return false;
    }

    public static function updateZapOtvet($options){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE zap_otvetov
        SET 
            score = :score, 
            is_true = :is_true,   
            popytki = :popytki
        WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);

        $result->bindParam(':score', $options['score'], PDO::PARAM_INT);
        $result->bindParam(':popytki', $options['popytki'], PDO::PARAM_INT);
        $result->bindParam(':is_true', $options['is_true'], PDO::PARAM_INT);
        $result->bindParam(':id', $options['id'], PDO::PARAM_INT);
        return $result->execute();

    }
    public static function getZapOtvetUserId($userId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM zap_otvetov WHERE user_id = :user_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);


        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        $i = 0;
        $listZap = array();
        while($row = $result->fetch()){
            $listZap[$i]['score'] = $row['score'];
            $listZap[$i]['is_true'] = $row['is_true'];
            $listZap[$i]['user_id'] = $row['user_id'];
            $listZap[$i]['task_id'] = $row['task_id'];
            $categoryId = Task::getTaskCategoryById($row['task_id']);
            $listZap[$i]['category_id'] = intval($categoryId);
            $i++;
        }
        if (sizeof($listZap) != 0){
            return $listZap;
        }else{
            return false;
        }




    }
    public static function getRightZapOtvetUserId($userId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM zap_otvetov WHERE user_id = :user_id and is_true = 1';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);


        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        $i = 0;
        $listZap = array();
        while($row = $result->fetch()){
            $listZap[$i]['score'] = $row['score'];
            $listZap[$i]['is_true'] = $row['is_true'];
            $listZap[$i]['user_id'] = $row['user_id'];
            $listZap[$i]['task_id'] = $row['task_id'];
            $categoryId = Task::getTaskCategoryById($row['task_id']);
            $listZap[$i]['category_id'] = intval($categoryId);
            $i++;
        }
        if (sizeof($listZap) != 0){
            return $listZap;
        }else{
            return false;
        }




    }
    public static function getRigthZapOtvetByCategoryId($userId, $categoryId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(*) FROM zap_otvetov inner join task on zap_otvetov.task_id = task.id WHERE zap_otvetov.user_id = :user_id AND task.category_id = :category_id';
        $categoryId = intval($categoryId);
        $userId = intval($userId);
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);

        $result->execute();
        $row = $result->fetchColumn();
        return $row;




    }
    public static function getRigthZapOtvetByRazdelId($userId, $razdelId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(*) FROM zap_otvetov inner join task on zap_otvetov.task_id = task.id WHERE zap_otvetov.user_id = :user_id AND task.razdel_id = :razdel_id and zap_otvetov.is_true = 1';
        $razdelId = intval($razdelId);
        $userId = intval($userId);
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $result->bindParam(':razdel_id', $razdelId, PDO::PARAM_INT);

        $result->execute();
        $row = $result->fetchColumn();
        return $row;
    }
}
