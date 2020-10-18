<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Authmodel', 'Auth');
    }

    function index()
    {
        if ($this->session->userdata('email')) {
            redirect('Users');
        }

        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('auth_header', $data);
            $this->load->view('loginview');
            $this->load->view('auth_footer');
        } else {
            $this->loginCode();
        }
    }

    function Logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        redirect('Auth');
    }

    function Registration()
    {
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[students.email]', ['is_unique' => 'This email already registered']);
        $this->form_validation->set_rules('nim', 'nim', 'required|trim|numeric');
        $this->form_validation->set_rules('password1', 'password', 'required|trim|matches[password2]|min_length[3]', ['min_length' => 'Your password too short!', 'matches' => 'Your password dont match!']);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration Page';
            $data['jurusan'] = ['IT', 'Agroculture', 'Engineering', 'Art', 'Law', 'Business'];

            $this->load->view('auth_header', $data);
            $this->load->view('registview', $data);
            $this->load->view('auth_footer');
        } else {
            $this->Auth->registUser();

            $token = base64_encode(random_bytes(32));

            $usertoken = [
                'email' => $this->input->post('email'),
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $usertoken);
            $this->_sendemail($token, 'Verify');
            $this->session->set_flashdata('message', 'Your account has been created, please check your email to activate it!');
            redirect('Auth');
        }
    }

    function Verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('students', ['email' => $email])->row_array();

        if ($user) {

            $usertoken = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($usertoken) {
                if (time() - $user['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('students');

                    $this->db->delete('user_token', ['token' => $token]);
                    $this->session->set_flashdata('message', 'Account activation success, ready to go now!');
                    redirect('Auth');
                } else {
                    $this->db->delete('students', ['email' => $email]);
                    $this->db->delete('user_token', ['token' => $token]);

                    $this->session->set_flashdata('message', 'Account activation failed, token expired!');
                    redirect('Auth');
                }
            } else {
                $this->session->set_flashdata('message', 'Account activation failed, wrong token!');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', 'Account activation failed, wrong email!');
            redirect('Auth');
        }
    }

    function Forgotpass()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $this->load->view('auth_header', $data);
            $this->load->view('forgotpassview');
            $this->load->view('auth_footer');
        } else {
            $email = $this->input->post('email');
            $user  = $this->db->get_where('students', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));

                $usertoken = [
                    'token' => $token,
                    'email' => $email,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $usertoken);
                $this->_sendemail($token, 'Forgot');

                $this->session->set_flashdata('message', 'Check your email to reset your password!');
                redirect('Auth');
            } else {
                $this->session->set_flashdata('message', 'Reset password failed, your email isnt registered!');
                redirect('Auth/Forgotpass');
            }
        }
    }

    function Resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user  = $this->db->get_where('students', ['email' => $email])->row_array();

        if ($user) {
            $usertoken = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($usertoken) {
                $this->session->set_userdata('resetpass', $email);
                $this->Changepass();
            } else {
                $this->session->set_flashdata('message', 'Reset password failed, wrong token!');
                redirect('Auth/Forgotpass');
            }
        } else {
            $this->session->set_flashdata('message', 'Reset password failed, your email isnt registered!');
            redirect('Auth/Forgotpass');
        }
    }

    function Changepass()
    {
        if (!$this->session->userdata('resetpass')) {
            redirect('Auth');
        }

        $this->form_validation->set_rules('password1', 'password', 'required|trim|matches[password2]|min_length[3]', ['min_length' => 'Your password too short!', 'matches' => 'Your password dont match']);
        $this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $this->load->view('auth_header', $data);
            $this->load->view('resetpassview');
            $this->load->view('auth_footer');
        } else {
            $email = $this->session->userdata('resetpass');
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('students');

            $this->db->delete('user_token', ['email' => $email]);
            $this->session->unset_userdata('resetpass');
            $this->session->set_flashdata('message', 'Your password has been changed, ready to go now!');
            redirect('Auth');
        }
    }

    private function _sendemail($token, $type)
    {
		// This verification and reset password using smtp
		
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'your email..',
            'smtp_pass' => 'your email pass..',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->email->initialize($config);
        $this->email->from('your email..', 'name/aliases for your email..');
        $this->email->to($this->input->post('email'));

        if ($type == 'Verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'Auth/Verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">HERE</a>');
        } elseif ($type == 'Forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'Auth/Resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">HERE</a>');
        }

        $this->email->send();
    }

    function loginCode()
    {
        $user = $this->Auth->dataCheck();

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($this->input->post('password'), $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                } else {
                    $this->session->set_flashdata('message', 'Login failed, wrong password!');
                    redirect('Auth');
                }
                if ($user['role_id'] == 1) {
                    redirect('Admin');
                } else {
                    redirect('Users');
                }
            } else {
                $this->session->set_flashdata('message', 'Login failed, your account isnt activated!');
                redirect('Auth');
            }
        } else {
            $this->session->set_flashdata('message', 'Login failed, your account isnt registered!');
            redirect('Auth');
        }
    }
}
