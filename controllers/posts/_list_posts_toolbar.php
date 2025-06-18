<div data-control="toolbar">
    <a href="<?= Backend::url('winter/test/posts/create') ?>" class="btn btn-primary oc-icon-plus">New Post</a>
    <button 
        class="btn btn-default oc-icon-refresh"
        disabled="disabled"
        data-request="onPurgeDeleted"
        data-request-confirm="Purge Deleted Posts?"
        data-trigger-action="enable"
        data-trigger=".control-filter input#postsFilter-scope-show_deleted[type=checkbox]"
        data-trigger-condition="checked"
        data-hotkey="ctrl+delete, cmd+delete"
        data-stripe-load-indicator>
        Purge Deleted Posts
    </button>
</div>
