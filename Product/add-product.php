<?php
include_once 'product.php';
include_once 'DataProduct.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <input type="text" placeholder="Id" name="id">
    <input type="text" placeholder="Name" name="name">
    <input type="text" placeholder="Price" name="price">
    <input type="submit" value="Add" name="add">
</form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $product = new Product($id, $name, $price);
    DataProduct::addProduct($product);
    header('location:product-list.php');
}
?>
