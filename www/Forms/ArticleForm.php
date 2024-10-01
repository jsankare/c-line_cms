<?php
namespace App\Forms;

class ArticleForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "article",
                "submit" => "Enregistrer mon article",
                "enctype" => "multipart/form-data"
            ],
            "inputs" => [
                "title" => [
                    "type" => "text",
                    "min" => 2,
                    "max" => 100,
                    "placeholder" => "Titre de l&apos;article*",
                    "label" => "Titre",
                    "required" => true,
                    "error" => "Le titre de l'article doit faire entre 2 et 50 caractères",
                    "value" => $data['title'] ?? ''
                ],
                "description" => [
                    "type" => "textarea",
                    "max" => 200,
                    "placeholder" => "Description de l'article",
                    "label" => "Description",
                    "error" => "La description ne peut pas faire plus de 200 caractères",
                    "value" => $data['description'] ?? ''
                ],
                "tag" => [
                    "type" => "text",
                    "max" => 50,
                    "placeholder" => "tag de l&apos;article",
                    "label" => "Tag",
                    "required" => true,
                    "error" => "Le tag ne peut pas faire plus de 50 caractères",
                    "value" => $data['tag'] ?? ''
                ],
                "image" => [
                    "type" => "file",
                    "label" => "Image*",
                    "required" => true,
                ],
                "content" => [
                    "type" => "textarea",
                    "placeholder" => "Entrez ici le contenu de l'article*",
                    "label" => "Contenu",
                    "required" => true,
                    "error" => "La description de la page ne peut pas faire plus de 255 caractères",
                    "value" => $data['content'] ?? ''
                ]
            ]
        ];
    }
}