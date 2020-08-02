<div class="col-sm-6 col-md-3 widget">
	<?php if (json_decode($block->params)->show_title == 1) { ?>
	<h4><?= $block->title; ?></h4>
	<?php } ?>
	<div class="widget-content">
		<?php if ($this->mmenus_items->get_menus(json_decode($block->params)->group_id)) { ?>
		<ul id="introduce-company" class="introduce-list">
			<?php foreach ($this->mmenus_items->get_menus(json_decode($block->params)->group_id) as $sub){?>
			<li>
				<a href="<?= $sub['title_alias'];?>" title="<?= $sub['title'] ?>"><?= $sub['title'] ?></a>
			</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
</div>