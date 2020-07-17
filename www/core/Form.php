<?php

namespace HotelFactory\core;

use HotelFactory\core\builder\FormBuilder;

class Form
{
    private $builder;
    private $config = [];
    private $model;
    private $name;
    private $isSubmit = false;
    private $isValid = false;
    private $validator;
    private $errors = [];

    //Initialise le validator et mets les valeurs par défaut dans la config
    public function __construct()
    {
        $this->validator = new Validator();

        $this->config = [
            "method"=>"POST",
            "action"=>"",
            "attr" => [ ]

        ];
    }


    // QUELQUES METHODES

    //Parcours les élements du Builder en récupérant le nom (exemple:firstname)
    // Si le getter de ce nom existe dans le model lié à la page on le modifie
    public function associateValue()
    {

        foreach($this->builder->getElements() as $key => $element)
        {
            $method = 'get'.ucfirst($key);

            if(method_exists($this->model, $method))
            {
                $this->builder->setValue($key, $this->model->$method());
            }
        }

    }

    // Je l'utilise pour me simplifier la vie, il ne fait que récupèrer les élèments du builder
    public function getElements(): ?array
    {
        return $this->builder->getElements();
    }

    /**
     *  Si on est en POST, on update isSubmit en lançant checkIsSubmit
     *      si on est isSubmit on update isValid en lançant checkIsValid
     *      Quand on termine, on associe les valeurs des champs du formulaire à notre $model
     *
     * */
    public function handle(): void
    {
        if($_SERVER['REQUEST_METHOD'] === $this->config["method"])
        {
            $isSubmit = $this->checkIsSubmitted();
            if($isSubmit)
            {
                $this->checkIsValid();
            }

            $this->updateObject();
        }
    }
    // name = testype_firstname
    /**
     * Comme on peut faire plusieurs formulaire dans une page, le name en front
     * contient le $nomFormulaire_$nomDuChamps, donc je parcours mes données en POST
     * et si une clé contient le $nomFormulaire alors je sais que c'est le bon formulaire qui est soumis
     * Le nom se trouve dans $name / Elle update isSubmit
     */
    private function checkIsSubmitted()
    {
        foreach($_POST as $key => $value)
        {
            if(FALSE !== strpos($key, $this->name))
            {
                $this->isSubmit = true;
                return true;
            }
        }

        return false;
    }

    /**
     * Cette méthode regarde pour chaque élements du builder l'ensemble des contraintes
     * Si il y a des contraintes, alors elles les enregistres dans $errors
     * Elle update $isValid
     */
    public function checkIsValid(): void
    {
        $this->isValid = true;


        foreach($_POST as $key => $value)
        {

            if(FALSE !== strpos($key, $this->name))
            {
                //testtype_firstname
                $key = str_replace($this->name.'_', '', $key);
                //firstname
                $element = $this->builder->getElement($key);

                if(isset($element->getOptions()['constraints']))
                {
                    foreach($element->getOptions()['constraints'] as $constraint)
                    {
                        $responseValidator = $this->validator->checkConstraint($constraint, $value);

                        if(NULL !== $responseValidator)
                        {
                            $this->isValid = false;
                            $this->errors[$key] = $responseValidator;
                        }
                    }

                }

            }
        }
    }

    // Insere les valeurs du formulaire dans $model
    public function updateObject(): void
    {
        foreach($_POST as $key => $value)
        {

            if(FALSE !== strpos($key, $this->name))
            {
                $key = str_replace($this->name.'_', '', $key);

                $method = 'set'.ucfirst($key);

                if(method_exists($this->model, $method))
                {
                    $this->model->$method($value);
                }
            }
        }

        $this->associateValue();
    }
// SETTER AND GETTER
    public function isSubmit(): bool
    {
        return $this->isSubmit;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function setModel(Model $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getBuilder()
    {
        return $this->builder;
    }

    public function setBuilder(FormBuilder $formBuilder): self
    {
        $this->builder = $formBuilder;

        return $this;
    }

    public function addConfig(string $key, $newConfig): self
    {
        $this->config[$key] = $newConfig;

        return $this;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}
