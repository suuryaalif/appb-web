<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Options;
use Dompdf\Dompdf;
use FontLib\Table\Type\post;

class Item extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ini fungsi helper untuk mencegah login lewat url
        has_login();
        //panggil model userModel
        $this->load->model('userModel');
        $this->load->model('requestModel');
        $this->load->model('purchaseModel');
        $this->load->model('itemModel');
        $this->load->helper(array('url', 'form'));
    }

    public function index($id = null)
    {
        if ($id == null) {
            $data = [
                'item' => $this->itemModel->getItem(),
                'title' => 'Item Management',
                'user' => $this->userModel->get_user_session()
            ];
            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('itemMgm/index', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {
            $data = $this->itemModel->getItem($id);
            var_dump($data);
        }
    }

    public function add($id = null)
    {
        if ($id != null) {
            $data = [
                'title' => 'Edit Item',
                'user' => $this->userModel->get_user_session(),
                'dataItem' => $this->itemModel->getItem($id),
                'kode_po' => $this->itemModel->get_po(),
                'kode_ro' => $this->itemModel->get_ro(),
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('itemMgm/edit', $data);
            $this->load->view('homepage/layouts/footer', $data);
        } else {
            $data = [
                'kode_barang' => $this->itemModel->AutoCode(),
                'title' => 'Item Management',
                'kode_po' => $this->itemModel->get_po(),
                'kode_ro' => $this->itemModel->get_ro(),
                'user' => $this->userModel->get_user_session()
            ];

            $this->load->view('homepage/layouts/header', $data);
            $this->load->view('homepage/layouts/sidebar', $data);
            $this->load->view('homepage/layouts/topbar', $data);
            $this->load->view('itemMgm/add', $data);
            $this->load->view('homepage/layouts/footer', $data);
        }
    }

    public function save($id = null)
    {
        //Qr code codingan
        $this->load->library('ciqrcode'); //pemanggilan library QR CODE
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './assets/'; //string, the default is application/cache/
        $config['errorlog']     = './assets/'; //string, the default is application/logs/
        $config['imagedir']     = './assets/img/qr-barang/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
        $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $kode_barang = $this->input->post('kode_barang');
        $qr_name = $kode_barang . '-' . date('dmy') . '.png'; //buat name dari qr code sesuai dengan nim
        $params['data'] = $kode_barang; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH . $config['imagedir'] . $qr_name; //simpan image QR CODE ke folder assets
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        $itemData = $this->db->get_where('barang', array('id_barang' => $id))->row();
        $path = './assets/img/qr-barang/' . $itemData->qr_barang;
        $prev_qr = $itemData->qr_barang;

        if ($id == null) {
            if ($this->input->post('kategori_barang') == 'Perlengkapan') {
                $data = [
                    'kode_barang' => $this->input->post('kode_barang', true),
                    'kode_ro' => $this->input->post('kode_ro', true),
                    'kode_po' => $this->input->post('kode_po', true),
                    'kategori_barang' => $this->input->post('kategori_barang', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'nama_barang' => $this->input->post('nama_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_barang' => $this->input->post('qty_barang', true),
                    'sat_barang' => $this->input->post('sat_barang', true),
                    'tgl_terima' => $this->input->post('tgl_terima', true),
                    'tgl_input' => time(),
                    'qr_barang' => 'default.png'
                ];

                $this->db->insert('barang', $data);
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat !</strong> anda berhasil menambahkan data barang.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('item');
            } else {
                $data = [
                    'kode_barang' => $this->input->post('kode_barang', true),
                    'kode_ro' => $this->input->post('kode_ro', true),
                    'kode_po' => $this->input->post('kode_po', true),
                    'kategori_barang' => $this->input->post('kategori_barang', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'nama_barang' => $this->input->post('nama_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_barang' => $this->input->post('qty_barang', true),
                    'sat_barang' => $this->input->post('sat_barang', true),
                    'tgl_terima' => $this->input->post('tgl_terima', true),
                    'tgl_input' => time(),
                    'qr_barang' => $qr_name
                ];
                $this->db->insert('barang', $data);
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat !</strong> anda berhasil menambahkan data barang.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('item');
            }
        } else {
            //mengecek kalau gambar yang lamanya default berarti dia gak di hapus gambarnya
            if ($prev_qr != 'default.png') {
                unlink($path);
                $data = [
                    'kategori_barang' => $this->input->post('kategori_barang', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'nama_barang' => $this->input->post('nama_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_barang' => $this->input->post('qty_barang', true),
                    'sat_barang' => $this->input->post('sat_barang', true),
                    'tgl_terima' => $this->input->post('tgl_terima', true),
                    'tgl_input' => time(),
                    'qr_barang' => 'default.png'
                ];

                $this->itemModel->update($id, $data);
                $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat !</strong> anda berhasil merubah data barang.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
                redirect('item');
            } else {
                $data = [
                    'kategori_barang' => $this->input->post('kategori_barang', true),
                    'jenis_barang' => $this->input->post('jenis_barang', true),
                    'nama_barang' => $this->input->post('nama_barang', true),
                    'desk_barang' => $this->input->post('desk_barang', true),
                    'qty_barang' => $this->input->post('qty_barang', true),
                    'sat_barang' => $this->input->post('sat_barang', true),
                    'tgl_terima' => $this->input->post('tgl_terima', true),
                    'tgl_input' => time(),
                    'qr_barang' => $qr_name
                ];
                $this->itemModel->update($id, $data);
                $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat !</strong> anda berhasil merubah data barang.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
                redirect('item');
            }
        }
    }

    public function delete($id)
    {
        $itemData = $this->db->get_where('barang', array('id_barang' => $id))->row();
        $path = './assets/img/qr-barang/' . $itemData->qr_barang;
        $prev_qr = $itemData->qr_barang;

        if ($prev_qr == 'default.png') {
            $this->itemModel->delete($id);
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Berhasil Dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('item');
        } else {
            unlink($path);
            $this->itemModel->delete($id);
            $this->session->set_flashdata('msg', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Data Berhasil Dihapus.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('item');
        }
    }

    public function save_pdf($id)
    {
        $row_barang = $this->db->get_where('barang', array('id_barang' => $id))->row();
        $kode_barang = $row_barang->kode_barang;
        $data = [
            'title' => 'Purchase Order',
            'user' => $this->userModel->get_user_session(),
            'dataItem' => $this->itemModel->getItem($id)
        ];

        $sroot      = $_SERVER['DOCUMENT_ROOT'];
        include $sroot . "/appb-web/application/third_party/dompdf/autoload.inc.php";

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $this->load->view('itemMgm/pdf', $data);
        $paper_size = 'A6'; // ukuran kertas
        $orientation = 'landscape'; //tipe format kertas potrait atau landscape
        $html = $this->output->get_output();
        $dompdf->setPaper($paper_size, $orientation);
        //Convert to PDF
        $dompdf->loadHtml($html);
        $dompdf->render();
        ob_end_clean();
        $dompdf->stream("label-" . $kode_barang . "-pdf", array('Attachment' => 0));
        // nama file pdf yang di hasilkan
    }
}
