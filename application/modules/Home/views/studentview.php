<!-- Main Content -->

<div class="row">
    <div class="col">
        <div class="container">
            <p class="para" style="margin-top: 100px">Here are our students data, if u want to update yours, you should login and update your profile!</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="container">
            <div class="table-responsive">
                <table class="table table-hover tablestudent">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    foreach ($students as $s) : ?>
                        <tbody>
                            <tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $s['nim'] ?></td>
                                <td><?php echo $s['name'] ?></td>
                                <td><?php echo $s['email'] ?></td>
                            </tr>
                        </tbody>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- End Main Content -->