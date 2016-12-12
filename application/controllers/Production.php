<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends Application
{

	/**
    * Production controller
    * Show services, and for the selected one, show the supplies that go into it, 
    * flagging any that are not on hand. Log any items made, without updating inventory.
    *
    */
    public function index()
    {
        $userrole = $this->session->userdata('userrole');
        if ($userrole != 'worker' && $userrole != 'admin') {          
            $this->data['pagebody'] = 'authorization';
            $this->render();
            return;
        }
        $this->data['pagebody'] = 'production';
        //the services
        $services = $this->services->get_all();

        //service information
        $productionInformation = array();

        //go through all the services
        foreach ($services as $service)
        {
            $supplyInformation = array();
            //for each service
            foreach ($service['supplies'] as $supply => $quantity)
            {
                //if the service's required supplies is more than what is in the supply room
                if ($this->supplies->get_quantity($supply) < $quantity)
                {
                    $supplyInformation[] = array('supply' => $supply, 'quantity' => $quantity, 'availability' => "Not enough supplies in warehouse");
                }
                else
                {
                    $supplyInformation[] = array('supply' => $supply, 'quantity' => $quantity, 'availability' => "Supply available");
                }
            }
            $productionInformation[] = array('name' => $service['name'], 'supplyInformation' => $supplyInformation);
        }
        $this->data['production'] = $productionInformation;
        $this->render();
    }

    //produce service
    public function produce()
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
