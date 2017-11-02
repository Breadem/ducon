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
    <div class="row" v-for="(value, index) in infos">
        <h2>标题:</h2>
        <h2><a :href="'./bbs/info/' + value.id ">@{{ value.title }}</a></h2>
        <p>发表日期:</p>
        <p>@{{ value.ctime}} </p>
        <at-button type="error" size="small" v-on:click="deleteInfo(index,value.id)" hollow>删除</at-button>
        <at-button type="primary" size="small" hollow><a :href="'./bbs/info/' + value.id + '/edit'">修改</a></at-button>
    </div>
     <!--    <p>没有帖子</p> -->
   

</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/at.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script type="application/javascript">
    var json = @json($infos);
    new Vue({
        el: '#app',
        data: {
            infos: json,
        },
        components: {

        },
        methods: {
            deleteInfo: function (index,id) {
                var self = this
                axios({
                        method: 'post',
                        url: '/bbs/info/'+id+'/delete',
                    })
                    .then(function (response) {
                        if (response.data.code == 200) {
                            self.$Notify.success({ title: '文章', message: '删除成功！' })
                            self.infos.splice(index, 1)
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.$Notify.error({ title: '文章', message: '删除失败！' })
                    });
            }
        }
    })
</script>
</body>
</html>