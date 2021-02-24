@extends('admin.layout')

@section('content_header')
   
@endsection

@section('content')
    <form action="{{route('admin.words.store')}}" method="post">
        <div class="form-group">
            <label for="">敏感词</label>
            <textarea name="words"  cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">提交</button>
        </div>
        @csrf
    </form>
@endsection