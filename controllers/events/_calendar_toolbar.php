<div data-control="toolbar">
    <a
        href="<?= Backend::url('winter/test/events/create') ?>"
        class="btn btn-primary wn-icon-plus">
        New event
    </a>

    <a
        href="<?= Backend::url('winter/test/events') ?>"
        class="btn btn-default wn-icon-list">
        View events list
    </a>

    <button
        class="btn btn-warning wn-icon-database"
        data-request="onSeed"
        data-request-confirm="Are you sure you want to seed events?"
        data-stripe-load-indicator>
        Seed events
    </button>
</div>
