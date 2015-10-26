<?php if ($this->session->userdata('is_logged') == 1){	?>
	<div class="dv-bc">
		<ul class="ul-lnk ul-inline">
			<li><i class="<?php echo $menu_icon ?>"></i><?php echo $p_menu_title ?></li>
			<?php echo !empty($menu_title) ? '<li>'.$menu_title.'</li>': '' ?>
		</ul>
	</div>
<?php } ?>