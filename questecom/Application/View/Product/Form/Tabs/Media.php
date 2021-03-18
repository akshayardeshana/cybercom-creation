<div class="section__content section__content--p30">
    <div class="container-fluid">

        <?php $media = $this->getMedia(); ?>
        <h3 class='title-5 m-b-35'>Media</h3>



        <!-- <a onclick="object.setUrl('<?php //echo $this->getUrl()->getUrl('form', 'Product') 
                                        ?>').resetParams().load(); " class="btn btn-outline-primary btn-sm">Update</a> -->
        <!-- <button type="button" onclick="<?php //echo $this->getUrl()->getUrl('updateMedia', 'Product');
                                            ?>" class="btn btn-outline-primary btn-sm" id="btn_update">Update</button> -->

        <button type="submit" name="btn_update" class="btn btn-outline-primary btn-sm">Update</button>
        <button type="button" class="btn btn-outline-primary btn-sm" id="btn_delete">Remove</button>


        <div class="table-responsive table-responsive-data2">
            <div class="row">
                <table class="table table-striped table-data2 ">
                    <thead id="tableHeading">
                        <tr>
                            <th>Media Id </th>
                            <th>Image</th>
                            <th>Label</th>
                            <th>Small</th>
                            <th>Thumb</th>
                            <th>Base</th>
                            <th>Gallary</th>
                            <th>remove</th>
                        </tr>
                    </thead>
                    <tbody>

                    <form method="post" action="<?php echo $this->getUrl()->getUrl('updateMedia', 'Product'); ?>">
                            <?php

                            if (!$this->getMedia()) {
                                echo "<script>document.getElementById('tableHeading').style.display = 'none';</script>";
                                echo '<strong style="padding-left:20px;padding-top:20px;">No Record Found!</strong>';
                            } else {

                                foreach ($media->data as $key => $value) {
                                    if ($value->productId == $this->getRequest()->getGet('editId')) {
                                        echo '<tr id="' . $value->mediaId . '">';
                                        echo '<td><label name="media[mediaId]">' . $value->mediaId . '</label></td>';
                                        echo '<td><img src="' . $value->image . '"></img></td>';

                                        /*LABEL */
                                        echo '<td><input type="text" style="background-color:#c0c0c0; height:40px; padding-left:10px" name="label[label]" value =' . $value->label . '></td>';


                                        /*SMALL */
                                        if ($value->small != 1) { ?>
                                            <td><input type="radio" name="small"></td>
                                        <?php  } else { ?>
                                            <td><input type="radio" name="small" checked></td>
                                        <?php }

                                        /*THUMB */
                                        if ($value->thumb != 1) { ?>
                                            <td><input type="radio" name="thumb"></td>
                                        <?php  } else { ?>
                                            <td><input type="radio" name="thumb" checked></td>
                                        <?php }


                                        /*BASE */
                                        if ($value->base != 1) { ?>
                                            <td><input type="radio" name="base"></td>
                                        <?php  } else { ?>
                                            <td><input type="radio" name="base" checked></td>
                                        <?php }


                                        /*GALLARY */
                                        if ($value->gallary != 1) { ?>
                                            <td><input type="checkbox" name="gallary"></td>
                                        <?php  } else { ?>
                                            <td><input type="checkbox" name="gallary" checked></td>
                                        <?php }
                                        ?>

                                        <!-- REMOVE -->
                                        <td><input type='checkbox' name="remove" value="<?php echo $value->mediaId ?>"></td>

                            <?php }
                                }
                                echo '</tr>';
                                // }
                            }
                            ?>
                        </form>
                    </tbody>
                </table>

            </div>
        </div>

        <form method="post" action="<?php echo $this->getUrl()->getUrl('addMedia', 'Product'); ?>" enctype="multipart/form-data">

            <input type="file" name="image" required>

            <button type="submit" name="update" class="btn btn-primary">Upload</button>

        </form>



        <script>
            $(document).ready(function() {

                $('#btn_delete').click(function() {

                    if (confirm("Are you sure you want to delete this?")) {
                        var id = [];

                        $(':checkbox:checked').each(function(i) {
                            id[i] = $(this).val();
                        });

                        if (id.length === 0) //tell you if the array is empty
                        {
                            alert("Please Select atleast one checkbox");
                        } else {
                            $.ajax({
                                url: 'delete.php',
                                method: 'POST',
                                data: {
                                    id: id
                                },
                                success: function() {
                                    for (var i = 0; i < id.length; i++) {
                                        $('tr#' + id[i] + '').css('background-color', '#ccc');
                                        $('tr#' + id[i] + '').fadeOut('slow');
                                    }
                                }
                            });
                        }

                    } else {
                        return false;
                    }
                });

            });
        </script>