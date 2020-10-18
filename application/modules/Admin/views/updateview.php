<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $student['id'] ?>">
                <div class="form-group">
                    <label for="nim">ID</label>
                    <input type="text" class="form-control" name="nim" id="nim" value="<?= $student['nim'] ?>">
                    <small class="form-text text-muted"><?php echo form_error('nim') ?></small>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?= $student['name'] ?>">
                    <small class="form-text text-muted"><?php echo form_error('name') ?></small>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" value="<?= $student['email'] ?>" readonly>
                    <small class="form-text text-muted"><?php echo form_error('email') ?></small>
                </div>
                <div class="form-group">
                    <label for="jurusan">Academic Fields</label>
                    <select class="form-control" id="jurusan" name="jurusan" id="jurusan">
                        <?php foreach ($jurusan as $j) : ?>
                            <?php if ($j == $student['jurusan']) : ?>
                                <option value="<?php echo $j ?>" selected><?php echo $j ?></option>
                            <?php else : ?>
                                <option value="<?php echo $j ?>"><?php echo $j ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3 float-right">
                    Update
                </button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->