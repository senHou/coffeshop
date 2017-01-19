<?php

class Product_models extends CI_Model {
    
     function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function listProducts($pageNo){
        
        $rowPerPage = $this->config->item('per_page');
        $this->db->limit($rowPerPage,$rowPerPage*($pageNo-1));
       
        $query = $this->db->get('product');
        echo $this->db->last_query(); 
        return $query->result_array();
    }
    
    public function recordCount() {
        return $this->db->count_all("product");
    }
    
    public function getProdcutById($id){
        $array = array('id' => $id);
        $query = $this->db->get_where('product',$array);
        return $query->row_array();
    }
}

