<?php $this->load->view('yonetim/include/headerMobil'); ?>

<!-- Default box -->


<?php echo $this->session->flashdata('ekleBasari'); ?>
<?php echo $this->session->flashdata('emailGonderildi'); ?>

<div class="box">
    <!-- Default box 
    <div class="box-header with-border">
        <h3 class="box-title">Öğrencilerim - <a type="button" class="btn btn-info" href="<?php echo base_url('Akademisyen/home/notDokumu'); ?>">Excel Not Dökümü</a></h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    -->
    <div class="box-body table-responsive p-2">

        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Proje Kodu</th>
                    <th>Proje Adı</th>
                    <th>Numara</th>
                    <th>İsim</th>
                    <th>Not</th>
                    <th>Şifre</th>
                </tr>
                <?php if($info){ ?>
                <?php foreach ($info as $info){ ?>
                <tr>
                    <td><?php echo $info->projeKodu ?></td>
                    <td>

                        <a href="<?php echo base_url('akademisyen/proje/'); echo ''.$info->projeKodu.'' ?>"><?php echo $info->projeAdi; ?></a>
                        <?php if($info->projeAdi==""){ ?>
                        <?php echo "Öğrencinin Projesi Yok"; } ?>

                    </td>
                    <td><?php echo $info->ogrNo; ?></td>
                    <td><a href="<?php echo base_url('akademisyen/ogrenci/profil/').''.$info->ogrNo.'' ?>" style="color:black"><?php echo $info->adiSoyadi ?></a></td>
                    <td><?php echo $info->puan;?></td>
                    <td>
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <div class="input-group-addon">
                                    <i class="fa fa-eye-slash mr-1" style="margin-top:30%" aria-hidden="true" onclick="togglePassword('<?php echo $info->sifre ?>')"></i>
                                </div>
                                <input id="<?php echo $info->sifre ?>" style="width:90px;" name="projeID" type="password" value="<?php echo $info->sifre ?>" class="form-control">
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
                <?php }else{
                    echo "<tr><td>Gösterilecek Kayıt Bulunamadı.<td></tr>";
                }?>
            </tbody>
        </table>

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <form method="post" role="form" action="<?php echo base_url('Akademisyen/Home/projeleriYayinla'); ?>">
            <div class="box-body">
                <div class="form-group">
                    <?php if(!$info2->projeYayinla){ ?>
                    <label style="margin-right: 7px;" for="exampleInputEmail1">Proje Notlarını Yayınla</label>
                    <input name="yayin" type="hidden" value="1">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn bg-olive margin">Yayınla</button>
                    <?php } else{ ?>
                    <label style="margin-right: 0px;" for="exampleInputEmail1">Notlarını Yayından Kaldır</label>
                    <input name="yayin" type="hidden" value="0">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <button type="submit" class="btn bg-red margin">Kaldır</button>

                    <?php } ?>
                </div>
            </div>
        </form>

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<script>
    <!--Burada txt_sifre alanına yazılan şifrenin icon a basılınca göster gizle yapması için yazdık
    -->
    function togglePassword(id){
        
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
<?php $this->load->view('yonetim/include/footerMobil'); ?>
