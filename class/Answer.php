<?php
 class Answer {
    private $text;
    private $correct;

    public function __construct($text, $correct) {
        $this->text = $text;
        $this->correct = $correct;
    }

    public function isCorrect() {
        return $this->correct;
    }

    public function getText() {
        return $this->text;
    }
}

?>