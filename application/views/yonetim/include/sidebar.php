<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image" style="margin-bottom:17px;">
                <?php $info=$this->session->userdata('info'); ?>
                <img src="<?php echo base_url('assets\upload\profile/').$info->profilFoto ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    <?php echo $info->adiSoyadi; ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÜ</li>
            <?php
            if($info->yetki=='1'){?>
            <li><a href="<?php echo base_url('Akademisyen/akademisyenPaneli') ?>"><i class="fa fa-book"></i><span>Ana Sayfa</span></a></li>
            <?php } ?>
            <?php
            if($info->yetki=='2'){?>
            <!-- ogrenci icin bir anasayfa tasarlanmadı. -->
            <!-- <li><a href="<?php// echo base_url('Akademisyen/ogr') ?>"><i class="fa fa-book"></i><span>Ana Sayfa</span></a></li> -->
            <?php } ?>
            <?php
            if($info->yetki=='0'){?>
            <li><a href="<?php echo base_url('admin/home') ?>"><i class="fa fa-book"></i><span>Ana Sayfa</span></a></li>
            <?php } ?>
            <!-- Akademisyen Menüleri -->
            <?php if ($info->yetki==='1'):    ?>
            <li><a href="<?php echo base_url('akademisyen/ogrencilerim') ?>"><i class="fas fa-user-graduate" style="margin-right: 6px"></i><span> Öğrencilerim</span></a></li>
            <li><a href="<?php echo base_url('akademisyen/projeListesi') ?>"><i class="fas fa-project-diagram" style="margin-right: 4px"></i><span> Projelerim</span></a></li>
            <li><a href="<?php echo base_url('akademisyen/digerProjeler') ?>"><i class="fas fa-tasks" style="margin-right: 6px"></i> Diğer Projeler</a></li>
            <li><a href="<?php echo base_url('akademisyen') ?>"><i class="fas fa-home"></i> Proje Değerlendirme</a></li>
            <?php endif; ?>
            <!-- Öğrenci Menüleri -->
            <?php if ($info->yetki==='2'):    ?>            
            <li>
                <a href="<?php echo base_url('Ogrenci/Home/projeAyrinti') ?>"><i class="fas fa-project-diagram" style="margin-right: 4px"></i><span> Proje</span></a>
            </li>
            <li>
                <a href="<?php echo base_url('Ogrenci/projeGrubu') ?>"><i class="fas fa-layer-group" style="margin-right: 4px"></i><span> Proje Grubu</span></a>
            </li>
            <?php endif; ?>
            <!-- Yonetici Menüleri -->
            <?php if ($info->yetki=='0'):    ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Üyeler</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="<?php echo base_url('yonetimPaneli/akademisyen') ?>"><i class="fa fa-circle-o"></i> Akademisyen
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="<?php echo base_url('YonetimPaneli/akademisyen') ?>"><i class="fa fa-circle-o"></i> Akademisyen Listesi </a></li>
                            <li><a href="<?php echo base_url('YonetimPaneli/akademisyenEkle') ?>"><i class="fa fa-circle-o"></i> Akademisyen Ekle</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="<?php echo base_url('YonetimPaneli/ogrenciListesi') ?>"><i class="fa fa-circle-o"></i> Öğrenci
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu" style="display: none;">
                            <li><a href="<?php echo base_url('YonetimPaneli/ogrenciListesi') ?>"><i class="fa fa-circle-o"></i> Öğrenci Listesi </a></li>
                            <li><a href="<?php echo base_url('YonetimPaneli/ogrenciEkle') ?>"><i class="fa fa-circle-o"></i> Öğrenci Ekle</a></li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fw fa-bullhorn"></i>
                    <span>Duyuru</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('YonetimPaneli/duyurular') ?>"><i class="fa fa-circle-o"></i>Duyurular</a></li>
                    <li><a href="<?php echo base_url('YonetimPaneli/duyuruEkle') ?>"><i class="fa fa-circle-o"></i>Duyuru Ekle</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Mesajlar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('YonetimPaneli/iletisimListesi') ?>"><i class="fa fa-circle-o"></i><span> Mesajlar</span></a></li>
                    <li><a href="<?php echo base_url('YonetimPaneli/mesajGonder/1') ?>"><i class="fa fa-circle-o"></i>Mesaj Gönder</a></li>
                </ul>
            </li>
            <li><a href="<?php echo base_url('YonetimPaneli/ayarlar') ?>"><i class="fa fa-cogs"></i><span> Ayarlar</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fas fa-project-diagram"></i>
                    <span>Projeler</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('YonetimPaneli/projeler') ?>"><i class="fa fa-circle-o"></i><span>Akademisyen Projeleri</span></a></li>
                    <li><a href="<?php echo base_url('YonetimPaneli/tumProjeler') ?>"><i class="fa fa-circle-o"></i>Tüm Proje Listesi</a></li>
                </ul>
            </li>  
            <?php endif; ?>
            <!-- Akademisyen ve Öğrenci Ortak Menüleri -->
            <?php if($info->yetki=='1' || $info->yetki=='2'){ ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>Mesajlar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('mesaj/gelenKutusu') ?>"><i class="fa fa-circle-o"></i> Gelen Kutusu</a></li>
                    <li><a href="<?php echo base_url('mesaj/mesajGonder') ?>"><i class="fa fa-circle-o"></i> Mesaj Gönder</a></li>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
