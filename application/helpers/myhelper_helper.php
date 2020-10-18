<?php

function is_loggedin()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        redirect('Auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        $querymenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $querymenu['id'];

        $useraccess = $ci->db->get_where('user_access_menu', [
            'menu_id' => $menu_id,
            'role_id' => $role_id
        ]);

        if ($useraccess->num_rows() < 1) {
            redirect('Users/Blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
