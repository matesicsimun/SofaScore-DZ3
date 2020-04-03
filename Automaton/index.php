<?php
declare (strict_types = 1);

require_once "src/Automaton.php";
require_once "src/DefaultAutomaton.php";

function prnt(string $s = "")   : void {
    echo $s . "<br>\n";
}

/*
 * Automaton registration
 */
Automaton::register("ime", new DefaultAutomaton("Simun"));
Automaton::register("brojevi", new DefaultAutomaton("12345"));
Automaton::register("mijesano", new DefaultAutomaton("\[12345\]"));
Automaton::register("SofaAutomation", new DefaultAutomaton("Sofa<broj><brojeviislova>Score",
                                                ["broj"=>"\\d+", "brojeviislova"=>"[[:alnum:]]*"]));

Automaton::register("lozinka", new DefaultAutomaton("lozinka<brojevi><znakovi>",
                        ["brojevi"=>"\\d+", "znakovi"=>"[!?_&%$#]+"]));

Automaton::register("registracija", new DefaultAutomaton("<dvaslova1> <tribroja>-<dvaslova2>",
                        ["dvaslova1"=>"[A-ZŽŠĆĐČ]{2}", "tribroja"=>"\\d{3}", "dvaslova2"=>"[A-ZŽŠĆĐČ]{2}"]));

Automaton::register("puno ime", new DefaultAutomaton("<slova> <slova>", ["slova"=>"[A-Z][a-z]+"]));

Automaton::register("username", new DefaultAutomaton("<brojevislovaiznakovi>",
                                                ["brojevislovaiznakovi"=>"[a-z]+[a-z0-9_-]{3,16}"]));

Automaton::register("complex username", new DefaultAutomaton("<brojevislovaiviseznakova>",
                                               ["brojevislovaiviseznakova"=>"[a-z]+[a-z0-9_!?€#-$&]{3,19}"]));

/*
 * Automaton testing
 */

$test = ["a", "Simun", "123456", "[12345]", "SofaScore", "Sofa10Score", "Sofa2020EducationScore",
                "lozinka12341123!###?", "lozinka", "zinkalo", "ZG 231-BN", "ZG321BN", "VŽ1111BJ", "RI 121ABC",
                "Pero Peric", "AnaKovac", "ana kovac", "pero Peric", "Pero", "username123", "us€rname123",
                "SofasaScore", "Sofa1ssScore"];


/*
 * Iterates over the $test array and tries to match strings to automata.
 */
foreach ($test as $t){
    $matched = null;
    foreach (Automaton::get() as $name => $automaton){
        if (!$automaton->match($t)){
            continue;
        }
        $matched = $name;
        break;
    }

    if (null === $matched){
        prnt("None automaton matched $t.");
    }
    else{
        prnt("Automaton " . $name . " matched $t.");
    }
}

prnt(); prnt();

/*
 * Test string generating
 */

prnt(Automaton::get("ime")->generate());
prnt(Automaton::get("lozinka")->generate(["brojevi"=>"14123", "znakovi"=>"!#$"]));
prnt(Automaton::get("lozinka")->generate(["znakovi"=>"lozinka"]));
prnt(Automaton::get("lozinka")->generate([ "znakovi"=>"#!"]));
prnt(Automaton::get("lozinka")->generate(["brojevi"=>"loz", "znakovi"=>"1234"]));
prnt(Automaton::get("SofaAutomation")->generate(["broj"=>"2020", "brojeviislova"=>"sofa3duc4t1on"]));
prnt(Automaton::get("SofaAutomation")->generate([]));
prnt(Automaton::get("SofaAutomation")->generate(["broj"=>"nekibroj", "brojeviislova"=>""])); //brojevi i slova prolazi jer je definiran s *, a ne s +
prnt(Automaton::get("registracija")->generate([]));
prnt(Automaton::get("registracija")->generate(["dvaslova1"=>"ZD", "tribroja"=>"123", "dvaslova2"=>"JK"]));
