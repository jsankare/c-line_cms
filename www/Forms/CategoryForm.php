<?php
namespace App\Forms;

class CategoryForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "category--form",
                "submit" => "Ajouter une catégorie"
            ],
            "inputs" => [
                "name" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 50,
                    "placeholder" => "Nom de la catégorie*",
                    "label" => "Nom",
                    "required" => true,
                    "error" => "Le nom de la catégorie doit faire entre 2 et 50 caractères",
                    "value" => $data['name'] ?? ''
                ],
                "type" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 50,
                    "placeholder" => "Type de la catégorie*",
                    "label" => "Type",
                    "required" => true,
                    "error" => "Le type de la catégorie doit faire entre 2 et 50 caractères",
                    "value" => $data['type'] ?? ''
                ]
            ]
        ];
    }
}
