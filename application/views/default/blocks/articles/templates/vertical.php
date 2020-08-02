<?php $single_item = NULL;?>
<div class="col-xs02 col-sm-6 prl10">
	<h2 class="title bar">
		<?php if (json_decode($block->params)->show_title == 1) { ?>
		<span><a href="#" title="<?= $block->title; ?>"><?= $block->title; ?></a></span>
		<?php } ?>
	</h2>
	<div class="new-hot">
		<?php if ($this->marticles->singleItem(json_decode($block->params))) { 
			$have_post= $this->marticles->singleItem(json_decode($block->params))?>
			<div class="post-img">
				<a href="<?= $domain.$have_post->cate_slug.'/'.$have_post->title_alias;?>.html" title="<?= $have_post->title; ?>">
					<img src="<?= image_thumb('uploads/articles/'.$have_post->image,MAX_WIDTH_ARTICLE,MAX_HEIGHT_ARTICLE);?>" class="img-thumbnail lazy img-responsive" alt="<?= $have_post->title; ?>" />
				</a>
			</div>
			<h3>
				<a class="post-title" href="<?= $domain.$have_post->cate_slug.'/'.$have_post->title_alias;?>.html?>" title="<?= $have_post->title; ?>"><?= $have_post->title; ?></a>
			</h3>
		<?php } ?>
		<!-- Foreach List -->
		<?php if ($this->marticles->loadBlocks(json_decode($block->params))) { ?>
		<ul class="list-new-hot">
			<?php foreach ($this->marticles->loadBlocks(json_decode($block->params)) as $value) {?>
			<li>
				<a href="<?= $domain.$value->cate_slug.'/'.$value->title_alias; ?>.html" title="<?= $value->title; ?>">
					<figure>
						<img alt='<?= $value->title; ?>' src="<?= image_thumb('uploads/articles/'.$value->image) ?>" class="img-responsive img-thumbnail" />
					</figure>
					<h3><?= $value->title; ?></h3>
				</a>
			</li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
</div>