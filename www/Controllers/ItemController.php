<?php
namespace App\Controller;

use App\Core\Form;
use App\Models\User;
use App\Models\Item;
use App\Core\View;

class ItemController
{
    public function home(): void
    {
        $items = (new Item())->findAll();
        $view = new View("Item/home", "back");
        $view->assign('items', $items);
        $view->render();
    }
}