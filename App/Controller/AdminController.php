<?php 
namespace App\Controller;

use App\Config\Session\Session;
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
    private $session;
  
    public function __construct()
    {
        $this->request = new Request();
        $this->postDAO = new PostDAO();
        $this->commentDAO = new CommentDAO();
        $this->userDAO = new UserDAO();
        $this->form = new Form($this->request->getPost());
        $this->validator = new FormController($this->request->getPost());
        $this->userSession = new UserSession();
        $this->session = new Session();
    }
    public function dashboard()
    {   
        if($this->userSession->checkAdmin()) {
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
        if($this->userSession->checkEditor()) {
            $posts = $this->postDAO->getPosts();
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/editorDashboard.php';
    }
    public function validateComment($commentId)
    {   
        if($this->userSession->checkAdmin()) {
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
        if($this->userSession->checkAdmin()) {
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
        if ($this->userSession->checkAdmin() || $this->userSession->checkEditor()) {
            $form = $this->form;
            $validator = $this->validator;
            $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
            $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->postDAO->addPost($method);
                    $this->session->set('addPost',"Votre article a bien été ajouté.");
                } else {
                    $this->session->set('error_addPost',"Une erreur est survenue lors de l'ajout d'un article.");
                }
            }           
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/addPost.php'; 
    }
    public function deletePost($postId) 
    {
        if($this->userSession->checkAdmin() || $this->userSession->checkEditor()) {
            $this->postDAO->deletePost($postId);
            $this->userSession->redirection();
        } else {
            $this->session->set('error_deletePost',"Une erreur est survenue lors de la suppression d'un article.");
        }
        require '../Views/admin/dashboard.php';
    }
    public function editPost($method,$postId) 
    {
        if ($this->userSession->checkAdmin() || $this->userSession->checkEditor()) {
            $form = $this->form;
            $post = $this->postDAO->getPost($postId);
            $validator = $this->validator;
            $validator->check('short_content', 'maxLenght', 'Ce champ doit comporter moins de 300 caractères', 300);
            $validator->check('title', 'minLenght', 'Le titre doit comporter au moins 3 caractères', 3);
            if (!empty($method)) {
                $errors = $validator->getErrors();
                if (empty($errors)) {
                    $this->postDAO->editPost($method, $postId);
                    $this->session->set('editPost',"Votre article a bien été modifié.");
                } else {
                    $this->session->set('error_editPost',"Une erreur est survenue lors de la modification de votre article.");
                }
            }
        } else {
            $this->userSession->redirection();
        }
        require '../Views/admin/editPost.php'; 
    }
    public function deleteUser($userId) 
    {
        if($this->userSession->checkAdmin()) {
            $this->userDAO->deleteUser($userId);
            $this->userSession->redirection();
        }
        else {
            $this->userSession->redirection();
        }
        require '../Views/admin/dashboard.php';
    }
}
