<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Courses</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#new_course_modal">
                            <i class="fas fa-plus mr-1"></i>
                            New Course
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
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Years</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($courses): ?>
                                <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td><?= $course["code"] ?></td>
                                        <td><?= $course["title"] ?></td>
                                        <td><?= $course["years"] ?> <?= intval($course["years"]) > 1 ? "years" : "year" ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-pencil-alt text-primary mr-1 edit_course" role="button" title="Edit Course Information" course_id="<?= $course["id"] ?>"></i>
                                            <i class="fas fa-trash-alt text-danger delete_course" role="button" title="Delete Course" course_id="<?= $course["id"] ?>"></i>
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