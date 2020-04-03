<?php

include "src/classes.php";

$html = new HTMLHtmlElement();
$head = new HTMLHeadElement();
$body = new HTMLBodyElement();

$title = new HTMLTitleElement("HTML library");
$meta = new HTMLMetaElement(["charset"=>"utf-8"]);
$meta_2 = new HTMLMetaElement(["name"=>"description", "content"=>"Demonstracija HTML biblioteke."]);

$head->add_children(new HTMLCollection([$title, $meta, $meta_2]));

/*
 * Begin body creation section
 */
$div = new HTMLDivElement();
$p = new HTMLPelement();
$text = new HTMLTextNode("Generirani SofaScore primjer.");

$p->add_child($text);
$div->add_child($p);
$div->add_attribute(new HTMLAttribute('class','omotac'));
$body->add_child($div);

$body->add_child(new HTMLBrElement());
/*
 * Begin table creation section
 */
$table = new HTMLTableElement();
$table->add_attribute(new HTMLAttribute("border","1"));
$row_1 = new HTMLRowElement();

$cell_1_1 = new HTMLCellElement();
$text = "Celija1";
$cell_1_1->add_text($text);

$cell_1_2 = new HTMLCellElement();
$text_node_2 = new HTMLTextNode("celija2");
$cell_1_2->add_text_node($text_node_2);

$cell_1_3 = new HTMLCellElement();
$text_node_3 = new HTMLTextNode("celija3");
$cell_1_3->add_text_node($text_node_3);

$row_1->add_cells([$cell_1_1, $cell_1_2, $cell_1_3]);
$table->add_existing_row($row_1);

$row_2 = new HTMLRowElement();
$cell_2_1 = new HTMLCellElement();
$cell_2_1->add_child(new HTMLTextNode("celija4"));
$row_2->add_child($cell_2_1);

$table->add_child($row_2);

$body->add_child($table);
/*
 * End table creation section
 */

$body->add_child(new HTMLBrElement());

/*
 * Begin form creation section
 */
$form = new HTMLFormElement();

//create input element and label element
$input = new HTMLInputElement();
$input->add_attribute(new HTMLAttribute("type","text"));
$input->add_attribute(new HTMLAttribute("id", "input1"));
$input->add_attribute(new HTMLAttribute("id1", "input2"));
$input->add_attribute(new HTMLAttribute("name","input1"));
$input->remove_attribute("id1");

$label = new HTMLLabelElement();
$label->add_attribute(new HTMLAttribute("for", "input1"));
$label->add_child(new HTMLTextNode("Enter some random string: "));

$form->add_child($label);
$form->add_child($input);

$form->add_child(new HTMLBrElement());
//create select element

$select = new HTMLSelectElement();
$select->add_attribute(new HTMLAttribute("id", "select1"));
$label_select = new HTMLLabelElement();
$label_select->add_attribute(new HTMLAttribute("for", "select1"));
$label_select->add_child(new HTMLTextNode("Select a option: "));

$option_1 = new HTMLOptionElement();
$option_1->add_attribute(new HTMLAttribute("value", "option1"));
$option_1->add_child(new HTMLTextNode("Option 1"));

$option_2 = new HTMLOptionElement();
$option_2->add_attribute(new HTMLAttribute("value","option2"));
$option_2->add_child(new HTMLTextNode("Option 2"));

$select->add_children(new HTMLCollection([$option_1, $option_2]));

$form->add_child($label_select);
$form->add_child($select);

$body->add_child($form);
/*
 * End form creation section
 */

/*
 * 'a' element creation
 */
$a = new HTMLAElement();
$a->add_attribute(new HTMLAttribute("href", "https://www.fer.unizg.hr"));
$a->add_child(new HTMLTextNode("Link na stranicu FER-a"));

$body->add_child(new HTMLBrElement());
$body->add_child($a);


$html->add_children(new HTMLCollection([$head, $body]));
echo $html->get_html();



/*
 * Testiranje nekih funkcija
 */

echo $body->get_child(1);
//echo $body->get_child(100); //uzrokuje pogresku
//echo $body->get_child(-1); //isto uzrokuje pogresku


echo $body->get_children_number(); //7

echo $body->get_child($body->get_children_number()-1); //provjera dohvata zadnjeg elementa - link
echo $body->remove_child(1);

echo $body->get_child($body->get_children_number()-1); //br

echo $body->get_children_number(); //6