<?php

class Cart extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('product_models');
        $this->load->library('session');
        $this->load->library('cart');
        $this->load->library('form_validation');
    }
    
    
    public function addToCart($productId){
        $product = $this->product_models->getProdcutById($productId);
        $data = array(
            'id'      => $product['code'],
            'qty'     => 1,
            'price'   => $product['price'],
            'name'    => $product['name']
        );
        
        $this->cart->insert($data);
         redirect(site_url('product/page'));
    }
    
    public function displayCart() {
        $this->template->load('layout','cart/display_cart',null);
    }
    
    public function updateCart() {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $rowId = $this->input->post($i.'[rowid]');
            $qty = $this->input->post($i.'[qty]');
            $data = array(
                'rowid' => $rowId,
                'qty'   => $qty
            );

            $this->cart->update($data);
            $i++;
        }
        
        $this->template->load('layout','cart/display_cart',null);
    }
}

