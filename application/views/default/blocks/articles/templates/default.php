<div class="row">
	<div class="col-xs-12">
		<?php if (isset($home_block_1) && !empty($home_block_1)) { ?>
		<div class="block-big">
			<div class="col-xs-12 prl10">
                        <h3 class="title bar"><span><a href="<?= base_url().'tin-tuc' ?>">TIN TỨC</a></span></h3>
                    </div>
			<?php if (isset($home_block_1['data']['last']) && !empty($home_block_1['data']['last'])) { ?>
			<div class="col-xs02 col-sm-6 col-md-5 pr0 pt10 pb10">
				<div id="featured-new">
					<div class="featured-new-img">
						<a href="<?= $home_block_1['data']['last']['title_alias']; ?>" title="<?= $home_block_1['data']['last']['title']; ?>">
							<img src="<?= $home_block_1['data']['last']['image']; ?>" class="lazy img-thumbnail img-responsive" alt="<?= $home_block_1['data']['last']['title']; ?>" />
						</a>
					</div>
					<h2 class="mt5 mb10"><a href='<?= $home_block_1['data']['last']['title_alias']; ?>' title='<?= $home_block_1['data']['last']['title']; ?>'><?= $home_block_1['data']['last']['title']; ?></a></h2>
					<label class="clearfix mb5" style="display: inline-block;width:100%;">
						<span class="post-time gray font12"><?= date('H:i',strtotime($home_block_1['data']['last']['date'])).' '.date('A',strtotime($home_block_1['data']['last']['date']));?></span>
						<span class="gray font12 ml15"><?= date('d-m-Y',strtotime($home_block_1['data']['last']['date']));?></span>
					</label>
					<div class="caption">
						<?php
						if (!empty($home_block_1['data']['last']['summary'])) {
							echo stripString($home_block_1['data']['last']['summary'],520);
						}
						?>
					</div>
				</div>
			</div>

			<?php } ?>
			<?php if (isset($home_block_1['data']['last']) && !empty($home_block_1['data']['last_child'])){ ?>
			<div class="col-xs02 col-sm-6 col-md-7 pt10 pb10 hidden-xs">
				<div class="featured-thumb">
					<ul class="list-new-hot full-section">
						<?php foreach($home_block_1['data']['last_child'] as $getPostThumb){ ?>
						<li>
							<figure>
								<img src="<?= image_thumb('uploads/articles/'.$getPostThumb->image,MAX_WIDTH_ARTICLE,MAX_HEIGHT_ARTICLE) ?>" class="lazy img-responsive img-thumbnail" alt="<?= $getPostThumb->title ?>" />
							</figure>
							<h3><a href="<?= $domain.$getPostThumb->cate_slug.'/'.$getPostThumb->title_alias;?>.html" title='<?= $getPostThumb->title; ?>'><?= stripString($getPostThumb->title,80,''); ?></a></h3>
							<div class="summary">
								<span class="meta"><?= date('d-m-Y H:i',strtotime($getPostThumb->created_at))?></span>
								<p><?= stripString($getPostThumb->summary,220,''); ?></p>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } ?>
			<div class="col-xs02 mt5 text-center wow flash" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="1s" style="display:inline-block;width:100%;">
                <?php
                    $links = array(
                        array('url' => base_url().'tin-tuc', 'name'=>'TIN TỨC'),
                    );
                    $num = array_rand($links);
                    $item = $links[$num];
                    printf('<a class="moreview" rel="dofollow" href="%s" title="%s">%s</a>', $item['url'], $item['name'], 'Xem tất cả');
                ?>
            </div>
		</div>
		<?php } ?>

	</div>

</div>