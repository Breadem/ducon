<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ url('/css/at.min.css') }}">
</head>
<body>
<div id="app">
    <form @submit.prevent="submit" style="margin-top: 5%">
        <at-input v-model="user.uname" placeholder="用户名或邮箱" :status="status.name"></at-input>
        <at-input v-model="user.upwd" type="password" placeholder="密码" :status="status.pwd"></at-input>
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
        el:'#app',
        data: {
            user: {
                uname: '',
                upwd: '',
            },
            status: {
                name: '',
                pwd: '',
            },
        },
        mounted: function() {
            axios.defaults.headers.common = {
                'X-CSRF-TOKEN': window.Laravel.csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            };
        },
        components: {

        },
        methods: {
            submit: function () {
                //var formData = JSON.stringify(this.user);
                let { name, pwd } = this.status;
                let { uname, upwd } = this.user;
                if(name == 'error' || pwd == 'error'){
                    alert('输入有误，请检查后重新输入')
                    return;
                }else if(uname == "" || upwd == ""){
                    alert('输入不能为空')
                }
                else{
                    axios({
                        method: 'post',
                        url: '/user/login',
                        data: this.user,
                    })
                        .then(function (response) {
                            if (response.data.code == 200) {
                                alert('成功！')
                            }else if (response.data.code == 451) {
                                alert('服务器内部错误，输入不能为空！')
                            }else if (response.data.code == 452) {
                                alert('服务器内部错误，验证错误！')
                            }
                            console.log('error --- ' + response);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            },
        },
        watch: {
            'user.uname': function (val, oldval){
                if(/^[a-zA-Z0-9_-]{4,16}$/.test(val)){
                    this.status.name = 'success'
                }else{
                    this.status.name = 'error'
                }
            },
            'user.upwd': function (val, oldval){
                //
                if(Object.is(val, this.user.uconfirm_pwd)){
                    this.status.confirm_pwd = 'success'
                }else if(this.user.uconfirm_pwd.length > 0){
                    this.status.confirm_pwd = 'error'
                }
                //
                if(val.length >= 6){
                    this.status.pwd = 'success'
                }
                else{
                    this.status.pwd = 'error'
                }
            }
        }
    })
</script>
</body>
</html>