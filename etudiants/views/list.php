<div class="dtitle w3-container w3-teal">
    Liste des étudiants
</div>

<form class="w3-container" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
    <input type="text" name="nom" placeholder="Rechercher par nom" value="<?= htmlspecialchars($nomFiltre); ?>">
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Numéro étudiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Année</th>
            <th>Sexe</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($etudiants)): ?>
            <?php foreach ($etudiants as $etudiant): ?>
                <tr>
                    <td><?= htmlspecialchars($etudiant['numetu']); ?></td>
                    <td><?= htmlspecialchars($etudiant['nometu']); ?></td>
                    <td><?= htmlspecialchars($etudiant['prenometu']); ?></td>
                    <td><?= htmlspecialchars($etudiant['annetu']); ?></td>
                    <td><?= htmlspecialchars($etudiant['sexetu']); ?></td>
                    <td>
                        <form action="index.php?element=etudiants&action=card" method="POST">
                            <input type="hidden" name="numetu" value="<?= htmlspecialchars($etudiant['numetu']); ?>">
                            <button type="submit" name="voir_etudiant" class="w3-btn w3-blue w3-padding-large w3-block">
                                Voir
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="w3-center">Aucun étudiant trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>