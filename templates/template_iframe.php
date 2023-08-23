<?php
header('X-Frame-Options: SAMEORIGIN');

/*
  Template Name: The Iframe Template
 */

?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="author" content="Goku Gohan">
    <meta name="description"
          content="MTimor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste">
    <meta name="keywords"
          content="Municipality, Municipality Project, Municipality Point Of Interest, Point Of Interest">

    <!-- Open graph tags -->
    <meta property="og:title"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste">
    <meta property="og:type" content="map">
    <meta property="og:url" content="/images/municipality.png">
    <meta property="og:image" content="/images/municipality.png">
    <meta property="og:description"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste">
    <meta property="og:site_name"
          content="Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste">

    <meta property="article:author" content="https://www.facebook.com/helderchebre">
    <title>Timor-Leste Portal Municipal plataforma de dados para o desenvolvimento de Timor-Leste</title>

    <link rel="icon" type="image/x-icon"
          href="<?php echo get_stylesheet_directory_uri() . '/assets/img/favicon.ico' ?>">

    <style>

        body{
            margin: 0;
            padding: 0;
            overflow-y: hidden;
        }
        iframe{
            width: 100%;
            height: 100vh;
            border: 0;
        }

    </style>
</head>

<body>
<?php the_content(); ?>
</body>

</html>
