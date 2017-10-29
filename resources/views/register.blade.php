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
            <at-input v-model="user.username" placeholder="用户名" :status="status.username"></at-input>
            <div v-if="errors.hasOwnProperty('username')">@{{ errors.username }}</div>
            <at-input v-model="user.password" type="password" placeholder="密码" :status="status.password"></at-input>
            <at-input v-model="user.password_confirmation" type="password" placeholder="确认密码" :status="status.password_confirmation"></at-input>
            <div v-if="errors.hasOwnProperty('password')">@{{ errors.password }}</div>
            <at-input v-model="user.email" placeholder="邮箱" :status="status.email"></at-input>
            <div v-if="errors.hasOwnProperty('email')">@{{ errors.email }}</div>
            <at-button type="info" hollow>注册</at-button>
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
                username: '',
                password: '',
                password_confirmation: '',
                email: '',
            },
            status: {
                username: '',
                password: '',
                password_confirmation: '',
                email: '',
            },
            errors: [],
        },
        components: {

        },
        methods: {
            submit: function () {
                var these = this
                    axios({
                        method: 'post',
                        url: '/api/user/register',
                        data: this.user,
                    })
                    .then(function (response) {
                        if (response.data.code == 200) {
                            alert('注册成功！')
                            window.location.href = response.data.url
                        }
                    })
                    .catch(function (error) {
                        console.log(error.response.data.errors)
                        these.errors = error.response.data.errors
                        console.log(these.errors)
                    });
                },
            },
        watch: {
            'user.username': function (val, oldval){
                if(/^[a-zA-Z0-9_-]{4,16}$/.test(val)){
                    if(this.errors.hasOwnProperty('username')){
                        delete this.errors.username
                    }
                    this.status.username = 'success'
                }else{
                    this.status.username = 'error'
                }
            },
            'user.password': function (val, oldval){
                if(this.errors.hasOwnProperty('password')){
                    delete this.errors.password
                }
                //
                if(Object.is(val, this.user.password_confirmation) && val.length >= 6){
                    this.status.password_confirmation = 'success'
                }else if(this.user.password_confirmation.length > 0){
                    this.status.password_confirmation = 'error'
                }
                //
                if(val.length >= 6 && val.length <= 12){
                    this.status.password = 'success'
                }
                else{
                    this.status.password = 'error'
                }
            },
            'user.password_confirmation': function (val, oldval){
                if(this.errors.hasOwnProperty('password')){
                    delete this.errors.password
                }
                //
                if(Object.is(val, this.user.password) && val.length >= 6){
                    this.status.password_confirmation = 'success'
                }else{
                    this.status.password_confirmation = 'error'
                }
            },
            'user.email': function (val, oldval) {
                if(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(val)){
                    if(this.errors.hasOwnProperty('email')){
                        delete this.errors.email
                    }
                    this.status.email = 'success'
                }else{
                    this.status.email = 'error'
                }
            }
        }
    })
</script>
</body>
</html>