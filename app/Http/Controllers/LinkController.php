<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Tag;
use App\Models\Category;

class LinkController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Link::with(['tags', 'category']);

        if($request->filled('search')){
            $search =  $request->search;
            $query->where('title', 'like', "%$search%");
        }
        if($request->filled('category_id')){
        $query->where('category_id', $request->category_id);
        }
        $links = $query->latest()->get();
        $categories = Category::all();
        return view('links.index', compact('links', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('links.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'title'       => 'required|string|max:255',
        'url'         => 'required|url',
        'category_id' => 'required|exists:categories,id',
        'tags'        => 'required|array',
        'tags.*'      => 'exists:tags,id',
    ]);

    $link = Link::create($data);
    
    $link->tags()->attach($request->tags);

    return redirect()->route('links.index')->with('success', 'Link added successfully');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $link = Link::with(['category', 'tags'])->findOrFail($id);
        return view('links.show', compact('link'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('links.index')->with('success', 'Link deleted successfully');
    }
}
