<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Bài viết<span class="mandatory">*</span>:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[article_id]">
            <?php 
            if (!empty($articles)) {
                foreach ($articles as $article) {
            ?>
            <option value="<?= $article->id; ?>">|-- <?= $article->title; ?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="title" class="col-sm-2 control-label text-right">Kiểu hiện thị<span class="mandatory">*</span>:</label>
    <div class="col-sm-10">
        <select class="select-search" name="params[template]">
            <option value="popup">Popup</option>
            <option value="redirect">Chuyển sang xem chi tiết</option>
        </select>
    </div>
</div>