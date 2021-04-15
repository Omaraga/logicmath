    <div class="page-buffer"></div>
</div>





<script src="/template/js/jquery.js"></script>
<!--<script src="/template/js/jquery.cycle2.min.js"></script>-->
<!--<script src="/template/js/jquery.cycle2.carousel.min.js"></script>-->
<script src="/template/js/bootstrap.min.js"></script>
<!--<script src="/template/js/jquery.scrollUp.min.js"></script>-->
<!--<script src="/template/js/price-range.js"></script>-->
<!--<script src="/template/js/jquery.prettyPhoto.js"></script>-->
<!--<script src="/template/js/main.js"></script>-->
<!--<script src="/template/js/lightbox.min.js"></script>-->
<!--<script src="/template/js/tox-progress.js"></script>-->
<script >
    function getTasks(razdelId){
        console.log(razdelId);
        $.ajax({
            method: "POST",
            url: "/cabinet/getTasks",
            dataType: "json",
            data: {razdelId: razdelId},

            success: function (data) {
                console.log(data);
                $.each(data, function(key,value) {
                    var level = parseInt(value.difficult);

                    if (level == 1) {
                        var $el = $("#begin");
                        if (value.task_id != "") {
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet/razdel/"+value.id+"/"+value.task_id+"'>"+
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>"+
                                "<h4>"+value.short_name+"</h4>"+
                                "</a></div>"));
                        }else{
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet'>"+
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>"+
                                "<h4>"+value.short_name+"</h4>"+
                                "</a></div>"));
                        }

                    }else if(level == 2){
                        var $el = $("#intermediate");
                        if (value.task_id != "") {
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet/razdel/"+value.id+"/"+value.task_id+"'>"+
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>"+
                                "<h4 >"+value.short_name+"</h4>"+
                                "</a></div>"));
                        }else{
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet/'>"+
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>"+
                                "<h4 >"+value.short_name+"</h4>"+
                                "</a></div>"));
                        }


                    }else if(level == 3){
                        var $el = $("#advanced");
                        if (value.task_id != "") {
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet/razdel/" + value.id + "/" + value.task_id + "'>" +
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>" +
                                "<h4>" + value.short_name + "</h4>" +
                                "</a></div>"));
                        }else{
                            $el.append($("<div class='col-sm-2 col-xs-3'>" +
                                "<a href='/cabinet/'>"+
                                "<div class='leo'><img src='/template/images/home/enable-task.png' ></div>"+
                                "<h4 >"+value.short_name+"</h4>"+
                                "</a></div>"));
                        }
                    }

                });

            }
        });
    }

    $(".razdelLink").click(function (e) {
        e.preventDefault();
        var razdelId = $(this).attr('attr-razdel-id');
        var razdelName = $(this).attr('attr-razdel-name');
        $("#begin").empty();
        $("#intermediate").empty();
        $("#advanced").empty();
        $("#showTask a").empty().append(razdelName);
        $("#menu1 .center ").empty().append(razdelName);
        //$("#showTask").fadeIn();
        getTasks(razdelId);
        $("#showTask a").click();

    });
    $(".studentInfo #sel1").change(function () {
        var val = $(this).val();
        val = parseInt(val);
        if (val == 0){
            $("#otherCity").fadeIn();
        }

    });
    $(".studentInfo #sel3").change(function () {
        var val = $(this).val();
        val = parseInt(val);
        if (val == 0){
            $("#otherSchool").fadeIn();
        }

    });
    $(document).ready(function () {
        $("#showTask").fadeOut();
        var activ = $("#active");
        var rating = $("#rating");
        var school = $(".studentInfo #sel3").val();
        if (school == 0){
            $("#otherSchool").fadeIn();
        }
        if(window.location.pathname=="/cabinet/rating"){
            activ.addClass('activ');
            //console.log(window.location.pathname);
        }else{
            activ.removeClass('activ');
        }
        if (rating != null){
            var widthUser =  document.documentElement.clientWidth;

            if (widthUser <= 767){
                $(rating).removeClass('container');
                $(rating).addClass('container-fluid');
            }else{
                $(rating).addClass('container');
            }
        }
       
    });


    $("#userLogo").click(function (e) {
        setTimeout(function(){
            e.preventDefault();
            document.location.reload(true);
            history.go(0);
        });
    });
    var id;
     function takeId(id,name,count,done){
       // console.log("ID="+id+" Name: "+name+" Count-Task: "+count+" Done: "+done+" INpersent: "+(done/count)*100);
        var cart = document.getElementsByClassName("viewcert");
                       cart.innerHTML= id;
        var img = document.getElementById('certChecked');
       img.src = "/upload/images/certs/"+id+".jpg";
       var h4 =  document.getElementById('certName');
       var prSent =Number.parseInt((done/count)*100);
       if(prSent>100){
           prSent = 100;
       }
       //console.log(prSent);
       h4.innerText = name;
       var span =  document.getElementById('taskCount');
       span.innerText = count+" сабақ";
       var persent =  document.getElementById('progCert');
       persent.style.width =prSent+"%";
       var persent =  document.getElementById('certPer');
       persent.innerText = prSent+"%";
       if(id==2){
        var el =  document.getElementById('progCert');
       el.className="progress-bar progress-bar-danger";
       
       span.className = "text-danger";
       }else if(id==1){
        var el =  document.getElementById('progCert');
        el.className="progress-bar progress-bar-primary";
        span.className = "text-primary";
       }else{
        var el =  document.getElementById('progCert');
       el.className="progress-bar progress-bar-success";
       span.className = "text-success";
       }
       

    }
    function changePhoto(img){
        var src =document.getElementsByClassName('tab-Prog');
        src[0].src = "http://logicmath.kz/template/images/home/"+img;
    }
    

    $(function(){
        $("#myTab a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });
    });



  

    document.addEventListener('DOMContentLoaded', function () {
                        ToxProgress.create();
                        ToxProgress.animate();
                      
                    });

</script>


</body>
</html>