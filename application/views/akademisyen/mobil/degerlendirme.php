<?php $this->load->view('yonetim/include/headerMobil'); ?>

<!-- Default box -->
<?php echo $this->session->flashdata('ekleBasari'); ?>
<?php $kontrol = $this->session->userdata('info');
$url=$this->uri->segment(3);
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
        <h3 class="box-title">Projeler</h3>

    </div>
    <div class="box-body table-responsive p-2">
        <?php $kontrol = $this->session->userdata('info'); ?>
        <table class="table table-striped">
            <tbody><tr>
                <th style="width: 10px">Kod</th>
                <th >Proje Adı</th>
                <th >Dosya</th>
                <th>Not</th>
                <th >Akademisyen</th>
                <th>Ayrıntı</th>
            </tr>
            <?php if($info){
              $sn=1; ?>
                <?php foreach ($info as $info){ ?>
                   <?php if($kontrol->hocaID != $info->hocaID){ ?>
                <!-- proje hocası başkasıysa -->
                    <?php
                    
                   
                    $durumOgrena = $this->db->query("SELECT ID FROM notlar WHERE projeKodu='" . $info->projeKodu . "' and hocaID='".$kontrol->hocaID."'" );
                    $degerlendirmeSonuc = $durumOgrena->row()->ID;

                    ?>
                    <?php if($degerlendirmeSonuc == ''){ ?>
                        <tr>
                            <td><?= $sn ?> - <?php echo $info->projeKodu ?></td>
                            <td><?php echo $info->projeAdi ?></td>
                             <?php if($info->dosya!=""){ ?>
                    <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeDosyaindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                    <?php }else{ ?>
                    <td><i class="far fa-times-circle fa-2x"></i> </td>
                    <?php } ?>
                    
                            <td style="min-width:180px" id="projenot">
                                <div class="form-group">
                                    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/not/'); echo ''.$info->projeKodu.'/3/'.$info->hocaID.'' ?>" enctype="multipart/form-data">
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
                            <td><?php echo $info->adiSoyadi ?></td>
                            <td><a type="button" style="margin-bottom: 15px" class="btn btn-warning btn-sm" href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>">Detay</a></td>
                        <td><?php echo $info->videoUrl ?></td>
                        </tr>
                    <?php 
                     $sn=$sn+1;
                    }?>
                <?php } ?>
                <?php } ?>
            <?php }else {
                echo "<p>Gösterilecek Kayıt Bulunamadı</p>";
            }
            ?>
            </tbody></table>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->


<script>
    function silEmin() {
        confirm("Silinecek, Emin misiniz ?");
    }
</script>



</section>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
