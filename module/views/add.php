<div class="dtitle w3-container w3-teal">
    Création d'un nouveau module
    
</div>
<form class="w3-container" action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST">
    <div class="dcontent">
        <div class="w3-row-padding">
            <div class="w3-half">
                <label class="w3-text-blue"><b>Numéro</b></label>
                <input type="number" class="w3-input w3-border" name="nummod" placeholder="Saisissez un numéro de module" value="<?= isset($data['nummod']) ? $data['nummod'] : ''; ?>" />
            </div>
            <div class="w3-half">
                <label class="w3-text-blue"><b>Nom</b></label>
                <input type="text" class="w3-input w3-border" name="nommod" placeholder="Saisissez un nom de module" value="<?= isset($data['nommod']) ? $data['nommod'] : ''; ?>" />
            </div>
            <div class="w3-first">
                <label class="w3-text-blue"><b>Coefficient</b></label>
                <input type="number" class="w3-input w3-border" name="coefmod" placeholder="Saisissez un coefficient de module" value="<?= isset($data['coefmod']) ? $data['coefmod'] : ''; ?>" />
            </div>
            
        </div>
        <br />
        <div class="w3-row-padding">
            <div class="w3-half w3-right">
                <input class="w3-btn w3-blue-grey" type="submit" name="confirm_envoyer" value="Créer le module" />
            </div>
            <div class="w3-half">
                <input class="w3-btn w3-red" type="submit" name="cancel" value="Annuler" />
            </div>
        </div>
</form>


