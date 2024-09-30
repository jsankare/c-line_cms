<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\Category;
use App\Models\Page;
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

            $ext = (new \SplFileInfo($_FILES["image"]["name"]))->getExtension();
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
            $mimeType = $finfo->file($_FILES['image']['tmp_name']);

            $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg', 'images/webp'];
            if (!in_array($mimeType, $allowedMimeTypes)) {
                header("Erreur, seulement les PNG, WEBP, JPEG & JPG sont acceptés", true, 500);
                header('Location: /500');
                exit();
            }

            // Move file du tmp au dossier uploads
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
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

            (isset($_POST['available']) && $_POST['available'] == '1') ? $product->setAvailable(1) : $product->setAvailable(0);

            $product->setImage($uploadFile);

            var_dump($_POST['available']);
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
        $pages = (new Page())->findAll();
        $productModel = new Product();
        $categoriesModel = new Category();

        $products = $productModel->findAll();
        $categories = $categoriesModel->findAll();

        $view = new View("Product/show", "front");
        $view->assign('pages', $pages);
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

        if ($product->getAvailable() === 1) {
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
        } else {
            header('Location: /products/show');
            exit();
        }

    }

    public function edit(): void
    {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            $product = (new Product())->findOneById($productId);

            if ($product) {
                $productForm = new Form("UpdateProduct");
                $price = number_format((float)$product->getPrice(), 2, '.', '');
                $productForm->setValues([
                    'id' => $productId,
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'category' => $product->getCategory(),
                    'price' => $price,
                    'available' => $product->getAvailable(),
                    'image' => $product->getImage(),
                ]);

                if ($productForm->isSubmitted() && $productForm->isValid()) {

                    $product->setName($_POST['name']);
                    $product->setDescription($_POST['description']);
                    $product->setCategory($_POST['category']);
                    $product->setPrice($_POST['price']);
                    $product->setAvailable($_POST['available']);

                    if (!empty($_FILES['image']['name'])) {
                        $ext = (new \SplFileInfo($_FILES["image"]["name"]))->getExtension();
                        $uploadDir = '/var/www/html/Public/products/';
                        $uploadFile = $uploadDir . uniqid() . '.' . $ext;

                        $finfo = new \finfo(FILEINFO_MIME_TYPE);
                        $mimeType = $finfo->file($_FILES['image']['tmp_name']);
                        $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];

                        if (!in_array($mimeType, $allowedMimeTypes)) {
                            header("Erreur, seulement les PNG, WEBP, JPEG & JPG sont acceptés", true, 500);
                            header('Location: /500');
                            exit();
                        }

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                            if (file_exists($product->getImage())) {
                                unlink($product->getImage());
                            }

                            $product->setImage($uploadFile);
                        } else {
                            header("Erreur lors de l'upload du fichier", true, 500);
                            header('Location: /500');
                            exit();
                        }
                    } else {
                        $product->setImage($product->getImage());
                    }

                    $product->save();

                    header('Location: /products/home');
                    exit();
                }

                $view = new View("Product/edit", "back");
                $view->assign('product', $product);
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

    public function addFromCart() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);

            if (isset($_SESSION['user-cart'][$productId])) {
                $_SESSION['user-cart'][$productId]['quantity'] += 1;
            }
        }

        header('Location: /cart');
        exit();
    }

    public function substractFromCart() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);

            if (isset($_SESSION['user-cart'][$productId])) {
                if ($_SESSION['user-cart'][$productId]['quantity'] == 1) {
                    unset($_SESSION['user-cart'][$productId]);
                } else {
                    $_SESSION['user-cart'][$productId]['quantity'] -= 1;
                }
            }
        }

        header('Location: /cart');
        exit();
    }

    public function addFromDisplay() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);

            if (isset($_SESSION['user-cart'][$productId])) {
                $_SESSION['user-cart'][$productId]['quantity'] += 1;
            }
        }

        header('Location: /products/show');
        exit();
    }

    public function substractFromDisplay() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);

            if (isset($_SESSION['user-cart'][$productId])) {
                if ($_SESSION['user-cart'][$productId]['quantity'] == 1) {
                    unset($_SESSION['user-cart'][$productId]);
                } else {
                    $_SESSION['user-cart'][$productId]['quantity'] -= 1;
                }
            }
        }

        header('Location: /products/show');
        exit();
    }

}
