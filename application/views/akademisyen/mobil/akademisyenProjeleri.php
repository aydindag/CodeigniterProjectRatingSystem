<?php $this->load->view('yonetim/include/headerMobil'); ?>

<!-- Default box -->
<?php echo $this->session->flashdata('ekleBasari'); ?>
<?php $kontrol = $this->session->userdata('info');
    $url=$this->uri->segment(3);
   
    $query = $this->db->query("SELECT * FROM akademisyen WHERE hocaID=" . $url);
    $hoca = $query->row();
    //echo $hoca->adiSoyadi; 

?>
<?php if($url==$kontrol->hocaID){ ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Proje Ekleme</h3>
    </div>
    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/projeEkleButton'); ?>" enctype="multipart/form-data">

        <div class="form-row p-2" style="position: relative;margin-left:290px;">
            <div class="col">
                <input name="projeAdi" placeholder="Proje Adı" type="text" class="form-control">
            </div>
            <div class="col">
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <button type="submit" class="btn btn-primary btn-flat">Ekle</button>
            </div>
        </div>
        <!-- /.box-body -->        
    </form>
    <!-- /.box-footer-->
</div>
<?php } ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?=$hoca->adiSoyadi ?>  Proje Listesi </h3>

    </div>
    <div class="box-body table-responsive p-2">
        <?php $kontrol = $this->session->userdata('info'); 
        
        ?>
        <table id="tablepadding">
            <tbody>
                <tr>
                    <th>Kod</th>
                    <?php if($info){ ?>
                    <?php if($info[0]->hocaID==$kontrol->hocaID){ ?>
                    <th>Notu </th>
                    <?php } } ?>
                    <th style="min-width:180px">Proje Adı</th>
                    <th>Proje Raporu</th>
                    <th>Proje Videosu</th>
                    <th style="min-width:180px">Verilen Not</th>
                    <?php if($info[0]->hocaID==$kontrol->hocaID){ ?>
                    <th>Durum</th>
                    <?php } ?>
                    <th>Ayrıntı</th>
                    <?php if($info[0]->hocaID==$kontrol->hocaID){ ?>
                    <th>Sil</th>
                    <?php } ?>

                </tr>

                <?php if($info){ ?>
                <?php foreach ($info as $info){ ?>
                <?php if($kontrol->hocaID != $info->hocaID){ ?>
                <!-- proje hocası başkasıysa -->
                <?php
                   
                   $durumOgren = $this->db->query("SELECT durum FROM proje WHERE projeKodu='" . $info->projeKodu . "'");
                   $durumSonucu = $durumOgren->row()->durum;
                ?>
                <?php if($durumSonucu=="Evet"){ ?>
                <tr>
                    <td id="projeKodu"><?php echo $info->projeKodu ?></td>
                    <?php  if($info->hocaID==$kontrol->hocaID){ ?>
                    <td>
                        <?php echo $info->puan; ?>
                    </td>
                    <?php } ?>
                    <td style="min-width:180px" id="projeAdi"><a href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>"><?php echo $info->projeAdi ?></a></td>
                    
                    <?php if($info->dosya!=""){ ?>
                    <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeDosyaindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                    <?php }else{ ?>
                    <td><i class="far fa-times-circle fa-2x"></i> </td>
                    <?php } ?>
                    
                    <td>
                    <?php 
                    if  ($info->videoUrl != "") { ?>
                    Var
                    <?php } ?>
                    </td>
                    
                    <td style="min-width:180px" id="projenot">
                        <div class="form-group">
                            <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/not/'); echo ''.$info->projeKodu.'/2/'.$info->hocaID.'' ?>" enctype="multipart/form-data">
                                <div class="input-group input-group-sm">
                                    <?php
                                        $kontrol = $this->session->userdata('info');
                                        $this->load->model('akdmodel');
                                        $inf3 = $this->akdmodel->hocanınVerdigiPuan($info->projeKodu,$kontrol->hocaID);
                                        ?>
                                    <div class="input-group-addon">
                                        <i class="fa fa-eye-slash mr-1" style="margin-top:30%" aria-hidden="true" onclick="togglePassword('<?php echo $info->projeKodu ?>')"></i>
                                    </div>
                                    <input id="<?php echo $info->projeKodu ?>" style="width:90px;" name="projeID" type="number" pattern="[0-9]*" inputmode="numeric" value="<?php if(isset($inf3->notu)){ echo $inf3->notu;}?>" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-sign-in-alt"></i></button>
                                    </span>
                                </div>

                            </form>
                        </div>
                    </td>
                    <td><a type="button" style="margin-bottom: 15px" class="btn btn-warning" href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>"> Detay </a></td>
                    <td><?php echo $info->videoUrl ?></td>
                </tr>
                <?php } ?>
                <?php } ?>
                <?php if($kontrol->hocaID == $info->hocaID){ ?>
                <!-- proje hocası oturum sahibiyse -->
                <tr>
                    <td id="projeKodu"><?php echo $info->projeKodu ?></td>
                    <?php  if($info->hocaID==$kontrol->hocaID){ ?>
                    <td>
                        <?php echo $info->puan; ?>
                    </td>
                    <?php } ?>
                    <td style="min-width:180px" id="projeAdi"><a href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>"><?php echo $info->projeAdi ?></a></td>
                    <td>
                    <?php 
                    if  ($info->dosya != "") { ?>
                    Var
                    <?php } ?>
                    </td>
                    <td>
                    <?php 
                    if  ($info->videoUrl != "") { ?>
                    Var
                    <?php } ?>
                    </td>
                    
                    <td style="min-width:180px" id="projenot">
                        <div class="form-group">
                            <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/not/'); echo ''.$info->projeKodu.'/2/'.$info->hocaID.'' ?>" enctype="multipart/form-data">
                                <div class="input-group input-group-sm">
                                    <?php
                                        $kontrol = $this->session->userdata('info');
                                        $this->load->model('akdmodel');
                                        $inf3 = $this->akdmodel->hocanınVerdigiPuan($info->projeKodu,$kontrol->hocaID);
                                        ?>
                                    <div class="input-group-addon">
                                        <i class="fa fa-eye-slash mr-1" style="margin-top:30%" aria-hidden="true" onclick="togglePassword('<?php echo $info->projeKodu ?>')"></i>
                                    </div>
                                    <input id="<?php echo $info->projeKodu ?>" style="width:90px;" name="projeID" type="password" pattern="[0-9]*" inputmode="numeric" value="<?php if(isset($inf3->notu)){ echo $inf3->notu;}?>" type="text" class="form-control">
                                    <span class="input-group-btn">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-sign-in-alt"></i></button>
                                    </span>
                                </div>

                            </form>
                        </div>
                    </td>
                    <td>
                        <form method="post" role="form" action="<?php echo base_url('Akademisyen/Home/durumuDegistir'); ?>">
                            <?php
                            $durumOgren = $this->db->query("SELECT durum FROM proje WHERE projeKodu='" . $info->projeKodu . "'");
                            $durumSonucu = $durumOgren->row()->durum;
                            ?>
                            <?php if($durumSonucu=="Hayır"){ ?>
                            <input name="yayin" type="hidden" value="Evet">
                            <input name="projeKodu" type="hidden" value="<?php echo $info->projeKodu ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn bg-red btn-sm ">Yayında Değil</button>
                            <?php } else{ ?>
                            <input name="yayin" type="hidden" value="Hayır">
                            <input name="projeKodu" type="hidden" value="<?php echo $info->projeKodu ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn bg-olive btn-sm ">Yayında </button>
                            <?php } ?>
                        </form>
                    </td>
                    <td><a type="button" style="margin-bottom: 15px" class="btn btn-warning btn-sm" href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>">Detay</a></td>
                    <td>
                        <form method="post" role="form" action="<?php echo base_url('Akademisyen/Home/projeSil'); ?>">
                            <input name="projeKodu" type="hidden" value="<?php echo $info->projeKodu ?>">
                            <input name="projeID" type="hidden" value="<?php echo $info->ID ?>">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit"  onclick="return confirm('Silinecek!! Emin misiniz?')" class="btn bg-red btn-sm ">  Sil  </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                <?php } ?>
                <?php }else {
                echo "<tr><td>Gösterilecek Kayıt Bulunamadı.<td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->

<script>
    <!--Burada txt_sifre alanına yazılan şifrenin icon a basılınca göster gizle yapması için yazdık
    -->
    function

    togglePassword(id)

    {

    var

    x

    =

    document.getElementById(id);

    console.log(x);

    if

    (x.type

    ==

    "password")

    {

    x.type

    =

    "number";

    }

    else

    {

    x.type

    =

    "password";

    }

    }


</script>
<script>
function silEmin() {
  confirm("Silinecek, Emin misiniz ?");
}
</script>



</section>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
