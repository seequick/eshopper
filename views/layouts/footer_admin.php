<div class="page-buffer"></div>
</div>

<footer id="footer" class="page-footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © <strong><?php echo date("d.m.Y"); ?></strong></p>
                <p class="pull-right">Made by me</p>
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
    function change(){
        document.getElementById("myform").submit();
    }
</script>
<!--<script>-->
<!--    $(document).ready(function(){-->
<!--        $(".add-to-cart").click(function () {-->
<!--            var id = $(this).attr("data-id");-->
<!--            $.post("/cart/addAjax/"+id, {}, function (data) {-->
<!--                $("#cart-count").html(data);-->
<!--            });-->
<!--            return false;-->
<!--        });-->
<!--    });-->
<!--</script>-->

</body>
</html>