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
     <div style="width:100%;height:100%;">
        <div style="margin:0 auto;width:50%">
            <h2>{{ $info->title }}</h2>
            <p>{{ $info->ctime }} by <a href="#">User</a></p>
            <p>{{$info->content}}</p>
         </div>
    </div>

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