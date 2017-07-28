<?php
/**
 * index.php запускает Bootstrap вызовом "Bootstrap::run();"
 * Задача Bootstrap подготовить приложение к работе.
 * В мелких приложениях можно использовать самописный Bootstrap. 
 * В средних и крупных лучше использовать фреймворки ( Bootstrap расширен от соответствующего класса фреймворка)
 */
class Bootstrap /* extends ...*/
{
	static $instance=null;
	static funnction run()
	{
		if ($instance !== null){
			return;
		}
		self::$instance = new self();
		self::$instance->_initLog();
		self::$instance->_initDb();
		/*...*/
	}
	protected function _initLog(){/*...*/}
	protected function _initDb(){/*...*/}
}
?>
