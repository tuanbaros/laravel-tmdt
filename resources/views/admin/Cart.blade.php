@extends('admin.admin')

@section('title-header')
    <h1 class="page-header">Giỏ Hàng</h1>
    <style>
        th{
            text-align: center;
        }
    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Giỏ hàng
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thông tin sản phẩm</th>
                                    <th>Quản lý</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    $i=0;
                                ?>
                                @foreach($cart_books as $cb)

                                    <?php
                                            $book = $cb->books;
                                            if (!$book){
                                                continue;
                                            }
                                    ?>

                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $book['title'] }}</td>
                                        <td>
                                            <center>
                                                {{$cb->quantity}}
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ route('product.description', $book->id) }}"><u>Xem thông tin</u></a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="{{ route('cart_item.delete', $cb->id) }}" title="Xóa" style="margin-right: 10%"><span class="glyphicon glyphicon-trash"></span></a>
                                            </center>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <h2>
                                <p class="text-success">Tổng chi phí: {{$total_cost}}</p>
                            </h2>
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
