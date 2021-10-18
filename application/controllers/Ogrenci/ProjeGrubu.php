<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjeGrubu extends CI_Controller { // kod karışık düzeltilmeli.

    public function __construct()
    {
        parent:: __construct();
        {
            $this->guvenlik();
            $this->load->helper(array('form', 'url'));
        }
    }
    function guvenlik(){
        $kontrol = $this->session->userdata('kontrol');
        if(!isset($kontrol) || $kontrol != true){
            redirect('Yonetim');
        }
        else{ }
    }
    public function index()
    {
        $kontrol = $this->session->userdata('info');
        $projeKodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= ".$kontrol->ID."");
        if($projeKodu->row()->projeKodu==null){
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Hata!</h4>
                    Bir projeniz yok yada proje grubuna ekli değilsiniz.
                    </div>');
            redirect('Ogrenci/Home/projeEkle');
        }else{
            $this->load->model('ogrmodel');
            $inf = $this->ogrmodel->projeGrubuGetir($projeKodu->row()->projeKodu);
            $data = new stdClass;
            $data->inf=$inf;
            $this->load->view('ogrenci/projeGrubu/uyeListesi',$data);
        }

    }
    public function uyeEkle()
    {
        $kontrol = $this->session->userdata('info');
        $projeKodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= ".$kontrol->ID."");
        if($projeKodu->row()->projeKodu==null) {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Hata!</h4>
                    Bir projeniz yok yada proje grubuna ekli değilsiniz.
                    </div>');
            redirect('Ogrenci/Home/projeEkle');
        }else{
            $this->load->model('akdmodel');
            $inf = $this->akdmodel->akademisyenOgrencileri($kontrol->hocaID);
            $data = new stdClass;
            $data->inf = $inf;
            $this->load->view('ogrenci/projeGrubu/uyeEkle', $data);
        }
    }
    public function ekle() // button event
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('students[]', 'Group', 'required');
        if ($this->form_validation->run()) {
            $students = $this->input->post('students'); //formdan veri alınır.
            $kontrol = $this->session->userdata('info');
            $projeKodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");
            $data = array(
                'projeKodu'=>$projeKodu->row()->projeKodu
            );
            foreach ($students as $ID){
                $this->load->model('ogrmodel');
                echo $ID." - ";
                $sonc = $this->ogrmodel->ogrGuncelle($data,$ID);
            }
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                    Üye Ekleme İşlemi Başarılı
                    </div>');
            redirect('Ogrenci/projeGrubu');

        }
        else{
            $this->index();
        }
    }
    public function gruptanCik()
    {
        $kontrol = $this->session->userdata('info');
        $data = array(
            'projeKodu'=> null
        );
        $this->load->model('ogrmodel');
        $sonuc = $this->ogrmodel->gruptanCik($data,$kontrol->ID);
        if($sonuc)
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                    Gruptan çıkma başarılı
                    </div>');
            redirect('Ogrenci/Home/projeEkle');
        }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                    İşlem bilinmeyen bir sebeple başarısız oldu. Yöneticiyle iletişime geçin.
                    </div>');
            redirect('Ogrenci/Home/projeEkle');
        }


    }

}