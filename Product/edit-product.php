<?php
include_once 'DataProduct.php';
include_once 'product.php';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $product = DataProduct::getProductById($id);
}
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
<form method="post">
    <input type="text" name="name" placeholder="Input Name"  value="<?php echo $product->getName()?>">
    <input type="text" name="price" placeholder="Input Price"  value="<?php echo $product->getPrice()?>">
    <button type="submit">Edit</button>
</form>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$price = $_REQUEST['price'];
$product = new $product($id, $name, $price);
DataProduct::updateProductById($id, $product);
header('location:product-listproduct-list.php');
}
?>