<?php
include_once 'product.php';

class DataProduct
{
    public static $path = 'product.json';

    public static function saveData($data)
    {
        $dataJson = json_encode($data);
        file_put_contents(self::$path, $dataJson);
    }

    public static function loadData()
    {
        $dataJson = file_get_contents(self::$path);
        $data = json_decode($dataJson);
        return self::convertToProduct($data);
    }

    public static function convertToProduct($data)
    {
        $products = [];
        foreach ($data as $item) {
            $product = new Product($item->id, $item->name, $item->price);
            array_push($products, $product);
        }
        return $products;
    }

    public static function addProduct($product)
    {

        $products = self::loadData();
        array_push($products, $product);
        self::saveData($products);
    }

    public static function getProductById($id)
    {
        $products = self::loadData();
        foreach ($products as $product) {
            if ($product->getId() == $id) {
                return $product;
            }
        }

    }
    public static function sortProduct($type){
        $products = self::loadData();
        usort($products, function ($item1, $item2) use ($type){
            if ($type == 'up') {
                return $item1->price > $item2->price;
            } else {
                return $item1->price < $item2->price;
            }
        });
        return $products;

    }

    public static function updateProductById($id, $newProduct)
    {
        $products = self::loadData();
        foreach ($products as $product) {
            if ($product->getId() == $id) {
                $product->setName($newProduct->getId());
                $product->setName($newProduct->getName());
                $product->setPrice($newProduct->getPrice());
            }
        }
        self::saveData($products);
    }

}