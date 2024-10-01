<?php
namespace App\Forms;

use App\Models\Category;
use App\Models\Image;

class UpdateProductForm
{
    public static function getConfig(array $data = []): array
    {
        $categories = (new Category())->findAll();
        $images = (new Image())->findAll();

        $categoryOptions[''] = 'Sélectionner une catégorie';
        $imagesOptions[''] = 'Sélectionner une image';

        foreach ($categories as $category) {
            if (!in_array($category->getType(), $categoryOptions)) {
                $categoryOptions[$category->getName()] = $category->getName();
            }
        }

        foreach ($images as $image) {
            $imagesOptions[$image->getLink()] = $image->getTitle();
        }

        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "product",
                "submit" => "Enregistrer mon produit",
                "enctype" => "multipart/form-data"
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
                    "placeholder" => "Description de l'article",
                    "label" => "Description",
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
                    "type" => "file",
                    "label" => "Image",
                ],
                "price" => [
                    "type" => "number",
                    "label" => "Prix du produit",
                    "value" => $data['price'] ?? '',
                    "step" => 0.01
                ],
                "available" => [
                    "type" => "select",
                    "options" => [
                        1 => "Disponible",
                        0 => "Non disponible",
                    ],
                    "label" => "Disponibilité",
                    "value" => $data['available'] ?? 1,
                ],
            ]
        ];
    }
}