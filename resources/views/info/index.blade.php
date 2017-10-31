<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ url('/css/at.min.css') }}">
</head>
<body>
<div id="app">
    @if (session('status'))
            {{ session('status') }}
    @endif
    @forelse ($infos as $info)
    <div class="row">
        <h2>标题:</h2>
        <h2><a href="./bbs/info/{{ $info->id }}">{{ $info->title }}</a></h2>
        <p>发表日期:</p>
        <p>{{ $info->ctime->toFormattedDateString() }}</p>
        <at-button type="error" size="small" hollow>删除</at-button>
        <at-button type="primary" size="small" hollow><a href="{{ url("/bbs/info/".$info->id."/edit") }}">修改</a></at-button>
    </div>
    @empty
        <p>没有帖子</p>
    @endforelse

</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/at.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script type="application/javascript">
    new Vue({
        el: '#app',
        data: {

        },
        components: {

        },
        methods: {
            
        }
    })
</script>
</body>
</html>