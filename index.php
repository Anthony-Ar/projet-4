<?php
require_once './config/database.php';
include_once './partial/header.html';
?>

<div id="liste-oeuvres">

    <?php
    $artworks = $db->query('SELECT * FROM artworks');
    $artworks = $artworks->fetchAll();

    foreach($artworks as $artwork) {
        echo '<article class="oeuvre">
                <a href="artwork.php?id='.htmlspecialchars($artwork['id']).'">
                    <img src="'.htmlspecialchars($artwork['image']).'" alt="'.htmlspecialchars($artwork['name']).'">
                    <h2>'.htmlspecialchars($artwork['name']).'</h2>
                    <p class="description">'.htmlspecialchars($artwork['author']).'</p>
                </a>
              </article>';
    } ?>

</div>

<?php include_once './partial/footer.html'; ?>
