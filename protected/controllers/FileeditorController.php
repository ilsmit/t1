<?php
class FileeditorController extends Controller
{
	public $homePath;
	public $logPath;
	public $editableFolders = array(
		array('path'=>"files/css", 'label'=>'CSS'),
		array('path'=>"files/php", 'label'=>'PHP'),
	);

	public function init(){
		$this->homePath = dirname(Yii::app()->request->scriptFile);
		$this->logPath = $this->homePath.'/logFileEditor.txt';
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array(
					'getContent',
					'putContent',
					'newFile'
				),
				'users'=>array('*'),
			),

			array('allow',
				'actions'=>array(
// 					'getContent',
// 					'putContent',
// 					'newFile'
				),
				'users'=>array('admin'),
			),

			array('allow',
				'actions'=>array(
// 					'getContent',
// 					'putContent',
// 					'newFile'
				),
				'users'=>array('@', 'admin'),
			),

			array('deny',
				'actions'=>array(
				),
				'users'=>array('*'),
			),
		);
	}

	public function safe($file)
	{
		$f = explode('/', $file);
		$c = count($f);

		foreach($this->editableFolders as $folder)
			if(strtolower($f[0]) === strtolower($folder['label']))
				$filepath = $this->homePath.'/'.$folder['path'].'/'.$f[1];

		return $c>2 || !isset($filepath) ? self::setLog($file) : $filepath;
	}

	public function setLog($file){

		$nfile = $this->logPath;
		
		if(file_exists($nfile))
			$logEditorContent = file_get_contents($nfile);

		$time = Yii::app()->dateFormatter->formatDateTime(time(), 'short');

		$logEditorContent .= "\n".$time.' - '.CHttpRequest::getUserHostAddress().' - '.$file;

		file_put_contents($nfile, $logEditorContent);
		return false;
	}

	public function actionNewFile(){
		if(self::safe($_POST['directory'].'/'.$_POST['filename']))
			echo file_put_contents(self::safe($_POST['directory'].'/'.$_POST['filename']), "");
		else
			return false;
	}

	public function actionGetContent(){
		echo file_get_contents(self::safe($_POST['filepath']));
	}

	public function actionPutContent(){
		$file = self::safe(urldecode ($_POST['path']));
		if($file === $this->logPath)
			return;

		echo file_put_contents($file, urldecode ($_POST['filecontent']));
	}
}

?>