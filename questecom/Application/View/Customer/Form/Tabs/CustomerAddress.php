<?php
$address = $this->getAddress();

?>

<form method="post" action="<?php echo $this->getUrl()->getUrl('saveAddress', 'customer'); ?>">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
            <strong><?php echo $this->getTitle(); ?></strong>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Address id:</label>
                    <input type="text" name="address[addressId]" disabled="disabled" value="<?php  if($address->addressId) {echo $address->addressId;} else {echo 'Auto';} ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Address:</label>
                    <input type="text" name="address[address]" value="<?php echo $address->address; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">City:</label>
                    <input type="text" name="address[city]" value="<?php echo $address->city; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">State:</label>
                    <input type="text" name="address[state]" value="<?php echo $address->state; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Zip Code:</label>
                    <input type="tel" name="address[zipCode]" value="<?php echo $address->zipCode; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Country:</label>
                    <input type="text" name="address[country]" value="<?php echo $address->country; ?>" class="form-control">
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <label class="form-control-label">Address Type:</label>
                    <select name="address[addressType]">
                        <?php foreach ($address->getAddressTypeOptions() as $key => $value) { ?>
                            <option value="<?php echo $key ?>" <?php if ($address->status == $key) { ?> selected <?php } ?>><?php echo $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="card-body card-block">
                <div class="form-group">
                    <button type="submit" name="update" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-plus"></i>&nbsp; Save</button>
                </div>
            </div>
        </div>
    </div>
</form>