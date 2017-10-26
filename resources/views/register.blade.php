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
            {{--<form-item required label="用户名:" label-col="4" wrapper-col="12" has-icon tips="我是提示" tips-mode="popup">--}}
                {{--<v-input type="text" placeholder="请输入您的用户名" v-model="user.username" required required-tips="用户名为必填项"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item required label="密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">--}}
                {{--<v-input type="password" placeholder="请输入您的密码" v-model="user.pwd"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item required label="确认密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">--}}
                {{--<v-input type="password" placeholder="请确认您的密码" v-model="user.confirm_pwd"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item required label="电话:" label-col="4" wrapper-col="12" has-icon :valid-status="phoneValidResult.isPhoneValid.validStatus" :tips="phoneValidResult.isPhoneValid.tips">--}}
                {{--<v-input type="text" placeholder="请输入您的电话号码" :rules="phoneValidRule" :valid-result="phoneValidResult" v-model="user.tel"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item required label="邮箱:" label-col="4" wrapper-col="12" has-icon tips="我是提示">--}}
                {{--<v-input type="text" placeholder="请输入您的邮箱" v-model="user.mail"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item required label="性别:" label-col="4" wrapper-col="12">--}}
                {{--<label><input type="radio" value="男" v-model="user.gender" checked />男</label>--}}
                {{--<label><input type="radio" value="女" v-model="user.gender" />女</label>--}}
            {{--</form-item>--}}
            {{--<form-item required label="个性签名" label-col="4" wrapper-col="12" tips-mode="popup" description-width="500" description-space="500">--}}
                {{--<v-input type="text" v-model="user.sign"></v-input>--}}
            {{--</form-item>--}}
            {{--<form-item label-col="4" wrapper-col="12">--}}
                {{--<v-button @click.native="submit" primary style="margin-right:10px">确定</v-button><v-button type="reset" tertiary value="重置条件"></v-button>--}}
            {{--</form-item>--}}

            <at-input v-model="user.uname" placeholder="用户名" :status="status.name"></at-input>
            <at-input v-model="user.upwd" type="password" placeholder="密码" :status="status.pwd"></at-input>
            <at-input v-model="user.uconfirm_pwd" type="password" placeholder="确认密码" :status="status.confirm_pwd"></at-input>
            <at-input v-model="user.umail" placeholder="邮箱" :status="status.mail"></at-input>
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
                uname: '',
                upwd: '',
                uconfirm_pwd: '',
                umail: '',
            },
            status: {
                name: '',
                pwd: '',
                confirm_pwd: '',
                mail: '',
            },
        },
        components: {

        },
        methods: {
            submit: function () {
                //var formData = JSON.stringify(this.user);
                let { name, pwd, confirm_pwd, mail } = this.status;
                let { uname, upwd, uconfirm_pwd, umail } = this.user;
                if(name == 'error' || pwd == 'error' || confirm_pwd == 'error' || mail == 'error'){
                    alert('输入有误，请检查后重新输入')
                    return;
                }else if(uname == "" || upwd == "" || uconfirm_pwd == "" || umail == ""){
                    alert('输入不能为空')
                }
                else{
                    axios({
                        method: 'post',
                        url: '/user/register',
                        data: this.user,
                    })
                        .then(function (response) {
                            if (response.data.code == 200) {
                                alert('成功！')
                                window.location.href = response.data.url
                            }else if (response.data.code == 451) {
                                alert('服务器内部错误，输入不能为空！')
                            }else if (response.data.code == 452) {
                                alert('服务器内部错误，验证错误！')
                            }else if (response.data.code == 453) {
                                alert('用户名已存在，请重新输入！')
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
            },
            'user.uconfirm_pwd': function (val, oldval){
                if(Object.is(val, this.user.upwd) && val.length >= 6){
                    this.status.confirm_pwd = 'success'
                }else{
                    this.status.confirm_pwd = 'error'
                }
            },
            'user.umail': function (val, oldval) {
                if(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/.test(val)){
                    this.status.mail = 'success'
                }else{
                    this.status.mail = 'error'
                }
            }
        }
    })
</script>
</body>
</html>