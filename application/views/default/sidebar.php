<div class="slidebar">
    <?= $this->load->widget('projects_featureds');?>
    <?php if (isset($hasParentCates) && !empty($hasParentCates)) { ?>
    <div class="box">
        <h3 class="title bar"><span><?= $title_hasParentCates; ?></span></h3>
        <div class="box-content">
            <ul class="most-read">
                <?php foreach ($hasParentCates as $hasParentCate) { ?>
                <li>
                    <h4><a href='<?= $domain.$hasParentCate->title_alias ?>' title='<?= $hasParentCate->
                        title; ?>'><i class="fa fa-caret-right"></i><?= $hasParentCate->title; ?></a></h4>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>
    <?php $this->load->view('default/advertings/bar');?>
    <?php if ($controller != 'home'){ ?>
       	<?php if (!empty($mostViews)) { ?>
    	<div class="box">
    		<h3 class="title bar"><span>TIN XEM NHIỀU</span></h3>
    		<div class="box-content">
    			<ul class="list-new-hot">
    				<?php foreach ($mostViews as $mostView) { ?>
                    <li>
                       <a href='<?= $domain.$mostView->slug_cate .'/'.$mostView->title_alias; ?>.html' title='<?= $mostView->title; ?>'>
                            <figure>
                                <img src="<?=image_thumb('uploads/articles/'.$mostView->image,185,150); ?>" class="img-responsive img-thumbnail" alt="<?= $mostView->title; ?>" />
                            </figure>
                            <h3><?= $mostView->title; ?></h3>
                        </a>
                    </li>
                    <?php } ?>
    			</ul>
    		</div>
    	</div>
    	<?php } ?>
	<?php } ?>
</div>
