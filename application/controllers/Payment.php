<?php
	/**
	* 
	*/
class Payment extends CI_Controller
{

        function __construct() {
            parent::__construct();
            $this->load->library('cart');
            $this->load->library('form_validation');
        }


        function setExpressCheckOut() {
            
            if (!isset($this->session->userdata['logged_in'])) {
                redirect('/user/login');
            } else {
                $products = [];
                // set an item via POST request
                $i = 0;
                foreach ($this->cart->contents() as $items) {
                    $products[$i]['ItemName'] = $items['name']; //Item Name
                    $products[$i]['ItemPrice'] = $items['price']; //Item Price
                    $products[$i]['ItemNumber'] = $items['code']; //Item Number
                    $products[$i]['ItemDesc'] = $items['name']; //Item Number
                    $products[$i]['ItemQty']	= $items['qty']; // Item Quantity

                    $i++;
                }



                /*
                $products[0]['ItemName'] = 'my item 1'; //Item Name
                $products[0]['ItemPrice'] = 0.5; //Item Price
                $products[0]['ItemNumber'] = 'xxx1'; //Item Number
                $products[0]['ItemDesc'] = 'good item'; //Item Number
                $products[0]['ItemQty']	= 1; // Item Quantity		
                */
                /*

                // set a second item

                $products[1]['ItemName'] = 'my item 2'; //Item Name
                $products[1]['ItemPrice'] = 10; //Item Price
                $products[1]['ItemNumber'] = 'xxx2'; //Item Number
                $products[1]['ItemDesc'] = 'good item 2'; //Item Number
                $products[1]['ItemQty']	= 3; // Item Quantity
                */		

                //-------------------- prepare charges -------------------------

                $charges = [];

                //Other important variables like tax, shipping cost
                $charges['TotalTaxAmount'] = 0;  //Sum of tax for all items in this order. 
                $charges['HandalingCost'] = 0;  //Handling cost for this order.
                $charges['InsuranceCost'] = 0;  //shipping insurance cost for this order.
                $charges['ShippinDiscount'] = 0; //Shipping discount for this order. Specify this as negative number.
                $charges['ShippinCost'] = 0; //Although you may change the value later, try to pass in a shipping amount that is reasonably accurate.

                //------------------SetExpressCheckOut-------------------

                //We need to execute the "SetExpressCheckOut" method to obtain paypal token

                $this->paypal->SetExpressCheckOut($products, $charges);	
            }
        }

        function DoExpressCheckoutPayment() {
            $this->paypal->DoExpressCheckoutPayment();
        }

        public function returnPage(){
            $this->template->load('layout','paypal/return',null);
        }
}
?>