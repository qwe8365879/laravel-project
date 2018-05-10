<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Article;
use App\Transformers\ArticleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;
use App\Exceptions\AccessDenyException;

class ArticleController extends Controller
{
    //
    public function index(){
        $articles = Article::all();

        return Fractal::includes('author')->collection($articles, new  ArticleTransformer); 
        // return response()->json($articles, 200);
    }

    public function show($id){
        $article = Article::find($id);
        return Fractal::includes('author')->item($article, new  ArticleTransformer); 
        // return response()->json($article, 200);
    }

    public function store(\App\Http\Requests\Api\Article\StoreArticleRequest $request){
        $article = new Article;
        $article->author_id = $request->user()->id;
        $article->title = $request->title;
        $article->slug = str_slug( $request->title );
        $article->description = $request->description;
        $article->save();

        return Fractal::includes('author')->item($article, new  ArticleTransformer); 
        // return response()->json($article, 201);
    }

    public function update(\App\Http\Requests\Api\Article\UpdateArticleRequest $request, $id){
        $article = Article::findOrFail($id);
        $article->title = $request->get('title', $article->title);
        $article->description = $request->get('description', $article->description);
        $article->slug = $request->has('title') ? str_slug( $request->get('title') ) : $article->slug;
        $article->update();

        return Fractal::includes('author')->item($article, new  ArticleTransformer); 
        // return response()->json($article, 200);
    }

    public function destroy(Request $request, $id){
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(null, 204);
    }
}
