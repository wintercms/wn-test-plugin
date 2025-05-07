<?php Block::put('breadcrumb') ?>
    <ul>
        <li><a href="<?= Backend::url('winter/test/people') ?>">People</a></li>
        <li><?= e(trans($this->pageTitle)) ?></li>
    </ul>
<?php Block::endPut() ?>

<?php if (!$this->fatalError): ?>

    <?= $this->makePartial('form_toggle') ?>

    <div class="layout-item stretch layout-column form-preview">
        <?= $this->formRenderPreview() ?>
    </div>

<?php else: ?>

    <p class="flash-message static error"><?= e(trans($this->fatalError)) ?></p>
    <p><a href="<?= Backend::url('winter/test/people') ?>" class="btn btn-default">Return to people list</a></p>

<?php endif ?>
