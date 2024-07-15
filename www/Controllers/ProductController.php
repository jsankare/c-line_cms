<?php
namespace App\Controller;

use App\Core\Form;
use App\Models\User;
use App\Models\Product;
use App\Core\View;

class ProductController
{
    public function home(): void
    {
        $products = (new Product())->findAll();
        $view = new View("Product/home", "back");
        $view->assign('products', $products);
        $view->render();
    }

    public function add():void
    {
        $productForm = new Form("Product");

        $view = new View("Product/create", "back");
        $view->assign('productForm', $productForm->build());
        $view->render();
    }
}