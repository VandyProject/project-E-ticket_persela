

<div class="row">
    <div class="col s12 m12 l12">
        <div class="card-panel">
            <h4 class="header2">Konfigurasi</h4>
            <div class="row">
                <form enctype="multipart/form-data" class="col s12" method="POST" action="<?= isset($data['id_config']) ? site_url() . 'admin/config/update' : site_url() . 'admin/config/save' ?>">
                    
                    <input class="hide" type="text" name="id_config" value="<?= isset($data['id_config']) ? $data['id_config'] : time() ?>">
                    <div class="row">
                        <label>Banner Barat</label>
                    </div>
                    <div class="row">
                        <?= isset($data['banner_barat']) ? '<img class="col s12 m4 l3 img-responsive" src="' . base_url() . 'config/' . $data['banner_barat'] . '" />' : '' ?>   
                        <div class="file-field input-field col s12">
                            <input class="file-path validate" type="text"/>
                            <div class="btn">
                                <span><?= isset($data['banner_barat']) ? 'Edit' : 'Input' ?></span>
                                <input name="banner_barat" type="file" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label>Banner Timur</label>
                    </div>
                    <div class="row">
                        <?= isset($data['banner_timur']) ? '<img class="col s12 m4 l3 img-responsive" src="' . base_url() . 'config/' . $data['banner_timur'] . '" />' : '' ?>   
                        <div class="file-field input-field col s12">
                            <input class="file-path validate" type="text"/>
                            <div class="btn">
                                <span><?= isset($data['banner_timur']) ? 'Edit' : 'Input' ?></span>
                                <input name="banner_timur" type="file" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label>Banner Selatan</label>
                    </div>
                    <div class="row">
                        <?= isset($data['banner_selatan']) ? '<img class="col s12 m4 l3 img-responsive" src="' . base_url() . 'config/' . $data['banner_selatan'] . '" />' : '' ?>   
                        <div class="file-field input-field col s12">
                            <input class="file-path validate" type="text"/>
                            <div class="btn">
                                <span><?= isset($data['banner_selatan']) ? 'Edit' : 'Input' ?></span>
                                <input name="banner_selatan" type="file" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label>Banner Utara</label>
                    </div>
                    <div class="row">
                        <?= isset($data['banner_utara']) ? '<img class="col s12 m4 l3 img-responsive" src="' . base_url() . 'config/' . $data['banner_utara'] . '" />' : '' ?>   
                        <div class="file-field input-field col s12">
                            <input class="file-path validate" type="text"/>
                            <div class="btn">
                                <span><?= isset($data['banner_utara']) ? 'Edit' : 'Input' ?></span>
                                <input name="banner_utara" type="file" />
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="input-field col s12">
                            <button class="btn red darken-1 waves-effect waves-light right" type="submit"><?= isset($data['id_klub']) ? 'Update' : 'Submit' ?>
                                <i class="mdi-content-send right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>