$(document).ready(function() {
    var vm = initVue();

    getNTE();
    setManagers();

    $('#nte-table').DataTable();

    $("body").on("click", ".btn-add-nte", function() {
        vm.nte_action      = "Add";
        vm.nte_action_icon = "fas fa-plus-circle";
        vm.nte_btn_action  = "btn-nte-save";

        setNTEFormEmpty();
        $("#modal-add-nte").modal("show");
    });

    function setNTEFormEmpty() {
        vm.nte_category             = 0;
        vm.nte_level                = 0;
        vm.nte_occurence            = 0;
        vm.nte_sanction_progression = 0;
        vm.nte_commission_manner    = "";
        vm.nte_improvement_plan     = "";
        vm.nte_further_infraction   = "";
        vm.nte_violation_details    = "";
        vm.nte_date_incurred        = "";
        vm.nte_infraction_place     = "";
        vm.nte_manager              = 0;
    }

    function initVue() {
        var vm = new Vue({
            el   : ".nte-vue",
            data : {
                sel_nte                 : $(".sel-nte option:first").val(),
                sel_nte_add             : $(".sel-nte-add option:first").val(),
                nte_category            : 0,
                nte_violation_details   : "",
                nte_date_incurred       : "",
                nte_date_served         : "",
                nte_error_violation     : "",
                nte_error_details       : "",
                nte_error_sanction      : "",
                nte_error_date_incurred : "",
                nte_error_date_served   : "",
                categories              : [
                                            "Work Performance and Productivity",
                                            "Attendance",
                                            "Professional Conduct",
                                            "Protection and Property",
                                            "Health, Safety and Physical Security"
                                          ],
                violation_levels        : [
                                            "Minor A",
                                            "Minor B",
                                            "Serious",
                                            "Grave",
                                          ],
                nte_level               : 0,
                misconduct_occurence    : [
                                            "1st",
                                            "2nd",
                                            "3rd",
                                            "4th",
                                            "5th",
                                            "6th"
                                          ],
                nte_occurence           : 0,
                sanction_progression    : [
                                            "Documented Verbal Coaching",
                                            "Written Reprimand",
                                            "Final Written Reprimand",
                                            "Suspension",
                                            "Termination"
                                          ],
                nte_sanction_progression: 0,
                nte_commission_manner   : "",
                nte_error_commission_manner : "",
                nte_improvement_plan    : "",
                nte_error_improvement_plan : "",
                nte_further_infraction  : "",
                nte_error_further_infraction : "",
                nte_infraction_place    : "",
                nte_error_infraction_place : "",
                managers                : [],
                nte_manager             : 0,
                nte_error_manager       : "",
                nte_error_category      : "",
                nte_error_level         : "",
                nte_error_occurence     : "",
                nte_error_progress      : "",
                nte_lists               : [],
                nte_action              : "Add",
                nte_action_icon         : "fas fa-plus-circle",
                nte_btn_action          : "btn-nte-save",
                nte_selected_id         : 0,
                nte_error_employee      : ""
            },
            mounted() {
                $(".nte-date-incurred").datepicker().on(
                    "changeDate", () => {
                        this.nte_date_incurred = $('.nte-date-incurred').val();
                        $('.nte-date-incurred').datepicker("hide");
                    }
                );
            }
        });

        return vm;
    }

    $("body").on("click", ".btn-nte-save", function() {
        var data = {
            'employee_id'              : $(".sel-nte-add").val(),
            'tm_hr_token'              : $("#modal-add-nte").find(".my-token").val(),
            'nte_category'             : vm.nte_category,
            'nte_level'                : vm.nte_level,
            'nte_occurence'            : vm.nte_occurence,
            'nte_sanction_progression' : vm.nte_sanction_progression,
            'nte_commission_manner'    : vm.nte_commission_manner,
            'nte_improvement_plan'     : vm.nte_improvement_plan,
            'nte_further_infraction'   : vm.nte_further_infraction,
            'nte_violation_details'    : vm.nte_violation_details,
            'nte_date_incurred'        : vm.nte_date_incurred,
            'nte_infraction_place'     : vm.nte_infraction_place,
            'nte_manager'              : vm.nte_manager
        }

        $.ajax({
            method : "POST",
            url    : "saveNTE",
            data   : data,
            success: function(result) {
                jsonres = $.parseJSON(result);

                setNTEError(jsonres);

                if(!jsonres.error) {
                    alertify.alert(
                        getMessageType("success", "Add New NTE"),
                        "NTE successfully added",
                        function() {
                            $("#modal-add-nte").modal("hide");
                            location.reload();
                        }
                    );
                }
            }
        });
    });

    function setNTEError(jsonres) {
        vm.nte_error_manager            = jsonres.message["manager"];
        vm.nte_error_category           = jsonres.message["category"];
        vm.nte_error_level              = jsonres.message["level"];
        vm.nte_error_occurence          = jsonres.message["occurence"];
        vm.nte_error_progress           = jsonres.message["progress"];
        vm.nte_error_commission_manner  = jsonres.message["commission_manner"];
        vm.nte_error_details            = jsonres.message["details"];
        vm.nte_error_improvement_plan   = jsonres.message["improvement_plan"];
        vm.nte_error_further_infraction = jsonres.message["further_infraction"];
        vm.nte_error_date_incurred      = jsonres.message["date_incurred"];
        vm.nte_error_infraction_place   = jsonres.message["infraction_place"];
    }

    function getMessageType(type, title = "") {
        result = '<i class="text-info glyphicon glyphicon-info-sign"></i> ';

        if(type == 'invalid') {
            result = '<i class="text-red glyphicon glyphicon-exclamation-sign"></i> ';
        }

        if(type == 'info') {
            result = '<i class="text-green glyphicon glyphicon-info-sign"></i> ';
        }

        if(type == 'warning') {
            result = '<i class="text-red fas fa-exclamation-triangle"></i> ';
        }


        result += " " + title;

        return result;
    }

    function getNTE() {
        var data = {
            'tm_hr_token' : $("#modal-add-nte").find(".my-token").val()
        };

        $.ajax({
            method : "POST",
            url    : "getNTE",
            data   : data,
            success: function(result) {
                jsonres = $.parseJSON(result);

                var table  = $('#nte-table').DataTable();

                table.destroy();

                if($(jsonres).size() > 0) {
                    vm.nte_lists = jsonres;
                }

                setTimeout(function() {
                    $('#nte-table').DataTable({
                        "destroy": true,
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true
                    });
                }, 100);

            }
        });
    }

    $("body").on("click", ".nte-edit", function() {
        vm.nte_action      = "Update";
        vm.nte_action_icon = "fas fa-edit";
        vm.nte_btn_action  = "btn-nte-update";
        vm.nte_selected_id = $(this).closest("td").find(".nte-id").val();

        var data = {
            'tm_hr_token' : $("#modal-add-nte").find(".my-token").val(),
            'nte_selected_id' : vm.nte_selected_id
        };

        $.ajax({
            method : "POST",
            url    : "getNTEData",
            data   : data,
            success: function(result) {
                jsonres = $.parseJSON(result);

                vm.nte_category             = jsonres.category;
                vm.nte_level                = jsonres.level;
                vm.nte_occurence            = jsonres.occurence;
                vm.nte_sanction_progression = jsonres.sanction_progression;
                vm.nte_commission_manner    = jsonres.commission_manner;
                vm.nte_improvement_plan     = jsonres.improvement_plan;
                vm.nte_further_infraction   = jsonres.further_infraction;
                vm.nte_violation_details    = jsonres.details;
                vm.nte_date_incurred        = jsonres.date_incurred;
                vm.nte_infraction_place     = jsonres.infraction_place;
                vm.nte_manager              = jsonres.manager;
                vm.sel_nte                  = jsonres.employee_id;
            }
        });

        $('.nte-date-incurred').val(vm.nte_date_incurred);
        $("#modal-add-nte").modal("show");
    });

    $("body").on("click", ".btn-nte-update", function() {
        var data = {
            'tm_hr_token'              : $("#modal-add-nte").find(".my-token").val(),
            'nte_id'                   : vm.nte_selected_id,
            'employee_id'              : vm.sel_nte,
            'nte_category'             : vm.nte_category,
            'nte_level'                : vm.nte_level,
            'nte_occurence'            : vm.nte_occurence,
            'nte_sanction_progression' : vm.nte_sanction_progression,
            'nte_commission_manner'    : vm.nte_commission_manner,
            'nte_improvement_plan'     : vm.nte_improvement_plan,
            'nte_further_infraction'   : vm.nte_further_infraction,
            'nte_violation_details'    : vm.nte_violation_details,
            'nte_date_incurred'        : vm.nte_date_incurred,
            'nte_infraction_place'     : vm.nte_infraction_place,
            'nte_manager'              : vm.nte_manager
        }

        $.ajax({
            method : "POST",
            url    : "updateNTE",
            data   : data,
            success: function(result) {
                jsonres = $.parseJSON(result);

                setNTEError(jsonres);

                if(!jsonres.error) {
                    alertify.alert(
                        getMessageType("success", "Update NTE"),
                        "NTE successfully updated.",
                        function() {
                            $("#modal-add-nte").modal("hide");
                            location.reload();
                        }
                    );
                }
            }
        });

    });

    function setManagers() {
        $.ajax({
            method : "POST",
            url    : "getEmployeeManagers",
            data   : {
                "employee_id" : vm.sel_nte,
                "tm_hr_token" : $("#modal-add-nte").find(".my-token").val()
            },
            success: function(result) {
                jsonres = $.parseJSON(result);

                vm.managers = jsonres;
            }
        });
    }

    $("body").on("click", ".nte-delete", function() {
        vm.nte_selected_id = $(this).closest("td").find(".nte-id").val();

        alertify.confirm(
            getMessageType("warning", "Delete NTE"),
            "Are you sure you want to remove this NTE?",
            function() {
                removeNTE();
            },
            function() {
                alertify.error('Cancel');
            }
        ).set('labels', {ok:'Delete', cancel:'Cancel'});;
    });

    function removeNTE() {
        $.ajax({
            method : "POST",
            url    : "removeNTE",
            data   : {
                "nte_id" : vm.nte_selected_id,
                "tm_hr_token" : $("#modal-add-nte").find(".my-token").val()
            },
            success: function(result) {
                jsonres = $.parseJSON(result);

                if(jsonres.error == false) {
                    alertify.success('Ok');
                    location.reload();
                } else {
                    alertify.alert(
                        getMessageType("error", "Remove NTE"),
                        jsonres.message,
                        function() {
                        }
                    );
                }
            }
        });
    }

    $("body").on("click", ".nte-download", function() {
        vm.nte_selected_id = $(this).closest("td").find(".nte-id").val();
        var emp_name       = $(this).closest("tr").find(".emp-name").text();

        $.ajax({
            method : "POST",
            url    : "generateNTE",
            data   : {
                "nte_id" : vm.nte_selected_id,
                "tm_hr_token" : $("#modal-add-nte").find(".my-token").val()
            },
            success: function(result) {
                jsonres = $.parseJSON(result);

                if(jsonres.error == false) {
                    alertify.alert(
                        getMessageType("success", "Download NTE"),
                        jsonres.message,
                        function() {
                            downloadNTE(jsonres.file, emp_name);
                        }
                    );
                } else {
                    alertify.alert(
                        getMessageType("error", "Download NTE"),
                        jsonres.message,
                        function() {
                        }
                    );
                }
            }
        });
    });

    function downloadNTE(file, emp_name) {
        window.open("downloadNTE?f=" + file + "&e=" + emp_name, "_blank");
    }
});

