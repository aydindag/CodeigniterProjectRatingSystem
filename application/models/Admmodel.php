<?php

class Admmodel extends CI_Model
{
    function akademisyenByID($id)
    {
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
function tumProjeler()
    {
        
        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
        $result = $this->db->select('proje.ID,proje.projeKodu,proje.puan,proje.projeAdi,proje.hocaID,proje.yil,akademisyen.projeYayinla,akademisyen.adiSoyadi')
            ->from('proje')
            ->join('akademisyen','proje.hocaID = akademisyen.hocaID','left outer' )            
            ->where('proje.yil',$sistemYili->row()->sistemYili)
            ->get()
            ->result();        
        if($result)
            return $result;
        else
            return false;
    }
function akademisyenByhocaID($id)
    {
        $result = $this->db->select('*')
            ->from('akademisyen')
            ->where('hocaID',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
function projeByOgrNo($ogrNo)
    {

        $result = $this->db->select('proje.projeKodu,proje.projeAdi,proje.hocaID')
            ->from('proje')
            ->join('ogrenci','proje.projeKodu = ogrenci.projeKodu','left outer' )
            ->where('ogrenci.ogrNo=',$ogrNo)
            ->get()
            ->row();
        if($result)
            return $result;
        else
            return false;
    }
    function ogrenciByID($id)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('ID',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function ogrenciListesi()
    {
        $sistemYili = $this->db->query('SELECT sistemYili FROM ayarlar where ID=1');
        $result = $this->db->select('*')
            ->from('ogrenci')            
            ->get()
            ->result();
        return $result;
    }
    function yoneticiByID($id)
    {
        $result = $this->db->select('*')
            ->from('yonetim')
            ->where('ID',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function akdGuncelle($data,$id)
    {
        $result=$this->db->update('akademisyen',$data,array('ID'=>$id));
        return $result;
    }
    function akademisyenEkle($data=array())
    {
        $result = $this->db->insert('akademisyen',$data);
        return $result;
    }
    function veriSil($id,$data)
    {
        $result = $this->db->delete($data,array('ID'=>$id));
        return $result;
    }
function projeNotuSil($projeKodu,$data)
    {
        $result = $this->db->delete($data,array('projeKodu'=>$projeKodu));
        return $result;
    }
    function projeninOgrencileriSil($projeKodu,$data)
    {
        $result = $this->db->delete($data,array('projeKodu'=>$projeKodu));
        return $result;
    }
    function ogrenciEkle($data=array())
    {
        $result = $this->db->insert('ogrenci',$data);
        return $result;
    }
    function ogrGuncelle($data,$id)
    {
        $result=$this->db->update('ogrenci',$data,array('ID'=>$id));
        return $result;
    }
    function duyuruGetir()
    {
        $result = $this->db->select('*')
            ->from('duyurular')
            ->get()
            ->result();
        return $result;
    }
    function duyuruEkle($data=array())
    {
        $result = $this->db->insert('duyurular',$data);
        return $result;
    }
    function ayarlar()
    {
        $result = $this->db->select('*')
            ->from('ayarlar')
            ->where('ID',"1")
            ->get()
            ->row();
        if($result)
            return $result;
        else
            return false;
    }
    function ayarlarGuncelle($data,$id)
    {
        $result=$this->db->update('ayarlar',$data,array('ID'=>$id));
        return $result;
    }
    function duyuruByID($id)
    {
        $result = $this->db->select('*')
            ->from('duyurular')
            ->where('ID',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    function duyuruGuncelle($data,$id)
    {
        $result=$this->db->update('duyurular',$data,array('ID'=>$id));
        return $result;
    }
    function iletisimListesi()
    {
        $result = $this->db->select('*')
                ->from('iletisim')
                ->get()
                ->result();
            return $result;
    }
    function iletisimEkle($data=array())
    {
        $result = $this->db->insert('iletisim',$data);
        return $result;
    }
    function iletisimByID($id)
    {
        $result = $this->db->select('*')
            ->from('iletisim')
            ->where('ID',$id)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }

}

?>