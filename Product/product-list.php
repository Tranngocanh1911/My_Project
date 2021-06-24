<?php
include_once 'DataProduct.php';
include_once 'product.php';
session_start();
$result = DataProduct::loadData();
if (isset($_REQUEST['sort'])){
    if ($_REQUEST['sort'] == 'up'){
        $result = DataProduct::sortProduct('up');
    } else {
        $result = DataProduct::sortProduct('down');
    }
}
if(isset($_REQUEST['page'])){
    if ($_REQUEST['page'] == 'delete'){
        $id = $_REQUEST['id'];
        array_splice($result,$id,1);
        DataProduct::saveData($result);
        header("location:product-list.php");
    }
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
    <style>
        #product {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #product td, #product th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #product tr:nth-child(even){background-color: #f2f2f2;}

        #product tr:hover {background-color: #ddd;}

        #product th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .button1 {
            color: cadetblue;
            background-color: white;
            border: 2px solid #4CAF50;
            text-decoration: none;
        }

        .button1:hover {
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
        }

        }
        .button4 {
            background-color: white;
            color: black;
            border: 2px solid #e7e7e7;
        }

        .button4:hover {background-color: #e7e7e7;}

        .button5 {
            background-color: white;
            color: black;
            border: 2px solid #555555;
        }

        .button5:hover {
            background-color: #555555;
            color: white;
        }
        .button3 {
            background-color: white;
            color: deeppink;
            border: 2px solid #f44336;
        }

        .button3:hover {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
<a href="add-product.php"><button class="button button5">Add</button></a>
<a href="product-list.php?sort=up"><button class="button button4">Up</button></a>
<a href="product-list.php?sort=down"><button class="button button4">Down</button></a>
<table id="product">
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    <?php
    foreach ($result as $key => $product):
    ?>
    <tr>
        <td><?php echo $product->getId() ?></td>
        <td><?php echo $product->getName() ?></td>
        <td><?php echo $product->getPrice() ?></td>
        <td><a href="edit-product.php?id=<?php echo $product->getId() ?>"><button class="button button1">Edit</button> </a></td>
        <td><a href="product-list.php?page=delete&id=<?php echo $key ?>"><button class="button button3" >Delete</button></a></td>
    </tr>
    <?php
    endforeach;
    ?>
</table>
</body>
</html>
