<section class="bg-sponsors-section">
                <div class="container">
                    <div class="row">
                        <div class="sponsors-option">
                            <div class="section-header">
                                <h2>top sponsors</h2>
                            </div>
                            <!-- .section-header -->
                            <div class="sponsors-container">
                                <div class="swiper-wrapper">
                                <?php foreach($sponsor as $s) { ?>
                                    <div class="swiper-slide">
                                        <div class="sopnsors-items">
                                            <a href="<?= $s['link_sponsor']; ?>"><img src="<?= base_url() ?>logo/<?= $s['logo_sponsor']; ?>" alt="<?= $s['link_sponsor']; ?>" class="img-responsive" /></a>
                                        </div>
                                        <!-- .sponsors-items -->
                                    </div>
                                <?php } ?>
                                    <!-- .swiper-slide -->

                                </div>
                                <!-- .swiper-wrapper -->
                            </div>
                            <!-- .sponsors-container -->
                        </div>
                        <!-- .sponsors-option -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .container -->
            </section>