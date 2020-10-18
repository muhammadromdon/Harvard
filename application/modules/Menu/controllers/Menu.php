<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        is_loggedin();
        $this->load->model('Users/Modelusers');
    }

    function index()
    {
        $data['title'] = 'Add Menu';
        $data['user'] = $this->Modelusers->checkdata();
        $data['menu'] = $this->Modelusers->getallmenu();

        $menu = $this->input->post('menu');

        $this->form_validation->set_rules('menu', 'menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Users/templates/dashheader', $data);
            $this->load->view('Users/templates/dashsidebar', $data);
            $this->load->view('Users/templates/dashtopbar', $data);
            $this->load->view('menuview', $data);
            $this->load->view('Users/templates/dashfooter');
        } else {
            $this->db->insert('user_menu', ['menu' => $menu]);
            $this->session->set_flashdata('message', 'New menu has been added..');
            redirect('Menu');
        }
    }

    function Deletemenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', 'Your menu has been deleted!');
        redirect('Menu');
    }

    function Menusettings()
    {
        $data['title']   = 'Menu Settings';
        $data['user']    = $this->Modelusers->checkdata();
        $data['submenu'] = $this->Modelusers->getsubmenu();
        $data['menu']    = $this->Modelusers->getallmenu();

        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('menu_id', 'menu', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('Users/templates/dashheader', $data);
            $this->load->view('Users/templates/dashsidebar', $data);
            $this->load->view('Users/templates/dashtopbar', $data);
            $this->load->view('menusettview', $data);
            $this->load->view('Users/templates/dashfooter');
        } else {
            $this->Modelusers->insertsub();
            $this->session->set_flashdata('message', 'New menu has been added..');
            redirect('Menu/Menusettings');
        }
    }

    function Deletesett($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', 'Your menu has been deleted!');
        redirect('Menu/Menusettings');
    }
}
