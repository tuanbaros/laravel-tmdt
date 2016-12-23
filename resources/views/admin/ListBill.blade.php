@extends('admin.admin')
@section('title-header')
<h1 class="page-header">Danh sách hóa đơn</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Danh sách tất cả cá hóa đơn
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="">
                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                        <thead>
                            <tr>
                                <th style="width:5%"><center>STT</center></th>
                                <th style="width:6%"><center>Mã hóa đơn</center></th>
                                <th style="width:10%"><center>Người mua hàng</center></th>
                                <th style="width:10%"><center>Địa Chỉ</center></th>
                                <th style="width:11%"><center>Số Điện Thoại</center></th>
                                <th style="width:10%"><center>Nội dung hóa đơn</center></th>
                                <th style="width:8%"><center>Trạng thái</center></th>
                                <th style="width:10%"><center>Ngày xuất hóa đơn</center></th>
                                <th style="width:8%"><center>Quản lý</center></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach($bills as $bill)
                                <?php $user = $bill->users?>
                            <tr>
                                <td><center>{{++$i}}</center></td>
                                <td><center>{{$bill->id}}</center></td>

                                @if($user==null)
                                    <td><center><u>{{$bill->name_customer}}</u></center></td>
                                    <td><center>{{$bill->address}}</center></td>
                                    <td><center>{{$bill->phone}}</center></td>
                                @else
                                    <td><center><u><a href="bill.account-{{$user->id}}">{{$user->name}}</a></u></center></td>
                                    <td><center>{{$user->address}}</center></td>
                                    <td><center>{{$user->phone}}</center></td>
                                @endif

                                <td><center><button class btn btn-primary>
                                            <a href="bill.detail-{{$bill->id}}">Xem</a></button></center></td>

                                <td><center>{{$bill->status}}
                                        <form action="bill.change.status" method="get">
                                            <input type="hidden" value="{{$bill->id}}" name="bill_id"/>
                                            @yield('add_input')
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="processing">processing</option>
                                                <option value="shipping">shipping</option>
                                                <option value="completed">completed</option>
                                                <option value="cancel">cancel</option>
                                            </select>
                                            <input type="submit" value="Change" class="btn btn-primary">
                                        </form>

                                    </center></td>
                                <td><center><?php $date=explode(' ', $bill->updated_at); echo $date[0]; ?></center></td>
                                <td><center><button><a href="bill.delete-{{$bill->id}}">Xóa</a></button>&nbsp&nbsp<button><a href="">In</a></button></center></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                    </div>
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection('content')
