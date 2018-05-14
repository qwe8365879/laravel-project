<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\Article;
use App\Model\Notification;
use App\Transformers\ArticleTransformer;
use Cyvelnet\Laravel5Fractal\Facades\Fractal;

class NotificationController extends Controller
{
    public function index(){
        
        $data = Notification::all()->orderByKey()->getValue();

        // $request = new \stdClass;
        // $request->article = "Sdfsfsdf";
        // $request->checked = false;
        // $this->store($request);

        return view('notification.article.index', compact('data'));
    }

    public function show(Request $request, $id){
        $data = Notification::find($id)->getValue();
        return view('notification.article.index', compact('data'));
    }

    public function store($request){
        $data = new Notification();
        $data->article = $request->article;
        $data->checked = $request->checked;
        $data->save();
    }
}
