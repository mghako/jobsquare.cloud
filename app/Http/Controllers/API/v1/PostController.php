<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Interfaces\Post\PostInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PostController extends Controller
{
    private PostInterface $postRepository;

    public function __construct(PostInterface $postRepository) {
        $this->postRepository = $postRepository; 
    }

    // get all posts
    public function index(): JsonResource {
        return $this->postRepository->getAllPosts();
    }

    // store posts
    public function store(StorePostRequest $storePostRequest): JsonResponse {
        return response()->json([
            'data' => $this->postRepository->createPost($storePostRequest->all())
        ], Response::HTTP_CREATED);
        
    }

    // show post
    public function show($id): JsonResource {
        return $this->postRepository->getPostById($id);
    }

    // update the post
    public function update($id, UpdatePostRequest $updatePostRequest): JsonResponse {
        return response()->json([
            'data' => $this->postRepository->updatePostById($id, $updatePostRequest->all())
        ]);
    }

    // delete post
    public function destroy($id) {
        $this->postRepository->deletePost($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
