				</div> <!-- content -->
				<?php //include VIEWS_PATH . 'Layouts/elements/sidebar.php';?>
			</div> <!-- wrapper -->
			
			<div id="footer">
		        <div id="credits">
		   		<?php echo date("Y"); ?> &copy; <a href="http://www.golflogin.com">Splice Media LLC</a>. All Rights Reserved.
		        </div> <!-- credits -->
			</div> <!-- footer -->
  
		
		</div> <!-- container -->
		<script type="text/javascript">
		$(function () {
			$("#sidebar h3 a").click(function (e) {
				e.preventDefault();
				var $ul = $(this).parent().next("ul").slideToggle("fast");
			});
		});
		</script>
	</body>
</html>