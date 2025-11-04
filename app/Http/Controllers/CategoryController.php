<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::orderBy('id', 'DESC')->get();
        $title = 'Data Categories';
        return view('category.index', compact('category', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string',
        // ]);

        // Category::create([
        //     'name' => $request->name,
        // ]);
        Category::create($request->all());
        alert()->success('Success', 'data created successfully ');
        return redirect()->to('category');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('category.create', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        // $request->validate([
        //     "name" => 'required|string',
        // ]);

        // $datas = [
        //     'name' => $request->name,
        // ];
        // $category->update($datas);
        $category->name = $request->name;
        $category->save();
        alert()->success('Success', 'data Updated successfully ');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        alert()->success('Success', 'data Deleted successfully ');
        return redirect()->route('category.index');
    }
}
