<?php
//plik do obróbki
$file= "backlinki-lamai_pl.csv";

//nazwa pliku wyjœciowego
$file_new = "nowy_plik.csv";

//wczytuje ca³¹ zawartoœc do zmiennej i exploduje (dziele na tablice) j¹ po znaku konca linii
$content = explode("\n", file_get_contents($file));

//dodaje zmienna przechowujaca tablice
$tab = array();

//zmienna przechowujaca stringa do wrzucaia wynikow
$zapis = '';

//usuwam znak konca lini z kazdego elementu w tablicy
$content = str_replace(array("\r", "\n"), '', $content);

//pêtla która wykonuje coœ dla ka¿dego elementu w tablicy
foreach($content as $line){
	//przypisuje do zmiennej exp zawartoœæ elementów i exploduje po œrednikach
	$exp = explode(";", $line);
	//przypisuje zmiennej $tab alias oraz zawartosc talicy exp
	$tab[$exp[0]][] = $exp;
}
print "<b>-------------------</b><br>";
print "Wielkosci tab: <b>";
print $wielkosctab = sizeof($tab);
print "</b><br>";

print "Ilosc wszystkich wierszy: <b>";
print $rows = array_sum(array_map("count", $tab));
print "</b><br>";

//Obliczam max ilosc kolumn - cos tu jest nie tak xD
$maxilosckolumn = 0;

foreach($tab as $subarray){
    foreach ($subarray as $value){
		foreach ($value as $tmp){		
			$maxilosckolumn = ($maxilosckolumn < count($value) ? count($value) : $maxilosckolumn);   			
		}
    }
}

print "Max ilosc kolumn: <b>";
print $maxilosckolumn = 21;
print "</b><br>";
print "<b>-------------------</b><br>";

$licz=0;
foreach ($tab as $domain=>$item){
	if(count($item)<6){
		$tab_pom[$domain] = $item;
		print ($domain." ".count($item)."<br>");
		if ($licz > 3){ break; }
		$licz++;		
	}
}

foreach ($tab_pom as $item){
	for ($i=0; $i<count($item); $i++){
		for ($j=0; $j<$maxilosckolumn; $j++){
			echo $item[$i][$j].";";
			$zapis .= $item[$i][$j].";";
		}
		echo "<br>";
		$zapis .= "\n";
	}
}

print "<pre>";
var_export($tab_pom);
//print_r ($tab_pom);
print "</pre>";


//wyœwietlenie elementów tablicy
// print "<pre>";
// var_dump ($tab);
// print "</pre>";



//echo $do_zapisu;
//zapis do nowego pliku
$f = fopen("$file_new", "w");
fputcsv($f, array($zapis));
fclose($f);
exit;
?>