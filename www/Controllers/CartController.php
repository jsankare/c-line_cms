<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Core\View;

class CartController
{
    public function home(): void
    {
        $pages = (new Page())->findAll();
        $view = new View("Cart/home", "front");
        $view->assign('pages', $pages);
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

    public function remove() {
        if (isset($_GET['id'])) {
            $productId = intval($_GET['id']);
            unset($_SESSION["user-cart"][$productId]);
        }
        header('Location: /cart');
        exit();
    }

    public function reset() {
        unset($_SESSION["user-cart"]);
        header('Location: /cart');
        exit();
    }

}
