<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
 
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="../../../../bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../../../../bootstrap/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" type="text/css" href="../../../../css/basic.css" />
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">

<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap-responsive.css"
    rel="stylesheet">

<link href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap.css"
    rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script  src="code.jquery.com/jquery-latest.js"> </script>
<script src="../../../../bootstrap/js/bootstrap-transition.js"></script>
<script src="../../../../bootstrap/js/bootstrap-modal.js"></script>
<?php echo Yii::app()->request->baseUrl; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../../../../bootstrap/js/bootstrap.min.js"> </script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<script>function start(){
    alert();
}</script>
<script src="../../../../bootstrap/js/bootstrap-transition.js"></script>
<script src="../../../../bootstrap/js/bootstrap-modal.js"></script>
<?php echo Yii::app()->request->baseUrl; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../../../../bootstrap/js/bootstrap.min.js"> </script>




	<div id="header">
		<div id="logo"><?php echo CHtml::link(CHtml::encode(Yii::app()->name), array('site/index')) ; ?></div>
	</div><!-- header -->

	<div id="mainmenu">
    <div id="logo_home"><?php echo CHtml::link(CHtml::image('/images/other/home.png', 'Главная страница'), array('site/index')); ?></div>
	   <div id="b_menu">
    	<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Домашняя страница', 'url'=>array('/site/index')),
				array('label'=>'Профиль', 'url'=>array('users/view', 'id' => Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Админка', 'url'=>array('admin/'), 'visible'=>Yii::app()->user->checkAccess('admin')),
				//array('label'=>'О нас', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Контакты', 'url'=>array('/site/contact')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Выход  ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Регистрация', 'url'=>array('/users/register'), 'visible'=>Yii::app()->user->isGuest)
			),
		)); ?>
        </div>
	</div><!-- mainmenu -->

    	<div id="site_menu">
        <div class='navbar'>
        <nav class='navbar-inner'>
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>Themes::getThemes(),
            
            'htmlOptions' => array('class' => 'nav')
           
		)); ?>
        </nav>
        </div>
	</div><!-- mainmenu -->





<div class="container-fluid" id="page" >

    

    
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div>


	<div id="footer">
        <div id="bottom_menu">
        <ul>
        <li>
        <?php echo CHtml::link('О нас', array('/site/page', 'view'=>'about')); ?>
        </li>
        <li>
        <?php echo CHtml::link('Обратная связь', array('/site/contact')); ?>
        </li>
        </ul>
        </div>
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

<!-- page -->




</body>
</html>
