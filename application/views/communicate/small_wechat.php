
<!DOCTYPE html>
<html class="no-js">
<head>
        <base href="<?=base_url()?>">
 <meta http-equiv="Expires" content="0" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Cache-control" content="no-cache" />
<meta http-equiv="Cache" content="no-cache" />
 <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="style/small_wechat/assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>

  <link rel="stylesheet" href="style/small_wechat/assets/css/amazeui.flat.min.css">
  <link rel="stylesheet" href="style/small_wechat/assets/css/amazeui.min.css">
  <link rel="stylesheet" href="style/small_wechat/assets/css/app.css">
  <link rel="stylesheet" href="style/small_wechat/assets/css/room.css">
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<script src="http://res.websdk.rongcloud.cn/RongIMClient-0.9.9.min.js"></script>
<title> <?php echo $groupId.$groupName; ?></title>

<script>
	window.onerror = function(msg, url, line) {

		var idx = new String(url).lastIndexOf("/");
		if (idx > -1) {
			url = url.substring(idx + 1);
		}
		alert("ERROR in " + url + " (line #" + line + "): " + msg);
		return false;
	};
	var logined=false;
	window.onload = function() {
		((function (global) {
	        if ('navigator' in global && 'plugins' in navigator && navigator.plugins['Shockwave Flash']) {
	            return !!navigator.plugins['Shockwave Flash'].description;
	        }
	        if ('ActiveXObject' in global) {
	            try {
	                return !!new ActiveXObject('ShockwaveFlash.ShockwaveFlash').GetVariable('$version');
	            } catch (e) {
	            }
	        }
	        return false;
	    })(window));

		//alert("WebSocket" in window && "ArrayBuffer" in window);
		//alert(navigator.userAgent );
		/*处理消息服务*/
		RongIMClient.init("kj7swf8o7csz2");//初始化



		RongIMClient.getInstance().setOnReceiveMessageListener(
				{//消息监听
					// 接收到的消息
					onReceived : function(message, info) {
                        //alert(info .getPortraitUri());
                        //alert(info .getPortraitUri());
				//		document.getElementById("msgDiv").innerHTML += message .getContent() + "<br>";
		    RongIMClient.getInstance().getUserInfo(message.getSenderUserId(),{
                onSuccess:function(info){
                    var name = info.getUserName();
                    var url = info.getPortraitUri();
                        document.getElementById("new_msg").innerHTML += '<article class="am-comment"> <li> <a href="#link-to-user-home"> <img src="'+url+'" alt="" class="am-comment-avatar user_head"/> </a> <div class="am-comment-main content_frame"> <div class="am-comment-meta content-detail" style="overflow-y: auto"> <a href="#link-to-user" class="am-comment-author">'+name+'</a><time datetime="<?php echo time(); ?>" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">"<?php  echo date('m-d,H:i', time()); ?>"</time> <br>' + message .getContent() + "</div></div> </li>";
                }, onError: function() {
                    alert("错误");
                }
            })
					},
					onError : function(errorCode) {
						console.log("ERROR CODE:" + errorCode);
					}
				});


		RongIMClient.setConnectionStatusListener({//连接状态监听
			onChanged : function(status) {
				//console.log(" Connection Status::" + status);
			}
		});

        var token="<?php echo $token;?>";
		//var token="mFDknbjLhcM3eoXbG9aMV6nr3XhPzf73ZRDsc8CNaGcJLhpIsiwlgm2np92SDA0izW7CcDKgQNA=";
		//var token ="你的TOKEN";
		RongIMClient.connect(token, {//连接
			onSuccess : function(userId) {
				if(!logined){
					console.log(userId + " logined....");
					logined=true;
				}
				alert("成功登录");
			},
			onError : function(errorCode) {
				alert("连接通讯服务器失败，错误码：" + errorCode + "\n单击确定按钮退出程序！");
			}
		});

		//
		ins = RongIMClient.getInstance();
        var c = document.getElementById("content"), s = document.getElementById("send");
        s.onclick = function () {
        document.getElementById("new_msg").innerHTML += '<article class="am-comment-flip"> <li> <a href="#link-to-user-home"> <img src="<?php echo $user_image;?>" alt="" class="am-comment-avatar user_head"/> </a> <div class="am-comment-main content_frame"> <div class="am-comment-meta content-detail" style="overflow-y: auto"> <a href="#link-to-user" class="am-comment-author"><?php echo $user_stu_name; ?></a><time datetime="<?php echo time(); ?>" title="2013年7月27日 下午7:54 格林尼治标准时间+0800">"<?php echo date('m-d,H:i', time()); ?>"</time> <br>' + c.value + "</div></div> </li>";
        var con = RongIMClient.ConversationType.setValue("3");
        var target = "<?php echo $groupId?>";
            ins.sendMessage(con, target, RongIMClient.TextMessage.obtain(document.getElementById("content").value), null, {
                onSuccess: function () {
        //            alert("send successfully");
                    console.log("send successfully");
                    c.value = (c.value * 1 + 1);
                }, onError: function () {
         //           alert("send fial");
                    console.log("send fail")
                }
            });
        }
		/*消息服务结束*/
	};
	//},false);
</script>

</head>

<body style="width:100%;height:100%;">
<div id="expImgs" style="width:100%;height:5%;background-color:#ccc;">

</div>
<div style="margin: 10px 10px">
</div>
<div style="margin: 10px 10px">
</div>


<div class="am-scrollable-vertical content_list" >
    <div id="new_msg">

			</div>
	</article>
</div>

    <footer data-am-widget="footer" class="room_footer room_footer_fixed">
    <div class="am-g">
        <div class="am-u-sm-9">
            <input id="content" type="text" class="chat_box" name="content" ></input>
        </div>
            <button id="send" type="button" class="am-btn am-btn-success send_button">发送</button>
        <div class="am-u-sm-1"></div>
    </div>
    </footer>


</div>
<div id="cons">

</div>
</body>
</html>
