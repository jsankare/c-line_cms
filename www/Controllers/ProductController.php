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

    public function showone(): void
    {
        if (isset($_GET['id'])) {
        $productId = intval($_GET['id']);
        $product = (new Product())->findOneById($productId);

        $view = new View("Product/showone", "front");
        $view->assign('product', $product);
        $view->render();
        } else {
            header("Produit non trouvé", true, 404);
            header('Location: /500');
            exit();
        }
    }

    public function add() {
        $productId = intval($_GET['id']);
        $product = (new Product())->findOneById($productId);

        if (!isset($_SESSION["user-cart"]) || !is_array($_SESSION["user-cart"])) {
            $_SESSION["user-cart"] = [];
        }

        if (isset($_SESSION["user-cart"][$product->getId()])) {
            $_SESSION["user-cart"][$product->getId()]['quantity']++;
        } else {
            $_SESSION["user-cart"][$product->getId()] = [
                'productId' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'category' => $product->getCategory(),
                'image' => $product->getImage(),
                'price' => $product->getPrice(),
                'quantity' => 1,
            ];
        }
        header('Location: /products/show');
        exit();
    }

    public function edit(): void
    {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $product = (new Product())->findOneById($productId);

            if ($product) {
                $productForm = new Form("Product");
                $productForm->setValues([
                    'id' => $productId,
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'category' => $product->getCategory(),
                    'price' => $product->getPrice(),
                    'available' => $product->getAvailable(),
                    'image' => $product->getImage(),
                ]);

                if ($productForm->isSubmitted() && $productForm->isValid()) {

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

                $view = new View("Product/edit", "back");
                $view->assign('productForm', $productForm->build());
                $view->render();
            } else {
                header("Produit non trouvé", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID produit non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

    public function predelete(): void {

        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $product = (new Product())->findOneById($productId);
        } else {
            header("impossible de récupérer le produit", true, 404);
            header('Location: /404');
            exit();
        }

        $view = new View('Product/delete', 'back');
        $view->assign('product', $product);
        $view->render();
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $product = (new Product())->findOneById($productId);

            if ($product) {
                $product->delete();
                header('Location: /products/home');
                exit();
            } else {
                header("Produit non trouvée", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID produit non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

    public function addone() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $product = (new Product())->findOneById($productId);
            $productQuantity = $_SESSION["user-cart"][$product->getName()]["quantity"];

            var_dump($productQuantity);
        }
    }
}
