<?php 
namespace App\Controller;

use App\Config\Session\UserSession;
use App\Controller\ErrorsController;
use App\Config\Request;
use App\DAO\PostDAO;
use App\DAO\CommentDAO;
use App\Model\Form;
use App\Controller\FormController;
use App\DAO\UserDAO;

class AdminController {

    private $postDAO;
    private $commentDAO;
    private $form;
    private $userDAO;
    private $validator;
    private $request;
    private $userSession;
  
    public function __construct()
    {
        $this->request = new Request();
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->form = new Form($this->request->getPost());
        $this->validator = new FormController($this->request->getPost());
        $this->userSession = new UserSession();
    }
    public function dashboard()
    {   
        if($this->userSession->admin()) {
            $posts = $this->postDAO->getPosts();
            $comments = $this->commentDAO->getValidatedComments();
            $users = $this->userDAO->getUsers();
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php'; 
    }
    public function editorDashboard()
    {   
        if($this->userSession->admin()) {
            $posts = $this->postDAO->getPosts();
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/editorDashboard.php';
    }
    public function validateComment($commentId)
    {   
        if($this->userSession->admin()) {
            $posts = $this->postDAO->getPosts();
            $comments = $this->commentDAO->getValidatedComments();
            $this->commentDAO->validateComment($commentId);
            $this->userSession->redirection();
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php';
    }
    public function deleteComment($commentId) 
    {
        if($this->userSession->admin()) {
            $posts = $this->postDAO->getPosts();
            $comments = $this->commentDAO->getValidatedComments();
            $this->commentDAO->deleteComment($commentId);
            $this->userSession->redirection();
        }
        else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php';
    }
    public function addPost($method) 
    {
        if ($this->userSession->admin() || $this->userSession->editor()) {
            $form = $this->form;
            $validator = $this->validator;
            $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
            $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    if ($method['author'] === $_SESSION['pseudo']) {
                        $method['author'] = substr_replace($_SESSION['pseudo'], $_SESSION['id_user'], 0);
                        $this->postDAO->addPost($method);
                        $succes_addPost = "Votre article a bien été ajouté.";
                    } else {
                        $error_authorAddPost = "Le champ auteur est mal renseigné.";
                    }
                } else {
                    $error_addPost = "Une erreur est survenue.";
                }
            }
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/addPost.php'; 
    }
    public function deletePost($postId) 
    {
        if($this->userSession->admin() || $this->userSession->editor()) {
            $this->postDAO->deletePost($postId);
            $this->userSession->redirection();
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php';
    }
    public function editPost($method,$postId) 
    {
        if ($this->userSession->admin() || $this->userSession->editor()) {
            $form = $this->form;
            $post = $this->postDAO->getPost($postId);
            $validator = $this->validator;
            $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
            $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    if ($method['author'] === "Magali") {
                        $method['author'] = substr_replace("Magali", "1", 0);
                        $this->postDAO->editPost($method, $postId);
                        $succes_editPost = "Votre article a bien été modifié";
                    } elseif ($method['author'] === "Marie") {
                        $method['author'] = substr_replace("Marie", "2", 0);
                        $this->postDAO->editPost($method, $postId);
                        $succes_editPost = "Votre article a bien été modifié";
                    }
                } else {
                    $error_editPost = "Une erreur est survenue lors de la modification de votre article.";
                }
            }
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/editPost.php'; 
    }
    public function deleteUser($userId) 
    {
        if($this->userSession->admin()) {
            $this->userDAO->deleteUser($userId);
            $this->userSession->redirection();
        }
        else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php';
    }
}
