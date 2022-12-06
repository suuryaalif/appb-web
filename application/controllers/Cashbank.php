<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Options;
use Dompdf\Dompdf;
use FontLib\Table\Type\post;

class Cashbank extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        //cek apakah user payment tidak bisa akses
        if ($this->session->userdata('role_id') == 3 or $this->session->userdata('role_id') == 2) {
            redirect('home/error_choice');
        }
        $this->load->model('requestModel');
        $this->load->model('userModel');
        $this->load->model('purchaseModel');
        $this->load->model('cashbankModel');
        $this->load->model('supplierModel');
        $this->load->helper(array('url', 'form', 'number'));
    }

    public function index()
    {
        $data = [
            'title' => 'Cashbank Requestion',
            'user' => $this->userModel->get_user_session(),
            'cashbank' => $this->cashbankModel->get_cbr()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('cashbank/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function detail()
    {
        $id = $this->uri->segment(3);
        $kode_ro = $this->uri->segment(4);
        $kode_po = $this->uri->segment(5);

        $data = [
            'title' => 'Cashbank Requestion',
            'user' => $this->userModel->get_user_session(),
            'cashbank' => $this->cashbankModel->get_cbr($id),
            'data_ro' => $this->requestModel->get_detailbyKode($kode_ro),
            'data_po' => $this->purchaseModel->get_detailbyCode($kode_po)
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('cashbank/detail_cbr', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_pay_data()
    {
        $data = [
            'title' => 'Data Pembayaran',
            'user' => $this->userModel->get_user_session(),
            'payment' => $this->cashbankModel->get_pay()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('cashbank/data_payment', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }


    public function get_form_create()
    {
        $data = [
            'title' => 'Create CBR',
            'kodeotomatis' => $this->cashbankModel->AutoCode(),
            'user' => $this->userModel->get_user_session(),
            'kodero' => $this->purchaseModel->get_ro(),
            'supplier' => $this->purchaseModel->get_sup(),
            'kodepo' => $this->cashbankModel->get_po()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('cashbank/create_cbr', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function add_new()
    {
        $this->form_validation->set_rules('biaya', 'Biaya', 'required|numeric', [
            'numberic' => 'hanya angka saja',
            'required' => 'harap diisi'
        ]);
        $this->form_validation->set_rules('kode_req', 'Kode_ro', 'required', [
            'required' => 'anda belum memilih'
        ]);
        $this->form_validation->set_rules('kode_pur', 'kode_po', 'required', [
            'required' => 'anda belum memilih'
        ]);
        $this->form_validation->set_rules('desk_cbr', 'desk_cbr', 'required', [
            'required' => 'harap isi kolom deskripsi'
        ]);
        $this->form_validation->set_rules('tgl_cbr', 'tanggal_cbr', 'required', [
            'required' => 'anda belum memilih'
        ]);

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Create CBR',
                'kodeotomatis' => $this->cashbankModel->AutoCode(),
                'user' => $this->userModel->get_user_session(),
                'kodero' => $this->purchaseModel->get_ro(),
                'supplier' => $this->purchaseModel->get_sup(),
                'kodepo' => $this->cashbankModel->get_po()
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('cashbank/create_cbr', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {
            $data = [
                'kode_cbr' => $this->input->post('kode_cbr', true),
                'kode_req' => $this->input->post('kode_req', true),
                'kode_pur' => $this->input->post('kode_pur', true),
                'desk_cbr' => $this->input->post('desk_cbr', true),
                'biaya' => $this->input->post('biaya', true),
                'id_supplier' => $this->input->post('id_supplier', true),
                'tempo_byr' => $this->input->post('tempo_byr', true),
                'cara_byr' => $this->input->post('cara_byr', true),
                'tgl_cbr' => $this->input->post('tgl_cbr', true),
                'status_cbr' => '1',
                'created_at' => time()
            ];

            $this->cashbankModel->add_cbr($data);
            $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data ditambahkan !</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('cashbank');
        }
    }

    public function get_edit($id)
    {
        $data_id = $this->db->get_where('cashbank_requestion', array('id_cbr' => $id))->row_array();

        if ($data_id['status_cbr'] > 2) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>maaf data telah disetujui/diproses anda tidak bisa edit!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect('cashbank');
        } else {
            $data = [
                'title' => 'Create CBR',
                'user' => $this->userModel->get_user_session(),
                'cashbank' => $this->cashbankModel->get_cbr($id),
                'kodero' => $this->purchaseModel->get_ro(),
                'supplier' => $this->purchaseModel->get_sup(),
                'kodepo' => $this->cashbankModel->get_po()
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('cashbank/edit_cbr', $data);
            $this->load->view('homepage/layouts/footer', $data);
        }
    }

    public function update_cbr($id)
    {
        $data = [
            'kode_req' => $this->input->post('kode_req', true),
            'kode_pur' => $this->input->post('kode_pur', true),
            'desk_cbr' => $this->input->post('desk_cbr', true),
            'biaya' => $this->input->post('biaya', true),
            'id_supplier' => $this->input->post('id_supplier', true),
            'tempo_byr' => $this->input->post('tempo_byr', true),
            'cara_byr' => $this->input->post('cara_byr', true),
            'tgl_cbr' => $this->input->post('tgl_cbr', true),
            'status_cbr' => '1',
            'created_at' => time()
        ];

        $this->cashbankModel->update($id, $data);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data diubah !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('cashbank');
    }

    public function delete_cbr($id)
    {
        $data_id = $this->db->get_where('cashbank_requestion', array('id_cbr' => $id))->row_array();

        if ($data_id['status_cbr'] > 2) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>maaf data telah disetujui/diproses, tidak bisa dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');

            redirect('cashbank');
        } else {
            $this->cashbankModel->delete($id);
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data dihapus !</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('cashbank');
        }
    }

    public function approve($id)
    {

        $this->cashbankModel->approve($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Disetujui ! berhasil menyetujui cashbank requestion</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('cashbank');
    }

    public function reject($id)
    {
        $this->cashbankModel->reject($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Ditolak ! berhasil menolak cashbank requestion</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('cashbank');
    }

    public function get_form_confirm()
    {
        $id_cbr = $this->uri->segment(3);
        $status = $this->db->get_where('cashbank_requestion', array('id_cbr' => $id_cbr))->row_array();

        if ($status['status_cbr'] < 3) {
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Permintaan Ditolak! CBR harus sudah disetujui</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('cashbank');
        } else {

            $data = [
                'title' => 'Payment Confirmation',
                'user' => $this->userModel->get_user_session(),
                'kodeotomatis' => $this->cashbankModel->AutoCodePayment(),
                'cashbank' => $status,
            ];


            // var_dump($data);
            // die;

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('cashbank/confirm_pay', $data);
            $this->load->view('homepage/layouts/footer', $data);
        }
    }

    public function save_confirm()
    {
        $id_cbr = $this->uri->segment(3);
        $kode_ro = $this->uri->segment(4);
        $kode_po = $this->uri->segment(5);
        $back = $id_cbr . '/' . $kode_ro . '/' . $kode_po;

        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/foto-bayar/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '5000';
        $config['max_width'] = '3000';
        $config['max_height'] = '3000';
        $config['file_name'] = 'img-paid-' . date('dmY_His') . '.jpg';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('bukti_byr')) {
            $error_msg = $this->upload->display_errors();
            $this->session->set_flashdata('error', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>' . $error_msg . '</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('cashbank/get_form_confirm/' . $back, $error_msg);
        } else {
            $image = $this->upload->data();
            $gambar = $image['file_name'];

            $data = [
                'kode_byr' => $this->input->post('kode_byr', true),
                'kode_cbr' => $this->input->post('kode_cbr', true),
                'total_byr' => $this->input->post('total_byr', true),
                'tgl_byr' => $this->input->post('tgl_byr', true),
                'bukti_byr' => $gambar
            ];

            $this->cashbankModel->add_pay($data);
            $this->cashbankModel->set_confirm($id_cbr);

            redirect('cashbank');
        }
    }

    public function save_pdf()
    {
        $id = $this->uri->segment(3);
        $kode_ro = $this->uri->segment(4);
        $kode_po = $this->uri->segment(5);
        $user_pay = $this->cashbankModel->approval_name();

        $data = [
            'title' => 'Cashbank Download',
            'user' => $this->userModel->get_user_session(),
            'cashbank' => $this->cashbankModel->get_cbr($id),
            'data_ro' => $this->requestModel->get_requestbyKode($kode_ro),
            'data_detail_ro' => $this->requestModel->get_detailbyKode($kode_ro),
            'approval_pay' => $user_pay['nama'],
            'approval_qr' => $user_pay['qr_sign'],
            'data_po' => $this->db->get_where('purchase_order', array('kode_po' => $kode_po))->result_array(),
            'data_detail_po' => $this->purchaseModel->get_detailbyCode($kode_po)
        ];

        // var_dump($data['approval_qr']);
        // die;

        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/appb-web/application/third_party/dompdf/autoload.inc.php";

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $this->load->view('cashbank/pdf', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->setPaper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("cashbank.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }

    public function download_bukti()
    {
        $id = $this->uri->segment(3);
        $cbr = $this->cashbankModel->get_ro($id);
        $qr_usrpay = $this->cashbankModel->get_qr_usp();
        $id_sp = $cbr['id_supplier'];
        $kd_po = $cbr['kode_pur'];

        $data = [
            'title' => 'Bukti Pembayaran',
            'user' => $this->userModel->get_user_session(),
            'payment' => $this->cashbankModel->get_pay($id),
            'qr_aprv' => $qr_usrpay['qr_sign'],
            'supplier' => $this->supplierModel->get_data($id_sp),
            'data_po' => $this->db->get_where('purchase_order', array('kode_po' => $kd_po))->result_array()
        ];
        // var_dump($data['qr_aprv']);
        // die;

        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/appb-web/application/third_party/dompdf/autoload.inc.php";

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $this->load->view('cashbank/payment_pdf', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->setPaper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("paymentinfo.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
