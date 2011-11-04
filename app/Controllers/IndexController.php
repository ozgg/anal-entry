<?php
class IndexController
{
    protected $_viewDir;
    protected $_title;
    protected $_parameters;

    public function __construct($viewDir, array $parameters = array())
    {
        $this->_viewDir = $viewDir;
        $this->_parameters = $parameters;
    }

    public function __call($method, $args)
    {
        $this->_title = 'Anal Entry / Страница не найдена';
        header('HTTP/1.1 404 Not Found');
        require_once "{$this->_viewDir}/404.phtml";
    }

    public function indexAction()
    {
        $this->_title = 'Вход в жопу. Ответы на вопросы.';
        $this->render('index', array('blame' => new Blame()));
    }

    public function aboutAction()
    {
        $this->render('about');
        $this->_title = 'О сайте «Вход в жопу»';
    }

    public function blameAction()
    {
        if (!empty($this->_parameters[0])) {
            $id = intval($this->_parameters[0]);
        } else {
            $id = 0;
        }
        $blame = new Blame($id);
        $this->_title = "Почему {$blame->getPhrase()}? [Анальный вход]";
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