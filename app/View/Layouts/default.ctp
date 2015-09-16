<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        
        <title>API StackOverflow</title>
	<?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('cake.generic');
            echo $scripts_for_layout;
	?>
    </head>
    <body>
        <div id="container">
            <div id="content">
                <?php
                    echo $this->Session->flash(); 
                    echo $content_for_layout; 
                ?>
            </div>
        </div>
	<?php 
            echo $this->element('sql_dump'); 
        ?>
    </body>
</html>