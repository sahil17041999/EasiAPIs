<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Category extends BaseController
{



    function __construct()
    {

        parent::__construct();

        $this->load->model('module_model');
        $this->load->helper('alert');

        $this->load->model('import_model');
    }

    public function index()
    {

        $cols = ' * ';

        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['profession_data'] = '';
        $page_data['profession_data'] = $tmp_data['data'];
        $this->loadViews("category/category", $page_data);
    }

    public function add_category()
    {
        $this->form_validation->set_rules('profession_name', 'Category name', 'required');
        if ($this->form_validation->run() == TRUE) {

            if (!empty($_FILES['service_icon']['name'])) {
                $config['upload_path'] = 'assets/img/api_category_img';
                $config['allowed_types'] = 'png';
                $config['file_name'] = $_FILES['service_icon']['name'];
                $config['max_size'] = '';
                $config['max_width']  = '';
                $config['max_height']  = '';
                $config['remove_spaces']  = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('service_icon')) {
                } else {
                    $uploadData = $this->upload->data();
                    // debug($uploadData);die;
                    $service_icon = $uploadData['file_name'];
                }
            } else {
                $this->session->set_flashdata('error', 'Please upload Category image ');
                redirect('category/add_category');
            }

            $page_data['service_icon'] = $service_icon;
            $page_data['profession_name'] = $this->input->post('profession_name');
            $page_data['status'] = $this->input->post('status');
            // $page_data['profession_name'] = $this->input->post('profession_name');
            $profession_data = $this->custom_db->insert_record('profession', $page_data);
            if ($profession_data > 0) {
                $this->session->set_flashdata('success', 'Category added successfully');
                redirect('category');
            } else {
                $this->session->set_flashdata('error', 'Category not added please try again!');
                redirect('category');
            }
        }
        $this->loadViews("category/add_category",);
    }

    function  category_info($origin)
    {
        if ($origin == NULL) {
        } else {
            $page_data['profession_info'] = $this->module_model->profession_get_info($origin);
            $this->loadViews("category/info_category", $page_data);
        }
    }

    public function edit_category()
    {
        $origin = $this->input->post('origin');
        $this->form_validation->set_rules('profession_name', 'Category name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Please enter category');
            redirect('category/category_info/' . $origin . '');
        } else {

            if (!empty($_FILES['service_icon']['name'])) {
                $config['upload_path'] = 'assets/img/api_category_img';
                $config['allowed_types'] = 'png';
                $config['file_name'] = $_FILES['service_icon']['name'];
                $config['max_size'] = '';
                $config['max_width']  = '';
                $config['max_height']  = '';
                $config['remove_spaces']  = false;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if (!$this->upload->do_upload('service_icon')) {
                } else {
                    $uploadData = $this->upload->data();
                    // debug($uploadData);die;
                    $service_icon = $uploadData['file_name'];
                }
            } else {
                //$this->session->set_flashdata('error', 'Please upload Category image ');
                //redirect('category/add_category');
            }



            $profession_record_data = array();

            $profession_name = $this->input->post('profession_name');
            $edit_image = $this->input->post('edit_service_icon');
            if ($edit_image != '' && !$service_icon) {
                $profession_record_data = array(
                    'profession_name' => $profession_name,
                    'service_icon' => $edit_image
                );
            } else {
                $profession_record_data = array(
                    'profession_name' => $profession_name,
                    'service_icon' => $service_icon
                );
            }


            // debug($profession_record_data);die;
            $profession_data = $this->module_model->edit_profession($profession_record_data, $origin);
            // debug($profession_data);die;
            if ($profession_data > 0) {
                $this->session->set_flashdata('success', 'Category updated successfully');
                redirect('category');
            } else {
                $this->session->set_flashdata('error', 'Category  not updated');
                redirect('category/edit_category/<?=' . $origin . '?>');
            }
        }
    }



    function delete_category($origin)
    {
        $this->custom_db->delete_record('profession', array('origin' => $origin));
        $this->session->set_flashdata('error', 'Category deleted successfully');
        redirect('category');
    }


    function category_status($origin)
    {
        $status = $this->input->post('status');
        $this->module_model->profession_status($origin, $status);
    }


    public function sub_category()
    {

        //$cols = ' * ';
        // $tmp_data = $this->custom_db->single_table_records('sub_category', $cols);
        // $page_data['sub_category_data'] = '';
        //$page_data['sub_category_data'] = $tmp_data['data'];
        $record = $this->module_model->sub_category_list();
        $page_data['sub_category_data'] = '';
        $page_data['sub_category_data'] = $record;
        $this->loadViews("category/sub_category", $page_data);
    }

    public function add_sub_category()
    {
        $this->form_validation->set_rules('sub_category_name', 'Sub Category name ', 'required');
        $this->form_validation->set_rules('category_id', 'Please select category', 'required');
        if ($this->form_validation->run() == TRUE) {

            $page_data['sub_category_name'] = $this->input->post('sub_category_name');
            $page_data['category_id'] = $this->input->post('category_id');
            $page_data['status'] = $this->input->post('status');
            // $page_data['profession_name'] = $this->input->post('profession_name');
            $profession_data = $this->custom_db->insert_record('sub_category', $page_data);
            if ($profession_data > 0) {
                $this->session->set_flashdata('success', 'Sub category added successfully');
                redirect('category/sub_category');
            } else {
                $this->session->set_flashdata('error', 'Sub category not added please try again');
                redirect('category/sub_category');
            }
        }
        $cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['category_list'] = '';
        $page_data['category_list'] = $tmp_data['data'];
        $this->loadViews("category/add_sub_category", $page_data);
    }

    function  sub_category_info($origin)
    {
        if ($origin == NULL) {
        } else {
            $cols = ' * ';
            $tmp_data = $this->custom_db->single_table_records('profession', $cols);
            $page_data['category_list'] = '';
            $page_data['category_list'] = $tmp_data['data'];
            $page_data['sub_category_info'] = $this->module_model->get_sub_category_info($origin);
            $this->loadViews("category/info_sub_category", $page_data);
        }
    }

    public function edit_sub_category()
    {
        $origin = $this->input->post('origin');
        $this->form_validation->set_rules('sub_category_name', 'Sub Category name ', 'required');
        $this->form_validation->set_rules('category_id', 'Please select category', 'required');
        if ($this->form_validation->run() == FALSE) {
            //$this->loadViews("category/info_sub_category");
            $this->session->set_flashdata('error', 'Please enter Sub category');
            redirect('category/sub_category_info/' . $origin . '');
        } else {
            $sub_category_name = $this->input->post('sub_category_name');
            $category_id = $this->input->post('category_id');
            $sub_category_record = array();
            $sub_category_record = array(
                'sub_category_name' => $sub_category_name,
                'category_id' => $category_id
            );
            // debug($profession_record_data);die;
            $category_data = $this->module_model->edit_sub_category($sub_category_record, $origin);
            // debug($profession_data);die;
            if ($category_data == true) {
                $this->session->set_flashdata('success', 'Sub category updated successfully');
                redirect('category/sub_category');
            } else {
                $this->session->set_flashdata('error', 'Sub category  not updated');
                redirect('category/sub_category_info/' . $origin . '');
            }
        }
    }

    function delete_sub_category()
    {

        $origin = $this->input->post('origin');

        try {
            // $this->load->model('Module_model');
            $this->module_model->delete_sub_category($origin);
            $response = array('status' => 'error', 'message' => 'Sub category deleted successfully');
            // $this->session->set_flashdata('error', 'Sub category deleted successfully');
            // redirect('category/sub_category');
        } catch (Exception $e) {
            // If there's a database error, set a custom error message
            if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
                $response = array('status' => 'error', 'message' => 'Cannot delete or update this row because it is linked to other records.');
                // redirect('category/sub_category');

            } else {
                $response = array('status' => 'error', 'message' => 'An error occurred while trying to delete the row.');
                // redirect('category/sub_category');
            }
        }
        echo json_encode($response);
    }

    function sub_category_status($origin)
    {
        $status = $this->input->post('status');
        $this->module_model->sub_category_status($origin, $status);
    }


    public function qualificaton_category()
    {
        $record = $this->module_model->qualification_category_list();
        $page_data['qualifcation_category_data'] = '';
        $page_data['qualifcation_category_data'] = $record;
        //debug($page_data['qualifcation_category_data']);die;
        $this->loadViews("category/qualifcation_category", $page_data);
    }

    public function add_qualification()
    {
        $this->form_validation->set_rules('qualification_name', 'Qualification Category name ', 'required');
        $this->form_validation->set_rules('category_id', 'Please select category', 'required');
        if ($this->form_validation->run() == TRUE) {

            $page_data['qualification_name'] = $this->input->post('qualification_name');
            $page_data['category_id'] = $this->input->post('category_id');
            $page_data['status'] = $this->input->post('status');
            // $page_data['profession_name'] = $this->input->post('profession_name');
            $profession_data = $this->custom_db->insert_record('qualification', $page_data);
            if ($profession_data > 0) {
                $this->session->set_flashdata('success', 'Qualification category added successfully');
                redirect('category/qualificaton_category');
            } else {
                $this->session->set_flashdata('error', 'Qualification category not added please try again');
                redirect('category/qualificaton_category');
            }
        }
        $cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('profession', $cols);
        $page_data['category_list'] = '';
        $page_data['category_list'] = $tmp_data['data'];
        $this->loadViews("category/add_qualificaton_category", $page_data);
    }

    function  qualification_category_info($origin)
    {
        if ($origin == NULL) {
        } else {
            $cols = ' * ';
            $tmp_data = $this->custom_db->single_table_records('profession', $cols);
            $page_data['category_list'] = '';
            $page_data['category_list'] = $tmp_data['data'];
            $page_data['Qualification_category_info'] = $this->module_model->get_qualification_category_info($origin);
            //debug($page_data['Qualification_category_info']);die;
            $this->loadViews("category/info_qualificaton_category", $page_data);
        }
    }

    public function edit_quali_category()
    {
        $origin = $this->input->post('origin');
        $this->form_validation->set_rules('qualification_name', 'Qualification Category name ', 'required');
        $this->form_validation->set_rules('category_id', 'Please select category', 'required');
        if ($this->form_validation->run() == FALSE) {
            //$this->loadViews("category/info_sub_category");
            $this->session->set_flashdata('error', 'Please enter Qualification category');
            redirect('category/qualification_category_info/' . $origin . '');
        } else {
            $qualification_name = $this->input->post('qualification_name');
            $category_id = $this->input->post('category_id');
            $quali_category_record = array();
            $quali_category_record = array(
                'qualification_name' => $qualification_name,
                'category_id' => $category_id
            );
            // debug($profession_record_data);die;
            $category_data = $this->module_model->edit_quali_category($quali_category_record, $origin);
            // debug($profession_data);die;
            if ($category_data == true) {
                $this->session->set_flashdata('success', 'Qualification category updated successfully');
                redirect('category/qualificaton_category');
            } else {
                $this->session->set_flashdata('error', 'Qualification category  not updated');
                redirect('category/qualification_category_info/' . $origin . '');
            }
        }
    }

    function delete_quali_category($origin)
    {
        $this->custom_db->delete_record('qualification', array('origin' => $origin));
        $this->session->set_flashdata('error', 'Qualification category deleted successfully');
        redirect('category/qualificaton_category');
    }

    function quali_category_status($origin)
    {
        $status = $this->input->post('status');
        $this->module_model->quali_category_status($origin, $status);
    }

    public function import_category()
    {

        if ($this->input->post('submit')) {
            $path = 'assets/Excelrecord/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadFile')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('category');
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                    //debug($import_xls_file);die;

                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                //debug($inputFileName);die;

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    //debug($inputFileType);die;
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;
                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['profession_name'] = $value['A'];
                        $inserdata[$i]['status'] = $value['B'];
                        $i++;
                    }
                    $result = $this->import_model->import_category_data($inserdata);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Category Imported successfully');
                        redirect('category');
                    } else {
                        $this->session->set_flashdata('error', 'Category not Imported');
                        redirect('category');
                    }
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                }
            } else {
                echo $error['error'];
            }
        }
        $this->loadViews("category/category");
    }
}
