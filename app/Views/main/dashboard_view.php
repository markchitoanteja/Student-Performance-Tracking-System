<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $student_count ?></h3>
                            <p>Total Students</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <a href="<?= base_url() ?>manage_student_records" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $course_count ?></h3>
                            <p>Courses Available</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <a href="<?= base_url() ?>course_management" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $subject_count ?></h3>
                            <p>Subjects Offered</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <a href="<?= base_url() ?>subject_management" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-history mr-1"></i> Recent Activity</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped datatable-no-fiter">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Activity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($logs): ?>
                                        <?php foreach ($logs as $log): ?>
                                            <tr>
                                                <td><?= date('F j, Y h:i A', strtotime($log["created_at"])) ?></td>
                                                <td><?= $log["name"] ?></td>
                                                <td><?= $log["activity"] ?></td>
                                            </tr>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>