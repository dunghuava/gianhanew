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
    	            <li class="active" property="itemListElement" typeof="ListItem"><?= $category->title; ?></li>
    	            <?php
    	            }
    				?>
				</ol>
				<!-- rao vat noi bat -->
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar margintTop"><span><?= $category->title . ' tại '. $province->name; ?></span></h1>
					</div>
                    <div class="article-grid">
					<?php
					if (!empty($realestates)) {
						foreach ($realestates as $realestate) {
					?>
					<article class="col-xs-6 col-md-6 product mb5 p5">
						<div class="item">
							<figure class="col-xs-4 col-md-4 product-img">
								<a href="<?=$domain.$realestate->slug_cate.'/'.$realestate->title_alias.'-'.$realestate->id;?>" title="<?= $realestate->title; ?>">
									<img src="<?= $domain.'uploads/properties/'.getThumbnail($realestate->id,'thumb_'); ?>" alt="<?= $realestate->title; ?>" class="img-thumbnail img-responsive center-block" />
								</a>
							</figure>
							<div class="col-xs-8 col-md-8 description">
								<h3><a class="<?= $realestate->type_class; ?>" href="<?=$domain.$realestate->slug_cate.'/'.$realestate->title_alias.'-'.$realestate->id;?>" title="<?= $realestate->title; ?>"><?= stripString($realestate->title,65,'.'); ?></a></h3>
								<div class="cusInfo">
									<span class='price'>Giá:
										<?php 
										if($realestate->price > 0 && $realestate->price_type !=0){
											echo $realestate->price. ' '.showUnit($realestate->price_type);
										}else{
											echo 'Thỏa thuận';
										}
										?>	
									</span>
                                    <span class="small pull-right">DT:
                                        <strong><?= ($realestate->area != 0) ? ''.$realestate->area.' m<sup>2</sup>' : 'KXĐ'; ?></strong>
                                    </span>
								</div>
								<div class="cusInfo location">
									<span>
										<a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'/'.$realestate->slug_d; ?>.htm" title="<?= $realestate->title_cate.' '.$realestate->d_name; ?>"><?= $realestate->d_name; ?></a>
									</span>
									<span class="hidden-xs hidden-sm date pull-right"><?= date('d/m/Y',strtotime($realestate->updated_at)); ?></span>
								</div>
							</div>
						</div>
					</article>
					<?php
						}
					}else{
						?>
						<div class="col-xs-12">
							<p class="text-center empty-data">Đang cập nhật thông tin....</p>
						</div>
						<?php
					}
					?>
                    </div>
					<div class="clearfix"></div>
					<div class="col-xs-12">
						<?=isset($link) ? $link : ''; ?>
					</div>
				</div>
				<!-- /raovat noi bat -->
			</div>
			<!--/Content -->
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="slidebar">
					<?php
					if (isset($hasParentCates) && !empty($hasParentCates)) {
						?>
						<div class="box">
							<h3 class="title bar"><span><?= $title_hasParentCates; ?></span></h3>
							<div class="box-content">
								<ul class="most-read">
									<?php
									foreach ($hasParentCates as $hasParentCate) {
										?>
										<li>
											<i class="fa fa-caret-right"></i>
											<h4><a href='<?= $domain.$hasParentCate->title_alias ?>' title='<?= $hasParentCate->title; ?>'><?= $hasParentCate->title; ?></a></h4>
										</li>
										<?php
									}
									?>
								</ul>
							</div>
						</div>
						<?php
					}
					?>
					<?php if (isset($districts) && !empty($districts)) { ?>
						<div class="box">
							<h3 class="title loca"><span><?= $category->title.' tại '. $province->name; ?></span></h3>
							<div class="box-content">
								<ul class="most-read">
									<?php
									foreach ($districts as $district) {
									   $countRowTable = countTable('realestates',array('district_id'=>$district->district_id,'category_id'=>$category->id));
                                       if($countRowTable > 0){
                                    ?>
                                    <li><i class="fa fa-caret-right"></i><h4><a href='<?= $domain.$category->title_alias.'/'. $province->slug_name.'/'.$district->slug_name;?>.htm' title='<?= $category->title.' tại'. $district->pre. ' ' .$district->name; ?>'><?= $district->name . ' <span class="countR">('.$countRowTable.')</span>'; ?></a></h4></li>
                                    <?php  
                                       }
									}
									?>
								</ul>
							</div>
						</div>
					<?php } ?>
                    <?= $this->load->widget('external_links'); ?>
				</div>
			</div>
		</div>
	</div>
</div>