<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $numberOfRecord = Brand::count();
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
        $brands = Brand::orderBy('id', 'asc')
            ->skip(($pageIndex - 1) * $perPage)
            ->take($perPage)
            ->get();
        $brands = Brand::paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.brand.create');
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
        $brand = Brand::create($validatedData);
        $brand->save();
        return redirect()->route('brand.index')->with('mes', 'Thêm thành công');
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
    public function edit(Brand $brand)
    {
        //
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update($validatedData);

        return redirect()->route('brand.index')->with('mes', 'Sửa thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        //
        $brand->delete();
        return redirect()->route('brand.index')->with('success', 'Thương hiệu đã được xóa thành công.');
    }
}
