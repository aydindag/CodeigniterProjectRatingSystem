<?php $this->load->view('yonetim/include/headerMobil'); ?>
<!-- Default box -->
<?php echo $this->session->flashdata('ekleBasari'); ?>
<?php echo $this->session->flashdata('emailGonderildi'); ?>
<!-- Proje Ayrıntıları start -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Project Adı: <?php echo $info->projeAdi ?></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body  p-2">
        <?php $kontrol = $this->session->userdata('info'); ?>
        <table>
            <tbody>
                <tr>
                    <th>Proje Kodu</th>
                    <td width="400"><?php echo $info->projeKodu ?></td>
                    <td rowspan="10">
                        <h2> Proje Videosu</h2>
                        <!-- Video Start -->
                        <?php if($info->videoURL != ""){ ?>

                        <div class="box-body">
                            <?php echo $info->videoURL ?>
                        </div>

                        <?php } ?>
                        <!-- Video End -->
                    </td>
                </tr>
                <?php if($info->hocaID==$kontrol->hocaID){ ?>
                <tr>
                    <th>Proje Notu</th>
                    <td>
                        <?php echo $info->puan; ?>
                    </td>

                </tr>
                <?php } ?>
                <tr>
                    <th>Verilen Not</th>
                    <td>
                        <div class="form-group">
                            <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/not/'); echo ''.$info->projeKodu.'/1/'.$info->hocaID.'' ?>" enctype="multipart/form-data">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-addon mr-1">
                                        <i class="fa fa-eye-slash" style="margin-top:30%" aria-hidden="true" onclick="togglePassword('<?php echo $info->projeKodu ?>')"></i>
                                    </div>
                                    <input id="<?php echo $info->projeKodu ?>" style="width: 75px;height: 29px;" type="password" name="projeID" value="<?php if(isset($inf3->notu)){ echo $inf3->notu;}?>" type="text" class="form-control">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                    <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-sign-in-alt"></i></button>
                                </div>
                            </form>
                        </div>

                    </td>
                </tr>
                <tr>
                    <th>Akademisyen</th>
                    <td><?php echo $info->adiSoyadi ?></td>
                </tr>
                <tr>
                    <th>Proje Adı</th>
                    <td><?php echo $info->projeAdi ?></td>
                </tr>
                <tr>
                    <th>Proje Adı(ing)</th>
                    <td><?php echo $info->projeName ?></td>
                </tr>
                <tr>
                    <th>Afiş</th>
                    <?php if($info->afis!=""){ ?>
                    <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeAfisindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-image fa-2x"></i><span> İndir</span></a></td>
                    <?php }else{ ?>
                    <td><i class="far fa-times-circle fa-2x"></i> </td>
                    <?php } ?>
                    
                </tr>
                <tr>
                    <th>Dosya</th>
                    <?php if($info->dosya!=""){ ?>
                    <td><a style="color:black" href="<?php echo base_url('Akademisyen/AkademisyenPaneli/projeDosyaindir/'); echo ''.$info->projeKodu.'' ?>"><i class="far fa-file-pdf fa-2x"></i><span> İndir</span></a></td>
                    <?php }else{ ?>
                    <td><i class="far fa-times-circle fa-2x"></i> </td>
                    <?php } ?>
                </tr>
                <tr>
                    <th>Project Açıklaması</th>
                    <td><?php echo $info->projeAciklama ?></td>
                </tr>
                <tr>
                    <th>Proje Açıklaması(ing)</th>
                    <td><?php echo $info->projeDetail ?></td>
                </tr>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- Proje Ayrıntıları end -->

<!-- Proje Öğrencileri start -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Öğrenciler</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body  p-2">
        <table class="table table-hover">
            <tbody>

                <tr>
                    <th>isim</th>
                    <?php
                if($info->projeYayinla){
                    ?>
                    <th>Not</th>
                    <?php } ?>
                    <th>Numara</th>
                    <th>Şifre</th>
                    <th>Sil</th>
                </tr>
                <?php if($inf){ ?>
                <?php foreach ($inf as $inf) { ?>
                <tr>
                    <td><a href="<?php echo base_url('akademisyen/ogrenci/profil/').''.$inf->ogrNo.'' ?>" style="color:black"><?php echo $inf->adiSoyadi ?></a></td>
                    <?php
                    $kontrol = $this->session->userdata('info');
                    $hocaID = $kontrol->hocaID;
                    if($info->projeYayinla){
                        ?>
                    <td><?php echo $inf->puan ?></td>
                    <?php } ?>
                    <td><?php echo $inf->ogrNo ?></td>
                    <td>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye-slash mr-1" style="margin-top:30%" aria-hidden="true" onclick="togglePassworda('<?php echo $inf->sifre ?>')"></i>
                                </div>
                                <input id="<?php echo $inf->sifre ?>" style="width:25px;" name="projeID" type="password" value="<?php echo $inf->sifre ?>" class="form-control">
                            </div>
                        </div>
                    </td>
                    <td>
                        <form method="post" role="form" action="<?php echo base_url('Akademisyen/Home/ogrSil'); ?>">
                            <input name="id" type="hidden" value="<?php echo $inf->ID ?>">   
                            <input name="projeKodu" type="hidden" value="<?php echo $info->projeKodu ?>">  
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" onclick="return confirm('Silinecek!! Emin misiniz?')" class="btn bg-red btn-sm">Sil</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                <?php }else{ ?>
                <tr>
                    <td>Projeye Dahil Olan Bir Öğrenci Yok.</td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- Proje Öğrencileri end -->
<!-- Proje Öğrencileri Ekle start -->
<?php
$kontrol = $this->session->userdata('info');
$hocaID = $kontrol->hocaID;
$projeKontrol = $this->db->query("select * from proje where hocaID='" . $kontrol->hocaID . "' and projeKodu='" . $info->projeKodu . "'");       
?>
<?php if($projeKontrol->num_rows()!=0){ ?>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Yeni Öğrenci Ekle
      
    </div>
    
    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/ogrenciEkleButton/'); echo ''.$info->projeKodu.'' ?>" enctype="multipart/form-data">
        <div class="box-body">
            <div class="row">
                
                <div class="col">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="ogrNo" placeholder="Ogr NO" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input name="adsoyad" placeholder="Adı Soyadı" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                   <div class="col">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <button type="submit" class="btn btn-primary btn-flat">Ekle</button>
            <div id="myDIV" style="visibility:hidden;height:0px;">Öğrenci eklendiğinde; ogrNo@ogrenci.karabuk.edu.tr mail adresine, kullanıcı adı ve şifre bilgileri mail atılır. Mail gitmemesi durumunda öğrencinin kullanıcı adı ve şifre bilgilerini öğrenci profilinden öğrenebilirsiniz. </div>
        </div>
            </div>
        </div>
        <!-- /.box-body -->
     
    </form>

    <!-- /.box-footer-->
</div>
<!-- Proje Öğrencileri Ekle end -->
<?php } ?>
<?php
    $kontrol = $this->session->userdata('info');
    $hocaID = $kontrol->hocaID;
    if($info->hocaID==$hocaID){
?>
<!-- Akademisyen Notları start -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Akademisyenler</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive p-2">
        <table class="table table-hover">
            <tbody>

                <tr>
                    <th>Isim</th>
                    <th>Not</th>
                    <th>Sicil</th>

                </tr>
                <?php if($inf2) { ?>
                <?php foreach ($inf2 as $inf2) { ?>
                <tr>
                    <td><?php echo $inf2->adiSoyadi ?></td>
                    <td><?php echo $inf2->notu ?></td>
                    <td><?php echo $inf2->hocaID ?></td>
                </tr>
                <?php } ?>
                <?php }else{ ?>
                <tr>
                    <td>Henüz Not Girilmemiş.</td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- Akademisyen Notları End -->
<!-- Proje Öğrencileri Mesajları start -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Mesajlar</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive p-2">
        <div class="table-responsive mailbox-messages">
            <table class="table table-hover table-striped">
                <tbody>
                    <?php if($bilgi) { ?>
                    <tr>

                        <th>Okundu</th>
                        <th>Kimden</th>
                        <th>Konu</th>
                        <th>Tarih</th>
                    </tr>
                    <?php $i=0;?>
                    <?php foreach($bilgi as $bilgi){ ?>
                    <?php if($projeKodu[$i]==$info->projeKodu ){ ?>
                    <tr>
                        <?php if($bilgi->okundu){ ?>
                        <td style="width:5%;text-align:center" class="mailbox-star"><a href="#"><i title="Okundu" class="far fa-check-circle text-success"></i></a></td>
                        <?php }else{ ?>
                        <td style="width:5%;text-align:center" class="mailbox-star"><a href="#"><i title="Okunmadı" class="fas fa-exclamation-circle text-danger"></i></a></td>
                        <?php } ?>
                        <td style="width:30%;" class="mailbox-name">
                            <a href="<?php echo base_url('Mesaj/mesajPaneli/mesajOku/'); echo ''.$bilgi->ID.'/' ?>">
                                <?php echo $isimler[$i]?>
                            </a>
                        </td>
                        <td style="width:50%;" class="mailbox-subject"><b><?php echo $bilgi->baslik ?></b>
                        </td>
                        <td style="width:15%;" class="mailbox-date">
                            <?php 
                                    $date = $bilgi->tarih;
                                    $newDate = date("d-m-Y", strtotime($date));
                                    echo $newDate;                                        
                                ?>
                        </td>
                    </tr>
                    <?php }  ?>
                    <?php $i++; ?>
                    <?php }  ?>
                    <?php }  ?>
                    <?php if(!$bilgi) { ?>
                    <tr>
                        <td>Herhangi bir mesajınız yok.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- /.table -->
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- Proje Öğrencileri Mesajlar End -->
<?php } ?>
</section>
<script>
    function togglePassword(id) {
        var x = document.getElementById(id);
        if (x.type == "password") {
            x.type = "number";
        } else {
            x.type = "password";
        }
    }

</script>
<script>
    var z = document.getElementById('iframeID');

    function myFunction(x) {
        if (x.matches) { // If media query matches
            z.style.height = "200px";
            z.style.width = "250px";
        } else {
            z.style.height = "400px";
            z.style.width = "600px";
        }
    }
    var x = window.matchMedia("(max-width: 700px)")
    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes

</script>
<script>
    <!--Burada txt_sifre alanına yazılan şifrenin icon a basılınca göster gizle yapması için yazdık
    -->
    function togglePassworda(id){
        
            var x = document.getElementById(id);
            console.log(x);
            if(x.type=="password"){
                x.type="text";
            }
            else
            {
                x.type="password";
            }
        
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById('myDIV');
        if (x.style.visibility === 'hidden') {
            x.style.visibility = 'visible';
            x.style.height = "auto";
            x.style.border = "4px dotted black";
            x.style.margin = "5px 0px 0px 0px";
        } else {
            x.style.visibility = 'hidden';
            x.style.height = "0px";
            x.style.border = "";
            x.style.margin = "";
        }
    }

</script>
<script>
function silEmin() {
  confirm("Silinecek, Emin misiniz ?");
}
</script>

<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery 3 -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="<?php echo base_url('assets/AdminPanel/'); ?>dist/js/demo.js"></script>
<script src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
