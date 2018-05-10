<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;

class ArticleController extends Controller
{
    //
    public function index(){
        $articles = Article::all();

        return response()->json($articles, 200);
    }

    public function show(Request $request, $id){
        $article = Article::find($id);
        // if($request->user('api')->id != $article->author_id){
        //     return response()->json(['error' => 'You don\'t have permission.'], 403);
        // }
        return response()->json($article, 200);
    }

    public function store(\App\Http\Requests\Api\Article\Store $request){
        $article = new Article;
        $article->author_id = $request->user()->id;
        $article->title = $request->title;
        $article->slug = str_slug( $request->title );
        $article->description = $request->description;
        $article->save();

        return response()->json($article, 201);
    }

    public function update(\App\Http\Requests\Api\Article\Update $request, $id){
        $article = Article::findOrFail($id);

        if($request->user('api')->id != $article->author_id){
            return response()->json(['error' => 'You don\'t have permission.'], 403);
        }
        $article->title = $request->get('title', $article->title);
        $article->description = $request->get('description', $article->description);
        $article->slug = $request->has('title') ? str_slug( $request->get('title') ) : $article->slug;
        $article->update();
        return response()->json($article, 200);
    }

    public function destroy(Request $request, $id){
        $article = Article::findOrFail($id);
        if($request->user('api')->id != $article->author_id){
            return response()->json(['error' => 'You don\'t have permission.'], 403);
        }
        $article->delete();

        return response()->json(null, 204);
    }
}
