<div id="content" class="nte-vue">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer content-outer">
        <div class="inner bg-light lter">
            <div class="row">

                <div class="col-lg-12">
                    <div class="box dark">
                        <header>
                            <div class="icons">
                                <i class="fas fa-flag"></i>
                            </div>
                            <h5>Notice To Explain</h5>
                            <div class="pull-right">
                                <div class="div-sel-nte">
                                    <select class="form-control sel-nte" v-model="sel_nte" style="display: none;">
                                        <option value="0">All</option>
                                        
                                        <?php if(!empty($employees)) :?>
                                            <?php foreach($employees as $id => $employee) :?>
                                        <option value="<?php echo $id;?>"><?php echo ucwords($employee);?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary pull-right width-150 btn-add-nte"> <i class="fas fa-plus"></i> Add</button>
                        </header>
                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">

                            <table id="nte-table" class="table table-bordered responsive-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Employee name</th>
                                        <th class="text-center">Manager</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Level</th>
                                        <th class="text-center">Violation Details</th>
                                        <th class="text-center">Date Incurred</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(nte_list, count) in nte_lists">
                                        <td class="text-center">{{ count + 1 }}</td>
                                        <td class="emp-name">{{ nte_list["employee_name"] }}</td>
                                        <td>{{ nte_list["manager_name"] }}</td>
                                        <td>{{ nte_list["misconduct_category"] }}</td>
                                        <td>{{ nte_list["misconduct_level"] }}</td>
                                        <td>{{ nte_list["details"] }}</td>
                                        <td>{{ nte_list["date_incurred"] }}</td>
                                        <td class="text-center">
                                            <input type="hidden" class="nte-id" v-model="nte_list['id']"/>
                                            <i class="nte-edit cursor-pointer text-blue font-size-20 fas fa-edit" ></i> | 
                                            <i class="nte-delete cursor-pointer text-red font-size-20 fas fa-trash-alt"></i> |
                                            <i class="nte-download cursor-pointer text-green font-size-20 fas fa-download"></i>
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
    <div id="modal-example" class="modal fade in" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        asdf
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="modal-add-nte" class="modal fade in" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"> <i v-bind:class="nte_action_icon" class="text-blue"></i> {{ nte_action }} Notice To Explain</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <input class="my-token" type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Employee</label>
                                    <div class="col-lg-8">
                                        <select class="form-control sel-nte-add" v-model="sel_nte_add">
                                            <?php if(!empty($employees)) :?>
                                                <?php foreach($employees as $id => $employee) :?>
                                            <option value="<?php echo $id;?>"><?php echo ucwords($employee);?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_employee}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Manager</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" v-model="nte_manager">
                                            <option value="0">Select Manager</option>
                                            <option v-for="(manager, head_id) in managers" v-bind:value="head_id">{{ manager }}</option>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_manager}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Category</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" v-model="nte_category">
                                            <option value="0">Select Category</option>
                                            <option v-for="category in categories" v-bind:value="category">{{ category }}</option>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_category}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Level</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" v-model="nte_level">
                                            <option value="0">Select Level of Violation</option>
                                            <option v-for="level in violation_levels" v-bind:value="level">{{ level }}</option>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_level}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Misconduct Occurence</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" v-model="nte_occurence">
                                            <option value="0">Select Misconduct Occurence</option>
                                            <option v-for="occurence in misconduct_occurence" v-bind:value="occurence">{{ occurence }}</option>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_occurence}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Sanction Progression</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" v-model="nte_sanction_progression">
                                            <option value="0">Select Sanction Progression</option>
                                            <option v-for="progress in sanction_progression" v-bind:value="progress">{{ progress }}</option>
                                        </select>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_progress}}</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-lg-4">Manner of Commission</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" v-model="nte_commission_manner"></textarea>
                                        
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_commission_manner}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="text4" class="control-label col-lg-4">Violation Details</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" v-model="nte_violation_details"></textarea>
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_details }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Plan For Improvement</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" v-model="nte_improvement_plan"></textarea>
                                        
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_improvement_plan }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Consequences Of Further Infraction(s)</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" v-model="nte_further_infraction"></textarea>
                                        
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_further_infraction }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Date Incurred</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control date-picker nte-date-incurred" v-model="nte_date_incurred">
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_date_incurred }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-4">Infraction Place</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control date-picker nte-infraction-place" v-model="nte_infraction_place">
                                        <div class="col-lg-12 error-message-container">
                                            <span class="error-message">{{ nte_error_infraction_place }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--
                        <div class="form-group">
                            <label class="control-label col-lg-4">Attachment</label>
                            <div class="col-lg-8">
                                <input type="file" class="form-control" id="file-nte-upload">
                            </div>
                        </div>
                        -->

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default width-150" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary width-150" v-bind:class="nte_btn_action">{{ nte_action }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--end modals-->
</div>
