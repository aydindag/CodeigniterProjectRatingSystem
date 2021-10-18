<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class profilPaneli extends CI_Controller{
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
            redirect('yonetim');
            //$this->load->view('yonetim/login');
        }
        else{

        }
    }
    function index(){
        $this->load->model('admmodel');
        $kontrol = $this->session->userdata('info');
        /*if($this->session->userdata('hataKontrol'))
        {
            $hataKontrol = $this->session->userdata('hataKontrol');
            $data['hataKontrol'] = $hataKontrol;
            $this->session->unset_userdata('hataKontrol');
        }
        else{
            echo "girmedim";
        }
        */
        if($kontrol->yetki==1)
            $inf=$this->admmodel->akademisyenByID($kontrol->ID);
        else if($kontrol->yetki==2)
            $inf=$this->admmodel->ogrenciByID($kontrol->ID);
        else if($kontrol->yetki==0)
            $inf=$this->admmodel->yoneticiByID($kontrol->ID);
        if($inf)
        {
            $data['inf']=$inf;
            //print_r($data);
            //die();
            $this->load->view('profil/profil',$data);
        }else{ //veritabanı hatası logtut.
            $this->load->view('yonetim/errorPage/500');
        }
    }
    function profilGuncelle()
    {
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->form_validation->set_rules('name', 'isim', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('mail', 'E-Mail', 'required|trim|max_length[50]');
        $this->form_validation->set_rules('username', 'kullanıcı Adı', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('sifre', 'sifre', 'required|trim|callback_password_check|min_length[6]|max_length[15]');
        if ($this->form_validation->run() == true) {
            $name = $this->input->post('name');
            $mail= $this->input->post('mail');
            $username = $this->input->post('username');
            $sifre = $this->input->post('sifre');
            $Education = $this->input->post('Education');
            $location = $this->input->post('location');
            $skills = $this->input->post('skills');
            $data = array('adiSoyadi' => $name,
                'kullaniciAdi' => $username,
                'email' => $mail,
                'sifre' => $sifre,
                'egitim' => $Education,
                'location' => $location,
                'yetenek' => $skills
            );
            $this->load->model('vtmodel');
            $kontrol = $this->session->userdata('info');
            if ($kontrol->yetki == 2)
                $sonuc = $this->vtmodel->profilGuncelle($data, $kontrol->ID, "ogrenci");
            else if ($kontrol->yetki == 1)
                $sonuc = $this->vtmodel->profilGuncelle($data, $kontrol->ID, "akademisyen");
            else if ($kontrol->yetki == 0)
                $sonuc = $this->vtmodel->profilGuncelle($data, $kontrol->ID, "yonetim");
            if (isset($sonuc)) {
                $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;margin-left:15px;margin-right:15px;" class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
                        Profiliniz Başarılı Bir Şekilde Güncellendi!
                    </div>');
                redirect('Profil/profilPaneli/index');
            } else { //veritabanı hatası, logtut.
                $this->load->view('yonetim/errorPage/500');
            }
        }else {
            $this->session->set_flashdata('ekleBasari', '<div style="margin-top:10px;" class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Hata!</h4>'.validation_errors().'</div>');
            redirect('Profil/profilPaneli/index');
        }
    }
    public function password_check($str)
    {
        if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
            return TRUE;
        }
        return FALSE;
    }
    function profilFotoGuncelle()
    {
        $config['upload_path']   = 'assets/upload/profile/';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']      = 2048;

        $this->upload->initialize($config);
        $this->load->library('upload', $config);

        //fotoğraf eklemek//
        if ( !$this->upload->do_upload('userfile')){ // logtut
            $error = array('error' => $this->upload->display_errors());
            $hatastd = array('hata'=>$error['error']
            );
            $this->session->set_userdata('hataKontrol', $hatastd);
            $this->index();
        }else{
            $data = array('upload_data' => $this->upload->data());
            $profilFoto=$this->upload->data('file_name');
            $data = array(
                'profilFoto'=>$profilFoto
            );
            $this->load->model('vtmodel');
            $kontrol = $this->session->userdata('info');
            if($kontrol->yetki==2)
            {
                $sonuc=$this->vtmodel->profilGuncelle($data,$kontrol->ID,"ogrenci");
            }
            else{
                $sonuc=$this->vtmodel->profilGuncelle($data,$kontrol->ID,"akademisyen");
            }
            if($sonuc)
            {
                $this->session->set_flashdata('ekleBasari','<div style="margin-top:10px;margin-left:15px;margin-right:15px;" class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Güncelleme Başarılı!</h4>
                            Profiliniz Başarılı Bir Şekilde Güncellendi!
                        </div>');
                redirect('Profil/profilPaneli/index');
            }
            else{
                $this->load->view('yonetim/errorPage/500');
            }
        }
    }

}

?>
