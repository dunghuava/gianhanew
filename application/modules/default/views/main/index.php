<!--homepage -->
<div id="searchs">
    <div class="container">
        <div class="row">
            <section class='filter-search'>
                <div class="col-md02">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul id="tabsearch" class="nav nav-tabs" role="tablist">
                            <li class="active">
                                <a href="#home" onclick="ChangeType(1);" aria-controls="home" role="tab" data-toggle="tab">BẤT ĐỘNG SẢN BÁN</a>
                            </li>
                            <li>
                                <a href="#tab" onclick="ChangeType(2);" aria-controls="tab" role="tab" data-toggle="tab">BẤT ĐỘNG SẢN CHO THUÊ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="wrap-form bg">
                        <form id="frmsearch" action="" method="post" accept-charset="utf8">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="line1">
                                <div class="small-item-s">
                                    <select  name="chuyenmuc" id="chuyenmuc" >
                                        <option value="0">-- Chọn loại nhà đất --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="province" id="province" >
                                        <option value="0" rel='0' slug=''>-- Tỉnh/Thành phố --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="district_id" id="district_id">
                                        <option value="0">-- Quận/huyện --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="ward_id" id="ward_id" >
                                        <option value="0">-- Phường/xã --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="street_id" id="street_id" >
                                        <option value="0">-- Đường/phố --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="direct" id="direct">
                                        <option value="0">-- Chọn hướng --</option>
                                        <option value="1">Đông</option>
                                        <option value="2">Tây</option>
                                        <option value="3">Nam</option>
                                        <option value="4">Bắc</option>
                                        <option value="5">Đông Nam</option>
                                        <option value="6">Đông Bắc</option>
                                        <option value="7">Tây Nam</option>
                                        <option value="8">Tây Bắc</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="price" id="price">
                                        <option value="0">-- Chọn mức giá --</option>
                                        <option value="1">&lt;= 1</option>
                                        <option value="2">Giá từ 1 - 3</option>
                                        <option value="3">Giá từ 3 - 5</option>
                                        <option value="4">Giá từ 5 - 10</option>
                                        <option value="5">Giá từ 10 - 40</option>
                                        <option value="6">Giá từ 40 - 70</option>
                                        <option value="7">Giá từ 70 - 100</option>
                                        <option value="8">Giá từ 100 0000</option>
                                        <option value="9">Giá từ 1000 - 3000</option>
                                        <option value="10">Giá từ 3000 - 5000</option>
                                        <option value="11">&gt;= 5000</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="area" id="area">
                                        <option value="0">-- Chọn diện tích --</option>
                                        <option value="1" >&lt;= 30 m2</option>
                                        <option value="2" >Từ 30 - 50 m2</option>
                                        <option value="3" >Từ 50 - 80 m2</option>
                                        <option value="4" >Từ 80 - 100 m2</option>
                                        <option value="5" >Từ 100 - 150 m2</option>
                                        <option value="6" >Từ 150 - 200 m2</option>
                                        <option value="7" >Từ 200 - 250 m2</option>
                                        <option value="8" >Từ 250 - 300 m2</option>
                                        <option value="9" >Từ 300 - 500 m2</option>
                                        <option value="10" >&gt;= 500 m2</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <select name="unit" id="unit">
                                        <option value="0">-- Đơn vị --</option>
                                    </select>
                                </div>
                                <div class="small-item-s">
                                    <button type="button" onclick="_Search();" class="btn btn-search pull-left" style="width:100%;" name="btnSearch"><i class="fa fa-search">&nbsp;&nbsp;&nbsp;Tìm kiếm</i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= $domain.'public/'.$modules.'/js/mainSearch.js'?>"></script>
<div id="homepage" class="section is_search">
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="block-big">
                    <div class="col-xs-12 prl10">
                        <h3 class="title bar"><span><a href="<?= base_url().'nha-dat-ban' ?>">RAO VẶT MỚI NHẤT | MUA BÁN – CHO THUÊ NHÀ ĐẤT,VĂN PHÒNG, BIỆT THỰ, CHUNG CƯ….</a></span></h3>
                    </div>
                    <div class="grid">
                        <?php if (!empty($main_realestates)) { ?>
                        <?php foreach ($main_realestates as $real) { ?>
                        <article class="col-xs-6 col-md-4 product p5">
                            <div class="item">
                                <figure class="col-xs-4 col-md-4 product-img">
                                    <a href="<?= $domain.$real->slug_cate.'/'.$real->title_alias.'-'.$real->id;?>" title="<?= $real->title; ?>">
                                        <img src="<?= $domain.'uploads/properties/'.getThumbnail($real->id,'thumb_'); ?>" alt="<?= $real->title; ?>" class="lazy img-thumbnail img-responsive" data-original="<?= $domain.'uploads/properties/'.getThumbnail($real->id,'thumb_'); ?>" />
                                    </a>
                                </figure>
                                <div class="col-xs-8 col-md-8 description">
                                    <h3><a class="<?= $real->type_class; ?>" href="<?= $domain.$real->slug_cate.'/'.$real->title_alias.'-'.$real->id;?>" title="<?= $real->title; ?>"><?= strtolower(ucfirst(stripString($real->title,5,'.'))); ?></a></h3>
                                    <div class="cusInfo">
                                        <span class='price pull-left'>Giá:
                                            <?php
                                            if($real->price > 0 && $real->price_type !=0){
                                                echo '&nbsp;&nbsp;'.$real->price. ' '.showUnit($real->price_type);
                                            }else{
                                                echo '&nbsp;&nbsp;Thỏa thuận';
                                            }
                                            ?>
                                        </span>
                                        <span class="small pull-right">DT:
                                            <strong><?= ($real->area != 0) ? ''.$real->area.' m<sup>2</sup>' : 'KXĐ'; ?></strong>
                                        </span>
                                    </div>
                                    <div class="cusInfo location">
                                        <a href="<?= $domain.$real->slug_cate.'/'.$real->slug_p.'/'.$real->slug_d; ?>.htm" title="<?= $real->title_cate.' '.$real->d_name; ?>"><span><?= $real->d_name; ?></span></a><i class="fa fa-caret-right fa-fw"></i><a href="<?= $domain.$real->slug_cate.'/'.$real->slug_p.'-tp'.toPublicId($real->province_id); ?>.htm" title="<?= $real->title_cate.' '.$real->p_name; ?>"><?= $real->p_name; ?></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php } ?>
                        <?php } ?>
                        <div class="col-xs02 mt5 text-center wow flash" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="1s" style="display:inline-block;width:100%;">
                            <?php
                            $links = array(
                                array('url' => base_url().'nha-dat-ban', 'name'=>'Nhà đất bán | Thông tin bán nhà  '),
                                array('url' => base_url().'nha-dat-cho-thue', 'name' => 'Nhà đất cho thuê | Cho thuê nhà đất   ')
                                );
                            $num = array_rand($links);
                            $item = $links[$num];
                            printf('<a class="moreview" rel="dofollow" href="%s" title="%s">%s</a>', $item['url'], $item['name'], 'Xem tất cả');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="grid">
                   
                    <?php if($this->mcontent_blocks->countBlocks('home-block-1') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('home-block-1') as $block){
                            $viewBlock = explode('BlocksComposer@', $block->action);
                            if ($block->type_id ==3) {
                                $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']),compact('block',$block));
                            }
                            
                        } ?>
                    <?php } ?>
                </div>
        <!-- BLock Content -->
                    
                <div class="grid">
                   
                    <?php if($this->mcontent_blocks->countBlocks('home-block-1') != 0) { ?>
                        <?php foreach($this->mcontent_blocks->loadBlocks('home-block-1') as $block){
                            
                            if ($block->type_id ==1) {
                                $viewBlock = explode('BlocksComposer@', $block->action);
                                $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']),compact('block',$block));
                            }
                            
                        } ?>
                    <?php } ?>
        <!-- BLock Content -->
                    
                </div>
            </div>

        </div>
        
        <div class="row">
            <!--Content  -->
            <div class="col-xs-12 col-md-8">
                <div class="block-big hidden-xs hidden-sm">
                    <!-- home_block_2 -->
                    <?php if($this->mcontent_blocks->countBlocks('home-block-4') != 0) { ?>
                    <?php foreach($this->mcontent_blocks->loadBlocks('home-block-4') as $block){
                        $viewBlock = explode('BlocksComposer@', $block->action);
                        $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                    } ?>
                    <?php } ?>
                    <!-- home_block_3 -->
                    <?php if($this->mcontent_blocks->countBlocks('home-block-5') != 0) { ?>
                    <?php foreach($this->mcontent_blocks->loadBlocks('home-block-5') as $block){
                        $viewBlock = explode('BlocksComposer@', $block->action);
                        $this->load->view($modules.'/blocks/'.strtolower(plural($viewBlock[0]).'/'.$viewBlock['1']), compact('block',$block));
                    } ?>
                    <?php } ?>
                </div>
            </div>
            <!-- /.content -->
            <!-- Sidebar -->
            <div class="col-xs02 col col-md-4">
                <?php $this->load->view($modules.'/sidebar'); ?>
            </div>
            <!-- /.sidebar -->
        </div>
        <!-- /raovat noi bat -->
    </div>
</div>
<!-- End homepage