<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\FAQ;
use App\Core\View;

class FAQController
{
    public function list(): void
    {
        $faqs = (new FAQ())->findAll();
        $view = new View("Faq/home", "back");
        $view->assign('faqs', $faqs);
        $view->render();
    }

    public function create(): void
    {
        $faqForm = new Form("Faq");

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

                header('Location: /faqs/home');
                exit();
            }
        }

        $faqForm->setValues([
            "question" => $question,
            "answer" => $answer,
        ]);

        $view = new View("Faq/create", "Back");
        $view->assign('faqForm', $faqForm->build());
        $view->render();
    }

    public function predelete(): void {

        if (isset($_GET['id'])) {
            $faqId = intval($_GET['id']);
            $faq = (new FAQ())->findOneById($faqId);
        } else {
            header("impossible de récupérer la FAQ", true, 404);
            header('Location: /404');
            exit();
        }

        $view = new View('Faq/delete', 'back');
        $view->assign('faq', $faq);
        $view->render();
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $faqId = intval($_GET['id']);
            $faq = (new FAQ())->findOneById($faqId);

            if ($faq) {
                $faq->delete();
                header('Location: /faqs/home');
                exit();
            } else {
                header("Faq non trouvée", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID FAQ non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

    public function edit(): void
    {
        if (isset($_GET['id'])) {
            $faqId = intval($_GET['id']);
            $faq = (new Faq())->findOneById($faqId);

            if ($faq) {
                $faqForm = new Form("Faq");
                $faqForm->setValues([
                    'question' => $faq->getQuestion(),
                    'answer' => $faq->getAnswer(),
                ]);

                if ($faqForm->isSubmitted() && $faqForm->isValid()) {

                    $faq->setQuestion($_POST['question']);
                    $faq->setAnswer($_POST['answer']);

                    $faq->save();

                    header('Location: /faqs/home');
                    exit();
                }

                $view = new View("Faq/edit", "back");
                $view->assign('faqForm', $faqForm->build());
                $view->render();
            } else {
                header("Faq non trouvée", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID faq non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

}
