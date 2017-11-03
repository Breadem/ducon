<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <!-- 引入样式 -->
    <link rel="stylesheet" href="{{ url('/css/at.min.css') }}">
    <link rel="stylesheet" href="{{ url('/css/comment.min.css') }}">
</head>
<body>
<div id="app">
    @if (session('status'))
            {{ session('status') }}
    @endif
     <div style="width:100%;height:100%;">
        <div style="margin:0 auto;width:50%">
            <h2>{{ $info->title }}</h2>
            <p>{{ $info->ctime->toFormattedDateString() }} by <a href="#">User</a></p>
            <p>{{$info->content}}</p>
         </div>
    </div>
    <div class="ui threaded comments">
  <h3 class="ui dividing header">Comments</h3>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/matt.jpg">
    </a>
    <div class="content">
      <a class="author">Matt</a>
      <div class="metadata">
        <span class="date">Today at 5:42PM</span>
      </div>
      <div class="text">
        How artistic!
      </div>
      <div class="actions">
        <a class="reply">Reply</a>
      </div>
    </div>
  </div>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/elliot.jpg">
    </a>
    <div class="content">
      <a class="author">Elliot Fu</a>
      <div class="metadata">
        <span class="date">Yesterday at 12:30AM</span>
      </div>
      <div class="text">
        <p>This has been very useful for my research. Thanks as well!</p>
      </div>
      <div class="actions">
        <a class="reply">Reply</a>
      </div>
    </div>
    <div class="comments">
      <div class="comment">
        <a class="avatar">
          <img src="/images/avatar/jenny.jpg">
        </a>
        <div class="content">
          <a class="author">Jenny Hess</a>
          <div class="metadata">
            <span class="date">Just now</span>
          </div>
          <div class="text">
            Elliot you are always so right :)
          </div>
          <div class="actions">
            <a class="reply">Reply</a>
          </div>
        </div>
      </div>
    </div>
    <div class="comments">
      <div class="comment">
        <a class="avatar">
          <img src="/images/avatar/jenny.jpg">
        </a>
        <div class="content">
          <a class="author">Jenny Hess</a>
          <div class="metadata">
            <span class="date">Just now</span>
          </div>
          <div class="text">
            Elliot you are always so right :)
          </div>
          <div class="actions">
            <a class="reply">Reply</a>
          </div>
        </div>
        <div class="comments">
          <div class="comment">
            <a class="avatar">
              <img src="/images/avatar/jenny.jpg">
            </a>
            <div class="content">
              <a class="author">Jenny</a>
              <div class="metadata">
                <span class="date">Just now</span>
              </div>
              <div class="text">
                Elliot you are always so right :)
              </div>
              <div class="actions">
                <a class="reply">Reply</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="comment">
    <a class="avatar">
      <img src="/images/avatar/joe.jpg">
    </a>
    <div class="content">
      <a class="author">Joe Henderson</a>
      <div class="metadata">
        <span class="date">5 days ago</span>
      </div>
      <div class="text">
        Dude, this is awesome. Thanks so much
      </div>
      <div class="actions">
        <a class="reply"  @click="reply(key)">Reply</a>
      </div>
    </div>
  </div>
  <form class="ui reply form" @submit.prevent="comment">
    <div class="field">
      <at-textarea v-model="commentVal" name="comment"></at-textarea>
    </div>
    <at-button type="primary">评论</at-button>
  </form>
</div>

</div>
<!-- 先引入 Vue -->
<script src="{{ url('/js/vue.js') }}"></script>
<!-- 引入组件库 -->
<script src="{{ url('/js/at.min.js') }}"></script>
<script src="{{ url('/js/axios.min.js') }}"></script>
<script type="application/javascript">
    var json = @json($info);
    var Reply = {
      template: `<form class='ui reply form'>
        <div class='field'>
          <at-textarea></at-textarea>
        </div>
        <at-button type="primary">回复</at-button>
      </form>`
    }

    new Vue({
        el: '#app',
        data: {
            showReplay: [],
            commentVal: '',
        },
        components: {

        },
        methods: {
            reply: function (key){
                this.showReplay[key] = true
            },
            comment: function () {
                var info_id = json.id
                var self = this
                    axios({
                        method: 'post',
                        url: '/bbs/info/'+info_id+'/comment',
                        data: {
                            'comment': this.commentVal,
                        },
                    })
                    .then(function (response) {
                        if (response.data.code == 200) {
                           self.$Notify.success({ title: '文章', message: '评论成功！' })
                        }
                    })
                    .catch(function (error) {
                        if (error.response && error.response.data)
                        self.errors = error.response.data.errors
                    });
            }
        }   
    })
</script>
</body>
</html>