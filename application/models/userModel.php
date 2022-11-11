<?php
defined('BASEPATH') or exit('No direct script access allowed');

class userModel extends CI_Model
{
    public function get_user_session()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }
}
