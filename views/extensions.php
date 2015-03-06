<div class="fpbx-container">
  <form class="popover-form fpbx-submit" name="frm_extensions" action="config.php?display=extensions<?php echo isset($_REQUEST['extdisplay']) && trim($_REQUEST['extdisplay']) != '' ? '&amp;extdisplay='.$_REQUEST['extdisplay'] : '' ?>" method="post" data-fpbx-delete="config.php?display=extensions&amp;extdisplay=<?php echo $_REQUEST['extdisplay'] ?>&amp;action=del" role="form">
    <?php foreach ( $html['top'] as $elem ) {
      echo $elem['html'];
    } ?>
    <?php foreach ( $html['bottom'] as $elem ) {
      echo $elem['html'];
    } ?>
    <div role="tabpanel">
      <ul class="nav nav-tabs" role="tablist">
        <?php foreach(array_keys($html['middle']) as $category) { ?>
          <li data-name="<?php echo strtolower($category)?>" class="change-tab <?php echo ($active == strtolower($category)) ? 'active' : ''?>"><a href="#<?php echo strtolower($category)?>" aria-controls="<?php echo strtolower($category)?>" role="tab" data-toggle="tab"><?php echo $tabtranslations[$category]?></a></li>
        <?php } ?>
      </ul>
      <div class="tab-content display">
        <?php foreach($html['middle'] as $category => $sections) { ?>
          <div id="<?php echo strtolower($category)?>" role="tabpanel" class="tab-pane <?php echo ($active == strtolower($category)) ? 'active' : ''?>">
            <div class="container-fluid">
              <?php foreach($sections as $section => $elements) { ?>
                <div class="section-title" data-for="<?php echo strtolower($section)?>"><h3><i class="fa fa-minus"></i> <?php echo $section?></h3></div>
                <div class="section" data-id="<?php echo strtolower($section)?>">
                  <?php foreach($elements as $elem) { ?>
                    <div class="element-container">
                      <?php if(!empty($elem['prompttext'])) {?>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="form-group">
                                <div class="col-md-4 control-label">
                                  <label for="<?php echo $elem['name']?>"><?php echo $elem['prompttext']?></label>
                                  <?php if(!empty($elem['helptext'])) { ?>
                                    <i class="fa fa-question-circle fpbx-help-icon" data-for="<?php echo $elem['name']?>"></i>
                                  <?php } ?>
                                </div>
                                <div class="col-md-8"><?php echo $elem['html']?></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php if(!empty($elem['helptext'])) { ?>
                          <div class="row">
                            <div class="col-md-12">
                              <span id="<?php echo $elem['name']?>-help" class="help-block fpbx-help-block"><?php echo $elem['helptext']?></span>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } else { ?>
                        <div class="row">
                          <div class="col-md-12"><?php echo $elem['html']?></div>
                        </div>
                      <?php } ?>
                    </div>
                  <?php } ?>
                </div>
                <br/>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <?php foreach($hiddens as $hidden) {?>
      <?php echo $hidden['html'];?>
    <?php } ?>
  </form>
</div>
<script>
  var theForm = document.frm_extensions;
  <?php
    $formname = "frm_extensions";
    $htmlout = '';
    foreach($jsfuncs as $function => $scripts) {
      switch($function) {
        case 'onsubmit()':
          $htmlout .= "function ".$formname."_onsubmit(theForm) {\n";
          foreach($scripts as $data) {
            $htmlout .= $data;
          }
          $htmlout .= "\treturn true;}\n";
        break;
        default:
          $htmlout .= "function ".$formname."_$function {\n";
          foreach($scripts as $data) {
            $htmlout .= $data;
          }
          $htmlout .= "}\n";
        break;
      }
    }
    echo $htmlout;
  ?>
  $("form").submit(function() {
    return frm_extensions_onsubmit(this);
  });
</script>
