<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Postting extends DefaultController
{
    protected $user_id;
    protected $total_point;

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $this->load->helper('unicode');
        $this->load->model(['default/membership_model', 'mprovinces', 'mrealestate_directions', 'default/realestate_model', 'mrealestate_gallerys', 'mrealestate_type']);
        $this->user_id = $this->session->userdata('user_id');
        $dataPointUser = $this->membership_model->pointUser($this->user_id);
        $this->total_point = $dataPointUser->points;
    }

    public function check_select($element, $label = '')
    {
        if ($element == '-1') {
            $this->form_validation->set_message('check_select', 'Chọn ' . $label);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function create()
    {
        $this->checkPoint();
        $img = TRUE;
        $this->_data['meta_title'] = SITENAME;
        $this->_data['meta_description'] = SITE_DESCRIPTION;
        $this->_data['meta_keywords'] = SITE_KEYWORDS;
        $this->_data['meta_image'] = LOGOSITE;
        $this->_data['temp'] = 'postting/create';
        //provinces
        $this->_data['provinces'] = $this->mprovinces->allProvinces();
        $this->_data['directions'] = $this->mrealestate_directions->getDrirection();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_rules('txtProductTitle', 'tiêu đề!', 'trim|required');
        $this->form_validation->set_rules('txtAddress', 'địa chỉ!', 'trim|required');
        $this->form_validation->set_rules('txtProductContent', 'nội dung', 'trim|required|min_length[30]');
        $this->form_validation->set_rules('sltProductType', '', 'callback_check_select[ hình thức !]');
        $this->form_validation->set_rules('sltProductCate', '', 'callback_check_select[ danh mục !]');
        $this->form_validation->set_rules('sltCity', '', 'callback_check_select[ tỉnh/thành phố !]');
        $this->form_validation->set_rules('sltDistrict', '', 'callback_check_select[ quận/huyện !]');
        if ($this->form_validation->run() == TRUE) {
            $vip_type = $this->input->post('sltVipType');
            $realestate = [
                'vip_type' => $vip_type,
                'start_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('txtStartDate')))),
                'end_date' => date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('txtEndDate')))),
                'title' => $this->input->post('txtProductTitle'),
                'title_alias' => make_unicode($this->input->post('txtProductTitle')),
                'content' => $this->input->post('txtProductContent'),
                'type_id' => $this->input->post('sltProductType'),
                'category_id' => $this->input->post('sltProductCate'),
                'province_id' => $this->input->post('sltCity'),
                'district_id' => $this->input->post('sltDistrict'),
                'ward_id' => $this->input->post('sltWard'),
                'street_id' => $this->input->post('sltStreet'),
                'project_id' => $this->input->post('sltProject'),
                'address' => $this->input->post('txtAddress'),
                'area' => $this->input->post('txtArea'),
                'price' => $this->input->post('txtPrice'),
                'price_type' => $this->input->post('sltPriceType'),
                'width' => $this->input->post('txtWidth'),
                'land_width' => $this->input->post('txtLandWidth'),
                'home_direction' => $this->input->post('sltHomeDirection'),
                'floor_number' => $this->input->post('txtFloorNumbers'),
                'bacon_direction' => $this->input->post('sltBaconDirection'),
                'room_number' => $this->input->post('txtRoomNumber'),
                'toilet_number' => $this->input->post('txtToiletNumber'),
                'interior' => $this->input->post('txtInterior'),
                'approval' => 1,
                'params' => json_encode(
                    array(
                        'meta_title' => $this->input->post('txtProductTitle'),
                        'meta_description' => stripString($this->input->post('txtProductContent'), 170),
                        'meta_keywords' => unicode2($this->input->post('txtProductTitle'))
                    )
                ),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->user_id,
                'updated_by' => $this->user_id
            ];
            $getPointType = $this->mrealestate_type->getPointType($vip_type);
            if (empty($getPointType)) {
                $this->session->set_flashdata('error', 'Đã có lỗi xảy ra vui lòng thử lại !');
                redirect(base_url() . 'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm');
            } else {
                // Nếu tổng số điểm lớn hơn số điểm point
                if ($this->total_point > $getPointType->type_point) {
                    $this->membership_model->update(
                        array(
                            'points' => $this->total_point - $getPointType->type_point
                        ),
                        array('id' => $this->user_id)
                    );
                } else {
                    $this->session->set_flashdata('error', 'Không đủ điểm đăng tin <strong>' . $getPointType->type_name . '</strong>');
                    redirect(base_url() . 'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm');
                }
            }
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($this->input->post('txtAddress')) . '&sensor=true';
            $json = @file_get_contents($url);
            $position = json_decode($json);
            if ($position && $position->status == "OK") {
                $realestate['lat'] = $position->results[0]->geometry->location->lat;
                $realestate['lng'] = $position->results[0]->geometry->location->lng;
                $location = TRUE;
            } else {
                $this->_data['error'] = 'Chúng tôi không tìm thấy địa chỉ này. Vui lòng nhập đúng địa chỉ';
                $realestate['lat'] = NULL;
                $realestate['lng'] = NULL;
                $location = TRUE;
            }
            if ($location == TRUE) {
                $realestateID = $this->realestate_model->insert($realestate);
                $this->session->set_flashdata('success', 'Đăng tin thành công');
                $this->load->library('upload');
                $files = $_FILES;
                $cpt = count($files);
                for ($i = 1; $i <= $cpt; $i++) {
                    if ($_FILES['img' . $i]['name'] != "") {
                        $this->upload->initialize($this->set_upload_options(convert_file_to_date($_FILES['img' . $i]['name'], make_unicode($this->input->post('txtProductTitle')))));
                        if (!$this->upload->do_upload('img' . $i)) {
                            $this->session->set_flashdata('errors', $this->upload->display_errors());
                            redirect(base_url() . $this->uri->uri_tring());
                        } else {
                            $image = $this->upload->data();
                            $this->_resize($image['file_name']);
                            $gallerys = [
                                'title' => $this->input->post('txtProductTitle'),
                                'image' => $image['file_name'],
                                'realestate_id' => $realestateID,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'created_by' => $this->user_id,
                                'updated_by' => $this->user_id
                            ];
                            $this->mrealestate_gallerys->insert($gallerys);
                        }
                    }
                }
            }
            redirect(base_url() . 'thanh-vien/quan-ly-tin-rao.htm');
        }
        $this->load->view($this->_data['modules'] . '/template', $this->_data);
    }

    /**
     * SỬA TIn
     */
    public function update($id)
    {
        $this->checkPoint();
        if (!is_numeric($id) || !isset($id)) {
            $this->session->set_flashdata('error', 'Đã có lỗi xảy ra');
            redirect(base_url() . 'thanh-vien/quan-ly-tin-rao.htm');
        }
        $infoR = $this->realestate_model->getRealestateEdit(toInternalId($id));
        if (empty($infoR)) {
            $this->session->set_flashdata('error', 'Không tồn tại tin rao');
            redirect(base_url() . 'thanh-vien/quan-ly-tin-rao.htm');
        }
        // Tranform data
        $this->_data['real'] = $infoR;
        $this->_data['provinces'] = $this->mprovinces->allProvinces();
        $this->_data['directions'] = $this->mrealestate_directions->getDrirection();
        $this->_data['meta_title'] = SITENAME;
        $this->_data['meta_description'] = SITE_DESCRIPTION;
        $this->_data['meta_keywords'] = SITE_KEYWORDS;
        $this->_data['meta_image'] = LOGOSITE;
        $this->_data['temp'] = 'postting/update';
        // Get gallerys
        $this->_data['gallerys'] = $this->mrealestate_gallerys->getRealestateGallerys(toInternalId($id));
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $this->form_validation->set_rules('txtProductTitle', 'tiêu đề!', 'trim|required');
        $this->form_validation->set_rules('txtAddress', 'địa chỉ!', 'trim|required');
        $this->form_validation->set_rules('txtProductContent', 'nội dung', 'trim|required|min_length[30]');
        $this->form_validation->set_rules('sltProductType', '', 'callback_check_select[ hình thức !]');
        $this->form_validation->set_rules('sltProductCate', '', 'callback_check_select[ danh mục !]');
        $this->form_validation->set_rules('sltCity', '', 'callback_check_select[ tỉnh/thành phố !]');
        $this->form_validation->set_rules('sltDistrict', '', 'callback_check_select[ quận/huyện !]');
        if ($this->form_validation->run() == TRUE) {
            $vip_type = $this->input->post('sltVipType');
            $realestate = [
                'vip_type' => $vip_type,
                'title' => $this->input->post('txtProductTitle'),
                'title_alias' => make_unicode($this->input->post('txtProductTitle')),
                'content' => $this->input->post('txtProductContent'),
                'type_id' => $this->input->post('sltProductType'),
                'category_id' => $this->input->post('sltProductCate'),
                'province_id' => $this->input->post('sltCity'),
                'district_id' => $this->input->post('sltDistrict'),
                'ward_id' => $this->input->post('sltWard'),
                'street_id' => $this->input->post('sltStreet'),
                'project_id' => $this->input->post('sltProject'),
                'address' => $this->input->post('txtAddress'),
                'area' => $this->input->post('txtArea'),
                'price' => $this->input->post('txtPrice'),
                'price_type' => $this->input->post('sltPriceType'),
                'width' => $this->input->post('txtWidth'),
                'land_width' => $this->input->post('txtLandWidth'),
                'home_direction' => $this->input->post('sltHomeDirection'),
                'floor_number' => $this->input->post('txtFloorNumbers'),
                'bacon_direction' => $this->input->post('sltBaconDirection'),
                'room_number' => $this->input->post('txtRoomNumber'),
                'toilet_number' => $this->input->post('txtToiletNumber'),
                'interior' => $this->input->post('txtInterior'),
                'params' => json_encode(
                    array(
                        'meta_title' => $this->input->post('txtProductTitle'),
                        'meta_description' => stripString($this->input->post('txtProductContent'), 170),
                        'meta_keywords' => unicode2($this->input->post('txtProductTitle'))
                    )
                ),
                'updated_by' => $this->user_id
            ];
            $getPointType = $this->mrealestate_type->getPointType($vip_type);
            if (empty($getPointType)) {
                $this->session->set_flashdata('error', 'Đã có lỗi xảy ra vui lòng thử lại !');
                redirect(base_url() . 'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm');
            }
            // Nếu không thay đổi loại tin
            if ($vip_type != $infoR->vip_type) {
                // Nếu tổng số điểm lớn hơn số điểm point
                if ($this->total_point > $getPointType->type_point) {
                    $this->membership_model->update(
                        array(
                            'points' => $this->total_point - $getPointType->type_point
                        ),
                        array('id' => $this->user_id)
                    );
                } else {
                    $this->session->set_flashdata('error', 'Không đủ điểm đăng tin <strong>' . $getPointType->type_name . '</strong>');
                    redirect(base_url() . 'thanh-vien/dang-tin-ban-cho-thue-nha-dat.htm');
                }
            }
            $url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($this->input->post('txtAddress')) . '&sensor=true';
            $json = @file_get_contents($url);
            $position = json_decode($json);
            if ($position && $position->status == "OK") {
                $realestate['lat'] = $position->results[0]->geometry->location->lat;
                $realestate['lng'] = $position->results[0]->geometry->location->lng;
                $location = TRUE;
            } else {
                $this->_data['error'] = 'Chúng tôi không tìm thấy địa chỉ này. Vui lòng nhập đúng địa chỉ';
                $realestate['lat'] = NULL;
                $realestate['lng'] = NULL;
                $location = TRUE;
            }
            if ($location == TRUE) {
                $this->load->library('upload');
                $files = $_FILES;
                $cpt = count($files);
                for ($i = 1; $i <= $cpt; $i++) {
                    if ($_FILES['img' . $i]['name'] != "") {
                        $this->upload->initialize($this->set_upload_options(convert_file_to_date($_FILES['img' . $i]['name'], make_unicode($this->input->post('txtProductTitle')))));
                        if (!$this->upload->do_upload('img' . $i)) {
                            $this->session->set_flashdata('errors', $this->upload->display_errors());
                            redirect(base_url() . 'thanh-vien/dang-tin-ban-cho-thue-nha-dat-sua' . $id . '.htm');
                        } else {
                            $image = $this->upload->data();
                            $this->_resize($image['file_name']);
                            $gallerys = [
                                'title' => $this->input->post('txtProductTitle'),
                                'image' => $image['file_name'],
                                'realestate_id' => toInternalId($id),
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                                'created_by' => $this->user_id,
                                'updated_by' => $this->user_id
                            ];
                            $this->mrealestate_gallerys->insert($gallerys);
                        }
                    }
                }
                $this->realestate_model->update($realestate, ['id' => toInternalId($id)]);
                $this->session->set_flashdata('success', 'Cập nhật thông tin thành công');
            }
            redirect(base_url() . 'thanh-vien/quan-ly-tin-rao.htm');
        }
        $this->load->view($this->_data['modules'] . '/template', $this->_data);
    }

    /**
     * Destroy
     */
    public function destroy()
    {
        if ($this->input->is_ajax_request()) {
            $realestateID = $this->input->post('item');
            $this->realestate_model->delete(['id' => toInternalId($realestateID)]);
            echo json_encode(array('status' => 200));
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    /**
     * Ajax rePost
     *
     */
    public function repost()
    {
        $this->checkLogin();
        if ($this->input->is_ajax_request()) {
            $item = toInternalId(str_replace('rePost_', '', $this->input->post('item')));
            $dataUp = [
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d', strtotime('+ 1month')),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $u = $this->realestate_model->update($dataUp, ['id' => $item]);
        } else {
            redirect(base_url());
        }
    }

    private function set_upload_options($file_name)
    {
        $config = array();
        $config['upload_path'] = $this->set_path_to_upload();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '*';
        $config['max_height'] = '*';
        $config['file_name'] = $file_name;
        $config['overwrite'] = FALSE;
        return $config;
    }

    private function set_path_to_upload()
    {
        $folderYeah = date('Y');
        $folderMonth = date('m');
        $folderDay = date('d');
        $pathUpload = './uploads/properties';
        if (!is_dir($pathUpload . '/' . $folderYeah)) {
            mkdir($pathUpload . '/' . $folderYeah, 0777, TRUE);
        }
        if (!is_dir($pathUpload . '/' . $folderYeah . '/' . $folderMonth)) {
            mkdir($pathUpload . '/' . $folderYeah . '/' . $folderMonth, 0777, TRUE);
        }
        if (!is_dir($pathUpload . '/' . $folderYeah . '/' . $folderMonth . '/' . $folderDay)) {
            mkdir($pathUpload . '/' . $folderYeah . '/' . $folderMonth . '/' . $folderDay, 0777, TRUE);
        }
        if (!is_dir($pathUpload . '/' . $folderYeah . '/' . $folderMonth . '/' . $folderDay . '/thumbnails')) {
            mkdir($pathUpload . '/' . $folderYeah . '/' . $folderMonth . '/' . $folderDay . '/thumbnails', 0777, TRUE);
        }
        return $pathUpload . '/' . $folderYeah . '/' . $folderMonth . '/' . $folderDay;
    }

    // Resize
    private function _resize($file)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->set_path_to_upload() . '/' . $file;
        $config['new_image'] = $this->set_path_to_upload() . '/thumbnails/' . $file;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 185;
        $config['height'] = 130;
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        return;
    }

    // Ajax
    public function deletegallery()
    {
        if ($this->input->is_ajax_request()) {
            $created_at = $this->input->post('dataDate');
            $pathImage = './uploads/properties/' . date('Y', strtotime($created_at)) . '/' . date('m', strtotime($created_at)) . '/' . date('d', strtotime($created_at));
            $galleryID = $this->input->post('galleryId');
            $gallery = $this->mrealestate_gallerys->getGallery(toInternalId($galleryID));
            if (!empty($gallery)) {
                if (file_exists($pathImage . '/' . $gallery->image)) {
                    unlink($pathImage . '/' . $gallery->image);
                    unlink($pathImage . '/thumbnails/thumb_' . $gallery->image);
                }
                $this->mrealestate_gallerys->delete(['id' => toInternalId($galleryID)]);
                echo json_encode(
                    array('status' => 200)
                );
            } else {
                echo json_encode(
                    array('status' => 400)
                );
            }
        }
    }

    // Check Point
    protected function checkPoint()
    {
        if ($this->total_point < 10) {
            $this->session->set_flashdata('error', 'Không đủ điểm để đăng tin');
            redirect('thanh-vien/quan-ly-tin-rao.htm');
        }
    }

    // Reset Updated_at
    public function reset_updated_at()
    {
        if ($this->input->is_ajax_request()) {
            $realestate_id = toInternalId($this->input->post('realestate_id'));
            $item = $this->db->select('vip_type,updated_at')->where('id', $realestate_id)->get('realestates')->row();
            if (!empty($item)) {
                $getPointType = $this->mrealestate_type->getPointType($item->vip_type);
                // Lấy ngày giờ phút giây hiện
                $currentdate = date('Y-m-d H:i:s');
                // Đến thời gian này mới được updated_at
                $update_at = date('Y-m-d H:i:s', strtotime($item->updated_at . '+24 hours'));
                if ($currentdate > $update_at) {
                    $this->realestate_model->update(
                        ['updated_at' => date('Y-m-d H:i:s')],
                        ['id' => $realestate_id]
                    );
                    $this->membership_model->update(
                        array(
                            'points' => $this->total_point - $getPointType->type_point
                        ),
                        array('id' => $this->user_id)
                    );
                    echo json_encode(['status' => 200, 'message' => 'Up tin thành công !']);
                } else {
                    echo json_encode(['status' => 400, 'message' => 'Thao tác không thành công !']);
                }
            } else {
                echo json_encode(['status' => 400, 'message' => 'Không tồn tại rao vặt !']);
            }
        }
    }
}

/* End of file Postting.php */
/* Location: ./application/modules/default/controllers/Postting.php */