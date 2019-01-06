$(document).ready(function() {
    var vm = initVue();

    setNOPData();

    function initVue() {
        var vm = new Vue({
            el   : ".nte-vue",
            data : {
                employee_list       : [],
                employee_head_list  : [],
                sel_nop_employee    : 0,
                sel_nop_head        : 0,
                nop_submission_date : "",
                nop_reason          : "",
                nop_error_messages  : [],
                table_cols          : ['#', 'Employee Name', 'Reason', 'Recommended By', 'Submission Date', 'Action'],
                nop_list            : [],
                sel_nop_id          : 0
            },
            mounted() {
                $(".date-submission").datepicker().on(
                    "changeDate", () => {
                        this.nop_submission_date = $('.date-submission').val();
                        $('.date-submission').datepicker("hide");
                    }
                );
            }
        });

        return vm;
    }

    $("body").on("click", ".btn-add-nop", function() {
        $("#modal-add-nop").modal("show");
    });

    function setNOPData() {
        $.ajax({
            method : "POST",
            url    : "getNOPData",
            data   : {
                "tm_hr_token" : $(".my-token").val()
            },
            success: function(result) {
                jsonres               = $.parseJSON(result);
                
                vm.employee_list      = jsonres.employee_list;
                vm.employee_head_list = jsonres.employee_head_list;
                
                var table             = $('#nop-table').DataTable();

                table.destroy();

                if($(jsonres).size() > 0) {
                    vm.nop_list = jsonres.nop_list;
                }

                setTimeout(function() {
                    $('#nop-table').DataTable({
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

    $("body").on("click", ".btn-add-nte", function() {
        var $this = $(this);
        $this.button('loading');

        $.ajax({
            method : "POST",
            url    : "addNOPData",
            data   : {
                "tm_hr_token"     : $(".my-token").val(),
                "employee_id"     : vm.sel_nop_employee,
                "reason"          : vm.nop_reason,
                "recommended_by"  : vm.sel_nop_head,
                "submission_date" : vm.nop_submission_date
            },
            success: function(result) {
                jsonres               = $.parseJSON(result);

                vm.nop_error_messages = jsonres.message;

                $this.button('reset');

                if(!jsonres.error) {
                    alertify.alert(
                        getMessageType("success", "Add New Notice To Explain"),
                        jsonres.overall_message,
                        function() {
                            setNOPData();
                            $("#modal-add-nop").modal("hide");
                        }
                    );
                }
            }
        });
    });

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

    $("body").on("click", ".btn-nop-delete", function() {
        vm.sel_nop_id = $(this).closest("td").find(".nop-id").val();

        alertify.confirm(
            getMessageType("warning", "Delete Notice of Performance"),
            "Are you sure you want to remove this Notice of Performance?",
            function() {
                removeNOP();
            },
            function() {
                alertify.error('Cancel');
            }
        ).set('labels', {ok:'Delete', cancel:'Cancel'});
    });

    function removeNOP() {
        $.ajax({
            method : "POST",
            url    : "deleteNOPData",
            data   : {
                "tm_hr_token" : $(".my-token").val(),
                "nop_id"      : vm.sel_nop_id
            },
            success: function(result) {
                jsonres = $.parseJSON(result);

                if(!jsonres.error) {
                    setNOPData();
                } else {
                    alertify.alert(
                        getMessageType("warning", "Delete Notice To Explain"),
                        jsonres.overall_message,
                        function() {
                            /*do nothing*/
                        }
                    );
                }
            }
        });
    }
});