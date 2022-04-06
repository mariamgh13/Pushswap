<?php

$la = $argv;
// array_shift($la);
$lb = [];
$options = "";

// OUTILS 


// SWAP

// échange les postions des deux premiers éléments de $la
function sa(&$la)
{
    global $options;
    $tmp = $la[0];
    $la[0] = $la[1];
    $la[1] = $tmp;
    $options .= " sa";
}
// échange les postions des deux premiers éléments de $lb
function sb(&$lb)
{
    global $options;
    $tmp = $lb[0];
    $lb[0] = $lb[1];
    $lb[1] = $tmp;
    $options .= " sb";
}
// sa() & sb() en même temps
function sc(&$la, &$lb)
{
    global $options;
    sa($la);
    sb($lb);
    $options .= "sc";
}

//PUSH

// prend le premier élément de $lb et le place à la prèmiere position de $la
function pa(&$la, &$lb)
{
    global $options;
    $element = array_shift($lb);
    array_unshift($la, $element);
    $options .= " pa";
}
// prend le premier élément de $lb et le place à la prèmiere position de $lb
function pb(&$la, &$lb)
{
    global $options;
    $element = array_shift($la);
    array_unshift($lb, $element);
    $options .= " pb";
}

// ROTATE

// fait une rotation de $la vers le début
function ra(&$la)
{
    global $options;
    $element = array_shift($la);
    array_push($la, $element);
    $options .= " ra";
}
// fait une rotation de $lb vers le début
function rb(&$lb)
{
    global $options;
    $element = array_shift($lb);
    array_push($lb, $element);
    $options .= " rb";
}

// ra() & rb() en même temps
function rr(&$la, &$lb)
{
    global $options;
    ra($la);
    rb($lb);
    $options .= " rr";
}
//fait une rotation de $la vers la fin
function rra(&$la)
{
    global $options;
    $element = array_pop($la);
    array_unshift($la, $element);
    $options .= " rra";
}
//fait une rotation de $lb vers la fin
function rrb(&$lb)
{
    global $options;
    $element = array_pop($lb);
    array_unshift($lb, $element);
    $options .= " rrb";
}
// rra() & rrb() en même temps
function rrr(&$la, &$lb)
{
    global $options;
    rra($la);
    rrb($lb);
    $options .= " rrr";
}

// function chose_arg($array)
// {
//     $counts = count($array);
// }

function chose_arg($array)
{
    $counts = count($array);
    for ($i = 0; $i < $counts - 1; $i++) {
        if ($array[$i] > $array[$i + 1]) {
            return false;
        }
    }
    return true;
}

$basecounts = count($la);

function check($la, $lb)
{
    $end = false;
    global $basecounts;
    global $options;

    while ($end == false) {

            if (chose_arg($la) == true) {
                
                if (count($la) == $basecounts) {
                    echo PHP_EOL;
                    $end = true;
                } else {
                    $l = count($lb);
                    for($i = 0; $i < $l; $i++) {
                        pa($la, $lb);
                    }
                    $end = true;
                }
            } else {
                $minla = min($la);
                while (chose_arg($la) == false) {
                    if ($la[0] <= $la[1]) {
                        if ($la[0] == $minla) {
                            pb($la, $lb);
                            $minla = min($la);
                        } else {
                            ra($la);
                        }
                    } else {
                        sa($la, $lb);
                    }
                }
            }
    }

    echo trim($options) . PHP_EOL;
}

$lb = [];
$la = array_slice($argv, 1);


check($la, $lb);
