<section id="content" class='section'>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<ol class="breadcrumb">
					<li><a href="<?= $domain; ?>" title="<?= SITENAME; ?>"><i class="fa fa-home fa-fw"></i>Trang chủ</a></li>
					<li class="active">Tìm kiếm</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				<div class="content-section">
					<h1 class="title"><span>Tìm kiếm</span></h1>
					<!-- .item-new -->
					<?php
					if (!empty($articles)) {
						foreach ($articles as $article) {
							?>
							<div class="row item-new wow fadeInDown">
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="new-image curve-shadow">
										<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $article->title; ?>">
											<img src="<?= $domain.'uploads/articles/'.$article->image; ?>" class="img-responsive thumbnail" alt="<?= $article->title; ?>"  />
										</a>
									</div>
								</div>
								<div class="new-info col-xs-12 col-sm-8 col-md-8">
									<h2 class="new-title">
										<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $article->title; ?>"><?= $article->title; ?></a>
									</h2>
									<div class="new-meta text-left">
										<span><i class="fa fa-calendar fa-fw"></i><?= date('m-d-Y H:i:s',strtotime($article->created_at)); ?></span>
										<span><i class="fa fa-folder-open-o fa-fw"></i><a href="<?= $domain.$article->slug_cate;?>" title="<?= $article->path; ?>"><?= str_replace('/', '<i class="fa fa-angle-double-right fa-fw"></i>', trim($article->path)); ?></a></span>
									</div>
									<p class="new-description">
										<?php
										if (!empty($article->summary)) {
											echo stripString($article->summary,180,' ...');
										}else{
											echo stripString(json_decode($article->params)->meta_description,180,' ...');
										}
										?>
									</p>
									<div class="pull-right">
										<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="Đọc thêm => <?= $article->title; ?>" class="btn btn-primary read">Đọc thêm <i class="fa fa-arrow-circle-o-right fa-fw"></i></a>
									</div>
								</div>
							</div>
							<?php
						}
					}else{
					?>
					<div class="row item-new">
						<p class="text-center">Chưa có bài viết cho nội dung này</p>
					</div>
					<?php
					}
					?>
					<!-- pagination -->
					<?= isset($link) ? $link : '';?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar-section">
					<!-- Sub Category -->
					<?php
					$this->load->view('default/search_bar');
					if (!empty($hasParent)) {
					?>
					<div class="box-bar">
						<h1 class="title"><span><?= $category->title; ?></span></h1>
						<ul class="danhmuc">
							<?php
								foreach ($hasParent as $key => $subCategory) {
								?>
								<li><i class="fa fa-angle-right"></i><a href="<?= $domain.$subCategory->title_alias; ?>" title="<?= $subCategory->title; ?>"><?= $subCategory->title; ?></a></li>
								<?php
								}
							?>
						</ul>
					</div>
					<?php
					}
					?>
					<!-- End Sub Category -->
					<?php
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
											<li><i class="fa fa-check-square-o"></i><a href="<?= $domain.$subarticle->cate_slug.'/'.$subarticle->title_alias; ?>.html" title="<?= $subarticle->title; ?>"><?= stripString( $subarticle->title,50,'...'); ?></a></li>
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