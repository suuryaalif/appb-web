<?php

function has_login()
{
    $ci = get_instance();

    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Ooow anda belum login!</strong> silahkan login.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
        redirect('auth');
    }
}
