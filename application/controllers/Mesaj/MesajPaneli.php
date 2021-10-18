<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MesajPaneli extends CI_Controller {

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
            //$this->load->view('yonetim/login');
        }
        else{

        }
    }
    public function index()
    {
        $this->load->view('mesaj/gelenKutusu');
    }
    public function gelenKutusu()
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki == 1) // oturum sahibi akademisyen ise ogr'den mesaj alır.
        {
            $kontrol = $this->session->userdata('info');
            $this->load->model('vtmodel');
            $cekilenVeri = $this->vtmodel->mesajByID($kontrol->ID);
            if($cekilenVeri)
            {
                $data = new stdClass;
                $data->bilgi=$cekilenVeri;
                $veri = array();
                $isimler = array();

                for($i=0;$i<sizeof($cekilenVeri);$i++)
                {
                    $veri[$i]=$cekilenVeri[$i]->gidenID;
                    $this->load->model('admmodel');
                    $ogrbilgisi = $this->admmodel->ogrenciByID($veri[$i]);
                    $isimler[$i]= $ogrbilgisi->adiSoyadi;
                }
                $data->isimler=$isimler;

                $this->load->view('mesaj/gelenKutusu',$data);
            }
            else{
                $data = new stdClass;
                $data->bilgi=null;
                $this->load->view('mesaj/gelenKutusu',$data);
            }


        }
        elseif($kontrol->yetki == 2) // oturum sahibi ogrenci ise akademisyenden'den mesaj alır.
        {
            $kontrol = $this->session->userdata('info');
            $this->load->model('vtmodel');
            $cekilenVeri = $this->vtmodel->mesajByID($kontrol->ID);
            if($cekilenVeri)
            {
                $data = new stdClass;
                $data->bilgi=$cekilenVeri;
                $veri = array();
                $isimler = array();

                for($i=0;$i<sizeof($cekilenVeri);$i++)
                {
                    $veri[$i]=$cekilenVeri[$i]->gidenID;
                    $this->load->model('admmodel');
                    $ogrbilgisi = $this->admmodel->akademisyenByID($veri[0]);
                    $isimler[$i]= $ogrbilgisi->adiSoyadi;
                }
                $data->isimler=$isimler;
                $this->load->view('mesaj/gelenKutusu',$data);
            }
            else{
                $data = new stdClass;
                $data->bilgi=null;
                $this->load->view('mesaj/gelenKutusu',$data);
            }

        }
        else{
            $this->load->view('yonetim/errorPage/401');
        }
    }

    public function mesajGonderindex()
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki==2)
        {
            $this->load->model('akdmodel');
            $inf=$this->akdmodel->akdGetir();
            $data = new stdClass;
            $data->bilgi=$inf;
            $this->load->view('mesaj/mesajGonder',$data);
        }else if($kontrol->yetki==1)
        {
            $this->load->model('admmodel');
            $inf=$this->admmodel->ogrenciListesi();
            $data = new stdClass;
            $data->bilgi=$inf;
            $this->load->view('mesaj/mesajGonder',$data);
        }
        else // yetkisiz giris logtut
        {
            $this->load->view('yonetim/errorPage/401');
        }

    }
    public function mesajGonder()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('baslik', 'Konu', 'required|trim|max_length[25]');
        $this->form_validation->set_rules('icerik', 'İçerik', 'required|trim');
        if ($this->form_validation->run() == true) {
            $kontrol = $this->session->userdata('info');
            $gonderen = $kontrol->adiSoyadi;
            $giden = $this->input->post('kime');
            $baslik = $this->input->post('baslik');
            $icerik = $this->input->post('icerik');
            $gidenID = null;
            $gonderenID = null;
            if ($kontrol->yetki == 1) {
                $result = $this->db->select('*')
                    ->from('ogrenci')
                    ->where('adiSoyadi', $giden)
                    ->get()
                    ->row();
                $gidenID = $result->ID;
                $data = array('gidenID' => $kontrol->ID,
                    'gelenID' => $gidenID,
                    'baslik' => $baslik,
                    'icerik' => $icerik
                );
                $this->load->model('vtmodel');
                $insert = $this->vtmodel->mesajGonder($data);
            } else if ($kontrol->yetki == 2) {
                $result = $this->db->select('*')
                    ->from('akademisyen')
                    ->where('adiSoyadi', $giden)
                    ->get()
                    ->row();
                $gidenID = $result->ID;
                $data = array('gidenID' => $kontrol->ID,
                    'gelenID' => $gidenID,
                    'baslik' => $baslik,
                    'icerik' => $icerik
                );
                $this->load->model('vtmodel');
                $insert = $this->vtmodel->mesajGonder($data);
            } else // yetkisiz giriş logtut
            {
                $this->load->view('yonetim/errorPage/401');
            }
            if (isset($insert)) {
                $this->session->set_flashdata('ekleBasari', '<div id="alertMesaj" class="alert alert-info">
                       <button style="margin-left:5px;" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Mesaj Başarıyla Gönderildi.                        
                    </div>');
                redirect('mesaj/gelenKutusu');
            } else {
                $this->session->set_flashdata('validError', '<div style="margin:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
            Mesaj Gönderilemedi.
            </div>');
                redirect('mesaj/gelenKutusu');
            }
        }else {
            $this->session->set_flashdata('validError', '<div style="margin:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Hata!</h4>'.validation_errors().'</div>');
            redirect('mesaj/gelenKutusu');
        }
    }
    public function mesajOku($id)
    {
        $okundu = "true";
        $data = array('okundu'=>$okundu
        );
        $result=$this->db->update('mesaj',$data,array('ID'=>$id));
        // //
        $this->load->model('vtmodel');
        $inf=$this->vtmodel->mesajOku($id);
        $kontrol = $this->session->userdata('info');
        $this->load->model('admmodel');
        if($kontrol->yetki==1)
        {
            $inf2=$this->admmodel->ogrenciByID($inf->gidenID);
        }else if($kontrol->yetki==2){
            $inf2=$this->admmodel->akademisyenByID($inf->gidenID);
        }else{// yetkisiz giriş logtut
            $this->load->view('yonetim/errorPage/401');
        }
        if($inf)
        {
            $data['inf']=$inf;
            $data['inf2']=$inf2;
            $this->load->view('mesaj/mesajOku',$data);
        }else{ // veritabanı hatası logtut
            $this->load->view('yonetim/errorPage/500');
        }
    }
    public function mesajSil($id)
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki==1 || $kontrol->yetki==2 ) {
            $this->load->model('vtmodel');
            $delete = $this->vtmodel->mesajSil($id);
            if (isset($delete)) {
                $this->session->set_flashdata('ekleBasari','<div id="alertMesaj" class="alert alert-info">
                       <button style="margin-left:5px;" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Mesaj Başarıyla Silindi.                        
                    </div>');
                redirect('mesaj/gelenKutusu');
            }else{ // veritabanı hatası logtut
                $this->load->view('yonetim/errorPage/500');
            }
        }else{ //yetkisiz giriş logtut
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function mesajCevapla($id)
    {
        $this->load->model('vtmodel');
        $inf=$this->vtmodel->mesajOku($id);
        $kontrol = $this->session->userdata('info');
        $this->load->model('admmodel');
        if($kontrol->yetki==1)
        {
            $inf2=$this->admmodel->ogrenciByID($inf->gidenID);
        }else if($kontrol->yetki==2){
            $inf2=$this->admmodel->akademisyenByID($inf->gidenID);
        }
        if(isset($inf))
        {
            $data['inf']=$inf;
            $data['inf2']=$inf2;
            $this->load->view('mesaj/mesajCevapla',$data);
        }else{ //veritabanı hatası logtut.
            $this->load->view('yonetim/errorPage/500');
        }
    }

}
