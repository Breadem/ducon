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
    <form style="margin-top: 5%" action="{{ url('/user/login') }}" method="post">
        {{ csrf_field() }}
        <at-input name="username" placeholder="用户名或邮箱"></at-input>
        <at-input name="password" type="password" placeholder="密码"></at-input>
        <at-button type="info" hollow>登录</at-button>
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