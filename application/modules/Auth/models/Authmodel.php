<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authmodel extends CI_Model
{

    function dataCheck()
    {
        return $this->db->get_where('students', ['email' => $this->input->post('email')])->row_array();
    }

    function checksession()
    {
        return $this->db->get_where('students', ['email' => $this->session->userdata('email')])->row_array();
    }

    function registUser()
    {
        $data = [
            'name'         => htmlspecialchars($this->input->post('name', true)),
            'email'        => htmlspecialchars($this->input->post('email', true)),
            'nim'          => htmlspecialchars($this->input->post('nim', true)),
            'jurusan'      => htmlspecialchars($this->input->post('jurusan', true)),
            'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'image'        => 'default.png',
            'role_id'      => 2,
            'is_active'    => 0,
            'date_created' => time()
        ];

        $this->db->insert('students', $data);
    }
}
