<?php
    $isPreview = $this->formGetContext() === 'preview';
    $isCreate = $this->formGetContext() === 'create';
    $pageUrl = isset($pageUrl) ? $pageUrl : null;
    $indexUrl = Backend::url('winter/test/records');
?>
<div class="form-buttons loading-indicator-container">
    <?php if ($isPreview) : ?>
        <span class="btn-text">
            <a href="<?= $indexUrl ?>"><?= e(trans('backend::lang.form.cancel')); ?></a>
        </span>
    <?php else : ?>
        <!-- Save -->
        <a
            href="javascript:;"
            class="btn btn-primary oc-icon-check save"
            data-request="onSave"
            data-load-indicator="<?= e(trans('backend::lang.form.saving')) ?>"
            data-request-before-update="$el.trigger('unchange.oc.changeMonitor')"
            <?php if (!$isCreate) : ?>
                data-request-data="redirect:0"
            <?php endif ?>
            data-hotkey="ctrl+s, cmd+s">
                <?= e(trans('backend::lang.form.save')) ?>
        </a>

        <?php if (!$isCreate) : ?>
            <!-- Save and Close -->
            <a
                href="javascript:;"
                class="btn btn-primary oc-icon-check save"
                data-request-before-update="$el.trigger('unchange.oc.changeMonitor')"
                data-request="onSave"
                data-load-indicator="<?= e(trans('backend::lang.form.saving')) ?>">
                    <?= e(trans('backend::lang.form.save_and_close')) ?>
            </a>
        <?php endif ?>

        <span class="btn-text">
            or <a href="<?= $indexUrl ?>"><?= e(trans('backend::lang.form.cancel')); ?></a>
        </span>

        <!-- Preview -->
        <a
            href="<?= URL::to($pageUrl) ?>"
            target="_blank"
            class="btn btn-primary oc-icon-crosshairs
            <?php if (!false) : ?>
                hide
            <?php endif ?>"
            data-control="preview-button">
                <?= e(trans('backend::lang.form.preview_title')) ?>
        </a>

        <?php if (!$isCreate) : ?>
            <!-- Delete -->
            <button
                type="button"
                class="btn btn-default empty oc-icon-trash-o"
                data-request="onDelete"
                data-request-confirm="<?= e(trans('ca::lang.actions.delete_confirm')) ?>"
                data-control="delete-button"></button>
        <?php endif ?>
    <?php endif; ?>
</div>
