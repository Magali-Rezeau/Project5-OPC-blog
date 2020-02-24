<?php 
namespace App\Model\DAO;

use App\Model\DAO\Database;
use App\Model\Comment;

class CommentDAO extends Database 
{
    /**
     * create comment object
     *
     * @param  string $data
     *
     * @return object
     */
    private function commentObject($data)
    {
        $comment = new Comment();
        $comment->setId_comment($data['id_comment']);
        $comment->setContent($data['content']);
        $comment->setAuthor($data['pseudo']);
        isset($data['profile_picture']) ? $comment->setProfile_picture($data['profile_picture']): '';
        $comment->setCreate_date($data['create_date']);
        isset($data['post_id']) ? $comment->setPost_id($data['post_id']) : '';
        return $comment;
    }
    /**
     * get all validated comments from a post
     *
     * @param  integer $postId
     *
     * @return array
     */
    public function getComments($postId)
    {
        $req = $this->prepareDB('SELECT comments.id_comment, comments.content, users.pseudo, users.profile_picture,comments.create_date, comments.validation FROM comments INNER JOIN users ON user_id = id_user WHERE comments.post_id = ? AND comments.validation = "validate" ORDER BY comments.create_date DESC',[$postId]);
        $comments = [];
        foreach ($req as $data) { 
            $commentId = $data['id_comment'];
            $comments[$commentId] = $this->commentObject($data);
        }
        return $comments;
    }
    /**
     * add a comment in DB
     *
     * @param  array $method = $_POST
     * @param  integer $userId
     * @param  integer $postId
     *
     */
    public function addComment($method,$userId,$postId) 
    {
        $req = $this->prepareDB('INSERT INTO comments(content, user_id, post_id,validation,create_date) VALUES (?,?,?,"noValidate", NOW())',[$method['content'],$userId,$postId]);    
    } 
    /**
     * get all not validated comments
     *
     * @return array
     */
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
    /**
     * update validation comments by administrator in DB
     *
     * @param  integer $commentId
     *
     */
    public function validateComment($commentId) 
    {
        $req = $this->prepareDB('UPDATE comments SET comments.validation = "validate" WHERE id_comment = :id_comment',
        ['id_comment' => $commentId]);
    }
    /**
     * delete comments in DB
     *
     * @param  integer $commentId
     *
     */
    public function deleteComment($commentId) 
    {
        $req = $this->prepareDB('DELETE FROM comments WHERE id_comment = ?', [$commentId]);
    }
}
