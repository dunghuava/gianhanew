<div id="searchs">
    <div class="container">
        <div class="row">
            <section class='filter-search'>
                <div class="col-md02">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul id="tabsearch" class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#home" aria-controls="home" role="tab" data-toggle="tab">TÌM KIẾM BẤT ĐỘNG SẢN</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wrap-form bg">
                        <form id="frmsearch" action="<?=$domain.'tim-du-an' ?>" method="GET" accept-charset="utf8">
                            <div class="line1">
                                <div class="small-item-s">
                                    <input type="text" name="s" id="tukhoa" placeholder="Từ khóa tìm kiếm" value="">
                                </div>
                                <div class="small-item-s">
                                    <select name="type" id="type" >
                                        <option value="0">Chọn kiểu dự án</option>
                                        <?php if ($this->mcategory->showCategoriesParent('project')) { ?>
                                        <?php foreach ($this->mcategory->showCategoriesParent('project') as $project_cate) { ?>
                                        <option value="<?= $project_cate->id;?>"><?= $project_cate->title; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="city" id="city">
                                        <option value="0">Chọn Tỉnh/Thành phố</option>
                                        <?php if ($this->mprovinces->allProvinces()) { ?>
                                        <?php foreach ($this->mprovinces->allProvinces() as $province) { ?>
                                        <option value="<?= $province->province_id ?>"><?= $province->name ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="district" id="district">
                                        <option value="0">Chọn Quận/huyện</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <button type="submit" class="btn btn-search pull-left" style="width:100%;"><i class="fa fa-search">&nbsp;&nbsp;&nbsp;Tìm kiếm</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">
    function ShowDistrict(elment){
        $.ajax({
            url   : DIR_ROOT + 'default/ajax/ajaxShowDistricts',
            type  : 'POST',
            data  : 'provinceID='+ $("select#city").val(),
            async : true,
            dataType: 'json'
        }).done(function(data){
            if (data != null){
                $(elment).select2('val','Chọn kiểu dự án');
                $(elment).html('');
                $(elment).append('<option value="0">Quận/huyện</option>').trigger('change');
                $.each(data, function(n, t) {
                    $(elment).append('<option value="'+t.district_id+'">'+t.name+'</option>');
                });
            }
        }).fail(function() {
            console.log("Loading error.....");
        });
        return false;
    }
    $(function(){
        $("#city").change(function(event) {
            ShowDistrict($("#district"));
        });
    });
</script>
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
                                <a property="item" typeof="WebPage" href="<?= $domain.$path_alias[$i];?>" title="<?= $path[$i] ?>"><?= $path[$i];?></a>
                            </li>
    						<?php
    					}
    				}else{
    	            ?>
    	            <li class="active"><a href="<?= $domain. $this->uri->uri_string(); ?>" title="$project->title"><?= stripString($project->title,70,''); ?></a></li>
    	            <?php
    	            }
    				?>
				</ol>
				<div class="block-big content-section">
					<!-- Project Detail -->
					<div class="project-detail">
						<div class="margin-item row clearfix">
                            <div class="col-sm-12">
                                <h1 class="text-uppercase"><?= $project->title; ?></h1>
                            </div>
							<div class="col-sm-12">
								<div class="project-thumbnail">
									<img src="<?= $domain.'uploads/projects/'.$project->image; ?>" alt="<?= $project->title; ?>" class="img-thumbnail img-responsive" />
								</div>
							</div>
						</div>
						<!-- Noi dung -->
						<div class="margin-item row clearfix">
							<div class="col-xs-12">
								<h2 class="title i-info"><span>Tổng quan dự án</span></h2>
								<div class="noidung">
									<?= str_replace('Thông tin từ CafeLand:',' ',$project->content); ?>
								</div>
							</div>
						</div>
                        <div class="margin-item row clearfix">
							<div class="col-xs-12">
								<h2 class="title marker"><span>Vị trí dự án (tương đối)</span></h2>
								<div id="project_map" style="height:320px"></div>
							</div>
						</div>
                        <script src="https://maps.google.com/maps/api/js?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I"></script>
						<script type="text/javascript"> 
							var gMapLatlng = new google.maps.LatLng(<?= $project->lat; ?>,<?= $project->lng; ?>);
							var gMapOptions = {
								center: new google.maps.LatLng(<?= $project->lat; ?>,<?= $project->lng; ?>),
								zoom: 17,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};
							var map = new google.maps.Map(document.getElementById("project_map"), gMapOptions);

							var marker = new google.maps.Marker({
								position: gMapLatlng,
								map: map,
								//icon: base_url+'public/default/images/maker/marker_green.png'
							});    
							var contentString = '<?= (!empty(json_decode($project->params)->address)) ? json_decode($project->params)->address : "Đang cập nhật..."; ?>';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map,marker);
							});
							infowindow.open(map,marker);
						</script>
                        <?php if ($this->agent->is_mobile()) { ?>
                        <div class="margin-item row clearfix">
                            <div class="col-xs-12">
                                <h2 class="title marker"><span>THÔNG TIN LIÊN HỆ</span></h2>
                                <div id="project-contact">
                                    <form action="" method="POST" class="form-horizontal frmcontact" id="fProject" role="form">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="">Họ tên <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name_user" id="name_consult">
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" id="hddlike_id" name="like_id" value="<?= $domain.$this->uri->uri_string() ?>">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="">Số điện thoại <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="phone_user" id="phone_consult">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="">E-mail <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="name_email" id="email_consult">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="">Nội dung</label>
                                                    <textarea name="content" id="content_text_area_consult" class="form-control" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-3">
                                                    <button type="button" data-url="<?=$domain.'du-an/consult' ?>" data-contact='<?=$contact->id ?>' data-apartment-id="<?= $project->id ?>" name="send_contat" class="btn btn_custom btn-primary" id="send_contact_consult">
                                                    <i class="fa fa-paper-plane-o pr_10"></i> Gửi yêu cầu tư vấn
                                                </button>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div id="loading" style="display:none;">
                                                        <i class="fa fa-spinner fa-pulse fa-2x fa-fw text-success"></i>
                                                    </div>
                                                    <div id="mesg"></div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="share">
                            <span class='small'>Chia sẻ rộng rãi để tin của bạn có vị trí cao trên google</span>
                            <div class="meta-entry">
						          <div class="addthis_native_toolbox" style="margin-top:5px;"></div>
		                          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4fd48fc101e64abb" async="async"></script>
                            </div>
						</div>
                        <?php if (!empty($tags)){ ?>
    						<div class="post-meta tag">
    							<i class="fa fa-tags"></i>
    							<?php foreach ($tags as $key => $tag) { ?>
    								<a href="<?= $domain.'tag/'.$tag->tag_slug ?>"><?php echo $tag->tag_name; ?></a>		
    							<?php } ?>
    						</div>
    					<?php } ?>
					</div>
				</div>
				<!-- rao vat noi bat -->
				<div class="block-big">
					<div class="col-xs-12">
						<h3 class="title bar"><span>Dự án cùng khu vực</span></h3>
					</div>
					<?php
					if (!empty($same_categories)) {
						$jump = count($same_categories);
						for($i=0; $i<$jump; $i+=2){
							?>
							<div class="articles">
								<?php
								for($j=$i; $j<($i+2); $j++)
								{
									if(empty($same_categories[$j])) continue;
									?>
									<article class="col-sm-6 col-md-6 product">
										<div class="item">
											<figure class="product-img col-md-5">
												<a href="<?= $domain.$same_categories[$j]->category_alias.'/'.$same_categories[$j]->title_alias;?>.html" title="<?= $same_categories[$j]->title; ?>">
													<img src="<?= image_thumb('uploads/projects/'.$same_categories[$j]->image) ?>" alt="<?= $same_categories[$j]->title; ?>" class="img-thumbnail img-responsive" />
												</a>
											</figure>
											<div class="description col-md-7">
												<h3>
													<a href="<?= $domain.$same_categories[$j]->category_alias.'/'.$same_categories[$j]->title_alias;?>.html" title="<?= $same_categories[$j]->title; ?>"><?= stripString($same_categories[$j]->title,120); ?></a>
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
							<p class="text-left empty-data">Dự án đang được cập nhật...</p>
						</div>
						<?php
					}
					?>
				</div>
				<!-- /.content -->
			</div>
			<!-- Sidebar -->
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="slidebar">
                    <?php if (!$this->agent->is_mobile()) { ?>
                        <?php if ($contact = $this->mcontacts->getContact($project->contact_id)) { ?> 
                        <div id="brights">
                            <div class="box" style="padding-top:15px;">
                                <div class="box-content inline-block text-center">
                                    <h3 class="col-md-12 point-fix point-fix-ex h3_relative text-uppercase">Thông tin <span class="color_red">liên hệ</span></h3>
                                    <div class="col-md-12 text-center">
                                        <?php if (!empty($contact->image)) { ?>
                                        <img width="120" class="img-circle" alt="Hình ảnh" src="<?= $domain.'uploads/contacts/'.$contact->image ?>">
                                        <?php }else{ ?>
                                        <img width="120" class="img-circle" alt="Hình ảnh" src="http://skyreal.com.vn/static/images/contact.jpg">
                                        <?php } ?>
                                        <p class="wap_info_agent" style="margin-bottom:15px;">
                                            <b><?= $contact->title ?></b><br>
                                            <span class="info_agent info_agent_phone"><i class="fa fa-phone color_red"></i>:<?= !empty(json_decode($contact->params)->phone) ? json_decode($contact->params)->phone : '' ?></span><br>
                                            <span class="info_agent"><i class="fa fa-envelope color_red"></i>: <?= $contact->email ?></span>
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <form id="fProject">
                                            <input type="hidden" name="project_id" id="hdd_project_id" value="<?= $project->id ?>" />
                                            <input type="hidden" name="project_link" id="hdd_project_link" value="<?= $domain.$this->uri->uri_string() ?>" />
                                            <div class="form-group">
                                                <input placeholder="Họ và tên" class="form-control" id="name_consult" type="text" name="name_user">
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Số điện thoại" id="phone_consult" class="form-control" type="text" name="phone_user">
                                            </div>
                                            <div class="form-group">
                                                <input placeholder="Địa chỉ email" id="email_consult" class="form-control" type="text" name="email_user">
                                            </div>
                                            <div class="form-group">
                                                <textarea placeholder="Nội dung liên hệ" id="content_text_area_consult" class="form-control" rows="3"></textarea>
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="button" data-url="<?=$domain.'du-an/consult' ?>" data-contact='<?=$contact->id ?>' data-apartment-id="<?= $project->id ?>" name="send_contat" class="btn btn_custom btn-primary" id="send_contact_consult">
                                                    <i class="fa fa-paper-plane-o pr_10"></i> Gửi yêu cầu tư vấn
                                                </button>
                                            </div>
                                            <div id="msg" style="margin-bottom:15px;"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End homepage -->