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
                            <tr>
                                <td><center>{{++$i}}</center></td>
                                <td><center>{{$bill->id}}</center></td>

                                @if($bill->users == null)
                                    <td><center><u>{{$bill->name_customer}}</u></center></td>
                                    <td><center>{{$bill->address}}</center></td>
                                    <td><center>{{$bill->phone}}</center></td>
                                @else
                                    <td><center><u><a href="{{ route('bill.account', $bill->users->id) }}">{{$bill->users->name}}</a></u></center></td>
                                    <td><center>{{$bill->users->address}}</center></td>
                                    <td><center>{{$bill->users->phone}}</center></td>
                                @endif

                                <td><center>
                                            <a href="{{ route('bill.detail', $bill->id)}}" class= "btn btn-default">Xem</a></center></td>

                                <td><center>{{$bill->status}}
                                        @if ($bill->status == 'processing' || $bill->status == 'shipping')
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
                                        @endif
                                    </center></td>
                                <td><center><?php $date=explode(' ', $bill->updated_at); echo $date[0]; ?></center></td>
                                @if ($bill->status == 'completed' || $bill->status == 'cancel')
                                <td><center><a class="btn btn-default" href="{{ route('bill.delete', $bill->id) }}">Xóa</a></td>
                                @else
                                <td></td>
                                @endif
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

@section('script')
    <script src="{{ asset('/js/dttable.js') }}"></script>
    <script>
        var dttable = new dttable();
        dttable.init('#dataTables');
    </script>
@endsection
