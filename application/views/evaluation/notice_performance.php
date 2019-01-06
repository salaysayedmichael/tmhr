<div id="content" class="nte-vue">
    <input class="base-url" type="hidden" value="<?php echo base_url();?>"/>
    <input class="my-token" type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

    <div class="outer content-outer">
        <div class="inner bg-light lter">
            <div class="row">

                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h5>Notice To Explain</h5>

                            <button class="btn btn-primary pull-right width-150 margin-top-3px btn-add-nop"> <i class="fas fa-plus"></i> Add</button>
                        </header>
                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                            <table id="nop-table" class="table table-bordered responsive-table">
                                <thead>
                                    <tr>
                                        <th class="text-center" v-for="col in table_cols" v-text="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="nop-row" v-for="(row, key) in nop_list">
                                        <td class="text-center">{{ key+1 }}</td>
                                        <td class="text-capitalize" v-text="row.employee_name"></td>
                                        <td v-text="row.reason"></td>
                                        <td class="text-capitalize" v-text="row.recommended_by_name"></td>
                                        <td v-text="row.submission_date"></td>
                                        <td class="text-center font-size-20">
                                            <input class="nop-id" type="hidden" v-bind:value="row.id">
                                            <i class="fas fa-trash-alt text-red cursor-pointer btn-nop-delete"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!--modals here-->
    <div id="modal-add-nop" class="modal fade in" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add Notice of Performance</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label class="control-label col-lg-4">Employee</label>
                            <div class="col-lg-8">
                                <select class="form-control text-capitalize" v-model="sel_nop_employee">
                                    <option v-bind:value="0">Select Employee</option>
                                    <option v-for="(employee, id) in employee_list" v-bind:value="employee.employee_id" v-text="employee.name"></option>
                                </select>
                            </div>
                            <div class="col-md-12 text-center text-red">
                                <span v-text="nop_error_messages.employee"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text4" class="control-label col-lg-4">Reason</label>
                            <div class="col-lg-8">
                                <textarea id="text4" class="form-control" v-model="nop_reason"></textarea>
                            </div>
                            <div class="col-md-12 text-center text-red">
                                <span v-text="nop_error_messages.reason"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Recommended By</label>
                            <div class="col-lg-8">
                                <select class="form-control text-capitalize" v-model="sel_nop_head">
                                    <option v-bind:value="0">Select Department Head</option>
                                    <option v-for="head in employee_head_list" v-bind:value="head.head_id" v-text="head.head_name"></option>
                                </select>
                            </div>
                            <div class="col-md-12 text-center text-red">
                                <span v-text="nop_error_messages.recommended_by"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-4">Date of Submission</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control date-submission" v-model="nop_submission_date">
                            </div>
                            <div class="col-md-12 text-center text-red">
                                <span v-text="nop_error_messages.submission_date"></span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default width-150" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary width-150 btn-add-nte" data-loading-text="<i class='fas fa-circle-notch fa-spin'></i> Saving">Add</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>