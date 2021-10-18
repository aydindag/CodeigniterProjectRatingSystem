<?php

class Vtmodel extends CI_Model{
    function loginCheck($kadi,$sifre){
        $result = $this->db->select('*')
            ->from('yonetim')
            ->where('kullaniciAdi',$kadi)
            ->where('sifre',$sifre)
            ->get()
            ->row();

        if(count($result)>0)
            return $result;
        else
            return false;
    }
    function akademisyenloginCheck($kadi,$sifre){
        $result = $this->db->select('*')
            ->from('akademisyen')
            ->where('kullaniciAdi',$kadi)
            ->where('sifre',$sifre)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function ogrenciloginCheck($kadi,$sifre){
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('kullaniciAdi',$kadi)
            ->where('sifre',$sifre)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
//    function akademisyenEkle($data=array())
//    {
//        $result = $this->db->insert('akademisyen',$data);
//        return $result;
//    }
//    function akademisyencek()
//    {
//        $result = $this->db->select('*')
//            ->from('akademisyen')
//            ->get()
//            ->result();
//        return $result;
//    }
//    function akademisyenByID($id)
//    {
//        $result = $this->db->select('*')
//            ->from('akademisyen')
//            ->where('ID',$id)
//            ->get()
//            ->row();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function akmguncelleVeri($data,$id)
//    {
//        $result=$this->db->update('akademisyen',$data,array('ID'=>$id));
//        return $result;
//    }
//    function veriSil($id,$silVeri)
//    {
//        $result = $this->db->delete($silVeri,array('ID'=>$id));
//        return $result;
//    }
//    function ogrenciEkle($data=array())
//    {
//        $result = $this->db->insert('ogrenci',$data);
//        return $result;
//    }
//    function ogrenciCek()
//    {
//        $result = $this->db->select('*')
//            ->from('ogrenci')
//            ->get()
//            ->result();
//        return $result;
//    }
//    function ogrenciByID($id)
//    {
//        $result = $this->db->select('*')
//            ->from('ogrenci')
//            ->where('ID',$id)
//            ->get()
//            ->row();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
    function ogrenciByMail($id)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('email',$id)            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function ogrenciByNo($id)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('ogrNo',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function adminByMail($id)
    {
        $result = $this->db->select('*')
            ->from('yonetim')
            ->where('email',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function akademisyenByMail($id)
    {
        $result = $this->db->select('*')
            ->from('akademisyen')
            ->where('email',$id)            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    } 
//    function ogrguncelleVeri($data,$id)
//    {
//        $result=$this->db->update('ogrenci',$data,array('ID'=>$id));
//        return $result;
//    }
//    function duyuruEkle($data=array())
//    {
//        $result = $this->db->insert('duyurular',$data);
//        return $result;
//    }
//    function duyuruCek()
//    {
//        $result = $this->db->select('*')
//            ->from('duyurular')
//            ->get()
//            ->result();
//        return $result;
//    }
//    function duyuruByID($id)
//    {
//        $result = $this->db->select('*')
//            ->from('duyurular')
//            ->where('ID',$id)
//            ->get()
//            ->row();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function dyrguncelleVeri($data,$id)
//    {
//        $result=$this->db->update('duyurular',$data,array('ID'=>$id));
//        return $result;
//    }
//    function projeEkle($data=array()){
//        $result = $this->db->insert('proje',$data);
//        return $result;
//    }
//    function ogrenciProjeByID($id)
//    {
//        $result = $this->db->select('proje.afis,proje.dosya,proje.projeKodu,proje.hocaID,proje.puan,proje.projeAdi,proje.projeAciklama,akademisyen.adiSoyadi,akademisyen.projeYayinla')
//            ->from('proje')
//            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
//            ->where('proje.projeKodu=',$id)
//            ->get()
//            ->row();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
    function ogrenciDanismanCek($id){
        $result = $this->db->select('*')
            ->from('akademisyen')
            ->where('ID',$id)            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
//    function akademisyenOgrencileri($id)
//    {
//        $result = $this->db->select('*')
//            ->from('ogrenci')
//            ->where('hocaID',$id)
//            ->get()
//            ->result();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
    function ogrenciByProje($id)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('projeKodu',$id)            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
//    function notGuncelle($data,$id)
//    {
//        $result=$this->db->update('proje',$data,array('ID'=>$id));
//        return $result;
//    }
    function mesajByID($id)
    {
        $result = $this->db->select('*')
            ->from('mesaj')
            ->where('gelenID',$id)            
            ->get()
            ->result();                 

        if($result)
            return $result;
        else
            return false;
    } 
    function mesajByNameogr($name)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('adiSoyadi',$name)            
            ->get()
            ->row();
        
        if($result)
            return $result;
        else
            return false;
          
    } 
    function mesajGonder($data=array())
    {
        $result = $this->db->insert('mesaj',$data);
        return $result;
    }
    function mesajOku($id)
    {
        $result = $this->db->select('*')
            ->from('mesaj')
            ->where('ID',$id)            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function mesajSil($id)
    {
        $result = $this->db->delete('mesaj',array('ID'=>$id));
        return $result;
    }
    function mesajSay()
    {
        $result = $this->db->count_all('mesaj');
        return $result;
    }
    function profilGuncelle($data,$id,$tableName)
    {
        $result=$this->db->update($tableName,$data,array('ID'=>$id));
        return $result;
    }
    function ayarlarıAl()
    {
        $result = $this->db->select('*')
            ->from('ayarlar')            
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function projeByAkademisyenID($id)
    {
        $result = $this->db->select('*')
            ->from('proje')
            ->where('danismanID =',$id) // değişmiş olabilir kontrol et.
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
//    function hocaNotuGir($data)
//    {
//        $result = $this->db->insert('notlar',$data);
//        return $result;
//    }
//    function hocaNotuGuncelle($data,$id)
//    {
//        $result=$this->db->update('notlar',$data,array('ID'=>$id));
//        return $result;
//    }
//    function akademisyenProjeleri($id)
//    {
//        $result = $this->db->select('*')
//            ->from('proje')
//            ->where('hocaID =',$id) // değişmiş olabilir kontrol et.
//            ->get()
//            ->result();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function projeAyrintiIndex($id)
//    {
//        //$query = $this->db->query("SELECT prj.projeKodu,prj.puan,prj.projeAdi,prj.projeAciklama,akd.adiSoyadi FROM proje as prj LEFT OUTER JOIN akademisyen AS akd ON prj.hocaID = akd.hocaID where prj.projeKodu='1234'" );
//
//        $result = $this->db->select('proje.afis,proje.dosya,proje.projeKodu,proje.hocaID,proje.puan,proje.projeAdi,proje.projeAciklama,akademisyen.adiSoyadi,akademisyen.projeYayinla')
//            ->from('proje')
//            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
//            ->where('proje.projeKodu=',$id)
//            ->get()
//            ->row();
//        if($result)
//            return $result;
//        else
//            return false;
//
//    }

//    function ogrenciandpuan($id)
//    {
//        $result = $this->db->select('ogrenci.adiSoyadi,ogrenci.ogrNo,proje.puan')
//            ->from('ogrenci')
//            ->join('proje','proje.projeKodu = ogrenci.projeKodu','left outer' )
//            ->where('proje.projeKodu=',$id)
//            ->get()
//            ->result();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function puanVeren($id)
//    {
//        $result = $this->db->select('notlar.notu,notlar.hocaID,akademisyen.adiSoyadi')
//            ->from('notlar')
//            ->join('akademisyen','notlar.hocaID = akademisyen.hocaID','left outer' )
//            ->where('notlar.projeKodu=',$id)
//            ->get()
//            ->result();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function hocanınVerdigiPuan($projeKodu,$hocaID)
//    {
//        $result = $this->db->select('notu')
//            ->from('notlar')
//            ->where('projeKodu=',$projeKodu)
//            ->where('hocaID=',$hocaID)
//            ->get()
//            ->row();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function projelerim($hocaID)
//    {
//        $result = $this->db->select('ogrenci.adiSoyadi,ogrenci.ogrNo,ogrenci.projeKodu,proje.puan,proje.projeAdi')
//            ->from('ogrenci')
//            ->join('proje','proje.projeKodu = ogrenci.projeKodu','left outer' )
//            ->where('proje.hocaID=',$hocaID)
//            ->where('proje.yil=',"2019")
//            ->get()
//            ->result();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function projeYayindaKontrol($hocaID)
//    {
//        $result = $this->db->select('*')
//            ->from('akademisyen')
//            ->where('hocaID=',$hocaID)
//            ->get()
//            ->row();
//
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    function projeYayinGuncelle($data,$hocaID)
//    {
//        $result=$this->db->update('akademisyen',$data,array('hocaID'=>$hocaID));
//        return $result;
//    }
//    function ogrencininDanismani($id)
//    {
//
//        $result = $this->db->select('akademisyen.adiSoyadi')
//            ->from('ogrenci')
//            ->join('akademisyen', 'ogrenci.hocaID = akademisyen.hocaID', 'left outer')
//            ->where('ogrenci.ID =', $id)
//            ->get()
//            ->row();
//        if ($result)
//            return $result;
//        else
//            return false;
//    }
//    public function projeGrubuGetir($projeKodu)
//    {
//        $result = $this->db->select('*')
//            ->from('ogrenci')
//            ->where('projeKodu',$projeKodu)
//            ->get()
//            ->result();
//        if($result)
//            return $result;
//        else
//            return false;
//    }
//    public function gruptanCik($data,$id)
//    {
//        $result=$this->db->update('ogrenci',$data,array('ID'=>$id));
//        return $result;
//    }

}

?>