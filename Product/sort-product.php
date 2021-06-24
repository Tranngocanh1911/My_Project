<?php
include_once 'DataProduct.php';
include_once 'product.php';
DataProduct::sortProduct();
header('location:product-listproduct-list.php');