<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelusers extends CI_Model
{

    function checkdata()
    {
        return $this->db->get_where('students', ['email' => $this->session->userdata('email')])->row_array();
    }

    function changepass()
    {
        $newpass = $this->input->post('newpass1');
        $password_hash = password_hash($newpass, PASSWORD_DEFAULT);

        $this->db->set('password', $password_hash);
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('students');
    }

    function getallmenu()
    {
        return $this->db->get_where('user_menu')->result_array();
    }

    function getsubmenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                      ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                 ";

        return $this->db->query($query)->result_array();
    }

    // MODEL UNTUK CONTROLLER ADMIN

    function insertsub()
    {
        $data = [
            'menu_id' => $this->input->post('menu_id'),
            'title' => $this->input->post('title'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ];

        $this->db->insert('user_sub_menu', $data);
    }

    function getallrole()
    {
        return $this->db->get('user_role')->result_array();
    }

    function getalldata()
    {
        return $this->db->get('students')->result_array();
    }

    function getstudentid($id)
    {
        return $this->db->get_where('students', ['id' => $id])->row_array();
    }

    function updatestudent()
    {
        $data = [
            'nim' => $this->input->post('nim'),
            'name' => $this->input->post('name'),
            'jurusan' => $this->input->post('jurusan')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('students', $data);
    }

    function deletestudent($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('students');
    }

    // AKHIR MODEL CONTROLLER ADMIN
}
