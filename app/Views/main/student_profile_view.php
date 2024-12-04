<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Profile</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary edit_student" student_id="<?= $student_data['id'] ?>">
                            <i class="fas fa-pencil-alt mr-1"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle clickable_image" src="<?= base_url() ?>public/dist/img/uploads/students/<?= $student_data["image"] ?>" style="aspect-ratio: 1 / 1;" alt="User profile picture" role="button">
                            </div>

                            <h3 class="profile-username text-center"><?= session()->get("title") ?></h3>

                            <p class="text-muted text-center"><?= $student_data["course"] . " " . $student_data["year"][0] . "-" . $student_data["section"] ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Student Number</b> <a class="float-right"><?= $student_data["student_number"] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mobile Number</b> <a class="float-right"><?= $student_data["mobile_number"] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $student_data["email"] ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">More About Me</h3>
                        </div>
                        <div class="card-body">
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                            <p class="text-muted"><?= $student_data["address"] ?></p>
                            <hr>
                            <strong><i class="fas fa-calendar-alt mr-1"></i> Birthday</strong>
                            <p class="text-muted"><?= date("F d, Y", strtotime($student_data["birthday"])) ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-chart-line mr-1"></i> Grades</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if ($grades): ?>
                                        <?php
                                        $groupedGrades = [];

                                        foreach ($grades as $grade) {
                                            $year = $grade['year'];
                                            $semester = $grade['semester'];

                                            $groupedGrades[$year][$semester][] = $grade;
                                        }

                                        $counter = 0;
                                        ?>

                                        <?php foreach ($groupedGrades as $year => $semesters): ?>
                                            <?php
                                            $counter++;
                                            $collapseId = "collapseYear{$counter}";
                                            ?>

                                            <div class="mb-4">
                                                <h4 class="text-primary font-weight-bold">
                                                    <?= $year ?> Year
                                                    <a data-toggle="collapse" href="#<?= $collapseId ?>" role="button" aria-expanded="true" aria-controls="<?= $collapseId ?>" class="collapse-toggle">
                                                        <i class="fas fa-chevron-down float-right" id="icon-<?= $collapseId ?>"></i>
                                                    </a>
                                                </h4>

                                                <div class="collapse show" id="<?= $collapseId ?>">
                                                    <?php foreach ($semesters as $semester => $subjects): ?>
                                                        <h5 class="text-secondary"><?= $semester ?> Semester</h5>

                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($subjects as $subject): ?>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                    <span><?= $subject['title'] ?></span>
                                                                    <span class="badge badge-info badge-pill"><?= $subject['grade'] ?></span>
                                                                </li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    <?php else: ?>
                                        <h1 class="p-5 text-center text-muted">No Grades Yet</h1>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"><i class="fas fa-medal mr-1"></i> Achievements</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php if ($achievements): ?>
                                        <ul class="list-group">
                                            <?php foreach ($achievements as $achievement): ?>
                                                <li class="list-group-item">
                                                    <h5 class="font-weight-bold"><?= esc($achievement['title']) ?></h5>
                                                    <p class="mb-1"><?= esc($achievement['description']) ?></p>
                                                    <small class="text-muted">Awarded on: <?= esc(date('F d, Y', strtotime($achievement['date_awarded']))) ?></small>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <h1 class="p-5 text-center text-muted">No Achievements Yet</h1>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>