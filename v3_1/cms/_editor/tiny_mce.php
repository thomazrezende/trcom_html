	<script language="javascript" type="text/javascript" src="_editor/tinymce.min.js"></script>
    <script language="javascript" type="text/javascript" src="_editor/jquery.tinymce.min.js"></script>
	<script language="javascript" type="text/javascript">
		tinymce.init({
			plugins: "link", 
			menubar : false,
			resize: false,
			selector: ".editor",
			content_css : "_editor/tiny_mce_content.css",
			width : '100%',
			toolbar: "undo redo | bold italic | link unlink | image",
			//mudar default font size:
			setup : function(ed){
				ed.on('init', function(){ this.getDoc().body.style.fontSize = '12px'; });
			}
		 });
	</script>