<?php


class RazdelController
{
    public function actionIndex($id, $currTaskId)
    {
        function getTwoLevelArray($array, $size, $colSize){
            $newArray = array();
            $j = -1;
            $k = 0;
            for ($i = 0; $i < $size; $i++){
                if($i % $colSize == 0){
                    $j++;
                    $k = 0;
                }else{
                    $k++;
                }
                $newArray[$j][$k] = intval($array[$i]);
            }
            return $newArray;
        }
        function getTable($task){
            $ansArray = $task['answers'];
            $quesArray = explode('~', $task['question']);
            $size = intval(sizeof($ansArray));
            $colSize = intval(sqrt($size));
            $table = "<table class='table table-bordered' id='taskSudoku'>";
            $ansArray = getTwoLevelArray($ansArray, $size, $colSize);
            $quesArray = getTwoLevelArray($quesArray, $size, $colSize);
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    if ($quesArray[$i][$j] == 0){
                        $table = $table . '<td class="checkMe" adress="'.$i.'-'.$j.'"></td>';
                    }else{
                        $table = $table . '<td>'.$ansArray[$i][$j].'</td>';
                    }
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            return $table;
        }
        function getTableImg($task){
            $ansArray = $task['answers'];
            $id = $task['id'];
            $quesArray = explode('~', $task['question']);
            $size = intval(sizeof($ansArray));
            $colSize = intval(sqrt($size));
            $table = "<table class='table table-bordered' id='taskSudokuImg'>";
            $ansArray = getTwoLevelArray($ansArray, $size, $colSize);
            $quesArray = getTwoLevelArray($quesArray, $size, $colSize);
            $width = 100/$colSize;
            for ($i = 0; $i < $colSize; $i++) {
                $table = $table .'<tr>';
                for($j = 0; $j < $colSize; $j++){
                    if ($quesArray[$i][$j] == 0){
                        $table = $table . '<td class="checkMeImg" adress="'.$i.'-'.$j.'" ans-val="" style="width: '.$width.'%"></td>';
                    }else{
                        $table = $table . '<td ans-val="'.$ansArray[$i][$j].'" style="width: '.$width.'%"><img alt="" src="/upload/images/task/'.$id.'-'.$ansArray[$i][$j].'.jpg"></td>';
                    }
                }
                $table = $table . '</tr>';
            }
            $table = $table . "</table>";
            return $table;
        }
        function getNextTask($taskList, $taskId){
            $needTask = false;
            foreach ($taskList as $task){
                if ($needTask != false){
                    $needTask = $task;
                    break;
                }

                if ($taskId == $task['id']){
                    $needTask = $task;
                }
            }
            return $needTask;


        }
        function getArifQuerstion($question, $type){
            $size = strlen($question);
            if ($type == 6){
                $znaks = array("+","-","*","/");
                $str = str_replace($znaks, "~", $question);
                $questionArray = explode("~", $str);
                return $questionArray;
            }elseif ($type == 7){
                $znaks = array("0","1","2","3","4", "5", "6", "7", "8", "9");
                $str = str_replace($znaks, "~", $question);
                $questionArray = explode("~", $str);
                return $questionArray;
            }

        }
        function getMinLength($question){
            $minLen = 50000;
            foreach ($question as $item){
                if ($item == "+" || $item == "-" || $item == "X" || $item == "/" || $item == "="){
                    continue;
                }
                $item = mb_substr($item, 0,null,"UTF-8");
                if ($minLen > mb_strlen($item)){
                    $minLen = mb_strlen($item);
                }
            }
            return $minLen;
        }
        function getMaxLength($question){
            $maxLen = 0;
            foreach ($question as $item){
                $item = mb_substr($item, 0,null,"UTF-8");
                if ($maxLen < mb_strlen($item)){
                    $maxLen = mb_strlen($item);
                }
            }
            return $maxLen;
        }

        function getMargin($minLen, $len){
            $size = 15;
            return ($len-$minLen)*$size;
        }
        function getRebusChislo($question, $id){
            $question = explode('~', $question);
            $rebusChisloHtml = "";
            $colorsKode = array('#73ebff', '#ff54fe', '#226a', '#9aff65', '#ff913a', '#df3500','#ff999f', '#fff', "#c1fffe", "#ffe1dc", "#0de4dc");
            shuffle($colorsKode);
            $colorKoreCounter = 0;
            $colors = array();
            $minLen = getMinLength($question);
            $maxLen = getMaxLength($question);
            if ($maxLen > 4){
                $znakMargin = $maxLen*15+5;
                $znakMargin1 = $znakMargin + 5;
            }elseif($maxLen > 3){
                $znakMargin = $maxLen*20+5;
                $znakMargin1 = $znakMargin + 5;
            }else{
                $znakMargin = $maxLen*15+5;
                $znakMargin1 = $znakMargin + 25;
            }
            foreach ($question as $item){
                if ($item == "+" || $item == "-" || $item == "X" || $item == "/" || $item == "="){
                    if ($item == '='){
                        $rebusChisloHtml .= '<span class="rebusOtv rebusZnak rebusEqual" ans-val="'.$item.'" style="width:'.($znakMargin1).'%;">'.''. '</span><br>';
                    }else{
                        $rebusChisloHtml .= '<span class="rebusOtv rebusZnak" ans-val="'.$item.'" style="margin-right:'.$znakMargin.'%;">'.$item . '</span><br>';
                    }

                }else {
                    $item = mb_substr($item, 0,null,"UTF-8");
                    $itemLen = mb_strlen($item);
                    for ($i = 0; $i < mb_strlen($item); $i++) {
                        $key = mb_substr($item, $i, 1, "UTF-8");
                        if (isset($colors[$key])){
                            $color = $colors[$key];
                        }else{
                            $colors[$key] = $colorsKode[$colorKoreCounter];
                            $color = $colorsKode[$colorKoreCounter];
                            $colorKoreCounter++;
                        }
                        if ($i == $itemLen - 1){
                            $margin = getMargin($minLen, $itemLen);
                            $rebusChisloHtml .= '<span task-cell-type="rebus" style= "background-color:'.$color.';" class="znak rebusOtv" ans-val="" currAns="'.$key.'" task-id="'.$id.'" attr-color="'.$color.'">'.$key.'</span>';
                        }else{
                            $rebusChisloHtml .= '<span task-cell-type="rebus" style= "background-color:'.$color.'" class="znak rebusOtv" ans-val="" currAns="'.$key.'" task-id="'.$id.'" attr-color="'.$color.'">'.$key.'</span>';
                        }


                    }
                    $rebusChisloHtml .= '<br>';
                }
            }
            if ($maxLen > 4){
                $rebusChisloHtml = '<div class="col-sm-4 col-sm-offset-4 col-xs-5 col-xs-offset-4" id="questionType7" style="text-align: right">'.$rebusChisloHtml.'</div>';
            }else{
                $rebusChisloHtml = '<div class="col-sm-3 col-sm-offset-4 col-xs-4 col-xs-offset-4" id="questionType7" style="text-align: right">'.$rebusChisloHtml.'</div>';
            }
            //            print_r($colors);
            return $rebusChisloHtml;
        }
        function getRebusChisloType1($question, $id){
            $question = explode('~', $question);
            $rebusChisloHtml = "";
            $minLen = getMinLength($question);
            $maxLen = getMaxLength($question);
            if ($maxLen > 4){
                $znakMargin = $maxLen*15+5;
                $znakMargin1 = $znakMargin + 5;
            }elseif($maxLen > 3){
                $znakMargin = $maxLen*20+5;
                $znakMargin1 = $znakMargin + 5;
            }else{
                $znakMargin = $maxLen*15+5;
                $znakMargin1 = $znakMargin + 25;
            }

            foreach ($question as $item){
                if ($item == "+" || $item == "-" || $item == "X" || $item == "/" || $item == "="){
                    if ($item == '='){

                        $rebusChisloHtml .= '<span class="rebusOtv rebusZnak rebusEqual" ans-val="'.$item.'" style="width:'.($znakMargin1).'%;">'.''. '</span><br>';
                    }else{

                        $rebusChisloHtml .= '<span class="rebusOtv rebusZnak" ans-val="'.$item.'" style="margin-right:'.$znakMargin.'%;">'.$item . '</span><br>';
                    }
                }else {
                    $item = mb_substr($item, 0,null,"UTF-8");
                    $itemLen = mb_strlen($item);
                    for ($i = 0; $i < mb_strlen($item); $i++) {
                        $key = mb_substr($item, $i, 1, "UTF-8");
                        if ($key != "*") {
                            if ($i == $itemLen - 1) {
                                $margin = getMargin($minLen, $itemLen);
                                $rebusChisloHtml .= '<span task-cell-type="rebusChislo" style= "border:1px solid #e5c9f5;" class="znakChislo rebusOtv" ans-val="'.$key.'" currAns="'.$key.'" task-id="' . $id . '">' . $key . '</span>';
                            } else {
                                $rebusChisloHtml .= '<span task-cell-type="rebusChislo"  class="znakChislo rebusOtv" ans-val="'.$key.'" currAns="'.$key.'" task-id="' . $id . '" style="border:1px solid #e5c9f5;">' . $key . '</span>';
                            }
                        }else{
                            if ($i == $itemLen - 1) {
                                $margin = getMargin($minLen, $itemLen);
                                $rebusChisloHtml .= '<span task-cell-type="rebusChislo" style= "" class="znak rebusOtv" ans-val="" currAns="&nbsp;" task-id="' . $id . '">&nbsp;</span>';
                            } else {
                                $rebusChisloHtml .= '<span task-cell-type="rebusChislo"  class="znak rebusOtv" ans-val="" currAns="&nbsp;" task-id="' . $id . '">&nbsp;</span>';
                            }
                        }

                    }
                    $rebusChisloHtml .= '<br>';
                }
            }
            if ($maxLen > 4){
                $rebusChisloHtml = '<div class="col-sm-4 col-sm-offset-4 col-xs-5 col-xs-offset-4" id="questionType7" style="text-align: right">'.$rebusChisloHtml.'</div>';
            }else{
                $rebusChisloHtml = '<div class="col-sm-3 col-sm-offset-4 col-xs-4 col-xs-offset-4" id="questionType7" style="text-align: right">'.$rebusChisloHtml.'</div>';
            }
//            print_r($colors);
            return $rebusChisloHtml;
        }
        function getRebusChisloType2($question, $id){

            $question = explode('~', $question);

            $rebusChisloHtml = "";
            $colorsKode = array('circle.png', 'hexagon.png', 'octagon.png', 'pentagon.png', 'romb.png', 'square.png','squarecircle.png', 'trapecia.png', "triangle.png");
//            shuffle($colorsKode);
            $colorKoreCounter = 0;
            $colors = array();
            foreach ($question as $item){

                for ($i = 0; $i < strlen($item); $i++) {
                    $key = substr($item, $i, 1);
//                    echo $key;
                    if ($key == '+'  || $key == '-'  || $key == '*'  || $key == '/'  || $key == '='){
                        $rebusChisloHtml .= '<span class="rebusOtv rebusFigureZnak" ans-val="'.$key.'">'.$key. '</span>';
                    }else{
                        if (isset($colors[$key])){
                            $color = $colors[$key];
                        }else{
                            $colors[$key] = $colorsKode[$colorKoreCounter];
                            $color = $colorsKode[$colorKoreCounter];
                            $colorKoreCounter++;
                        }
                        if ($i == strlen($item) - 1){
                            $rebusChisloHtml .= '<span task-cell-type="rebus" attr-is-last = "1" style= "background-image: url(\'/template/images/figures/'.$color.'\');" class="znak rebusOtv" ans-val="" currAns="&nbsp;" task-id="'.$id.'" attr-color="'.$color.'">&nbsp;</span>';
                        }else{
                            $rebusChisloHtml .= '<span task-cell-type="rebus" attr-is-last = "0" style= "background-image: url(\'/template/images/figures/'.$color.'\');" class="znak rebusOtv" ans-val="" currAns="&nbsp;" task-id="'.$id.'" attr-color="'.$color.'">&nbsp;</span>';
                        }
                    }

                }
                $rebusChisloHtml .= '<br><br>';

            }
            return $rebusChisloHtml;
        }
        $id = intval($id);
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        $taskList = Task::getTasksByRazdelId($id);
        for ($i = 0; $i < sizeof($taskList); $i++){
            $zapOtvet = Zap_otvetov::getZapOtvetByTaskAndUserId($taskList[$i]['id'], $userId);
            $taskList[$i]['zap_otvetov'] = $zapOtvet;
        }
        if (!isset($taskList) || empty($taskList) || sizeof($taskList)==0){
            header("Location: /cabinet");
        }
        if (!isset($currTaskId)){
            $currTaskId = intval($taskList[0]['id']);
        }
        $rightAnsList = Task::getRightAnswerList($taskList);
        $i = 0;
        $size = sizeof($taskList);
        while ($i < $size){
            $answers = $taskList[$i]['answers'];
            if (intval($taskList[$i]['task_type']) == 1 || intval($taskList[$i]['task_type']) == 2){
                shuffle($answers);
                $taskList[$i]['answers'] = $answers;
            }

            $i++;
        }

//        print_r($taskList);

//        print_r($rightAnsList);

        // Подключаем вид
        Razdel::checkZapRazdelov($userId);
        require_once(ROOT . '/views/razdel/index.php');
        return true;
    }
    public function actionCheckAns(){
        function getArifQuerstion($question, $type){
            $size = strlen($question);
            if ($type == 6){
                $znaks = array("+","-","*","/");
                $str = str_replace($znaks, "~", $question);
                $questionArray = explode("~", $str);
                return $questionArray;
            }elseif ($type == 7){
                $znaks = array("0","1","2","3","4", "5", "6", "7", "8", "9");
                $str = str_replace($znaks, "~", $question);
                return $str;
            }

        }
        $taskId = intval($_POST['task']);
        $answer = $_POST['answer'];
        $userId = intval(User::checkLogged());
        $task = Task::getTaskById($taskId);
        $taskType = intval($task['task_type']);
        $taskAnswers = $task['answers'];
        if ($taskType == 1 || $taskType == 2 || $taskType == 3){
            $rightAns = $taskAnswers[0];
        }elseif ($taskType == 4 || $taskType == 5){
            $rightAns = implode('~', $taskAnswers);
        }elseif ($taskType == 6){
            $question = $task['question'];
            $leftRight = explode("=", $question);
            $left = $leftRight[0];
            $right = $leftRight[1];
            $left = getArifQuerstion($left, 6);
            $rightSize = sizeof($right);
            $leftSize = sizeof($left);
            $right = getArifQuerstion($right, 6);
            $answerList = explode("~", $answer);
            $counterLeft = 0;
            $counterRight = 0;
            $counterZnak = 0;
            $leftSum = $left[0];
            $rightSum = $right[0];
            foreach ($left as $item){
                if ($counterLeft == 0){
                    $counterLeft++;
                    continue;
                }
                $currZnak = $answerList[$counterZnak];
                if ($currZnak == '0'){
                    $leftSum.='+'.$item;
                }elseif ($currZnak == '1'){
                    $leftSum.='-'.$item;
                }elseif ($currZnak == '2'){
                    $leftSum.='/'.$item;
                }elseif ($currZnak == '3'){
                    $leftSum.='*'.$item;
                }
                if ($counterLeft < $leftSize){
                    $counterZnak++;
                    $counterLeft++;
                }
            }
            foreach ($right as $item){
                if ($counterRight == 0){
                    $counterRight++;
                    continue;
                }
                $currZnak = $answerList[$counterZnak];
                if ($currZnak == '0'){
                    $rightSum.='+'.$item;
                }elseif ($currZnak == '1'){
                    $rightSum.='-'.$item;
                }elseif ($currZnak == '2'){
                    $rightSum.='/'.$item;
                }elseif ($currZnak == '3'){
                    $rightSum.='*'.$item;
                }
                if ($counterRight < $rightSize){
                    $counterZnak++;
                    $counterLeft++;
                }
            }

            $leftSum = '$leftSum = '.$leftSum.';';
            eval($leftSum);
            $rightSum = '$rightSum = '.$rightSum.';';
            eval($rightSum);
            $answer = $leftSum;
            $rightAns = $rightSum;
        }elseif ($taskType == 7){
            $question = $task['question'];
            $leftRight = explode("=", $question);
            $left = $leftRight[0];
            $right = $leftRight[1];
            $left = getArifQuerstion($left, 7);
            $right = getArifQuerstion($right, 7);
            $answerList = explode("~", $answer);
            $counterDigit = 0;
            $isHasAllVal = true;
            foreach ($answerList as $item){
                if($item == '_'){
                    $isHasAllVal = false;
                    break;
                }
            }
            if ($isHasAllVal){
                while (true){
                    $pos = strpos($left, '~');
                    if ($pos > -1){
                        $left = substr_replace($left, $answerList[$counterDigit], $pos, 1);
                        $counterDigit++;
                    }else{
                        break;
                    }
                }
                while (true){
                    $pos = strpos($right, '~');
                    if ($pos > -1){
                        $right = substr_replace($right, $answerList[$counterDigit], $pos, 1);
                        $counterDigit++;
                    }else{
                        break;
                    }
                }
                $leftSum = '';
                $rightSum = '';



                $leftSum = '$leftSum = '.$left.';';
                eval($leftSum);
                $rightSum = '$rightSum = '.$right.';';
                eval($rightSum);
                $answer = $leftSum;
                $rightAns = $rightSum;
            }else{
                $answer = 0;
                $rightAns = 1;
            }

        }elseif ($taskType == 8){
            $rightAns = $taskAnswers[0];
        }elseif ($taskType == 9){
            $answerList = explode('=', $answer);
            $left = $answerList[0];
            $right = $answerList[1];
            $znaks = array("X");
            $left = str_replace($znaks, "*", $left);
            $leftSum = '$leftSum = '.$left.';';
            eval($leftSum);
            $rightSum = '$rightSum = '.$right.';';
            eval($rightSum);
            $answer = $leftSum;
            $rightAns = $rightSum;
        }elseif ($taskType == 10){
            $answers = explode('~', $answer);
            $rightAns = 1;
            $isRigthRebus = 1;
            foreach ($answers as $answerItem){
                $answerList = explode('=', $answerItem);
                $left = $answerList[0];
                $right = $answerList[1];
                $leftSum = '$leftSum = '.$left.';';
                eval($leftSum);
                $rightSum = '$rightSum = '.$right.';';
                eval($rightSum);
                if ($leftSum != $rightSum){
                    $isRigthRebus = 0;
                }
            }

            $answer = $isRigthRebus;
        }elseif ($taskType == 11){
            $answer = $_POST['answer'];
            $rightAns = $taskAnswers[0];
        }
        $taskScore = $task['score'];
        $zapOtvetId = Zap_otvetov::getZapOtvetId($userId, $taskId);
        if ($zapOtvetId == false){
            $zapOtvetId = intval(Zap_otvetov::createZapOtvet($userId, $taskId, $taskScore));
            $zapOtvet = Zap_otvetov::getZapOtvetById($zapOtvetId);
            $score = intval($taskScore);
            $popytki = 0;
            $isConfirmed = 0;
        }else{
            $zapOtvet = Zap_otvetov::getZapOtvetById($zapOtvetId);
            $score = intval($zapOtvet['score']);
            $popytki = intval($zapOtvet['popytki']);
            $isConfirmed = intval($zapOtvet['is_true']);
        }
        if ($answer == $rightAns){
            $isRight = 1;
        }else{
            $isRight = 0;
            if ($isConfirmed == 0){
                $score -= 10;
            }
        }
        if ($score <= 10){
            $score = 10;
        }
        if ($isConfirmed == 0){
            $popytki++;
        }




        $options = array();
        $options['id'] = $zapOtvetId;
        $options['score'] = $score;
        $options['is_true'] = $isRight;
        $options['popytki'] = $popytki;
        if ($isConfirmed == 0){
            Zap_otvetov::updateZapOtvet($options);
            Razdel::checkZapRazdelov($userId);
        }



        $jsonOtvet = array();
        $jsonOtvet['task_id'] = $taskId;
        $jsonOtvet['is_right'] = $isRight;
        $jsonOtvet['popytki'] = $popytki;
        $jsonOtvet['score'] = $score;
        $jsonOtvet['zap'] = $zapOtvetId;
        $jsonOtvet['user'] = $userId;
//        $jsonOtvet['answer'] = $answer;
//        $jsonOtvet['rightAns'] = $rightAns;




        echo json_encode($jsonOtvet);

        return true;
    }
}