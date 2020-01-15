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
        $comment->setAuthor($data['username']);
        $comment->setCreate_date($data['create_date']);
        return $comment;
    }
    public function getComments($postId)
    {
        $req = $this->prepareDB('SELECT comments.id_comment, comments.content, users.username,comments.create_date FROM comments INNER JOIN users ON user_id = id_user WHERE post_id = ?',[$postId]);
        $comments = [];
        foreach ($req as $data) { 
            $comments[] = $this->commentObject($data);
        }
        return $comments;
    }
}