<?php $projects = $this->mprojects->loadproduct(json_decode($block->params)); 
// echo "<pre>";
//     print_r($projects);die();
?>
<div class="row">
    <div class="col-md-12">
        <div class="block-big">
            <div class="section-header text-left">
                <div class="header-line">
                    <h2 class="h2_label">
                    <?php foreach ($projects as $key => $value) {
                        if ($key == 0) {  
                    ?>
                        <a href="<?= $domain.$value->category_alias; ?>">
                            <i class="fa fa-building-o color_icon fa-fw"></i> <?= $block->title; ?>
                        </a>
                    <?php } } ?>
                    </h2>
                    <?php if (isset(json_decode($block->params)->description)) { ?>
                    <h4 class="h4_label hidden-xs hidden-sm"> <?= json_decode($block->params)->description ?></h4>
                    <?php } ?>
                </div>
            </div>
            
            <?php if(!empty($projects)){ ?>
            <div class="clearfix"></div>
            <?php foreach ($projects as $key => $project) { ?>
            <article class="mb_25 col-md-4 col-sm-6 col-xs-12 text-center block-project">
                <div class="block-project-img">
                    <a title="<?= $project->title ?>" href="<?= $domain.$project->category_alias.'/'.$project->title_alias; ?>.html">
                        <img src="<?= image_thumb('uploads/projects/'.$project->image,MAX_WIDTH_PROJECT,MAX_HEIGHT_PROJECT) ?>" class="lazy img-responsive" alt="<?= $project->title ?>" />
                    </a>
                </div>
                <h3 class="h3-title">
                    <a title="<?= $project->title; ?>" href="<?= $domain.$project->category_alias.'/'.$project->title_alias; ?>.html"><?= $project->title; ?></a>
                </h3>
                <p class="text-justify"><?= stripString($project->summary,180,' [...]'); ?></p>
            </article>

            <?php } ?>
                <div class="col-xs02 mt5 text-center wow flash" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="1s" style="display:inline-block;width:100%;">
                <?php
                foreach ($projects as $key2 => $value2) {
                    if ($key2 ==0) {
                        $links = array(
                            array('url' => base_url().$value2->category_alias, 'name'=>''),
                        );
                        $num = array_rand($links);
                        $item = $links[$num];
                        printf('<a class="moreview" rel="dofollow" href="%s" title="%s">%s</a>', $item['url'],$item['name'],'Xem tất cả');
                    }
                }
                ?>
            </div>
            <?php } ?>

        </div>
    </div>
</div>