
</div>
<div id="animate-star" style="display: none; position: absolute; z-index: 100000; left: 30%;"><img src="/template/images/home/star-min.png" alt=""></div>



<script src="/template/js/jquery.js"></script>
<!--<script src="/template/js/jquery.cycle2.min.js"></script>-->
<!--<script src="/template/js/jquery.cycle2.carousel.min.js"></script>-->
<script src="/template/js/bootstrap.min.js"></script>
<!--<script src="/template/js/jquery.scrollUp.min.js"></script>-->
<!--<script src="/template/js/price-range.js"></script>-->
<!--<script src="/template/js/jquery.prettyPhoto.js"></script>-->
<!--<script src="/template/js/main.js"></script>-->
<script>
    $("#help").click(function (e) {
        var url = document.location.href;
        var urlA = url.split('/');
        var taskId = parseInt(urlA[urlA.length-1]);
        var help = $("#panel"+taskId).attr('task-help-text')
        // <img src = "1.jpg" onerror = "this.style.display = 'none'">
        var text = "<h3>"+help+"</h3>"+"<img src = '/upload/images/task/"+taskId+"-help.jpg'"+" onerror = 'this.style.display = \"none\"'>";
        $("#myModal #modalBody").html(text);
    });
    $("#solve").click(function (e) {
        var url = document.location.href;
        var urlA = url.split('/');
        var taskId = parseInt(urlA[urlA.length-1]);
        var help = $("#panel"+taskId).attr('task-solve-text')
        // <img src = "1.jpg" onerror = "this.style.display = 'none'">
        var text = "<h3>"+help+"</h3>"+"<img src = '/upload/images/task/"+taskId+"-solve.jpg'"+" onerror = 'this.style.display = \"none\"'>";
        $("#myModal2 #modalBody").html(text);
    });
    $("#sendRequest").click(function (e) {
        e.preventDefault();
        var url = document.location.href;
        var urlA = url.split('/');
        var taskId = parseInt(urlA[urlA.length-1]);
        var typeError = $("#typeError").val();
        var messageError = $("#messageError").val();
        messageError = typeError + '\n' + messageError;


        $.ajax({
            method: "POST",
            url: "/admin/request/create",
            dataType: "json",
            data: {task: taskId, message: messageError},

            success: function (data) {
                var text = '<h3>Хабарлама жіберлді!</h3>';
                $("#myModal1 #modalBody").html(text);
                $("#sendRequest").fadeOut();
                // $("#myModal1").delay(2000).fadeOut();
            }
        });
    });
    function checkAnsF(taskId, answer){
        // console.log(answer);
        // console.log(taskId);
        $.ajax({
            method: "POST",
            url: "/cabinet/razdel/checkAns",
            dataType: "json",
            data: {task: taskId, answer: answer},

            success: function (data) {
                console.log(data);
                $("#animate-star").css({
                    left: "30%",
                    top: "100%",
                });
                var isRight = data.is_right;
                var score = data.score;
                var taskId = data.task_id;
                var popytki = data.popytki;
                if (isRight == 1) {
                    // alert("Дурыс, Жарайсын!"); #5ebd75

                    $("#taskResh").css({'background-color': '#5ebd75'}).html('<h2>Дұрыс жарайсың!</h2>').fadeIn(1000).delay(7000).fadeOut(1000);
                    $("#animate-star").fadeIn();
                    $("#animate-star").animate({
                        left: "55%",
                        top: "15%",
                    }, 1500);
                    $("#animate-star").fadeOut();
                    var cont = '<span id="popytki"><span style="color: #34b44a; font-size: 25px;">'+popytki+'</span> талпыныстан шешілді   </span><span style="color: #34b44a;font-size: 25px;">'+score+' </span><i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>';
                    $('#panel' + taskId + ' #score').hide().html(cont).delay(1500).show(1000);
                    $('#panel' + taskId + ' #score').attr('is-solved', '1');
                    $('#zhauapBeru').fadeOut();
                    $('#kelesiTapsyrma').fadeIn();
                    $('#help').fadeOut();
                    $('#solve').fadeIn();
                    function foo() {
                        document.getElementById("kelesiTapsyrma1").click();
                    }
                    setTimeout(foo, 10000);
                } else {
                    $("#taskResh").css({'background-color': 'red'}).html('<h2>Тағы тырысып көр.</h2>').fadeIn(1000).delay(7000).fadeOut(1000);
                }

            }
        });
    }
    $(document).ready(function(){

        $("#sodoku_input").fadeOut();
        $("#sodoku_input_img").fadeOut();
        $("#taskSudoku td.checkMe").click(function () {
            var adress = $(this).attr('adress');
            $("#sodoku_input input").val('');
            $("#sodoku_input input").attr('table-adress', adress);
            $("#sodoku_input").fadeIn();
            $("#sodoku_input input").focus();
        });
        $("#taskSudokuImg td.checkMeImg").click(function () {
            var adress = $(this).attr('adress');
            $("#sodoku_input_img span.razdelAnsTableImg").each(function () {
                $(this).removeClass('ansChecked');
                $(this).attr('table-adress', adress);
            });
            $("#sodoku_input_img").fadeIn();

        });
        $("#sodoku_input input").change(function () {
            var adress = $(this).attr('table-adress');
            var ans = $(this).val();
            $('#taskSudoku td.checkMe[adress = "'+adress+'"]').text(ans);
        });
        $(".razdelAnsTableImg").click(function () {
            $('.razdelAnsTableImg').removeClass('ansChecked');
            $(this).addClass("ansChecked");
            var adress = $(this).attr("table-adress");
            var ans = $(this).attr('ans-val');
            var imgName = $(this).attr('img-name');
            var ansHtml = '<img alt="" src="/upload/images/task/' + imgName + '">';
            $('#taskSudokuImg td.checkMeImg[adress = "'+adress+'"]').html(ansHtml);
            $('#taskSudokuImg td.checkMeImg[adress = "'+adress+'"]').attr('ans-val', ans);
        });
        $(".znak").click(function () {
            $('.znak').removeClass('znakChecked');
            $(this).addClass('znakChecked');
            // $(this).css('background-color","yellow');
            var taskType = $(this).attr("task-cell-type");
            if (taskType!=null && taskType == 'rebus'){
                $('.znak').css("color", "#fff");
                $(this).css({"color": "#fffcc4","text-shadow": "#000 0 0 3px"});
                var color = $(this).attr("attr-color");
                $('.znak[attr-color="'+color+'"]').each(function () {
                    $(this).css({"color": "#fffcc4","text-shadow": "#000 0 0 3px"});
                    $(this).addClass('znakChecked');
                });
            }else if(taskType!=null && taskType == 'rebusChislo'){
                $('.znak').css("background-color", "#f5f5f5");
                $(this).css({"background-color": "#f8f390","text-shadow": "red 0 0 3px"});

            } else{
                $('.znak').css("background-color", "#f5f5f5");
                $(this).css("background-color", "#fffcc4");
            }


            // console.log(this);
        });
        $(".arifAns").click(function () {
            var taskId = $(this).attr('task-id');
            var ansVal = $(this).attr('ans-val');
            var typeTask = $(this).attr('task-type');
            var checkedZnak = $('#panel' + taskId + ' .znakChecked');
            if (typeTask == 'arifChislo' && checkedZnak.length > 0){
                console.log(checkedZnak);
                $(this).fadeOut();
                var currAnsVal = $(checkedZnak).attr('ans-val');
                var lastAns = $(".arifAns[ans-val = '"+currAnsVal+"']");
                $(lastAns).fadeIn();
            }else if(typeTask == 'rebus' && checkedZnak.length > 0){
                var currAnsVal = $(checkedZnak).attr('ans-val');
                $(this).fadeOut();
                var lastAns = $(".arifAns[ans-val = '"+currAnsVal+"']");
                $(lastAns).fadeIn();
            }else if(typeTask == 'rebusChislo' && checkedZnak.length > 0){
                var currAnsVal = $(checkedZnak).attr('ans-val');
                var lastAns = $(".arifAns[ans-val = '"+currAnsVal+"']");
            }


            var znakHtml = $(this).html();
            $(checkedZnak).attr('ans-val', ansVal);
            $(checkedZnak).html(znakHtml);
            if (typeTask == 'rebus' && checkedZnak.length > 0) {
                var color = $(checkedZnak).attr("attr-color");
                $('.znak[attr-color="'+color+'"]').each(function () {
                    $(this).attr('ans-val', ansVal);
                    $(this).html(znakHtml);
                });
            }
        });
        $(".deleteChislo").click(function () {
            var taskId = $(this).attr('task-id');
            var typeTask = $(this).attr('task-type');
            var checkedZnak = $('#panel' + taskId + ' .znakChecked');
            var currAns = $(checkedZnak).attr('currans');
            var currAnsVal = $(checkedZnak).attr('ans-val');
            var lastAns = $(".arifAns[ans-val = '"+currAnsVal+"']");
            $(checkedZnak).attr('ans-val', '');
            $(checkedZnak).html(currAns);
            $(lastAns).fadeIn();
        })
        $(".razdelAns").click(function () {
            $('.razdelAns').removeClass('ansChecked');
            $(this).addClass("ansChecked");
        });
        $("a#checkAns").click(function (e) {
            e.preventDefault();
            var url = document.location.href;
            var urlA = url.split('/');
            var taskId = parseInt(urlA[urlA.length-1]);
            var checkAns = $("#panel" + taskId + " .ansChecked");
            var questionType = $("#panel" + taskId +" #question").attr("task-type");
            //console.log(questionType);
            if (questionType == "test"){
                if (checkAns.length){
                    var answer = checkAns.attr('ans-val');
                    checkAnsF(taskId, answer);
                }else{
                    $("#taskResh").css({'background-color': 'red'}).html('<h2>Жауап таңдаңыз.</h2>').fadeIn(1000).delay(2000).fadeOut(1000);
                }
            } else if (questionType == 'sudoku'){
                var answer = '';
                $("#panel"+taskId+" #taskSudoku td").each(function () {
                    var currTd = $(this).text();
                    if (answer == ''){
                        answer = answer + currTd;
                    }else{
                        answer = answer + '~' +currTd;
                    }
                });
                // console.log(answer);
                checkAnsF(taskId, answer);

            }else if (questionType == 'sudokuImg'){
                // console.log('here');
                var answer = '';
                $("#taskSudokuImg td").each(function () {
                    var currTd = $(this).attr('ans-val');
                    if (answer == ''){
                        answer = answer + currTd;
                    }else{
                        answer = answer + '~' +currTd;
                    }
                });
                // console.log(answer);
                checkAnsF(taskId, answer);
            }else if (questionType == 'arifTaskSoZnakami'){
                var answer = '';
                $("#panel"+taskId+" .znak").each(function () {
                    var currTd = $(this).attr('ans-val');
                    if (currTd == null || currTd == ''){
                        currTd = '_';
                    }
                    if (answer == ''){
                        answer = answer + currTd;
                    }else{
                        answer = answer + '~' +currTd;
                    }
                });
                // console.log(answer);
                checkAnsF(taskId, answer);
            }else if (questionType == 'rebus') {
                var answer = '';
                $("#panel" + taskId + " .rebusOtv").each(function () {
                    var currTd = $(this).attr('ans-val');
                    answer = answer + currTd;
                });
                console.log(answer);
                checkAnsF(taskId, answer);
            }else if(questionType == 'rebus-figure'){
                var answer = '';
                $("#panel" + taskId + " .rebusOtv").each(function () {
                    var currTd = $(this).attr('ans-val');
                    var isLast = parseInt($(this).attr('attr-is-last'));
                    if (isLast == 1) {
                        answer = answer + currTd + '~';
                    }else{
                        answer = answer + currTd;
                    }
                });
                answer = answer.substring(0, answer.length - 1);
                console.log(answer);
                checkAnsF(taskId, answer);
            }else if(questionType == 'testClose'){
                var answer = $("#panel" + taskId + " #testClose").val();
                if (answer.length > 0){
                    checkAnsF(taskId, answer);
                }else{
                    $("#taskResh").css({'background-color': 'red'}).html('<h2>Жауапты енгізіңіз.</h2>').fadeIn(1000).delay(2000).fadeOut(1000);
                }
                console.log(answer);
            }



        });
    });
</script>


</body>
</html>