<?php
$customerGroup = $this->getCustomerGroups();

?>

<form method="post" id="customerGroupForm" action="<?php echo $this->getUrl()->getUrl('save', 'customerGroup'); ?>">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
            <strong><?php echo $this->getTitle(); ?></strong>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">customerGroup id:</label>
                    <input type="text" name="customerGroup[groupId]" disabled="disabled" value="<?php  if($customerGroup->groupId) {echo $customerGroup->groupId;} else {echo 'Auto';} ?>" class="form-control">
                </div>
            </div>
            
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Name:</label>
                    <input type="text" name="customerGroup[name]" value="<?php echo $customerGroup->name; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Default [0/1]:</label>
                    <input type="text" name="customerGroup[default]" value="<?php echo $customerGroup->default; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                <button type="button" onclick="object.resetParams().setForm('#customerGroupForm').load();" name="update" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-plus"></i>&nbsp; Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
