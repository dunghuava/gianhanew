<?php if (isset($external_links) && !empty($external_links)) { ?>
<div class="box">
	<h1 class="title bar"><span>Liên kết nổi bật</span></h1>
	<div class="box-content">
		<ul class="most-read">
			<?php 
			foreach ($external_links as $external_link) {
				?>
				<li><i class="fa fa-caret-right"></i><h4><a href="<?= $external_link->title_alias; ?>" title="<?= $external_link->title; ?>"><?= $external_link->title; ?></a></h4></li>
				<?php
			}
			?>
		</ul>
	</div>
</div>
<?php } ?>
