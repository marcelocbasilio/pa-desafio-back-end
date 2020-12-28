<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Posts;
use Exception;
use Illuminate\Http\JsonResponse as JsonResponsePost;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers\Api
 *
 */
class PostController extends Controller
{
    /** @var Posts */
    private $post;

    /**
     * PostController constructor.
     * @param Posts $post
     */
    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    /**
     * @return JsonResponsePost
     */
    public function index(): JsonResponsePost
    {
        $posts = $this->post->with('tags')->paginate('10');
        return response()->json($posts, 200);
    }

    /**
     * @param int $id
     * @return JsonResponsePost
     */
    public function show(int $id): JsonResponsePost
    {
        try {
            $post = $this->post->with('tags')->findOrFail($id);
            return response()->json([
                'data' => $post
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponsePost
     */
    public function save(Request $request): JsonResponsePost
    {
        $data = $request->all();
        try {
            $post = $this->post->create($data);

            if (isset($data['tags']) && count($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }

            return response()->json([
                'data' => [
                    'message' => 'Post cadastrado com sucesso!'
                ]
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponsePost
     */
    public function update(Request $request): JsonResponsePost
    {
        $data = $request->all();

        try {
            $post = $this->post->findOrFail($data['id']);
            $post->update($data);

            if (isset($data['tags']) && count($data['tags'])) {
                $post->tags()->sync($data['tags']);
            }

            return response()->json([
                'data' => [
                    'message' => 'Post atualizado com sucesso!'
                ]
            ]);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param int $id
     * @return JsonResponsePost
     */
    public function delete(int $id): JsonResponsePost
    {
        $post = $this->post->findOrFail($id);
        try {
            $post->delete();
            return response()->json([
                'data' => [
                    'message' => 'Post removido com sucesso!'
                ]
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }


}
