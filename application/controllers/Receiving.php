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

            //add both supplies and services
            $this->data['receiving'] = array(array('supplies' => $supplies));
            $this->render();
	}

	//update supplies on the database
	public function update()
	{
            $this->rest->initialize(array('server' => 'http://backend.local'));
            $this->rest->option(CURLOPT_PORT, REST_PORT);
            
            $selectedItems = $this->input->post("selectedItem");
            
            // I know this is bad code. I could do better if I knew more about PHP. :(
            foreach($selectedItems as $yes)
            {
                $loc = key($selectedItems);
                $curItem = array('id' => $loc, 'quantity' => $selectedItems[$loc]);
                $result = $this->rest->put('/receiving/item/id/' . $loc, $curItem);
            }
	}
}
