<?php
namespace App\Forms;

class GalleryForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "gallery",
                "enctype" => "multipart/form-data",
                "submit" => "Valider"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "label" => "Titre*",
                    "required" => true,
                    "min" => 2,
                    "max" => 50,
                    "value" => $data['title'] ?? ''
                ],
                "description" => [
                    "type" => "text",
                    "label" => "Description*",
                    "required" => true,
                    "min" => 2,
                    "max" => 100,
                    "value" => $data['description'] ?? ''
                ],
                "image" => [
                    "type" => "file",
                    "label" => "Image*",
                    "required" => true
                ],
                "is_gallery" => [
                    "type" => "checkbox",
                    "label" => "Doit apparaitre sur la gallerie",
                    "value" => 0,
                    "checked" => isset($data['is_gallery']) && $data['is_gallery']

                ]
            ]
        ];
    }
}
