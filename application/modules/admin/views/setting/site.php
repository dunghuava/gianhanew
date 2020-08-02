<!-- Page header -->
<div class="page-header">
      <div class="page-title text-info text-semibold">
        <h3>
            <span data-icon="&#xe312;"></span> 
            Cấu hình hệ thống<small>Cấu hình chung cho toàn hệ thống website</small>
        </h3>
    </div>
</div>
<!-- /Page header -->

<!-- Breadcrumbs line -->
<div class="breadcrumb-line">
  <ul class="breadcrumb">
    <li><a href="<?= $root_site.$modules; ?>">Admin Panel</a></li>
    <li class="active">Cấu hình hệ thống</li>
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
<form action="<?= $root_site.$this->uri->uri_string(); ?>" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
    <div class="row">
        <div class="col-xs-12">
            <!-- Panel group -->
            <div class="panel-group block-inner" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title panel-trigger active">
                            <a data-toggle="collapse" data-parent="#accordion" href="#site-info"><i class="icon-cogs"></i> Cấu hình site</a>
                        </h6>
                    </div>
                    <div id="site-info" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[domain_name]">Domain Name:</label>
                                        <input class="form-control" name="value[domain_name]" value="<?= $setting->domain_name ?>" id="" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Tên website:</label>
                                        <input class="form-control" name="value[sitename]" value="<?= $setting->sitename ?>" id="" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[show_title]">Hiển thị tên Website</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" name="value[show_title]" <?= $setting->show_title == 1 ? 'checked' : ''; ?> value="1" type="radio"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" <?= $setting->show_title == 0 ? 'checked' : ''; ?> name="value[show_title]" value="0" type="radio"> Không
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[sitename]">Logo:</label>
                                        <input class="form-control" name="value[logo]" value="<?= $setting->logo; ?>" id="files" onclick="openKCFinder(this)" type="text" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="thumnails">
                                            <img src="<?= $setting->logo; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function openKCFinder(input) {
                                    window.KCFinder = {
                                        callBackMultiple: function(files) {
                                            window.KCFinder = null;
                                            input.value = "";
                                            for (var i = 0; i < files.length; i++)
                                                input.value += files[i] + "\n";
                                        }
                                    };
                                    window.open('<?= $root_site; ?>public/admin/js/plugins/kcfinder/browse.php?type=image&dir=files/public',
                                        'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
                                        );
                                }
                            </script>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[offline]">Tạm ngừng hoạt động</label>
                                        <div class="group-inline-input">
                                            <label class="radio-inline">
                                                <input class="styled" name="value[offline]" value="1" <?php if($setting->offline == 1) echo 'checked="checked"'; ?> id="value[offline]" type="radio"> Có
                                            </label>
                                            <label class="radio-inline">
                                                <input class="styled" name="value[offline]" value="0" <?php if($setting->offline == 0) echo 'checked="checked"'; ?> id="value[offline]" type="radio"> Không
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[offline_notify]">Thông báo ngừng hoạt động:</label>
                                        <textarea name="value[offline_notify]" class="form-control" cols="" rows="5"><?= $setting->offline_notify ?></textarea>
                                        <script type="text/javascript">
                                            CKEDITOR.env.isCompatible = true;
                                            CKEDITOR.replace('value[offline_notify]', {
                                             toolbar: [
                                             { name: 'document', items: [ 'Source', '-', 'NewPage' ] },
                                             [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
                                             { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] }
                                             ]
                                         });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[info_footer]">Thông tin chân trang</label>
                                        <textarea name="value[info_footer]" class="form-control" cols="" rows="5"><?= $setting->info_footer;?></textarea>
                                        <script type="text/javascript">
                                            CKEDITOR.env.isCompatible = true;
                                            CKEDITOR.replace('value[info_footer][vietnamese]', {
                                             toolbar: [
                                             { name: 'document', items: [ 'Source', '-', 'NewPage' ] },
                                             [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
                                             { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline' ] }
                                             ]
                                         });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[timezone]">Múi giờ trên site:</label>
                                        <select name="value[timezone]" class="select-search">
                                            <?php
                                            foreach ($timezonelist as $key => $value) {
                                                ?>
                                                <optgroup label="<?= $key; ?>">
                                                    <?php
                                                    foreach ($value as $k => $item) {
                                                        ?>
                                                        <option value="<?= $k; ?>" <?php if($k==$setting->timezone) echo 'selected="selected"'; ?>><?= $item; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#seo-info"><i class="icon-tags2"></i> Cấu hình SEO</a></h6>
                    </div>
                    <div id="seo-info" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[meta_description]">Mô tả website:</label>
                                        <textarea name="value[meta_description]" class='form-control' rows="5"><?= $setting->meta_description; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[meta_keywords]">Từ khóa Seo :</label>
                                        <textarea name="value[meta_keywords]" class='form-control' rows="5"><?= $setting->meta_keywords; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[alexa_verify_id]">Alexa Verify ID</label>
                                        <textarea name="value[alexa_verify_id]" class='form-control' rows="5"><?= $setting->alexa_verify_id; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[google_site_verification]">Google Verify ID</label>
                                        <textarea name="value[google_site_verification]" class='form-control' rows="5"><?= $setting->google_site_verification; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[google_analytics]">Mã Google Analytics:</label>
                                        <textarea name="value[google_analytics]" class='form-control' rows="5"><?= $setting->google_analytics; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[google_plus]">Mạng Google Plus:</label>
                                        <input type="text" name="value[google_plus]" value="<?= $setting->google_plus; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#social-info"><i class="icon-envelop"></i> Cấu hình phân trang</a></h6>
                    </div>
                    <div id="social-info" class="panel-collapse collapse">
                        <div class="panel-body">
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[record_per_page]">Số nội dung mỗi trang:</label>
                                        <input type="text" name="value[record_per_page]" value="<?= $setting->record_per_page; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[page_per_segment]">Số trang mỗi phân đoạn:</label>
                                        <input type="text" name="value[page_per_segment]" value="<?= $setting->page_per_segment; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="##mailserver-info"><i class="icon-envelop"></i> Cấu hình máy chủ email</a></h6>
                    </div>
                    <div id="mailserver-info" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_address]">Gửi với địa chỉ::</label>
                                        <input type="text" name="value[mail_address]" value="<?= $setting->mail_address; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_name]">Gửi với tên::</label>
                                        <input type="text" name="value[mail_name]" value="<?= $setting->mail_name; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_driver]">Phương thức gửi mail:</label>
                                        <div class="group-inline-input">
                                            <select class="select-full" id="value[mail_driver]" name="value[mail_driver]">
                                                <option value="smtp" <?= ($setting->mail_driver == 'smtp') ? 'selected' :''; ?>>smtp</option>
                                                <option value="mail" <?= ($setting->mail_driver == 'mail') ? 'selected' :''; ?>>mail</option>
                                                <option value="sendmail" <?= ($setting->mail_driver == 'sendmail') ? 'selected' :''; ?>>sendmail</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_secure]">Phương thức bảo mật:</label>
                                        <select class="select-full" id="value[mail_secure]" name="value[mail_secure]">
                                            <option value="ssl" <?= ($setting->mail_driver == 'ssl') ? 'selected' :''; ?>>ssl</option>
                                            <option value="tls" <?= ($setting->mail_driver == 'tls') ? 'selected' :''; ?>>tls</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_host]">SMTP host:</label>
                                        <input type="text" name="value[mail_host]" value="<?= $setting->mail_host; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_port]">SMTP port:</label>
                                        <input type="text" name="value[mail_port]" value="<?= $setting->mail_port; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_auth_username]">SMTP username:</label>
                                        <input type="text" name="value[mail_auth_username]" value="<?= $setting->mail_auth_username; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="value[mail_auth_password]">SMTP password (chừa trống nếu không thay đổi):</label>
                                        <input type="text" name="value[mail_auth_password]" value="<?= $setting->mail_auth_password; ?>" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Panel group -->
        </div>
    </div>
    <!-- Form actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-actions">
                <a href="<?= $root_site; ?>admin/settings/reset/site" class="btn btn-danger">Khôi phục mặc định</a>
                <input type="submit" name="btnSettingUpdate" value="Cập nhật cấu hình" class="btn btn-info" />
            </div>
        </div>
    </div>
    <!-- /Form actions -->
</form>
<!-- /Form -->
