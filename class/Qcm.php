<?php
class Qcm
{
    private  $db;
    private array $questions = [];

    public function __construct(PDO $db)
    {
        $this->db = $db;

    }

    public function getQuestions()

    {
        // Use PDO to fetch questions from the database
        $query = $this->db->query("SELECT * FROM question ");
        $questionsData = $query->fetchAll();
        // var_dump($questionsData );

        // Call the private function to handle creating Question and Answer objects
        $this->processQuestionsData($questionsData);
    }

    private function processQuestionsData($questionsData)
    {
        foreach ($questionsData as $data) {
            $question = new Question($data['question']);
            $question->setExplications($data['explication']);

            // Call the private function to handle creating Answer objects
            $answers = $this->getAnswersForQuestion($data['id']);
            foreach ($answers as $answer) {
                $question->addAnswer($answer);
            }

            $this->questions[] = $question;
        }
    }

    private function getAnswersForQuestion($questionId)
    {
        // Use PDO to fetch answers from the database for a specific question
        $query = $this->db->prepare("SELECT * FROM answer WHERE question_id = :question_id");
        $query->execute(['question_id' => $questionId]);
        $answersData = $query->fetchAll();
        // var_dump( $answersData);
        // die();

        $answers = [];
        foreach ($answersData as $data) {
            $answers[] = new Answer($data['answer'], $data['is_correct']);
           
        }

        return $answers;
    }

    public function generate()
    {
        foreach ($this->questions as $index => $question) {
            echo "Question " . ($index + 1) . ": " . $question->getCorps() . "<br>";
            foreach ($question->getAnswers() as $index => $answer) {
                echo ($index + 1) . " - " . $answer->getText() . "<br>";
            }
            echo "Explications: " . $question->getExplications() . "<br><br>";
        }
    }
}
