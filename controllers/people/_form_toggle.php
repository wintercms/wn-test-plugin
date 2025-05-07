<?php
    $uriPrefix = ($formContext === 'create')
        ? 'winter/test/people/create'
        : 'winter/test/people/' . $formContext . '/' . $formModel->id;
?>
<div class="callout callout-warning no-subheader">
    <div class="header">
        <i class="icon-database"></i>
        <h3>Alternate views</h3>
    </div>
    <div class="content">
        <ul>
            <?php if ($formContext === 'preview'): ?>
                <li><a href="<?= Backend::url('winter/test/people/update/' . $formModel->id) ?>">Update Context</a></li>
            <?php elseif ($formContext === 'update'): ?>
                <li><a href="<?= Backend::url('winter/test/people/preview/' . $formModel->id) ?>">Preview Context</a></li>
            <?php endif ?>
            <li><a href="<?= Backend::url($uriPrefix.'/recordfinder') ?>">Record Finder</a></li>
            <li><a href="<?= Backend::url($uriPrefix.'/relationcontroller') ?>">Relation Controller</a></li>
            <li><a href="<?= Backend::url($uriPrefix.'/proxyfields') ?>">Proxy Fields</a></li>
        </ul>
    </div>
</div>
