<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 pr0">
                <ol class="breadcrumb my-breadcrumb" vocab="http://schema.org/" typeof="BreadcrumbList">
					<li property="itemListElement" typeof="ListItem">
                        <a property="item" typeof="WebPage" href="<?= $domain; ?>" title="<?= SITENAME; ?>">
                            <span property="name"><i class="fa fa-home fa-fw"></i>Trang chủ</span>
                            <meta property="position" content="1" />
                        </a>
                    </li>
                    <?php
    				$path = explode('/', $category->path);
    				$path_alias = explode('/', $category->path_alias);
    				if (sizeof($path_alias) > 2 || sizeof($path_alias) == 2) {
    					for ($i=0; $i < sizeof($path_alias) ; $i++) { 
    						?>
    						<li property="itemListElement" typeof="ListItem">
                                <a property="item" typeof="WebPage" href="<?= $domain.$path_alias[$i];?>" title="<?= $path[$i] ?>"><?= $path[$i];?></a>
                            </li>
    						<?php
    					}
    				}else{
    	            ?>
    	            <li property="itemListElement" typeof="ListItem"><a href="<?= $domain.$this->uri->uri_string(); ?>" title="<?= $category->title; ?>"><?= $category->title; ?></a></li>
    	            <?php
    	            }
    				?>
				</ol>
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar"><span><?= $category->title; ?></span></h1>
					</div>
                    <div class="article-grid">
                    	<?php if (!empty($articles)) { ?>
                    	<div class="other-new">
                    		<?php foreach ($articles as $key => $article) { ?>
                    		<article class="col-sm-6 article mb5 p5">
                    			<div class="item">
                    				<figure class="col-md-12 col-xs-12 article-img mb10 pt5 pl10 pr10">
                    					<a href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $article->title; ?>">
                                            <img src="<?= image_thumb('uploads/articles/'.$article->image,MAX_WIDTH_ARTICLE,MAX_HEIGHT_ARTICLE);?>" class="img-thumbnail img-responsive center-block" alt="<?= $article->title ?>" />
                    					</a>
                    				</figure>
                    				<div class="description col-md-12 pl10 pr10">
                    					<h3 class="mb5">
                    						<a class="font14" href="<?= $domain.$article->slug_cate.'/'.$article->title_alias;?>.html" title="<?= $article->title; ?>"><?= $article->title; ?></a>
                    					</h3>
                    					<label class="clearfix mb5" style="display: inline-block;width:100%;">
                    						<span class="post-time gray font12"><?= date('H:i',strtotime($article->created_at)).' '.date('A',strtotime($article->created_at));?></span>
                    						<span class="gray font12 ml15"><?= date('d-m-Y',strtotime($article->created_at));?></span>
                    					</label>
                    					<p class="des hidden-xs">
                    						<?php
                    						if (!empty($article->summary)) {
                    							echo stripString($article->summary,140);
                    						}
                    						?>
                    					</p>
                    				</div>
                    			</div>
                    		</article>
                    		<?php } ?>
                    	</div>
                    <?php } ?>
                    </div>
                    <div class="clearfix"></div>
					<div class="col-xs-12">
						<?=isset($link) ? $link : ''; ?>
					</div>
				</div>
				<!-- /raovat noi bat -->
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<?php $this->load->view($modules.'/sidebar'); ?>
			</div>
		</div>
	</div>
</div>