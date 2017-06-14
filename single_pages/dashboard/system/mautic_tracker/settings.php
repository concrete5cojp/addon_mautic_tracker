<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<form method="post" action="<?php echo $this->action('save_settings'); ?>">

    <?= $this->controller->token->output('save_settings'); ?>

    <fieldset>
        <div class="form-group">
            <?php echo $form->label('url', t('Mautic URL')) ?>
            <div class="input-group">
                <?= $form->text('url', $url, ['placeholder' => 'http(s)://yourmautic.com']) ?>
                <span class="input-group-addon"><i class="fa fa-asterisk"></i></span>
            </div>
        </div>
    </fieldset>
    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit"><?php echo t('Save') ?></button>
        </div>
    </div>

</form>


