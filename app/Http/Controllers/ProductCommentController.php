<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request, $productId)
     {
         // Validate form data
         $validatedData = $request->validate([
             'name' => 'required|string',
             'messages' => 'required|string',
             'rating' => 'required|integer|between:1,5',
         ]);
     
         try {
             // Check if the user has already reviewed the product
             $comment = ProductComment::where('product_id', $productId)
                                      ->where('user_id', $request->user_id)
                                      ->first();
     
             if ($comment) {
                 // If a review exists, update it
                 $comment->update([
                     'name' => $validatedData['name'],
                     'messages' => $validatedData['messages'],
                     'rating' => $validatedData['rating'],
                 ]);
             } else {
                 // If no review exists, create a new one
                 $comment = ProductComment::create([
                     'product_id' => $productId,
                     'user_id' => $request->user_id,
                     'name' => $validatedData['name'],
                     'messages' => $validatedData['messages'],
                     'rating' => $validatedData['rating'],
                 ]);
             }
     
             // Redirect back to the product page with success message
             return redirect()->back()->with('success', 'Đã thêm/ cập nhật đánh giá');
         } catch (\Exception $e) {
             // Redirect back to the product page with error message
             return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm/ cập nhật đánh giá');
         }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
