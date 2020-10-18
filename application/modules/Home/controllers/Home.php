<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MX_Controller
{
    function index()
    {
        $data['title'] = 'Harvard University';
        $this->load->view('headerview', $data);
        $this->load->view('topbarview');
        $this->load->view('homeview');
        $this->load->view('footerview');
    }
}
