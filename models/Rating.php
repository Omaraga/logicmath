<?php


class Rating
{
    const PAGE_DEFAULT = 10;
    public static function updateRatingList($user_id){
        $zapOtvetov = Zap_otvetov::getZapOtvetUserId($user_id);
        $total_score = 0;
        // Соединение с БД
        $db = Db::getConnection();
        if ($zapOtvetov!=false){
            foreach ($zapOtvetov as $otvet){
                $is_right = intval($otvet['is_true']);
                if ($is_right == 1){
                    $score = intval($otvet['score']);
                    $total_score+=$score;
                }
            }
        }
        $rating = self::getRatingByUserId($user_id);
        if ($rating != false){
            // Текст запроса к БД
            $sql = "UPDATE rating
                        SET 
                            score = :score
                        WHERE id = :id";
            $id = intval($rating['id']);
            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':score', $total_score, PDO::PARAM_INT);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        }else{
            // Текст запроса к БД
            $sql = 'INSERT INTO rating '
                . '(user_id, score)'
                . 'VALUES '
                . '(:user_id, :score)';

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':score', $total_score, PDO::PARAM_INT);
            $result->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $result->execute();
        }

    }
    public static function updateRatingPlace($country = null, $city = null, $school = null){
        if (isset($country) && $country != null){
            $ratingList  = self::getFullRatingList($country, null, null);
        }elseif (isset($city) && $city != null){
            $ratingList  = self::getFullRatingList(null, $city, null);
        }elseif (isset($school) && $school != null){
            $ratingList  = self::getFullRatingList(null, null, $school);
        }else{
            $ratingList  = self::getFullRatingList();
        }
        foreach ($ratingList as $rating){
            self::updateRatingList($rating['user_id']);
        }
        $klassList = Klass::getKlassList();
        $placeList = array();
        foreach ($klassList as $klass){
            $placeList[$klass['id']] = 1;
        }
        foreach ($ratingList as $rating){
            $userId = $rating['user_id'];
            $user = User::getUserById($userId);
            $userKlassId = intval($user['klass_id']);
            $placeNum = $placeList[$userKlassId];
            if (isset($country) && $country != null){
                self::updateRatingPlaceById($rating['id'], $placeNum, 1);
            }elseif (isset($city) && $city != null){
                self::updateRatingPlaceById($rating['id'], $placeNum, 2);
            }elseif (isset($school) && $school != null){
                self::updateRatingPlaceById($rating['id'], $placeNum, 3);
            }else{
                self::updateRatingPlaceById($rating['id'], $placeNum);
            }

            $placeNum ++;
            $placeList[$userKlassId] = $placeNum;
        }



    }
    public static function updateRatingPlaceById($id, $place, $type = 0){
        // Текст запроса к БД
        $db = Db::getConnection();
        if ($type == 1){
            $sql = "UPDATE rating
                        SET 
                            country_place = :place
                        WHERE id = :id";
        }elseif ($type == 2){
            $sql = "UPDATE rating
                        SET 
                            city_place = :place
                        WHERE id = :id";
        }elseif ($type == 3){
            $sql = "UPDATE rating
                        SET 
                            school_place = :place
                        WHERE id = :id";
        }else{
            $sql = "UPDATE rating
                        SET 
                            place = :place
                        WHERE id = :id";
        }


        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':place', $place, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function getFullRatingList($country = null, $city = null, $school = null){
        $db = Db::getConnection();
        if (isset($country) && $country != null){
            $sql = 'SELECT rating.id, rating.user_id, rating.score FROM rating inner join user on rating.user_id = user.id where user.country_id = :country_id  ORDER BY score DESC';
            $result = $db->prepare($sql);
            $result->bindParam(':country_id', $country, PDO::PARAM_INT);
        }elseif (isset($city) && $city != null){
            $sql = 'SELECT rating.id, rating.user_id, rating.score FROM rating inner join user on rating.user_id = user.id where user.city_id = :city_id  ORDER BY score DESC';
            $result = $db->prepare($sql);
            $result->bindParam(':city_id', $city, PDO::PARAM_INT);
        }elseif (isset($school) && $school != null){
            $sql = 'SELECT rating.id, rating.user_id, rating.score FROM rating inner join user on rating.user_id = user.id where user.school_id = :school_id ORDER BY score DESC';
            $result = $db->prepare($sql);
            $result->bindParam(':school_id', $school, PDO::PARAM_STR);
        }else{
            $sql = 'SELECT * FROM rating ORDER BY score DESC';
            // Используется подготовленный запрос
            $result = $db->prepare($sql);
        }


        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $ratingList = array();
        while ($row = $result->fetch()) {
            $ratingList[$i]['id'] = $row['id'];
            $ratingList[$i]['user_id'] = $row['user_id'];
            $userAndCity = User::getFioAndCityByUserId($row['user_id']);
            $ratingList[$i]['fio'] = $userAndCity['fio'];
            $ratingList[$i]['city'] = $userAndCity['city'];
            $ratingList[$i]['score'] = $row['score'];
            $i++;
        }
        return $ratingList;
    }
    public static function getRatingList($page = 1, $country = 0, $klass_id, $city_id = 0, $school_id = 0){
        $db = Db::getConnection();
        $klass_id = intval($klass_id);
        $country = intval($country);
        $offset = ($page - 1)*self::PAGE_DEFAULT;
        if ($country == 0) {
            $sql = 'SELECT * FROM rating inner join user on rating.user_id = user.id WHERE user.klass_id = :klass_id ORDER BY rating.score DESC LIMIT ' . self::PAGE_DEFAULT . ' OFFSET ' . $offset;
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
        }elseif ($country == -1){
            $sql = 'SELECT * FROM rating inner join user on rating.user_id = user.id where user.city_id = :city_id and user.klass_id = :klass_id ORDER BY score DESC LIMIT '.self::PAGE_DEFAULT.' OFFSET '.$offset;
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
            $result->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        }elseif ($country == -2){
            $sql = 'SELECT * FROM rating inner join user on rating.user_id = user.id where user.school_id = :school_id and user.klass_id = :klass_id ORDER BY score DESC LIMIT '.self::PAGE_DEFAULT.' OFFSET '.$offset;
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
            $result->bindParam(':school_id', $school_id, PDO::PARAM_INT);

        }else{
            $sql = 'SELECT * FROM rating inner join user on rating.user_id = user.id where user.country_id = :country_id and user.klass_id = :klass_id ORDER BY score DESC LIMIT '.self::PAGE_DEFAULT.' OFFSET '.$offset;
            $result = $db->prepare($sql);
            $result->bindParam(':country_id', $country, PDO::PARAM_INT);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
        }


        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $ratingList = array();
        while ($row = $result->fetch()) {
            $ratingList[$i]['id'] = $row['id'];
            $ratingList[$i]['user_id'] = $row['user_id'];
            $userAndCity = User::getFioAndCityByUserId($row['user_id']);
            $ratingList[$i]['fio'] = $userAndCity['fio'];
            $ratingList[$i]['city'] = $userAndCity['city'];
            $ratingList[$i]['score'] = $row['score'];
            $ratingList[$i]['place'] = $row['place'];
            $ratingList[$i]['school_place'] = $row['school_place'];
            $ratingList[$i]['city_place'] = $row['city_place'];
            $ratingList[$i]['country_place'] = $row['country_place'];
            $i++;
        }
        return $ratingList;
    }
    public static function getRatingByUserId($userId){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM rating WHERE user_id = :user_id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        $row = $result->fetch();

        // Получение и возврат результатов
        if ($row){
            return $row;
        }else{
            return false;
        }

    }
    public static function getTotalRating($key, $param, $klass_id){
        $db = Db::getConnection();
        // Запрос к БД
        if ($key == -2){
            $sql = 'SELECT count(*) FROM rating inner join user on rating.user_id = user.id WHERE user.klass_id = :klass_id and user.school_id = :school_id';
            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
            $result->bindParam(':school_id', $param, PDO::PARAM_INT);
        }elseif ($key == -1){
            $sql = 'SELECT count(*) FROM rating inner join user on rating.user_id = user.id WHERE user.klass_id = :klass_id and user.city_id = :city_id';
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
            $result->bindParam(':city_id', $param, PDO::PARAM_INT);
        }elseif($key == 0){
            $sql = 'SELECT count(*) FROM rating inner join user on rating.user_id = user.id WHERE user.klass_id = :klass_id and user.country_id = :country_id';
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
            $result->bindParam(':country_id', $param, PDO::PARAM_INT);
        }else{
            $sql = 'SELECT count(*) FROM rating inner join user on rating.user_id = user.id WHERE user.klass_id = :klass_id';
            $result = $db->prepare($sql);
            $result->bindParam(':klass_id', $klass_id, PDO::PARAM_INT);
        }



        // Указываем, что хотим получить данные в виде массива

        // Выполнение коменды
        $result->execute();
        $row = $result->fetchColumn();
        // Получение и возврат результатов


        return $row;
    }

}