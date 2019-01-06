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
                        <div class="current-shift">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Current Shift</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Shift Code:</label><br>
                                        <?php foreach($shift_data as $shift_datum):?>
                                    <input type="text" class="form-control" name="curr-shift-code" id="curr-shift-code" disabled="true" value="<?php echo $shift_datum['shift_code'];?>">
                                        
                                </div>
                                <div class="col-md-3">
                                    <label>Time In:</label><br>
                                    <input type="text" class="form-control" name="curr-time-in" id="curr-time-in" disabled="true" value="<?php echo $shift_datum['time_in'];?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Break In:</label><br>
                                    <input type="text" class="form-control" name="curr-break-in" id="curr-break-in" disabled="true" value="<?php echo $shift_datum['break_in'];?>">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Shift Details</label><br>
                                    <textarea class="form-control" name="curr-shift-details" id="curr-shift-details" disabled="true" value="">
                                        <?php echo $shift_datum['shift_details'];?>
                                    </textarea>
                                </div>
                                <div class="col-md-3">
                                    <label>Time Out:</label><br>
                                    <input type="text" class="form-control" name="curr-time-out" id="curr-time-out" disabled="true" value="<?php echo $shift_datum['time_out'];?>">
                                </div>
                                <div class="col-md-3">
                                    <label>Break Out:</label><br>
                                    <input type="text" class="form-control" name="curr-break-out" id="curr-break-out" disabled="true" value="<?php echo $shift_datum['break_out'];?>">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <?=form_open(base_url('settings/changeShift'));?>
                        <div class="divide"></div>
                        <div class="change-shift">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Change Shift</label>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Shift Code:</label><br>
                                    <select class="form-control" name="chg-shift-code" id="chg-shift-code" disabled="">
                                        <option value="">Select Shift</option>
                                        <option value="1">Morning</option>
                                        <option value="2">Swing</option>
                                        <option value="3">Night</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Time In:</label><br>
                                    <input type="time" class="form-control" name="chg-time-in" id="chg-time-in" disabled="">
                                </div>
                                <div class="col-md-3">
                                    <label>Break In:(Optional)</label><br>
                                    <input type="time" class="form-control" name="chg-break-in" id="chg-break-in" disabled="">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Details:</label><br>
                                    <textarea class="form-control" name="chg-shift-details" id="chg-shift-details" disabled="" placeholder="Minimum of 20 characters"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label>Time Out:</label><br>
                                    <input type="time" class="form-control" name="chg-time-out" id="chg-time-out" disabled="">
                                </div>
                                <div class="col-md-3">
                                    <label>Break Out:(Optional)</label><br>
                                    <input type="time" class="form-control" name="chg-break-out" id="chg-break-out" disabled="">
                                </div>
                                <div class="col-md-3 btn-div">
                                    <br>
                                    <button type="button" class="btn btn-primary" id="btn-change" name="btn-change">Change</button>
                                    <button type="button" class="btn btn-primary hideBtn" id="btn-apply" name="btn-apply">Apply</button>
                                </div>
                            </div>
                        </div>
                        <?=form_close();?>
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