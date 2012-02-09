	
	</div>
	<div id="footer">
		<div id="foot">
			<?php 
				$options = get_option('themezee_options');
				if ( isset($options['themeZee_footer']) and $options['themeZee_footer'] <> "" ) { 
					echo  esc_attr($options['themeZee_footer']); } 
			?>
			<div class="credit_link"><a href="<?php echo THEMEZEE_INFO; ?>">Wordpress Theme by ThemeZee</a></div>
			<div class="clear"></div>
		</div>
	</div>
</div>
	<?php wp_footer(); ?>
</body>
</html>