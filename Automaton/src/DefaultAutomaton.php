<?php


class DefaultAutomaton extends Automaton
{
    private $fullRegex; //contains the full regex definition of the automaton
    private $originalInput; //contains automaton definition with <parameter> notation
    private $definitions; //pairs of <parameter> => regex definitions

    /**
    * DefaultAutomaton constructor.
    * Konstruktorska metoda.
    * @param $input ulazni regularni izraz. Posebni parametri
    * nalaze se unutar tagova <>, te se smiju iskljucivo sastojati
    * od brojeva , malih slova engleske abecede te znaka podvlak.
    * @param array $regex mapa imena parametara i prudruzenih
    * regularnih izraza; regularni izrazi moraju biti valjani i u
    * skladu s PHP notacijom da bi ih PCRE mogao izvoditi.
    */
    public function __construct($input, array $regex = [])
    {
        $this->originalInput = $input;
        $this->definitions = $regex;

        $this->createFullRegex();
    }

    /**
     * Replaces fullRegex that contains <parameter> notation
     * with a standard regular expression which can be used
     * to match inputs.
     */
    private function createFullRegex(){
        $this->fullRegex = $this->originalInput; //initialize value

        foreach ($this->definitions as $key => $value){
            $pattern = "/<" .  $key . ">/";
            $this->fullRegex = preg_replace($pattern, $value, $this->fullRegex);
        }

        $this->fullRegex = "/^" . $this->fullRegex . "$/";
    }

    /**
     * @inheritDoc
     */
    public function match($input): bool
    {
        if (1 === preg_match($this->fullRegex, $input)){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function generate(array $array = []): string
    {
        //initializes the result to the input that was used to initially describe the automaton
        $generatedString = $this->originalInput;

        //matches and replaces parameters in '<' and '>' of the original input string with the values stored in $definitions array
        foreach ($array as $key => $value) {

            //verifies the type of value that should replace a parameter in the string
            if (!preg_match("/" . $this->definitions[$key] . "/", $value)) {
                $generatedString = preg_replace("/<$key>/", "-Value $key not valid-", $generatedString);
            } else {
                $pattern = "/<" . $key . ">/";
                $generatedString = preg_replace($pattern, $value, $generatedString);
            }

        }

        //verify that no parameters are left unreplaced in the string
        //i.e. no <parameter1> strings should be stored in the generated string
        $matches = [];
        $checkRegex = "/<(.*?)>/";
        if (preg_match_all($checkRegex, $generatedString, $matches) > 0){
            foreach ($matches[1] as $match){
                $generatedString = preg_replace("/<".$match.">/", "-Missing parameter $match-", $generatedString);
            }
        }

        return $generatedString;
    }
}