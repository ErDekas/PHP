<?php
$a = 1;
$b = -3;
$c = 2;

$discriminante = $b * $b - 4 * $a * $c;

echo "Resultados de la ecuación: {$a}x^2 + {$b}x + {$c} = 0\n";

if ($discriminante > 0) {
    $raiz1 = (-$b + sqrt($discriminante)) / (2 * $a);
    $raiz2 = (-$b - sqrt($discriminante)) / (2 * $a);
    
    echo "Las raíces son: $raiz1 y $raiz2\n";
    
    print "Las raíces son: $raiz1 y $raiz2\n";
    
    printf("Las raíces son: %.2f y %.2f\n", $raiz1, $raiz2);
} elseif ($discriminante == 0) {
    $raiz = -$b / (2 * $a);
    
    echo "La raíz doble es: $raiz\n";
    
    print "La raíz doble es: $raiz\n";
    
    printf("La raíz doble es: %.2f\n", $raiz);
} else {
    echo "No hay raíces reales.\n";
    print "No hay raíces reales.\n";
    printf("No hay raíces reales.\n");
}
?>