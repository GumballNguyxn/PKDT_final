@extends('layouts.app')
@section('title', 'Trang chủ')
@section('main')

  <div class="pb-5">
      <!-- Container -->
      <div class="container">
        <div class="row">
            <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5" style="margin-top: 5%;">
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
                        <div class="py-2 text-uppercase"></div>
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
                <button class="btn btn-hover-shine btn-danger border-0 btn-sm" type="submit" data-toggle="tooltip" title="Delete" data-placement="bottom" onclick="return confirm('Bạn có muốn xóa sản phẩm này?')">
                    <span class="btn-icon-wrapper opacity-8">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                        </svg>
                    </span>
                </button>
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
        <a href="{{ url('products') }}" class="btn btn-outline-primary btn-lg" style="color: #ffffff; background-color: #0099FF;"> 
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
