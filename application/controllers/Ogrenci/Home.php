<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->guvenlik();
        $this->load->helper(array('form', 'url'));

    }
    function guvenlik(){
	$kontrol = $this->session->userdata('kontrol');
        $kontrol2 = $this->session->userdata('info');
        if(!isset($kontrol)|| $kontrol!=true)
        {
            redirect('login');
        }elseif(!isset($kontrol2) || $kontrol2->yetki!=2)
        {
            redirect('Yonetim/errorpage');
        }
        else{ //logtut?

        }
    }
    public function index()
    {
        $kontrol = $this->session->userdata('info');
        $projesiVarmi = $this->db->query("SELECT projeKodu FROM ogrenci WHERE ID=".$kontrol->ID."");
        if($projesiVarmi->row()->projeKodu) // proje yoksa false doner.
        {
            redirect('Ogrenci/Home/projeAyrinti');
        }else{
            redirect('Ogrenci/Home/projeEkle');
        }
    }
    public function projeEkle()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->model('ogrmodel');
        $projeID =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");
        if($kontrol->yetki == 2 & !$projeID->row()->projeKodu)
        {
            $inf=$this->ogrmodel->ogrencininDanismani($kontrol->ID);
            $data = new stdClass;
            $data->inf=$inf;
            $this->load->view('ogrenci/projeEkle',$data);
        }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Uyarı!</h4>
                    Zaten ekli bir projeniz var.
                    </div>');
            redirect('Ogrenci/Home/projeAyrinti');
        }
    }
    public function projeEkleButton()
    {

        $config['upload_path']   = 'assets/upload/afis/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 15000;
        $config['max_width']     = 1024;
        $config['max_height']    = 768;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        //afis eklemek//
        if ( !$this->upload->do_upload('userfile')){ //hata alinan kisim logtut
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
            redirect('Ogrenci/Home/projeEkle');
            //echo serialize($error);
        }else{
            $data = array('upload_data' => $this->upload->data());
            $afisadi=$this->upload->data('file_name');

            ///////proje dosyasi Eklemek////////
            $config['upload_path']   = 'assets/upload/projeDosya';
            $config['allowed_types'] = 'pdf';
            $config['max_size']      = 5000;
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('userfilea')){ // logtut

                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
                redirect('Ogrenci/Home/projeEkle');
            }else{
                $data = array('upload_data' => $this->upload->data());
                $dosyaadi=$this->upload->data('file_name');


                // Bilgilerin proje dosyasina eklenmesi  //
                $kontrol = $this->session->userdata('info');
                $projeAdi = $this->input->post('projeAdi');
                $projeAciklama= $this->input->post('projeAciklama');
                $projeKodu= $this->input->post('projeKodu');
                $data = array('projeAdi'=>$projeAdi,
                    'projeAciklama'=>$projeAciklama,
                    'projeKodu'=>$projeKodu,
                    'afis'=>$afisadi,
                    'dosya'=>$dosyaadi,
                    'hocaID'=>$kontrol->hocaID,
                );
                $this->load->model('ogrmodel');
                $insert=$this->ogrmodel->projeEkle($data);
                $this->db->query("UPDATE ogrenci SET projeKodu = '".$projeKodu."' WHERE ID = '".$kontrol->ID."'" ); // yukarıdaki kod proje tablosuna ekleme gerçekleşirir. -->
                //projekodu bilgisi öğrenci tablosuna yazılır.
                if($insert)
                {
                    $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Basarili!</h4>
                    Proje basarili bir sekilde eklendi!
                    </div>');
                    redirect('Ogrenci/Home/projeAyrinti');
                }
                else{ //veritabanı bağlantı hatası. logtut
                    $this->load->view('yonetim/errorPage/500');
                }

            }

        }
    }
    public function projeAyrinti()
    {
        $kontrol = $this->session->userdata('info');
        $projeID =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");
        if($kontrol->yetki == 2)
        {
            $this->load->model('akdmodel');
            $inf=$this->akdmodel->projeAyrinti($projeID->row()->projeKodu);
            if($inf)
            {
                $data['inf']=$inf;
                $this->load->view('ogrenci/projeAyrinti',$data);
            }else{
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Uyarı!</h4>
                    Gösterilecek Bir Proje Bulunamadı.
                    </div>');
                redirect('Ogrenci/Home/projeEkle');
            }
        }
        else{ //logtut
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function projeDosyaindir()
    {
        $kontrol = $this->session->userdata('info');
        $projeKodu = $this->db->query("SELECT projeKodu FROM ogrenci WHERE ID='".$kontrol->ID."'");
        if($kontrol->yetki == 2)
        {
            $this->load->model('ogrmodel');
            $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu->row()->projeKodu);
            $data['inf']=$inf;
            $this->load->helper('download');
            force_download('assets/upload/projeDosya/'.$inf->dosya,NULL);
            $this->projeAyrinti();
        }
        else{
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function projeAfisindir()
    {
        $kontrol = $this->session->userdata('info');
        $projeKodu = $this->db->query("SELECT projeKodu FROM ogrenci WHERE ID=".$kontrol->ID."");
        if($kontrol->yetki == 2)
        {
            $this->load->model('ogrmodel');
            $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu->row()->projeKodu);
            $data['inf']=$inf;
            $this->load->helper('download');
            force_download('assets/upload/afis/'.$inf->afis,NULL);
            $this->projeAyrinti();
        }
        else{
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function projeGuncelle()
    {
        $kontrol = $this->session->userdata('info');
        $proje = $this->db->query("SELECT projeKodu FROM ogrenci where ID='".$kontrol->ID."'");
        $this->load->model('Ogrmodel');
        $inf=$this->Ogrmodel->ogrenciProjeByID($proje->row()->projeKodu);
        $data['inf']=$inf;        
        $this->load->view('ogrenci/projeGuncelle',$data);
    }
    public function projeGuncelleButton()
    {
        // formdan verileri ceker.
        $kontrol = $this->session->userdata('info');
        $projeAdi = $this->input->post('projeAdi');
        $projeAdiing = $this->input->post('projeAdiing');
        $projeAciklama= $this->input->post('projeAciklama');
        $projeAciklamaing= $this->input->post('projeAciklamaing');
        $projeKodu= $this->input->post('projeKodu');
        $data = array('projeAdi'=>$projeAdi,
            'projeName'=>$projeAdiing,
            'projeAciklama'=>$projeAciklama,
            'projeDetail'=>$projeAciklamaing,
        );
        $this->load->model('ogrmodel');
        $insert=$this->ogrmodel->projeGuncelle($data,$projeKodu);
        if($insert)
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Güncelleme Basarili!</h4>
                    Proje basarili bir sekilde güncellendi!
                    </div>');
            redirect('Ogrenci/Home/projeAyrinti');
        }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                    Proje Güncellenemedi.
                    </div>');
            redirect('Ogrenci/home/projeAyrinti');
        }
    }
    public function projeAfisVeDosyaGuncelle()
    {
        $config['upload_path']   = 'assets/upload/afis/';
        $config['allowed_types'] = 'gif|jpg|png';        
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        $kontrol = $this->session->userdata('info');
        $projekodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");
        //afis eklemek//
        if ( !$this->upload->do_upload('userfile')){ //hata alinan kisim logtut
            $projeAfisKontrol = $this->db->query("SELECT afis FROM proje where projeKodu='".$projekodu->row()->projeKodu."'");
            if($projeAfisKontrol->row()->afis=="")
            {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
                redirect('Ogrenci/Home/projeEkle');
                //echo serialize($error);
            }
        }else{
            $data = array('upload_data' => $this->upload->data());
            $afisadi=$this->upload->data('file_name');
            ///////proje dosyasi Eklemek////////
            $config['upload_path']   = 'assets/upload/projeDosya';
            $config['allowed_types'] = 'pdf';            
            $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if ( !$this->upload->do_upload('userfilea')){ // logtut

                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
                redirect('Ogrenci/home/projeEkle');
            }else{
                $data = array('upload_data' => $this->upload->data());
                $dosyaadi=$this->upload->data('file_name');

                // Bilgilerin proje dosyasina eklenmesi  //
                $data = array(
                    'afis'=>$afisadi,
                    'dosya'=>$dosyaadi
                );
                $this->load->model('ogrmodel');
                $insert=$this->ogrmodel->projeGuncelle($data,$projekodu->row()->projeKodu);
                if($insert)
                {
                    $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Basarili!</h4>
                    Proje basarili bir sekilde eklendi!
                    </div>');
                    redirect('Ogrenci/Home/projeAyrinti');
                }
                else{
                    $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Başarısız!</h4>
                    Proje eklenemedi.
                    </div>');
                    redirect('Ogrenci/Home/projeAyrinti');
                }
            }

        }
    }
    public function afisGuncelle()
    {
        $config['upload_path']   = 'assets/upload/afis/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']  = 15000;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        $kontrol = $this->session->userdata('info');
        $projekodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");
        //afis eklemek//
        if ( !$this->upload->do_upload('userfile')){ //hata alinan kisim logtut
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
            redirect('Ogrenci/Home/projeGuncelle');
        }else {
            $KayitliafisAdi = $this->db->query("SELECT afis FROM proje where projeKodu='".$projekodu->row()->projeKodu."'");
            $this->load->helper("file");
            unlink('assets/upload/afis/'.$KayitliafisAdi->row()->afis);
            $data = array('upload_data' => $this->upload->data());
            $afisadi = $this->upload->data('file_name');
            // Bilgilerin proje dosyasina eklenmesi  //
            $data = array(
                'afis'=>$afisadi,
            );
            $this->load->model('ogrmodel');
            $insert=$this->ogrmodel->projeGuncelle($data,$projekodu->row()->projeKodu);
            if($insert)
            {
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Basarili!</h4>
                    Proje basarili bir sekilde güncellendi!
                    </div>');
                redirect('Ogrenci/Home/projeGuncelle');
            }
            else{
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Başarısız!</h4>
                    Proje güncellenemedi.
                    </div>');
                redirect('Ogrenci/Home/projeGuncelle');
            }
        }
    }
    public function dosyaGuncelle()
    {
        $config['upload_path']   = 'assets/upload/projeDosya';
        $config['allowed_types'] = 'pdf';
        $config['max_size']  = 16000;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        $kontrol = $this->session->userdata('info');
        $projekodu =$this->db->query("SElECT projeKodu FROM ogrenci WHERE ID= '".$kontrol->ID."'");

        if ( !$this->upload->do_upload('userfilea')){ // logtut

            $error = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>'.$error['error'].'</div>');
            redirect('Ogrenci/home/projeGuncelle');
        }else{
            $KayitliDosyaAdi = $this->db->query("SELECT dosya FROM proje where projeKodu='".$projekodu->row()->projeKodu."'");
            $this->load->helper("file");
            unlink('assets/upload/projeDosya/'.$KayitliDosyaAdi->row()->dosya);
            $data = array('upload_data' => $this->upload->data());
            $dosyaadi=$this->upload->data('file_name');

            // Bilgilerin proje dosyasina eklenmesi  //
            $data = array(
                'dosya'=>$dosyaadi
            );
            $this->load->model('ogrmodel');
            $insert=$this->ogrmodel->projeGuncelle($data,$projekodu->row()->projeKodu);

            if($insert)
            {
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Basarili!</h4>
                    Proje basarili bir sekilde güncellendi!
                    </div>');
                redirect('Ogrenci/Home/projeGuncelle');
            }
            else{
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Ekleme Başarısız!</h4>
                    Proje güncellenemedi.
                    </div>');
                redirect('Ogrenci/Home/projeGuncelle');
            }
        }

    }
    public function video()
    { 
        // formdan verileri ceker.
        $kontrol = $this->session->userdata('info');
        $videoUrl = $this->input->post('videoURL');        
        $url = parse_url($videoUrl); //video ID'sini çıkarır.
        parse_str($url['query'], $query);
        $videoUrl='<iframe id="iframeID" width="600" height="400" style="display:block;margin:0 auto" src="https://www.youtube.com/embed/'.$query[v].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $projeKodu= $this->input->post('projeKodu');
        $data = array('videoUrl'=>$videoUrl,);       
        $this->load->model('ogrmodel');
        $insert=$this->ogrmodel->projeGuncelle($data,$projeKodu);
        if($insert)
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Güncelleme Basarili!</h4>
                    Proje basarili bir sekilde güncellendi!
                    </div>');
            redirect('Ogrenci/Home/projeAyrinti');
        }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                    Proje Güncellenemedi.
                    </div>');
            redirect('Ogrenci/home/projeAyrinti');
        }

    }


}
