        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="<?= base_url() ?>">Student Performance Tracking System</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
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
                                            <option value="BSIT">Bachelor of Science in Information Technology</option>
                                            <option value="BSA">Bachelor of Science in Agriculture</option>
                                            <option value="BEED">Bachelor of Elementary Education</option>
                                            <option value="BSED">Bachelor of Secondary Education</option>
                                            <option value="BSCrim">Bachelor of Science in Criminology</option>
                                            <option value="BSA">Bachelor of Science in Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="new_student_year" class="required">Year</label>
                                        <select id="new_student_year" class="custom-select" required>
                                            <option value selected disabled></option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
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
                                            <option value="BSIT">Bachelor of Science in Information Technology</option>
                                            <option value="BSA">Bachelor of Science in Agriculture</option>
                                            <option value="BEED">Bachelor of Elementary Education</option>
                                            <option value="BSED">Bachelor of Secondary Education</option>
                                            <option value="BSCrim">Bachelor of Science in Criminology</option>
                                            <option value="BSA">Bachelor of Science in Business Administration</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="update_student_year" class="required">Year</label>
                                        <select id="update_student_year" class="custom-select" required>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            <option value="4th">4th</option>
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
        <script src="<?= base_url() ?>public/dist/js/adminlte.min.js"></script>
        <script src="<?= base_url() ?>public/dist/js/main.js?v=1.0.3"></script>
        </body>

        </html>

        <?php session()->remove("notification") ?>