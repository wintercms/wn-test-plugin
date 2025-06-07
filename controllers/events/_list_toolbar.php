<div data-control="toolbar">
    <a
        href="<?= Backend::url('winter/test/events/create') ?>"
        class="btn btn-primary wn-icon-plus">
        New event
    </a>

    <a
        href="<?= Backend::url('winter/test/events/calendar') ?>"
        class="btn btn-default wn-icon-calendar">
        View events calendar
    </a>

    <button
        class="btn btn-warning wn-icon-database"
        data-request="onSeed"
        data-request-confirm="Are you sure you want to seed events?"
        data-stripe-load-indicator>
        Seed events
    </button>

    <button
        class="btn btn-danger wn-icon-trash-o"
        disabled="disabled"
        onclick="$(this).data('request-data', { checked: $('.control-list').listWidget('getChecked') })"
        data-request="onDelete"
        data-request-confirm="<?= e(trans('backend::lang.list.delete_selected_confirm')); ?>"
        data-trigger-action="enable"
        data-trigger=".control-list input[type=checkbox]"
        data-trigger-condition="checked"
        data-request-success="$(this).prop('disabled', 'disabled')"
        data-stripe-load-indicator>
        <?= e(trans('backend::lang.list.delete_selected')); ?>
    </button>
</div>
