<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AkademisyenPaneli extends CI_Controller {

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
        $kontrol2 = $this->session->userdata('info');
        if(!isset($kontrol)|| $kontrol!=true)
        {
            redirect('login');
        }elseif(!isset($kontrol2) || $kontrol2->yetki!=1)
        {
            redirect('Yonetim/errorpage');
        }
        else{ //logtut?

        }
    }
    public function index()
    {
        $kontrol = $this->session->userdata('info');
        $data = new stdClass;
        $this->load->model('akdmodel');
        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
        $query = $this->db->query("SELECT ID FROM proje where yil='".$sistemYili->row()->sistemYili."'");
        $toplamProjeSayisi = $query->num_rows();
        $projesayim=$this->akdmodel->akademisyenProjeleri($kontrol->hocaID);
        
        $ogrenciSayim = $this->akdmodel->akademisyenOgrencileri($kontrol->hocaID);
        $notVerilenProjeSayisi = $this->akdmodel->notVerilenProje($kontrol->hocaID);
        if($projesayim)
            $data->bProje=count($projesayim); //
        else
            $data->bProje="0"; //
        if($ogrenciSayim)
            $data->ogrencilerim=count($ogrenciSayim); //
        else
            $data->ogrencilerim=0; //
        if($notVerilenProjeSayisi)
            $data->notVerilmeyenProje=(($toplamProjeSayisi-count($notVerilenProjeSayisi))); //
        else if($notVerilenProjeSayisi == 0)
            $data->notVerilmeyenProje=$toplamProjeSayisi;
        if($toplamProjeSayisi)
            $data->tProje=$toplamProjeSayisi;
        else
            $data->tProje="0";
        $this->load->view('akademisyen/panel/akdHome',$data);
    }
    public function panelProjeAyrinti($projeId)
    {
        // proje ayrıntısı
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->projeAyrinti($projeId);
        $data = new stdClass;
        $data->info=$sonuc;
        // proje öğrencileri
        $this->load->model('akdmodel');
        $son=$this->akdmodel->ogrencininPuani($projeId);
        $data->inf=$son;
        // not veren hocalar.
        $this->load->model('akdmodel');
        $res = $this->akdmodel->puanVeren($projeId);
        $data->inf2=$res;

        $this->load->view("akademisyen/panel/projeAyrinti",$data);
    }
    public function projeDosyaindir($projeKodu)
    {
        $this->load->model('ogrmodel');
        $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu);
        $data['inf']=$inf;
        $this->load->helper('download');
        force_download('assets/upload/projeDosya/'.$inf->dosya,NULL);
        $this->projeAyrinti();
    }
    public function projeAfisindir($projeKodu)
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki == 1)
        {
            $this->load->model('ogrmodel');
            $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu);
            $data['inf']=$inf;
            $this->load->helper('download');
            force_download('assets/upload/afis/'.$inf->afis,NULL);
            //redirect("Akademisyen/AkademisyenPaneli/panelProjeAyrinti/".$projeKodu);
            $this->panelProjeAyrinti($projeKodu);
        }
        else{ // logtut
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function panelNot($id,$yer) //panelde Not verme işlemi için.
    {
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $notu = $this->input->post('not');
        $ip = $this->input->ip_address();
        $data = array('notu' => $notu,
            'hocaID' => $hocaID,
            'projeKodu' => $id,
            'ipAdress'=>$ip,
        );
        $notGirildimi = $this->db->query("select ID from notlar where hocaID='".$kontrol->hocaID."' and projeKodu='".$id."'");
        if($notGirildimi->row()->ID!="") // hoca daha önce not girdiyse günceller.
        {
            $this->load->model('akdmodel');
            $sonuc = $this->akdmodel->notGuncelle($data,$notGirildimi->row()->ID);
        }else { // daha önce not girmediyse yeni not ekler.
            $this->load->model('akdmodel');
            $sonuc = $this->akdmodel->notGir($data);
        }
        $query = $this->db->query("SELECT AVG(notlar.notu) as ort FROM `notlar` WHERE notlar.projeKodu ='".$id."'");
        $ort = $query->row()->ort;
        $this->db->query("UPDATE proje SET puan =" . $ort . " WHERE projeKodu ='".$id."'");
        if ($sonuc) { // veritabanına eklendiyse onay mesajı verir.
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
            Not verme işlemi Başarılı Bir Şekilde Yapıldı.
            </div>');
            //$this->akademisyenMainindex();
            if($yer==0) // 0 degeri proje ayrıntısına götürür.
                redirect('akademisyen/pproje/'.$id);
            else if($yer==1) // 1 değeri proje listesine götürür.
                redirect('akademisyen/projeListesi');
            else
                echo "Hatalı Erişim.";


        }else{
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
            Not girişi yapılamadı.
            </div>');
            redirect('akademisyen/projeListesi');
        }
    }
    public function projeGosterMain()
    {
        $this->load->view("akademisyen/projeGoster");
    }
    public function panelProjeListesi()
    {        
        $kontrol = $this->session->userdata('info');
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->akademisyenProjeleri($kontrol->hocaID);
        $data = new stdClass;
        $data->bilgi=$sonuc;
        $this->load->view('akademisyen/panel/projeListesi',$data);
    }
    public function digerProjeler() // Arama sayfası
    {
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->akdGetir();
        $data = new stdClass;
        $data->info=$sonuc;
        $this->load->view('akademisyen/panel/digerProjelerAra',$data);
    }
    public function digerProjelerListele($hocaID)
    {
        $this->load->model('akdmodel');
        $projeler=$this->akdmodel->akademisyenProjeleri($hocaID);        
        $veri = new stdClass;
        $veri->proje=$projeler;
        $this->load->view('akademisyen/panel/digerProjeler',$veri);
    }
    public function ogrencilerim()
    {
        
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $this->load->model('akdmodel');
        $info=$this->akdmodel->projelerim($hocaID);        
        $info2=$this->akdmodel->projeYayindaKontrol($hocaID);
        $data = new stdClass;
        $data->info=$info;
        $data->info2 = $info2;        
        $this->load->view('akademisyen/panel/ogrenciListesi',$data);
    }
    public function ogrenciProfil($ogrNo)
    {
        $this->load->model('Ogrmodel');
        $this->load->model('Admmodel');
        $kontrol = $this->session->userdata('info');
        $ogrenciBilgisi=$this->Ogrmodel->ogrenciByOgrNo($ogrNo);
        if($ogrenciBilgisi)
        {
            $hocaBilgisi=$this->Admmodel->akademisyenByhocaID($ogrenciBilgisi->hocaID);
            $data['ogrenci']=$ogrenciBilgisi;
            $data['hoca']=$hocaBilgisi;
            $this->load->view('profil/profilPublic',$data);
        }else{ //veritabanı hatası logtut.
            $this->load->view('yonetim/errorPage/500');
        }
    }


}