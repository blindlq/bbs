<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Transformers\LinkTransformer;

class LinksController extends Controller
{
    //
    public function index(Link $link)
    {
        $links = $link->getAllCached();

        return $this->response->collection($links, new LinkTransformer());
    }
}
