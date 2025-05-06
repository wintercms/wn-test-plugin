<div data-control="toolbar">
    <a href="<?= Backend::url('winter/test/people/create') ?>" class="btn btn-primary oc-icon-plus">New Person</a>
    <a href="<?= Backend::url('winter/test/phones') ?>" class="btn btn-default oc-icon-phone">Manage Phones</a>

    <a href="javascript;:"
       data-control="popup"
       data-handler="onModelShowAddDatabaseColumnsPopup"
       data-stripe-load-indicator
       class="btn btn-default oc-icon-table">
        Show DataTable
    </a>

    <a href="javascript;:"
       data-request="onSendTestEmail"
       data-stripe-load-indicator
       class="btn btn-default oc-icon-check">
        Send Test Email
    </a>
</div>
