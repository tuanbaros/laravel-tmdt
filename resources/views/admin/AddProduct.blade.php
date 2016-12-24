@extends('admin.admin')
@section('title-header')
<h1 class="page-header">Thêm sản phẩm</h1>
@endsection
@section('content')
<style type="text/css">
    .panel-body .row{
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Hoàn thành thông tin trong bảng
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form action="product.add" method="post" >
                    <div class="row">
                        <div class="col-sm-5">
                            <label>Tên sách *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="title" id="title" class="form-control" placeholder="Nhập tên sách" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Tên tác giả *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="author_name" id="author_name" class="form-control" placeholder="Nhập tên tác giả" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Giới thiệu tác giả *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="author_introduce" id="author_introduce" class="form-control" placeholder="Nhập thông tin tác giả" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Liên hệ tác giả *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="author_contact" id="author_contact" class="form-control" placeholder="Nhập thông tin liên hệ" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Category *</label>
                        </div>
                        <div class="col-sm-5">
                            <?php $categories = \App\Category::all(); ?>
                            <select name="category" id="category" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Ngôn ngữ *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" name="language" id="language" class="form-control" placeholder="Nhập ngôn ngữ" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Giá *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" name="price" step='0.01' min="0" id="price" class="form-control" placeholder="Nhập giá sản phẩm" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Giảm giá *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" step="1" min="0" max="100" name="discount_percent" id="discount_percent" class="form-control" placeholder="Nhập % giảm giá" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Số lượng *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" name="quantity_remain" min="0" id="quantity_remain" step="1" class="form-control" placeholder="Nhập số lượng sản phẩm" required>
                        </div>
                    </div>
                    <div class="row" style="margin:20px 0px">
                        <center><label for="">Mô tả sản phẩm</label></center>
                        <textarea name="description" id="description" cols="25" rows="10" class="ckeditor"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label for="">Ngày phát hành *</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="datetime-local" name="date_releases" class="form-control" id="date_releases" placeholder="Nhập ngày phát hành" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <center><input type="submit" name="product.add" value="Thêm Sách" class="btn btn-primary"></center>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection
