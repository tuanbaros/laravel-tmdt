@extends('admin.admin')

@section('title-header')
    <h1 class="page-header">Thông Tin Sách</h1>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Book
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <img src="{{$image->url}}" alt="{{$image->description}}" style="width:140px;height:210px;">
                    <br/>
                    <br/>
                    <div class="dataTable_wrapper">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                            <ul class="list-group">
                                <li class="list-group-item">Tên sản phẩm :
                                    <span style="margin-right: 6%"></span> {{$book->title}}</li>
                                <li class="list-group-item">Category :
                                    <span style="margin-right: 9%"></span> {{$category->name}}</li>
                                <li class="list-group-item">Ngôn Ngữ :
                                    <span style="margin-right: 9%"></span> {{$book->language}}</li>
                                <li class="list-group-item">Đánh Giá :
                                    <span style="margin-right: 9%"></span> {{$book->rate_average}}</li>
                                <li class="list-group-item">Giá Cũ :
                                    <span style="margin-right: 11%"></span> {{$book->price}}</li>
                                <li class="list-group-item">Giá Mới :
                                    <span style="margin-right: 10%"></span> {{$book->new_price}}</li>
                                <li class="list-group-item">Số Lượng :
                                    <span style="margin-right: 9%"></span> {{$book->quantity_remain}}</li>
                                <li class="list-group-item">NGày Phát Hành :
                                    <span style="margin-right: 5%"></span> {{$book->date_releases}}</li>
                            </ul>

                            <div class="panel panel-primary">
                                <div class="panel-heading">Mô Tả Sản Phẩm</div>
                                <div class="panel-body">
                                    {{$book->description}}
                                </div>
                            </div>
                            <div class="panel panel-primary">
                                <div class="panel-heading">Thông Tin Tác Giả</div>
                                <div class="panel-body">
                                    <img src="{{$author->avatar}}" alt="{{$author->avatar}}" style="width:140px;height:210px;">
                                    <ul class="list-group">
                                        <li class="list-group-item">Tên Tác Giả :
                                            <span style="margin-right: 6%"></span> {{$author->name}}</li>
                                        <li class="list-group-item">Giới Thiệu :
                                            <span style="margin-right: 7%"></span> {{$author->introduce}}</li>
                                        <li class="list-group-item">Liên Hệ :
                                            <span style="margin-right: 9%"></span> {{$author->contact}}</li>
                                    </ul>


                                </div>
                            </div>
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection