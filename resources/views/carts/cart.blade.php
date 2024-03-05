@extends('layouts.app')
@section('title', 'Trang chủ')
@section('main')

  <div class="pb-5">
      <!-- Container -->
      <div class="container">
        <div class="row">
            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
              <div class="container text-center my-5">
                  <h2 class="display-4">Giỏ hàng</h2>
              </div>

              <!-- Shopping cart table -->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0 bg-light">
                        <div class="p-2 px-3 text-uppercase">Hình ảnh</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="p-2 px-3 text-uppercase">Tên chi tiết</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="py-2 text-uppercase">Giá</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="py-2 text-uppercase">Số Lượng</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="py-2 text-uppercase">Tổng tiền</div>
                      </th>
                      <th scope="col" class="border-0 bg-light">
                        <div class="py-2 text-uppercase">Xóa</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
    @php
    $totalPrice = 0; // Khởi tạo biến tổng tiền
    @endphp
    @foreach($cart->items as $item)
    <tr>
        <td class="border-0">
            <div class="p-2">
                @if($item->product->productImage->isNotEmpty())
                    <?php $firstImage = $item->product->productImage->first(); ?>
                    <img src="products_img/{{$firstImage->path }}" alt="{{ $item->product->name }}" width="70" class="img-fluid rounded shadow-sm">
                @endif
            </div>
        </td>
        <td class="border-0 align-middle"><strong>{{ $item->product->name }}</strong></td>
        <td class="border-0 align-middle"><strong>{{ number_format($item->price) }}</strong></td>
        <td class="border-0 align-middle"><strong>{{ $item->quantity }}</strong></td>
        <td class="border-0 align-middle"><strong>{{  number_format($item->quantity * $item->price) }}</strong></td>
        <td class="border-0 align-middle">
            <form action="/carts/{{$item->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Xóa</button>
            </form>
        </td>
    </tr>
    @php
    // Tính tổng tiền cho từng sản phẩm và cộng vào tổng tiền
    $totalPrice += $item->quantity * $item->price;
    @endphp
    @endforeach
</tbody>
<tfoot>
<tr>
    <td colspan="5" class="text-right"><h3><strong>Tổng tiền: {{ number_format($totalPrice) }} VNĐ</strong></h3></td>
</tr>
<tr>
    <td colspan="5" class="text-right">
        <a href="{{ url('products') }}" class="btn btn-outline-primary btn-lg" style="color: #ffffff; background-color: #add8e6;"> 
            Tiếp tục mua sắm
        </a>
        <a href="{{ url('checkouts') }}" class="btn btn-danger btn-lg" style="background-color: #b20000;">
            Thanh toán
        </a>
    </td>
</tr>
</tfoot>

                </table>
              </div>
              <!-- End -->
            </div>
        </div>
      </div>
      <!-- EndContainer -->  
  </div>


@endsection
