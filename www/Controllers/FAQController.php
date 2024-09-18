<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\FAQ;
use App\Core\View;
use App\Core\User;

class FAQController
{
    public function list(): void
    {
        $faqs = (new FAQ())->findAll();
        $view = new View("FAQ/home", "back");
        $view->assign('faqs', $faqs);
        $view->render();
    }

    public function create(): void
    {
        $user = (new User())->findOneById($_SESSION['user_id']);
        if (!$user) return;
        $faqForm = new Form("FAQ");

        $question = "";
        $answer = "";

        if ($faqForm->isSubmitted()) {

            $question = $_POST["question"] ?? "";
            $answer = $_POST["answer"] ?? "";

            if ($faqForm->isValid()) {
                $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><b><i><u><strike><s><del><blockquote><center><code><ul><ol><li><a><img><div><span><br><strong><em>';
                $sanitized_question = strip_tags($question, $allowed_tags);
                $sanitized_answer = strip_tags($answer, $allowed_tags);

                $faq = new FAQ();
                $faq->setQuestion($sanitized_question);
                $faq->setAnswer($sanitized_answer);
                $faq->save();

                header('Location: /FAQ/home');
                exit();
            }
        }

        $faqForm->setValues([
            "question" => $question,
            "answer" => $answer,
        ]);

        $view = new View("FAQ/create", "Back");
        $view->assign('articleForm', $faqForm->build());
        $view->render();
    }

}
