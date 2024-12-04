<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Student Achievements</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#new_achievement_modal">
                            <i class="fas fa-plus mr-1"></i>
                            New Achievement
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Date Awarded</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($achievements): ?>
                                <?php foreach ($achievements as $achievement): ?>
                                    <tr>
                                        <td><?= $achievement["student_number"] ?></td>
                                        <td><?= $achievement["title"] ?></td>
                                        <td><?= $achievement["description"] ?></td>
                                        <td><?= date('F j, Y', strtotime($achievement["date_awarded"])) ?></td>
                                        <td class="text-center">
                                            <i class="fas fa-pencil-alt text-primary mr-1 update_achievement" role="button" title="Edit Achievement" update_achievement_id="<?= $achievement["id"] ?>"></i>
                                            <i class="fas fa-trash-alt text-danger delete_achievement" role="button" title="Delete Achievement" update_achievement_id="<?= $achievement["id"] ?>"></i>
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