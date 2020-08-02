<div class="page-header">
    <div class="page-title text-info text-semibold">
        <h3><span data-icon="&#xe312;"></span> BÀI VIẾT</h3>
    </div>
</div>
<!-- /Page header -->
<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
        <li class="active">Bài viết</li>
    </ul>
</div>
<!-- /Breadcrumbs line -->
<!-- Callout -->
<div id="message">
    <?php 
    if ($this->session->flashdata('success')) {
        ?>
        <div class="callout callout-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h5>Hoàn tất nghiệp vụ</h5>
            <p><?= $this->session->flashdata('success'); ?></p>
        </div>
        <?php   
    }
    ?>
</div>
<script type="text/javascript" src="<?= $root_site.'public/'.$modules; ?>/js/admin.articles.js"></script>
<!-- Table -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h6 class="panel-title"><i class="fa fa-windows"></i> Bài viết đang có</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered dataTable" id="articles" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?> data-table="articles">
            <thead>
                <tr>
                    <th style="width: 45px;"><input type="checkbox" id="checkall" /></th>
                    <th class="image-column text-center">Image</th>
                    <th>Tiêu đề</th>
                    <th style="width: 115px;" class="text-center">Nhóm bài viết</th>
                    <th style="width:60px;" class="text-center"><i class="fa fa-check"></i></th>
                    <th style="width: 115px;" class="text-center">Cập nhật bởi</th>
                    <th style="width: 115px;" class="text-center">Cập nhật lúc</th>
                    <th style="width: 115px;" class="text-center">Nghiệp vụ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article){ ?>
                <tr index="<?= $article->id; ?>" <?= $this->security->get_csrf_token_name(); ?>=<?= $this->security->get_csrf_hash(); ?>>
                    <td><input type="checkbox" class="checkthis" value="<?= $article->id; ?>" /></td>
                    <td class="text-center">
                        <?php if (!empty($article->image)) { ?>
                        <a href="<?=$root_site.'uploads/articles/'.$article->image ?>" class="lightbox">
                            <img src="<?=$root_site.'uploads/articles/'.$article->image ?>" alt="" class='img-media' />
                        </a>
                        <?php }else{ ?>

                        <?php } ?>
                    </td>
                    <td><?= $article->title; ?></td>
                    <td class="text-center"><?= $article->title_cate; ?></td>
                    <td class="text-center">
                        <?php 
                        if ($article->public == 1) {
                            echo '<i class="fa fa-check text-success"></i>';
                        }else{
                            echo '<i class="fa fa-ban text-danger"></i>';
                        }
                        ?>
                    </td>
                    <td class="text-center"><?= $article->display_name; ?></td>
                    <td class="text-center"><?= date('m-d-Y',strtotime($article->updated_at)).'<hr>'.date('H:i:s',strtotime($article->updated_at)); ?></td>
                    <td class="text-center">
                        <div class="table-controls">
                            <a href="<?= $root_site.$modules; ?>/articles/destroy/<?= $article->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Xóa" onclick="return confirm('Bạn muốn xóa bài viết có ID <?= $article->id; ?> ?');">
                                <i class="icon-remove"></i>
                            </a> 
                            <a href="<?= $root_site.$modules; ?>/articles/update/<?= $article->id; ?>" class="btn btn-link btn-icon btn-xs tip" title="Sửa"><i class="icon-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /Table -->