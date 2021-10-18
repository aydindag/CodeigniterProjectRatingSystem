<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YonetimPaneli extends CI_Controller {
    public function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->guvenlik();
        $this->load->helper(array('form', 'url'));

    }

    public function guvenlik(){
        $kontrol = $this->session->userdata('kontrol');
        $kontrol2 = $this->session->userdata('info');
        if(!isset($kontrol)|| $kontrol!=true)
        {
            redirect('login');
        }elseif(!isset($kontrol2) || $kontrol2->yetki!=0)
        {
            redirect('Yonetim/errorpage');
        }
        else{ //logtut?

        }

    }
    public function index()
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki==0)
        {
            $data = new stdClass;
            $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
            $this->load->model('admmodel');
            $this->load->model('akdmodel');
            $query = $this->db->query("SELECT ID FROM proje where yil='".$sistemYili->row()->sistemYili."'");
            /*$netquery = $this->akdmodel->projeGetir();
            print_r($netquery);
            die();
            */
            $toplamProjeSayisi = $query->num_rows();
            $ogrenciler = $this->admmodel->ogrenciListesi();
            $akademisyenler = $this->akdmodel->akdGetir();
            $iletisimSayisi = $this->admmodel->iletisimListesi();
            if($iletisimSayisi)
                $data->iletisimSayisi = count($iletisimSayisi);
            else
                $data->iletisimSayisi = "0";
            if($toplamProjeSayisi)
                $data->tProje=$toplamProjeSayisi;
            else
                $data->tProje="0";
            if($ogrenciler)
                $data->ogrencilerim=count($ogrenciler);
            else
                $data->ogrencilerim="0";
            if($akademisyenler)
                $data->akademisyen=count($akademisyenler);
            else
                $data->akademisyen="0";
            $this->load->view("yonetim/home/adminHome",$data);
        }
        else
            $this->load->view('yonetim/errorPage/401');
    }
    public function akademisyen()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->model('akdmodel');
        $cekilenVeri = $this->akdmodel->akdGetir();
        $data = new stdClass;
        $data->bilgi=$cekilenVeri;
        $this->load->view('yonetim/akademisyen/akademisyen',$data);
    }
    public function akademisyenEkle()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->view('yonetim/akademisyen/akademisyenEkle');
    }
    public function akademisyenEkleButton()
    {
        $adsoyad = $this->input->post('adsoyad');
        $kadi= $this->input->post('kadi');
        $mail = $this->input->post('mail');
        $unvan = $this->input->post('unvan');
        $password = $this->input->post('password');

        $data = array('adiSoyadi'=>$adsoyad,
            'kullaniciAdi'=>$kadi,
            'email'=>$mail,
            'unvan'=>$unvan,
            'sifre'=>$password
        );
        $this->load->model('admmodel');
        $insert=$this->admmodel->akademisyenEkle($data);
        if(isset($insert))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Ekleme Başarılı!</h4>
            Akademisyen başarılı bir şekilde eklendi!
            </div>');
            redirect('YonetimPaneli/akademisyen');
        }else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> HATA!</h4>
            Ekleme sırasında bir sorun oluştu. Tekrar deneyin.
            </div>');
            redirect('YonetimPaneli/akademisyen');
        }
    }
    public function veriSil($id,$data)
    {
        $this->load->model('admmodel');
        $delete = $this->admmodel->veriSil($id,$data);
        if(isset($delete))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Başarılı!</h4>
            Silme İşlemi Başarılı!
            </div>');
            if($data=="ogrenci")
                redirect('YonetimPaneli/ogrenciListesi');
            else if($data=="iletisim")
                redirect('YonetimPaneli/iletisimListesi');
            else
                redirect('YonetimPaneli/'.$data);
        }
    }
    public function akademisyenGuncelle($id)
    {
        $this->load->model('admmodel');
        $inf=$this->admmodel->akademisyenByID($id);
        $data['inf']=$inf;
        $this->load->view('yonetim/akademisyen/akademisyenGuncelle',$data);
    }
    public function akademisyenGuncelleButton($id)
    {
        $adsoyad = $this->input->post('adsoyad');
        $kadi= $this->input->post('kadi');
        $mail = $this->input->post('mail');
        $unvan = $this->input->post('unvan');
        $password = $this->input->post('password');

        $data = array('adiSoyadi'=>$adsoyad,
            'kullaniciAdi'=>$kadi,
            'email'=>$mail,
            'unvan'=>$unvan,
            'sifre'=>$password
        );
        $this->load->model('admmodel');
        $sonuc=$this->admmodel->akdGuncelle($data,$id);
        if(isset($sonuc))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
            Akademisyen başarılı bir şekilde Güncellendi!
            </div>');
            redirect('YonetimPaneli/akademisyen');
        }
    }
    public function ogrenciListesi()
    {
        $kontrol = $this->session->userdata('info');

        $this->load->model('admmodel');
        $cekilenVeri = $this->admmodel->ogrenciListesi();
        $data = new stdClass;
        $data->bilgi=$cekilenVeri;
        $this->load->view('yonetim/ogrenci/ogrenciListesi',$data);
    }
    public function ogrenciEkle()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->model('akdmodel');
        $cekilenVeri = $this->akdmodel->akdGetir();
        $data = new stdClass;
        $data->bilgi=$cekilenVeri;
        $this->load->view('yonetim/ogrenci/ogrenciEkle',$data);
    }
    public function ogrenciEkleButton()
    {
        $adsoyad = $this->input->post('adsoyad');
        $kadi= $this->input->post('kadi');
        $mail = $this->input->post('mail');
        $password = $this->input->post('password');
        $ogrNo = $this->input->post('ogrNo');
        $sube = $this->input->post('sube');
        $projeKodu = $this->input->post('projeKodu');
        $hocaID = $this->input->post('danismanid');

        $data = array('adiSoyadi'=>$adsoyad,
            'kullaniciAdi'=>$kadi,
            'email'=>$mail,
            'ogrNo'=>$ogrNo,
            'sifre'=>$password,
            'sube'=>$sube,
            'projeKodu'=>$projeKodu,
            'hocaID'=>$hocaID,
        );
        $this->load->model('admmodel');
        $insert=$this->admmodel->ogrenciEkle($data);
        if(isset($insert))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Ekleme Başarılı!</h4>
            Öğrenci başarılı bir şekilde eklendi!
            </div>');
            redirect('YonetimPaneli/ogrenciListesi');
        }else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> HATA!</h4>
            Ekleme işlemi başarısız oldu. Tekrar Deneyin.
            </div>');
            redirect('YonetimPaneli/ogrenciListesi');
        }
    }
    public function ogrenciGuncelle($id)
    {
        $kontrol = $this->session->userdata('info');
        $this->load->model('admmodel');
        $inf=$this->admmodel->ogrenciByID($id);
        $data['inf']=$inf;
        $this->load->view('yonetim/ogrenci/ogrenciGuncelle',$data);
    }
    public function ogrenciGuncelleButton($id)
    {
        $adsoyad = $this->input->post('adsoyad');
        $kadi= $this->input->post('kadi');
        $mail = $this->input->post('mail');
        $unvan = $this->input->post('unvan');
        $password = $this->input->post('password');
        $ogrNo = $this->input->post('ogrNo');
        $sube = $this->input->post('sube');
        $projeKodu = $this->input->post('projeKodu');

        $data = array('adiSoyadi'=>$adsoyad,
            'kullaniciAdi'=>$kadi,
            'email'=>$mail,
            'ogrNo'=>$ogrNo,
            'sifre'=>$password,
            'sube'=>$sube,
            'projeKodu'=>$projeKodu
        );
        $this->load->model('admmodel');
        $sonuc=$this->admmodel->ogrGuncelle($data,$id);
        if(isset($sonuc))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
            Öğrenci başarılı bir şekilde Güncellendi!
            </div>');
            redirect('YonetimPaneli/ogrenciListesi');
        }
    }
    public function duyurular()
    {
        $kontrol = $this->session->userdata('info');

        $this->load->model('admmodel');
        $cekilenVeri = $this->admmodel->duyuruGetir();
        $data = new stdClass;
        $data->bilgi=$cekilenVeri;
        $data->veri = $cekilenVeri;
        $this->load->view('yonetim/duyurular/duyurular',$data);
    }
    public function duyuruEkle()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->view('yonetim/duyurular/duyuruEkle');
    }
    public function duyuruEkleButton()
    {
        $baslik = $this->input->post('baslik');
        $icerik= $this->input->post('icerik');
        $ekleyenisim = $this->input->post('ekleyenisim');
        $data = array('duyuruBaslik'=>$baslik,
            'duyuruIcerik'=>$icerik,
            'ekleyenIsım'=>$ekleyenisim
        );
        $this->load->model('admmodel');
        $insert=$this->admmodel->duyuruEkle($data);
        if(isset($insert))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Ekleme Başarılı!</h4>
            Duyuru başarılı bir şekilde eklendi!
            </div>');
            redirect('YonetimPaneli/duyurular');
        }
    }
    public function duyuruGuncelle($id)
    {

        $this->load->model('admmodel');
        $inf=$this->admmodel->duyuruByID($id);
        $data['inf']=$inf;
        $this->load->view('yonetim/duyurular/duyuruGuncelle',$data);
    }
    public function duyuruGuncelleButton($id)
    {
        $baslik = $this->input->post('baslik');
        $icerik= $this->input->post('icerik');
        $ekleyenisim = $this->input->post('ekleyenisim');


        $data = array('duyuruBaslik'=>$baslik,
            'duyuruIcerik'=>$icerik,
            'ekleyenIsım'=>$ekleyenisim
        );
        $this->load->model('admmodel');
        $sonuc=$this->admmodel->duyuruGuncelle($data,$id);
        if(isset($sonuc))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
            Duyuru başarılı bir şekilde Güncellendi!
            </div>');
            redirect('YonetimPaneli/duyurular');
        }else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-alert alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarısız!</h4>
            Duyuru güncellenemedi!
            </div>');
            redirect('YonetimPaneli/duyurular');
        }
    }
    public function ayarlar()
    {
        $this->load->model('admmodel');
        $inf=$this->admmodel->ayarlar();
        $data['inf']=$inf;
        $this->load->view('yonetim/ayarlar/ayarlar',$data);
    }
    public function ayarlarGuncelle()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('server', 'Server', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('port', 'Port', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|trim|valid_email|max_length[50]');
        $this->form_validation->set_rules('sifre', 'Şifre', 'required|trim|max_length[20]');
        $this->form_validation->set_rules('sistemYili', 'sistem yılı', 'required|trim|max_length[4]');
        if ($this->form_validation->run() == true) {
            $server = $this->input->post('server');
            $port = $this->input->post('port');
            $email = $this->input->post('email');
            $sifre = $this->input->post('sifre');
            $sistemYili = $this->input->post('sistemYili');


            $data = array('smtpServer' => $server,
                'smtpport' => $port,
                'smtpemail' => $email,
                'sistemYili' => $sistemYili,
                'password' => $sifre
            );
            $this->load->model('admmodel');
            $sonuc = $this->admmodel->ayarlarGuncelle($data, "1");
            if (isset($sonuc)) {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
            Ayarlar başarılı bir şekilde Güncellendi!
            </div>');
                redirect('YonetimPaneli/ayarlar');
            } else {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-alert alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Güncelleme Başarısız!</h4>
            Ayarlar güncellenemedi!
            </div>');
                redirect('YonetimPaneli/ayarlar');
            }
        }else {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Hata!</h4>'.validation_errors().'</div>');
            redirect('YonetimPaneli/ayarlar');
        }
    }
    public function iletisimListesi()
    {
        $kontrol = $this->session->userdata('info');
        $this->load->model('admmodel');
        $cekilenVeri = $this->admmodel->iletisimListesi();
        $data = new stdClass;
        $data->bilgi=$cekilenVeri;

        $this->load->view('yonetim/iletisim/iletisimListesi',$data);
    }
    public function iletisimAyrinti($id)
    {

        $this->load->model('admmodel');
        $inf=$this->admmodel->iletisimByID($id);
        if($inf)
        {
            $data['inf']=$inf;
            $this->load->view('yonetim/iletisim/iletisimAyrinti',$data);
        }else{
            $this->session->set_flashdata('hata','<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Hata!</h4>
                Bilgiye Ulaşılamadı.
              </div>');
            redirect('YonetimPaneli/iletisimListesi');
        }
    }
    public function projeler()
    {
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->akdGetir();
        $data = new stdClass;
        $data->info=$sonuc;
        $this->load->view('yonetim/proje/projeler',$data);
    }
    public function akademisyenProjeleri($hocaID)
    {
        $this->load->model('akdmodel');
        $projeler=$this->akdmodel->akademisyenProjeleri($hocaID);
        $veri = new stdClass;
        $veri->proje=$projeler;
        $this->load->view('yonetim/proje/akademisyenProjeleri',$veri);
    }
    public function tumProjeler()
    {
	
        $this->load->model('admmodel');
        $projeler=$this->admmodel->tumProjeler();        
        $veri = new stdClass;
        $veri->proje=$projeler;   

        $this->load->view('yonetim/proje/projeListesi',$veri);
    }
    public function projeSil($id,$projeKodu)
    {        
        $this->load->model('admmodel');
        $delete = $this->admmodel->veriSil($id,"proje");
        $notlariSil = $this->admmodel->projeNotuSil($projeKodu,"notlar");
        $ogrencileriSil = $this->admmodel->projeninOgrencileriSil($projeKodu,"ogrenci");
        if(isset($delete))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Başarılı!</h4>
            Proje, öğrencileri ve notlarıyla birlikte başarıyla silindi.
            </div>');            
            redirect('YonetimPaneli/tumProjeler');
            
        }
    }
    public function projeAyrinti($projeId)
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
        $this->load->view('yonetim/proje/projeAyrinti',$data);

    }
    public function projeDosyaindir($projeKodu)
    {
        $this->load->model('ogrmodel');
        $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu);
        $data['inf']=$inf;
        $this->load->helper('download');
        force_download('assets/upload/projeDosya/'.$inf->dosya,NULL);
        redirect('YonetimPaneli/projeAyrinti/'.$projeKodu);
    }
    public function projeAfisindir($projeKodu)
    {
        $this->load->model('ogrmodel');
        $inf=$this->ogrmodel->ogrenciProjeByID($projeKodu);
        $data['inf']=$inf;
        $this->load->helper('download');
        force_download('assets/upload/afis/'.$inf->afis,NULL);
        redirect('YonetimPaneli/projeAyrinti/'.$projeKodu);

    }
public function mesajGonder($email)
    {
        $this->load->model('Akdmodel');
        $this->load->model('Admmodel');
        $ogrenciler=$this->Admmodel->ogrenciListesi();
        $hoca=$this->Akdmodel->akdGetir();
        $data = new stdClass;
        $data->ogrenci=$ogrenciler;
        $data->hoca=$hoca;
        if($email!="1"){
            $data->email=$email;
        }
        $this->load->view('yonetim/iletisim/mesajGonder',$data);
    }
    public function mesajGonderButton()
    {
        $kime = $this->input->post('kime');
        $konu = $this->input->post('konu');
        $icerik = $this->input->post('icerik');
        $this->load->model('vtmodel');
        $cekilenVeri = $this->vtmodel->ayarlarıAl();
        $mailaddres = $cekilenVeri->smtpemail;
        $port = $cekilenVeri->smtpport;
        $pass = $cekilenVeri->password;
        $hosti = $cekilenVeri->smtpServer;
        $user = $cekilenVeri->smtpemail;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $hosti,
            'smtp_port' => $port,
            'smtp_user' => $user,
            'smtp_pass' => $pass,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($mailaddres);
        $this->email->to($kime);
        $this->email->subject($konu);
        $this->email->message($icerik);
        if ($this->email->send()) {
            $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                        E-Mail Başarıyla Gönderildi. 
                        </div>');

            redirect('YonetimPaneli/mesajGonder/1');

        } else {
            $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Hata!</h4>
                        E-mail Gönderilemedi.
                        </div>');
            redirect('YonetimPaneli/mesajGonder/1');
        }
    }
/*
    public function mailGonder()
    {
        echo "Mail Gönderme Sayfasındasiniz"."<br>";

        $this->load->model('vtmodel');
        $cekilenVeri = $this->vtmodel->ayarlarıAl();
        $mailaddres = $cekilenVeri->smtpemail;
        $port = $cekilenVeri->smtpport;
        $pass = $cekilenVeri->password;
        $hosti = $cekilenVeri->smtpServer;
        $user = $cekilenVeri->smtpemail;
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => $hosti,
            'smtp_port' => $port,
            'smtp_user' => $user,
            'smtp_pass' => $pass,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
        );
        $ogrenci = $this->db->query('SELECT ID,adiSoyadi,email,sifre,kullaniciAdi FROM ogrenci where sifre="" and email!=""');
        $toplam = $ogrenci->num_rows();

        $i = 1;
        foreach ($ogrenci->result_array() as $row)
        {
            if($i<=50) {
                echo $i."- ".$row['adiSoyadi'] . " -> " . $row['email'] . "<br>";
                $sifre = $this->sifreOlustur();
                $data = array(
                    'sifre' => $sifre
                );
                $this->load->model('admmodel');
                $sonuc = $this->admmodel->ogrGuncelle($data, $row['ID']);
                echo $i."- ".$row['adiSoyadi']." sifresi oluşturuldu: ".$sifre. "<br>";
                // mail başlangıç
		
                $mail = "Sayın " . $row['adiSoyadi'] . ";<br>Bilgileriniz aşağıdadır.<br>Kullanıcı Adınız: ".$row['kullaniciAdi']."<br>Şifreniz: <b>" . $sifre . "</b><br>" . "İyi Günler.";
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($mailaddres);
                $this->email->to($row['email']);
                $this->email->subject("Yeni Şifre");
                $this->email->message($mail);

                if ($this->email->send()) {
                    echo $i."- ".$row['adiSoyadi']." -> E-Mail Gönderildi "."<br>";

                } else {
                    echo $i."- ".$row['adiSoyadi']." -> **E-Mail Gönderilemedi ** "."<br>";
                }
                // mail bitiş		
                $i = $i + 1;
            }
            else{
                echo "Günlük Limit Aşıldı <br>";
                break;
            }




        }
        echo "Döngüden Çıkıldı.<br>";







    }
*/
    public function sifreOlustur()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password);

        return random_password();
    }

}