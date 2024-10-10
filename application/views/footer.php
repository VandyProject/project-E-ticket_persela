<footer>
    <div class="bg-footer-top">
        <div class="container">
            <div class="row">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="footer-widgets">
                                <div class="widgets-title">
                                    <h3>Developer</h3>
                                </div>
                                <!-- .widgets-title -->
                                <div class="widgets-content">
                                    <p>Terima kasih kepada semua pihak yang telah membantu terwujudnya sistem ini. semoga sistem ini bisa membantu kegiatan di persela lamongan dan bisa di kembangkan lagi untuk hasil yang lebih baik.</p>
                                </div>
                                <!-- .widgets-content -->
                                <div class="address-box">
                                    <ul class="address">
                                        <br>
                                        <li>
                                            <i class="fa fa-address-card" aria-hidden="true"></i>
                                            <span>Novandy Fahrizal Fanani</span>
                                        </li>
                                        <br>
                                        <li>
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                            <span>085806050060</span>
                                        </li>
                                        <br>
                                        <li>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <span>Lamongan, Jawa Timur.</span>
                                        </li>
                                        <br>
                                        <li>
                                            <!-- <i class="fa fa-envelope-o" aria-hidden="true"></i> -->
                                            <!-- <span>novandyfahrizalfanani@gmail.com</span> -->
                                        </li>
                                    </ul>
                                </div>
                                <!-- .address -->
                            </div>
                            <!-- .footer-widgets -->
                        </div>
                        <!-- .col-md-3 -->
                        <div class="col-md-9 col-sm-6">
                            <div class="footer-widgets">
                                <div class="widgets-title">
                                    <h3>Message</h3>
                                </div>
                                <!-- .widgets-title -->
                                <ul class="latest-news">
                                    <form enctype="multipart/form-data" class="contact-form" method="POST" action="<?= site_url() ?>home/kirimpesan">
                                        <?php $this->session->set_userdata('url_psn', $_SERVER['REQUEST_URI']); ?>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" class="form-control" placeholder="Nama" required=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Email" required=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Pesan</label>
                                            <input type="text" name="pesan" class="form-control" placeholder="Pesan" required=""/>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger" >Kirim</button>
                                        </div>
                                    </form>
                                </ul>
                            </div>
                            <!-- .footer-widgets -->
                        </div>

                    </div>
                    <!-- .row -->
                </div>
                <!-- .footer-top -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-footer-top -->

    <div class="bg-footer-bottom">
        <div class="container">
            <div class="row">
                <div class="footer-bottom">
                    <div class="copyright-txt">
                        <p>&copy; <?= date('Y') ?>. Designer By <a href="" title="">Novanady Fahrizal Fanani</a></p>
                    </div>
                    <!-- .copyright-txt -->
                    <div class="social-box">
                        <ul class="social-icon-rounded">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>

                </div>
                <!-- .footer-bottom -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .bg-footer-bottom -->

</footer>