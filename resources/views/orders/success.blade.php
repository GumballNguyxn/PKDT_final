@extends('layouts.app')
@section('main')
    

    <div class="confirmation">
        <div class="card">
            <div class="checkmark">
                <img src="{{ asset('img/checked.png') }}" alt="Checkmark Image"class="checkmark-img">

            </div>

            <div class="card-header text-white">
                <h2 class="mb-0">Bạn đã đặt hàng thành công!</h1>
            </div>
                <p class="mb-0">Đơn Hàng #{{ $order->id }}  </p>
            

        </div>
    
        <!-- <div class="order-id">Order ID: 12458</div>
        <div class="email">We have sent your order confirmation and invoice to thisemail@gmail.com</div> -->
    </div>
     <!-- Thêm nút "Tiếp tục mua sắm" -->
     <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-lg custom-button-color">Tiếp tục mua sắm</a>
    </div>
    
        <div style="margin-top: 120px;" id="newsletter" >
			<!-- container -->

			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">							
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>   
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
                
                <p style="margin-top: 20px; margin-bottom: 30px;">For any question, we're available at <a href="" class="email-link">nhom3@email.com</a></p>  
                
			</div>
			<!-- /container -->
		</div>

    <style>
        body {
            text-align: center;
        }
        .confirmation {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 80px auto 20px; /* Thay đổi giá trị margin-top thành 40px, hoặc giá trị phù hợp với thiết kế của bạn */
            max-width: 65%;
        }
        

        .checkmark-img {
            width: 35px;
            margin:  15px;
        }
       
      
        .email-link {
            color: red;
        }
        .mt-4{
            margin: 35px;
        }
    </style>

@endsection