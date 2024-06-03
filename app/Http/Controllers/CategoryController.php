<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of( Category::query())->addIndexColumn()
            // ->addColumn('mode', function(Category $category){
            //     if ($category->mode) {
            //         # code...
            //     } else {
            //         # code...
            //     }

            // })
            // ->rawColumns(['mode'])
            ->make(true);
        }
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'keywords' => $request->keywords,
            'mode' => $request->mode
        ]);

        return redirect()->route('categories.index')->with(['status' => 200, 'message' => 'Category created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug): View
    {
        $category = Category::where('slug',$slug)->first();
        return view('categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {

        $category = Category::where('slug',$slug)->first();
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {

        // return $request;
        $category = Category::where('slug',$slug)->first();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->keywords = $request->keywords;
        $category->mode = $request->mode;
        $category->update();
        return redirect()->route('categories.index')->with(['status' => 200, 'message' => 'Category Updated']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['success' => 'Category Detached and deleted !']);
    }
}
