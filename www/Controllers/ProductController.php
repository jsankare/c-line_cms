<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\Category;
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

    public function create(): void
    {
        $productForm = new Form('Product');

        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setCategory($_POST['category']);
            $product->setPrice($_POST['price']);
            $product->setAvailable($_POST['available']);
            $product->setImage($_POST['image']);

            $product->save();

            header('Location: /products/home');
            exit();
        }

        $categories = (new Category())->findAll();
        $view = new View('Product/create', 'back');
        $view->assign('categories', $categories);
        $view->assign('productForm', $productForm->build());
        $view->render();
    }

    public function show(): void
    {
        $productModel = new Product();
        $categoriesModel = new Category();

        $products = $productModel->findAll();
        $categories = $categoriesModel->findAll();

        $view = new View("Product/show", "front");
        $view->assign('products', $products);
        $view->assign('categories', $categories);
        $view->render();
    }

}
