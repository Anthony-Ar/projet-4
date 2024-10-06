<?php
include_once './partial/header.html';

if(isset($_POST['submit'])) {
    $data = $_POST;

    if(empty($data['name'])
        || trim($data['name']) == '')
    {
        $name_error = '<p class="input-error">Veuillez entrer un titre correct.</p>';
    }

    if(empty($data['author'])
        || trim($data['author']) == '')
    {
        $author_error = '<p class="input-error">Veuillez entrer un nom d\'auteur correct.</p>';
    }

    if(empty($data['description'])
        || strlen($data['description']) < 3
        || trim($data['description']) == '')
    {
        $description_error = '<p class="input-error">La description de l\'œuvre doit faire au moins 3 caractères.</p>';
    }

    if(!filter_var($data['image'], FILTER_VALIDATE_URL)
        || empty($data['image'])
        || trim($data['image']) == '')
    {
        $image_error = '<p class="input-error">Veuillez entrer le lien vers l\'illustration de l\'œuvre dans un format correct.</p>';
    }

    if(!isset($name_error) && !isset($author_error) && !isset($description_error) && !isset($image_error)) {
        require_once './config/database.php';
        $request = $db->prepare("INSERT INTO artworks (name, author, description, image) VALUES (:name, :author, :description, :image)");
        $request->bindValue(':name', htmlspecialchars($data['name']));
        $request->bindValue(':author', htmlspecialchars($data['author']));
        $request->bindValue(':description', htmlspecialchars($data['description']));
        $request->bindValue(':image', htmlspecialchars($data['image']));
        $request->execute();

        header('Location: index.php');
    }
}
?>

<form action="createArtwork.php" method="POST">
    <div class="form-element">
        <label for="name">Titre de l'œuvre</label>
        <input type="text" name="name" id="name" placeholder="Titre de l'œuvre"
               value="<?php if(isset($_POST['name'])) {
                   echo htmlspecialchars($_POST['name']);
               } ?>"/>
        <?php if (isset($name_error)) {
            echo $name_error;
        } ?>
    </div>

    <div  class="form-element">
        <label for="author">Auteur</label>
        <input type="text" name="author" id="author" placeholder="Auteur de l'œuvre"
               value="<?php if(isset($_POST['author'])) {
                   echo htmlspecialchars($_POST['author']);
               } ?>"/>
        <?php if (isset($author_error)) {
            echo $author_error;
        } ?>
    </div>

    <div  class="form-element">
        <label for="description">Description de l'œuvre</label>
        <textarea rows="15" name="description" id="description" placeholder="Description de l'œuvre"><?php if(isset($_POST['description'])) {
                echo htmlspecialchars($_POST['description']);
            } ?></textarea>
        <?php if (isset($description_error)) {
            echo $description_error;
        } ?>
    </div>

    <div  class="form-element">
        <label for="image">Lien vers l'illustration de l'œuvre</label>
        <input type="text" name="image" id="image" placeholder="Illustration de l'œuvre"
               value="<?php if(isset($_POST['image'])) {
                   echo htmlspecialchars($_POST['image']);
               } ?>"/>
        <?php if (isset($image_error)) {
            echo $image_error;
        } ?>
    </div>

    <input type="submit" name="submit" id="submit" value="Valider"/>
</form>

<?php include_once './partial/footer.html'; ?>
