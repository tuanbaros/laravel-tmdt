@extends('admin.admin')
@section('title-header')
<h1 class="page-header">THÔNG TIN CHI TIẾT ĐƠN HÀNG</h1>
@endsection
@section('content')
<div class="row dashboard_graph     ">
    <div class="col-sm-12">
        <big>
            <div class="col-sm-3">
                <p>Đơn Hàng</p>
                <p>Ngày</p>
                <p>Trạng Thái</p>
            </div>
            <div class="col-sm-9">
                <p>{{$bill->id}}</p>
                <p>{{$bill->updated_at}}</p>
                <p>{{$bill->status}}</p>
            </div>
        </big>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <h4>Tóm Tắt</h4>
        <hr style="border: 1px solid rgb(186, 186, 186)"/>
        <big>
            <div class="col-sm-3">
                <p>Hình Thức Thanh Toán</p>
                <p>Hình Thức Giao Hàng</p>
                <p>Giảm Giá</p>
                <p>Phí Vận Chuyển</p>
                <p>Tổng Cộng</p>
            </div>
            <div class="col-sm-9">
                <p>Thanh toán khi nhận hàng</p>
                <p>Giao hàng/Voucher giấy Tận Nơi</p>
                <p>0$</p>
                <p>0$</p>
                <p>{{$order->total_cost}}$</p>
            </div>
        </big>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>

        <h4>Thông Tin Khách Hàng</h4>
        <hr style="border: 1px solid rgb(186, 186, 186)"/>
        <big>
            <div class="col-sm-3">
                @if($user!=null)
                    <p>Người đặt</p>
                @endif
                <p>Người nhận</p>
                <p>Địa Chỉ</p>
                <p>Số Điện Thoại</p>
            </div>
            <div class="col-sm-9">
                @if($user!=null)
                    <p>{{$user->name}}</p>
                @endif
                    <p>{{$bill->name_customer}}</p>
                    <p>{{$bill->address}}</p>
                    <p>{{$bill->phone}}</p>
            </div>
        </big>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <h4>Thông Tin Deals</h4>
        <hr style="border: 1px solid rgb(186, 186, 186)"/>
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Sản Phẩm</th>
                <th>Giá Bán</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            @if($cart_books!=null)
                @foreach($cart_books as $cb)
                    <?php $book = $cb->books?>
                    <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$book->title}}</td>
                        <td>{{$book->new_price}}$</td>
                        <td>{{$cb->quantity}}</td>
                        <td>{{$book->new_price*$cb->quantity}}$</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection('content')
