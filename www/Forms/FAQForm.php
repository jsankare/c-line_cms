<?php
namespace App\Forms;

class FAQForm
{
    public static function getConfig(array $data = []): array
    {
        return [
            "config" => [
                "action" => "",
                "method" => "POST",
                "class" => "FAQ",
                "submit" => "Ajouter une FAQ"
            ],
            "inputs" => [
                "question" => [
                    "type" => "textarea",
                    "placeholder" => "Entrer la question ici*",
                    "label" => "Question",
                    "required" => true,
                    "error" => "La question ne peut pas être vide",
                    "value" => $data['content'] ?? ''
                ],
                "answer" => [
                    "type" => "textarea",
                    "placeholder" => "Entrer la réponse ici*",
                    "label" => "Réponse",
                    "required" => true,
                    "error" => "La réponse ne peut pas être vide",
                    "value" => $data['content'] ?? ''
                ]
            ]
        ];
    }
}
