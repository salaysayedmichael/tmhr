<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer content-outer">
        <div class="inner bg-light lter">

            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <?php echo form_open(base_url() . 'evaluation', array('id' => 'evaluation-filter'));?>
                        <input id="filter-group" name="filter-group" type="hidden"  value="<?php echo (!empty($sel_group)) ? $sel_group : '';?>"/>

                        <header>
                            <div class="col-md-7">
                                <div class="icons icon-evaluation">
                                    <i class="fa fa-th"></i>
                                </div>
                                <h5>Evaluation List</h5>
                            </div>

                            <div class="col-md-2 filter-container">
                                <select name="sel-filter-status" class="form-control evaluation-filter sel-filter-status">
                                    <option>All</option>
                                    <option <?php echo ($filter_status == "Done") ? "selected" : "";?>>Done</option>
                                    <option <?php echo ($filter_status == "Ongoing") ? "selected" : "";?>>Ongoing</option>
                                    <option <?php echo ($filter_status == "Expired") ? "selected" : "";?>>Expired</option>
                                </select>
                            </div>

                            <div class="col-md-2 filter-container">
                                <select name="sel-filter-user" class="form-control evaluation-filter sel-filter-user">
                                    <option value="0">Select Filter</option>
                                    <optgroup label="By Department">
                                        <?php if(!empty($departments)) :?>
                                            <?php foreach($departments as $dep_key => $department) :?>
                                                <?php $selected = ($sel_group == "By Department" && $filter_id == $department['department_id']) ? "selected" : "";?>

                                        <option value="<?php echo $department['department_id'];?>" <?php echo $selected;?>><?php echo ucwords($department['department_title']);?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </optgroup>
                                    <optgroup label="By Employee">
                                        <?php if(!empty($employee_names)) :?>
                                            <?php foreach($employee_names as $emp_id => $employee) :?>
                                                <?php $selected = ($sel_group == "By Employee" && $filter_id == $emp_id) ? "selected" : "";?>

                                        <option value="<?php echo $emp_id;?>" <?php echo $selected;?>><?php echo ucwords($employee);?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </optgroup>
                                </select>
                            </div>

                            <!-- .toolbar -->
                            <div class="toolbar col-md-1">
                                <nav class="pull-right" style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </nav>
                            </div>
                            <!-- /.toolbar -->
                        </header>
                        <?php echo form_close();?>
                        <div id="div-5" class="body collapse in" aria-expanded="true" style="">
                            <input id="create-eval-token" type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

                            <form class="">
                                <div class="form-group row">
                                    <div class="col-lg-10">
                                    </div>
                                    <div class="col-lg-2">
                                        <a class="btn btn-primary" id="btn-create-evaluation">
                                            Create Evaluation
                                        </a>
                                    </div>

                                    <?php if(!empty($heads)) :?>
                                        <?php foreach($heads as $head_id => $head_name) :?>
                                            <?php if(!empty($evaluations[$head_id])) :?>
                                    <div class="col-lg-12 ui-sortable">
                                        <div class="box ui-sortable-handle eval-container">
                                            <header>
                                                <h5 class="ucfirst"> <i>Evaluator</i> : <span class="text-info eval-evaluator"><?php echo ucwords($head_name);?><span></h5>
                                                <div class="toolbar">
                                                    <div class="btn-group">
                                                        <a href="#defaultTable-<?php echo $head_id;?>" data-toggle="collapse" class="btn btn-sm btn-default minimize-box" aria-expanded="true">
                                                            <i class="fa fa-angle-up"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </header>
                                            <div id="defaultTable-<?php echo $head_id;?>" class="body collapse in" aria-expanded="true" style="">
                                                <table class="table table-bordered responsive-table table-evaluation-list">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Employee Name</th>
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>Score</th>
                                                            <th>Evaluation Detail</th>
                                                            <th>Expiry Date</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php if(!empty($evaluations[$head_id])) :?>
                                                            <?php foreach($evaluations[$head_id] as $evaluation_count => $eval) :?>
                                                        <tr class="tbl-eval-row" data-eval-list="<?php echo $eval['id'];?>">
                                                            <td><?php echo ($evaluation_count+1);?></td>
                                                            <td class="ucfirst eval-evaluated"><?php echo $eval['evaluated_name'];?></td>
                                                            <td class="eval-type"><?php echo ucfirst($eval["type"]);?></td>
                                                            <td><?php echo $eval["status_words"];?></td>
                                                            <td class="text-center"><?php echo (!empty($eval["score"])) ? ($eval["score"] . "%") : '';?></td>
                                                            <td class="text-center">
                                                                <a class="btn btn-default <?php echo (!empty($eval["score"])) ? 'btn-finish-eval' : '';?>" <?php echo (!empty($eval["score"])) ? '' : 'disabled';?> data-csrf-token="<?php echo $this->security->get_csrf_hash();?>">View Result</a>
                                                            </td>
                                                            <td class="text-red text-center"><?php echo $eval["expiry_date"];?></td>
                                                            <td class="text-center">
                                                                <?php if($eval["status_words"] == "Ongoing"):?>
                                                                    <a class="btn btn-danger delete-eval" id="<?php echo $eval['id']?>" data-csrf-token="<?php echo $this->security->get_csrf_hash();?>"><i class="fa fa-trash"></i></a>
                                                                <?php else: ?>
                                                                    <a class="btn btn-danger" disabled><i class="fa fa-trash"></i></a>
                                                                <?php endif;?>
                                                            </td>
                                                        </tr>
                                                            <?php endforeach;?>
                                                        <?php endif;?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>

<div class="modal fade in" id="modal-create-evaluation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Create Evaluation</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-evaluate-employee'));?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <div class="col-lg-4">
                                </div>

                                <label class="control-label col-lg-4">Evaluation Type</label>
                                <div class="col-lg-4">
                                    <select id="evalution-type" class="form-control">
                                        <option>Department Head To Employee</option>
                                        <option>Employee To Department Head</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <h5>Department Head</h5>

                                            <!-- .toolbar -->
                                            <div class="toolbar">
                                                <nav style="padding: 8px;">
                                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </nav>
                                            </div>
                                            <!-- /.toolbar -->
                                        </header>
                                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Department</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-eval-department" name="department" class="form-control">
                                                        <?php if(!empty($departments)) :?>
                                                            <?php foreach($departments as $department):?>
                                                        <option value="<?php echo $department['department_id'];?>"><?php echo ucwords($department['department_title']);?></option>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Department Head</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-dep-head" name="dep-head" size="5" class="form-control" data-csrf-token="<?php echo $this->security->get_csrf_hash();?>" disabled>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                               <div class="col-lg-6">
                                    <div class="box dark">
                                        <header>
                                            <div class="icons">
                                                <i class="fas fa-users"></i>
                                            </div>
                                            <h5>Employee</h5>

                                            <!-- .toolbar -->
                                            <div class="toolbar">
                                                <nav style="padding: 8px;">
                                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                                        <i class="fa fa-expand"></i>
                                                    </a>
                                                </nav>
                                            </div>
                                            <!-- /.toolbar -->
                                        </header>
                                        <div id="div-1" class="body collapse in" aria-expanded="true" style="">
                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Expiry Date</label>
                                                <div class="col-lg-8">
                                                    <input id="evaluation-expiry-date" type="text" name="evaluation-expiry-date" placeholder="" class="form-control date-picker text-right">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Employee List</label>
                                                <div class="col-lg-8">
                                                    <select id="sel-dep-emp" name="dep-emp" multiple="multiple" size="5" class="form-control" disabled>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-lg-4">Type</label>
                                                <div class="col-lg-8">
                                                    <input id="type" type="text" name="type" placeholder="e.g Probationary, Regularization" class="form-control" value="">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--END SELECT-->
                            </div>

                        </div>
                    </div>
                <?php echo form_close();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-110" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-110 btn-create-evaluation">Create</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade in" id="modal-view-evaluation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>

                <h4 class="modal-title">Evaluation Result: <span id="evaluated-employee-name" class="ucfirst text-info"></span></h4>
                <h4 class="modal-title">Evaluator: <span id="evaluator-name" class="ucfirst text-info"></span></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="evaluation-detail" value=""/>
                <input type="hidden" id="evaluation-result-type" value=""/>
                <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'form-view-evaluation'));?>

                <table id="tbl-eval-result" class="table table-bordered responsive-table">
                    <thead>
                        <tr>
                            <th class="text-center" width="300px">Attribute</th>
                            <th class="text-center">Comments</th>
                            <th class="text-center">Recommendations</th>
                            <th class="text-center">Selected Rating</th>
                            <th class="text-center">Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($evaluation_attribute)) :?>
                            <?php foreach($evaluation_attribute as $key => $attr_value) :?>
                        <tr>
                            <td class="word-wrap vertical-middle"><?php echo $attr_value["attr_title"];?></td>
                            <td class="word-wrap vertical-middle comments-<?php echo $attr_value['attr_id'];?>"></td>
                            <td class="word-wrap vertical-middle recommendations-<?php echo $attr_value['attr_id'];?>"></td>
                            <td class="vertical-middle rating-<?php echo $attr_value['attr_id'];?>"></td>
                            <td class="vertical-middle text-right rating-num-<?php echo $attr_value['attr_id'];?>"></td>
                        </tr>
                            <?php endforeach;?>

                        <tr>
                            <td class="text-center" colspan="4"><b>Total</b></td>
                            <td class="text-right attr-total"></td>
                        </tr>

                        <tr>
                            <td><b>Employee Strength</b></td>
                            <td class="attr-strength" id="overall-strength" colspan="4"></td>
                        </tr>
                        <tr>
                            <td><b>Employee Weakness</b></td>
                            <td class="attr-weakness" id="overall-weakness" colspan="4"></td>
                        </tr>
                        <tr>
                            <td><b>Plan for Improvement</b></td>
                            <td class="attr-improvement" id="overall-improvement" colspan="4"></td>
                        </tr>
                        <tr>
                            <td><b>Trainings/Development Needed</b></td>
                            <td class="attr-training" id="overall-training" colspan="4"></td>
                        </tr>
                        <tr>
                            <td><b>Overall Recommendation</b></td>
                            <td class="attr-recommendation" id="overall-recommendation" colspan="4"></td>
                        </tr>

                        <?php else :?>
                        <tr>
                            <td colspan="5">No Data Found.</td>
                        </tr>
                        <?php endif;?>
                    </tbody>
                </table>

                <?php echo form_close();?>

<!--
                <div class="row padding-left-right-15">
                    <div class="col-md-5 overall-container">
                        <span><h5>OverAll Comment:</h5></span>
                        <label id="overall-comment"></label>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-5 overall-container">
                        <span><h5>OverAll Recommendation:</h5></span>
                        <label id="overall-recommendation"></label>
                    </div>
                </div>
-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-110 pull-left btn-print-evaluation"><i class="glyphicon glyphicon-print"></i> Print Result</button>
                <button type="button" class="btn btn-default btn-110" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>