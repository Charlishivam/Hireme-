<?php
class settings extends MY_Controller
{
    function __construct(){

        parent::__construct();
        auth_check(); // check login auth
        $this->rbac->check_module_access();

    $this->load->model('admin/orders_model', 'orders_model');
    }

  //-----------------------------------------------------   
  public function view(){

    $this->rbac->check_operation_access(); // check opration permission

    $data['title'] = '';
    //$data['orders'] = $this->orders_model->get_all_orders();

    $this->load->view('admin/includes/_header');
    $this->load->view('admin/settings/index', $data);
    $this->load->view('admin/includes/_footer');
  }

  //-----------------------------------------------------------
  public function index(){


    $data['title'] = '';
    $data['records'] = $this->orders->get_all_module();

    $this->load->view('admin/includes/_header');
    $this->load->view('admin/orders/orders_list', $data);
    $this->load->view('admin/includes/_footer');
  }

  //-----------------------------------------------------------
  public function create(){

    $this->rbac->check_operation_access(); // check opration permission

    if($this->input->post('submit')){
      $this->form_validation->set_rules('orderid', 'Order Id', 'trim|required');
      $this->form_validation->set_rules('method', 'method', 'trim|required');      
      $this->form_validation->set_rules('product', 'Product', 'trim');
      $this->form_validation->set_rules('product_qty', 'Quantity', 'trim');
      $this->form_validation->set_rules('product_price', 'Amount', 'trim');
      $this->form_validation->set_rules('product_sku', 'Product SKU', 'trim');      
      $this->form_validation->set_rules('customer', 'Customer', 'trim|required');
      $this->form_validation->set_rules('address', 'Address', 'trim|required');
      $this->form_validation->set_rules('address2', 'Address 2', 'trim');
      $this->form_validation->set_rules('city', 'City', 'trim|required');
      $this->form_validation->set_rules('state', 'State', 'trim|required');
      $this->form_validation->set_rules('pincode', 'Pin Code', 'trim|required');
      $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
      $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
      $this->form_validation->set_rules('dimension_height', 'Dimension', 'trim|required');
      $this->form_validation->set_rules('dimension_width', 'Dimension', 'trim|required');
      $this->form_validation->set_rules('dimension_leangth', 'Dimension', 'trim|required');
      $this->form_validation->set_rules('warehouse', 'Warehouse', 'trim');
      $this->form_validation->set_rules('shipping', 'Shipping Charges', 'trim|required');
      $this->form_validation->set_rules('cod', 'COD Charges', 'trim|required');
      $this->form_validation->set_rules('discount', 'Discount', 'trim|required');
      $this->form_validation->set_rules('status', 'Status', 'trim');
      
      if ($this->form_validation->run() == FALSE) {
        $data = array(
          'errors' => validation_errors()
        );
        $this->session->set_flashdata('errors', $data['errors']);
        redirect(base_url('admin/orders/create'),'refresh');
      }
      else{
        $data = array(
          'orderid'           => $this->input->post('orderid'),
          'method'           => $this->input->post('method'),
          'product'           => $this->input->post('product'),
          'product_qty'       => $this->input->post('product_qty'),
          'product_price'     => $this->input->post('product_price'),
          'product_sku'       => $this->input->post('product_sku'),
          'customer'          => $this->input->post('customer'),
          'address'           => $this->input->post('address'),
          'address2'          => $this->input->post('address2'),
          'city'              => $this->input->post('city'),
          'state'             => $this->input->post('state'),
          'pincode'           => $this->input->post('pincode'),
          'phone'             => $this->input->post('phone'),
          'weight'            => $this->input->post('weight'),
          'dimension_height'  => $this->input->post('dimension_height'),
          'dimension_width'   => $this->input->post('dimension_width'),
          'dimension_leangth' => $this->input->post('dimension_leangth'),
          'warehouse'         => $this->input->post('warehouse'),
          'shipping'          => $this->input->post('shipping'),
          'cod'               => $this->input->post('cod'),
          'discount'          => $this->input->post('discount'),          
          'status'            => $this->input->post('status'),
        );
        $data = $this->security->xss_clean($data);
        $result = $this->orders_model->create($data);
        if($result){
          $this->session->set_flashdata('success', 'orders has been added successfully!');
          redirect(base_url('admin/orders/view'));
        }
      }
    }
    else{
      $data['title'] = '';

      $this->load->view('admin/includes/_header');
      $this->load->view('admin/orders/create', $data);
      $this->load->view('admin/includes/_footer');
    }
  }
}

?>