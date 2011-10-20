<?php
class IndexController
{
    protected $_viewDir;
    protected $_title;
    protected $_parameters;

    public function __construct($viewDir, array $parameters = array())
    {
        $this->_viewDir = $viewDir;
    }

    public function __call($method, $args)
    {
        $this->_title = 'Anal Entry / Страница не найдена';
        header('HTTP/1.1 404 Not Found');
        require_once "{$this->_viewDir}/404.phtml";
    }

    public function indexAction()
    {
        $this->render('index');
        $this->_title = 'Anal entry';
    }

    public function aboutAction()
    {
        $this->render('about');
        $this->_title = 'Anal Entry / О сайте';
    }

    public function blameAction()
    {
        $blame = 'Blame!';
        $this->_title = 'Anal Entry / ';
        $this->render('blame', array('blame' => $blame));
    }

    public function render($view, array $params = array())
    {
        extract($params);
        require_once $this->_viewDir . "/index/{$view}.phtml";
    }

    public function getTitle()
    {
        return $this->_title;
    }
}
?>