<?php


class Certificate
{
    public static function getCertificateListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Запрос к БД
        $result = $db->query('SELECT * FROM certificate ORDER BY id ASC');

        // Получение и возврат результатов
        $certList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $certList[$i]['id'] = $row['id'];
            $certList[$i]['name_ru'] = $row['name_ru'];
            $certList[$i]['name_kz'] = $row['name_kz'];
            $certList[$i]['count_task'] = $row['count_task'];
            $i++;
        }
        return $certList;
    }


    public static function deleteCertificateById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM certificate WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    public static function updateCertificateById($id, $name_ru, $name_kz, $count_task)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE certificate
            SET 
                name_kz = :name_kz, 
                name_ru = :name_ru,
                count_task = :count_task
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name_kz', $name_kz, PDO::PARAM_STR);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':count_task', $count_task, PDO::PARAM_INT);
        return $result->execute();
    }


    public static function getCertificateById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM certificate WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }



    public static function createCertificate($name_ru, $name_kz, $count_task)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO certificate (name_kz, name_ru, count_task) '
            . 'VALUES (:name_kz, :name_ru, :count_task)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name_ru', $name_ru, PDO::PARAM_STR);
        $result->bindParam(':name_kz', $name_kz, PDO::PARAM_STR);
        $result->bindParam(':count_task', $count_task, PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
    }
    public static function checkAproveCertificate($userId){
        $certList = self::getCertificateListAdmin();
        $user = User::getUserById($userId);
        if (isset($user['certificate_ids']) && strlen($user['certificate_ids']) > 0){
            $myCerts = explode('~', $user['certificate_ids']);
        }else{
            $myCerts = array();
        }
        $myCertsSize = sizeof($myCerts);
        $zap_otvetov = Zap_otvetov::getRightZapOtvetUserId($userId);
        $sizeZapOtv = sizeof($zap_otvetov);
        foreach ($certList as $cert){
            if (!in_array($cert['id'], $myCerts)){
                $countTask = $cert['count_task'];
                if ($sizeZapOtv >= $countTask){
                    $myCerts[] = $cert['id'];
                    self::createCertificateFile($userId, $cert['id']);
                }
            }
        }
//        print_r($myCerts);
        if (sizeof($myCerts) != $myCertsSize){
            User::updateUsersCerts($userId, $myCerts);
        }
    }
    public static function createCertificateFile($userId, $certId)
    {
        $user = User::getUserById($userId);
        $surname = $user['surname'];
        $name = $user['name'];
        $fio = $surname." ".$name;
        $img= $_SERVER['DOCUMENT_ROOT'] . "/upload/images/certs/".$certId.".jpg";
        $pic = ImageCreateFromjpeg($img); //открываем рисунок в формате JPEG
        $color=ImageColorAllocate($pic, 0, 0, 0); //получаем идентификатор цвета
        /* определяем место размещения текста по вертикали и горизонтали */
        $h = 1300; //высота
        $w = 1150; //ширина
        /* выводим текст на изображение */
        ImageTTFtext($pic, 100, 0, $w, $h, $color, $_SERVER['DOCUMENT_ROOT'] ."/template/fonts/vAsylm02.ttf", $fio);
//            ImageTTFtext($pic, 26, 0, $w-50, $h+65, $color, "/template/fonts/Roboto-Black.ttf", time());
        Imagejpeg($pic,$_SERVER['DOCUMENT_ROOT'] . "/upload/certificates/".$userId."_".$certId.".jpg"); //сохраняем рисунок в формате JPEG
        ImageDestroy($pic); //освобождаем память и закрываем изображение
    }

}