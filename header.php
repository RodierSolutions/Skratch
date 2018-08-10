<?php include 'html-head.php'; ?>

<body> <!-- body tag closes in footer.php -->
  <header>

  <?php
    $site_title = get_bloginfo( 'name' );
    $site_description = get_bloginfo( 'description' );
  ?>

  <section>

    <h1>Site Name: <?php echo $site_title ?></h1>
    <h3>Tagline: <?php echo $site_description ?></h3>

    <nav>
      <?php wp_nav_menu( array( 'theme_location' => 'header-nav' ) ); ?>
    </nav>

  </section>

  </header>