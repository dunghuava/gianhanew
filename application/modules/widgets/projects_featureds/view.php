<div class="box">
    <h3 class="title bar"><span>Dự án nổi bật</span></h3>
    <div class="new-hot">
        <?php if (isset($project_featureds) && !empty($project_featureds)) { ?>
        <div class="post-img">
            <a href="<?= $domain.$project_featureds->category_alias.'/'.$project_featureds->title_alias.'.html';?>" title="<?= $project_featureds->title; ?>">
                <img src="<?= image_thumb('uploads/projects/'.$project_featureds->image,MAX_WIDTH_PROJECT,MAX_HEIGHT_PROJECT); ?>" class="img-thumbnail img-responsive" alt="<?= $project_featureds->title; ?>" />
            </a>
        </div>
        <h3 class="<?= $project_featureds->title_alias; ?>"><a class="post-title" href="<?= $domain.$project_featureds->category_alias.'/'.$project_featureds->title_alias.'.html';?>" title="<?= $project_featureds->title; ?>"><?= stripString($project_featureds->title,90); ?></a></h3>
        <?php } ?>
        <ul class="list-new-hot">
        <?php if (isset($moreFeatureds) && !empty($moreFeatureds)) { ?>
            <?php foreach ($moreFeatureds as $moreFeatured) {?>
            <li>
                <a href="<?= $domain.$moreFeatured->category_alias.'/'.$moreFeatured->title_alias.'.html';?>" title="<?= $moreFeatured->title; ?>">
                    <figure>
                        <img alt="<?= $moreFeatured->title; ?>" src="<?= image_thumb('uploads/projects/' . $moreFeatured->image); ?>" class="img-responsive img-thumbnail" />
                    </figure>
                    <h3><?= stripString($moreFeatured->title,90,'...'); ?></h3>
                </a>
            </li>
            <?php } ?>
        <?php } ?>
        </ul>
    </div>
</div>