<?php

namespace HotelFactory\models;

class Question extends Model
{
    protected $id;
    protected $question;
    protected $idHfUser;
    protected $status;

    /* SETTERS */

    public function setId($id)
    {
        $this->id=$id;
    }

    public function setQuestion($question)
    {
        $this->question=strip_tags($question);
    }

    public function setIdHfUser($idHfUser)
    {
        $this->idHfUser=$idHfUser;
    }

    public function setStatus($status)
    {
        $this->status=$status;
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

    public function getStatus(){
        return $this->status;
    }

    public static function showQuestionTable($questions){

        $tabQuestions = [];
        foreach($questions as $question){
            $tabQuestions[] = [
                "id" => $question->getId(),
                "question" => $question->getQuestion(),
                "idHfUser" => $question->getIdHfUser(),
                "status" => $question->getStatus()
            ];
        }

        $tab = [
            "colonnes"=>[
                "Id",
                "Question",
                "User",
                "Status"
            ],

            "fields"=>[
                "Question"=>[]
            ]
        ];

        $tab["fields"]["Question"] = $tabQuestions;


        return $tab;
    }

}
