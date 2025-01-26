<div class="dtitle w3-container w3-teal">
    Liste des Épreuves
</div>

<form class="w3-container" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
    <input type="text" name="nom" placeholder="Rechercher par libellé"
        value="<?= htmlspecialchars($nomFiltre ?? ''); ?>">
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Libellé</th>
            <th>Matière</th>
            <th>Enseignant</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($epreuves)): ?>
            <?php foreach ($epreuves as $epreuve): ?>
                <tr>
                    <td><?= htmlspecialchars($epreuve['numepr'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($epreuve['libepr'] ?? ''); ?></td>
                    <td>
                        <?php
                        $matiereStmt = $pdo->prepare("SELECT nommat FROM matieres WHERE nummat = :matepr");
                        $matiereStmt->execute([':matepr' => $epreuve['matepr']]);
                        $matiere = $matiereStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($matiere['nommat'] ?? '');
                        ?>
                    </td>
                    <td>
                        <?php
                        $enseignantStmt = $pdo->prepare("SELECT nomens, preens FROM enseignants WHERE numens = :ensepr");
                        $enseignantStmt->execute([':ensepr' => $epreuve['ensepr']]);
                        $enseignant = $enseignantStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars(($enseignant['preens'] ?? '') . ' ' . ($enseignant['nomens'] ?? ''));
                        ?>
                    </td>
                    <td><?= htmlspecialchars($epreuve['datepr'] ?? ''); ?></td>
                    <td>
                        <form action="index.php?element=epreuves&action=card" method="POST">
                            <input type="hidden" name="numepr" value="<?= htmlspecialchars($epreuve['numepr']); ?>">
                            <button type="submit" name="voir_epreuve" class="w3-btn w3-blue w3-padding-large w3-block">
                                Voir
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="w3-center">Aucune épreuve trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>