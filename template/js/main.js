

/*scroll to top*/
function checkAnsF(glavaId){
    // console.log(glavaId);
    $.ajax({
        method: "POST",
        url: "/admin/task/getRazdel",
        dataType: "json",
        data: {id: glavaId},

        success: function (data) {
            console.log(data);
            var $el = $("#razdel_id");
            $el.empty(); // remove old options
            $.each(data, function(key,value) {
                $el.append($("<option></option>")
                    .attr("value", value.id).text(value.name_ru + '-' + value.order_num));

            });
        }
    });
}
function checkParentRazdel() {
    var val = $(".isChild:checked").val();
    val = parseInt(val);
    if (val == 1){
        var level = $("#razdelLevel option:selected").val();
        getParentRazdel(level);
    }else{
        $("#parentRazdelBlock").fadeOut();
    }
}
function getParentRazdel(levelId) {
    $.ajax({
        method: "POST",
        url: "/admin/razdel/parentrazdel",
        dataType: "json",
        data: {id: levelId},

        success: function (data) {
            console.log(data);
            var $el = $("#parentRazdelSel");
            $el.empty(); // remove old options

            $("#parentRazdelBlock").fadeIn();
            $.each(data, function(key,value) {
                $el.append($("<option></option>")
                    .attr("value", value.id).text(value.name_ru));

            });
        }
    });
}
function getLevels(courceId){
    // console.log(glavaId);
    $.ajax({
        method: "POST",
        url: "/admin/task/getLevel",
        dataType: "json",
        data: {id: courceId},

        success: function (data) {
            console.log(data);
            var $el = $("#glavaId");
            $el.empty(); // remove old options

            $.each(data, function(key,value) {
                $el.append($("<option></option>")
                    .attr("value", value.id).text(value.name_ru));

            });
            checkAnsF(value.id);
        }
    });
}
function getSubRazdel(id){
    $.ajax({
        method: "POST",
        url: "/admin/razdel/subrazdel",
        dataType: "json",
        data: {id: id},

        success: function (data) {
            console.log(data);
            var $el = $("#podrazdel");
            $el.empty(); // remove old options

            $.each(data, function(key,value) {
                $el.append($("<option></option>")
                    .attr("value", value.id).text(value.name_ru));

            });
        }
    });
}
$(document).ready(function(){
    var type = parseInt($("#select_type_task option:selected" ).val());
    var typeDivs = $(".type_task").each(function () {
        var currDiv = parseInt($(this).attr("type-task-val"));
        if (type == currDiv) {
            $(this).fadeIn();
        }else{
            $(this).fadeOut();
        }
    });
    checkParentRazdel();
    //$("#parentRazdelBlock").fadeIn();
    $("#glavaId").change(function () {

        var type = parseInt($("#glavaId option:selected" ).val());
        // console.log(type);
        checkAnsF(type);
    });
    $("#glavaId").click(function () {

        var type = parseInt($("#glavaId option:selected" ).val());
        // console.log(type);
        checkAnsF(type);
    });
    $("#courceId").click(function () {

        var type = parseInt($("#courceId option:selected" ).val());
        // console.log(type);
        getLevels(type);
    });
    $("#razdel_id").click(function () {

        var type = parseInt($("#razdel_id option:selected" ).val());
        // console.log(type);
        getSubRazdel(type);
    });
    $("#select_type_task").change(function () {

        var type = parseInt($("#select_type_task option:selected" ).val());
        var typeDivs = $(".type_task").each(function () {
            var currDiv = parseInt($(this).attr("type-task-val"));
            if (type == currDiv) {
                $(this).fadeIn();
            }else{
                $(this).fadeOut();
            }
        });
    });
    $("#sudoku-num-create").click(function (e) {
        e.preventDefault();
        var str = parseInt($("#string-size").val());
        var table = "<p>Введите правильный ответ</p><table class='table table-bordered' style='text-align: center'>";
        for (var i = 0; i < str; i++) {
            table = table + '<tr>';
            for(var j = 0; j < str; j++){
                table = table + '<td><input type="text" name="'+i+'-'+j+'tableRight"></td>';
            }
            table = table + '</tr>';
        }
        table = table + "</table>";
        table = table + "<p>Введите 1 и 0 (0 - пустое место, 1 - будет отображаться)</p><table class='table table-bordered' style='text-align: center'>";
        for (var i = 0; i < str; i++) {
            table = table + '<tr>';
            for(var j = 0; j < str; j++){
                table = table + '<td><input type="text" name="'+i+'-'+j+'tableWrong"></td>';
            }
            table = table + '</tr>';
        }
        table = table + "</table>";
        $("#table-place").html(table);
        console.log(table);

    });
    $("#sudoku-num-create-image").click(function (e) {
        e.preventDefault();
        var str = parseInt($("#string-size-image").val());
        var table = "<label>Загрузите картинки</label>";
        for (var i = 0; i < str; i++){
            table = table + "<br><input type='file' name='tableImage"+i+"'>";
        }
        table = table + "<p>Введите правильный ответ</p><table class='table table-bordered' style='text-align: center'>";
        for (var i = 0; i < str; i++) {
            table = table + '<tr>';
            for(var j = 0; j < str; j++){
                table = table + '<td><input type="text" name="'+i+'-'+j+'tableRightImage"></td>';
            }
            table = table + '</tr>';
        }
        table = table + "</table>";
        table = table + "<p>Введите 1 и 0 (0 - пустое место, 1 - будет отображаться)</p><table class='table table-bordered' style='text-align: center'>";
        for (var i = 0; i < str; i++) {
            table = table + '<tr>';
            for(var j = 0; j < str; j++){
                table = table + '<td><input type="text" name="'+i+'-'+j+'tableWrongImage"></td>';
            }
            table = table + '</tr>';
        }
        table = table + "</table>";
        $("#table-place-image").html(table);
        console.log(table);

    });

    $("#rebus-num-create").click(function (e){
        e.preventDefault();
        var kolvo = $("#rebus-input-kolvo").val();
        kolvo = parseInt(kolvo);
        var select = "";
        var input = "<br><span>Введите значения строк</span>";
        for (var i=0; i<kolvo;i++){
            if (i < kolvo - 1) {
                input = input + '<input type="text" name="rebus-input'+i+'">' + '<select name="rebus-znak'+i+'" id="select_type_task"><option value="+" selected="selected">+</option><option value="-">-</option><option value="X">X</option><option value="/">/</option></select>';
            }else{
                input = input + '<input type="text" name="rebus-input'+i+'">';
            }
        }
        input = input + '<hr><span>Результат</span><input type="text" name="rebus-result">';
        $("#rebus-place").html(input);
    });

    $("#rebus-num-create-chislo").click(function (e){
        e.preventDefault();
        var kolvoChislo = $("#rebus-input-kolvo-сhislo").val();
        kolvoChislo = parseInt(kolvoChislo);
        var select = "";
        var input = "<br><span>Введите значения строк</span>";
        for (var i=0; i<kolvoChislo;i++){
            if (i < kolvoChislo - 1) {
                input = input + '<input type="text" name="rebus-input'+i+'">' + '<select name="rebus-znak'+i+'" id="select_type_task"><option value="+" selected="selected">+</option><option value="-">-</option><option value="X">X</option><option value="/">/</option></select>';
            }else{
                input = input + '<input type="text" name="rebus-input'+i+'">';
            }
        }
        input = input + '<hr><span>Результат</span><input type="text" name="rebus-result">';
        console.log(input);
        $("#rebus-place-сhislo").html(input);
    });
    $("#rebus-num-create-figure").click(function (e){
        e.preventDefault();
        var kolvoChislo = $("#rebus-input-kolvo-figure").val();
        kolvoChislo = parseInt(kolvoChislo);
        var input = "<br><span>Введите значения строк</span>";
        for (var i=0; i<kolvoChislo;i++){
            input = input + '<input type="text" name="rebus-input'+i+'">';
        }
        $("#rebus-place-figure").html(input);
    });

    $(".isChild").change(function () {
        var val = $(this).val();
        val = parseInt(val);
        if (val == 1){
            var level = $("#razdelLevel option:selected").val();
            getParentRazdel(level);
        }else{
            $("#parentRazdelBlock").fadeOut();
        }
        //console.log(val);
    });




});