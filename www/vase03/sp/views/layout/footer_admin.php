<div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2022</p>
                <p class="pull-right">Evgeny Vasilenko</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->



<script src="/~vase03/sp/template/js/jquery.js"></script>
<script src="/~vase03/sp/template/js/jquery.cycle2.min.js"></script>
<script src="/~vase03/sp/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/~vase03/sp/template/js/bootstrap.min.js"></script>
<script src="/~vase03/sp/template/js/jquery.scrollUp.min.js"></script>
<script src="/~vase03/sp/template/js/price-range.js"></script>
<script src="/~vase03/sp/template/js/jquery.prettyPhoto.js"></script>
<script src="/~vase03/sp/template/js/main.js"></script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");
            $.post("/~vase03/sp/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

</body>
</html>