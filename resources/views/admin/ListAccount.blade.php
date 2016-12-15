@extends('admin.admin')
@section('title-header')
<h1 class="page-header">Quản lý tài khoản khách hàng</h1>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Thông tin tài khoản khách hàng
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <table class="table table-striped table-bordered table-hover" id="dataTables">
                            <thead>
                                <tr>
                                    <th style="width:4%">STT</th>
                                    <th style="width:8%">Avatar</th>
                                    <th style="width:15%">Tên khách hàng</th>
                                    <th style="width:15%">Địa chỉ</th>
                                    <th style="width:13%">Số điện thoại</th>
                                    <th style="width:8%">Ngày tạo</th>
                                    <th style="width:10%">DS Hóa đơn</th>
                                    <th style="width:10%">LS giao dịch</th>
                                    <th style="width:8%">Giỏ hàng</th>
                                    <th style="width:10%">Quản lý</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                                @foreach($accounts as $account)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>
                                        <img src="{{$account->avatar}}" alt="Avatar" style="width:60px;height:60px;">
                                    </td>
                                    <td>{{$account->name}}</td>
                                    <td>{{$account->address}}</td>
                                    <td>{{$account->phone}}</td>
                                    <td><?php $date=explode(' ', $account->updated_at); echo $date[0];?></td>
                                    <td><center><a href=""><u>Xem</u></a></center></td>
                                    <td><center><a href=""><u>Xem</u></a></center></td>
                                    <td><center><a href=""><u>Xem</u></a></center></td>
                                    <td><center><a href="" title="Xóa" style="margin-right: 10%"><span class="glyphicon glyphicon-trash"></span></a></center></td>
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