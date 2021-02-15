@extends('admin.layout')
@section('content_header')
    <x-contentheader title="添加分类" />
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form action="{{isset($data)? route('admin.category.update', [$data]) : route('admin.category.store')}}" method="post">
                <x-textinput name="name" label="分类名称" :value="$data->name??''"/>
                <div class="form-group">
                    <label for="">分类图标</label>
                    <div>
                        <x-simpleuploader id="icon" single="1" name="icon" :pictures="isset($data->icon)?(array)$data->icon:[]"/>
                    </div>
                </div>
                <x-textinput name="sort" label="排序" type="number" :value="$data->sort??0"/>
                <x-radio label="是否启用" name="enabled" :options="[1=> '是', 0 => '否']" :checked="$data->enabled??1"/>
                    @isset($data) @method('PUT') @endisset
                <x-submit/>
            </form>
        </div>
    </div>
@endsection
