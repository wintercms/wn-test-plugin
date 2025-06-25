<div data-control="toolbar">
    <a href="<?= Backend::url('winter/test/countries/create') ?>" class="btn btn-primary oc-icon-plus">New Country</a>

    <button data-request="onRedirect" class="btn btn-primary" data-attach-loading>Other Page Redirect</button>
    <button data-request="onRedirectCurrentHashed" class="btn btn-primary" data-attach-loading>Current Page Redirect</button>
    <button data-request="onRedirectDownload" class="btn btn-primary" data-attach-loading>File Download Redirect</button>
    <script>
        $(document).on('ajaxSetup', function (event, context) {
            if (context.handler === 'onRedirectDownload') {
                context.options.handleRedirectResponse = function (url) {
                    window.location.assign(url);
                    $(event.target).trigger('ajaxRedirected');
                }
            }
        });
    </script>
</div>
