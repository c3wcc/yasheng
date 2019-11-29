$(document).ready(function () {
    // var form = $(this).parent().parent().parent();
    // var inputs = form.serializeObject();
    ajax_url = jsui.uri+'user/reg.php';
    edit_ajax_url = jsui.uri + 'user/edit.php?action=update';
    var _tipstimer;

    function tips(str) {
        if (!str) return false
        _tipstimer && clearTimeout(_tipstimer)
        $('.user-tips').html(str).animate({
            top: 0
        }, 220)
        _tipstimer = setTimeout(function () {
            $('.user-tips').animate({
                top: -30
            }, 220)
        }, 5000)
    }

    $('.container-user').on('click', function (e) {
        e = e || window.event;
        var target = e.target || e.srcElement
        var _ta = $(target)

        if (_ta.parent().attr('evt')) {
            _ta = $(_ta.parent()[0])
        } else if (_ta.parent().parent().attr('evt')) {
            _ta = $(_ta.parent().parent()[0])
        }

        var type = _ta.attr('evt')

        if (!type || _ta.hasClass('disabled')) return

        switch (type) {

            case 'postnew.submit':

                var form = _ta.parent().parent().parent()
                var inputs = form.serializeObject()

                /*	if (!window.tinyMCE) {
                    tips('数据异常');
                    return
					}
                inputs.post_content = tinyMCE.activeEditor.getContent();*/

                var title = $.trim(inputs.post_title)
                var url = $.trim(inputs.post_url)
                var content = $.trim(inputs.post_content)


                if (!title || title.length > 50) {
                    tips('标题不能为空，且小于50个字符');
                    return
                }

                if (!content || content.length > 10000 || content.length < 10) {
                    tips('文章内容不能为空，且介于10-10000字之间');
                    return
                }

                if (!url && url.length > 200) {
                    tips('来源链接不能大于200个字符');
                    return
                }

                $.ajax({
                    type: 'POST',
                    url: ajax_url,
                    data: inputs,
                    dataType: 'json',
                    success: function (data) {

                        if (data.msg) {
                            tips(data.msg)
                        }

                        if (data.error) {
                            return
                        }

                        form.find('.form-control').val('')
                        if( data.goto ){ location.href = data.goto;}
                        location.hash = 'posts/draft'
                    }
					
					/*success: function (data) {

                        if (data.error) {
                            if (data.msg) {
                                tips(data.msg)
                            }
                            return
                        }

                        tips('修改成功！下次登录请使用新密码！')
                        if( data.goto ){ location.href = data.goto;}
                        $('input:password').val('')
                    }*/
                });

                break;

            case 'password.submit':
                var form = _ta.parent().parent().parent()
                var inputs = form.serializeObject()

                if (!inputs.action) {
                    return
                }

                if (!inputs.password || inputs.password.length < 6) {
                    tips('新密码不能为空且至少6位')
                    return
                }

                if (inputs.password !== inputs.password2) {
                    tips('两次密码输入不一致')
                    return
                }

                if (inputs.passwordold === inputs.password) {
                    tips('新密码和原密码不能相同')
                    return
                }

                $.ajax({
                    type: 'POST',
                    url: ajax_url,
                    data: inputs,
                    dataType: 'json',
                    success: function (data) {

                        if (data.error) {
                            if (data.msg) {
                                tips(data.msg)
                            }
                            return
                        }

                        tips('修改成功！下次登录请使用新密码！')
                        if( data.goto ){ location.href = data.goto;}
                        $('input:password').val('')
                    }
                });

                break;
            case 'info.submit':
                var form = _ta.parent().parent().parent()
                var inputs = form.serializeObject()
                if (!inputs.action) {return}
                if (!/.{2,20}$/.test(inputs.nickname)) {tips('昵称限制在2-20字内');return}
                if( !inputs.email ){tips('邮箱不能为空');return}
                if( !is_mail(inputs.email) ){tips('邮箱格式错误');return}
                var fm = new FormData()
                fm.append('nickname', inputs.nickname)
                fm.append('email', inputs.email)
                fm.append('photo', inputs.photo)
                var img= document.blooger.img.files[0]
                if (img) {fm.append('img', img)}
                $.ajax({
                    type: 'POST',
                    url: edit_ajax_url,
                    data: fm, // FormData Object
                    dataType: 'json',
                    contentType: false, //禁止设置请求类型
                    processData: false, //禁止jquery对DAta数据的处理,默认会处理
                    success: function (data) {
                        if (data.error) {
                            if (data.msg) {
                                tips(data.msg)
                            }
                            return
                        }
                        tips('修改成功！');
                        if( data.goto ){ location.href = data.goto;}
                        cache_userdata = null
                    }
                });
                break;
        }
    })
})
