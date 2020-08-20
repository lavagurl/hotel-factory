<?php

namespace HotelFactory\models;

class Answer extends Model
{
    protected $id;
    protected $answer;
    protected $idHfFaqQuestion;
    protected $idHfUser;

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setAnswer($answer)
    {
        $this->answer=strip_tags($answer);
    }

    public function setIdHfFaqQuestion($idHfFaqQuestion)
    {
        $this->idHfFaqQuestion=$idHfFaqQuestion;
    }

    public function setIdHfUser($idHfUser)
    {
        $this->idHfUser=$idHfUser;
    }


    /* GETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function getIdHfFaqQuestion()
    {
        return $this->idHfFaqQuestion;
    }

    public function getIdHfUser()
    {
        return $this->idHfUser;
    }

    public static function showAnswerTable($answers){

        $tabAnswers = [];
        foreach($answers as $answer){
            $tabAnswers[] = [
                "id" => $answer->getId(),
                "answer" => $answer->getAnswer(),
                "idHfFaqQuestion" => $answer->getIdFaqQuestion(),
                "idHfUser" => $answer->getIdHfUser()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Réponse",
                "Référence question",
                "Référence user"
            ],

            "fields"=>[
                "Answer"=>[]
            ]
        ];

        $tab["fields"]["Answer"] = $tabAnswers;


        return $tab;
    }

}