<?php require_once ROOT.'/views/layouts/header.php';?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?php echo $categoryItem['id'];?>"><?php echo $categoryItem['name'];?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img src="<?php echo Product::getImage($products['id']); ?>" width="200px" alt="" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="product-information"><!--/product-information-->
                                <?php if ($products['is_new']): ?>
                                <img src="/template/images/product-details/new.jpg" class="newarrival" alt="" />
                                <?php endif; ?>
                                <h2><?php echo $products['name']; ?></h2>
                                <p>Код товара: <?php echo $products['code']; ?></p>
                                <span>
                                            <span><?php echo $products['price']; ?>$</span>
                                            <label>Количество:</label>
                                            <input type="text" value="1" />
                                           <a href="/cart/add/<?php echo $products['id'];?>" data-id="<?php echo $products['id'];?>" style="position:relative; top:63px; right:181px;"
                                              class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину</a>
                                        </span>
                                <br/>
                                <br/>
                                <br/>
                                <br/>

                                <p><b>Наличие:</b> <?php if ($products['availability'] == 1) echo "Есть на складе"; else echo "Нет на складе"; ?></p>
<!--                                 --><?php //if ($products['is_new'] == 1) echo "<p style='color:red; '><b>Новинка</b></p>"; else echo ""; ?>
                                <p><b>Производитель:</b> <?php echo $products['brand']; ?></p>
                            </div><!--/product-information-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5>Описание товара</h5>
                            <p><?php echo $products['description']; ?></p>

                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php require_once ROOT.'/views/layouts/footer.php';?>