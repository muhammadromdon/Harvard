<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="row">
        <div class="col-lg">

            <?php echo form_error('menu', '<div class="alert alert-danger">', '</div>') ?>

            <?php if ($this->session->flashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <small class="text-strong"> <?php echo $this->session->flashdata('message') ?></small>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>

            <a href="#" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#modalsubmenu"><i class="fas fa-plus"></i><span class="ml-3">New Menu</span></a>

            <div class="row">
                <div class="col-lg">

                    <div class="table-responsive">
                        <table class="table table-sm table-hover tablemenu">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Url</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($submenu as $sm) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $i++ ?></th>
                                        <td><?php echo $sm['title'] ?></td>
                                        <td><?php echo $sm['menu'] ?></td>
                                        <td><?php echo $sm['url'] ?></td>
                                        <td><i class="<?php echo $sm['icon'] ?>"></i></td>
                                        <td>
                                            <a href="<?php echo base_url('Menu/Deletesett/' . $sm['id']) ?>" class="badge badge-danger">Delete</a>
                                            <a href="#" class="badge badge-primary">Edit</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Menu Modal-->
<div class="modal fade" id="modalsubmenu" tabindex="-1" role="dialog" aria-labelledby="modalsubmenu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalsubmenu">Add new submenu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo base_url() ?>Menu/Menusettings" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="title" name="title" placeholder="Title..">
                        <?php echo form_error('title', '<small class="text-muted pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?php echo $m['id'] ?>"><?php echo $m['menu'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <?php echo form_error('menu_id', '<small class="text-muted pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="url" name="url" placeholder="Menu url..">
                        <?php echo form_error('url', '<small class="text-muted pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="icon" name="icon" placeholder="Menu icon..">
                        <?php echo form_error('icon', '<small class="text-muted pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active!
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Add menu</button>
                </div>
            </form>
        </div>
    </div>
</div>