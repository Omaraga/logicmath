<?php include ROOT . '/views/layouts/header_task.php'; ?>
    <div class="closeX">
        <a href="/cabinet"><img src="/template/images/razdel/x.png" alt=""></a>
    </div>
    <div class="starX">
        <a href="/progress"><img src="/template/images/razdel/star.png" alt=""></a>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1" id = "task">
                    <div id="activTask" style="display: none;">1</div>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul id="myTab" class="nav nav-tabs">
                                <?php $counterTask = 1;?>
                                <?php foreach ($taskList as $task):?>
                                    <li style="width: <?=100/$size-0.0001;?>%" class="<?=$counterTask == 1? 'firstTask':''?><?=$counterTask == sizeof($taskList)? 'lastTask':''?> <? echo $currTaskId==$task['id']? 'active':'';?> <? echo $task['zap_otvetov'] == false || $task['zap_otvetov']['is_true'] == 0 ?'unsolveTask':'solveTask';?>"><a href="/cabinet/razdel/<? echo $id; ?>/<? echo $task['id'];?>"><?php echo $counterTask;?></a></li>
                                    <? $counterTask++;?>
                                <? endforeach;?>
                            </ul>

                            <div class="taskContent row">
                                <? foreach ($taskList as $task):?>
                                    <div id="panel<?echo $task['id'];?>" style="<?=$currTaskId!=$task['id']? 'display:none;' :''?>;" task-help-text='<?=htmlspecialchars($task["helpText"]);?>' task-solve-text='<?=htmlspecialchars($task["solveText"]);?>'  class="taskBody">
                                        <div class="col-sm-12 scoreBlock">
                                                <span id="score" is-solved="<? echo $task['zap_otvetov'] == false || $task['zap_otvetov']['is_true'] == 0 ?0:1;?>"><? echo $task['zap_otvetov'] == false || $task['zap_otvetov']['is_true'] == 0 ?'<span style="font-size: 15px; color: #843534">Тапсырма шешілмеген<span></span>':'<span id="popytki"><span style="color: #34b44a; font-size: 25px;">'.$task['zap_otvetov']['popytki'].'</span> талпыныстан шешілді   </span><span style="color: #34b44a;font-size: 25px;">'.$task['zap_otvetov']['score'].' </span><i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>';?>
                                        </div>
                                        <div class="row">
<!--                                            <div class="col-sm-12">-->
                                                <? if(intval($task['task_type']) == 1 || intval($task['task_type']) == 2):?>
                                                    <div class="questions" id="question" task-type="test" task-id="<?=$task['id'];?>">
                                                        <h4><? echo $task['title_kz'];?></h4>
                                                        <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/task/".$task['id'].".jpg"; ?>
                                                        <div class="task-main-cont">
                                                            <?if(file_exists($fileName)):?>
                                                                <img src="/upload/images/task/<?=$task['id'];?>.jpg" alt="">
                                                            <?endif;?>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 3):?>
                                                    <div class="questions" id="question" task-type="testClose" task-id="<?=$task['id'];?>">
                                                        <h4><? echo $task['title_kz'];?></h4>
                                                        <?$fileName = $_SERVER['DOCUMENT_ROOT'] ."/upload/images/task/".$task['id'].".jpg"; ?>
                                                        <div class="task-main-cont">
                                                            <?if(file_exists($fileName)):?>
                                                                <img src="/upload/images/task/<?=$task['id'];?>.jpg" alt="">
                                                            <?endif;?>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 4):?>
                                                    <div class="questions" id="question" task-type="sudoku" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <div class="col-sm-6 col-sm-offset-3">
                                                                <?=getTable($task);?>
                                                            </div>
                                                        </div>

                                                    </div>
                                                <?elseif (intval($task['task_type']) == 5):?>
                                                    <div class="questions row" id="question" task-type="sudokuImg" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <div class="col-sm-6 col-sm-offset-3">
                                                                <?=getTableImg($task);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 6):?>
                                                    <?$quesioonArray = getArifQuerstion($task['question'], 6);?>
                                                    <div class="questions row questionType6" id="question" task-type="arifTaskSoZnakami" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <div class="col-sm-12" id="questionType6">
                                                                <?$counter = 0;
                                                                $size = sizeof($quesioonArray);
                                                                $widthDiv = 100/($size + $size + 1);
                                                                ?>
                                                                <?foreach ($quesioonArray as $question):?>
                                                                    <span class="chislo"><?=$question;?></span>
                                                                    <?if($counter < $size - 1):?>
                                                                        <span class="znak" ans-val="" currAns="&nbsp;">
                                                                                &nbsp;
                                                                        </span>
                                                                    <?endif;?>
                                                                    <?$counter++;?>
                                                                <?endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 7):?>
                                                    <?$quesioonArray = getArifQuerstion($task['question'], 7);?>
                                                    <div class="questions row" id="question" task-type="arifTaskSoZnakami" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <div class="col-sm-12" id="questionType7">
                                                                <?$counter = 0;
                                                                $size = sizeof($quesioonArray);
                                                                $widthDiv = 100/($size + $size + 1);
                                                                //                                                        print_r($quesioonArray);
                                                                ?>
                                                                <?foreach ($quesioonArray as $question):?>
                                                                    <span class="chislo">
                                                                        <?if($question == '*'):?>
                                                                            x
                                                                        <?elseif ($question == '/'):?>
                                                                            :
                                                                        <?else:?>
                                                                            <?=$question;?>
                                                                        <?endif;?>
                                                                    </span>
                                                                    <?if($counter < $size - 1):?>
                                                                        <span class="znak" ans-val="" currAns="&nbsp;">&nbsp;</span>
                                                                    <?endif;?>
                                                                    <?$counter++;?>
                                                                <?endforeach;?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 8):?>
                                                    <div class="questions row" id="question" task-type="rebus" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <!--                                                    <div class="col-sm-3 col-sm-offset-4" id="questionType7" style="text-align: right">-->
                                                            <?echo getRebusChislo($task['question'], $task['id']);?>
                                                            <!--                                                    </div>-->
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 9):?>
                                                    <div class="questions row" id="question" task-type="rebus" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <!--                                                    <div class="col-sm-3 col-sm-offset-4" id="questionType7" style="text-align: right">-->
                                                            <?echo getRebusChisloType1($task['question'], $task['id']);?>
                                                            <!--                                                    </div>-->
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 10):?>
                                                    <div class="questions row" id="question" task-type="rebus-figure" task-id="<?=$task['id'];?>">
                                                        <h3><? echo $task['title_kz'];?></h3>
                                                        <div class="task-main-cont">
                                                            <div class="col-sm-12" id="questionType10">
                                                                <?echo getRebusChisloType2($task['question'], $task['id']);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?endif;?>
                                                <div id="blockAnswer" class="row">


                                                <? if(intval($task['task_type']) == 1):?>
                                                    <?$answersSize = sizeof($task['answers']);?>
                                                    <? foreach ($task['answers'] as $answer):?>
                                                        <div class="answers">
                                                            <div class="answer col-sm-<?=12/$answersSize;?> col-xs-6">
                                                                <span class="razdelAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="test">
                                                                    <?=$answer;?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?endforeach;?>
                                                <?elseif (intval($task['task_type']) == 2):?>
                                                    <?$answersSize = sizeof($task['answers']);?>
                                                    <? foreach ($task['answers'] as $answer):?>
                                                        <div class="answers">
                                                            <div class="answer col-sm-<?=12/$answersSize;?> col-xs-6">
                                                                <span class="razdelAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="test">
                                                                    <img src="/upload/images/task/<?=$task['id'].'-'.$answer;?>.jpg" alt="">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    <?endforeach;?>
                                                <?elseif (intval($task['task_type']) == 3):?>
                                                    <input type="text" task-id="<?=$task['id'];?>" task-type="testClose" id="testClose">
                                                <?elseif (intval($task['task_type']) == 4):?>
                                                    <div class="answers">
                                                        <div class="answer col-sm-3 col-sm-offset-4" id="sodoku_input">
                                                            <span class="razdelAns ansChecked" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="sudoku">
                                                                <input type="text"  class="form-control" table-adress="" autofocus>
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 5):?>
                                                    <div class="container">
                                                        <div class="answers row" id="sodoku_input_img">
                                                            <? $ansSize = intval(sqrt(sizeof($task['answers'])));?>
                                                            <? for ($i = 1; $i <= $ansSize; $i++):?>
                                                                <div class="answer col-sm-<?=12/$ansSize;?> col-xs-6">
                                                                            <span class="razdelAnsTableImg" task-id="<?=$task['id'];?>" ans-val="<?=$i;?>" task-type="sudokuImg" table-adress="" img-name="<?=$task['id'].'-'.$i;?>.jpg">
                                                                                <img src="/upload/images/task/<?=$task['id'].'-'.$i;?>.jpg" alt="">
                                                                            </span>
                                                                </div>
                                                            <?endfor;?>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 6):?>
                                                    <div class="container">
                                                        <?$answersSize = sizeof($task['answers']);?>
                                                        <? foreach ($task['answers'] as $answer):?>
                                                            <div class="answers">
                                                                <div class="answer col-sm-<?=12/$answersSize;?> col-xs-6" id="answerType6">
                                                                    <span class="arifAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="arifZnak">
                                                                        <?if($answer == "0"):?>
                                                                            <i class="plus" aria-hidden="true">+</i>
                                                                        <?elseif($answer == "1"):?>
                                                                            <i class="minus" aria-hidden="true">-</i>
                                                                        <?elseif($answer == "2"):?>
                                                                            <i class="delenie" aria-hidden="true">:</i>
                                                                        <?elseif($answer == "3"):?>
                                                                            <i class="times" aria-hidden="true">x</i>
                                                                        <?endif;?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?endforeach;?>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 7):?>
                                                    <div class="container">
                                                        <?$answersSize = sizeof($task['answers']);?>
                                                        <? foreach ($task['answers'] as $answer):?>
                                                            <div class="answers">
                                                                <div class="answer" id="answerType7" style="float: left; width: <?=intval(90/$answersSize);?>%;">
                                                                    <span class="arifAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="arifChislo">
                                                                        <?=$answer;?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?endforeach;?>
                                                        <div class="answer" id="deleteChislo" style="float: left; width: 9%">
                                                                <span class="deleteChislo" task-id="<?=$task['id'];?>" delete-chislo = "">
                                                                    X
                                                                </span>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 8):?>
                                                    <div class="container">
                                                        <?$answers = array("0", "1","2", "3", "4", "5", "6", "7", "8", "9");?>
                                                        <? foreach ($answers as $answer):?>
                                                            <div class="answers">
                                                                <div class="answer" id="answerType7" style="float: left; width: <?=intval(90/sizeof($answers));?>%;">
                                                                    <span class="arifAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="rebus">
                                                                        <?=$answer;?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?endforeach;?>
                                                        <div class="answer" id="deleteChislo" style="float: left; width: 9%">
                                                                <span class="deleteChislo" task-id="<?=$task['id'];?>" delete-chislo = "">
                                                                    X
                                                                </span>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 9):?>
                                                    <div class="container">
                                                        <?$answers = array("0", "1","2", "3", "4", "5", "6", "7", "8", "9");?>
                                                        <? foreach ($answers as $answer):?>
                                                            <div class="answers">
                                                                <div class="answer" id="answerType7" style="float: left; width: <?=intval(90/sizeof($answers));?>%;">
                                                                    <span class="arifAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="rebusChislo">
                                                                        <?=$answer;?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?endforeach;?>
                                                        <div class="answer" id="deleteChislo" style="float: left; width: 9%">
                                                                <span class="deleteChislo" task-id="<?=$task['id'];?>" delete-chislo = "">
                                                                    X
                                                                </span>
                                                        </div>
                                                    </div>
                                                <?elseif (intval($task['task_type']) == 10):?>
                                                    <div class="container">
                                                        <?$answers = array("0", "1","2", "3", "4", "5", "6", "7", "8", "9");?>
                                                        <? foreach ($answers as $answer):?>
                                                            <div class="answers">
                                                                <div class="answer" id="answerType7" style="float: left; width: <?=intval(90/sizeof($answers));?>%;">
                                                                    <span class="arifAns" task-id="<?=$task['id'];?>" ans-val="<?=$answer;?>" task-type="rebus">
                                                                        <?=$answer;?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        <?endforeach;?>
                                                        <div class="answer" id="deleteChislo" style="float: left; width: 9%">
                                                            <span class="deleteChislo" task-id="<?=$task['id'];?>" delete-chislo = "">
                                                                X
                                                            </span>
                                                        </div>
                                                    </div>
                                                <?endif;?>
                                                </div>
<!--                                            </div>-->
                                        </div>
                                    </div>
                                <? endforeach;?>
                            </div>

                        </div>
                        <div class="col-sm-12" id = 'taskResh'>
                            <h2>Дұрыс жарасың!</h2>
                        </div>
                        <div class="decisions col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="decision col-sm-4 col-xs-3" id="help">
                                    <a href="" id="help" data-toggle="modal" data-target="#myModal"><img src="/template/images/razdel/leo_head.png"
                                                                                                         alt="">Көмек</a>
                                </div>
                                <div class="decision col-sm-4 col-xs-3" style="display: none" id="solve">
                                    <a href="" id="solve" data-toggle="modal" data-target="#myModal2">Шешiмi</a>
                                </div>
                                <div class="decision col-sm-4 col-xs-6" id="zhauapBeru">
                                    <a href="" id="checkAns">Жауап беру</a>

                                </div>

                                <div class="decision col-sm-4 col-xs-6" style="display: none" id="kelesiTapsyrma">
                                    <?$nextTask = getNextTask($taskList, $currTaskId);?>

                                    <a href="/cabinet/razdel/<?=$nextTask['razdel_id'];?>/<?=$nextTask['id'];?>" id="kelesiTapsyrma1">Келесi тапсырма</a>

                                </div>
                                <div class="decision col-sm-3 col-xs-3">
                                    <a href="" id="request" data-toggle="modal" data-target="#myModal1"><i class="fa fa-question-circle" aria-hidden="true" style="font-size: 27px"></i></a>
                                </div>
                                <!--                        <div class="decision col-sm-4 visible-xs" style="margin-top: 10px">-->
                                <!--                            <a href="" id="help" data-toggle="modal" data-target="#myModal">Көмек</a>-->
                                <!--                        </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Trigger the modal with a button -->


        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Қосымша мәлімет</h4>

                    </div>
                    <img src="/template/images/razdel/helpLogo.png" alt="" id="helpLogo">
                    <div class="modal-body" id="modalBody" >

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Жабу</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Шешiмi</h4>
                    </div>
                    <div class="modal-body" id="modalBody" >

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Жабу</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title">Бiзбен хабарласу</h4>
                    </div>
                    <div class="modal-body" id="modalBody" >
                        <div class="row">
                            <div class="col-sm-2 imgErr hidden-xs" >
                                <img src="/template/images/razdel/techError.png" alt="">
                            </div>
                            <div class="col-sm-10">
                                <select name="typeError" id="typeError" class="form-control">
                                    <option value="Техникалық қате">Техникалық қате</option>
                                    <option value="Тапсырмада қателік">Тапсырмада қателік</option>
                                    <option value="Тапсырма қиын">Тапсырма қиын</option>
                                </select>
                            </div>
                        </div>
                        
                        <br>
                        <textarea name="message" id="messageError" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Жабу</button>
                        <button type="button" class="btn btn-default" id="sendRequest">Жiберу</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
<?php include ROOT . '/views/layouts/footer_task.php'; ?>