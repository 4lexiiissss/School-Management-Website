<div class="dtitle w3-container w3-teal">
    Création d'un nouvel étudiant
</div>
<form class="w3-container" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-third">
                <label class="w3-text-blue"><b>Numéro étudiant</b></label>
                <input type="number" class="w3-input w3-border" name="numetu" placeholder="Saisissez un numéro étudiant" value="<?= isset($data['numetu']) ? $data['numetu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Nom</b></label>
                <input type="text" class="w3-input w3-border" name="nometu" placeholder="Saisissez un nom" value="<?= isset($data['nometu']) ? $data['nometu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Prénom</b></label>
                <input type="text" class="w3-input w3-border" name="prenometu" placeholder="Saisissez un prénom" value="<?= isset($data['prenometu']) ? $data['prenometu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Adresse</b></label>
                <input type="text" class="w3-input w3-border" name="adretu" placeholder="Saisissez une adresse" value="<?= isset($data['adretu']) ? $data['adretu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Ville</b></label>
                <input type="text" class="w3-input w3-border" name="viletu" placeholder="Saisissez une ville" value="<?= isset($data['viletu']) ? $data['viletu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Code postal</b></label>
                <input type="number" class="w3-input w3-border" name="cpetu" placeholder="Saisissez un code postal" value="<?= isset($data['cpetu']) ? $data['cpetu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Numéro de téléphone</b></label>
                <input type="number" class="w3-input w3-border" name="teletu" placeholder="Saisissez un numéro de téléphone" value="<?= isset($data['teletu']) ? $data['teletu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Date d'entrée</b></label>
                <input type="date" class="w3-input w3-border" name="datentetu" value="<?= isset($data['datentetu']) ? $data['datentetu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Année</b></label>
                <input type="number" class="w3-input w3-border" name="annetu" placeholder="Saisissez une année" value="<?= isset($data['annetu']) ? $data['annetu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Remarque</b></label>
                <input type="text" class="w3-input w3-border" name="remetu" placeholder="Saisissez une remarque" value="<?= isset($data['remetu']) ? $data['remetu'] : ''; ?>" />
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Sexe</b></label>
                <select class="w3-select w3-border" name="sexetu">
                    <option value="" disabled selected>Choisissez le sexe</option>
                    <option value="M" <?= (isset($data['sexetu']) && $data['sexetu'] === 'M') ? 'selected' : ''; ?>>Masculin</option>
                    <option value="F" <?= (isset($data['sexetu']) && $data['sexetu'] === 'F') ? 'selected' : ''; ?>>Féminin</option>
                </select>
            </div>
            <div class="w3-third">
                <label class="w3-text-blue"><b>Date de naissance</b></label>
                <input type="date" class="w3-input w3-border" name="datnaietu" value="<?= isset($data['datnaietu']) ? $data['datnaietu'] : ''; ?>" />
            </div> 
        </div>
        <br />
        <div class="w3-row-padding">
            <div class="w3-half w3-right">
                <input class="w3-btn w3-blue-grey" type="submit" name="confirm_envoyer" value="Créer l'étudiant" />
            </div>
            <div class="w3-half">
                <input class="w3-btn w3-red" type="submit" name="cancel" value="Annuler" />
            </div>
        </div>
    </div>
</form>
