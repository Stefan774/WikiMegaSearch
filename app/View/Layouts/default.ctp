<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('WikiMegaSearch', 'WikiMegaSerach: Query multiple Wiki sites');
?>
<!DOCTYPE html>
<html>
<head>
    
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
                echo $this->Html->css('bootstrap');
                echo $this->Html->css('jquery-ui-1.9.2.custom');          
                               
                echo $this->Html->script('jquery'); // Include jQuery library
                echo $this->Html->script('jquery-ui-1.9.2.custom.min'); // Include jQuery UI-library    
                echo $this->Html->script('bootstrap'); // Include Bootstrap js for affix Navi
        
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div class="navbar navbar-fixed-top" data-spy="affix" data-offset-top="0">
        <div class="navbar-inner">

            <?php 
                echo $this->Html->link('WikiMegaSearch',array('controller'=>'Searches','action'=>'index'),array('class'=>'brand')); 
                echo $this->Form->create('Search', array('type' => 'get','action' => 'searchWikis', 'class'=>'navbar-form pull-left','div'=>false,'label' => false));
                echo $this->Form->input('searchToken', array('type' => 'text','label'=>'','class'=>'search-query', 'placeholder'=>'Search','div'=>false,'label' => false));
                echo $this->Form->end();
            ?>
        </div>
    </div>
	<div id="container">
		<div id="header">
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
