@extends('layouts.app')
@section('title', Auth::user()->name)
@section('main')
			<div class="row gutters-sm">
				<div class="col-md-2 profile-list">
					<ul class="list-link">
						<li><a href="?info" class="">Thông tin cá nhân</a></li>
						<li><a href="?bought" class="">Đơn hàng đã đặt</a></li>
						<li><a href="?received" class="">Đơn hàng đã giao</a></li>
					</ul>
				</div>
                <div class="col-md-10 row info-profile">
					<div class="col-md-4 mb-3">
						<div class="card">
							<div class="card-body">
								<div class="d-flex flex-column align-items-center text-center">
									@if (Auth::user()->avatar == null)
										<img src="{{ asset('avatars/no_image.png') }}" alt="Avatar" class="rounded-circle" width="150">
									@else
										<img src="{{ asset('avatars/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle" width="150">
									@endif
									<div class="mt-3">
										<h4 style="font-size: 20px;">{{Auth::user()->name}}</h4>
										<p class="text-muted font-size-sm">{{Auth::user()->email}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="card-body" style="font-size: 20px; padding-bottom: 15%;">
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0" style="font-size: 20px;">Họ tên</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										{{Auth::user()->name}}
									</div>
								</div>
								<hr class="transparent-hr">
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0" style="font-size: 20px;">Email</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										{{Auth::user()->email}}
									</div>
								</div>
								<hr class="transparent-hr">
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0" style="font-size: 20px;">SĐT</h6>
									</div>
									<div class="col-sm-9 text-secondary">
										@if (Auth::user()->phone == null)
											<button class="btn-openForm" onclick="openForm()">Thêm SĐT</button>
										@else
											{{Auth::user()->phone}}
										@endif
									</div>
								</div>
								<hr class="transparent-hr">
								<div class="row">
									<div class="col-sm-3">
										<h6 class="mb-0" style="font-size: 20px;">Địa chỉ</h6>
									</div>
									<div class="col-sm-9 text-secondary">
									@if (Auth::user()->address == null)
											<button class="btn-openForm" onclick="openForm()">Thêm địa chỉ</button>
										@else
											{{Auth::user()->address}}
										@endif
									</div>
								</div>
							</div>
					</div>
					<!-- A button to open the popup form -->
					<button class="open-button btn btn-danger" onclick="openForm()">Chỉnh sửa</button>
				</div>
				
				<!-- The form -->
				<div class="form-popup col-md-8" id="editProfileForm">
					<form action="{{ route('update-profile', ['user'=>Auth::user()->id]) }}" method="POST" class="form-container d-grid gap-2" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="row">
							<div class="col-md-4 d-grid gap-2">
								<label for="inputAvatar"><b>Ảnh đại diện</b></label>
								<label for="inputName"><b>Họ tên</b></label>
								<label for="inputPhone"><b>Số điện thoại</b></label>
								<label for="inputAddress"><b>Địa chỉ</b></label>
							</div>
							<div class="col-md-6 d-grid gap-2">
								<input type="file" id="inputAvatar" name="avatar">
								<input type="text" value="{{ Auth::user()->name }}" id="inputName" name="name" required>
								<input type="text" value="{{ Auth::user()->phone }}" id="inputPhone" name="phone" required>
								<input type="text" value="{{ Auth::user()->address }}" id="inputAddress" name="address" required>
							</div>
						</div>
						<div class="row">
							<button type="submit" class="btn btn-danger">Xác nhận</button>
							<button type="button" class="btn btn-danger cancel" onclick="closeForm()">Đóng</button>
						</div>
					</form>
				</div>		
            </div>
@endsection
