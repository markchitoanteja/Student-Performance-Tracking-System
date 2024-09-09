<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Records</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#new_student_modal">
                            <i class="fas fa-plus mr-1"></i>
                            New Student
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Student Number</th>
                                <th>Student Name</th>
                                <th>Course, Year and Section</th>
                                <th>Email Address</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($students): ?>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td>
                                            <a href="<?= base_url() ?>student_profile?student_number=<?= $student["student_number"] ?>"><?= $student["student_number"] ?></a>
                                        </td>
                                        <td>
                                            <?= $student["first_name"] ?>
                                            <?= isset($student["middle_name"]) && !empty($student["middle_name"]) ? strtoupper($student["middle_name"][0]) . '.' : '' ?>
                                            <?= $student["last_name"] ?>
                                        </td>
                                        <td><?= $student["course"] . " " . $student["year"][0] . "-" . $student["section"] ?></td>
                                        <td><?= $student["email"] ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-pencil-alt text-primary mr-1 edit_student" role="button" title="Edit Student Information" student_id="<?= $student["id"] ?>"></i>
                                            <i class="fas fa-trash-alt text-danger delete_student" role="button" title="Delete Student" student_id="<?= $student["id"] ?>"></i>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>