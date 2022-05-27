<?php

function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('email');
    if ($user_session) {
        redirect('marketing');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('email');
    if (!$user_session) {
        redirect('auth');
    }
}

function check_marketing()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 1) {
        redirect('auth/logout');
    }
}

function check_kasir()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 2) {
        redirect('auth/logout');
    }
}

function check_portir()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 3) {
        redirect('auth/logout');
    }
}

function check_konsumen()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 4) {
        redirect('auth/logout');
    }
}
