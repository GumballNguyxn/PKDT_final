<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $numberOfRecord = User::count();
         $perPage = 5;
         $numberOfPage = $numberOfRecord % $perPage == 0?
              (int) $numberOfRecord / $perPage: (int) $numberOfRecord / $perPage + 1;
         $pageIndex = 1;
         if($request->has('pageIndex'))
             $pageIndex = $request->input('pageIndex');
         if($pageIndex < 1) $pageIndex = 1;
         if($pageIndex > $numberOfPage) $pageIndex = $numberOfPage;
         //
         $users = User::orderByDesc('id')
                 ->skip(($pageIndex-1)*$perPage)
                 ->take($perPage)
                 ->get();
         // dd($arr);
         return view('admin.users.index', compact( 'users', 'numberOfPage', 'pageIndex'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.users.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->route('users.index')->with('mes','Thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::where('id', $user->id)->first();
        return view('admin.users.show', compact('user'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        $pageIndex = 1;
        if($request->has('pageIndex')) $pageIndex = $request->input('pageIndex');
        $user->delete();
        return redirect()->back()->with('mes', 'Xóa thành công!');
    }

    public function profile(){
        return view('auth.profile');
    }
}
