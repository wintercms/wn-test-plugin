<?php if (!$this->fatalError): ?>

    <div class="layout fancy-layout">
        <?= Form::open([
            'class' => 'layout',
            'data-change-monitor' => 'true',
            'data-window-close-confirm' => e(trans('winter.test::lang.general.unsaved_changes')),
        ]) ?>

            <?= $this->formRender() ?>

        <?= Form::close() ?>
    </div>

<?php else: ?>

    <div class="control-breadcrumb">
        <?= Block::placeholder('breadcrumb') ?>
    </div>
    <div class="padded-container">
        <p class="flash-message static error"><?= e(trans($this->fatalError)) ?></p>
        <p><a href="<?= Backend::url('winter/test/records') ?>" class="btn btn-default"><?= e(trans('backend::lang.form.return_to_list')) ?></a></p>
    </div>

<?php endif ?>
