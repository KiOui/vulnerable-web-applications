<h3>Superheldenprofiel voor Power Surge</h3>
<?php
if (!isset($_GET['secret']) || $_GET["secret"] !== "5a89cbf7499a5a172f44951765be85dc") {
    die("Deze pagina is alleen zichtbaar met het persoonlijke geheim van Power Surge");
}


    $flag = file_get_contents("/tmp/flag.txt");

    echo '<table class="table table-striped table-hover">';
    echo '<thead><tr><th></th><th></th></tr></thead>';

    echo '<tr>';
    echo '<td scope="row">Superheldennaam:</td>';
    echo '<td>Power Surge</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<td>Oorspronkelijke naam:</td>';
    echo '<td>Sarah Voltage</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Leeftijd</th>';
    echo '<td>29</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Locatie</th>';
    echo '<td>Electra City, Energieland</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Krachten</th>';
    echo '<td>Stroomopwekking, Energieveldcreatie, Vliegsnelheid</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Missies Voltooid</th>';
    echo '<td>89</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Tijd besteed aan het beschermen van de stad</th>';
    echo '<td>3.200.000 minuten</td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Favoriete missie:</th>';
    echo '<td><iframe width="560" height="315" 
        src="https://www.youtube.com/embed/gqs8bRMhBgA" 
        frameborder="0" allow="accelerometer; autoplay; 
        clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen></iframe></td></tr>';
    echo '</tr>';

    echo '<tr>';
    echo '<th scope="row">Flag</th>';
    echo "<td> $flag</td></tr>";
    echo '</tr>';

    echo '</table>';
?>
