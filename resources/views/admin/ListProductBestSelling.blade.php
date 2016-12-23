@extends('admin.admin')

@section('title-header')
    <h1 class="page-header">Danh sách sản phẩm bán chạy</h1>
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Thông tin sản phẩm bán chạy
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row" style="margin-bottom: 15px">
                                <div class="col-sm-6">

                                </div>
                                <div class="col-sm-2 col-sm-offset-4">
                                    <a href="product.add"><input type="button" name="" id="" class="btn btn-primary" value="Thêm sản phẩm"></a>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                <tr>
                                    <th style="width:4%">STT</th>
                                    <th style="width:14%">Tên sản phẩm</th>
                                    <th style="width:8%">Giá</th>
                                    <th style="width:10%">Số lượng đã bán</th>
                                    <th style="width:10%">Số lượng còn lại</th>
                                    <th style="width:8%">Ngôn ngữ</th>
                                    <th style="width:10%">Xem thông tin</th>
                                    <th style="width:8%">Quản lý</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $i=0; ?>
                                @foreach($books as $book)

                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->new_price}} $</td>
                                        <td>{{$book->quantity_selling}}</td>
                                        <td>{{$book->quantity_remain}}</td>
                                        <td>{{$book->language}}</td>
                                        <td><a href="product.description-{{$book->id}}"><u>Xem thông tin</u></a></td>
                                        <td><center><a href="product.edit-{{$book->id}}" title="Sửa" style="margin-right: 10%"><span class="glyphicon glyphicon-pencil"></span></a>
                                                <a href="product.delete-{{$book->id}}" title="Xóa" style="margin-right: 10%"><span class="glyphicon glyphicon-trash"></span></a></center></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

@section('script')
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script>
        var dttable = new dttable();
        dttable.init('#dataTables');
    </script>
@endsection
