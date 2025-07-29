<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>

    <!-- Bootstrap 5 and Animate.css -->
    <?php
        echo $this->Html->css([
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
            'style' // your custom CSS in webroot/css/style.css
        ]);

        echo $this->Html->script([
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
        ]);
    ?>

    <?php echo $this->Html->meta('icon'); ?>
    <?php echo $scripts_for_layout; ?>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Student Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><?php echo $this->Html->link('Students', ['controller' => 'students', 'action' => 'index'], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Add Student', ['controller' => 'students', 'action' => 'add'], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Branches', ['controller' => 'branches', 'action' => 'index'], ['class' => 'nav-link']); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Years', ['controller' => 'years', 'action' => 'index'], ['class' => 'nav-link']); ?></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container animate__animated animate__fadeIn">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout; ?>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>&copy; <?php echo date('Y'); ?> Triveni's Project - CakePHP 2.x + Bootstrap</small>
</footer>

</body>
</html>
