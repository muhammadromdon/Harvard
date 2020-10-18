<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Home') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-home"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Harvard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php

    $roleid = $this->session->userdata('role_id');

    $querymenu = "SELECT   `user_menu`.`id`,`menu`
                  FROM     `user_menu` JOIN `user_access_menu`
                  ON       `user_menu`.`id` = `user_access_menu`.`menu_id`
                  WHERE    `user_access_menu`.`role_id` = $roleid
                  ORDER BY `user_access_menu`.`menu_id` ASC";

    $menu = $this->db->query($querymenu)->result_array();

    ?>

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?php echo $m['menu'] ?>
        </div>

        <?php

        $menuid = $m['id'];

        $querysubmenu = "SELECT * FROM `user_sub_menu` WHERE `menu_id` = $menuid AND `is_active` = 1";

        $submenu = $this->db->query($querysubmenu)->result_array();

        ?>

        <?php foreach ($submenu as $sm) : ?>

            <?php if ($title == $sm['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif ?>
                <a href="<?php echo base_url($sm['url']) ?>" class="nav-link pb-0">
                    <i class="<?php echo $sm['icon'] ?>"></i>
                    <span><?php echo $sm['title'] ?></span>
                </a>
                </li>

            <?php endforeach ?>

            <hr class="sidebar-divider mt-2">

        <?php endforeach ?>

        <!-- Nav Item - Logout -->
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Auth/Logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->