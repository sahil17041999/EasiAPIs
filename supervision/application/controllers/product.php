<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Product extends BaseController
{



    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index()
    {
        $cols = ' * ';
        $tmp_data = $this->custom_db->single_table_records('category', $cols);
        $page_data['category_data'] = '';
        $page_data['category_data'] = $tmp_data['data'];
        $this->loadViews("product/category",$page_data);
    }

    public function add_category()
    {
        $this->form_validation->set_rules('category_name', 'category_name ', 'required');
        if ($this->form_validation->run() == TRUE) {

            $page_data['category_name'] = $this->input->post('category_name');
            $page_data['status'] = $this->input->post('status');
           // $page_data['profession_name'] = $this->input->post('profession_name');
            $profession_data = $this->custom_db->insert_record('category', $page_data);
            if ($profession_data > 0) {
                $this->session->set_flashdata('success', 'category added successfully');
                redirect('product');
            } else {
                $this->session->set_flashdata('error', 'category not added please try again!');
                redirect('product');
            }
            
        }
        $this->loadViews("product/add_category");
    }

    function  category_info($origin)
    {
        if ($origin == NULL) {
        } else {
            $page_data['category_info'] = $this->product_model->get_category_info($origin);
			
            $this->loadViews("product/info_category", $page_data);
        }
    }

    public function edit_category(){
        $origin = $this->input->post('origin');
        $this->form_validation->set_rules('category_name', 'category name', 'required');
        if ($this->form_validation->run() == FALSE) {

        }else{
            $profession_name = $this->input->post('category_name');
            $category_record = array();
            $category_record = array(
                'category_name' => $profession_name
            );
           // debug($profession_record_data);die;
            $category_data = $this->product_model->edit_category($category_record, $origin);
           // debug($profession_data);die;
            if ($category_data == true) {
                $this->session->set_flashdata('success', 'category updated successfully');
                redirect('product');
            } else {
                $this->session->set_flashdata('error', 'category  not updated');
                redirect('product/edit_category/<?=' . $origin . '?>');
            }
        }
    }



    function delete_category($origin)
    {
        $this->custom_db->delete_record('category', array('origin' => $origin));
        $this->session->set_flashdata('error', 'category deleted successfully');
        redirect('product');
    }


    function category_status($origin)
    {
        $status = $this->input->post('status');
        $this->product_model->category_status($origin, $status);
    }
}
