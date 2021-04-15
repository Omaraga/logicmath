<?php


class Request
{
    public static function getRequestList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT * FROM request ORDER BY id ASC');

        // Получение и возврат результатов
        $requestList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $requestList[$i]['id'] = $row['id'];
            $requestList[$i]['user_id'] = $row['user_id'];
            $requestList[$i]['task_id'] = $row['task_id'];
            $requestList[$i]['time'] = $row['time'];
            $requestList[$i]['message'] = $row['message'];
            $i++;
        }
        return $requestList;
    }
    public static function deleteRequestById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM request WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createRequest($user_id, $task_id, $email , $message)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO request (user_id, task_id, email, message) '
            . 'VALUES (:user_id, :task_id, :email, :message)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $result->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }
}