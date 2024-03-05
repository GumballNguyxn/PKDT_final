<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.profile');
    }

    public function update(Request $request, User $user)
    {
        $validatedData =  $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra định dạng và kích thước của ảnh
        ]);
    
        $imageName = time().'.'.$validatedData['avatar']->extension();  
    
        $validatedData['avatar']->move(public_path('avatars'), $imageName);
    
        // Lưu thông tin vào cơ sở dữ liệu
        $user->update([
            'avatar' => $imageName,
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);
        return redirect()->back();
    }

}
