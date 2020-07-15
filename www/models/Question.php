<?php

namespace HotelFactory\models;

class Question extends Model
{
    protected $id;
    protected $question;
    protected $idHfUser;

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setQuestion($question)
    {
        $this->question=$question;
    }

    public function setIdHfUser($idHfUser){
        $this->idHfUser=$idHfUser;
    }


    /* GETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getIdHfUser()
    {
        return $this->idHfUser;
    }

    public static function showQuestionTable($questions){

        $tabQuestions = [];
        foreach($questions as $question){
            $tabQuestions[] = [
                "id" => $question->getId(),
                "question" => $question->getQuestion(),
                "idHfUser" => $question->getIdHfUser()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Question",
                "User"
            ],

            "fields"=>[
                "Question"=>[]
            ]
        ];

        $tab["fields"]["Question"] = $tabQuestions;


        return $tab;
    }

}

?>