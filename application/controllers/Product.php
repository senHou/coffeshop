<?php

class  Product extends CI_Controller{

    function __construct() {
        parent::__construct();
        $this->load->model('product_models');
        $this->load->library('session');
    }
    
    public function index() {
        $data['products'] = $this->product_models->listProducts();
        $this->template->load('layout','product/products',$data);
    }
    
    public function page() {
        $this->load->library('pagination');

        $config['total_rows'] = $this->product_models->recordCount();
        $config['base_url'] = base_url()."product/page";
        $this->pagination->initialize($config);
        
        if($this->uri->segment(3)){
            $page = ($this->uri->segment(3)) ;
        }else{
            $page = 1;
        }
        
        $str_links = $this->pagination->create_links();
        $data["links"] = explode('&nbsp;',$str_links );

       
        $data['products'] = $this->product_models->listProducts($page);
        $this->template->load('layout','product/products',$data);
    }
}
