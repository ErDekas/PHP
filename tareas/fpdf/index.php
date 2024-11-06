<?php
// Incluir la clase FPDF
require_once('C:/xampp/htdocs/fpdf186/fpdf.php');
// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Datos de ejemplo
$generacion = "Gen1";
$pokedex = "Pokédex";
$logo = 'logo.jpg'; // Cambia este nombre por el de la imagen del logo que uses
$pokemons = [
    ['numero' => 1, 'nombre' => 'Bulbasaur'],
    ['numero' => 2, 'nombre' => 'Ivysaur'],
    ['numero' => 3, 'nombre' => 'Venusaur'],
    ['numero' => 4, 'nombre' => 'Charmander'],
    ['numero' => 5, 'nombre' => 'Charmeleon'],
    ['numero' => 6, 'nombre' => 'Charizard'],
    ['numero' => 7, 'nombre' => 'Squirtle'],
    ['numero' => 8, 'nombre' => 'Wartortle'],
    ['numero' => 9, 'nombre' => 'Blastoise'],
    ['numero' => 10, 'nombre' => 'Caterpie'],
    ['numero' => 11, 'nombre' => 'Metapod'],
    ['numero' => 12, 'nombre' => 'Butterfree'],
    ['numero' => 13, 'nombre' => 'Weedle'],
    ['numero' => 14, 'nombre' => 'Kakuna'],
    ['numero' => 15, 'nombre' => 'Beedrill'],
    ['numero' => 16, 'nombre' => 'Pidgey'],
    ['numero' => 17, 'nombre' => 'Pidgeotto'],
    ['numero' => 18, 'nombre' => 'Pidgeot'],
    ['numero' => 19, 'nombre' => 'Rattata'],
    ['numero' => 20, 'nombre' => 'Raticate'],
    ['numero' => 21, 'nombre' => 'Spearow'],
    ['numero' => 22, 'nombre' => 'Fearow'],
    ['numero' => 23, 'nombre' => 'Ekans'],
    ['numero' => 24, 'nombre' => 'Arbok'],
    ['numero' => 25, 'nombre' => 'Pikachu'],
    ['numero' => 26, 'nombre' => 'Raichu'],
    ['numero' => 27, 'nombre' => 'Sandshrew'],
    ['numero' => 28, 'nombre' => 'Sandslash'],
    ['numero' => 29, 'nombre' => 'Nidoran♀'],
    ['numero' => 30, 'nombre' => 'Nidorina'],
    ['numero' => 31, 'nombre' => 'Nidoqueen'],
    ['numero' => 32, 'nombre' => 'Nidoran♂'],
    ['numero' => 33, 'nombre' => 'Nidorino'],
    ['numero' => 34, 'nombre' => 'Nidoking'],
    ['numero' => 35, 'nombre' => 'Clefairy'],
    ['numero' => 36, 'nombre' => 'Clefable'],
    ['numero' => 37, 'nombre' => 'Vulpix'],
    ['numero' => 38, 'nombre' => 'Ninetales'],
    ['numero' => 39, 'nombre' => 'Jigglypuff'],
    ['numero' => 40, 'nombre' => 'Wigglytuff'],
    ['numero' => 41, 'nombre' => 'Zubat'],
    ['numero' => 42, 'nombre' => 'Golbat'],
    ['numero' => 43, 'nombre' => 'Oddish'],
    ['numero' => 44, 'nombre' => 'Gloom'],
    ['numero' => 45, 'nombre' => 'Vileplume'],
    ['numero' => 46, 'nombre' => 'Paras'],
    ['numero' => 47, 'nombre' => 'Parasect'],
    ['numero' => 48, 'nombre' => 'Venonat'],
    ['numero' => 49, 'nombre' => 'Venomoth'],
    ['numero' => 50, 'nombre' => 'Diglett'],
    ['numero' => 51, 'nombre' => 'Dugtrio'],
    ['numero' => 52, 'nombre' => 'Meowth'],
    ['numero' => 53, 'nombre' => 'Persian'],
    ['numero' => 54, 'nombre' => 'Psyduck'],
    ['numero' => 55, 'nombre' => 'Golduck'],
    ['numero' => 56, 'nombre' => 'Mankey'],
    ['numero' => 57, 'nombre' => 'Primeape'],
    ['numero' => 58, 'nombre' => 'Growlithe'],
    ['numero' => 59, 'nombre' => 'Arcanine'],
    ['numero' => 60, 'nombre' => 'Poliwag'],
    ['numero' => 61, 'nombre' => 'Poliwhirl'],
    ['numero' => 62, 'nombre' => 'Poliwrath'],
    ['numero' => 63, 'nombre' => 'Abra'],
    ['numero' => 64, 'nombre' => 'Kadabra'],
    ['numero' => 65, 'nombre' => 'Alakazam'],
    ['numero' => 66, 'nombre' => 'Machop'],
    ['numero' => 67, 'nombre' => 'Machoke'],
    ['numero' => 68, 'nombre' => 'Machamp'],
    ['numero' => 69, 'nombre' => 'Bellsprout'],
    ['numero' => 70, 'nombre' => 'Weepinbell'],
    ['numero' => 71, 'nombre' => 'Victreebel'],
    ['numero' => 72, 'nombre' => 'Tentacool'],
    ['numero' => 73, 'nombre' => 'Tentacruel'],
    ['numero' => 74, 'nombre' => 'Geodude'],
    ['numero' => 75, 'nombre' => 'Graveler'],
    ['numero' => 76, 'nombre' => 'Golem'],
    ['numero' => 77, 'nombre' => 'Ponyta'],
    ['numero' => 78, 'nombre' => 'Rapidash'],
    ['numero' => 79, 'nombre' => 'Slowpoke'],
    ['numero' => 80, 'nombre' => 'Slowbro'],
    ['numero' => 81, 'nombre' => 'Magnemite'],
    ['numero' => 82, 'nombre' => 'Magneton'],
    ['numero' => 83, 'nombre' => 'Farfetch\'d'],
    ['numero' => 84, 'nombre' => 'Doduo'],
    ['numero' => 85, 'nombre' => 'Dodrio'],
    ['numero' => 86, 'nombre' => 'Seel'],
    ['numero' => 87, 'nombre' => 'Dewgong'],
    ['numero' => 88, 'nombre' => 'Grimer'],
    ['numero' => 89, 'nombre' => 'Muk'],
    ['numero' => 90, 'nombre' => 'Shellder'],
    ['numero' => 91, 'nombre' => 'Cloyster'],
    ['numero' => 92, 'nombre' => 'Gastly'],
    ['numero' => 93, 'nombre' => 'Haunter'],
    ['numero' => 94, 'nombre' => 'Gengar'],
    ['numero' => 95, 'nombre' => 'Onix'],
    ['numero' => 96, 'nombre' => 'Drowzee'],
    ['numero' => 97, 'nombre' => 'Hypno'],
    ['numero' => 98, 'nombre' => 'Krabby'],
    ['numero' => 99, 'nombre' => 'Kingler'],
    ['numero' => 100, 'nombre' => 'Voltorb'],
    ['numero' => 101, 'nombre' => 'Electrode'],
    ['numero' => 102, 'nombre' => 'Exeggcute'],
    ['numero' => 103, 'nombre' => 'Exeggutor'],
    ['numero' => 104, 'nombre' => 'Cubone'],
    ['numero' => 105, 'nombre' => 'Marowak'],
    ['numero' => 106, 'nombre' => 'Hitmonlee'],
    ['numero' => 107, 'nombre' => 'Hitmonchan'],
    ['numero' => 108, 'nombre' => 'Lickitung'],
    ['numero' => 109, 'nombre' => 'Koffing'],
    ['numero' => 110, 'nombre' => 'Weezing'],
    ['numero' => 111, 'nombre' => 'Rhyhorn'],
    ['numero' => 112, 'nombre' => 'Rhydon'],
    ['numero' => 113, 'nombre' => 'Chansey'],
    ['numero' => 114, 'nombre' => 'Tangela'],
    ['numero' => 115, 'nombre' => 'Kangaskhan'],
    ['numero' => 116, 'nombre' => 'Horsea'],
    ['numero' => 117, 'nombre' => 'Seadra'],
    ['numero' => 118, 'nombre' => 'Goldeen'],
    ['numero' => 119, 'nombre' => 'Seaking'],
    ['numero' => 120, 'nombre' => 'Staryu'],
    ['numero' => 121, 'nombre' => 'Starmie'],
    ['numero' => 122, 'nombre' => 'Mr. Mime'],
    ['numero' => 123, 'nombre' => 'Scyther'],
    ['numero' => 124, 'nombre' => 'Jynx'],
    ['numero' => 125, 'nombre' => 'Electabuzz'],
    ['numero' => 126, 'nombre' => 'Magmar'],
    ['numero' => 127, 'nombre' => 'Pinsir'],
    ['numero' => 128, 'nombre' => 'Tauros'],
    ['numero' => 129, 'nombre' => 'Magikarp'],
    ['numero' => 130, 'nombre' => 'Gyarados'],
    ['numero' => 131, 'nombre' => 'Lapras'],
    ['numero' => 132, 'nombre' => 'Ditto'],
    ['numero' => 133, 'nombre' => 'Eevee'],
    ['numero' => 134, 'nombre' => 'Vaporeon'],
    ['numero' => 135, 'nombre' => 'Jolteon'],
    ['numero' => 136, 'nombre' => 'Flareon'],
    ['numero' => 137, 'nombre' => 'Porygon'],
    ['numero' => 138, 'nombre' => 'Omanyte'],
    ['numero' => 139, 'nombre' => 'Omastar'],
    ['numero' => 140, 'nombre' => 'Kabuto'],
    ['numero' => 141, 'nombre' => 'Kabutops'],
    ['numero' => 142, 'nombre' => 'Aerodactyl'],
    ['numero' => 143, 'nombre' => 'Snorlax'],
    ['numero' => 144, 'nombre' => 'Articuno'],
    ['numero' => 145, 'nombre' => 'Zapdos'],
    ['numero' => 146, 'nombre' => 'Moltres'],
    ['numero' => 147, 'nombre' => 'Dratini'],
    ['numero' => 148, 'nombre' => 'Dragonair'],
    ['numero' => 149, 'nombre' => 'Dragonite'],
    ['numero' => 150, 'nombre' => 'Mewtwo'],
    ['numero' => 151, 'nombre' => 'Mew']
];


// Configuración inicial del PDF
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode("Pokémon"), 0, 1, 'C');

// Logo
$pdf->Image($logo, 10, 20, 30);
$pdf->Ln(20);

// Título
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode("Listado de pokemons - $generacion - $pokedex"), 0, 1, 'C');
$pdf->Ln(10);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, utf8_decode('Número'), 1, 0, 'C');
$pdf->Cell(40, 10, utf8_decode('Nombre'), 1, 1, 'C');

// Contenido de la tabla
$pdf->SetFont('Arial', '', 10);
foreach ($pokemons as $pokemon) {
    $pdf->Cell(40, 10, utf8_decode($pokemon['numero']), 1, 0, 'C');
    $pdf->Cell(40, 10, utf8_decode($pokemon['nombre']), 1, 1, 'C');
}

// Salida del PDF
$pdf->Output('D', utf8_decode('Listado_Pokémon.pdf')); // Guarda el PDF como archivo
?>
