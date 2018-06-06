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
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Последние товары</h2>
                        <?php foreach ($latestProducts as $latestProductsItem): ?>
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo Product::getImage($latestProductsItem['id']); ?>" width="200px" alt="" />
                                            <h2>$<?php echo $latestProductsItem['price'];?></h2>
                                        <p>
                                            <a href="/product/<?php echo $latestProductsItem['id'];?>">
                                                <?php echo $latestProductsItem['name'];?>
                                            </a>
                                        </p>
                                        
                                        <a href="/cart/add/<?php echo $latestProductsItem['id'];?>" data-id="<?php echo $latestProductsItem['id'];?>"
                                           class="btn btn-default add-to-cart">
                                            <i class="fa fa-shopping-cart"></i>В корзину</a>
</a>
                                            <?php if ($latestProductsItem['is_new']): ?>
                                                <img src="/template/images/home/new.png" class="new" alt="" style="width: 20%; "/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div><!--features_items-->

                </div>
            </div>
        </div>
    </section>

<?php require_once ROOT.'/views/layouts/footer.php';?>