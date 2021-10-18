<?php

class Akdmodel extends CI_Model{
    function akdGetir()
    {
        $result = $this->db->select('*')
            ->from('akademisyen')
	    ->order_by('adiSoyadi','asc')
            ->Where('AG','0')
            ->get()
            ->result();
        return $result;
    }
    function akademisyenProjeleri($id)
    {
        
        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');

        $result = $this->db->select('proje.ID,proje.projeKodu,proje.puan,proje.dosya,proje.videoUrl,proje.projeAdi,proje.hocaID,proje.yil,akademisyen.projeYayinla,akademisyen.adiSoyadi')
            ->from('proje')
            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
            ->where('proje.hocaID',$id)
            ->where('proje.yil',$sistemYili->row()->sistemYili)
            ->get()
            ->result();
        
        if($result)
            return $result;
        else
            return false;
    }
    function hocanınVerdigiPuan($projeKodu,$hocaID)
    {
        $result = $this->db->select('notu')
            ->from('notlar')
            ->where('projeKodu=',$projeKodu)
            ->where('hocaID=',$hocaID)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function akademisyenProjeleriDegerlendirme()
    {

        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');

        $result = $this->db->select('proje.ID,proje.projeKodu,proje.puan,proje.dosya,proje.videoUrl,proje.projeAdi,proje.hocaID,proje.Durum,proje.yil,akademisyen.projeYayinla,akademisyen.adiSoyadi')
            ->from('proje')
            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
            ->where('proje.Durum','Evet')
            ->where('proje.yil',$sistemYili->row()->sistemYili)
            ->get()
            ->result();

        if($result)
            return $result;
        else
            return false;
    }
    function projeAyrinti($id)
    {
        //$query = $this->db->query("SELECT prj.projeKodu,prj.puan,prj.projeAdi,prj.projeAciklama,akd.adiSoyadi FROM proje as prj LEFT OUTER JOIN akademisyen AS akd ON prj.hocaID = akd.hocaID where prj.projeKodu='1234'" );

        $result = $this->db->select('proje.ID,proje.afis,proje.dosya,proje.projeKodu,proje.hocaID,proje.puan,proje.projeAdi,proje.videoURL,proje.projeName,proje.projeDetail,proje.projeAciklama,akademisyen.adiSoyadi,akademisyen.projeYayinla')
            ->from('proje')
            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )
            ->where('proje.projeKodu=',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }    
    function ogrencininPuani($id)
    {
        $result = $this->db->select('ogrenci.ID,ogrenci.sifre,ogrenci.adiSoyadi,ogrenci.ogrNo,proje.puan')
            ->from('ogrenci')
            ->join('proje','proje.projeKodu = ogrenci.projeKodu','left outer' )
            ->where('proje.projeKodu=',$id)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
    function puanVeren($id)
    {
        $result = $this->db->select('notlar.notu,notlar.hocaID,akademisyen.adiSoyadi')
            ->from('notlar')
            ->join('akademisyen','notlar.hocaID = akademisyen.hocaID','left outer' )
            ->where('notlar.projeKodu=',$id)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
    function akademisyenOgrencileri($id)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('hocaID',$id)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
    function ogrencilerim($hocaID,$yil)
    {

        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
        $result = $this->db->select('adiSoyadi,ogrNo,projeAdi,proje.projeKodu,proje.puan,proje.yil')
            ->from('ogrenci')
            ->join('proje','ogrenci.projeKodu = proje.projeKodu','left outer' )
            ->where('ogrenci.hocaID=',$hocaID)
            ->where('year(create_at)',$sistemYili->row()->sistemYili)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
    function projelerim($hocaID)
    {
        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
        $result = $this->db->select('ogrenci.adiSoyadi,ogrenci.sifre,ogrenci.ogrNo,ogrenci.projeKodu,proje.puan,proje.projeAdi')
            ->from('ogrenci')
            ->join('proje','proje.projeKodu = ogrenci.projeKodu','left outer' )
            ->where('ogrenci.hocaID=',$hocaID)
            
            ->get()
            ->result();
            
        
        if($result)
            return $result;
        else
            return false;
    }
    function projeYayindaKontrol($hocaID)
    {
        $result = $this->db->select('*')
            ->from('akademisyen')
            ->where('hocaID=',$hocaID)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function projeDurumKontrol($projeKodu)
    {
        $result = $this->db->select('*')
            ->from('proje')
            ->where('projeKodu=',$projeKodu)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function projeYayinGuncelle($data,$hocaID)
    {
        $result=$this->db->update('akademisyen',$data,array('hocaID'=>$hocaID));
        return $result;
    }
    function projeDurumDegistir($data,$projeKodu)
    {
        $result=$this->db->update('proje',$data,array('projeKodu'=>$projeKodu));
        return $result;
    }
    function notGir($data)
    {
        $result = $this->db->insert('notlar',$data);
        return $result;
    }
    function projeEkle($data)
    {
        $result = $this->db->insert('proje',$data);
        return $result;
    }
    function notGuncelle($data,$id)
    {
        $result=$this->db->update('notlar',$data,array('ID'=>$id));
        return $result;
    }
    function notVerilenProje($hocaID)
    {
        $result = $this->db->select('*')
            ->from('notlar')
            ->where('hocaID',$hocaID)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }



}

?>