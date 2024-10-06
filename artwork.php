<?php
require_once './config/database.php';
include_once './partial/header.html';

if(!isset($_GET['id']))
{
    header('Location: index.php');
    exit;
} else {
    $artwork = $db->prepare("SELECT * FROM artworks WHERE id = :id");
    $artwork->execute(array('id' => $_GET['id']));
    $artwork = $artwork->fetch();

    if($artwork == null) {
        header('Location: index.php');
        exit;
    }
}
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?php echo htmlspecialchars($artwork['image']) ?>"
             alt="<?php echo htmlspecialchars($artwork['name']) ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?php echo $artwork['name'] ?></h1>
        <p class="description"><?php echo htmlspecialchars($artwork['author']) ?></p>
        <p class="description-complete"><?php echo htmlspecialchars($artwork['description']) ?></p>
    </div>
</article>

<?php include_once './partial/footer.html'; ?>
