        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="<?= base_url() ?>">Student Performance Tracking System</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
        </div>

        <!-- View Full Screen Image Modal -->
        <div class="modal fade" id="view_image_modal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <img id="image_container" alt="Full Screen Image">
                </div>
            </div>
        </div>

        <!-- Account Settings Modal -->
        <div class="modal fade" id="account_settings_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="overlay loading">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Account Settings</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="javascript:void(0)" id="account_settings_form">
                        <div class="modal-body">
                            <div class="text-center mb-3">
                                <img id="account_settings_image_display" class="rounded-circle" alt="User Image" style="width: 100px; height: 100px;">
                            </div>
                            <div class="form-group text-center">
                                <label for="account_settings_image">Upload Image</label>
                                <input type="file" class="form-control-file" id="account_settings_image" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="account_settings_name">Name</label>
                                <input type="text" class="form-control" id="account_settings_name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="account_settings_username">Username</label>
                                <input type="text" class="form-control" id="account_settings_username" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                                <label for="account_settings_password">Password</label>
                                <input type="password" class="form-control" id="account_settings_password" placeholder="Password hidden for security purposes">
                                <small class="text-danger d-none" id="error_account_settings_password">Passwords do not match</small>
                            </div>
                            <div class="form-group">
                                <label for="account_settings_confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="account_settings_confirm_password" placeholder="Password hidden for security purposes">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="account_settings_id">
                            <input type="hidden" id="account_settings_old_password">
                            <input type="hidden" id="account_settings_old_image">

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="account_settings_submit">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (session()->get("current_page") == "manage_student_records"): ?>
            <!-- New Student Modal -->
            <div class="modal fade" id="new_student_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="overlay d-none loading">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">New Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="new_student_form">
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <img id="new_student_image_display" class="rounded-circle" src="<?= base_url() ?>public/dist/img/default-user-image.png" alt="User Image" style="width: 100px; height: 100px;">
                                </div>
                                <div class="form-group text-center">
                                    <label for="new_student_image">Upload Image</label>
                                    <input type="file" class="form-control-file" id="new_student_image" accept="image/*" required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_student_number" class="required">Student Number</label>
                                            <input type="text" class="form-control" id="new_student_student_number" required>
                                            <small class="text-danger d-none" id="error_new_student_student_number">Student Number is already in use</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_course" class="required">Course</label>
                                            <select id="new_student_course" class="custom-select" required>
                                                <option value selected disabled></option>
                                                <?php if ($courses): ?>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="new_student_year" class="required">Year</label>
                                            <select id="new_student_year" class="custom-select" disabled required>
                                                <!-- Data from AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="new_student_section" class="required">Section</label>
                                            <input type="text" class="form-control" id="new_student_section" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_first_name" class="required">First Name</label>
                                            <input type="text" class="form-control" id="new_student_first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_middle_name">Middle Name</label>
                                            <input type="text" class="form-control" id="new_student_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_last_name" class="required">Last Name</label>
                                            <input type="text" class="form-control" id="new_student_last_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_birthday" class="required">Birthday</label>
                                            <input type="date" class="form-control" id="new_student_birthday" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_mobile_number" class="required">Mobile Number</label>
                                            <input type="text" class="form-control" id="new_student_mobile_number" data-inputmask='"mask": "9999 999 9999"' data-mask required>
                                            <small class="text-danger d-none" id="error_new_student_mobile_number">Invalid Mobile Number</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_student_email" class="required">Email Address</label>
                                            <input type="email" class="form-control" id="new_student_email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="new_student_address" class="required">Address</label>
                                            <textarea id="new_student_address" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success" id="new_student_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Student Modal -->
            <div class="modal fade" id="update_student_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="overlay d-none loading">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Update Student</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="update_student_form">
                            <div class="modal-body">
                                <div class="text-center mb-3">
                                    <img id="update_student_image_display" class="rounded-circle" src="<?= base_url() ?>public/dist/img/default-user-image.png" alt="User Image" style="width: 100px; height: 100px;">
                                </div>
                                <div class="form-group text-center">
                                    <label for="update_student_image">Upload Image</label>
                                    <input type="file" class="form-control-file" id="update_student_image" accept="image/*">
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_student_number" class="required">Student Number</label>
                                            <input type="text" class="form-control" id="update_student_student_number" required>
                                            <small class="text-danger d-none" id="error_update_student_student_number">Student Number is already in use</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_course" class="required">Course</label>
                                            <select id="update_student_course" class="custom-select" required>
                                                <?php if ($courses): ?>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="update_student_year" class="required">Year</label>
                                            <select id="update_student_year" class="custom-select" required>
                                                <!-- Data from AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="update_student_section" class="required">Section</label>
                                            <input type="text" class="form-control" id="update_student_section" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_first_name" class="required">First Name</label>
                                            <input type="text" class="form-control" id="update_student_first_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_middle_name">Middle Name</label>
                                            <input type="text" class="form-control" id="update_student_middle_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_last_name" class="required">Last Name</label>
                                            <input type="text" class="form-control" id="update_student_last_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_birthday" class="required">Birthday</label>
                                            <input type="date" class="form-control" id="update_student_birthday" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_mobile_number" class="required">Mobile Number</label>
                                            <input type="text" class="form-control" id="update_student_mobile_number" data-inputmask='"mask": "9999 999 9999"' data-mask required>
                                            <small class="text-danger d-none" id="error_update_student_mobile_number">Invalid Mobile Number</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_student_email" class="required">Email Address</label>
                                            <input type="email" class="form-control" id="update_student_email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="update_student_address" class="required">Address</label>
                                            <textarea id="update_student_address" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="update_student_id">
                                <input type="hidden" id="update_student_old_student_number">
                                <input type="hidden" id="update_student_old_image">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success" id="update_student_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if (session()->get("current_page") == "course_management"): ?>
            <!-- New Course Modal -->
            <div class="modal fade" id="new_course_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">New Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="new_course_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="new_course_code">Course Code</label>
                                    <input type="text" class="form-control" id="new_course_code" required>
                                    <small class="text-danger d-none" id="error_new_course_code">Course Code is already in use</small>
                                </div>
                                <div class="form-group">
                                    <label for="new_course_title">Course Title</label>
                                    <input type="text" class="form-control" id="new_course_title" required>
                                </div>
                                <div class="form-group">
                                    <label for="new_course_years">Years</label>
                                    <input type="number" class="form-control" id="new_course_years" required>
                                    <small class="text-danger d-none" id="error_new_course_years">Years must be greater than zero</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="new_course_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Course Modal -->
            <div class="modal fade" id="update_course_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Update Course</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="update_course_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="update_course_code">Course Code</label>
                                    <input type="text" class="form-control" id="update_course_code" required>
                                    <small class="text-danger d-none" id="error_update_course_code">Course Code is already in use</small>
                                </div>
                                <div class="form-group">
                                    <label for="update_course_title">Course Title</label>
                                    <input type="text" class="form-control" id="update_course_title" required>
                                </div>
                                <div class="form-group">
                                    <label for="update_course_years">Years</label>
                                    <input type="number" class="form-control" id="update_course_years" required>
                                    <small class="text-danger d-none" id="error_update_course_years">Years must be greater than zero</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="update_course_id">
                                <input type="hidden" id="update_course_old_code">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="update_course_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if (session()->get("current_page") == "subject_management"): ?>
            <!-- New Subject Modal -->
            <div class="modal fade" id="new_subject_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">New Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="new_subject_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="new_subject_code">Subject Code</label>
                                    <input type="text" class="form-control" id="new_subject_code" required>
                                    <small class="text-danger d-none" id="error_new_subject_code">Subject Code is already in use</small>
                                </div>
                                <div class="form-group">
                                    <label for="new_subject_title">Descriptive Title</label>
                                    <input type="text" class="form-control" id="new_subject_title" required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_subject_lecture_units">Lecture Units</label>
                                            <input type="number" class="form-control" id="new_subject_lecture_units" required>
                                            <small class="text-danger d-none" id="error_new_subject_lecture_units">Lecture Units must be equal or greater than zero</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_subject_laboratory_units">Laboratory Units</label>
                                            <input type="number" class="form-control" id="new_subject_laboratory_units" required>
                                            <small class="text-danger d-none" id="error_new_subject_laboratory_units">Laboratory Units must be equal or greater than zero</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="new_subject_hours_per_week">Hours/Week</label>
                                            <input type="number" class="form-control" id="new_subject_hours_per_week" required>
                                            <small class="text-danger d-none" id="error_new_subject_hours_per_week">Hours per week must be greater than zero</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="new_subject_course">Course</label>
                                            <select id="new_subject_course" class="custom-select" required>
                                                <option value selected disabled></option>
                                                <?php if ($courses): ?>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="new_subject_year" class="required">Year</label>
                                            <select id="new_subject_year" class="custom-select" disabled required>
                                                <!-- Data from AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="new_subject_semester" class="required">Semester</label>
                                            <select id="new_subject_semester" class="custom-select" required>
                                                <option value selected disabled></option>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="new_subject_pre_requisites">Pre-Requisites</label>
                                    <select class="select2 w-100" id="new_subject_pre_requisites" multiple="multiple" data-placeholder="Leave blank if none">
                                        <!-- Data from AJAX -->
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="new_subject_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Subject Modal -->
            <div class="modal fade" id="update_subject_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Update Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="update_subject_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="update_subject_code">Subject Code</label>
                                    <input type="text" class="form-control" id="update_subject_code" required>
                                    <small class="text-danger d-none" id="error_update_subject_code">Subject Code is already in use</small>
                                </div>
                                <div class="form-group">
                                    <label for="update_subject_title">Descriptive Title</label>
                                    <input type="text" class="form-control" id="update_subject_title" required>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_subject_lecture_units">Lecture Units</label>
                                            <input type="number" class="form-control" id="update_subject_lecture_units" required>
                                            <small class="text-danger d-none" id="error_update_subject_lecture_units">Lecture Units must be equal or greater than zero</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_subject_laboratory_units">Laboratory Units</label>
                                            <input type="number" class="form-control" id="update_subject_laboratory_units" required>
                                            <small class="text-danger d-none" id="error_update_subject_laboratory_units">Laboratory Units must be equal or greater than zero</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="update_subject_hours_per_week">Hours/Week</label>
                                            <input type="number" class="form-control" id="update_subject_hours_per_week" required>
                                            <small class="text-danger d-none" id="error_update_subject_hours_per_week">Hours per week must be greater than zero</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="update_subject_course">Course</label>
                                            <select id="update_subject_course" class="custom-select" required>
                                                <?php if ($courses): ?>
                                                    <?php foreach ($courses as $course): ?>
                                                        <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                                    <?php endforeach ?>
                                                <?php endif ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="update_subject_year" class="required">Year</label>
                                            <select id="update_subject_year" class="custom-select" disabled required>
                                                <!-- Data from AJAX -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="update_subject_semester" class="required">Semester</label>
                                            <select id="update_subject_semester" class="custom-select" required>
                                                <option value="1st">1st</option>
                                                <option value="2nd">2nd</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="update_subject_pre_requisites">Pre-Requisites</label>
                                    <select class="select2 w-100" id="update_subject_pre_requisites" multiple="multiple" data-placeholder="Leave blank if none">
                                        <?php if ($subjects): ?>
                                            <?php foreach ($subjects as $subject): ?>
                                                <option value="<?= $subject["code"] ?>"><?= $subject["title"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="update_subject_id">
                                <input type="hidden" id="update_subject_old_code">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="update_subject_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if (session()->get("current_page") == "grade_management"): ?>
            <!-- New Grade Modal -->
            <div class="modal fade" id="new_grade_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">New Grade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="new_grade_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="new_grade_student_id">Student Name</label>
                                    <select class="custom-select" id="new_grade_student_id" required>
                                        <option value disabled selected></option>
                                        <?php if ($students): ?>
                                            <?php foreach ($students as $student): ?>
                                                <option value="<?= $student["id"] ?>"><?= $student["first_name"] ?> <?= !empty($student["middle_name"]) ? $student["middle_name"][0] . '.' : '' ?> <?= $student["last_name"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_grade_course">Course</label>
                                    <select class="custom-select" id="new_grade_course" required>
                                        <option value disabled selected></option>
                                        <?php if ($courses): ?>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_grade_year">Year</label>
                                    <select class="custom-select" id="new_grade_year" disabled required>
                                        <!-- Data from AJAX -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_grade_semester">Semester</label>
                                    <select class="custom-select" id="new_grade_semester" required>
                                        <option value disabled selected></option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_grade_subject_id">Subject</label>
                                    <select class="custom-select" id="new_grade_subject_id" disabled required>
                                        <!-- Data from AJAX -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="new_grade_grade">Final Grade</label>
                                    <input type="number" class="form-control" id="new_grade_grade" step="0.1" required>
                                    <small class="text-danger d-none" id="error_new_grade_grade">Grade must be greater than or equal to 1</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="new_grade_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Grade Modal -->
            <div class="modal fade" id="update_grade_modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="overlay loading d-none">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title">Update Grade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="javascript:void(0)" id="update_grade_form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="update_grade_student_id">Student Name</label>
                                    <select class="custom-select" id="update_grade_student_id" required>
                                        <?php if ($students): ?>
                                            <?php foreach ($students as $student): ?>
                                                <option value="<?= $student["id"] ?>"><?= $student["first_name"] ?> <?= !empty($student["middle_name"]) ? $student["middle_name"][0] . '.' : '' ?> <?= $student["last_name"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_grade_course">Course</label>
                                    <select class="custom-select" id="update_grade_course" required>
                                        <?php if ($courses): ?>
                                            <?php foreach ($courses as $course): ?>
                                                <option value="<?= $course["code"] ?>"><?= $course["title"] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_grade_year">Year</label>
                                    <select class="custom-select" id="update_grade_year" disabled required>
                                        <!-- Data from AJAX -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_grade_semester">Semester</label>
                                    <select class="custom-select" id="update_grade_semester" required>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_grade_subject_id">Subject</label>
                                    <select class="custom-select" id="update_grade_subject_id" disabled required>
                                        <!-- Data from AJAX -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="update_grade_grade">Final Grade</label>
                                    <input type="number" class="form-control" id="update_grade_grade" step="0.1" required>
                                    <small class="text-danger d-none" id="error_update_grade_grade">Grade must be greater than or equal to 1</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="update_grade_id">
                                <input type="hidden" id="update_grade_old_student_id">
                                <input type="hidden" id="update_grade_old_course">
                                <input type="hidden" id="update_grade_old_year">
                                <input type="hidden" id="update_grade_old_semester">
                                <input type="hidden" id="update_grade_old_subject_id">

                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="update_grade_submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <script>
            var base_url = "<?= base_url() ?>";
            var mode = "<?= session()->get("mode") ?>";
            var user_id = "<?= session()->get("user_id") ?>";
            var notification = <?= session()->get("notification") ? json_encode(session()->get("notification")) : json_encode(null) ?>;
        </script>

        <script src="<?= base_url() ?>public/plugins/jquery/jquery.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/sweetalert2/js/sweetalert2.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/datatables/js/dataTables.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/inputmask/inputmask.min.js"></script>
        <script src="<?= base_url() ?>public/plugins/select2/js/select2.full.min.js"></script>
        <script src="<?= base_url() ?>public/dist/js/adminlte.min.js"></script>
        <script src="<?= base_url() ?>public/dist/js/main.min.js"></script>
        </body>

        </html>

        <?php session()->remove("notification") ?>