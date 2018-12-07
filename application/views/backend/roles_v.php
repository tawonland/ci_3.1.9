<?php
  foreach ($a_form as $key => $v) {

    $field        = $v['field'];
    $id           = isset($v['id']) ? $v['id'] : $field;
    $class        = isset($v['class']) ? $v['class'] : '';
    $placeholder  = isset($v['placeholder']) ? $v['placeholder'] : '';

    //param formx
    $data         = ['id' => $id, 'name' => $field, 'class' => $class, 'placeholder' => $placeholder];
    $value        = isset($row[$field]) ? $row[$field] : '';
    $extra        = isset($v['extra']) ? $v['extra'] : '';
    $checked      = isset($v['checked']) ? $v['checked'] : FALSE;
    ?>

    <div class="form-group">
      <label for="<?php echo $field; ?>" class="col-sm-2 control-label"><?php echo $v['label']; ?></label>

      <div class="col-sm-10">
      <?php 

      if($v['type'] == 'text'){
        echo formx_input($data, $value, $c_edit, $extra);
      }
      else
      if($v['type'] == 'checkbox'){
        echo formx_checkbox($data, $value, $checked, $c_edit, $extra);
      }
      
      echo form_error($field); ?>
      </div>
    </div>

    <?
  }
?>