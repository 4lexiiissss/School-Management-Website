<div class="dtitle w3-container w3-teal">
    Liste des matieres
</div>

<form class="w3-container" action="<?= htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="POST">
    <input type="text" name="nom" placeholder="Rechercher par nom" value="<?= htmlspecialchars($nomFiltre ?? ''); ?>">
    <button type="submit">Rechercher</button>
</form>

<table border="1">
    <thead>
        <tr>
            <th>Numéro matiére</th>
            <th>Nom</th>
            <th>Coefficient</th>
            <th>Module</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($matieres)): ?>
            <?php foreach ($matieres as $matiere): ?>
                <tr>
                    <td><?= htmlspecialchars($matiere['nummat'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($matiere['nommat'] ?? ''); ?></td>
                    <td><?= htmlspecialchars($matiere['coefmat'] ?? ''); ?></td>
                    <td>
                        <?php
                        $moduleStmt = $pdo->prepare("SELECT nommod FROM modules WHERE nummod = :nummod");
                        $moduleStmt->execute([':nummod' => $matiere['nummod']]);
                        $module = $moduleStmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($module['nommod'] ?? ''); 
                        ?>
                    </td>
                    <td>
                        <form action="index.php?element=matiere&action=card" method="POST">
                            <input type="hidden" name="nummat" value="<?= htmlspecialchars($matiere['nummat']); ?>">
                            <button type="submit" name="voir_matiere" class="w3-btn w3-blue w3-padding-large w3-block">
                                Voir
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="w3-center">Aucune matière trouvée.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>