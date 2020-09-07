<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Register extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
    }

    public function index()
    {
        $this->load->view('register');
    }

    public function proses()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[2]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[2]');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[2]');

        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->auth->register($username, $password, $nama);
            $this->session->set_flashdata('success_register', 'Proses pendaftaran user berhasil');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('register');
        }
    }
}
