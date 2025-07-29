<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
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
<body class="bg-light" >
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Student Admin</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><?php echo $this->Html->link('Students', ['controller' => 'students', 'action' => 'index'], ['class' => 'nav-link', /*'target' => '_blank'*/]); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Add Student', ['controller' => 'students', 'action' => 'add'], ['class' => 'nav-link', /*'target' => '_blank'*/]); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Branches', ['controller' => 'branches', 'action' => 'index'], ['class' => 'nav-link', /*'target' => '_blank'*/]); ?></li>
                <li class="nav-item"><?php echo $this->Html->link('Years', ['controller' => 'years', 'action' => 'index'], ['class' => 'nav-link', /*'target' => '_blank'*/]); ?></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container animate__animated animate__fadeIn">
    <!--php echo $this->Session->flash(); ?>
    <--php echo $content_for_layout; ?>
    <-- ✅ Flash messages using Session -->
    <!--php echo $this->Session->flash('flash', ['element' => 'default']); ?-->
    <!--php echo $this->Session->flash('auth'); ?-->

    <!-- ✅ Flash messages using FlashComponent -->
    <!--?php echo $this->Flash->render(); ?-->

    <div class="container mt-3">
    <?php echo $this->Flash->render('default', ['elements' => 'flash_message']); ?>
    <?php echo $this->Flash->render('flash', ['elements' => 'flash_message']); ?>
    <?php echo $this->Flash->render('auth', ['elements' => 'flash_message']); ?>

    <?php echo $content_for_layout; ?>
</div>



<footer class="text-center text-muted mt-5 mb-3">
    <small>&copy; <?php echo date('Y'); ?> Mayur's Project - CakePHP 2.x + Bootstrap</small>
</footer>

<div id="footer">
    <?php echo $this->Html->link(
        $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
        'https://cakephp.org/',
        array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
    ); ?>
    <p><?php echo $cakeVersion; ?></p>
</div>

<?php echo $this->element('sql_dump'); ?>
<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000); // Auto-close in 5 sec
</script>

</body>
</html>
