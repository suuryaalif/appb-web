<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Options;
use Dompdf\Dompdf;
use FontLib\Table\Type\post;

class Purchaseorder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        if ($this->session->userdata('role_id') != 1) {
            redirect('home/error_choice');
        }
        //panggil model
        $this->load->model('userModel');
        $this->load->model('requestModel');
        $this->load->model('purchaseModel');
        $this->load->helper(array('url', 'form'));
    }

    public function index()
    {
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'PO' => $this->purchaseModel->get_data()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/index', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function detail($kode_po = null)
    {
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'data_purchase' => $this->purchaseModel->get_PobyCode($kode_po),
            'detail_purchase' => $this->purchaseModel->get_detailbyCode($kode_po),
            'kode' => $kode_po
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/detailPo', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_formPrePo()
    {
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'kodeotomatis' => $this->purchaseModel->AutoCode(),
            'temp_po' => $this->purchaseModel->get_tempPo()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/prePo', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function get_formFinPo()
    {
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'kodeotomatis' => $this->purchaseModel->AutoCode(),
            'temp_po' => $this->purchaseModel->get_tempPo(),
            'supplier' => $this->purchaseModel->get_sup(),
            'ro' => $this->purchaseModel->get_ro()
        ];

        // var_dump($data['supplier']);
        // die;

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/finPo', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function save_temp_detail()
    {
        $this->form_validation->set_rules('qty_order', 'Qty_order', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Purchase Order',
                'user' => $this->userModel->get_user_session(),
                'kodeotomatis' => $this->purchaseModel->AutoCode(),
                'temp_po' => $this->purchaseModel->get_tempPo()
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('purchaseorder/prePo', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {

            $data = [
                'kode_purchase' => $this->input->post('kode_purchase', true),
                'jenis_barang' => $this->input->post('jenis_barang', true),
                'desk_barang' => $this->input->post('desk_barang', true),
                'qty_order' => $this->input->post('qty_order', true),
                'sat_order' => $this->input->post('sat_order', true)
            ];
            $this->db->insert('temp_po', $data);
            $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data ditambahkan !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
            redirect('purchaseorder/get_formPrePo');
        }
    }

    public function save_po($kode_po)
    {
        $data = [
            'kode_po' => $this->input->post('kode_po', true),
            'kode_ro' => $this->input->post('kode_ro', true),
            'desk_po' => $this->input->post('desk_po', true),
            'id_supplier' => $this->input->post('id_sup', true),
            'tgl_po' => $this->input->post('tgl_po', true)
        ];

        $this->purchaseModel->post_detail($kode_po);
        $this->db->insert('purchase_order', $data);
        $this->db->truncate('temp_po');

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Purchase Order berhasil dibuat !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder');
    }

    public function delete_temp_detail($id)
    {
        $this->purchaseModel->delete_tempByID($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data dihapus !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder/get_formPrePo');
    }

    public function save_po_edited($kode)
    {
        $data = [
            'kode_po' => $this->input->post('kode_po', true),
            'kode_ro' => $this->input->post('kode_ro', true),
            'desk_po' => $this->input->post('desk_po', true),
            'id_supplier' => $this->input->post('id_sup', true),
            'tgl_po' => $this->input->post('tgl_po', true)
        ];
        $this->purchaseModel->update_po($data, $kode);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Purchase Order berhasil diubah !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder/detail/' . $kode);
    }

    public function edit_detail($id)
    {
        $kode = $this->purchaseModel->get_kodebyID($id);
        $data = [
            'title' => 'Edit PO',
            'user' => $this->userModel->get_user_session(),
            'kode_po' => $kode['kode_purchase'],
            'detail_po' => $this->purchaseModel->get_detailbyID($id),
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/edit_detail', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function update_detail($id)
    {
        $kode_po = $this->input->post('kode_purchase');
        $data = [
            'kode_purchase' => $this->input->post('kode_purchase', true),
            'jenis_barang' => $this->input->post('jenis_barang', true),
            'desk_barang' => $this->input->post('desk_barang', true),
            'qty_order' => $this->input->post('qty_order', true),
            'sat_order' => $this->input->post('sat_order', true)
        ];
        $this->purchaseModel->update_detail($data, $id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Detail diubah !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder/detail/' . $kode_po);
    }

    public function delete_detail($id)
    {
        $kode = $this->purchaseModel->get_kodebyID($id);
        $kode_po = $kode['kode_purchase'];
        $this->purchaseModel->delete_detail($id);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Detail dihapus !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder/detail/' . $kode_po);
    }

    function delete_po($kode_po)
    {
        $this->purchaseModel->delete_all_detail($kode_po);
        $this->purchaseModel->delete_po($kode_po);
        $this->session->set_flashdata('msg', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data PO dihapus !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('purchaseorder');
    }

    public function form_add_detail($kode_po)
    {
        $data = [
            'title' => 'Tambah Detail PO',
            'user' => $this->userModel->get_user_session(),
            'kode_po' => $kode_po,
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/add_detail', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function form_edit_po($kode_po)
    {
        $data = [
            'title' => 'Tambah Detail PO',
            'user' => $this->userModel->get_user_session(),
            'kode_po' => $kode_po,
            'data_po' => $this->purchaseModel->get_PobyCode($kode_po),
            'supplier' => $this->purchaseModel->get_sup(),
            'ro' => $this->purchaseModel->get_ro()
        ];

        $this->load->view('homepage/layouts/header', $data);
        $this->load->view('homepage/layouts/sidebar', $data);
        $this->load->view('homepage/layouts/topbar', $data);
        $this->load->view('purchaseorder/edit_purchase', $data);
        $this->load->view('homepage/layouts/footer', $data);
    }

    public function add_detail()
    {
        $kode_purchase = $this->input->post('kode_purchase');
        $this->form_validation->set_rules('qty_order', 'Qty_order', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Detail PO',
                'user' => $this->userModel->get_user_session(),
                'kode_po' => $kode_purchase,
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('purchaseorder/add_detail', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {

            $data = [
                'kode_purchase' => $this->input->post('kode_purchase', true),
                'jenis_barang' => $this->input->post('jenis_barang', true),
                'desk_barang' => $this->input->post('desk_barang', true),
                'qty_order' => $this->input->post('qty_order', true),
                'sat_order' => $this->input->post('sat_order', true)
            ];
            $this->db->insert('detail_purchase', $data);
            $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data ditambahkan !</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
            redirect('purchaseorder/detail/' . $kode_purchase);
        }
    }
    public function save_pdf($kode_po)
    {
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'data_purchase' => $this->purchaseModel->get_PobyCode($kode_po),
            'detail_purchase' => $this->purchaseModel->get_detailbyCode($kode_po),
            'kode' => $kode_po
        ];

        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/appb-web/application/third_party/dompdf/autoload.inc.php";

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $this->load->view('purchaseorder/pdfPo', $data);
        $paper_size = 'A4'; // ukuran kertas
        $orientation = 'potrait'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->setPaper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("purchaseorder.pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
