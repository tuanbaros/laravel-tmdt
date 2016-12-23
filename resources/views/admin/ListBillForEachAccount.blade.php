@extends('admin.ListBill')
@section('add_input')
    <input type="hidden" value="{{$user_id}}" name="user_id"/>
@endsection
