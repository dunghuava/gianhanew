<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
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
    	            <li property="itemListElement" typeof="ListItem"><a href="<?= $domain.$this->uri->uri_string() ?>" title="<?= $category->title; ?>"><?= $category->title; ?></a></li>
    	            <?php
    	            }
    				?>
    				<li class="active"><a href="<?= $domain. $this->uri->uri_string(); ?>" title="<?= $article->title ?>"><?= stripString($article->title,72,'...'); ?></a></li>
				</ol>
				<div class="block-big content-section entry" itemscope itemtype="http://schema.org/NewsArticle">
					<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>
					<h1 class="entry-title" itemprop="headline"><?= $article->title; ?></h1>
					<h2 itemprop="author" itemscope itemtype="https://schema.org/Person" class="hidden">
						By <span itemprop="name">John Doe</span>
					</h2>
					<div class="entry-meta">
						<span class="date pull-left">
							<i class="fa fa-calendar fa-fw"></i><?= date('m-d-Y',strtotime($article->updated_at)).' | <i class="fa fa-clock-o fa-fw"></i> '.date('H:i',strtotime($article->updated_at)).' '.date('A',strtotime($article->updated_at)).' | <i class="fa fa-eye fa-fw"></i> '.$article->hits; ?>
						</span>
					</div>
                    <div class="summary" itemprop="description">
                        <h2><?= $article->summary?></h2>
                    </div>
                    <?php if (!empty($article->image)) { ?>
                    <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject" class="hidden">
                    	<img src="<?= $domain.'uploads/articles/'.$article->image; ?>"/>
                    	<meta itemprop="url" content="<?= $domain.'uploads/articles/'.$article->image; ?>">
                    	<meta itemprop="width" content="800">
                    	<meta itemprop="height" content="800">
                    </div>
                    <?php } ?>
                    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization" class="hidden">
                    	<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                    		<img src="<?= LOGOSITE; ?>"/>
                    		<meta itemprop="url" content="<?= LOGOSITE; ?>">
                    		<meta itemprop="width" content="600">
                    		<meta itemprop="height" content="60">
                    	</div>
                    	<meta itemprop="name" content="Văn Phòng Hồ Chí Minh">
                    </div>
                    <meta itemprop="datePublished" content="<?= date('c',strtotime($article->created_at)) ?>"/>
                    <meta itemprop="dateModified" content="<?= date('c',strtotime($article->updated_at)) ?>"/>
					<div class="noidung"><?= $article->content;?></div>
                    <?php
                    if(!empty($article->source_link))
                    {
                    ?>
                    <div class="author">
					   <strong class="pull-left">Nguồn: </strong> <input value="<?= $article->source_link;?>" type="author"/>
					</div>
                    <?php
                    }
                    ?>
                    
                    <div class="share">
                        <span>CHIA SẺ</span>
                        <div class="fb-share-button" data-href="<?= $domain.$this->uri->uri_string(); ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?= $domain.$this->uri->uri_string(); ?>">Chia sẻ</a></div>
                    </div>
                    <script type="text/javascript">
							(function($) {
								$.fn.replacetext = function(target, replacement) {
						         	// Get all text nodes:
							         var $textNodes = this
							         .find("*")
							         .andSelf()
							         .contents()
							         .filter(function() {
							         	return this.nodeType === 3 && 
							         	!$(this).parent("a").length;
							         });
						         
						         	// Iterate through the text nodes, replacing the content
						         	// with the link:
						         	$textNodes.each(function(index, element) {
							         	var contents = $(element).text();
							         	contents = contents.replace(target, replacement);
							         	$(element).replaceWith(contents);
						         	});
						     	};
							 })(jQuery);
                              /*
							  $("div.noidung").replacetext(/Tp.HCM/gi, "<a href='http://s-nhadat.com/nha-dat-cho-thue/ho-chi-minh-tp39923992.htm'>$&</a>");
                              $("div.noidung").replacetext(/thuê nhà/gi, "<a href='http://s-nhadat.com/nha-dat-cho-thue/ho-chi-minh-tp39923992.htm'>$&</a>");
                              $("div.noidung").replacetext(/bán nhà/gi, "<a href='http://s-nhadat.com/nha-dat-ban'>$&</a>");
                              */
						</script>
					<?php
					if (!empty($tags)){
						?>
						<div class="post-meta tag">
							<i class="fa fa-tags"></i>
							<?php
							foreach ($tags as $key => $tag) {
								echo '<a href="'.$domain.'tag/'.$tag->tag_slug.'">'.$tag->tag_name.'</a>';		
							}
							?>
						</div>
						<?php
					}
					?>
                    <?php
                    if($article->is_comment == 1)
                    {
                    ?>
                    <ul class="project-tab nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#facebook">Facebook</a></li>
                        <li><a data-toggle="tab" href="#google" onclick="CmtGoogle();">Google +</a></li>
                    </ul>
                    <div class="project-tab-content tab-content">
                        <div id="facebook" class="tab-pane fade in active">
                            <div class="fb-comments" data-href="<?= $domain.$this->uri->uri_string(); ?>" data-numposts="20" width="100%" data-colorscheme="light" data-version="v2.3"></div>
                        </div>
                        <div id="google" class="tab-pane fade">
                            <!-- Google Plus -->
                            <script src="https://apis.google.com/js/plusone.js">
                            </script>
                            <div class="g-comments"
                                data-href="<?= $domain.$this->uri->uri_string(); ?>"
                                data-width="630"
                                data-first_party_property="BLOGGER"
                                data-view_type="FILTERED_POSTMOD">
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
					
				</div>
				<!-- Same cate -->
				<div class="block-big">
					<div class="col-xs-12">
						<h3 class="title bar"><span>Tin tức mới liên quan</span></h3>
					</div>
					<?php
					if (!empty($otherGetDetail)) {
						$jump = count($otherGetDetail);
						for($i=0; $i<$jump; $i+=2)
						{
							?>
							<div class="articles">
								<?php
								for($j=$i; $j<($i+2); $j++)
								{
									if(empty($otherGetDetail[$j])) continue;
									?>
									<article class="col-xs-6 col-sm-6 col-md-6 product pr10 pl10 mb15">
										<div class="item">
											<figure class="col-xs-5 col-md-5 product-img o-new-img">
												<a href="<?= $domain.$otherGetDetail[$j]->slug_cate.'/'.$otherGetDetail[$j]->title_alias; ?>.html" title="<?= str_replace('"','',$otherGetDetail[$j]->title); ?>">
													<img src="<?= $domain.'uploads/articles/'.$otherGetDetail[$j]->image; ?>" alt="<?= str_replace('"','',$otherGetDetail[$j]->title); ?>" class="img-thumbnail img-responsive" />
												</a>
											</figure>
											<div class="description col-md-7">
												<h3>
													<a href="<?= $domain.$otherGetDetail[$j]->slug_cate.'/'.$otherGetDetail[$j]->title_alias; ?>.html" title="<?= str_replace('"','',$otherGetDetail[$j]->title); ?>"><?= stripString($otherGetDetail[$j]->title,120); ?></a>
												</h3>
											</div>
										</div>
									</article>
									<?php
								}
								?>
							</div>
							<?php	
						}
					}else{
						?>
						<div class="col-xs-12">
							<p class="text-left empty-data">Thông tin đang được cập nhật....</p>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<!-- -->
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="slidebar">
					<?php $this->load->view($modules.'/sidebar'); ?>
				</div>
			</div>
		</div>
	</div>
</div>