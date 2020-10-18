<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        is_loggedin();
        $this->load->model('Users/Modelusers');
    }

    function index()
    {
        $data['title'] = 'Dashboard';
        $data['user']  = $this->Modelusers->checkdata();

        $this->load->view('Users/templates/dashheader', $data);
        $this->load->view('Users/templates/dashsidebar', $data);
        $this->load->view('Users/templates/dashtopbar', $data);
        $this->load->view('adminview', $data);
        $this->load->view('Users/templates/dashfooter');
    }

    function Role()
    {
        $data['title'] = 'Role';
        $data['user']  = $this->Modelusers->checkdata();
        $data['role']  = $this->Modelusers->getallrole();

        $this->form_validation->set_rules('role', 'role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('Users/templates/dashheader', $data);
            $this->load->view('Users/templates/dashsidebar', $data);
            $this->load->view('Users/templates/dashtopbar', $data);
            $this->load->view('roleview', $data);
            $this->load->view('Users/templates/dashfooter');
        }
    }

    function Roleaccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user']  = $this->Modelusers->checkdata();
        $data['role']  = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['umenu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('Users/templates/dashheader', $data);
        $this->load->view('Users/templates/dashsidebar', $data);
        $this->load->view('Users/templates/dashtopbar', $data);
        $this->load->view('accessview', $data);
        $this->load->view('Users/templates/dashfooter');
    }

    function Changeaccess()
    {
        $roleid = $this->input->post('roleid');
        $menuid = $this->input->post('menuid');

        $data = [
            'role_id' => $roleid,
            'menu_id' => $menuid
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Content view has been managed!');
    }

    function Datamaster()
    {
        $data['title'] = 'Data Master';
        $data['user']  = $this->Modelusers->checkdata();
        $data['siswa'] = $this->Modelusers->getalldata();

        $this->load->view('Users/templates/dashheader', $data);
        $this->load->view('Users/templates/dashsidebar', $data);
        $this->load->view('Users/templates/dashtopbar', $data);
        $this->load->view('masterdataview', $data);
        $this->load->view('Users/templates/dashfooter');
    }

    function Updatestudent($id)
    {
        $this->form_validation->set_rules('nim', 'id', 'required|trim|numeric');
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'fields', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Students Data';
            $data['user']  = $this->Modelusers->checkdata();
            $data['student'] = $this->Modelusers->getstudentid($id);
            $data['jurusan'] = ['IT', 'Agroculture', 'Engineering', 'Art', 'Law', 'Business'];

            $this->load->view('Users/templates/dashheader', $data);
            $this->load->view('Users/templates/dashsidebar', $data);
            $this->load->view('Users/templates/dashtopbar', $data);
            $this->load->view('updateview', $data);
            $this->load->view('Users/templates/dashfooter');
        } else {
            $this->Modelusers->updatestudent();
            $this->session->set_flashdata('message', 'updated..');
            redirect('Admin/Datamaster');
        }
    }

    function Deletestudent($id)
    {
        $this->Modelusers->deletestudent($id);
        $this->session->set_flashdata('message', 'deleted..');
        redirect('Admin/Datamaster');
    }
}
