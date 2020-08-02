<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Projects extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        @session_start();
        $this->load->helper(['menu', 'unicode']);
        $this->load->model(array('mcategory', 'mprojects', 'mprovinces', 'mcontacts'));
        $user = $this->session->userdata('username');
        $kcfinderSession = array(
            'disabled' => false,
            'uploadURL' => base_url() . "uploads/$user",
            'uploadDir' => ""
        );
        $_SESSION['KCFINDER'] = $kcfinderSession;
    }

    public function index()
    {
        $this->_data['title'] = 'Dự án';
        $this->_data['projects'] = $this->mprojects->getProjects($this->_data['level'], $this->_data['user_id']);
        $this->_data['temp'] = 'projects/index';
        $this->load->view($this->_data['modules'] . '/dashboard', $this->_data);
    }

    /**create
     *
     */
    public function create()
    {
        $img = TRUE;
        $this->_data['title'] = 'Thêm dự án';
        $this->_data['temp'] = 'projects/create';
        // Validate Field
        $this->_data['category'] = $this->mcategory->get_all_categories('project');
        $this->_data['provinces'] = $this->mprovinces->allProvinces();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $rule = $this->mprojects->rules;
        $this->form_validation->set_rules($rule['insert']);
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_rules('image', 'ảnh minh họa', 'required');
        }
        if ($this->form_validation->run() == TRUE) {
            $params = $this->input->post('params');
            $data = array(
                'title' => $this->input->post('title'),
                'title_alias' => make_unicode($this->input->post('title_alias')),
                'params' => json_encode($params, JSON_UNESCAPED_UNICODE),
                'summary' => $this->input->post('summary'),
                'content' => $this->input->post('content'),
                'category_id' => $this->input->post('category_id'),
                'contact_id' => $this->input->post('contact_id'),
                'province_id' => $this->input->post('province_id'),
                'district_id' => $this->input->post('district_id'),
                'public' => $this->input->post('public'),
                'status' => 1,
                'featured' => $this->input->post('featured'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('user_id'),
                'updated_by' => $this->session->userdata('user_id')
            );
            if ($_FILES['image']['name'] != "") {
                $config['file_name'] = convert_file_to_date($_FILES['image']['name'], make_unicode($this->input->post('title_alias')));
                $config['upload_path'] = './uploads/projects/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024';
                $config['max_width'] = '*';
                $config['max_height'] = '*';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->_data['error'] = $this->upload->display_errors();
                    $img = FALSE;
                } else {
                    $images = $this->upload->data();
                    $data['image'] = $images['file_name'];
                    $img = TRUE;
                }
            }
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I&address=' . urlencode($params['address']) . '&sensor=true';
            $json = @file_get_contents($url);
            $position = json_decode($json);
            if ($position->status == "OK") {
                $data['lat'] = $position->results[0]->geometry->location->lat;
                $data['lng'] = $position->results[0]->geometry->location->lng;
            } else {
                $this->_data['error'] = 'Chúng tôi không tìm thấy địa chỉ này. Vui lòng nhập đúng địa chỉ';
                $data['lat'] = NULL;
                $data['lng'] = NULL;
            }
            if ($img == TRUE) {
                $this->session->set_flashdata('success', 'Thêm mới thành công');
                $this->mprojects->insert($data);
                redirect(base_url() . $this->_data['modules'] . '/projects');
            }
        }
        $this->load->view($this->_data['modules'] . '/dashboard', $this->_data);
    }

    /**update
     *
     */
    public function update($id)
    {
        if (!isset($id) || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
            redirect(base_url() . $this->_data['modules'] . '/projects');
        }
        $project = $this->mprojects->getProject($id, $this->_data['level'], $this->_data['user_id']);
        if (empty($project)) {
            $this->session->set_flashdata('error', 'Đã có lỗi xảy ra, vui lòng thử lại sau');
            redirect(base_url() . $this->_data['modules'] . '/projects');
        }
        //
        $this->load->model('mtagging_tagged');
        $tagged = $this->mtagging_tagged->get_tag_by_article($id, $this->_data['controller']);
        if (!empty($tagged)) {
            $result = array();
            if (is_array($tagged)) {
                foreach ($tagged as $key => $tag) {
                    $result[$key] = $tag['tag_name'];
                }
            }
            $this->_data['tagged'] = implode(',', $result);
        }
        $this->_data['project'] = $project;
        $img = TRUE;
        $this->load->model('mdistricts');
        $this->_data['districts'] = $this->mdistricts->getDistrictByProvinceId($project->province_id);
        $this->_data['title'] = 'Cập nhật dự án';
        $this->_data['temp'] = 'projects/update';
        // Validate Field
        $this->_data['category'] = $this->mcategory->get_all_categories('project');
        $this->_data['provinces'] = $this->mprovinces->allProvinces();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;
        $rule = $this->mprojects->rules;
        $this->form_validation->set_rules($rule['insert']);
        if ($this->form_validation->run() == TRUE) {
            $params = $this->input->post('params');
            $data = array(
                'title' => $this->input->post('title'),
                'title_alias' => make_unicode($this->input->post('title_alias')),
                'params' => json_encode($params, JSON_UNESCAPED_UNICODE),
                'public' => $this->input->post('public'),
                'summary' => $this->input->post('summary'),
                'content' => $this->input->post('content'),
                'category_id' => $this->input->post('category_id'),
                'contact_id' => $this->input->post('contact_id'),
                'province_id' => $this->input->post('province_id'),
                'district_id' => $this->input->post('district_id'),
                'public' => $this->input->post('public'),
                'status' => 1,
                'featured' => $this->input->post('featured'),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('user_id')
            );
            if ($_FILES['image']['name'] != "") {
                $config['file_name'] = convert_file_to_date($_FILES['image']['name'], make_unicode($this->input->post('title_alias')));
                $config['upload_path'] = './uploads/projects/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '1024';
                $config['max_width'] = '*';
                $config['max_height'] = '*';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->_data['error'] = $this->upload->display_errors();
                    $img = FALSE;
                } else {
                    $images = $this->upload->data();
                    $this->mprojects->deleteImage('image', array('id' => $id), './uploads/projects/');
                    $data['image'] = $images['file_name'];
                    $img = TRUE;
                }
            }
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyDqAHaMV9ZVcSX992nMQOgZ_Vy80GUZ_8I&address=' . urlencode($params['address']) . '&sensor=true';
            $json = @file_get_contents($url);
            $position = json_decode($json);
            if ($position->status == "OK") {
                $data['lat'] = $position->results[0]->geometry->location->lat;
                $data['lng'] = $position->results[0]->geometry->location->lng;
            } else {
                $data['lat'] = NULL;
                $data['lng'] = NULL;
            }
            if ($img == TRUE) {
                $this->session->set_flashdata('success', 'Cập nhật thành công');
                $this->mprojects->update($data, ['id' => $id]);
                redirect(base_url() . $this->_data['modules'] . '/projects');
            }
        }
        $this->load->view($this->_data['modules'] . '/dashboard', $this->_data);
    }

    /**destroy
     *
     */
    public function destroy($id)
    {
        $this->mprojects->deleteImage('image', array('id' => $id), './uploads/projects/');
        $this->mprojects->delete(array('id' => $id));
        $this->session->set_flashdata('success', 'Xóa dự án thành công');
        redirect(base_url() . $this->_data['modules'] . '/projects');
    }

    // Validation
    public function check_select($element, $message)
    {
        if ($element == '0') {
            $this->form_validation->set_message('check_select', 'Bạn phải chọn ' . $message);
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

/* End of file projects.php */
/* Location: ./application/modules/admin/controllers/projects.php */