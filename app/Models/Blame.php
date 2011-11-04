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
        return "Это из-за тебя {$this->_phrases[$this->_index]}!";
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