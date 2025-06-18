        <?php if ($formModel->product): ?>
            <div class="scoreboard">
                <div data-control="toolbar">
                    <div class="scoreboard-item title-value">
                        <h4>Product</h4>
                        <p><?= $formModel->product->name ?></p>
                        <p class="description">type: <?= class_basename($formModel->product) ?></p>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="callout fade in callout-warning no-icon no-subheader">
                <div class="header">
                    <h3>Orphan detected</h3>
                </div>
                <div class="content">
                    <p>This review is an orphan</p>
                </div>
            </div>
        <?php endif ?>
