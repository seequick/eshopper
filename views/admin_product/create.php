<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li><a href="/admin/product">Управление товарами</a></li>
                        <li class="active">Редактировать товар</li>
                    </ol>
                </div>


                <h4>Добавить новый товар</h4>

                <br/>


                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <strong style="color: red; "><?php echo $error; ?></strong></li>

                            <?php endforeach; ?>
                            <br/>
                        </ul>
                    <?php endif; ?>
                    <div class="login-form">
                        <form action="" method="post" enctype="multipart/form-data">

                            <p>Название товара</p>
                            <input type="text" name="name" placeholder="" value="" required>

                            <p>Артикул</p>
                            <input type="text" name="code" placeholder="" value="" required>

                            <p>Стоимость, $</p>
                            <input type="number" name="price" min="1" step="0.01" placeholder="" value="" required>

                            <p>Категория</p>
                            <select name="category_id">
                                <?php if (is_array($categoriesList)): ?>
                                    <?php foreach ($categoriesList as $category): ?>
                                        <option value="<?php echo $category['id']; ?>">
                                            <?php echo $category['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>

                            <br/><br/>

                            <p>Производитель</p>
                            <input type="text" name="brand" placeholder="" value="" required>

                            <p>Изображение товара</p>
                            <input type="file" name="image" placeholder="" value="">

                            <p>Детальное описание</p>
                            <textarea name="description" required></textarea>

                            <br/><br/>

                            <p>Наличие на складе</p>
                            <select name="availability">
                                <option value="1" selected="selected">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br/><br/>

                            <p>Новинка</p>
                            <select name="is_new">
                                <option value="1" selected="selected">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br/><br/>

                            <p>Рекомендуемые</p>
                            <select name="is_recommended">
                                <option value="1" selected="selected">Да</option>
                                <option value="0">Нет</option>
                            </select>

                            <br/><br/>

                            <p>Статус</p>
                            <select name="status">
                                <option value="1" selected="selected">Отображается</option>
                                <option value="0">Скрыт</option>
                            </select>

                            <br/><br/>

                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">

                            <br/><br/>

                        </form>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>