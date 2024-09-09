<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Grades</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#new_grade_modal">
                            <i class="fas fa-plus mr-1"></i>
                            New Grade
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
                                <th>Course</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Final Grade</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($grades): ?>
                                <?php foreach ($grades as $grade): ?>
                                    <tr>
                                        <td><?= $grade["student_number"] ?></td>
                                        <td><?= $grade["first_name"] . ' ' . (!empty($grade["middle_name"]) ? strtoupper(substr($grade["middle_name"], 0, 1)) . '. ' : '') . $grade["last_name"]; ?></td>
                                        <td><?= $grade["course"] ?></td>
                                        <td><?= $grade["year"] ?></td>
                                        <td><?= $grade["semester"] ?></td>
                                        <td><?= $grade["grade"] ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-pencil-alt text-primary mr-1 edit_grade" role="button" title="Edit Grade Information" grade_id="<?= $grade["id"] ?>"></i>
                                            <i class="fas fa-trash-alt text-danger delete_grade" role="button" title="Delete Grade" grade_id="<?= $grade["id"] ?>"></i>
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