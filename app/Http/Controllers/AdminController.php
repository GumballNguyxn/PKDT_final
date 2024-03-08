<?php

namespace App\Http\Controllers;
use App\Models\Product ;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
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
        // Danh sách các bảng cần đếm
        $tablesToCount = ['users', 'orders', 'products','product_categories','brands'];

        // Khởi tạo mảng để lưu số lượng bản ghi của từng bảng
        $tableCounts = [];

        // Lặp qua danh sách các bảng và truy vấn số lượng bản ghi
        foreach ($tablesToCount as $tableName) {
            $rowCount = DB::table($tableName)->count();
            $tableCounts[$tableName] = $rowCount;
        }
        return view('admin.index', ['tableCounts' => $tableCounts]);
    }
    public function store()
    {
        
    }

    public function profile(User $user)
    {
        
    }
}
