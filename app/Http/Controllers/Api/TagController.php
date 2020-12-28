<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Tags;
use Exception;
use Illuminate\Http\JsonResponse as JsonResponseTag;
use Illuminate\Http\Request;

/**
 * Class TagController
 * @package App\Http\Controllers\Api
 */
class TagController extends Controller
{
    /** @var Tags */
    private $tag;

    /**
     * TagController constructor.
     * @param Tags $tag
     */
    public function __construct(Tags $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @return JsonResponseTag
     */
    public function index(): JsonResponseTag
    {
        $tags = $this->tag->paginate('10');
        return response()->json($tags, 200);
    }

    /**
     * @param int $id
     * @return JsonResponseTag
     */
    public function show(int $id): JsonResponseTag
    {
        try {
            $tag = $this->tag->findOrFail($id);
            return response()->json([
                'data' => $tag
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponseTag
     */
    public function save(Request $request): JsonResponseTag
    {
        $data = $request->all();

        try {
            $this->tag->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Tag cadastrada com sucesso!'
                ]
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponseTag
     */
    public function update(Request $request): JsonResponseTag
    {
        $data = $request->all();
        $tag = $this->tag->find($data['id']);

        try {
            $tag->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Tag atualizada com sucesso!'
                ]
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * @param int $id
     * @return JsonResponseTag
     */
    public function delete(int $id): JsonResponseTag
    {
        $tag = $this->tag->findOrFail($id);
        try {
            $tag->delete();
            return response()->json([
                'data' => [
                    'message' => 'Tag removida com sucesso!'
                ]
            ], 200);
        } catch (Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
