<?php
namespace App\Forms;

class ReviewForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "Faq",
                "submit" => "Ajouter un avis"
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "placeholder" => "Eric",
                    "label" => "Prénom*",
                    "required" => true,
                    "error" => "Le prénom ne peut pas être vide",
                    "value" => $data['content'] ?? ''
                ],
                "lastname" => [
                    "type" => "text",
                    "placeholder" => "Dupuis",
                    "label" => "Nom*",
                    "value" => $data['content'] ?? ''
                ],
                "position" => [
                    "type" => "text",
                    "placeholder" => "Clown de cirque, écolier, banquier ..",
                    "label" => "Position",
                    "required" => true,
                    "error" => "La position ne peut pas être vide",
                    "value" => $data['content'] ?? ''
                ],
                "comment" => [
                    "type" => "textarea",
                    "placeholder" => "Superbe création bien reçue ce jour (..)",
                    "label" => "Avis",
                    "required" => true,
                    "error" => "L'avis ne peut pas être vide",
                    "value" => $data['content'] ?? ''
                ],
                "rating" => [
                    "type" => "number",
                    "label" => "Note / 5",
                    "min" => 1,
                    "max" => 5,
                    "required" => true,
                    "value" => $data['rating'] ?? ''
                ],
            ]
        ];
    }
}
