<!-- Tag -->
<div class="box-bar">
	<h1 class="title"><span>Chủ đề</span></h1>
	<div id="tags">
		<?php
		if (!empty($taged)) {
			foreach ($taged as $s_tag) {
				?>
				<a href="<?= $domain.'tag/'.$s_tag->slug; ?>" title="<?= $s_tag->name; ?>"><?= $s_tag->name; ?></a>
				<?php
			}
		}
		?>
	</div>
</div>