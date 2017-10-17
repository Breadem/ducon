<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ url('/css/greater-blue.css') }}">
</head>
<body>
<div id="app">
        <v-form method="post" style="margin-top: 5%">
            <form-item required label="用户名:" label-col="4" wrapper-col="12" has-icon tips="我是提示" tips-mode="popup">
                <v-input type="text" placeholder="请输入您的用户名" v-model="user.username" required required-tips="用户名为必填项"></v-input>
            </form-item>
            <form-item required label="密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
                <v-input type="password" placeholder="请输入您的密码" v-model="user.pwd"></v-input>
            </form-item>
            <form-item required label="确认密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
                <v-input type="password" placeholder="请确认您的密码" v-model="user.confirm_pwd"></v-input>
            </form-item>
            <form-item required label="电话:" label-col="4" wrapper-col="12" has-icon :valid-status="phoneValidResult.isPhoneValid.validStatus" :tips="phoneValidResult.isPhoneValid.tips">
                <v-input type="text" placeholder="请输入您的电话号码" :rules="phoneValidRule" :valid-result="phoneValidResult" v-model="user.tel"></v-input>
            </form-item>
            <form-item required label="邮箱:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
                <v-input type="text" placeholder="请输入您的邮箱" v-model="user.mail"></v-input>
            </form-item>
            <form-item required label="性别:" label-col="4" wrapper-col="12">
                <label><input type="radio" value="男" v-model="user.gender" checked />男</label>
                <label><input type="radio" value="女" v-model="user.gender" />女</label>
            </form-item>
            <form-item required label="个性签名" label-col="4" wrapper-col="12" tips-mode="popup" description-width="500" description-space="500">
                <v-input type="text" v-model="user.sign"></v-input>
            </form-item>
            <form-item label-col="4" wrapper-col="12">
                <v-button @click.native="submit" primary style="margin-right:10px">确定</v-button><v-button type="reset" tertiary value="重置条件"></v-button>
            </form-item>
        </v-form>
</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/atui.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script type="application/javascript">
    new Vue({
        el:'#app',
        data: {
            user:{
                username: '',
                pwd: '',
                confirm_pwd: '',
                tel: '',
                mail: '',
                gender: '',
                sign: ''
            },
            phoneValidRule: ['isPhone'],
            phoneValidResult: {
                isPhoneValid: {
                    validStatus: '',
                    tips: '',
                    errorTips: '',
                }
            },
        },
        components: {
            // 注册组件
            vForm: atui.Form,
            vButton: atui.Button,
            vInput: atui.Input,
            vSelect: atui.Select,
            vOption: atui.Option,
            vTextarea: atui.Textarea,
            FormItem: atui.FormItem
        },
        methods: {
            submit: function () {
                var formData = JSON.stringify(this.user);
                axios({
                    method: 'post',
                    url: '/user/register',
                    data: formData,
                })
                    .then(function (response) {
                        if (response.data.code == 301) {
                            window.location.href = response.data.url
                        }
                        console.log('error --- ' + response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    })
</script>
</body>
</html>