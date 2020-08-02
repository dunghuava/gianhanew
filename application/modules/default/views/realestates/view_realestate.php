<div id="homepage" class="section">
	<div class="container">
		<div class="row">
			<!--Content  -->
			<div class="col-xs-12 col-sm-8 col-md-8 nopadding-rgt">
				<!-- Detail -->
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
                                <a property="item" typeof="WebPage" href="<?= $domain.$path_alias[$i];?>" title="<?= $path[$i] ?>">
                                <span property="name"><?= $path[$i];?></span>
                               	</a>
                                <meta property="position" content="<?= $i; ?>" />
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
				<div class="block-big content-section">
					<div class="realestate">
						<div class="realestate-title">
							<h1 class="<?= $realestate->type_class ?>"><?= $realestate->title;?></h1>
						</div>
						<div class="realestate-meta">
							<div class="marker">
								<i class="fa fa-map-marker fa-fw"></i>
								<span>Khu vực :</span>
								<?php
								if ($realestate->project_id == 0) {
								?>
								<a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'/'.$realestate->slug_d; ?>.htm" title="<?= $realestate->title_cate.' tại '.$realestate->pre.' '. $realestate->d_name; ?>"><?= $realestate->title_cate.' tại '.$realestate->pre.' '. $realestate->d_name; ?></a> - <?= $realestate->p_name; ?>
								<?php
								}else{
									$projects = get_slug_project($realestate->project_id);
								?>
								<a href="<?= $domain.$realestate->slug_cate.'/'.$projects->project_slug.'-dn'.toPublicId($projects->project_id); ?>" title="<?= $realestate->title_cate.' tại '. $projects->project_name; ?>"><?= $realestate->title_cate.' tại '. $projects->project_name; ?></a> - <?= $realestate->pre . ' ' . $realestate->d_name . ' - ' . $realestate->p_name; ?>
								<?php
								}
								?>	
							</div>
							<div class="realestate-price">
								Giá :<span class="spanprice">&nbsp;
                                <?php if ($realestate->price > 0) { ?>
									&nbsp;<?= number_format($realestate->price,0,'','.').' '.showUnit($realestate->price_type); ?>
								<?php }else{ echo 'Thỏa thuận'; } ?>
                                </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								Diện tích : <span class="spanarea spanprice">&nbsp;<?= ($realestate->area > 0) ? $realestate->area .'m<sup>2</sup>': 'KXĐ'; ?></span>
							</div>
						</div>
						<div class="noidung">
							<h3>Thông tin mô tả</h3>
                            <?= nl2br($realestate->content); ?>
						</div>
                        <div class="share">
						    <span class='small'>Chia sẻ rộng rãi để tin của bạn có vị trí cao trên google</span>
				            <div class="meta-entry">
                                  <div class="addthis_native_toolbox" style="margin-top:5px;"></div>
						          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fd48fc101e64abb" async="async"></script>
						    </div>
						</div>
                        <script type="text/javascript">
						(function($) {
							$.fn.replacetext = function(target, replacement) {
						        var $textNodes = this
    						        .find("*")
    						        .andSelf()
    						        .contents()
    						        .filter(function() {
    						        	return this.nodeType === 3 && 
    						        	!$(this).parent("a").length;
    						        });
                                    var limit = 1;
						            $textNodes.each(function(index, element){
                                        if(index > limit) return false;
						         		var contents = $(element).text();
						         		    contents = contents.replace(target, replacement);
					         		        $(element).replaceWith(contents);
						         	});
						        };
						     })(jQuery);
						     $("div.noidung").replacetext(/<?= $realestate->d_name;?>/gi, "<a href='<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'/'.$realestate->slug_d; ?>.htm'>$&</a>");
                             $("div.noidung").replacetext(/<?= $category->title;?>/gi, "<a rel='dofollow' href='<?= $domain.$realestate->slug_cate; ?>'>$&</a>");
                        </script>
                        <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I&libraries=drawing,places"></script>
                        <div class="row">
							<div class="col-xs-12">
                                <!-- Image -->
                                <?php if (!empty($gallerys)){ ?>
                                <h3 class="title-content">Hình ảnh</h3>
                                <div id="realestate_image">
                                	<div id="myCarousel" class="carousel slide" data-ride="carousel">
                                		<div class="carousel-inner" role="listbox">
                                			<?php foreach ($gallerys as $k => $gallery) { ?>
                                			<div class="item <?= $k==0 ? 'active' : ''; ?>">
                                				<img class="img-responsize" src="<?= $domain; ?>/resizer/timthumb.php?src=uploads/properties/<?= date('Y',strtotime($realestate->created_at)).'/'.date('m',strtotime($realestate->created_at)).'/'.date('d',strtotime($realestate->created_at)).'/'.$gallery->image; ?>" alt="<?= $gallery->image; ?>" />
                                			</div>
                                			<?php } ?>
                                		</div>
                                		<!-- Left and right controls -->
                                		<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                			<span class="sr-only">Prev</span>
                                		</a>
                                		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                			<span class="sr-only">Next</span>
                                		</a>
                                	</div>
                                </div>
                                <?php } ?>
								<!-- Nav tabs -->
								
								<?php if ($realestate->lat > 0 && $realestate->lng > 0) { ?>
								<h3 class="title-content">Bản đồ</h3>
								<div class="map-meta">
									<ul>
										<li><i class="mini-icon icon-market"></i> Vị trí BĐS</li>
										<li><i class="mini-icon icon-school"></i> Trường học</li>
										<li><i class="mini-icon icon-hospital"></i> Bệnh viện</li>
										<li><i class="mini-icon icon-park"></i> Công viên</li>
									</ul>
								</div>
								<div id="realestate_map" style="height:460px;"></div>
								<input type="hidden" id="lat" value="<?php echo $realestate->lat; ?>" />
								<input type="hidden" id="lng" value="<?php echo $realestate->lng; ?>" />
								<script type="text/javascript">
									function in_array(one, arr) {
										var i;
										for (i in arr) {
											if (arr[i] === one)
												return true;
										}
										return false;
									}
								    var mapHereLoc, infoWindowHereLoc, cat_id = <?=$realestate->category_id; ?>;
								    $(document).ready(function () {
								    	var pyrmont = new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value);
								    	mapHereLoc = new google.maps.Map(document.getElementById('realestate_map'), {
								    		center: pyrmont,
								    		zoom: 15,
								    		scrollwheel: false
								    	});
								    	var options = {
								    		position: pyrmont,
								    		map: mapHereLoc,
								    		icon: DIR_ROOT + 'public/default/images/marker/marker.png'
								    	};
								    	new google.maps.Marker(options);
								    	infoWindowHereLoc = new google.maps.InfoWindow();
								    	searchPlacesHereLoc(document.getElementById('lat').value, document.getElementById('lng').value,cat_id);
								    	var pyrmont = new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value);
								    	var populationOptions = {
								    		strokeColor: '#0098BB',
								    		strokeOpacity: 0.8,
								    		strokeWeight: 2,
								    		fillColor: '#0098BB',
								    		fillOpacity: 0.35,
								    		map: mapHereLoc,
								    		center: pyrmont,
								    		radius: 1000
								    	};
								    	var cityCircle = new google.maps.Circle(populationOptions);
								    });
								    function searchPlacesHereLoc() {
								    	var service = new google.maps.places.PlacesService(mapHereLoc);
								    	var all = ['hospital', 'school', 'park'];
								    	var request = {
								    		location: new google.maps.LatLng(document.getElementById('lat').value, document.getElementById('lng').value),
								    		radius: 1000, // mét
								    		types: all
								    	};
								    	service.nearbySearch(request, callbackHereLoc);
								    }
								    function createMarkerHereLoc(place){
								    	drawTableListPubLocs(place)
								    	console.log(place.types);
								    	var placeLoc = place.geometry.location;
								    	var iconText = 'marker';
								    	if (in_array('hospital', place.types)) {
								    		iconText = 'benhvien';
								    	} else if (in_array('school', place.types)) {
								    		iconText = 'truonghoc';
								    	} else if (in_array('park', place.types)) {
								    		iconText = 'congvien';
								    	}
								    	var marker = new google.maps.Marker({
								    		map: mapHereLoc,
								    		position: placeLoc,
								    		icon: DIR_ROOT + 'public/default/images/marker/' + iconText + '.png'
								    	});
								    	google.maps.event.addListener(marker, 'click', function() {
								    		infoWindowHereLoc.setContent('<div style="width:250px">' + place.name + '<br><small><i class="fa fa-map-marker fa-fw"></i>' + place.vicinity+ '</small></div>');
								    		infoWindowHereLoc.open(mapHereLoc, this);
								    	});
								    }
								    function callbackHereLoc(results, status) {
								    	if (status == google.maps.places.PlacesServiceStatus.OK) {
								    		var total = results.length;
								    		for (var i = 0; i < total; i++) {
								    			createMarkerHereLoc(results[i]);
								    		}
								    		if (total > 0){
								    			mapHereLoc.panTo(results[total-1].geometry.location);
								    		}
								    	}
								    }
								    function drawTableListPubLocs(results) {
								    	//console.log(results);
								    	var placeBegin = new google.maps.LatLng(document.getElementById('lat').value,document.getElementById('lng').value);
										var obj = {'hospital': [], 'school': [], 'university': [], 'park': [], 'bank': [], 'atm': [], 'bus_station': [], 'grocery_or_supermarket': [], 'gym':[], 'cafe':[], 'spa':[]};
										var objTitle = {'hospital': 'Bệnh viện', 'school': 'Trường học', 'university': 'Trường học', 'park': 'Công viên', 'bank': 'Ngân hàng, cây ATM', 'bus_station': 'Bến xe Buýt', 'grocery_or_supermarket': 'Siêu thị', 'gym': 'GYM', 'cafe': 'Cafe', 'spa': 'Spa'};
										var total = results.length, placeLoc, place;
								    }
								</script>
								<?php } ?>
							</div>
						</div>
                        <div class="more-view mt10">
							<span>Có thể bạn muốn xem </span>: <a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'-tp'.toPublicId($realestate->province_id); ?>.htm" title="<?= $category->title.' tại '.$realestate->p_name; ?>"><?= $category->title.' tại '.$realestate->p_name; ?></a>
						</div>
                        <div class="share p0 noborder">
                            <a id="saveNews" rel="nofollow" onclick="productSaved(this,'<?= $realestate->id?>');" class="save">Lưu tin</a>
                        </div>
						<div class="margin-item row clearfix text-left">
							<div class="col-sm-6">
								<h2 class="title i-info"><span>Đặc điểm bất động sản</span></h2>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td class="name"><span>Mã tin</span></td>
											<td class="text"><?=toPublicId($realestate->id) ?></td>
										</tr>
										<tr>
											<td class="name">Loại tin</td>
											<td class="text"><a rel="dofollow" href="<?= $domain.$realestate->slug_cate;?>"><?= $realestate->title_cate; ?></a></td>
										</tr>
										<tr>
											<td class="name">Ngày đăng tin</td>
											<td><?= date('d/m/Y',strtotime($realestate->start_date));?></td>
										</tr>
										<tr>
											<td class="name">Ngày hết hạn</td>
											<td><?= date('d/m/Y',strtotime($realestate->end_date));?></td>
										</tr>
										<?php if ($realestate->home_direction > 0) { ?>
											<tr>
												<td class="name">Hướng nhà</td>
												<td><?= showDirections($realestate->home_direction); ?></td>
											</tr>
										<?php }
										if ($realestate->bacon_direction > 0) { ?>
											<tr>
												<td class="name">Hướng ban công :</td>
												<td><?= showDirections($realestate->bacon_direction); ?></td>
											</tr>
											<?php
										}
										if ($realestate->width > 0) {
											?>
											<tr>
												<td class="name">Ngang</td>
												<td class="text"><?= $realestate->width;?></td>
											</tr>
											<?php
										}
                                        if ($realestate->width > 0) {
											?>
											<tr>
												<td class="name">Dài</td>
												<td class="text"><?= $realestate->land_width;?></td>
											</tr>
											<?php
										}
										if ($realestate->floor_number > 0) {
											?>
											<tr>
												<td class="name">Số tầng</td>
												<td class="text"><?= $realestate->floor_number; ?></td>
											</tr>
											<?php
										}
										if ($realestate->room_number > 0){
											?>
											<tr>
												<td class="name">Số phòng</td>
												<td class="text"><?= $realestate->room_number;?></td>
											</tr>
											<?php
										}
										if ($realestate->toilet_number > 0){
											?>
											<tr>
												<td class="name">Số toilet</td>
												<td class="text"><?= $realestate->toilet_number;?></td>
											</tr>
											<?php
										}
										if (!empty($realestate->interior)){ ?>
											<tr>
												<td class="name">Nội thất</td>
												<td class="text"><?= $realestate->interior;?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="col-sm-6 nopadding-lft">
								<h2 class="title i-contact"><span>liên hệ</span></h2>
								<table class="table table-hover">
									<tbody>
										<tr>
											<td class="name">Họ tên</td>
											<td class="text"><?= $realestate->display_name; ?></td>
										</tr>
										<?php if (!empty($realestate->address)) { ?>
										<tr>
											<td class="name">Địa chỉ</td>
											<td class="text"><?= $realestate->address; ?></td>
										</tr>
										<?php } ?>
										<tr>
											<td class="name">Di động</td>
											<td class="text"><?= $realestate->mobile; ?></td>
										</tr>
										<tr>
											<td class="name">Email</td>
											<td class="text"><a href="mailto:<?= $realestate->email; ?>"><?= $realestate->email; ?></a></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
                        <blockquote>
                            <h4 style="font-size: 13px; font-weight: bold;margin:0px;padding:0;">Lưu ý</h4>
                            <p>Quý vị đang xem nội dung tin rao " <a style="color:#D33320;" rel="dofollow" href="<?= $domain.$realestate->slug_cate.'/'.$realestate->title_alias.'-'.toPublicId($realestate->id);?>"><?= $realestate->title; ?></a> ". Mọi thông tin liên quan tới tin rao này là do người đăng tin đăng tải và chịu trách nhiệm. Chúng tôi luôn cố gắng để có chất lượng thông tin tốt nhất, nhưng chúng tôi không đảm bảo và không chịu trách nhiệm về bất kỳ nội dung nào liên quan tới tin rao này. Nếu quý vị phát hiện có sai sót hay vấn đề gì xin hãy thông báo cho chúng tôi.</p>
                        </blockquote>
					</div>
				</div>
                <?php
				if (!empty($sames)) {
					$jump = count($sames);
				?>
				<div class="block-big">
					<div class="col-xs-12">
						<h1 class="title bar"><span>Tin rao cùng khu vực</span></h1>
					</div>
				<?php
					for($i=0; $i<$jump; $i+=2) { 
				?>
				<div class="row">
                    <div class="other-new">
    					<div class="col-xs-12">
    						<?php
    						for($j=$i; $j<($i+2); $j++)
    						{
    							if(empty($sames[$j])) continue;
    						?>
    						<article class="col-xs-6 col-sm-6 product p5">
    							<div class="item">
    								<h3 class="other-title mb5">
    									<a href="<?= $domain.$sames[$j]->slug_cate.'/'.$sames[$j]->title_alias.'-'.$sames[$j]->id; ?>" title="<?= $sames[$j]->title; ?>"><?= stripString($sames[$j]->title,70,'.'); ?></a>
    								</h3>
    								<figure class="col-xs-4 col-md-4 product-img other-img" style="margin-top: 5px;">
    									<a href="<?= $domain.$sames[$j]->slug_cate.'/'.$sames[$j]->title_alias.'-'.$sames[$j]->id; ?>" title="<?= $sames[$j]->title; ?>">
    										<img src="<?= $domain.'/resizer/timthumb.php?src=uploads/properties/'.getThumbnail($sames[$j]->id,'thumb_'); ?>" alt="<?= $sames[$j]->title; ?>" class="img-responsive" />
    									</a>
    								</figure>
    								<div class="description other col-md-8">
    									<div class="cusInfo">
    										<label class="pull-left with40">Giá </label>:
    										<span class="price">
    											<?php
    											if($sames[$j]->price > 0 && $sames[$j]->price_type !=0){
    												echo '&nbsp;'.$sames[$j]->price. ' '.showUnit($sames[$j]->price_type);
    											}else{
    												echo ':&nbsp;Thỏa thuận';
    											}
    											?>
    										</span>
    									</div>
    									<div class="cusInfo">
    										<label class="pull-left with40">DT</label>
    										<?= ($sames[$j]->area != 0) ? '<span class="size13">:&nbsp;'.$sames[$j]->area.' m<sup>2</sup></span>' : '<span class="small">:&nbsp;KXĐ</span>'; ?>
    									</div>
    									<div class="cusInfo location">
    										<label class="pull-left with40">Vị trí</label> 
    										<span>:&nbsp;<a href="<?= $domain.$sames[$j]->slug_cate.'/'.$sames[$j]->slug_p.'/'.$sames[$j]->slug_d; ?>.htm" title="<?= $sames[$j]->title_cate.' '.$sames[$j]->d_name; ?>"><?= $sames[$j]->d_name; ?></a>-<a href="<?= $domain.$sames[$j]->slug_cate.'/'.$sames[$j]->slug_p.'-tp'.toPublicId($sames[$j]->province_id); ?>.htm" title="<?= $sames[$j]->title_cate.' '.$sames[$j]->p_name; ?>"><?= $sames[$j]->p_name; ?></a>
    										</span>
    									</div>
    								</div>
    							</div>
    						</article>
    						<?php
                            }
    						?>
    					</div>
                    </div>
				</div>
				<?php
					}
				?>
                    <div class="col-xs-12">
    				    <div class="external-link text-center">
                            <a href="<?= $domain.$realestate->slug_cate.'/'.$realestate->slug_p.'/'.$realestate->slug_d.'.htm'; ?>" title="<?= $realestate->title_cate.' tại '. $realestate->d_name; ?>"><i class="fa fa-hand-o-right fa-fw"></i> Xem tất cả tin cùng khu vực</a>
    				    </div>
				    </div>
				</div>
				<?php
				}
				?>
				<!-- Detail Realestate-->
			</div>
			<!-- Slidbar -->
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="slidebar">
                    <?php if (isset($hasParentCates) && !empty($hasParentCates)) { ?>
                    <div class="box">
                    	<h2 class="title bar"><span>Xem thêm danh mục</span></h2>
                    	<div class="box-content">
                    		<ul class="most-read">
                    			<?php
                    			foreach ($hasParentCates as $hasParentCate) {
                    				?>
                    				<li>
                    					<i class="fa fa-caret-right"></i>
                    					<h4>
                    						<a href='<?= $domain.$hasParentCate->title_alias ?>' title='<?= $hasParentCate->title; ?>'><?= $hasParentCate->title; ?></a>
                    					</h4>
                    				</li>
                    				<?php
                    			}
                    			?>
                    		</ul>
                    	</div>
                    </div>
                    <?php } ?>
                    <?php
						if ($realestate->project_id > 0) {
							if (!empty($projects)) {
								?>
								<div class="box">
									<h3 class="title bar"><span><?= $realestate->title_cate.' tại '. $realestate->p_name; ?></span></h3>
									<div class="box-content">
                                        <ul class="most-read">
										<?php
										foreach ($Rprojects as $prj) {
											?>
											
												<?php
												$countRowTable = countRowTable('realestates',array('project_id'=>$prj->project_id,'category_id' => $realestate->category_id));
												if ($countRowTable > 0) {
												?>
												<li>
													<i class="fa fa-caret-right"></i>
													<h4><a href='' title=''><?= $prj->project_name .' <span class="countR">('.$countRowTable.')</span>'; ?></a></h4>
												</li>
												<?php
												}
												?>
											
											<?php
										}
										?>
                                        </ul>
									</div>
								</div>
								<?php
							}
						}
						?>
					<!-- End Box -->
					<?php if (isset($districts) && !empty($districts)) { ?>
					<div class="box">
						<h2 class="title bar"><span><?= $realestate->title_cate.' tại '. $realestate->p_name; ?></span></h2>
						<div class="box-content">
							<ul class="most-read">
								<?php
								foreach ($districts as $district) {
									$countRowTable = countTable('realestates',array('district_id'=>$district->district_id,'category_id'=>$category->id));
									if($countRowTable > 0){
										?>
										<li>
											<i class="fa fa-caret-right"></i>
											<h4><a href='<?= $domain.$realestate->slug_cate.'/'. $realestate->slug_p.'/'.$district->slug_name;?>.htm' title='<?= $realestate->title_cate.' tại '. $district->pre. ' ' .$district->name; ?>'><?= $district->name . ' <span class="countR">('.$countRowTable.')</span>'; ?>
											</a></h4>
										</li>
										<?php
									}
								}
								?>
							</ul>
						</div>
					</div>
					<?php } ?>
                    <?= $this->load->widget('external_links'); ?>
                    <?php $this->load->view('default/advertings/bar');?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End homepage -->