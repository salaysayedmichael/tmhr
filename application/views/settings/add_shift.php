<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer">
        <div class="bg-light lter">

            <div id="user-profile-2" class="user-profile page-container">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18 dashboard-navtab">
                        <li class="active">
                            <a data-toggle="tab" href="#addshift" style="border-left: 1px;">
                                <i class="blue ace-icon fas fa-thumbtack bigger-120"></i>
                                Add Shift
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content no-border padding-24">
                        <div id="addshift" class="tab-pane in active">
                            <div class="box">
                                <header>
                                    <div class="icons">
                                        <i class="fa fa-table"></i>
                                    </div>
                                    <h5>Shifts</h5>
                                </header>
                                <div class="body">
                                    <table id="table-shifts" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Shift Name</th>
                                                <th>Shift Details</th>
                                                <th>Time In</th>
                                                <th>Time Out</th>
                                                <th>Break In</th>
                                                <th>Break Out</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if(!empty($shifts)):?>
                                            <?php foreach($shifts as $key => $shift) :?>
                                        <tr>
                                            <td><?php echo $shift["shift_name"];?></td>
                                            <td><?php echo empty($shift["shift_details"]) ? 'No details' : $shift["shift_details"];?></td>
                                            <td><?php echo date("h:i:s a",strtotime($shift["time_in"]));?></td>
                                            <td><?php echo date("h:i:s a",strtotime($shift["time_out"]));?></td>
                                            <td><?php echo $shift['break_in'] = '00:00:00.000000' ? 'Not set' : date("h:i:s a",strtotime($shift["break_in"]))?></td>
                                            <td><?php echo $shift['break_out'] = '00:00:00.000000' ? 'Not set' : date("h:i:s a",strtotime($shift["break_out"]))?></td>
                                            <td class="text-center">
                                                <input type="hidden" class="shift_id" value="<?php echo $shift['sid'] ?>" >
                                                <a id="<?php echo $shift['sid'] ?>" class="fetch_edit_shift"><i class="fa fa-edit fa-lg"></i> | </a>
                                                <a><i class="fa fa-trash-alt fa-lg delete-shift" shift-id="<?php echo $shift['sid'] ?>"></i></a>
                                            </td>
                                        
                                        </tr>
                                            <?php endforeach;?>
                                            <?php else:?>
                                        <tr>
                                            <td colspan="7" class="text-center text-danger">No data available</td>
                                        </tr>       
                                        <?php endif;?>
                                        </tbody>
                                    </table>
                                </div>
                                <header>
                                    <button class="btn btn-primary" style="margin:.8%" data-toggle="modal" data-target="#addshift-modal"><i class="fa fa-plus"></i> Add Shift</button>
                                </header>
                            </div>
                        </div>
                        <!-- Add Shift Modal    -->
                        <div id="addshift-modal" class="modal fade " role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Add Shift</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input class="my-token" type="hidden" value="<?php echo $this->security->get_csrf_hash();?>" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Shift Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="shift_name" name="shift_name" autocomplete="off" pattern="[A-Za-z]">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Time In <span class="text-danger">*</span></label>
                                                <input class="form-control" type="time" id='time_in' name="time_in" autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Time Out <span class="text-danger">*</span></label>
                                                <input class="form-control" type="time" id="time_out" name="time_out" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Break In</label>
                                                <input class="form-control" type="time" id="break_in"  autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Break Out</label>
                                                <input class="form-control" type="time" id="break_out"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Shift Details</label>
                                                <textarea class="form-control" id="shift_details" name="shift_details" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center err-message hide text-danger">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id='add_shift' name="add_shift"><i class="fa fa-plus"></i> Add Shift</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="updateshift-modal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Update Shift</h4>
                                    </div>
                                    <div class="modal-body">
                                        <input class="my-token" type="hidden" value="<?php echo $this->security->get_csrf_hash();?>" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Shift Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" id="updt_shiftName" name="shift_name" autocomplete="off" pattern="[A-Za-z]">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Time In <span class="text-danger">*</span></label>
                                                <input class="form-control" type="time" id='updt_timeIn' name="time_in" autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Time Out <span class="text-danger">*</span></label>
                                                <input class="form-control" type="time" id="updt_timeOut" name="time_out" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Break In</label>
                                                <input class="form-control" type="time" id="updt_breakIn" name="break_in" autocomplete="off">
                                            </div>
                                            <div class="col-md-6">
                                                <label>Break Out</label>
                                                <input class="form-control" type="time" id="updt_breakOut" name="break_out" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Shift Details</label>
                                                <textarea class="form-control" id="updt_shiftDetails" name="shift_details" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-center err-message hide text-danger">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary updt_shift">Update Shift</button>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div style="margin-bottom: 30px;"></div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
</div>
<!-- /#content -->

<?php echo form_open(base_url() . 'evaluation/employeeEvaluation', array('class' => 'form-horizontal', 'id' => 'frm-evaluation'));?>
    <input type="hidden" id="evaluation-id" name="evaluation-id" value="" />
<?php echo form_close();?>