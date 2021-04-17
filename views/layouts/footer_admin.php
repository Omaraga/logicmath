    <div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2021</p>
                <p class="pull-right">LogicMath</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/template/js/jquery.js"></script>
<!--<script src="/template/js/jquery.cycle2.min.js"></script>-->
<!--<script src="/template/js/jquery.cycle2.carousel.min.js"></script>-->
<script src="/template/js/bootstrap.min.js"></script>
<!--<script src="/template/js/jquery.scrollUp.min.js"></script>-->
<!--<script src="/template/js/jquery.prettyPhoto.js"></script>-->
<script src="/template/js/main.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#helpText').summernote();
            $('#solveText').summernote();
            $('#title_kz').summernote({
                placeholder: '',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']]
                ]
            });
            $('#title_ru').summernote({
                placeholder: '',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']]
                ]
            });


        });
    </script>



</body>
</html>