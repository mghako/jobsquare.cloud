<?php

namespace App\Interfaces\Post;

interface PostInterface
{
    public function getAllPosts();

    public function getPostById($id);

    public function createPost(array $data);

    public function updatePostById($id, array $data);

    public function deletePost($id);
}
