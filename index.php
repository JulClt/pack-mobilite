<?php 
    
require 'vendor/autoload.php';

//Manage content flash message
define("MESSAGE", serialize(array(
    "sent"        => "Super ! Un mail vous a été envoyé afin de bien confirmer votre adresse e-mail.",
    "invalid"     => "Oups, votre e-mail n'est pas valide.",
    "empty"       => "Vous devez vous indiquer votre e-mail. Merci.",
    "already_sub" => "Ah... bonne nouvelle vous êtes déjà inscrit ou déjà membre de l'association."
)));

//AERP list ID
define("AERP_ID", 'da02a34338');

//API Connection
$mc = new Mailchimp('127f6d0850de5528f4b9b4703ae01b03-us4');

if(isset($_POST['email'])){
    
    extract($_POST);
    $message = unserialize(MESSAGE);

    if (!empty($_POST['email'])){
        $error = '';
        //Check email
        if (preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $email)){
            
            //Send email to MailChimp
            try {
                $mc->lists->subscribe(AERP_ID, array('email'=>$email));
                
                //Flash message : E-mail sent to the list!
                $flash = '<p class="flash email-valid">'.$message['sent'].'</p>';
            } catch (Mailchimp_Error $e) {
                //If already subscribed 
                if ($e->getCode() === 214)
                    $flash = '<p class="flash email-valid">'.$message['already_sub'].'</p>';
            }
        }else{
            $helpError = true; // Set input email value with the incorrect email
            
            //Flash message error (invalid mail)
            $flash = '<p class="flash email-error">'.$message['invalid'].'</p>';
        }
    } else {
        //Flash message error (empty field)
        $flash = '<p class="flash email-error">'.$message['empty'].'</p>';
    }
}

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>L'AERP vous présente son Pack Mobilité</title>

    <!-- Bootstrap Core CSS -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/freelancer.css" rel="stylesheet" type="text/css">
    <link href="css/custom-style.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- IE8 support for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">L'AERP vous présente...</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="http://www.aerp.fr">Aller sur le site</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="container">
            <div class="row page-scroll">
                <div class="col-sm-1"></div>
                <a href="#pack-mobilite" class="col-sm-4 item-pack">
                    <span class="name">Pack Mobilité</span>
                </a>
                <div class="col-sm-2 operation-plus">
                    <i class="fa fa-plus"></i>
                </div>
                <a href="#pack-toulezour" class="col-sm-4 item-pack">
                    <span class="name">Pack Toulezour</span>
                </a>
                <!-- <div class="col-lg-12">
                    <img class="img-responsive" src="img/profile.png" alt="">
                    <div class="intro-text">
                        <i class="fa fa-plane"></i>
                        <span class="name">Facilitez votre mobilité.</span>
                        <span class="skills">Facilitez votre logement, votre emploi, vos études... le tout dans un seul et unique <strong>pack mobilité</strong>.</span>
                    </div>
                </div> -->
            </div>
            <div class="row">
                <div class="col-lg-12 item-result">
                    <span> Un Réunionnais au TOP à Paris</span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="subscribe-form" action="index.php" method="post">
                        <input value="<?php if($helpError) echo $email; ?>" type="text" name="email" id="email" class="input-lg form-control" placeholder="Mon adresse mail">
                        <input type="submit" class="btn btn-primary btn-lg" value="Y accéder !">
                    </form>
                    <?php if($flash) echo $flash; ?>
                </div>
            </div>
        </div>
    </header>

    <section id="pack-mobilite" class="pack">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Le Pack Mobilité</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 pack-item">
                    <div class="name">Logement</div>
                    <a href="#portfolioModal1" class="pack-link" data-toggle="modal">  
                        <div class="caption">
                            <div class="caption-content">
                                L'AERP a produit <strong>le Guide du Logement</strong>, téléchargeable gratuitement. 
                            </div>
                        </div>
                        <img src="img/pack-mobilite/logement.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Mobilité</div>
                    <a href="#portfolioModal2" class="pack-link" data-toggle="modal">  
                        <div class="caption">
                            <div class="caption-content">
                                Le <strong>Réseau Albius</strong> vous met en contact avec des Réunionnais déjà installés en métropole pour vous aider.
                            </div>
                        </div>
                        <img src="img/pack-mobilite/reseaualbius.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Financer ses études</div>
                    <a href="#portfolioModal4" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <strong>RésoPlus</strong> permet est un service proposé par la BRED à destination des étudiants ultra-marins.
                            </div>
                        </div>
                        <img src="img/pack-mobilite/resoplus.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Aide aux démarches</div>
                    <a href="#portfolioModal3" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                L'AERP a créé pour vous, en partenariat avec le Conseil
                                Général, <strong>un guide afin de vous retrouver dans toutes les démarches à
                                entreprendre avant et pendant votre installation</strong>.
                            </div>
                        </div>
                        <img src="img/pack-mobilite/demarches.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">NeoSquat</div>
                    <a href="#portfolioModal5" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <strong>NeoSquat</strong> permet aux étudiants de louer leurs meubles plutôt que de les acheter.
                            </div>
                        </div>
                        <img src="img/pack-mobilite/neosquat.png" class="img-responsive" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="pack-toulezour" class="pack">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Le Pack Toulezour</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 pack-item">
                    <div class="name">Emploi</div>
                    <a href="#portfolioModal1" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                Avec les <strong>ateliers coaching d'Akelio</strong> vous recevez de précieux conseils (CV, lettres de motivation, entretiens d'embauche) et vous bénéficiez d'un réseau de networking.
                            </div>
                        </div>
                        <img src="img/pack-integration/ateliercoaching.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Stage</div>
                    <a href="#portfolioModal2" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                <strong>Businexthome</strong> vous propose des hébergements proches de votre lieu de stage.
                            </div>
                        </div>
                        <img src="img/pack-integration/businexthome.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Produit Pei</div>
                    <a href="#portfolioModal3" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                Conçu par l'AERP, <strong>Produit Péi</strong> a pour but de référencer les produits réunionnais sur Paris en un seul endroit.
                            </div>
                        </div>
                        <img src="img/pack-integration/produitpei.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Vie parisienne</div>
                    <a href="#portfolioModal4" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                Profitez <strong>d'activités proposées et/ou organisées par l'AERP</strong>
                                comme des visites, conférences et autres tournois sportifs.
                            </div>
                        </div>
                        <img src="img/portfolio/game.png" class="img-responsive" alt="" />
                    </a>
                </div>
                <div class="col-sm-4 pack-item">
                    <div class="name">Vie associative de l'AERP</div>
                    <a href="#portfolioModal5" class="pack-link" data-toggle="modal">
                        <div class="caption">
                            <div class="caption-content">
                                Vous avez envie <strong>d'initier, de participer ou de diriger
                                des projets innovants</strong> pour les Réunionnais ? L'AERP n'hésite pas à mobiliser
                                ses membres pour améliorer la vie ds étudiants réunionnais à Paris.
                            </div>
                        </div>
                        <img src="img/pack-integration/aerp.png" class="img-responsive" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>A propos</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4">
                    <p>Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Nous contacter</h3>
                        <p>
                            Maison des Association du 12ème<br>
                            Boîte 53 - 181 Avenue Daumesnil 
                            Paris, France, 75012
                        </p>
                        <p>
                            <a href="mailto:contact@aerp.fr">contact@aerp.fr</a>
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Retrouvez-nous sur</h3>
                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/pages/AERP-Association-des-Etudiants-R%C3%A9unionnais-de-Paris/128613610537576" class="btn-social btn-outline" target="blank"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li><a href="https://plus.google.com/u/0/b/108299826264224533204/+AerpFr974/about" class="btn-social btn-outline" target="blank"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li><a href="https://twitter.com/AERParis" class="btn-social btn-outline" target="blank"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li><a href="https://www.linkedin.com/company/aerp" class="btn-social btn-outline" target="blank"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>RDV sur aerp.fr</h3>
                        <p>
                            Accéder directement au site : <a href="http://www.aerp.fr">aerp.fr</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; 2014 - AERP
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="scroll-top page-scroll">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i> Accéder aux packs
        </a>
    </div>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/freelancer.js"></script>

</body>

</html>
