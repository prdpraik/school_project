<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open('teacher/assignments/do_update/'.$row['assignment_id'] , array('class' => 'form-horizontal validatable','target'=>'_top','enctype'=>'multipart/form-data'));?>
            <div class="padded">
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('title');?></label>
                    <div class="controls">
                        <input type="text" class="validate[required]" name="assignment_title" value="<?php echo $row['assignment_title'];?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('assignment');?></label>
                    <div class="controls">
                        <div class="box closable-chat-box">
                            <div class="box-content padded">
                                    <div class="chat-message-box">
                                    <textarea name="assignment" id="ttt" rows="5" placeholder="<?php echo get_phrase('add_assignment');?>"><?php echo $row['assignment'];?></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label"><?php echo get_phrase('date');?></label>
                    <div class="controls">
                        <input type="text" class="datepicker fill-up" name="create_timestamp" value="<?php echo date('m/d/Y',$row['create_timestamp']);?>"/>
                    </div>
                </div>
				
				<div class="control-group">
                                <label class="control-label"><?php echo get_phrase('Upload File');?></label>
                                <div class="controls" style="width:210px;">
                                    <input type="file" class="" name="assignmentfile" id="assignmentfile" />
                                </div>
                </div>
				<div class="control-group">
                                <div class="controls" style="width:210px;">
                                    <?php echo $row['assignment_attachment']; ?>
                                </div>
                </div>
				

            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-gray"><?php echo get_phrase('edit_assignment');?></button>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>