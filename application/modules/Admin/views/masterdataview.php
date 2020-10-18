<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title ?></h1>

    <div class="flashdata" data-flashdata="<?php echo $this->session->flashdata('message') ?>"></div>

    <div class="row mt-4">
        <div class="col-lg">

            <h4 class="float-right" style="margin-bottom: 30px;">Harvard Students List</h4>

            <div class="table-responsive">
                <table class="table table-sm table-hover tabeldata">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Academic Fields</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($siswa as $s) : ?>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $s['nim'] ?></td>
                                <td><?php echo $s['name'] ?></td>
                                <td><?php echo $s['email'] ?></td>
                                <td><?php echo $s['jurusan'] ?></td>
                                <td>
                                    <a href="<?php echo base_url('Admin/Updatestudent/') . $s['id'] ?>" class="btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url('Admin/Deletestudent/') . $s['id'] ?>" class="btn-sm btn-danger tombolhapus"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->