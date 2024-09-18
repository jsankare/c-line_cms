<?php

namespace App\Controller;

use App\Core\Form;
use App\Models\Review;
use App\Core\View;

class ReviewController
{
    public function list(): void
    {
        $reviews = (new Review())->findAll();
        $view = new View("Review/home", "back");
        $view->assign('reviews', $reviews);
        $view->render();
    }

    public function create(): void
    {
        $reviewForm = new Form("Review");

        $firstname = "";
        $lastname = "";
        $position = "";
        $comment = "";
        $rating = "";

        if ($reviewForm->isSubmitted()) {

            $firstname = $_POST["firstname"] ?? "";
            $lastname = $_POST["lastname"] ?? "";
            $position = $_POST["position"] ?? "";
            $comment = $_POST["comment"] ?? "";
            $rating = $_POST["rating"] ?? "";

            if ($reviewForm->isValid()) {
                $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><b><i><u><strike><s><del><blockquote><center><code><ul><ol><li><a><img><div><span><br><strong><em>';
                $sanitized_firstname = strip_tags($firstname, $allowed_tags);
                $sanitized_lastname = strip_tags($lastname, $allowed_tags);
                $sanitized_position = strip_tags($position, $allowed_tags);
                $sanitized_comment = strip_tags($comment, $allowed_tags);

                $review = new Review();
                $review->setFirstname($sanitized_firstname);
                $review->setLastname($sanitized_lastname);
                $review->setPosition($sanitized_position);
                $review->setComment($sanitized_comment);
                $review->setRating($rating);
                $review->save();

                header('Location: /reviews/home');
                exit();
            }
        }

        $reviewForm->setValues([
            "firstname" => $firstname,
            "lastname" => $lastname,
            "position" => $position,
            "comment" => $comment,
            "rating" => $rating,

        ]);

        $view = new View("Review/create", "Back");
        $view->assign('reviewForm', $reviewForm->build());
        $view->render();
    }

    public function predelete(): void {

        if (isset($_GET['id'])) {
            $reviewId = intval($_GET['id']);
            $review = (new Review())->findOneById($reviewId);
        } else {
            header("impossible de récupérer la Review", true, 404);
            header('Location: /404');
            exit();
        }

        $view = new View('Review/delete', 'back');
        $view->assign('review', $review);
        $view->render();
    }

    public function delete(): void
    {
        if (isset($_GET['id'])) {
            $reviewId = intval($_GET['id']);
            $review = (new Review())->findOneById($reviewId);

            if ($review) {
                $review->delete();
                header('Location: /reviews/home');
                exit();
            } else {
                header("Review non trouvée", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID Review non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

    public function edit(): void
    {
        if (isset($_GET['id'])) {
            $reviewId = intval($_GET['id']);
            $review = (new Review())->findOneById($reviewId);

            if ($review) {
                $reviewForm = new Form("Review");
                $reviewForm->setValues([
                    'firstname' => $review->getFirstname(),
                    'lastname' => $review->getLastname(),
                    'position' => $review->getPosition(),
                    'comment' => $review->getComment(),
                    'rating' => $review->getRating(),
                ]);

                if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {

                    $review->setFirstname($_POST['firstname']);
                    $review->setLastname($_POST['lastname']);
                    $review->setPosition($_POST['position']);
                    $review->setComment($_POST['comment']);
                    $review->setRating($_POST['rating']);

                    $review->save();

                    header('Location: /reviews/home');
                    exit();
                }

                $view = new View("Review/edit", "back");
                $view->assign('reviewForm', $reviewForm->build());
                $view->render();
            } else {
                header("Review non trouvée", true, 404);
                header('Location: /404');
                exit();
            }
        } else {
            header("ID review non spécifié", true, 500);
            header('Location: /500');
            exit();
        }
    }

}
