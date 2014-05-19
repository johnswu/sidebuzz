<?php
include '../header.php';
$userData='';
if(!empty($userSession))
{
$userData=$OauthLogin->userDetails($userSession);
//header("Location:home.php");
}
else
{
header("Location:/index.php");
}
?>
<html>
	<head>
		<title>Side.Buzz - Seattle Startup Weekend</title>
		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script src="/phpfreechat-2.1.0/client/jquery.phpfreechat.min.js" type="text/javascript"></script>
		<script src="http://js.pusher.com/2.2/pusher.min.js"></script>
		<script src="/js/sidebuzz.js"></script>
		
		<link rel="stylesheet" type="text/css" href="/css/sidebuzz.css"></link>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400" rel="stylesheet" />
		<link rel="stylesheet" href="/css/lib/fontello.css" />
		<link rel="stylesheet" href="/css/lib/normalize.css" />
		<link rel="stylesheet" href="/css/index.css" />
		<link rel="stylesheet" href="/css/sidebar.css" />
		
		<link rel="stylesheet" type="text/css" href="/phpfreechat-2.1.0/client/themes/carbon/jquery.phpfreechat.min.css" />
	</head>
	<body>
	
		<div class="wrapper jsc-sidebar-content jsc-sidebar-pulled">
			<!-- <nav> -->
				<a href="#" class="icon-menu link-menu jsc-sidebar-trigger"></a>
				<div class="eventTitle"> - Seattle Startup Weekend</div>
				<img style="float:right;height:35px;" src="<?php echo $userData['picture'] ?>" />
			<!-- </nav> -->
			<section class="main-content">
				<iframe id="hostFrame" style="border:1px solid #cccccc;">
				</iframe>
				<div id="chatContainer">
					<div id="mychat"><a href="http://www.phpfreechat.net">phpFreeChat: simple Web chat</a></div>
				</div>
			</section>
		</div>

		<nav class="sidebar jsc-sidebar" id="jsi-nav" data-sidebar-options="">
			<ul class="sidebar-list">
				<li><a href="./" class="current">SideBuzz</a></li>
				<li><a href="#" onclick="openChat();">Chat On/Off</a></li>
				<li><a href="#">Map</a></li>
				<li><a href="#">Schedule</a></li>
				<li><a href="#">Bio</a></li>
			</ul>
		</nav>
						
		<script src="/js/sidebar.js"></script>
		<script>
			$('#jsi-nav').sidebar({
				trigger: '.jsc-sidebar-trigger',
				pullCb: function () { console.log('pull'); },
				pushCb: function () { console.log('push'); }
			});
		</script>

		<script type="text/javascript">
		  $('#mychat').phpfreechat({ 
				serverUrl: '/phpfreechat-2.1.0/server',
				show_powered_by: false
				});
		</script>
		<script type="text/javascript">
			// Reset iframe height after window resize
			$(function(){
				$(window).resize(function(){
					resizeHostFrame();
				});
			});

			resizeHostFrame();
			checkPushCycle();
		</script>
	</body>
</html>