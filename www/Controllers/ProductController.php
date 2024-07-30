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
        $categories = (new Category())->findAll();
        $productForm = new Form('Product');

        if ($productForm->isSubmitted() && $productForm->isValid()) {

            $ext = (new \SplFileInfo($_FILES["product"]["name"]))->getExtension();

            // might be error with creating folder rights, fixed using "chmod -R 777 www/Public"
            $uploadDir = '/var/www/html/Public/products/';
            if(is_dir($uploadDir)) {
            } else {
                if (!mkdir($uploadDir, 0777, true)) {
                    header("Dossier non créé ", true, 500);
                    header('Location: /500');
                    exit();
                } else {
                    header("Dossier créé", true, 200);
                }
            }
            $uploadFile = $uploadDir . uniqid() . '.' . $ext;

            // Check MIME type
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->file($_FILES['product']['tmp_name']);

            $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg'];
            if (!in_array($mimeType, $allowedMimeTypes)) {
                header("Erreur, seulement les PNG, JPEG & JPG sont acceptés", true, 500);
                header('Location: /500');
                exit();
            }

            // Move file du tmp au dossier products
            if (move_uploaded_file($_FILES['product']['tmp_name'], $uploadFile)) {
                header("Fichier uploadé avec succes", true, 200);
            } else {
                header("Fichier non créé", true, 500);
                header('Location: /500');
                exit();
            }

            $product = new Product();
            $product->setName($_POST['name']);
            $product->setDescription($_POST['description']);
            $product->setCategory($_POST['category']);
            $product->setPrice($_POST['price']);
            $product->setAvailable($_POST['available']);
            $product->setImage($uploadFile);
            $product->save();

            header('Location: /product/list');
            exit();
        }

        $view = new View('Product/create', 'back');
        $view->assign('categories', $categories);
        $view->assign('productForm', $productForm->build());
        $view->render();
    }
}
