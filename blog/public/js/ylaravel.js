var editor = new wangEditor('content');
//
// editor.config.uploadImgUrl = '/posts/image/upload';
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$("button").click(function(){
    var like_user = $(".like-button").attr("like-user");
    var like_value = $(".like-button").attr("like-value");
    if (like_value == '0') {
        $.ajax({
            type:"POST",
            url:"/user/" + like_user + '/doFan',
            data:"json",
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
            success:function(msg){
                if (msg.error != '0') {
                    alert(msg.error);
                }
                $(".like-button").attr("like-value", '1');
                $(".like-button").text('取消关注');
            }
        });
    } else {
        $.ajax({
            type:"POST",
            url:"/user/" + like_user + '/doUnFan',
            data:"json",
            headers: {'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')},
            success:function(msg){
                if (msg.error != '0') {
                    alert(msg.error);
                }
                $(".like-button").attr("like-value", '0');
                $(".like-button").text('关注');
            }
        });
    }
});

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();