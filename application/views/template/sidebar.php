<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <?php
        $levels = $this->db->get('levels')->result_array();
        foreach ($levels as $r) :
            $level = $r['level'];
            $id_level = $r['id'];
        ?>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
                <span><?= $level; ?></span>
            </h6>
            <ul class="nav flex-column">
                <?php
                $menus = $this->db->get_where('menus', ['level' => $id_level])->result_array();
                foreach ($menus as $s) :
                    $menu = $s['menu'];
                    $url = $s['url'];
                ?>
                    <li class="nav-item m-0 p-0">
                        <a class="nav-link <?= $this->uri->segment(1) == $url ? 'active' : ''; ?> pb-1" href="<?= base_url() . $url; ?>">
                            &nbsp; <?= $menu; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
        <a href="<?= base_url('sign-out'); ?>" class="btn btn-sm btn-outline-success mt-3 ml-4">Keluar Aplikasi</a>
    </div>
</nav>