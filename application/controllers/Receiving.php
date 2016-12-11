<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Receiving extends Application
{

	/**
    * Production page
    * Show services, and for the selected one, show the supplies that go into it, 
    * flagging any that are not on hand. Log any items made, without updating inventory.
    *
    */
	public function index()
	{
                $userrole = $this->session->userdata('userrole');
                if ($userrole != 'admin') {
                   
                    $this->data['pagebody'] = 'authorization';
                    $this->render();
                    return;
                }
		$this->data['pagebody'] = 'receiving';
        //
		$services = $this->services->get_all();
                $supplies = $this->supplies->get_all();

        //go through supplies
		foreach ($supplies as $supply)
		{
			//add supply info
			$standalone[] = array('supply' => $supply['name']);
		}

		//go through services
		foreach ($services as $service)
		{
			//add service info
			$bundle[] = array('service' => $service['name']);
		}
		//add both supplies and services
		$this->data['receiving'] = array(array('supplies' => $standalone, 'services' => $bundle));
		$this->render();
	}

	//receive service
	public function receive()
	{
		//results returned from POST
		$results = $this->input->post();

		//go through results and add the quanity specified to the stocks
		foreach ($results as $service)
		{
			$this->stocks->set_quantity($service['name'], "add", $service['quantity']);
		}

		//return message upon successful stocking
	}
}
