<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function __construct()
    {
       $this->authorizeResource(Category::class,'category'); // bunu kaldırıp duruma bak,kullanıcı yoksa bu eklenirse categoty, categories rotalarının hiç birine gidemez 403 hatası (policy de ?User $user dersek bu yazılan policy methodların da gueestler için 403 vermez)
       //$this->authorizeResource(Category::class)
       //$this->authorizeResource('category')
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::with(['articles'])->get(); //categoriler article relationları ile gelir
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        return redirect()->route('categories.show', $category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $category = Category::with(['articles'])->findOrFail($category->id);
        return view('categories.detail', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $category = Category::findOrFail($category->id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    //public function update(Request $request, $id)
    {

        if(auth()->user()->can('update',$category)){ //policy update
            dd($request);
            $request->validate([
                'name' => 'required'
            ]);

            $category = Category::findOrFail($category->id);
            //$category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->save();
        }


        return redirect()->route('categories.show', $category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        $category->delete();
        return redirect()->route('categories.index');
    }


    public function follow(Request $request, Category $category)
    {
        $category->followers()->attach($request->user()->id);
        return redirect()->route('categories.show', $category);
    }

    public function unfollow(Request $request, Category $category)
    {
        $category->followers()->detach($request->user()->id);
        return redirect()->route('categories.show', $category);
    }
}
