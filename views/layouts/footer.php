    <div class="page-buffer"></div>
<!--</div>-->

<footer id="footer" class="page-footer"><!--Footer-->
        <div class="container">
            <div class="row">
                <div class="logo col-sm-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <img src="/template/images/home/logo-white-blue.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 contacts hidden-xs">
                    <div class="col-sm-12" style="text-align: left;padding-left: 20%;"><span>Байланыс</span></div>
                    <div class="col-sm-12"><a href="tel:87752317019"><i class="fa fa-phone" aria-hidden="true"></i> +7-(775)-231-70-19</a></div>
                    <div class="col-sm-12"><a href="mailto:info@logicmath.kz"><i class="fa fa-envelope" aria-hidden="true"></i> info@logicmath.kz</a></div>
                </div>
                <div class="col-sm-5 col-xs-12 social">
                    <div class="row links">
                        <div class="col-sm-12 col-xs-12"><span>Біз әлеуметтік желідеміз</span></div>
                        <div class="social-link first">
                            <a href="https://www.instagram.com/logicmath.kz/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                        <div class="social-link">
                            <a href="https://www.facebook.com/logicmath.kz/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </div>
                        <div class="social-link">
                            <a href="https://www.telegram.com/logicmath.kz/"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>
                        </div>
                        <div class="social-link">
                            <a href="https://www.vk.com/logicmath.kz/"><i class="fa fa-vk" aria-hidden="true"></i></a>
                        </div>
                        <div class="social-link">
                            <a href="https://www.youtube.com/logicmath.kz/"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 contacts col-xs-12 visible-xs">
                    <div class="col-sm-12" style="text-align: center;margin-bottom:5px; "><span>Байланыс</span></div>
                    <div class="col-xs-6"><a href="tel:87752317019"><i class="fa fa-phone" aria-hidden="true"></i> +7-(775)-231-70-19</a></div>
                    <div class="col-xs-6" style="margin-bottom: 15px"><a href="mailto:info@logicmath.kz"><i class="fa fa-envelope" aria-hidden="true"></i> info@logicmath.kz</a></div>
                </div>
            </div>
        </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>
<script>
    $( document ).ready(function() {
        $('#s-h-pass').click(function(){
            var type = $('#password').attr('type') == "text" ? "password" : 'text',
                c = $(this).html() == "<span class=\"glyphicon glyphicon-eye-close\" title=\"Скрыть пароль\"></span>" ? "<span class=\"glyphicon glyphicon-eye-open\" title=\"Показать пароль\"></span>" : "<span class=\"glyphicon glyphicon-eye-close\" title=\"Скрыть пароль\"></span>";
            $(this).html(c);
            $('#password').prop('type', type);
        });
    });
</script>

</body>
</html>