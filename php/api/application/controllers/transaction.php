<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Transactions
 */

require_once (APPPATH. 'libraries/REST_Controller.php');

class Transaction extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('CORE_Controller');
		$this->core_controller->set_response_helper($this);
		
		$this->load->model('transaction_model'); 
	}

	var $user_type = '';

	
	public function addTransactionRecord_post(){
		
		$this->load->model('user_model'); 
		$user=$this->core_controller->get_current_user();
		$stock_id=$this->input->post('stock_id');
		$price=$this->input->post('price');
		$quantity=$this->input->post('quantity');
		$datetime=$this->input->post('datetime');
		$target_price=$this->input->post('target_price');
		$stop_loss_price=$this->input->post('stop_loss_price');
		$rationale=$this->input->post('rationale');
		$review=$this->input->post('review');
		$type=$this->input->post('type');
		$trans_fee=$this->input->post('trans_fee');

		$data = array(
		    $this->transaction_model->KEY_user_id => $user[$this->user_model->KEY_user_id],
		    $this->transaction_model->KEY_stock_id => $stock_id ,
		    $this->transaction_model->KEY_price => $price,
		    $this->transaction_model->KEY_quantity => $quantity,
		    $this->transaction_model->KEY_datetime => $datetime ,
		    $this->transaction_model->KEY_target_price=> $target_price,
		    $this->transaction_model->KEY_stop_loss_price => $stop_loss_price,
		    $this->transaction_model->KEY_rationale => $rationale ,
		    $this->transaction_model->KEY_review => $review,
		    $this->transaction_model->KEY_type => $type,
		    $this->transaction_model->KEY_trans_fee => $trans_fee ,
		  
		);

		var_dump($data);
		$trans_id = $this->transaction_model->add_record($data);
		var_dump($trans_id);
		if($trans_id<0){
			$this->core_controller->fail_response(200);
		}
		$this->core_controller->add_return_data('transaction_id', $trans_id); 
		$this->core_controller->successfully_processed();


	}
	 

	

}

/* End of file transaction.php */
/* Location: ./application/controllers/transaction.php */