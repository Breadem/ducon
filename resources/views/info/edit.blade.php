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
    <form style="margin-top: 5%" @submit.prevent="submit">
        {{ csrf_field() }}
        <at-input v-model="title" name="title" value="{{$info->title}}" placeholder="标题"></at-input>
        <at-textarea v-model="content" name="content" min-rows="2" max-rows="4" placeholder="这里输入内容，请输入多行"></at-textarea>
        <at-alert v-if="errors.hasOwnProperty('title')" :message="errors.title.toString()" type="error"></at-alert>
        <at-alert v-if="errors.hasOwnProperty('content')" :message="errors.content.toString()" type="error"></at-alert>

        <at-button type="info" hollow>发表</at-button>
    </form>
</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/at.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script type="application/javascript">
    var json = @json($info);
    new Vue({
        el: '#app',
        data: {
            title:json.title,
            content: json.content,
            errors: [],
        },
        components: {

        },
        methods: {
            
            submit: function () {
                var info_id = json.id;
                var self = this
                    axios({
                        method: 'post',
                        url: '/api/bbs/info/'+info_id+'/update',
                        data: {
                            'title': this.title,
                            'content': this.content,
                        },
                    })
                    .then(function (response) {
                        if (response.data.code == 200) {
                           self.$Notify.success({ title: '文章', message: '修改成功！' })
                            window.location.href = response.data.url
                        }
                    })
                    .catch(function (error) {
                        if (error.response && error.response.data)
                        self.errors = error.response.data.errors
                    });
                },
        }
    })
</script>
</body>
</html>