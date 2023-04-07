<?php 
class Error_custom extends MY_Controller{

    public function __construct(){
        parent::__construct();
    }

    public function pdfWaterMark(){


        $this->middle = 'errors/html/pdfWaterMark';
        $this->layout();
    }


    public function pdfWaterMarkiFrame(){

    	$this->template['middle'] = $this->load->view('errors/errorWaterMark_iFrame', true);

    }

}