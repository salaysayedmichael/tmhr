<div id="content">
    <input type="hidden" class="base-url" value="<?php echo base_url();?>"/>

    <div class="outer content-outer">
        <div class="inner bg-light lter">

            <div class="row">

                <div class="col-lg-12">
                    <div class="box">
                        

                        <header>
                            <div class="col-md-7">
                                <div class="icons icon-evaluation">
                                    <i class="fa fa-th"></i>
                                </div>
                                <h5>Evaluation Settings</h5>
                            </div>
                        </header>

                        <div class="row margin-top-30">
                            <div class="col-md-12">
                                <form class="form-vertical">
                                    <div class="col-md-6">
                                        <label>Department Heads</label> <span>(Select one)</span>
                                        <select size="10" class="form-control" id="sel-emp-head" data-csrf-token="<?php echo $this->security->get_csrf_hash();?>">
                                            <?php if(!empty($emp_heads)) :?>
                                                <?php foreach($emp_heads as $emp_head) :?>
                                            <option value="<?php echo $emp_head['employee_id'];?>"><?php echo ucwords($emp_head['last_name'] . ", " . $emp_head['first_name']);?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Employees</label> <span>("ctrl" key + click for multiple select)</span>
                                        <select size="10" class="form-control" multiple="multiple" id="sel-employees" disabled>
                                            <?php if(!empty($employees)) :?>
                                                <?php foreach($employees as $employee_id => $employee_name) :?>
                                                    <option value="<?php echo $employee_id?>"><?php echo ucwords($employee_name)?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 margin-15">
                                            <button type="button" class="btn btn-primary width-150 btn-save-dep-tree pull-right"> Save </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>