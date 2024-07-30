<?php
namespace App\Forms;

use App\Models\Category;
use App\Models\Image;

class ProductForm
{
    public static function getConfig(array $data = []): array
    {
        $categories = (new Category())->findAll();
        $images = (new Image())->findAll();

        $categoryOptions[''] = 'Sélectionner une catégorie';
        $imagesOptions[''] = 'Sélectionner une image';

        foreach ($categories as $category) {
            $categoryOptions[$category->getId()] = $category->getType();
        }

        foreach ($images as $image) {
            $imagesOptions[$image->getId()] = $image->getTitle();
        }

        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "product",
                "submit" => "Enregistrer mon produit"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 50,
                    "placeholder" => "Nom du produit*",
                    "label" => "Nom",
                    "required" => true,
                    "error" => "Le nom du produit doit faire entre 2 et 50 caractères",
                    "value" => $data['name'] ?? ''
                ],
                "description" => [
                    "type" => "textarea",
                    "max" => 50,
                    "placeholder" => "Description de l'article",
                    "label" => "Description",
                    "error" => "La description ne peut pas faire plus de 50 caractères",
                    "value" => $data['description'] ?? ''
                ],
                "category" => [
                    "type" => "select",
                    "selected" => "placeholder",
                    "options" => $categoryOptions,
                    "label" => "Catégorie",
                    "required" => true,
                    "error" => "La catégorie est requise",
                    "value" => $data['category'] ?? ''
                ],
                "image" => [
                    "type" => "select",
                    "options" => $imagesOptions,
                    "label" => "Image",
                    "required" => true,
                    "error" => "L'image est requise",
                    "value" => $data['image'] ?? ''
                ],
                "price" => [
                    "type" => "number",
                    "label" => "Prix du produit",
                    "value" => $data['price'] ?? ''
                ],
                "available" => [
                    "type" => "select",
                    "options" => [
                        "true" => "Disponible",
                        "false" => "Non disponible",
                    ],
                    "label" => "Disponibilité",
                    "value" => $data['available'] ?? 'true'
                ],
            ]
        ];
    }
}