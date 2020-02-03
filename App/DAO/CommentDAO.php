<?php 
namespace App\DAO;

use App\DAO\Database;
use App\Model\Comment;

class CommentDAO extends Database {

    private function commentObject($data)
    {
        $comment = new Comment();
        $comment->setId_comment($data['id_comment']);
        $comment->setContent($data['content']);
        $comment->setAuthor($data['pseudo']);
        $comment->setCreate_date($data['create_date']);
        isset($data['post_id']) ? $comment->setPost_id($data['post_id']) : '';
        $comment->setPost_id($data['post_id']);
        return $comment;
    }
    public function getComments($postId)
    {
        $req = $this->prepareDB('SELECT comments.id_comment, comments.content, users.pseudo,comments.create_date, comments.validation FROM comments INNER JOIN users ON user_id = id_user WHERE comments.post_id = ? AND comments.validation = "validate" ORDER BY comments.create_date DESC',[$postId]);
        $comments = [];
        foreach ($req as $data) { 
            $commentId = $data['id_comment'];
            $comments[$commentId] = $this->commentObject($data);
        }
        return $comments;
    }
    public function addComment($method,$postId) 
    {
        $req = $this->prepareDB('INSERT INTO comments(content, user_id, post_id,create_date) VALUES (?,1,?, NOW())',[$method['content'],$postId]);    
    } 
    public function getValidatedComments() 
    {
        $req = $this->queryDB('SELECT comments.id_comment, comments.content, users.pseudo,comments.create_date, comments.validation, comments.post_id FROM comments INNER JOIN users ON user_id = id_user WHERE comments.validation = "noValidate" ORDER BY comments.create_date DESC');
        $comments = [];
        foreach ($req as $data) { 
            $commentId = $data['id_comment'];
            $comments[$commentId] = $this->commentObject($data);
        }
        return $comments;
    }
    public function validateComment($commentId) 
    {
        $req = $this->prepareDB('UPDATE comments SET comments.validation = "validate" WHERE id_comment = :id_comment',
        ['id_comment' => $commentId]);
    }
    public function deleteComment($commentId) 
    {
        $req = $this->prepareDB('DELETE FROM comments WHERE id_comment = ?', [$commentId]);
    }
}
