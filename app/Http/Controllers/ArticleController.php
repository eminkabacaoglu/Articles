<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use App\Mail\ArticleCreated;
use App\Events\ArticleCreated as ArticleCreatedEvent;


class ArticleController extends Controller
{
    public function __construct()
    {
        
        //$this->middleware('author')->except(['index', 'show']);

    }
    public function index()
    //public function index(Request $request, Article $article) //policy için
    {
        
        //$this->authorize('view',$article); // resource controller olmadan policyuygulanması /articles sayfası
        // Article listeleme
        $articles = Article::with(['category', 'user', 'tags'])->latest()->get();
        return view("articles.index", compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', compact('categories'));
    }

    public function edit($id)
    {
        
        $article = Article::with(['category'])->findOrFail($id);
        $categories = Category::all();
        return view('articles.edit', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required',
            'content' => 'required|string|min:3',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;
        $article->save();

        return redirect('/articles/' . $article->id);
    }

    public function show($id)
    {
        $article = Article::with(['category'])->findOrFail($id);
        return view('articles.detail', compact('article'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required',
            'content' => 'required|string|min:3',
            'tags' => 'nullable|string'
        ]);

        $article = new Article;
        $article->category_id = $request->category_id;
        $article->user_id=$request->user()->id;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->save();

        $article->setTags($request->tags);
        //dd($request->user());
        //Mail::to($request->user()->email)->send(new ArticleCreated($article)); // listener event kullanmadan mail gönderme.Alternatif 1
        //ArticleCreatedEvent::dispatch($article); //event listener ile kullanım. Alternatf 2
        //Model üzerinden event tetiklemek Alternatif 3. bu sebeple bir üst satırı kaldırdık. Article modelinde gidiyoruz


        return redirect('/articles/' . $article->id);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('/articles/');
    }
}
