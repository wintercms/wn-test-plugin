<?php
    $uriPrefix = $formModel->exists
        ? 'winter/test/posts/update/'.$formModel->id
        : 'winter/test/posts/create';
?>
<div class="callout callout-warning no-subheader">
    <div class="header">
        <i class="icon-database"></i>
        <h3>Alternate views</h3>
    </div>
    <div class="content">
        <ul>
            <li><a href="<?= Backend::url($uriPrefix.'/relation') ?>">Relation Field</a></li>
            <li><a href="<?= Backend::url($uriPrefix.'/relationcontroller') ?>">Relation Controller</a></li>
            <li><a href="<?= Backend::url($uriPrefix.'/recordfinder') ?>">Record Finder</a></li>
        </ul>
    </div>
</div>
