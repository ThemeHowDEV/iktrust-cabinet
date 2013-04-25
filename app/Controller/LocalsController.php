<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class LocalsController extends AppController {

	public function adminview($id = null){
		$this->layout = 'admin';
		$this->Local->id = $id;
		$this->set('local', $this->Local->read(null, $id));
		$a = $this->Local->Find('first',array(
			'conditions' =>array( 'Local.id' => $id),
		));

		$this->set('a',$a);
		//debug($a);die();
		
		$localStatuses = $this->Local->LocalStatus->find('list');
		//debug($localStatuses);die();
		
		$this->set(compact( 'localStatuses'));
		//save data
		
		if($this->request -> isPut() || $this->request -> isPost()){
			$this->Local->create();
			
			if($this->request->data['Local']['local_status_id'] ==2 ) {
			
				$ibagent 			= $this->request->data['Local']['ibagent'];
				$country 			= $this->request->data['Local']['country'];
				$state				= $this->request->data['Local']['state'];
				$city		 			= $this->request->data['Local']['city'];
				$address 			= $this->request->data['Local']['address'];
				$send_reports 	= $this->request->data['Local']['send_reports'];
				$readonly 		= $this->request->data['Local']['readonly'];
				$comment 		= $this->request->data['Local']['comment'];
				$acctype 			= $this->request->data['Local']['acctype'];
				$name 				= $this->request->data['Local']['name'];
				$email 				= $this->request->data['Local']['email'];
				$key 				= $this->request->data['Local']['key'];
				$investor 			= $this->request->data['Local']['investor'];
				$agent 				= $this->request->data['Local']['agent'];
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_URL,'http://iktrust.co.uk/webservice/api.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);

				// hantar parameter 
				$data = array(
					'ibagent' 			=> $ibagent,
					'country' 			=> $country,
					'state' 				=> $state,
					'city' 				=> $city,
					'address' 			=> $address,
					'send_reports ' => $send_reports ,
					'readonly' 			=> $readonly,
					'comment' 		=> $comment,
					'acctype' 			=> $acctype,
					'name' 				=> $name,
					'email' 				=> $email,
					'mpass' 			=> $key,
					'ipass' 				=> $investor,
					'agent' 				=> $agent,
				);
				
				//debug($key);die();
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$output = curl_exec($ch);
				$info = curl_getinfo($ch);
				
				debug($data);
				debug($output);
				debug($info);die();
			}
			
			if($this->Local->save($this->request->data)){
				$this->redirect(array('controller' => 'locals' , 'action' => 'tradersindex'));
			}
		}
	}
	
	public function tradersindex(){
		$this->layout = 'admin';
		$this->Local->recursive = 0;
		$this->set('locals', $this->paginate('Local', array(), array()));
	}
	
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Local->id = $id;
		
		if (!$this->Local->exists()) {
			throw new NotFoundException(__('Invalid trader'));
		}
		
		if ($this->Local->delete()) {
			$this->Session->setFlash(__('Trader deleted'));
			$this->redirect(array('action' => 'tradersindex'));
		}
		
		$this->Session->setFlash(__('Trader was not deleted'));
		$this->redirect(array('action' => 'tradersindex'));
	}
	
	public function edit_deposit($id = null) {
		//layout
		$this->layout = 'admin';	
		//load model
		$this->loadModel('Deposit');
		$this->loadModel('DepositComment');
		//find user id
		$userId = $this->UserAuth->getUserId();
		$this->set('user_id', $userId);
		//display details
		$this->Deposit->id = $id;
		
		$deposit = $this ->Deposit->find('first' , array(
			'conditions' => array( 'Deposit.id' => $id)
		));
		$this->set('deposit', $deposit);
		//display table
		
		$login = $deposit['Deposit']['mt4_user_LOGIN'];
		$dc = $this->paginate('DepositComment',
			array("DepositComment.mt4_user_LOGIN" => $login)
		);
		$this->set('dc', $dc);
		//submit form
		
		if($this->request -> isPut() || $this->request -> isPost()){
			$status = $this->request->data['Deposit']['status'];
			//debug($this->request->data);die();
			$data = array('id' => $id , 'local_status_id' => $status );
			$this->Deposit->save($data);
			$this->DepositComment->create();
			if($this->DepositComment->save($this->request->data)){
				//$this->session->setFlash(_('The bank details have been saved'));
				$this->redirect(array('action' => 'transaction_deposit'));
			}
			if($this->request->data['Deposit']['status'] ==2 ) {
				//send data using curl
				$amount 		= $this->request->data['DepositComment']['amount'];
				$comment	= $this->request->data['DepositComment']['comment'];
				$login 			= $this->request->data['DepositComment']['mt4_user_LOGIN'];
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				curl_setopt($ch, CURLOPT_URL,'http://iktrust.co.uk/webservice/api.php');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_POST, true);

				// hantar parameter 
				$data = array(
					'amount'	 	=> $amount,
					'comment' 	=> $comment,
					'login'			=> $login,
					
				);
				
				//debug($key);die();
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				$output = curl_exec($ch);
				$info = curl_getinfo($ch);
				
				debug($data);
				debug($output);
				debug($info);die();
				
				// send sms
				$HttpSocket = new HttpSocket();
				$results = $HttpSocket->post('http://bulk.ezlynx.net:7001/BULK/BULKMT.aspx', array(
					'user' => 'instafx', 
					'pass' => 'instafx8000',
					'msisdn' => '0136454001',
					'body' => 'iktrust test ',
					'smstype' => 'TEXT',
					'sender' => 'IKTRUST',
					#'Telco' => 'CELCOM'
					));	   
			}
		}
	}
	
	function transaction_deposit(){
			//layout
			$this->layout = 'admin';	
			//load model
			$this->loadModel('Deposit');
			$this->loadModel('User');
			$this->loadmodel('Mt4User');
			$this->loadModel('DepositComment');
			$deposit = $this->paginate('Deposit');
			$this->set('deposit', $deposit);			 
		//
	}

}

?>
