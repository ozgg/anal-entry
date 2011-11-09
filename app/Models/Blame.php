<?php
class Blame
{
    protected $_phrases;
    protected $_index = 0;

    public function __construct($id = 0)
    {
        $this->_phrases = include_once __DIR__ . '/Blame/data.php';
        $index = $id - 1;
        if (!isset($this->_phrases[$index])) {
            $index = rand(0, count($this->_phrases) - 1);
        }
        $this->_index = $index;
    }

    public function __toString()
    {
        $variants = array(
            'Это из-за тебя',
            'Это исключительно по твоей вине',
            'Это по твоей вине',
            'По твоей вине',
            'Это исключительно из-за тебя',
            'Это из-за таких, как ты,',
            'Из-за таких, как ты,',
        );
        $index = rand(0, count($variants) - 1);
        $end = rand(0, 1) ? '.' : '!';
        return "{$variants[$index]} {$this->_phrases[$this->_index]}{$end}";
    }

    public function getPhrase()
    {
        return $this->_phrases[$this->_index];
    }

    public function getIndex()
    {
        return $this->_index + 1;
    }
}
?>