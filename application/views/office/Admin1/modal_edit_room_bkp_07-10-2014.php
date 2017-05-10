<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('admin/dormitory/do_room_update/'.$row['room_id'] , array('class' => 'form-horizontal validatable','target'=>'_top'));?>
            <div class="padded">
                <div class="control-group">
                                <label class="control-label"><?php echo get_phrase('dormitory_name');?></label>
                                <div class="controls">
                                    <select name="dormitory_id" class="uniform" style="width:100%;">
                                        <?php 
                                        $dormitories = $this->db->get('dormitory')->result_array();

                                            foreach ($dormitories as $row2):
                                        ?>
                                            <option value="<?php echo $row2['dormitory_id'];?>"
                                                <?php if($row['dormitory_id'] == $row2['dormitory_id'])echo 'selected';?>>
                                                    <?php echo $row2['name'];?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('room_name');?></label>
                    <div class="controls">
                        <input type="text" class="" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('description');?></label>
                    <div class="controls">
                        <input type="text" class="" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_room');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>