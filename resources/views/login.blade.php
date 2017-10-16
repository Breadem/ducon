<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ url('/css/greater-blue.css') }}">
</head>
<body>
<div id="app">
    <v-form action="" method="post" style="margin-top: 5%">
        <form-item required label="用户名:" label-col="4" wrapper-col="12" has-icon tips="我是提示" tips-mode="popup">
            <v-input type="text" placeholder="请输入您的用户名"  :value="username" required required-tips="用户名为必填项" maxlength="12" minlength="2" minlength-tips="用户名不能少于2个字符" tips="我是提示"></v-input>
        </form-item>
        <form-item required label="密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
            <v-input type="text" placeholder="请输入您的密码" :value="pwd"></v-input>
        </form-item>
        <form-item required label="确认密码:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
            <v-input type="text" placeholder="请确认您的密码" :value="confirm_pwd"></v-input>
        </form-item>
        <form-item required label="电话:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
            <v-input type="text" placeholder="请输入您的电话号码" :value="tel"></v-input>
        </form-item>
        <form-item required label="邮箱:" label-col="4" wrapper-col="12" has-icon tips="我是提示">
            <v-input type="text" placeholder="请输入您的邮箱" :value="mail"></v-input>
        </form-item>
        <form-item required label="性别:" label-col="4" wrapper-col="12">
            <label><input type="radio" name="sexy" checked />男</label>
            <label><input type="radio" name="sexy" />女</label>
        </form-item>
        <form-item required label="个性签名" label-col="4" wrapper-col="12" tips-mode="popup" description-width="500" description-space="500">
            <v-textarea :value="sign"></v-textarea>
        </form-item>
        <form-item label-col="4" wrapper-col="12">
            <v-button type="submit" primary @click.native="validFun" style="margin-right:10px">确定</v-button><v-button type="reset" tertiary value="重置条件"></v-button>
        </form-item>
    </v-form>
</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/atui.js') }}"></script>
<script>
    new Vue({
        el:'#app',
        data: {
            username: '',
            pwd: '',
            confirm_pwd: '',
            tel: '',
            mail: '',
            sign: ''
        },
        components: {
            // 注册组件
            vButton: atui.Button,
            vForm: atui.Form,
            vInput: atui.Input,
            vSelect: atui.Select,
            vOption: atui.Option,
            vTextarea: atui.Textarea,
            FormItem: atui.FormItem
        },
        methods: {
            onClick () {
                alert('button click')
            }
        }
    })
</script>
</body>
</html>