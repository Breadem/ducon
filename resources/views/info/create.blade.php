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
    <form style="margin-top: 5%" action="{{ url('/info/create') }}" method="post">
        {{ csrf_field() }}
        <at-input v-model="inputValue" name="title" placeholder="标题"></at-input>
        <at-textarea v-model="inputValue2" name="content" min-rows="2" max-rows="4" placeholder="这里输入内容，请输入多行"></at-textarea>
        @if (count($errors) > 0)
             @foreach ($errors->all() as $error)
                        <at-alert message="{{ $error }}" type="error"></at-alert>
             @endforeach
        @endif
        <at-button type="info" hollow>发表</at-button>
    </form>
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
    })
</script>
</body>
</html>