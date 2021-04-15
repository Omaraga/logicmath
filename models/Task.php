<?php


class Task
{


    public static function getTasksByRazdelId($razdelId){
    $db = Db::getConnection();
    // Запрос к БД
    $sql = 'SELECT * FROM task WHERE razdel_id = :id';
    // Используется подготовленный запрос
    $result = $db->prepare($sql);
    $result->bindParam(':id', $razdelId, PDO::PARAM_INT);
    // Указываем, что хотим получить данные в виде массива
    $result->setFetchMode(PDO::FETCH_ASSOC);

    // Выполнение коменды
    $result->execute();
    // Получение и возврат результатов
    $i = 0;
    $taskList = array();
    while ($row = $result->fetch()) {
        $taskList[$i]['id'] = $row['id'];
        $taskList[$i]['title_kz'] = $row['title_kz'];
        $taskList[$i]['title_ru'] = $row['title_ru'];
        $taskList[$i]['task_type'] = $row['task_type'];
        $taskList[$i]['category_id'] = $row['category_id'];
        $taskList[$i]['question'] = $row['question'];
        $taskList[$i]['razdel_id'] = $row['razdel_id'];
        $taskList[$i]['score'] = $row['score'];
        $taskList[$i]['helpText'] = $row['helpText'];
        $taskList[$i]['solveText'] = $row['solveText'];
        $answers = $row['answers'];
        $listAnswers = explode('~', $answers);
        $taskList[$i]['answers'] = $listAnswers;
        $i++;
    }
    return $taskList;
}
    public static function getTasksByRazdelIdShort($razdelId){
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT * FROM task WHERE razdel_id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $razdelId, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        // Получение и возврат результатов
        $i = 0;
        $taskList = array();
        while ($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['razdel_id'] = $row['razdel_id'];
            $taskList[$i]['task_level'] = $row['task_level_id'];
            $taskList[$i]['short_name'] = $row['short_name'];
            $i++;
        }
        return $taskList;
    }

    public static function getFirstTaskIdByRazdelId($razdelId){
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT * FROM task WHERE razdel_id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $razdelId, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();
        $row = $result->fetch();
        // Выполнение коменды
        return $row['id'];
    }

    public static function getRightAnswerList($listTask){
        $rightAnsList = array();
        foreach ($listTask as $task){
            $rightAnsList[$task['id']] = $task['answers'][0];
        }
        return $rightAnsList;
    }

    public static function getTaskList(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM task ORDER BY razdel_id ASC');
        $taskList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['title_kz'] = $row['title_kz'];
            $taskList[$i]['title_ru'] = $row['title_ru'];
            $taskList[$i]['question'] = $row['question'];
            $taskList[$i]['razdel_id'] = $row['razdel_id'];
            $taskList[$i]['answers'] = $row['answers'];
            $taskList[$i]['category_id'] = $row['category_id'];
            $taskList[$i]['score'] = $row['score'];
            $i++;
        }
        return $taskList;
    }

    public static function deleteTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM task WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createTask($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO task '
            . '(title_ru, title_kz, category_id, score, answers, razdel_id, task_type, question, helpText, solveText)'
            . 'VALUES '
            . '(:title_ru, :title_kz, :category_id, :score, :answers, :razdel_id, :task_type, :question, :helpText, :solveText)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title_ru', $options['title_ru'], PDO::PARAM_STR);
        $result->bindParam(':title_kz', $options['title_kz'], PDO::PARAM_STR);
        $result->bindParam(':question', $options['question'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':score', $options['score'], PDO::PARAM_INT);
        $result->bindParam(':answers', $options['answers'], PDO::PARAM_STR);
        $result->bindParam(':razdel_id', $options['razdel_id'], PDO::PARAM_INT);
        $result->bindParam(':task_type', $options['task_type'], PDO::PARAM_INT);
        $result->bindParam(':helpText', $options['helpText'], PDO::PARAM_STR);
        $result->bindParam(':solveText', $options['solveText'], PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function getTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM task WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        $row = $result->fetch();
        $answersStr = $row['answers'];
        $answers = explode('~', $answersStr);
        $row['answers'] = $answers;
        // Получение и возврат результатов
        return $row;
    }


    /**
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateTaskById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                title_ru = :title_ru, 
                title_kz = :title_kz, 
                score = :score, 
                category_id = :category_id, 
                razdel_id = :razdel_id, 
                answers = :answers,
                question = :question,
                helpText = :helpText,
                short_name = :short_name,
                task_level_id = :task_level_id,
                solveText = :solveText
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title_ru', $options['title_ru'], PDO::PARAM_STR);
        $result->bindParam(':title_kz', $options['title_kz'], PDO::PARAM_STR);
        $result->bindParam(':question', $options['question'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':score', $options['score'], PDO::PARAM_INT);
        $result->bindParam(':answers', $options['answers'], PDO::PARAM_STR);
        $result->bindParam(':razdel_id', $options['razdel_id'], PDO::PARAM_INT);
        $result->bindParam(':solveText', $options['solveText'], PDO::PARAM_STR);
        $result->bindParam(':short_name', $options['short_name'], PDO::PARAM_STR);
        $result->bindParam(':task_level_id', $options['task_level'], PDO::PARAM_INT);
        $result->bindParam(':helpText', $options['helpText'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getCountTasksByCategoryId($id){
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT count(id) FROM task WHERE category_id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива

        // Выполнение коменды
        $result->execute();
        $row = $result->fetchColumn();
        // Получение и возврат результатов


        return $row;
    }
    public static function getTaskCategoryById($id){
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT category_id FROM task WHERE id = :id';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива
        // Выполнение коменды
        $result->execute();
        $row = $result->fetch();
        // Получение и возврат результатов


        return $row[0];
    }

    public static function getCountTasks(){
        $db = Db::getConnection();
        // Запрос к БД
        $sql = 'SELECT count(id) FROM task';
        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        // Указываем, что хотим получить данные в виде массива

        // Выполнение коменды
        $result->execute();
        $row = $result->fetchColumn();
        // Получение и возврат результатов


        return $row;
    }


}