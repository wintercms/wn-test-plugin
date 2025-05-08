<h3>
    <?php
    switch ($model->rating) {
        case 0:
            echo "☆☆☆☆☆";
            break;
        case 1:
            echo "★☆☆☆☆";
            break;
        case 2:
            echo "★★☆☆☆";
            break;
        case 3:
            echo "★★★☆☆";
            break;
        case 4:
            echo "★★★★☆";
            break;
        case 5:
            echo "★★★★★";
            break;
    }
    ?>
</h3>
