<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class yonetim extends CI_Controller
{
    public function index()
    {
	$kontrol = $this->session->userdata('info');
        if(isset($kontrol))
        {
            if($kontrol->yetki==2)
                redirect('Ogrenci/home');
            else if($kontrol->yetki==1)
                redirect('Akademisyen/home');
            else
                redirect('yonetimPaneli');
        }
        $this->load->view('yonetim/login/login');
    }
    public function cikis() // oturum kapatma
    {
        $this->session->sess_destroy();
        redirect('login');
    }
/*
    public function registerOgrindex()
    {
        $this->load->model('vtmodel');
        $inf = $this->vtmodel->akademisyencek();
        $data = new stdClass;
        $data->bilgi = $inf;
        $this->load->view('yonetim/register/register', $data);
    }
*/
    public function errorpage()
    {
        $this->load->view('yonetim/errorPage/401');
    }
    public function errorpage500()
    {
        $this->load->view('yonetim/errorPage/500');
    }
/*
    public function registerOgr()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('adiSoyadi', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|trim|is_unique[ogrenci.email]|max_length[30]');
        $this->form_validation->set_rules('kullaniciAdi', 'User Name', 'required|trim|is_unique[ogrenci.kullaniciAdi]|max_length[15]');
        $this->form_validation->set_rules('ogrNo', 'Student Number', 'required|trim|is_unique[ogrenci.ogrNo]|max_length[13]|min_length[13]');
        $this->form_validation->set_rules('sube', 'Class', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('danismanid', 'SuperVisor', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('sifre', 'Password', 'required|trim|max_length[15]|callback_password_check|min_length[6]');
        $this->form_validation->set_rules('sifre2', 'Retype password', 'required|trim|matches[sifre]|max_length[15]');

        if ($this->form_validation->run() == true) {
            $data1 = $this->input->post('adiSoyadi');
            $data2 = $this->input->post('email');
            $data3 = $this->input->post('kullaniciAdi');
            $data4 = $this->input->post('ogrNo');
            $data5 = $this->input->post('sube');
            $data6 = $this->input->post('danismanid');
            $data7 = $this->input->post('sifre');
            $data8 = $this->input->post('sifre2');

            $adiSoyadi = $this->security->xss_clean($data1);
            $email = $this->security->xss_clean($data2);
            $kullaniciAdi = $this->security->xss_clean($data3);
            $ogrNo = $this->security->xss_clean($data4);
            $sube = $this->security->xss_clean($data5);
            $danismanid = $this->security->xss_clean($data6);
            $sifre = $this->security->xss_clean($data7);
            $sifre2 = $this->security->xss_clean($data8);

            $data = array('adiSoyadi' => $adiSoyadi,
                'kullaniciAdi' => $kullaniciAdi,
                'email' => $email,
                'ogrNo' => $ogrNo,
                'sifre' => $sifre,
                'sube' => $sube,
                'hocaID' => $danismanid,
            );
            $this->load->model('admmodel');
            $insert = $this->admmodel->ogrenciEkle($data);
            if (isset($insert)) {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Üyelik Kaydınız Başarılı Bir Şekilde Oluşturuldu.
                </div>');
                $this->load->view('yonetim/login');
            }else{
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                Üyelik Kaydınız Oluşturulamadı.
                </div>');
                $this->load->view('yonetim/login');
            }
        } else {
            $this->load->model('akdmodel');
            $inf = $this->akdmodel->akdGetir();
            $data = new stdClass;
            $data->bilgi = $inf;
            $this->load->view('yonetim/register', $data);
        }
    }
*/
    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }
    public function login() // Sign in buton eventi
    {
        $kim = $this->input->post('kim');
        if($kim == "akd")
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('kadi', 'User Name', 'required|trim');
            $this->form_validation->set_rules('sifre', 'Password', 'required|trim');
            $this->form_validation->set_rules('g-
            
            tcha-response','Captcha','callback_recaptcha');			
            if ($this->form_validation->run()) {
                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                $data1 = $this->input->post('kadi');
                $data2 = $this->input->post('sifre');
                $kadi = $this->security->xss_clean($data1);
                $sifre = $this->security->xss_clean($data2);
                $this->load->model('vtmodel');
                $sonuc = $this->vtmodel->akademisyenloginCheck($kadi, $sifre);
                if ($sonuc) {
                    $this->session->set_userdata('kontrol', true); // güvenlik session
                    $this->session->set_userdata('info', $sonuc);
                    redirect('Akademisyen/home');
                } else {
                    $this->session->set_flashdata('hata', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Warning!</h4>
                User Name or Password Wrong!
              </div>');

                    redirect("Yonetim");
                }
            } else
                $this->load->view('yonetim/login/login');
        }
        else if($kim == "ogr")
        {

            $this->load->library('form_validation');
            $this->form_validation->set_rules('kadi', 'E-Mail', 'required|trim');
            $this->form_validation->set_rules('sifre', 'Password', 'required|trim');
            $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
            if ($this->form_validation->run()) {

                $csrf = array(
                    'name' => $this->security->get_csrf_token_name(),
                    'hash' => $this->security->get_csrf_hash()
                );
                $data1 = $this->input->post('kadi');
                $data2 = $this->input->post('sifre');
                $kadi = $this->security->xss_clean($data1);
                $sifre = $this->security->xss_clean($data2);
                $this->load->model('vtmodel');
                $sonuc = $this->vtmodel->ogrenciloginCheck($kadi, $sifre);
                if ($sonuc) {
                    $this->session->set_userdata('kontrol', true); // güvenlik session
                    $this->session->set_userdata('info', $sonuc);
                    redirect('Ogrenci/home');
                } else { //logtut
                    $this->session->set_flashdata('hata', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Hata!</h4>
                Username or Password is incorrect
              </div>');
                    redirect("Yonetim");
                }
            } else
                $this->load->view('yonetim/login/login');
        }
    }
    public function recaptcha($str='')
    {
        $google_url="https://www.google.com/recaptcha/api/siteverify";
        $secret='6Le7iAAVAAAAAM-uw5A9UFTuyvCsI6eNczx5MmN2';
        $ip=$_SERVER['REMOTE_ADDR'];
        $url=$google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $res = curl_exec($curl);
        curl_close($curl);
        $res= json_decode($res, true);
        //reCaptcha success check
        if($res['success'])
        {
            return TRUE;
        }
        else
        {			
            $this->form_validation->set_message('recaptcha', 'Giriş Reddedildi. Lütfen Tekrar Deneyin.');
            return TRUE;
        }
    }
    public function adminLogin()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('kadi', 'E-Mail', 'required|trim');
        $this->form_validation->set_rules('sifre', 'Şifre', 'required|trim');
        if ($this->form_validation->run()) {
            $csrf = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $data1 = $this->input->post('kadi');
            $data2 = $this->input->post('sifre');
            $kadi = $this->security->xss_clean($data1);
            $sifre = $this->security->xss_clean($data2);
            $this->load->model('vtmodel');
            $sonuc = $this->vtmodel->loginCheck($kadi, $sifre);
            if ($sonuc) {                                      //ka veya şifre yanlış mı ?
                $this->session->set_userdata('kontrol', true); // güvenlik session
                $this->session->set_userdata('info', $sonuc);
                redirect('admin/home');
            } else {
                $this->session->set_flashdata('hata', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Hata!</h4>
                E-Mail adresi veya şifre yanlış.
              </div>');
                redirect('admin/login');
            }
        } else
            $this->load->view('yonetim/login/adminLogin');
    }
    public function sifremiUnuttumindex()
    {
        $this->load->view('yonetim/forgotPassword/sifremiUnuttum');
    }
    public function sifremiUnuttum()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('mail', 'Mail', 'required|valid_email|trim');
        $uyeTipi = null;
        if ($this->form_validation->run() == true) {
            $data1 = $this->input->post('mail');
            $uyeTipi = $this->input->post('uyeTipi');
            $gelenMail = $this->security->xss_clean($data1);
            $this->load->model('vtmodel');
            if ($uyeTipi == 1) {
                $kisiBilgileri = $this->vtmodel->akademisyenByMail($gelenMail);
                // sifre olustur basla
                $sifre = $this->sifreOlustur();
                $ID = $kisiBilgileri->ID;
                $data = array(
                    'sifre'=>$sifre
                );
                $this->load->model('admmodel');
                $sonuc=$this->admmodel->akdGuncelle($data,$ID);
                $kisiBilgileri = $this->vtmodel->akademisyenByMail($gelenMail);
                // sifre olustur bitti //
            } else {
                $kisiBilgileri = $this->vtmodel->ogrenciByMail($gelenMail);
                // sifre olustur basla
                $sifre = $this->sifreOlustur();
                $ID = $kisiBilgileri->ID;
                $data = array(
                    'sifre'=>$sifre
                );
                $this->load->model('admmodel');
                $sonuc=$this->admmodel->ogrGuncelle($data,$ID);
                $kisiBilgileri = $this->vtmodel->ogrenciByMail($gelenMail);
                // sifre olustur bitti //
            }
            if ($kisiBilgileri) {

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
                $mail = "Sayın " . $kisiBilgileri->adiSoyadi . ";<br>Bilgileriniz aşağıdadır.<br>Kullanıcı Adınız: ".$kisiBilgileri->kullaniciAdi."<br>Şifreniz: <b>" . $kisiBilgileri->sifre . "</b><br>" . "İyi Günler.";
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($mailaddres);
                $this->email->to($kisiBilgileri->email);
                $this->email->subject("Yeni Şifre");
                $this->email->message($mail);

                if ($this->email->send()) {
                    $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                        E-Mail Başarıyla Gönderildi. 
                        </div>');

                    redirect('Yonetim');

                } else {
                    $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Hata!</h4>
                        E-mail Gönderilemedi.
                        </div>');
                    $this->email->print_debugger();
                    redirect('sifremiUnuttum');
                    
                    /*$this->email->print_debugger();
                    $error = ob_end_clean();
                    $errors[] = $error;
                    print_r($this->email->print_debugger());
                    die();
                    */
                }
            } else {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>
                Sistemde Böyle bir E-Mail Yok
                </div>');
                redirect('sifremiUnuttum');
            }
        } else {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>
                '.validation_errors().'
                </div>');
                redirect('sifremiUnuttum');
            redirect('sifremiUnuttum');
        }

    }
    public function sifremiUnuttumAdminindex()
    {
        $this->load->view('yonetim/forgotPassword/sifremiUnuttumAdmin');
    }
    public function sifremiUnuttumAdmin()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('mail', 'Mail', 'required|valid_email|trim');

        if ($this->form_validation->run() == true) {
            $data1 = $this->input->post('mail');
            $uyeTipi = $this->input->post('uyeTipi');
            $gelenMail = $this->security->xss_clean($data1);
            $this->load->model('vtmodel');
            $kisiBilgileri = $this->vtmodel->adminByMail($gelenMail);
            if ($kisiBilgileri) {
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
                $mail = "Sayın " . $kisiBilgileri->adiSoyadi . ";<br>Bilgileriniz aşağıdadır.<br>Kullanıcı Adınız: ".$kisiBilgileri->kullaniciAdi."<br>Şifreniz: <b>" . $kisiBilgileri->sifre . "</b><br>" . "İyi Günler.";
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from($mailaddres);
                $this->email->to($kisiBilgileri->email);
                $this->email->subject("Yeni Şifre");
                $this->email->message($mail);

                if ($this->email->send()) {
                    $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                        E-Mail Başarıyla Gönderildi
                        </div>');
                    redirect('admin/login');
                } else {
                    $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Hata!</h4>
                        E-mail Gönderilemedi.
                        </div>');
                    redirect('admin/sifremiUnuttum');
                }
            } else {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Hata!</h4>
                Sistemde Böyle bir E-Mail Yok
                </div>');
                redirect('admin/sifremiUnuttum');
            }
        }else{
            $this->load->view('yonetim/forgotPassword/sifremiUnuttumAdmin');
        }
    }
    public function duyuruOku($id)
    {
        $kontrol = $this->session->userdata('info');
        if(isset($kontrol))
        {
            if($kontrol->yetki==2)
            {
                $this->load->model('admmodel');
                $duyuru = $this->admmodel->duyuruByID($id);
                $data = new stdClass;
                $data->duyuru=$duyuru;
                $this->load->view("yonetim/duyurular/duyuruOku",$data);
            }else{
                $this->load->view('yonetim/errorPage/401');
            }
        }else{
            $this->load->view('yonetim/errorPage/401');
        }

    }
    public function iletisim()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('adiSoyadi', 'İsim', 'required|trim');
        $this->form_validation->set_rules('email', 'E-Mail', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('baslik', 'Baslik', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('telefon', 'telefon', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('icerik', 'İçerik', 'required|trim|max_length[255]|min_length[5]');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
        if ($this->form_validation->run() == true) {
            $data1 = $this->input->post('adiSoyadi');
            $data2 = $this->input->post('email');
            $data5 = $this->input->post('baslik');
            $data3 = $this->input->post('telefon');
            $data4 = $this->input->post('icerik');


            $adiSoyadi = $this->security->xss_clean($data1);
            $email = $this->security->xss_clean($data2);
            $baslik = $this->security->xss_clean($data5);
            $telefon = $this->security->xss_clean($data3);
            $icerik = $this->security->xss_clean($data4);
            $ip = $this->input->ip_address();

            $data = array('adSoyad' => $adiSoyadi,
                'email' => $email,
                'baslik' => $baslik,
                'tel' => $telefon,
                'ipAdress' => $ip,
                'icerik' => $icerik,
            );
            $this->load->model('admmodel');
            $insert = $this->admmodel->iletisimEkle($data);
            if (isset($insert)) {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Mesajınız Başarılı Bir Şekilde İletildi.
                </div>');
                $this->load->view('yonetim/iletisim/iletisimFormu');
            }else{
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                Mesajınız Oluşturulamadı.
                </div>');
                $this->load->view('yonetim/iletisim/iletisimFormu');
            }
        } else {
            $this->load->view('yonetim/iletisim/iletisimFormu');
        }

    }
/*
    public function veri($id)
    {
        $this->load->model('Akdmodel');
        $veri = $this->Akdmodel->projeAyrinti($id);
        if($veri)
        {
            $data = new stdClass;            ;
            $data->veri = $veri;
            $this->load->view('yonetim/veri',$data);

        }
    }
*/
    public function sifrele()
    {
        /*
        $this->load->helper('text');
        $sifre = "sifre";

        //$string = ascii_to_entities($sifre);
        $hash = 7;
        $i = 0;
        $sifre2="";
        for ($i =0;$i<strlen($sifre);$i++ ){
            echo $sifre[$i]." karakterin asci karsiligi:".ord($sifre[$i])."<br>";
            echo $i.".hash fonksiyonu".($hash*31)."<br>";
            $hash =  ord($sifre[$i]) + $hash*31  ;
            echo $i.".hash sonucu ".$hash."<br>";
        }
        echo $hash;
        */
        $this->load->helper('text');
        $sifre = "sifre";
        $hash = 7;
        for ($i =0;$i<strlen($sifre);$i++ ){
            $hash =  ord($sifre[$i]) + $hash*31  ;
        }
        echo $hash;
    }
public function projeAra()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('ogrNo', 'Öğrenci Numarası', 'required|trim');
        $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
        if ($this->form_validation->run() == true) {
            $data1 = $this->input->post('ogrNo');
            $ogrNo = $this->security->xss_clean($data1);

            $this->load->model('admmodel');
            $projeBilgisi = $this->admmodel->projeByOgrNo($ogrNo);
            $hocaID = $projeBilgisi->hocaID;
            $projeKodu = $projeBilgisi->projeKodu;
            $this->load->model('akdmodel');
            $hocaBilgisi = $this->admmodel->akademisyenByhocaID($hocaID);

            $ogrenciBilgileri = $this->akdmodel->ogrencininPuani($projeKodu);
            if (!$projeBilgisi) {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
                Sistemde Projeniz Bulunamadı.
                </div>');
                redirect('login');
            }
            $data = new stdClass;
            $data->proje = $projeBilgisi;
            $data->hoca = $hocaBilgisi;
            $data->ogrenci = $ogrenciBilgileri;
            $this->load->view('yonetim/login/projeAra', $data);
        }else{
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Hata!</h4>'.validation_errors().'</div>');
            redirect('login');

        }
    }
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
    public function apkindir()
    {
        
            
            $this->load->helper('download');
            force_download('assets/upload/afis/'.'TezPuanlama.apk',NULL);
            
        
    }



}
?>
