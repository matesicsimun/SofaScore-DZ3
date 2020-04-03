<?php


abstract class Automaton
{
    /**
     * Asocijativno polje automata u formatu $ime => $automat
     * @var array $map
     */
    private static $map = [];

    /**
     * Metoda provjerava podudara li se ulazni niz znakova s automatom
     * @param string $input
     * @return true ako se niz podudara, false inace
     */
    public abstract function match($input) : bool;

    /**
    * Metoda na temelju definicije automata te ulaznih parametara
    * generira izlazni niz znakova.
    * Ulazni parametri sastoje se u obliku kljuc => vrijednost .
    * Kljuc je ime parametra regularnog izraza , a vrijednost je
    * vrijednost
    * koja se mora pojaviti u generiranom nizu .
    *
    * U slucaju da nedostaje neki ulazni parametar, ispisati na
    * ekran koji parametar nedostaje.
    * U slucaju da neka vrijednost parametra ne odgovara tipu,
    * ispisati da nije valjan tip podatka .
    * @param array $array ime_parametra_automata = > vrijednost
    * koju mora poprimiti
    *
    * @return string generirani niz znakova
    */
    public abstract function generate(array $array = []) : string;

    /**
    * Metoda za registraciju automata .
    * Imenu u $map se pridruzuje automat .
    * @param string $name
    * @param Automaton $automaton
    */
    public static function register(string $name, Automaton $automaton){
        self::$map[$name] = $automaton;
    }

    /**
     * Metoda vraca automat ili mapu automata.
     * Ako je predano ime, vraca automat ili null.
     * Ako je metoda pozvana bez parametara, vraca cijelu
     * mapu automata.
     * @param string $name
     *
     * @return null|Automaton|Automaton[]
     */
    public static function get($name = null){
        if ($name === null || !array_key_exists($name, self::$map)){
            return self::$map;
        }

        return self::$map[$name];
    }



}