<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar"><span><?= $meta_title; ?></span></h1>
					</div>
					<?php
					if (!empty($articles)) {
						?>
						<div class="other-new">
							<?php
							foreach ($articles as $key => $article) {
								?>
								<article class="col-xs-12 product">
									<div class="item">
										<figure class="product-img col-md-3">
											<a href="<?=$domain.$article->slug_cate.'/'.$article->title_alias.'.html';?>" title="<?= $article->title; ?>">
												<img src="<?= $domain.'uploads/articles/'.$article->image; ?>" alt="<?= $article->title; ?>" class="img-thumbnail img-responsive center-block" />
											</a>
										</figure>
										<div class="description col-md-9">
											<h3>
												<a href="<?=$domain.$article->slug_cate.'/'.$article->title_alias.'.html';?>" title="<?= $article->title; ?>"><?= $article->title; ?></a>
											</h3>
											<div class="new-meta text-left">
												<span><i class="fa fa-calendar fa-fw"></i><?= date('d-m-Y H:i',strtotime($article->created_at)); ?></span>
											</div>
											<p class="des">
												<?php
												if (!empty($article->summary)) {
													echo stripString($article->summary,193);
												}
												?>
											</p>
										</div>
									</div>
								</article>
								<?php
							}
							?>
						</div>
					<?php
						}
					?>
				</div>
				<!-- /raovat noi bat -->
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<?php $this->load->view($modules.'/sidebar'); ?>
			</div>
		</div>
	</div>
</div>