<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
				
				<!-- rao vat noi bat -->
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar margintTop"><span><?= $h1_title; ?></span></h1>
					</div>
					<?php
					if (!empty($realestates)) {
						foreach ($realestates as $realestate) {
					?>
					<article class="col-xs-6 col-md-12 product">
						<div class="item">
							<figure class="product-img col-md-3">
								<a href="<?=$domain.$realestate->title_alias.'-'.toPublicId($realestate->id);?>" title="<?= $realestate->title; ?>">
									<img src="<?= $domain.'uploads/properties/'.getThumbnail($realestate->id,'thumb_'); ?>" alt="" class="img-thumbnail img-responsive center-block" />
								</a>
							</figure>
							<div class="description col-md-9">
								<h3><a class="<?= $realestate->type_class ?>" href="<?=$domain.$realestate->title_alias.'-'.toPublicId($realestate->id);?>" title="<?= $realestate->title; ?>"><?= stripString($realestate->title,185); ?></a></h3>
								<div class="cusInfo">
									<label class="pull-left">Giá</label>
									<span class='price'>:
										<?php
										if($realestate->price > 0 && $realestate->price_type !=0){
											echo '&nbsp;&nbsp;'.$realestate->price. ' '.showUnit($realestate->price_type);
										}else{
											echo 'Thỏa thuận';
										}
										?>
									</span>
								</div>
								<div class="cusInfo">
									<label class="pull-left">Diện tích</label>
									<?= ($realestate->area != 0) ? '<span class="small">:&nbsp;&nbsp;'.$realestate->area.' m<sup>2</sup></span>' : '<span class="small">:&nbsp;&nbsp;KXĐ</span>'; ?>
								</div>
								<div class="cusInfo location">
									<label class="pull-left">Vị trí</label>
									<span>:
										<a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'/'.$realestate->slug_d.'-'.toPublicId($realestate->district_id); ?>" title="<?= $realestate->title_cate.' '.$realestate->d_name; ?>"><?= $realestate->d_name; ?></a><i class="fa fa-caret-right fa-fw"></i><a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'-tp'.toPublicId($realestate->province_id); ?>" title="<?= $realestate->title_cate.' '.$realestate->p_name; ?>"><?= $realestate->p_name; ?></a>
									</span>
									<?php
                                        if (strtotime(date('d-m-Y',strtotime($realestate->updated_at))) == strtotime(date('m/d/Y'))){
                                            echo '<span class="hidden-xs hidden-sm date today pull-right">Hôm nay <em>('.date('H:i',strtotime($realestate->updated_at)).')</em></span>';
                                        }else{
                                            echo '<span class="hidden-xs hidden-sm date pull-right">'.date('d-m-Y',strtotime($realestate->updated_at)).'</span>';
                                        }
                                    ?>
								</div>
							</div>
						</div>
					</article>
					<?php
						}
					}else{
						?>
						<div class="col-xs-12">
							<p class="text-center empty-data">Chưa có thông tin phù hợp....</p>
						</div>
						<?php
					}
					?>
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
					<!--  -->
                    <div class="box">
                        <div class="box-content pt10">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- kiem tien khong de -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:265px;height:250px"
                                 data-ad-client="ca-pub-5590716065241387"
                                 data-ad-slot="2679885356"></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                    </div>
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
											<h4>
                                                <a href='<?= $domain.$hasParentCate->title_alias ?>' title='<?= $hasParentCate->title; ?>'><?= $hasParentCate->title; ?>
                                                <?php
                                                    $countRowTable = countRowTable('realestates',array('category_id'=>$hasParentCate->id));
                                                    echo $countRowTable > 0 ? '<span class="countR">('.$countRowTable.')</span>' : '';
                                                ?>
                                                </a>
                                            
                                            </h4>
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
					<?php
					if (isset($districts) && !empty($districts)) {
					?>
						<div class="box">
							<h3 class="title loca"><span><?= $category->title.' tại '. $province->name; ?></span></h3>
							<div class="box-content">
								<ul class="item-bar">
									<?php
									foreach ($districts as $district) {
										?>
										<li>
											<i class="fa fa-caret-right"></i>
											<h4>
												<a href='<?= $domain.$category->title_alias.'/'. $province->slug_name.'/'.$district->slug_name.'-'.toPublicId($district->district_id);?>' title='<?= $category->title.' tại'. $district->pre. ' ' .$district->name; ?>'><?= $district->name; ?>
                                                <?php
                                                    $countRowTable = countRowTable('realestates',array('district_id'=>$district->district_id));
                                                    echo $countRowTable > 0 ? '<span class="countR">('.$countRowTable.')</span>' : '';
                                                ?>
                                                </a>
											</h4>
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
				</div>
			</div>
		</div>
	</div>
</div>