<?php
/**
 * Smarty view renderer
 *
 * @author Alexander Makarov <sam@rmcreative.ru>
 * @author Carsten Brandt <mail@cebe.cc>
 * @link http://code.google.com/p/yiiext/
 * @link http://www.smarty.net/
 *
 * @version 1.0.0
 */
class ESmartyViewRenderer extends CApplicationComponent implements IViewRenderer
{
	/**
	 * @var string the file-extension for viewFiles this renderer should handle
	 * for smarty templates this usually is .tpl
	 */
	public $fileExtension = '.tpl';

	/**
	 * @var int dir permissions for smarty compiled templates directory
	 */
	public $directoryPermission = 0771;

	/**
	 * @var int file permissions for smarty compiled template files
	 * NOTE: BEHAVIOR CHANGED AFTER VERSION 0.9.8
	 */
	public $filePermission = 0644;

	/**
	 * @var array smarty configuration values
	 * this array is used to configure smarty at initialization you can set all
	 * public properties of the Smarty class e.g. error_reporting
	 *
	 * please note:
	 * compile_dir will be created if it does not exist, default is <app-runtime-path>/smarty/compiled/
	 *
	 * @since 0.9.9
	 */
	public $config = array();

	/**
	 * @var Smarty smarty instance for rendering
	 */
	private $smarty = null;

	/**
	 * Component initialization
	 */
	public function init(){

		parent::init();

		Yii::import('application.vendors.*');

		require_once('Smarty/Smarty.class.php');
		// load the smarty helper
		require_once dirname(__FILE__).'/plugins/smarty_helper.php';

        if (SMARTY_SPL_AUTOLOAD !== 0) {
			throw new CException('ESmartyViewRenderer cannot work with SMARTY_SPL_AUTOLOAD enabled. Set SMARTY_SPL_AUTOLOAD to 0.');
		}

		spl_autoload_unregister('smartyAutoload');
		Yii::registerAutoloader('smartyAutoload');

		$this->smarty = new Smarty();

        $this->config = array_merge(
            array(
                'compile_dir' => Yii::app()->getRuntimePath().'/smarty/compiled/',
                '_file_perms' => $this->filePermission,
                '_dir_perms'  => $this->directoryPermission
            ),
            $this->config
        );
        // configure smarty
        foreach ($this->config as $key => $value) {
			$this->smarty->$key = $value;
		}

		$this->smarty->template_dir = '';
	}

	/**
	 * Renders a view file.
	 * This method is required by {@link IViewRenderer}.
	 * @param CBaseController the controller or widget who is rendering the view file.
	 * @param string the view file path
	 * @param mixed the data to be passed to the view
	 * @param boolean whether the rendering result should be returned
	 * @return mixed the rendering result, or null if the rendering result is not needed.
	 */
	public function renderFile($context,$sourceFile,$data,$return) {
		// current controller properties will be accessible as {$this.property}
		$data['this'] = $context;
		// Yii::app()->... is available as {Yii->...} (deprecated, use {Yii::app()->...} instead, Smarty3 supports this.)
		$data['Yii'] = Yii::app();

		$template = $this->smarty->createTemplate($sourceFile, null, null, $data, false);

		//render or return
		if($return)
			return $template->fetch();
		else
			$template->display();
	}
}