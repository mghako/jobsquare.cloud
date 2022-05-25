<?php

namespace App\Repositories\Post;

use App\Http\Resources\Posts\PostResource;
use App\Interfaces\Post\PostInterface;
use App\Models\Post;

class PostRepository implements PostInterface
{
    // view all posts
    public function getAllPosts() {
        return PostResource::collection(Post::paginate());
    }

    // find individual post
    public function getPostById($id) {
        return new PostResource(Post::findOrFail($id));
    }

    // store post data
    public function createPost(array $data) {
        return Post::create($data);
    }

    // update post data
    public function updatePostById($id, array $data) {
        return $this->getPostById($id)->update($data);
        // return Post::whereId($id)->update($data);
    }

    // delete post data
    public function deletePost($id) {
        return Post::findOrFail($id)->delete();
    }
}
