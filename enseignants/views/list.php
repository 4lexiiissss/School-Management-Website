<div class="dtitle w3-container w3-teal">
    Liste des enseigants
</div>

<form class="w3-container" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
    <input type="text" name="nom" placeholder="Rechercher par nom" value="<?= htmlspecialchars($nomFiltre); ?>">
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Numéro Enseignant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Fonction</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($enseignants)): ?>
            <?php foreach ($enseignants as $enseignant): ?>
                <tr>
                    <td><?= htmlspecialchars($enseignant['numens']); ?></td>
                    <td><?= htmlspecialchars($enseignant['nomens']); ?></td>
                    <td><?= htmlspecialchars($enseignant['preens']); ?></td>
                    <td><?= htmlspecialchars($enseignant['foncens']); ?></td>
                    <td>
                        <form action="index.php?element=enseignants&action=card" method="POST">
                            <input type="hidden" name="numens" value="<?= htmlspecialchars($enseignant['numens']); ?>">
                            <button type="submit" name="voir_enseignant" class="w3-btn w3-blue w3-padding-large w3-block">
                                Voir
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="w3-center">Aucun enseignant trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>