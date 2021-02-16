<h1>生成成功</h1>
<p>{{$i}}</p>
<script>
    const url = "{{route('admin.thumb', ['index' => $i])}}"
    location.href = url
</script>