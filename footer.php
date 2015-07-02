 <!-- footer -->
  <footer id="footer" class="app-footer" role="footer">
        <div class="wrapper b-t bg-light">
      <span class="pull-right">2.0.1 <a href ui-scroll="app" class="m-l-sm text-muted"><i class="fa fa-long-arrow-up"></i></a></span>
    	&copy; 2015 Copyright.
    </div>
  </footer>
  <!-- / footer -->

</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script>
	$(function(){
		$("#cli").click(function(){
			$("#usuario").hide("meddium");
		});

		$("#adm").click(function(){
			$("#usuario").show("meddium");
		});

		$("#mon").click(function(){
			$("#usuario").show("meddium");
		});
	});
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
<!--<script src="js/ui-load.js"></script>
<script src="js/ui-jp.config.js"></script>
<script src="js/ui-jp.js"></script>-->
<script src="js/ui-nav.js"></script>
<script src="js/ui-toggle.js"></script>

</body>
</html>