<h3>Superheldenprofiel voor Electro Pirate</h3>
        <?php
        if (!isset($_GET['secret']) || $_GET["secret"] !== "5a89cbf7499a5a172f44951765be85dc") {
            die("Deze pagina is alleen zichtbaar met het persoonlijke geheim van Electro Pirate");
        }
            $flag = file_get_contents("/tmp/flag.txt");
        ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr><th></th><th></th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">Superheldennaam:</td>
                        <td>Electro Pirate</td>
                    </tr>
                    <tr>
                        <td>Oorspronkelijke naam:</td>
                        <td>Alex Thunder</td>
                    </tr>
                    <tr>
                        <th scope="row">Leeftijd</th>
                        <td>38</td>
                    </tr>
                    <tr>
                        <th scope="row">Locatie</th>
                        <td>Neon City, Energieland</td>
                    </tr>
                    <tr>
                        <th scope="row">Krachten</th>
                        <td>Elektriciteitsbeheersing, Energieabsorptie, Supersnelheid</td>
                    </tr>
                    <tr>
                        <th scope="row">Missies Voltooid</th>
                        <td>102</td>
                    </tr>
                    <tr>
                        <th scope="row">Tijd besteed aan het beschermen van de stad</th>
                        <td>5.432.000 minuten</td>
                    </tr>
                    <tr>
                        <th scope="row">Favoriete missie:</th>
                        <td>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/TjpxRy9QwCI" 
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; 
                                gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">Flag</th>
                        <td><?php echo $flag; ?></td>
                    </tr>
                </tbody>
            </table>