<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        is_loggedin();
        $this->load->model('Modelusers');
    }

    function index()
    {
        $data['title'] = 'My Profile';
        $data['user']  = $this->Modelusers->checkdata();

        $this->load->view('templates/dashheader', $data);
        $this->load->view('templates/dashsidebar', $data);
        $this->load->view('templates/dashtopbar', $data);
        $this->load->view('userview', $data);
        $this->load->view('templates/dashfooter');
    }

    function Blocked()
    {
        $this->load->view('userblock');
    }

    function Edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user']  = $this->Modelusers->checkdata();
        $data['jurusan'] = ['IT', 'Agroculture', 'Engineering', 'Art', 'Law', 'Business'];

        $this->form_validation->set_rules('name', 'name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dashheader', $data);
            $this->load->view('templates/dashsidebar', $data);
            $this->load->view('templates/dashtopbar', $data);
            $this->load->view('usereditview', $data);
            $this->load->view('templates/dashfooter', $data);
        } else {

            $data = [
                'name'  => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'nim' => $this->input->post('nim'),
                'jurusan' => $this->input->post('jurusan')
            ];

            $this->_uploadimage();

            $this->db->update('students', $data, ['email' => $this->session->userdata('email')]);

            $this->session->set_flashdata('message', 'Your profile has been updated!');
            redirect('Users');
        }
    }

    private function _uploadimage()
    {
        $data['user'] = $this->Modelusers->checkdata();

        $uploadimage = $_FILES['image']['name'];

        if ($uploadimage) {
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = '15000';
            $config['upload_path'] = './assets/img/profile';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $oldimage = $data['user']['image'];

                if ($oldimage != 'default.png') {
                    unlink(FCPATH . '/assets/img/profile/' . $oldimage);
                }

                $newimage = $this->upload->data('file_name');
                $this->db->set('image', $newimage);
            } else {
                $this->session->set_flashdata('message', '<p>' . $this->upload->display_errors() . '</p');
                redirect('Users/Edit');
            }
        }
    }

    function Changepass()
    {
        $data['title'] = 'Change Password';
        $data['user']  = $this->Modelusers->checkdata();

        $this->form_validation->set_rules('currentpass', 'current password', 'required|trim');
        $this->form_validation->set_rules('newpass1', 'password', 'required|trim|min_length[3]|matches[newpass2]');
        $this->form_validation->set_rules('newpass2', 'password', 'required|trim|matches[newpass1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/dashheader', $data);
            $this->load->view('templates/dashsidebar', $data);
            $this->load->view('templates/dashtopbar', $data);
            $this->load->view('changepassview', $data);
            $this->load->view('templates/dashfooter');
        } else {
            $currentpass = $this->input->post('currentpass');

            if (!password_verify($currentpass, $data['user']['password'])) {
                $this->session->set_flashdata('message', 'Your current password is wrong!');
                redirect('Users/Changepass');
            } else {
                $this->Modelusers->changepass();
                $this->session->set_flashdata('message', 'Your password has been updated!');
                redirect('Users/Changepass');
            }
        }
    }
}
