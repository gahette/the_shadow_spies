<?php

namespace App\Validation;

class Validator
{
    private $data;
    private $errors;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validate(array $rules): ?array
    {
        foreach ($rules as $lastname => $rulesArray) {
            if (array_key_exists($lastname, $this->data)) {
                foreach ($rulesArray as $rule) {
                    switch ($rule) {
                        case 'required':
                            $this->required($lastname, $this->data[$lastname]);
                            break;
                        case substr($rule, 0, 3) === 'min':
                            $this->min($lastname, $this->data[$lastname], $rule);
                    }
                }
            }
        }
        return $this->getErrors();
    }

    private function required(string $lastname, string $value)
    {
        $value = trim($value);
        if (empty($value)) {
            $this->errors[$lastname][] = "$lastname est requis.";
        }
    }

    private function min(string $lastname, string $value, string $rule)
    {
        preg_match_all('/(\d+)/', $rule, $matches);

        $limit = (int)$matches[0][0];

        if (strlen($value) < $limit) {
            $this->errors[$lastname][] = "$lastname doit comprendre un minimum de $limit caractères.";
        }
    }

    private function getErrors(): ?array
    {
        return $this->errors;
    }
}