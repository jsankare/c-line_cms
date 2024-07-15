<?php
namespace App\Forms;

class ProductForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "submit" => "Enregistrer mon produit"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 50,
                    "placeholder" => "Nom du produit*",
                    "label" => "Titre",
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
                "category"=>[
                    "type"=> "select",
                    "options"=>[
                        "X" => "Catégorie X",
                        "Y" => "Catégorie Y",
                        "Z" => "Catégorie Z",
                    ],
                    "value" => $data['status'] ?? 0
                ],
                "image"=>[
                    "type"=> "select",
                    "options"=>[
                        "X" => "image X",
                        "Y" => "image Y",
                        "Z" => "image Z",
                    ],
                    "value" => $data['status'] ?? 0
                ],
                "price" => [
                    "type" => "number",
                    "label" => "Prix du produit",
                    "value" => $data['price'] ?? ''
                ],
                "available"=>[
                    "type"=> "select",
                    "options"=>[
                        "true" => "Disponible",
                        "false" => "Non disponible",
                    ],
                    "value" => $data['status'] ?? 0
                ],
            ]
        ];
    }
}