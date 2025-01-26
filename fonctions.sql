CREATE OR REPLACE PROCEDURE ajout_etudiant(
    num IN etudiants.numetu%TYPE,
    nom IN etudiants.nometu%TYPE,
    prenom IN etudiants.prenometu%TYPE,
    adresse IN etudiants.adretu%TYPE,
    ville IN etudiants.viletu%TYPE,
    cpe IN etudiants.cpetu%TYPE,
    tel IN etudiants.teletu%TYPE,
    dateentre IN etudiants.datentetu%TYPE,
    anne IN etudiants.annetu%TYPE,
    remarque IN etudiants.remetu%TYPE,
    sexe IN etudiants.sexetu%TYPE,
    datenai IN etudiants.datnaietu%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    IF EXISTS (
        SELECT 1 
        FROM etudiants 
        WHERE numetu = num 
          AND nometu = nom 
          AND prenometu = prenom 
          AND adretu = adresse 
          AND viletu = ville 
          AND cpetu = cpe 
          AND teletu = tel 
          AND datentetu = dateentre 
          AND annetu = anne 
          AND remetu = remarque 
          AND sexetu = sexe 
          AND datnaietu = datenai
    ) THEN
        RAISE EXCEPTION USING MESSAGE = 'Cet étudiant existe déjà';
    END IF;

    INSERT INTO etudiants (
        numetu, nometu, prenometu, adretu, viletu, cpetu, teletu, datentetu, annetu, remetu, sexetu, datnaietu
    )
    VALUES (
        num, nom, prenom, adresse, ville, cpe, tel, dateentre, anne, remarque, sexe, datenai
    );

END;
$$;



CREATE OR REPLACE FUNCTION fetch_etudiant(num IN etudiants.numetu%TYPE)
RETURNS TABLE (
    numetu etudiants.numetu%TYPE,
    nometu etudiants.nometu%TYPE,
    prenometu etudiants.prenometu%TYPE,
    adretu etudiants.adretu%TYPE,
    viletu etudiants.viletu%TYPE,
    cpetu etudiants.cpetu%TYPE,
    teletu etudiants.teletu%TYPE,
    datentetu etudiants.datentetu%TYPE,
    annetu etudiants.annetu%TYPE,
    remetu etudiants.remetu%TYPE,
    sexetu etudiants.sexetu%TYPE,
    datnaietu etudiants.datnaietu%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT e.numetu, e.nometu, e.prenometu, e.adretu, e.viletu, e.cpetu, 
           e.teletu, e.datentetu, e.annetu, e.remetu, e.sexetu, e.datnaietu
    FROM etudiants e
    WHERE e.numetu = num;
END;
$$;

CREATE OR REPLACE FUNCTION modif_etudiant(
    num IN etudiants.numetu%TYPE,
    nom IN etudiants.nometu%TYPE,
    prenom IN etudiants.prenometu%TYPE,
    adresse IN etudiants.adretu%TYPE,
    ville IN etudiants.viletu%TYPE,
    cpe IN etudiants.cpetu%TYPE,
    tel IN etudiants.teletu%TYPE,
    dateentre IN etudiants.datentetu%TYPE,
    anne IN etudiants.annetu%TYPE,
    remarque IN etudiants.remetu%TYPE,
    sexe IN etudiants.sexetu%TYPE,
    datenai IN etudiants.datnaietu%TYPE
)
RETURNS VOID
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE etudiants
    SET
        nometu = nom,
        prenometu = prenom,
        adretu = adresse,
        viletu = ville,
        cpetu = cpe,
        teletu = tel,
        datentetu = dateentre,
        annetu = anne,
        remetu = remarque,
        sexetu = sexe,
        datnaietu = datenai
    WHERE numetu = num;
    
END;
$$;

--------- ENSEIGNANT ------------

CREATE OR REPLACE PROCEDURE ajout_enseignant(
    num IN enseignants.numens%TYPE,
    nom IN enseignants.nomens%TYPE,
    prenom IN enseignants.preens%TYPE,
    fonction IN enseignants.foncens%TYPE,
    adresse IN enseignants.adrens%TYPE,
    ville IN enseignants.vilens%TYPE,
    cpe IN enseignants.cpens%TYPE,
    tel IN enseignants.telens%TYPE,
    datenai IN enseignants.datnaiens%TYPE,
    dateemb IN enseignants.datembens%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM enseignants
        WHERE numens = num
          AND nomens = nom
          AND preens = prenom
          AND foncens = fonction
          AND adrens = adresse
          AND vilens = ville
          AND cpens = cpe
          AND telens = tel
          AND datnaiens = datenai
          AND datembens = dateemb
    ) THEN
        RAISE EXCEPTION 'Cet enseignant existe déjà.';
    END IF;

    INSERT INTO enseignants (
        numens, nomens, preens, foncens, adrens, vilens, cpens, telens, datnaiens, datembens
    )
    VALUES (
        num, nom, prenom, fonction, adresse, ville, cpe, tel, datenai, dateemb
    );

END;
$$;


CREATE OR REPLACE FUNCTION modif_enseignant(
    num IN enseignants.numens%TYPE,
    nom IN enseignants.nomens%TYPE,
    prenom IN enseignants.preens%TYPE,
    fonction IN enseignants.foncens%TYPE,
    adresse IN enseignants.adrens%TYPE,
    ville IN enseignants.vilens%TYPE,
    cpe IN enseignants.cpens%TYPE,
    tel IN enseignants.telens%TYPE,
    datenai IN enseignants.datnaiens%TYPE,
    dateemb IN enseignants.datembens%TYPE
)
RETURNS VOID
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE enseignants
    SET
        nomens = nom,
        preens = prenom,
        foncens = fonction,
        adrens = adresse,
        vilens = ville,
        cpens = cpe,
        telens = tel,
        datnaiens = datenai,
        datembens = dateemb
    WHERE numens = num;
END;
$$;

CREATE OR REPLACE FUNCTION fetch_enseignant(num IN enseignants.numens%TYPE)
RETURNS TABLE (
    numens enseignants.numens%TYPE,
    nomens enseignants.nomens%TYPE,
    preens enseignants.preens%TYPE,
    foncens enseignants.foncens%TYPE,
    adrens enseignants.adrens%TYPE,
    vilens enseignants.vilens%TYPE,
    cpens enseignants.cpens%TYPE,
    telens enseignants.telens%TYPE,
    datnaiens enseignants.datnaiens%TYPE,
    datembens enseignants.datembens%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT e.numens, e.nomens, e.preens, e.foncens, e.adrens, e.vilens,
           e.cpens, e.telens, e.datnaiens, e.datembens
    FROM enseignants e
    WHERE e.numens = num;
END;
$$;

--------- MODULE ------------

CREATE OR REPLACE PROCEDURE ajout_module(
    num IN modules.nummod%TYPE,
    nom IN modules.nommod%TYPE,
    coef IN modules.coefmod%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM modules
        WHERE nummod = num
    ) THEN
        RAISE EXCEPTION 'Le module avec le numéro % existe déjà.', num;
    END IF;

    INSERT INTO modules (
        nummod, nommod, coefmod
    )
    VALUES (
        num, nom, coef
    );

END;
$$;

CREATE OR REPLACE FUNCTION modif_module(
    num IN modules.nummod%TYPE,
    nom IN modules.nommod%TYPE,
    coef IN modules.coefmod%TYPE
)
RETURNS VOID
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE modules
    SET
        nommod = nom,
        coefmod = coef
    WHERE nummod = num;
END;
$$;

CREATE OR REPLACE FUNCTION fetch_module(num IN modules.nummod%TYPE)
RETURNS TABLE (
    nummod modules.nummod%TYPE,
    nommod modules.nommod%TYPE,
    coefmod modules.coefmod%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT m.nummod, m.nommod, m.coefmod
    FROM modules m
    WHERE m.nummod = num;
END;
$$;


--------- MATIERE ------------

CREATE OR REPLACE PROCEDURE ajout_matiere(
    num IN matieres.nummat%TYPE,
    nom IN matieres.nommat%TYPE,
    nummod IN matieres.nummod%TYPE,
    coef IN matieres.coefmat%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM matieres
        WHERE nummat = num
    ) THEN
        RAISE EXCEPTION 'La matière avec le numéro % existe déjà.', num;
    END IF;

    INSERT INTO matieres (
        nummat, nommat, nummod, coefmat
    )
    VALUES (
        num, nom, nummod, coef
    );

END;
$$;

CREATE OR REPLACE FUNCTION modif_matiere(
    num IN matieres.nummat%TYPE,
    nom IN matieres.nommat%TYPE,
    new_nummod IN matieres.nummod%TYPE,  
    coef IN matieres.coefmat%TYPE
)
RETURNS VOID
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE matieres
    SET
        nommat = nom,
        nummod = new_nummod,  -
        coefmat = coef
    WHERE nummat = num;
END;
$$;


CREATE OR REPLACE FUNCTION fetch_matiere(num IN matieres.nummat%TYPE)
RETURNS TABLE (
    nummat matieres.nummat%TYPE,
    nommat matieres.nommat%TYPE,
    nummod matieres.nummod%TYPE,
    coefmat matieres.coefmat%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT m.nummat, m.nommat, m.nummod, m.coefmat
    FROM matieres m
    WHERE m.nummat = num;
END;
$$;


--------- EPREUVE ------------

CREATE OR REPLACE PROCEDURE ajout_epreuve(
    num IN epreuves.numepr%TYPE,
    lib IN epreuves.libepr%TYPE,
    enseignant IN epreuves.ensepr%TYPE,
    matiere IN epreuves.matepr%TYPE,
    dat IN epreuves.datepr%TYPE,
    coef IN epreuves.coefepr%TYPE,
    annee IN epreuves.annepr%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    IF EXISTS (
        SELECT 1
        FROM epreuves
        WHERE numepr = num
    ) THEN
        RAISE EXCEPTION 'L''épreuve avec le numéro % existe déjà.', num;
    END IF;

    INSERT INTO epreuves (
        numepr, libepr, ensepr, matepr, datepr, coefepr, annepr
    )
    VALUES (
        num, lib, enseignant, matiere, dat, coef, annee
    );

END;
$$;

CREATE OR REPLACE FUNCTION modif_epreuve(
    num IN epreuves.numepr%TYPE,
    lib IN epreuves.libepr%TYPE,
    enseignant IN epreuves.ensepr%TYPE,
    matiere IN epreuves.matepr%TYPE,
    dat IN epreuves.datepr%TYPE,
    coef IN epreuves.coefepr%TYPE,
    annee IN epreuves.annepr%TYPE
)
RETURNS VOID
LANGUAGE plpgsql
AS $$
BEGIN
    UPDATE epreuves
    SET
        libepr = lib,
        ensepr = enseignant,
        matepr = matiere,
        datepr = dat,
        coefepr = coef,
        annepr = annee
    WHERE numepr = num;

END;
$$;

CREATE OR REPLACE FUNCTION fetch_epreuve(num IN epreuves.numepr%TYPE)
RETURNS TABLE (
    numepr epreuves.numepr%TYPE,
    libepr epreuves.libepr%TYPE,
    ensepr epreuves.ensepr%TYPE,
    matepr epreuves.matepr%TYPE,
    datepr epreuves.datepr%TYPE,
    coefepr epreuves.coefepr%TYPE,
    annepr epreuves.annepr%TYPE
)
LANGUAGE plpgsql
AS $$
BEGIN
    RETURN QUERY
    SELECT e.numepr, e.libepr, e.ensepr, e.matepr, e.datepr, e.coefepr, e.annepr
    FROM epreuves e
    WHERE e.numepr = num;
END;
$$;

--------- NOTE ------------

CREATE OR REPLACE FUNCTION ajout_note(
    p_numepr INT,      
    p_numetu INT,      
    p_note INT         
)
RETURNS VOID AS $$
BEGIN
    INSERT INTO avoir_note (numepr, numetu, note)
    VALUES (p_numepr, p_numetu, p_note);
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION modif_note(
    p_numepr INT,      
    p_numetu INT,    
    p_note INT        
)
RETURNS VOID AS $$
BEGIN
    IF EXISTS (SELECT 1 FROM avoir_note WHERE numetu = p_numetu AND numepr = p_numepr) THEN
        UPDATE avoir_note
        SET note = p_note
        WHERE numetu = p_numetu AND numepr = p_numepr;
    ELSE
        RAISE EXCEPTION 'Note non trouvee pour l''etudiant % et l''epreuve %', p_numetu, p_numepr;
    END IF;
END;
$$ LANGUAGE plpgsql;
