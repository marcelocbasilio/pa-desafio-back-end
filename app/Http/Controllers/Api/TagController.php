<?php

namespace App\Http\Controllers\Api;

use App\Tags;
use Illuminate\Http\JsonResponse as JsonResponseTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
