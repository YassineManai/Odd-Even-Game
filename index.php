<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtm" Xml:lang="fr">

<head>
    <title>Ajout POO</title>
    <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
    <link href="styless.css" rel="stylesheet" type="text/css"/>

</head>

<body>

    <div class="body">
        <?php


        function chargerClasse($classname)
        {
            require $classname . '.class.php';
        }

        spl_autoload_register('chargerClasse');
        $Con = new PDO('mysql:host=localhost;dbname=bdjoueurs', 'root', '');
        $Con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


        $mysqli = new mysqli('localhost', 'root', '', 'bdjoueurs') or die(mysqli_error($mysqli));
        $res = $mysqli->query("SELECT DISTINCT(Nom),Prenom,Score FROM joueurs") or die($mysqli->error);
        // pre($res) ;
        /*pre($res->fetch_assoc());
    pre($res->fetch_assoc());
    function pre($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    } */
        ?>
        <style>
            th {
                border: 1px solid black;
                width: 300px;
            }


            .hide {

                position: fixed;
                left: 1500px;
                top: 350px;
                visibility: hidden;


            }

            #number {
                font-size: 90px;
            }

            .msgmil {
                color: #fff;
                position: absolute;
                top: 20%;
                left: 5%;
                font-size: 3rem;
                text-align: center;
                font-family: Copperplate, Papyrus, fantasy;
            }

            .msgerror {
                color: #fff;
                position: absolute;
                top: 40%;
                left: 3%;
                font-size: 3rem;
                text-align: center;
                font-family: Copperplate, Papyrus, fantasy;

            }

            h1 {
                color: #5d95f6;
                font-family: Copperplate, Papyrus, fantasy;
            }

            .msgwin {
                color: #4281ed;

                position: absolute;
                top: 20%;
                right: 3%;
                font-size: 3rem;
                font-family: Copperplate, Papyrus, fantasy;
                text-align: center;
            }

            .msg {
                color: #6c9df1;
                position: absolute;
                top: 20%;
                right: 20%;
                font-size: 3rem;
                font-family: Copperplate, Papyrus, fantasy;

            }

            .pic {
                left: 30px;
                position: relative;
            }
            
        </style>





        <form action="" method="post">
            <p>
            <div class="wrapper">
                <header> <div class="g">Pair/Impair</div></header>
                <section class="input-part">
                    <p class="info-txt"></p>
                    <div class="content">

                        <header> Nom: </header>
                        <input type="text" name="n" maxlength="30" onfocus="this.value=''" spellcheck="false" placeholder=" entrer votre Nom ">

                        <br>
                        <div class="separator"></div>

                        <header> Prenom: </header>
                        <input type="text" name="p" maxlength="30" onfocus="this.value=''" spellcheck="false" placeholder=" Entrer Votre Prenom ">
                        <br>
                        <br>
                        <div class="c">


                            <input type="submit" value="Crée joueur" name="creer" />
                            <input type="submit" value="Effacée joueur" name="Del" />
                            <input type="submit" value="Modifier joueur" name="mod" />
                            <input type="Button" onclick="hide1()" value="Demarer" name="Start" />
                            <input type="submit" value="Affichier le millieur Score " name="Mil" />

                        </div>
                    </div>

                    <header>Table de Joueurs </header>


                    <table>
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <?php
                        while ($row = $res->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['Nom']; ?></td>
                                <td><?php echo $row['Prenom']; ?></td>
                                <td><?php echo $row['Score']; ?></td>

                            </tr>
                        <?php endwhile; ?>
                    </table>



                </section>
            </div>



            <div class="hide">
                <h1>Essayer de deviner mon numéro : </h1>
                <div class="pic">
                    <img src="anime.png" width="400px" height="400px">
                </div>
                <br>
                <div class="input-part">
                    <div class="c">
                        <input type="Submit" value="Pair" name="Pair" />
                        <br>
                        <br>
                        <input type="submit" value="Impair" name="UmPair" />
                    </div>
                </div>


            </div>


        </form>
        <p id="random"></p>


        <?php

        $manager = new ManagerJoueurs($Con);
        if (isset($_POST['creer']) && isset($_POST['n']) && isset($_POST['p'])) {
            $jou = new Joueur(array('Nom' => $_POST['n'], 'Prenom' => $_POST['p']));

            $manager->ajouter($jou);
        }




        if (isset($_POST['Del']) && isset($_POST['n']) && isset($_POST['p'])) {
            $jou = $manager->recup($_POST['n']);
            $manager->Del($jou);
        }


        if (isset($_POST['mod']) && isset($_POST['n']) && isset($_POST['p'])) {
            $jou = $manager->recup($_POST['n']);
            $jou->setPrenom($_POST['p']);
            $manager->mod($jou);
        }

        /*  foreach ($tab as $key => $val ) {
               echo $val = $jou->afficheJouer();
            }*/


        if (isset($_POST['Pair']) && isset($_POST['n']) && isset($_POST['p'])) {

            $jou = $manager->recup($_POST['n']);
            $jou->getScore();
            $manager->check($jou);
        }
        if (isset($_POST['UmPair']) && isset($_POST['n']) && isset($_POST['p'])) {

            $jou = $manager->recup($_POST['n']);
            $jou->getScore();
            $manager->check1($jou);
        }
        if (isset($_POST['Mil'])) {
            $res = $mysqli->query("SELECT DISTINCT(Nom),Prenom,Score FROM joueurs WHERE Score = (SELECT MAX(Score) FROM joueurs )") or die($mysqli->error);
            $msg = $res->fetch_assoc();
            echo  "<span class='msgmil'> " . $msg['Score'] . " est le millieur score  <br><br>" . $msg['Nom'] . "  est Gagner !! </span> ";
        }




        ?>
    </div>
    <script src="index.js"></script>
</body>

</html>