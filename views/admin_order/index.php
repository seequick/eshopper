<?php include ROOT . '/views/layouts/header_admin.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <br/>

                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Админпанель</a></li>
                        <li class="active">Управление заказами</li>
                    </ol>
                </div>

                <h4 style="text-align: center; ">Список заказов</h4>
                <h6 style="text-align: center; ">Всего заказов на сайте: <?php echo $total; ?></h6>

                <br/>

                <table class="table-bordered table-striped table">
                    <tr>
                        <th style="width: 8%; text-align: center; ">ID заказа</th>
                        <th style="text-align: center; ">Имя покупателя</th>
                        <th style="text-align: center; ">Телефон покупателя</th>
                        <th style="text-align: center; ">Дата оформления</th>
                        <th style="text-align: center; ">Статус</th>
                        <th style="text-align: center; "></th>
                        <th style="text-align: center; "></th>
                        <th style="text-align: center; "></th>
                    </tr>
                    <?php foreach ($ordersList as $order): ?>
                        <tr>
                            <td style="text-align: center; ">
                                <a href="/admin/order/view/<?php echo $order['id']; ?>">
                                    <?php echo $order['id']; ?>
                                </a>
                            </td>
                            <td style="text-align: center; "><?php echo $order['user_name']; ?></td>
                            <td style="text-align: center; "><?php echo $order['user_phone']; ?></td>
                            <td style="text-align: center; "><?php echo $order['date']; ?></td>
                            <td style="text-align: center; "><?php echo Order::getStatusText($order['status']); ?></td>
                            <td style="text-align: center; "><a href="/admin/order/view/<?php echo $order['id']; ?>" title="Смотреть"><i class="fa fa-eye"></i></a></td>
                            <td style="text-align: center; "><a href="/admin/order/update/<?php echo $order['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                            <td style="text-align: center; "><a href="/admin/order/delete/<?php echo $order['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>