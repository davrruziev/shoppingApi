<?php
namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
      public function getAllOrders();

      public function changeStatusOrder($request);

      public function orderStore($request, $sum, $address, $products);
      public function StocksOrders($products);

}
