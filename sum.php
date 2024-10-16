<?php

/**
 * Cette fonction montre le cumul en complexité logarithmique O(n)
 * perf : pour 1000 de cumuls de 0 à 1000000 : 65,67 sec ou 69.94 sec ou 72,21 sec
 * @param $end
 * @return int
 */
function sumRangeOnFrom1To($end)
{
    $cumul = 0;
    for($i=1; $i<=$end; $i++) {
        $cumul+=$i;
    }

    return $cumul;
}

/**
 * Cette fonction montre le cumul en complexité logarithmique O(1)
 * Certaines instructions ne sont pas nécessaires à la fonction :
 * L'objectif est de ne différencier de sumRangeOnFrom1To QUE le calcul,
 * c'est pour cela que ces instructions inutiles ont été laissées.
 * perf : pour 1000 de cumuls de 0 à 1000000 : 0.00049996 sec ou 0.0004251 sec
 * @param $end
 * @return float|int
 */
function sumRangeO1From1To($end)
{
    $cumul = 0;
    $cumul = $end*($end+1)/2;

    return $cumul;
}

/**
 * Facteur entre les 2 fonctions pour max = 1000000 : ~130000. En factorisant et arrondissant, ça donne un facteur 10⁵.
 * On s'attendait à une grosse diff, mais c'est plutôt énorme. Concrètement on a plus d'1 min et moins d'1 sec.
 *  65,67 sec contre 0.00049996 sec pour max = 1000000 et repeat = 1000 => fact : 130000
 *   46.89 sec contre 0.00049496 sec pour max = 500000 et repeat = 1000 => fact : 94753. Diff pour O(n) par rapport à 1000000 : 71%
 *   18.84 sec contre 0.00074887 sec pour max = 200000 et repeat = 1000 => fact : 25157. Diff pour O(n) par rapport à 1000000 : 29%
 */
$max = isset($argv[1])?intval($argv[1]):1000;
$repeat = isset($argv[2])?intval($argv[2]):1000;
print "Launching 0n cumul right after this".PHP_EOL;
$start = microtime(true);
for($i=0;$i<$repeat;$i++) {
    $cumulOfRange1ToVal = sumRangeOnFrom1To($max);
}
$end = microtime(true);
echo $cumulOfRange1ToVal.PHP_EOL;
print ($end - $start).PHP_EOL;


print "Launching 01 cumul right after this".PHP_EOL;
$start = microtime(true);
for($i=0;$i<$repeat;$i++) {
    $cumulOfRange1ToVal = sumRangeO1From1To($max);
}
$end = microtime(true);
echo $cumulOfRange1ToVal.PHP_EOL;
print ($end - $start).PHP_EOL;