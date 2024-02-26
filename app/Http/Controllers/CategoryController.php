<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('category.index', compact('category'));
    }

    public function create()
    {
        $category = category::all();
        return view('category.create', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        // dd($request);
        $category = new category([
            'name' => $request->name
        ]);

        $category->save();

        return redirect()->route('category.create')->with('success', 'category created successfully');
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
    
        $category = Category::findOrFail($id);
    
        // Update fields from the form
        $category->update([
            'name' => $request->name
        ]);
    
        return redirect()->route('category.index')->with('success', 'category updated successfully');
    }

    
    public function destroy($id)
    {
        category::where('id', $id)->delete();
        return redirect(route('category.index'));
    }

}
