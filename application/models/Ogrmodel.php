<?php
class ogrmodel extends CI_Model{
    function ogrenciProjeByID($id)
    {
        $result = $this->db->select('proje.afis,proje.dosya,proje.projeKodu,proje.videoUrl,proje.hocaID,proje.puan,proje.projeAdi,proje.projeName,proje.projeDetail,proje.projeAciklama,akademisyen.adiSoyadi,akademisyen.projeYayinla')
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
    function ogrencininDanismani($id)
    {

        $result = $this->db->select('akademisyen.adiSoyadi')
            ->from('ogrenci')
            ->join('akademisyen', 'ogrenci.hocaID = akademisyen.hocaID', 'left outer')
            ->where('ogrenci.ID =', $id)
            ->get()
            ->row();
        if ($result)
            return $result;
        else
            return false;
    }
    function projeEkle($data=array()){
        $result = $this->db->insert('proje',$data);
        return $result;
    }
    function ogrenciByOgrNo($ogrNo)
    {
        $result = $this->db->select('ogrenci.adiSoyadi,ogrenci.kullaniciAdi,ogrenci.email,ogrenci.ogrNo,ogrenci.projeKodu,ogrenci.sifre,ogrenci.profilFoto,ogrenci.hocaID,ogrenci.egitim,ogrenci.location,ogrenci.yetenek,proje.projeAdi,proje.projeKodu')
            ->from('ogrenci')
            ->join('proje','ogrenci.projeKodu = proje.projeKodu','left outer' )
            ->where('ogrenci.ogrNo=',$ogrNo)
            ->get()
            ->row();

        if($result)
            return $result;
        else
            return false;
    }
    public function projeGrubuGetir($projeKodu)
    {
        $result = $this->db->select('*')
            ->from('ogrenci')
            ->where('projeKodu',$projeKodu)
            ->get()
            ->result();
        if($result)
            return $result;
        else
            return false;
    }
    public function gruptanCik($data,$id)
    {
        $result=$this->db->update('ogrenci',$data,array('ID'=>$id));
        return $result;
    }
    function ogrGuncelle($data,$id)
    {
        $result=$this->db->update('ogrenci',$data,array('ID'=>$id));
        return $result;
    }
    function projeGuncelle($data,$projeKodu)
    {
        $result=$this->db->update('proje',$data,array('projeKodu'=>$projeKodu));        
        return $result;
    }

}