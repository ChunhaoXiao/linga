@extends('admin.layout')
@section('content_header')
    <x-contentheader title="添加文章" />
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form action="{{isset($data)? route('admin.post.update', [$data]) : route('admin.post.store')}}" method="post">
                <x-textinput name="title" label="标题" :value="$data->title??''"/>
                <x-select label="所属分类" name="category_id" :options="$categories" :selected="$data->category_id??''"/>

                <div class="form-group">
                    <label for="">文件上传</label>
                    <div>
                        <x-simpleuploader id="picture" name="file" :pictures="$data->files??[]"/>
                    </div>
                </div>
                <x-radio name="is_vip" label="是否vip内容" :options="[1 => '是', 0 => '否']" :checked="isset($data->is_vip)?$data->is_vip:1"/>

                <x-textarea label="描述" name="body" rows="8" :value="$data->body??''"/>
                    @isset($data) @method('PUT') @endisset
                <x-submit/>
            </form>
        </div>
    </div>
@endsection
