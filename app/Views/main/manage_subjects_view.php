<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Subjects</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#new_subject_modal">
                            <i class="fas fa-plus mr-1"></i>
                            New Subject
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
                                <th>Subject Code</th>
                                <th>Descriptive Title</th>
                                <th>Total Units</th>
                                <th>Lec Units</th>
                                <th>Lab Units</th>
                                <th>Hours/Week</th>
                                <th>Pre-Requisite/s</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($subjects): ?>
                                <?php foreach ($subjects as $subject): ?>
                                    <tr>
                                        <td><?= $subject["code"] ?></td>
                                        <td><?= $subject["title"] ?></td>
                                        <td><?= intval($subject["lecture_units"]) + intval($subject["laboratory_units"]) ?> units</td>
                                        <td><?= $subject["lecture_units"] ?> unit<?= intval($subject["lecture_units"]) > 1 ? "s" : null ?></td>
                                        <td><?= $subject["laboratory_units"] ?> unit<?= intval($subject["laboratory_units"]) > 1 ? "s" : null ?></td>
                                        <td><?= $subject["hours_per_week"] ?> hour<?= intval($subject["hours_per_week"]) > 1 ? "s" : null ?></td>
                                        <td><?= $subject["pre_requisites"] ? str_replace(",", ", ", $subject["pre_requisites"]) : "None" ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-pencil-alt text-primary mr-1 edit_subject" role="button" title="Edit Subject Information" subject_id="<?= $subject["id"] ?>"></i>
                                            <i class="fas fa-trash-alt text-danger delete_subject" role="button" title="Delete Subject" subject_id="<?= $subject["id"] ?>"></i>
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