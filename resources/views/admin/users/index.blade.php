@extends('admin.layouts.app')
@section('main')
    <!-- Main -->
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    
                    <div>
                        <h3>Người dùng</h3>
                        <div class="page-title-subheading">
                            Xem, thêm mới, xóa và quản lý.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="{{ route('users.create')}}" class="btn-shadow btn-hover-shine mr-3 btn btn-danger d-flex">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                            </svg>
                        </span>
                        Thêm
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">

                    <div class="card-header">

                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search"
                                    placeholder="Tìm kiếm" class="form-control">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                        </svg>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Họ tên</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">SĐT</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $item)
                                    <tr>
                                        <td class="text-center text-muted">{{$item->id}}</td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            @if ($item->avatar == null)
                                                                <img src="{{ asset('avatars/no_image.png') }}" alt="Avatar" width="40" height="40" class="rounded-circle" data-toggle="tooltip" title="Image" data-placement="bottom">
                                                            @else
                                                                <img src="{{ asset('avatars/' . $item->avatar) }}" alt="Avatar" width="40" height="40" class="rounded-circle" data-toggle="tooltip" title="Image" data-placement="bottom">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading" style="color: #1E1F29;">{{$item->name}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">{{$item->email}}</td>
                                        <td class="text-center">{{$item->phone}}</td>
                                        <td class="text-center">

                                            <a href="{{ route('users.show', ['user'=>$item->id])}}"
                                                class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                                Chi tiết
                                            </a>
                                            <!-- <a href="{{ route('users.edit', ['user'=>$item->id])}}" data-toggle="tooltip" title="Edit"
                                                data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                                <span class="btn-icon-wrapper opacity-8">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                    </svg>
                                                </span>
                                            </a> -->
                                            <form class="d-inline" action="{{route('users.destroy', ['pageIndex' => $pageIndex, 'user' => $item->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm" type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom" onclick="return confirm('Bạn có muốn xóa người dùng {{ $item->name }} (ID:{{$item->id}}) ?')">
                                                    <span class="btn-icon-wrapper opacity-8">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        <!-- phan trang o day -->
                        <div class="d-flex justify-content-center align-items-center my-2">
                            <a class="btn btn-light" href="{{route('users.index', ['pageIndex' => $pageIndex - 1])}}"><<</a>
                            @for($i = 1; $i <= $numberOfPage; $i++)
                                @if($pageIndex == $i)
                                    <a class="btn btn-secondary ms-2" href="{{route('users.index', ['pageIndex' => $i])}}">{{$i}}</a>
                                @else
                                    <a class="btn btn-light ms-2" href="{{route('users.index', ['pageIndex' => $i])}}">{{$i}}</a>
                                @endif
                            @endfor
                            <a class="btn btn-light ms-2" href="{{route('users.index', ['pageIndex' => $pageIndex + 1])}}">>></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->
	
@endsection
