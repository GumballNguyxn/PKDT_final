<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $numberOfRecord = ProductCategory::count();
        $perPage = 10;
        $numberOfPage = $numberOfRecord % $perPage == 0 ?
            (int) ($numberOfRecord / $perPage) : (int) ($numberOfRecord / $perPage) + 1;
        $pageIndex = 1;
        if ($request->has('pageIndex'))
            $pageIndex = $request->input('pageIndex');
        if ($pageIndex < 1)
            $pageIndex = 1;
        if ($pageIndex > $numberOfPage)
            $pageIndex = $numberOfPage;
        //
        $categories = ProductCategory::orderBy('id', 'asc')
            ->skip(($pageIndex - 1) * $perPage)
            ->take($perPage)
            ->get();
        $brands = ProductCategory::paginate(3);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Thêm các quy tắc kiểm tra hợp lệ cho các trường khác nếu cần
        ]);
        $category = ProductCategory::create($validatedData);
        $category->save();
        return redirect()->route('admin.category.index')->with('mes', 'Thêm thành công');
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
    public function edit(ProductCategory $category)
    {
        //
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $category)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validatedData);

        return redirect()->route('admin.category.index')->with('mes', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $category)
    {
        //
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được xóa thành công.');
    }
}
