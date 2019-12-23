<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"./application/admin/template/admin\admin_pwd_ajax.htm";i:1573115082;}*/ ?>
<div class="ncap-form-default">
  <form id="admin_form" method="post" action="" name="admin_form">
    <input type="hidden" name="admin_id" value="<?php echo $info['admin_id']; ?>">
    <dl class="row">
      <dt class="tit"><label for="old_pw"><em>*</em>原密码</label><!-- 原密码 --></dt>
      <dd class="opt"><input id="old_pw" name="old_pw" class="txt valid" type="password">
          <span class="err"></span></dd>
    </dl>
    <dl class="row">
      <dt class="tit"><label for="new_pw"><em>*</em>新密码</label><!-- 新密码 --></dt>
      <dd class="opt"><input id="new_pw" name="new_pw" class="txt" type="password">
          <span class="err"></span></dd>
    </dl>
    <dl class="row">
      <dt class="tit"><label for="new_pw2"><em>*</em>确认密码</label><!-- 确认密码--></dt>
      <dd class="opt"><input id="new_pw2" name="new_pw2" class="txt" type="password">
          <span class="err"></span></dd>
    </dl>
    <div class="bot"><a href="JavaScript:void(0);" class="ncap-btn-big ncap-btn-green" id="submitBtn"><span>确认提交</span></a></div>
  </form>
</div>
<script type="text/javascript">
    $(function () {
     
        $('#submitBtn').click(function(){
            $('#admin_form').submit();
        });
        
        $("#admin_form").validate({
            debug: false, //调试模式取消submit的默认提交功能   
            focusInvalid: false, //当为false时，验证无效时，没有焦点响应  
            onkeyup: false,   
            submitHandler: function(form){   //表单提交句柄,为一回调函数，带一个参数：form   
                $.ajax({
                    url:"<?php echo url('Admin/admin_pwd', ['_ajax'=>1]); ?>",
                    type:'post',
                    dataType:'json',
                    data: $("#admin_form").serialize(),
                    success:function(obj){
                        if(obj.status !=1){
                            layer.alert(obj.msg, {icon: 5, title:false});
                        }else{
                            var dialog = DialogManager.get('modifypw');
                            dialog.close();
                            layer.alert('操作成功!', {icon: 6, title:false});
                        }  
                    }
                });
            },  
            ignore:":button",   //不验证的元素
            rules:{
                old_pw:{
                    required:true,
                    minlength:5
                },
                new_pw:{
                    required:true,
                    minlength:5
                },
                new_pw2:{
                    required:true,
                    minlength:5,
                    equalTo: "#new_pw"
                }
            },
            messages:{
                old_pw:{
                    required:"请输入原密码",
                    minlength:"原始密码长度不能少于5位"
                },
                new_pw:{
                    required:"请输入新密码",
                    minlength:"新密码长度不能少于5位"
                },
                new_pw2:{
                    required:"请输入确认密码",
                    minlength:"确认密码长度不能少于5位",
                    equalTo:"两次密码输入不一致"
                }
            }
        });
        
    });

</script>