<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer">
        <div class="bg-light lter">

            <div id="user-profile-2" class="user-profile page-container">
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18 dashboard-navtab">
                        <li class="active">
                            <a data-toggle="tab" href="#ongoing" style="border-left: 1px;">
                                <i class="blue ace-icon fas fa-thumbtack bigger-120"></i>
                                Re-shift
                            </a>
                        </li>
                    </ul>
                    <div class="container">
                        <div id="modal_addShift" class="modal fade" aria-hidden="true" style="display:none;">
                            <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                <div class="add_shift">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Shift Name:</label><br>
                                            <input class="form-control"type="text" id="shift_name" name="shift_name" autocomplete="off" pattern="[A-Za-z]">
                                            <p id="sn-warning"></p>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Time In:</label><br>
                                            <input type="time" class="form-control" id='time_in' name="time_in" autocomplete="off">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Time Out:</label><br>
                                            <input class="form-control"type="time" id="time_out" name="time_out" autocomplete="off">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Shift Details:</label><br>
                                            <textarea class="form-control" id="shift_details" name="shift_details" autocomplete="off"></textarea>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Break In:(Optional)</label><br>
                                            <input class="form-control"type="time" id="break_in" name="break_in" autocomplete="off">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Break Out:(Optional)</label><br>
                                            <input class="form-control" type="time" id="break_out" name="break_out" autocomplete="off">
                                        </div>
                                    </div>
                                    
                                </div><!-- End of div.add_shift -->
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id='add_shift' name="add_shift" class="btn btn-primary" ><i class="fa fa-plus"></i> Add</button>
                            </div>
                            </div>
                            </div>
                        </div>
                        <div id="updt_modal" class="modal fade" aria-hidden="true" style="display: none;"> <!-- Start of updt_modal -->
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">Update Shift</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="update_shift">
                                            <?=form_open(base_url('settings/updateShift'));?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Shift Name:</label><br>
                                                    <input type="text" id="updt_shiftName" name="updt_shiftName" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Time In:</label><br>
                                                    <input type="text" id="updt_timeIn" name="updt_timeIn" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Time Out:</label>
                                                    <input type="text" id="updt_timeOut" name="updt_timeOut" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Shift Details:</label><br>
                                                    <textarea id="updt_shiftDetails" name="updt_shiftDetails" class="form-control"></textarea>
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Break In:</label><br>
                                                    <input type="text" id="updt_breakIn" name="updt_breakIn" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Break Out:</label><br>
                                                    <input type="text" id="updt_breakOut" name="updt_breakOut" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button type="submit" id="updt_shift" name="updt_shift" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End of updt_modal -->
                        <div class="available-shifts"><!-- Start of div.add-shifts -->
                            <div class="row add_shiftContainer">
                                <div class="col-md-3">
                                    <a data-toggle="modal" data-original-title="" data-placement="" class="btn btn-primary btn-sm" href="#modal_addShift">
                                         <i class="fa fa-plus"></i> New Shift
                                    </a>
                                </div>
                            </div>
                            <table class="table table-striped table-bordered" id="table-shifts">
                                <thead class="thead-light">
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
                                        <td><?php echo date("h:i:s a",strtotime($shift["shift_details"]));?></td>
                                        <td><?php echo date("h:i:s a",strtotime($shift["time_in"]));?></td>
                                        <td><?php echo date("h:i:s a",strtotime($shift["time_out"]));?></td>
                                        <td><?php echo date("h:i:s a",strtotime($shift["break_in"]));?></td>
                                        <td><?php echo date("h:i:s a",strtotime($shift["break_out"]));?></td>
                                        <td>Action</td>
                                    </tr>
                                        <?php endforeach;?>
                                        <?php else:?>
                                     <tr>
                                         <td colspan="7" class="text-center">No data available</td>
                                     </tr>       
                                    <?php endif;?>
                                </tbody>
                             </table>
                         </div>
                    </div>
                </div>
            </div>
        </div><!-- /.inner -->
    </div><!-- /.outer -->
</div><!-- /#content -->

<!--  <?php echo form_open(base_url() . 'evaluation/employeeEvaluation', array('class' => 'form-horizontal', 'id' => 'frm-evaluation'));?>
    <input type="hidden" id="evaluation-id" name="evaluation-id" value="" />
<?php echo form_close();?> -->