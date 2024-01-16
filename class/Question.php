<?php
class Question {
    private $corps;
    private $explications;
    private array $answers = [];

    public function __construct($corps) {
        $this->corps = $corps;
    }

    public function addAnswer(Answer $answer) {
        $this->answers[] = $answer;
    }

    public function setExplications($explications) {
        $this->explications = $explications;
    }

    public function getCorps() {
        return $this->corps;
    }

    public function getExplications() {
        return $this->explications;
    }

    public function getAnswers() {
        return $this->answers;
    }
}
?>




