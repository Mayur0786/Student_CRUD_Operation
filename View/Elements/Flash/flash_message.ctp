<?php
$class = 'alert alert-dismissible fade show ';

if (isset($params['class'])) {
    if (strpos($params['class'], 'success') !== false) {
        $class .= 'alert-success';
    } elseif (strpos($params['class'], 'error') !== false || strpos($params['class'], 'danger') !== false) {
        $class .= 'alert-danger';
    } elseif (strpos($params['class'], 'warning') !== false) {
        $class .= 'alert-warning';
    } else {
        $class .= 'alert-info';
    }
} else {
    $class .= 'alert-info';
}
?>

<div class="<?php echo $class; ?>" role="alert">
    <?php echo h($message); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
