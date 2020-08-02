<section id="content" class='section'>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ol class="breadcrumb">
				<li><a href="<?= $domain; ?>" title="<?= SITENAME; ?>"><i class="fa fa-home fa-fw"></i>Trang chủ</a></li>
					<li><a href="<?= $domain.$article->slug_cate; ?>" title="<?= $article->title_cate;?>"><?= $article->title_cate;?></a></li>
					<li class="active"><?= $article->title; ?></li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="content-section">
					<div class="post">
						<h1 class="post-title"><?= $article->title; ?></h1>
						<div class="post-meta">
							<ul class="news-meta">
								<li class="date"><i class="fa fa-calendar"></i> <?= date('m-d-Y',strtotime($article->created_at)).' at '.date('H:i:s',strtotime($article->created_at));?></li>
								<li><i class="fa fa-folder-open-o fa-fw"></i><a href="<?= $domain.$article->slug_cate; ?>" title="<?= $article->title_cate;?>"><?= $article->title_cate;?></a></li>
							</ul>
						</div>
						<div class="noidung">
							<?= $article->content;?>
						</div>
						<?php
						if (!empty($tags)) {
						?>
						<div class="post-meta tag">
							<i class="fa fa-tags"></i>
							<?php
							foreach ($tags as $key => $tag) {
								echo '<a itemprop="keywords" href="'.$domain.'tag/'.$tag->tag_slug.'">'.$tag->tag_name.'</a>';		
							}
							?>
						</div>
						<?php
						}
						?>
						<div class="alert alert-success notice text-left my-alert">
							<span class="pull-left" style="text-transform:none;margin-top:5px;"><i class="fa fa-share-alt fa-fw"></i> Chia sẻ :</span>
							<div class="addthis_native_toolbox" style="margin-top:5px;"></div>
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fd48fc101e64abb" async="async"></script>
						</div>
					</div>
					<h1 class="title"><span>Bài viết liên quan</span></h1>
					<!-- .item-new -->
					<?php
					if (!empty($otherGetDetail)) {
						foreach ($otherGetDetail as $key => $other) {
					?>
					<div class="row item-new wow fadeInDown">
						<div class="col-xs-12 col-sm-4 col-md-4">
							<div class="new-image curve-shadow">
								<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $other->title; ?>">
									<img src="<?= $domain.'uploads/articles/'.$other->image; ?>" class="img-responsive thumbnail" alt="<?= $other->title; ?>"  />
								</a>
							</div>
						</div>
						<div class="new-info col-xs-12 col-sm-8 col-md-8">
							<h2 class="new-title">
								<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $other->title; ?>"><?= $other->title; ?></a>
							</h2>
							<div class="new-meta text-left">
								<span><i class="fa fa-calendar fa-fw"></i><?= date('m-d-Y H:i:s',strtotime($other->created_at)); ?></span>
								<span><i class="fa fa-folder-open-o fa-fw"></i><a href="<?= $domain.$other->slug_cate;?>" title="<?= str_replace('/', ' - ', trim($other->path)); ?>"><?= str_replace('/', '<i class="fa fa-angle-double-right fa-fw"></i>', trim($other->path)); ?></a></span>
							</div>
							<p class="new-description">
								<?php
								if (!empty($other->summary)) {
									echo stripString($other->summary,180,' ...');
								}else{
									echo stripString(json_decode($other->params)->meta_description,180,' ...');
								}
								?>
							</p>
							<div class="pull-right">
								<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="Đọc thêm => <?= $other->title; ?>" class="btn btn-primary read">Đọc thêm <i class="fa fa-arrow-circle-o-right fa-fw"></i></a>
							</div>
						</div>
					</div>
					<?php
						}
					}else{
					?>
					<div class="row item-new">
						<p class="text-center">Chưa có bài viết nào.</p>
					</div>
					<?php
					}
					?>
					
					<!-- /.item-new -->
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar-section">
					<?php
					$this->load->view('default/search_bar');
					if (!empty($sidebars)) {
						foreach ($sidebars as $sidebar) {
							?>
							<div class="box-bar">
								<h1 class="title"><span><?= $sidebar['title']; ?></span></h1>
								<ul class="danhmuc">
									<?php
									if (!empty($sidebar['articles'])) {
										foreach ($sidebar['articles'] as $subarticle) {
											?>
											<li><i class="fa fa-angle-right"></i><a href="<?= $domain.$subarticle->cate_slug.'/'.$subarticle->title_alias; ?>.html" title="<?= $subarticle->title; ?>"><?= stripString( $subarticle->title,50,'...'); ?></a></li>
											<?php
										}
									}
									?>
								</ul>
							</div>
							<?php
						}
					}
					$this->load->view('default/tags');
					?>

				</div>
			</div>
		</div>
	</div>
</section>
<!-- end dich vu -->
<div class='clearfix'></div>