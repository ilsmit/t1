<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
	   $this->redirect('admin/news');
		$this->render('index');
	}
}