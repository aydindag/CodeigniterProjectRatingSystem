<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends CI_Controller {

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
            redirect('yonetim/errorpage');
        }
        else{ //logtut?

        }
    }
    public function index()
    {
        $kontrol = $this->session->userdata('info');
        if($kontrol->yetki == 1){
            //akademisyenleri listeler.
            $this->load->model('akdmodel');
            $sonuc=$this->akdmodel->akdGetir();
            $data = new stdClass;
            $data->info=$sonuc;
            $this->load->view('akademisyen/mobil/akademisyenMain',$data);
        }else{ //logtut
            $this->load->view('yonetim/errorPage/401');
        }
    }
    public function projeler($hocaID)
    {
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->akademisyenProjeleri($hocaID);	    
        $data = new stdClass;
        $data->info=$sonuc;
	    $this->load->view('akademisyen/mobil/akademisyenProjeleri',$data);
    }
    public function degerlendirme()
    {
        $this->load->model('akdmodel');
        $sonuc=$this->akdmodel->akademisyenProjeleriDegerlendirme();
        $data = new stdClass;
        $data->info=$sonuc;
        $this->load->view('akademisyen/mobil/degerlendirme',$data);
    }
    public function ara() // akademisyenMainİndex'teki sayfadaki Search buttonunun click eventi.
    {
        $projeId = $this->input->post('projeID');
        $proje = $this->db->query("select ID from proje where durum='Evet' and projeKodu='".$projeId."'");
        if($proje->num_rows()!=0)
        {
            redirect('Akademisyen/Home/projeAyrinti/'.$projeId);
        }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
            Aradığınız Proje Bulunamadı.
            </div>');
            redirect('Akademisyen/Home');
        }


    }
    public function projeAyrinti($projeId)
    {        
        $kontrol = $this->session->userdata('info');
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
        //hocanın projeye verdiği not        
        $this->load->model('akdmodel');
        $res2 = $this->akdmodel->hocanınVerdigiPuan($projeId,$kontrol->hocaID);
        $data->inf3=$res2;
        //mesajlar        
        $this->load->model('vtmodel');
        $cekilenVeri = $this->vtmodel->mesajByID($kontrol->ID);
        if($cekilenVeri)
        {            
            $data->bilgi=$cekilenVeri;
            $veri = array();
            $isimler = array();
            $projeNum = array();
            for($i=0;$i<sizeof($cekilenVeri);$i++) { 
                $veri[$i]=$cekilenVeri[$i]->gidenID;
                $this->load->model('admmodel');
                $ogrbilgisi = $this->admmodel->ogrenciByID($veri[$i]);
                $isimler[$i]= $ogrbilgisi->adiSoyadi;
                $projeNum[$i]= $ogrbilgisi->projeKodu;
            }
            $data->isimler=$isimler;  
            $data->projeKodu=$projeNum;            
        }
        else{            
            $data->bilgi=null;            
        }
        //print_r($data);        
        //die();
        $this->load->view("akademisyen/mobil/projeAyrintiIndex",$data);
    }
    public function not($id,$yer,$gelenHocaID)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('projeID', 'Not', 'required|trim|numeric|less_than_equal_to[100]|greater_than_equal_to[0]');
      
        if ($this->form_validation->run() == true) {
            $kontrol = $this->session->userdata('info');
            $hocaID = $kontrol->hocaID;
            $notu = $this->input->post('projeID');
            $ip = $this->input->ip_address();
            $data = array('notu' => $notu,
                'hocaID' => $hocaID,
                'projeKodu' => $id,
                'ipAdress' => $ip,
            );
            $notGirildimi = $this->db->query("select ID from notlar where hocaID='" . $kontrol->hocaID . "' and projeKodu='" . $id . "'");
            if ($notGirildimi->row()->ID != "") // hoca daha önce not girdiyse günceller.
            {
                $this->load->model('akdmodel');
                $sonuc = $this->akdmodel->notGuncelle($data, $notGirildimi->row()->ID);
            } else { // daha önce not girmediyse yeni not ekler.
                $this->load->model('akdmodel');
                $sonuc = $this->akdmodel->notGir($data);
            }
            $query = $this->db->query("SELECT AVG(notlar.notu) as ort FROM `notlar` WHERE notlar.projeKodu='" . $id . "'");
            $ort = $query->row()->ort;
            $this->db->query("UPDATE proje SET puan =" . $ort . " WHERE projeKodu ='" . $id . "'");
            if ($sonuc) { // veritabanına eklendiyse onay mesajı verir.
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
            Not Verme İşlemi Başarılı
            </div>');
                if ($yer == 1)
                    redirect('akademisyen/proje/' . $id);
                else if ($yer == 2)
                    redirect('akademisyen/projeler/' . $gelenHocaID);
                else if ($yer == 3)
                    redirect('/Akademisyen/home/degerlendirme');
            } else {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarısız!</h4>
            Not Verme İşlemi Başarılamadı
            </div>');
                redirect('Akademisyen/Home');
            }
        }else {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Hata!</h4>'.validation_errors().'</div>');
            if ($yer == 1)
                redirect('akademisyen/proje/' . $id);
            else if ($yer == 2)
                redirect('akademisyen/projeler/' . $gelenHocaID);
        }
    }
    public function projelerim()
    {
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $this->load->model('akdmodel');
        $info=$this->akdmodel->projelerim($hocaID);        
        $info2=$this->akdmodel->projeYayindaKontrol($hocaID);
        $data = new stdClass;
        $data->info=$info;
        $data->info2 = $info2;
        $this->load->view('akademisyen/mobil/projelerim',$data);
    }
    public function projeleriYayinla()
    {
        $yayin = $this->input->post('yayin');
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $data = array('projeYayinla' => $yayin
        );
        $this->load->model('akdmodel');
        $info=$this->akdmodel->projeYayinGuncelle($data,$hocaID);
        if($info)
        {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
            İşlem Başarıyla Gerçekleşti.
            </div>');
            //$this->akademisyenMainindex();
            redirect('Akademisyen/projelerim');
        }


    }
    public function durumuDegistir()
    {
        $yayin = $this->input->post('yayin');
        $projeKodu = $this->input->post('projeKodu');
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $data = array('durum' => $yayin
        );
        $this->load->model('akdmodel');
        $info=$this->akdmodel->projeDurumDegistir($data,$projeKodu);
        if($info)
        {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
            İşlem Başarıyla Gerçekleşti.
            </div>');
            //$this->akademisyenMainindex();
            redirect('akademisyen/projeler/'.$hocaID);
        }
    }
    public function ogrSil()
    {
        $id = $this->input->post('id'); 
        
        $projeKodu = $this->input->post('projeKodu'); 
        $this->load->model('admmodel');
        $delete = $this->admmodel->veriSil($id,'ogrenci');
        if(isset($delete))
        {
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i>Başarılı!</h4>
            Silme İşlemi Başarılı!
            </div>');            
            redirect('Akademisyen/Home/projeAyrinti/'.$projeKodu);
        }
    }
    public function projeSil()
    {
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $projeKodu = $this->input->post('projeKodu');    
        $projeID = $this->input->post('projeID');  
        $projeKontrol = $this->db->query("select ID from ogrenci where projeKodu='" . $projeKodu . "'"); 
        if($projeKontrol->num_rows()==0){
            $this->load->model('admmodel');
            $delete = $this->admmodel->veriSil($projeID,"proje"); //projesiler
            $notlariSil = $this->admmodel->projeNotuSil($projeKodu,"notlar");
            if(isset($delete))
            {
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>Başarılı!</h4>
                Proje, notlarıyla birlikte başarıyla silindi.
                </div>');            
                redirect('Akademisyen/Home/projeler/'.$hocaID);

            }
        }else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>Hata!</h4>
                Projede öğrenci olduğu için silinemedi.
                </div>');            
                redirect('Akademisyen/Home/projeler/'.$hocaID);
        }
    
    }
     public function notDokumu()
    {
        $kontrol = $this->session->userdata('info');
        $hocaID = $kontrol->hocaID;
        $this->load->model('akdmodel');
        $fileName = $kontrol->hocaID.'OgrNotDokumu.xlsx';
        $employeeData = $this->akdmodel->projelerim($hocaID);
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Ogr No');
        $sheet->setCellValue('B1', 'Adı Soyadı');
        $sheet->setCellValue('C1', 'Proje Kodu');
        $sheet->setCellValue('D1', 'Proje Adı');
        $sheet->setCellValue('E1', 'Not');
        $rows = 2;
        foreach ($employeeData as $val){

            $sheet->setCellValue('A' . $rows, $val->ogrNo);
            $sheet->setCellValue('B' . $rows, $val->adiSoyadi);
            $sheet->setCellValue('C' . $rows, $val->projeKodu);
            $sheet->setCellValue('D' . $rows, $val->projeAdi);
            $sheet->setCellValue('E' . $rows, $val->puan);
            $rows++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save("assets/notdokumu/".$fileName);
        header("Content-Type: application/vnd.ms-excel");
        $this->load->helper('download');
        force_download('assets/notdokumu/'.$kontrol->hocaID.'OgrNotDokumu.xlsx',NULL);

    }
    public function projeEkle()
    {        
        $this->load->view('akademisyen/mobil/projeEkle');
	}
    public function projeEkleButton()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('projeAdi', 'Proje Adı', 'required|trim|max_length[100]|min_length[5]');       
        if ($this->form_validation->run() == true) {
            $kontrol = $this->session->userdata('info');            
            $result = $this->db->select('proje.projeKodu,proje.puan,proje.projeAdi,proje.hocaID,proje.yil,akademisyen.projeYayinla,akademisyen.adiSoyadi')
            ->from('proje')
            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
            ->where('proje.hocaID',$kontrol->hocaID)            
            ->get()
            ->result();            
            $projeSayisi= count($result);
            $projeSayisi++;            
            $projeKodu= $kontrol->hocaKodu.$projeSayisi;
            $projeAdi = $this->input->post('projeAdi');                    
            $data = array('projeAdi'=>$projeAdi,                   
                   'projeKodu'=>$projeKodu,                   
                   'hocaID'=>$kontrol->hocaID,
                   'yil'=>'2019',
                    );
             $this->load->model('akdmodel');
             $insert=$this->akdmodel->projeEkle($data);
             $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
                Proje Başarıyla Eklendi.
                </div>');
             redirect('akademisyen/projeler/' . $kontrol->hocaID);
        }else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Error!</h4>
                '.validation_errors().'</div>');
             $this->load->view('akademisyen/mobil/projeEkle');
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

        return $password;
    }
    public function ogrenciEkle($projeKodu)
    {
        $kontrol = $this->session->userdata('info');
        $projeKontrol = $this->db->query("select * from proje where hocaID='" . $kontrol->hocaID . "' and projeKodu='" . $projeKodu . "'");       
        if ($projeKontrol->num_rows()!=0){  //hoca sadece kendi projesine öğrenci ekler. Onun kontrolünü yapar.          
            $this->load->model('admmodel');
            $inf=$this->admmodel->ogrenciListesi();
            $data = new stdClass;
            $data->bilgi=$inf;
            $data->projeBilgi=$projeKodu;
            $this->load->view('akademisyen/mobil/ogrenciEkle',$data);
            }
        else{
            $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Başarısız!</h5>
            Sadece Kendi Projelerinize Öğrenci Ekleyebilirsiniz.
            </div>');
            redirect('Akademisyen/Home/projeAyrinti/'.$projeKodu);
        }        
    }
    public function ogrenciEkleButton($projeId)
    {
        
        $kontrol = $this->session->userdata('info');
        $adsoyad = $this->input->post('adsoyad');
        $kadi= $this->input->post('ogrNo');
        $kadi = trim($kadi);        
        $mail = $kadi."@ogrenci.karabuk.edu.tr";
        $password = $this->sifreOlustur();
        $ogrNo = $kadi;
        $sube = "0";
        $projeKodu = $projeId;
        $hocaID = $kontrol->hocaID;

        $data = array('adiSoyadi'=>$adsoyad,
        'kullaniciAdi'=>$kadi,
        'email'=>$mail,
        'ogrNo'=>$ogrNo,
        'sifre'=>$password,
        'sube'=>$sube,
        'projeKodu'=>$projeKodu,
        'hocaID'=>$hocaID,
        );
        //öğrenciyi veritabanına ekler.
        $this->load->model('admmodel');
        $insert=$this->admmodel->ogrenciEkle($data);
        //eklenen öğrenciye mail gönderme start
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
        $mailconent = "Sayın " . $adsoyad . ";<br>Bilgileriniz aşağıdadır.<br>Kullanıcı Adınız: ".$kadi."<br>Şifreniz: <b>" . $password . "</b><br>" . "İyi Günler.";
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($mailaddres);
        $this->email->to($mail);
        $this->email->subject("Üyeliğiniz Oluştuldu");
        $this->email->message($mailconent);  
        //$this->email->send()
        if ($this->email->send()) {                
            $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Başarılı!</h4>
            Öğrenci Başarıyla Eklendi. Kullanıcı Bilgileri Mail Olarak Gönderildi.
            </div>');
        redirect('Akademisyen/Home/projeAyrinti/'.$projeKodu);
        } else { 
            $hatamesaji = $this->email->print_debugger(['subject']);
            $this->session->set_flashdata('emailGonderildi', '<div style="margin-top:10px;" class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Öğrenci Eklendi Ancak Mail Gönderilemedi</h5>            
            '.$hatamesaji.'
            </div>');
        redirect('Akademisyen/Home/projeAyrinti/'.$projeKodu);

        }
        //eklenen öğrenciye mail gönderme end
	}
    public function eskiogrEkle($projeId)
    {
        $students = $this->input->post('ogr'); //formdan veri alınır.
        $kontrol = $this->session->userdata('info');
        $projeKodu =$projeId;
        $data = array(
            'projeKodu'=>$projeKodu
            );
        foreach ($students as $ID){
            $this->load->model('ogrmodel');
            echo $ID." - ";
            $sonc = $this->ogrmodel->ogrGuncelle($data,$ID);
        }
        redirect('Akademisyen/Home/projelerim');
	}    
}
