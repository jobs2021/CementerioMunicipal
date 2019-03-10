<audio id="NotificationSound" style="display: none;" controls>
	<source src="<?php echo $server;?>/Views/static/assets/notification.mp3" type="audio/mp3">
</audio>

</body>
<script src="<?php echo $server;?>/Views/static/js/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo $server;?>/Views/static/js/toastr.min.js"></script>
<script src="<?php echo $server;?>/Views/static/js/socket.io.js"></script>
<script src="<?php echo $server;?>/Views/static/js/buscador.js"></script>
<script src="<?php echo $server;?>/Views/static/js/popper.min.js"></script>
<script src="<?php echo $server;?>/Views/static/js/bootstrap.min.js"></script>
<script src="<?php echo $server;?>/Views/static/js/leaflet.js"></script>


<!--- socketio -->

<script type="text/javascript">
	$(document).ready(function(){

		const socket = io('<?php echo $server;?>:8585');
		var audio = document.getElementById("NotificationSound");

		function mi(){
			window.location.replace("<?php echo $server;?>/eyetitulo");
			//alert("click");
		}

		socket.on('message',function(msj){
			var mmsj = JSON.parse(msj);
			var data = JSON.parse(mmsj.msj);

			toastr.success(data['msg'],data['title'],{"onclick" :mi ,"positionClass": "toast-top-right","closeButton": true,"newestOnTop": true,"timeOut": "0","extendedTimeOut": "0"});
			audio.play();

		});

	})
</script>



</html>
