<?php
namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
     public function getProducts();

     public function getProductId($product);
}
