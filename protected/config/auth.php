<?php
return array (
		
		'updateComment' =>
		array(
				'type' => CAuthItem::TYPE_OPERATION,
				'description' => 'изменение комментария',
				'bizRule' => NULL,
				'data' => NULL,
		),

  'updateUser' => 
  array (
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'изменение данных пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
		
  'updateOwnUser' => 
  array (
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'изменение своих данных',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
     
    ),
  ),
		
  'createNews' => 
  array (
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'создание контакта',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'viewNews' => 
  array (
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'просмотр списка контактов',
    'bizRule' => NULL,
    'data' => NULL,
  ),

  'updateNews' => 
  array (
    'type' =>CAuthItem::TYPE_ROLE,
    'description' => 'редактирование контакта',
    'bizRule' => NULL,
    'data' => NULL,
  ),
		'updateOwnNews' =>
		array (
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'редактирование контакта',
				'bizRule' => 'return Yii::app()->user->id==News::model()->news_author',
				
				'data' => NULL,

		),		
		
  'deleteNews' => 
  array (
    'type' => CAuthItem::TYPE_OPERATION,
    'description' => 'удаление контакта',
    'bizRule' => NULL,
    'data' => NULL,
  ),
		
		
		
		
		'guest' => array(
				'type' => CAuthItem::TYPE_ROLE,
				'description' => 'Guest',
				'bizRule' => null,
				'data' => null
		),			
	  'user' => 
		  array (
	     'type' => CAuthItem::TYPE_ROLE,
	     'description' => '',
	     'bizRule' => NULL,
	     'data' => NULL,
	     'children' => 
	 	    array (
				'guest',
	 	    	'updateOwnUser',
	 	    		'updateComment'
	 	    			
	 	    		
	    ),
	  ),
		'moderator' =>
		array (
				'type' => CAuthItem::TYPE_ROLE,
				'description' => '',
				'bizRule' => NULL,
				'data' => NULL,
				'children' =>
				array (
					'user',
					'createNews',
						'updateComment'
				),
		
		),		
		'admin' =>
		array (
				'type' => CAuthItem::TYPE_ROLE,
				'description' => '',
				'bizRule' => NULL,
				'data' => NULL,
				'children' =>
				array (
					'moderator',
					'updateNews',	
					'manageNews',
					'deleteNews',
					'updateUser',
					'updateComment'	
						
				),
		
		),
);
