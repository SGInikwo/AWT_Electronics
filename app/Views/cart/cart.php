<?php
$session = \Config\Services::session();
?>

<h1>Cart</h1>
<!-- Cart view-->
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col"></th>
        <th scope="col">Name</th>
        <th scope="col">quantity</th>
        <th scope="col">Price</th>
    </tr>
    </thead>
    <tbody>
    <?php $item=0 ?>
    <?php foreach ($products as $product): ?>
    <tr>
        <th scope="row"><?= ++$item ?></th>
        <td> <img src="assets/images/<?= $product['image'] ?>" width="150" height="100"> </td>
        <td><?= $product['name'] ?></td>
        <td><?= $product['quantity'] ?></td>
        <td><?php $nummmber =$product['price'] *  $product['quantity']?>&pound; <?= number_format($nummmber, 2)?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th></th>
        <td></td>
        <td></td>
        <td>Total:</td>
        <td>&pound; <?= number_format($total, 2)?></td>
    </tr>
    </tbody>
</table>

<a class="btn btn-outline-primary ms-3" href="/cart/checkout">Checkout</a>
