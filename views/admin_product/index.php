<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление товарами</li>
                    </ol>
                </div>

                <a href="/admin/product/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить товар</a>
                <div class="col-lg-2 pull-right">
                    <form id="myform" method="post">
                        <select name = 'peer-id' title = "Количество товаров" style = 'position: relative;' onchange="change()">
                            <option value="25" <?php if ($amount == 25) echo ' selected="selected"'; ?>>25</option>
                            <option value="50" <?php if ($amount == 50) echo ' selected="selected"'; ?>>50</option>
                            <option value="100" <?php if ($amount == 100) echo ' selected="selected"'; ?>>100</option>
                            <option value="250" <?php if ($amount == 250) echo ' selected="selected"'; ?>>250</option>
                            <option value="<?php echo $total; ?>" <?php if ($amount == $total) echo ' selected="selected"'; ?>>show all</option>
                        </select>
                    </form>
                </div>
                <h4 style="text-align: center; ">Список товаров</h4>
                <h6 style="text-align: center; ">Всего товаров <b><?php echo $total?></b></h6>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th>ID</th>
                        <th>Название товара</th>
                        <th>Артикул</th>
                        <th>Категория</th>
                        <th title="Цена, $"><i class="fa fa-dollar"></th>
                        <th>Брэнд</th>
                        <th title="В наличии?"><i class="fa fa-shopping-cart"></th>
                        <th title="Новый?"><i class="fa fa-plus"></th>
                        <th title="Рекомендуемый?"><i class="fa fa-plus-circle"></th>
                        <th title="Видимый?"><i class="fa fa-search"></th>
                        <th title="Редактировать"></th>
                        <th title="Удалить"></th>
                    </tr>
                    <?php foreach ($productsList as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['code']; ?></td>
                            <td><?php if (is_array($categoriesList)): ?>
                            <?php foreach ($categoriesList as $category): ?>
                                    <?php if ($product['category_id'] == $category['id']) echo $category['name']; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                </td>
                            <td title="Цена, $"><?php echo $product['price']; ?></td>
                            <td><?php echo $product['brand']; ?></td>
                            <td title="В наличии?"><?php echo $product['availability']; ?></td>
                            <td title="Новый?"><?php echo $product['is_new']; ?></td>
                            <td title="Рекомендуемый?"><?php echo $product['is_recommended']; ?></td>
                            <td title="Видимый?"><?php echo $product['status']; ?></td>
                            <td><a href="/admin/product/update/<?php echo $product['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td><a href="/admin/product/delete/<?php echo $product['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
            <!--Постраничная навигация-->
<!--            --><?php //echo $pagination->get(); ?>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>