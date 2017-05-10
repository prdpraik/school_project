<?php
$students	=	$this->crud_model->get_dormitory_students($dormitory_id);
//echo "<pre>";print_r($students);exit;
?>
    <center>
        <?php if($students) { ?>
        <table class="table table-normal dormitory-list">
            <thead>
                <tr>
                    <th><div><?php echo get_phrase('hostel_number');?></div></th>
                    <th><div><?php echo get_phrase('student_name');?></div></th>
                    <th><div><?php echo get_phrase('class');?></div></th>
                    <th><div><?php echo get_phrase('room_name');?></div></th>
                    <th><div><?php echo get_phrase('hostel_fees');?></div></th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($students as $row): ?>
                <?php $class = $this->crud_model->get_class_name($row['class_id']);?>
                <?php $room = $this->crud_model->get_room_name($row['dormitory_room_number']);?>
                    <tr>
                        <td><?php echo $row['hostel_number']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $class; ?></td>
                        <td><?php echo $room; ?></td>
                        <td><?php echo $row['hostel_fees']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            
        </table>
        <?php } ?>
    </div>
	</center>