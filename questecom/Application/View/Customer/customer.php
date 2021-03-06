<div class="section__content section__content--p30">
    <div class="container-fluid">
        <h3 class='title-5 m-b-35'>Customer</h3>
        <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form', 'Customer') ?>').resetParams().load(); " class="btn btn-outline-primary btn-sm">Add customer</a>
       
        <div class="table-responsive table-responsive-data2">
            <div class="row">
                <table class="table table-striped table-data2 ">
                    <thead id="tableHeading">
                        <tr>
                            <th>customer Id</th>
                            <th>group</th>
                            <th>first name</th>
                            <th>last name</th>
                            <th>email</th>
                            <th>mobile number</th>
                            <th>password</th>
                            <th>created date</th>
                            <th>updated date</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            $customers = $this->getCustomers();
                            if (!$this->getCustomers()) {
                                echo "<script>document.getElementById('tableHeading').style.display = 'none';</script>";
                                echo '<strong style="padding-left:20px;padding-top:20px;">No Record Found!</strong>';
                            } else {
                                foreach ($customers->data as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>' . $value->customerId . '</td>';
                                    echo '<td>' . $this->getName($value).'</td>';
                                    echo '<td>' . $value->firstName . '</td>';
                                    echo '<td>' . $value->lastName . '</td>';
                                    echo '<td>' . $value->email . '</td>';
                                    echo '<td>' . $value->mobile . '</td>';
                                    echo '<td>' . $value->password . '</td>';
                                    echo '<td>' . $value->createdDate . '</td>';
                                    echo '<td>' . $value->updatedDate . '</td>';
                                    if ($value->status != 1) {
                            ?>
                                <td><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('select', 'Customer', ['editId' => $value->customerId, 'selectId'=>$value->status]) ?>').resetParams().load(); " title="Active" id="activeBtn" class="btn btn-success btn-sm">Active</a></td>
                                <?php } else { ?>
                                    <td><a onclick = "object.setUrl('<?php echo $this->getUrl()->getUrl('select', 'Customer', ['editId' => $value->customerId, 'selectId'=>$value->status]) ?>').resetParams().load(); " title="In active" id="inactiveBtn" class="btn btn-danger btn-sm">Inactive</a> </td>
                                <?php } ?>

                                <td><a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form', 'Customer', ['editId' => $value->customerId]) ?>').resetParams().load(); " class="btn btn-success btn-sm">Edit</a>&nbsp
                                    <a onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete', 'Customer', ['deleteId' => $value->customerId]) ?>').resetParams().load(); " class="btn btn-danger btn-sm">Delete</a>
                                </td>


                            <?php
                                    echo '</tr>';
                                }
                            }

                            ?>
                    </tbody>
                </table>
            </div>
        </div>