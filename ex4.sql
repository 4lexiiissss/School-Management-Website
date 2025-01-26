CREATE OR REPLACE FUNCTION get_classement_par_epreuve(p_numepr INT)
RETURNS TABLE(
    numetu INT,
    nom VARCHAR,
    prenom VARCHAR,
    note INT,
    moyenne_globale NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        etu.numetu,
        etu.nometu AS nom,
        etu.prenometu AS prenom,
        anote.note,
        ROUND(AVG(anote.note) OVER (PARTITION BY etu.numetu), 2) AS moyenne_globale
    FROM 
        avoir_note anote
    JOIN 
        etudiants etu 
    ON 
        anote.numetu = etu.numetu
    WHERE 
        anote.numepr = p_numepr
    ORDER BY 
        anote.note DESC;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION get_classement_par_etudiant(p_numetu INT)
RETURNS TABLE(
    nummod INT,
    nommod VARCHAR,
    moyenne NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        mat.nummod,
        mod.nommod,  
        ROUND(AVG(anote.note), 2) AS moyenne
    FROM 
        avoir_note anote
    JOIN 
        epreuves epr ON anote.numepr = epr.numepr
    JOIN 
        matieres mat ON epr.matepr = mat.nummat
    JOIN 
        modules mod ON mat.nummod = mod.nummod  
    WHERE 
        anote.numetu = p_numetu
    GROUP BY 
        mat.nummod, mod.nommod  
    ORDER BY 
        mod.nommod;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION get_classement_general_par_annee()
RETURNS TABLE(
    numetu INT,
    nometu VARCHAR,
    prenometu VARCHAR,
    annetu INT,
    total_score NUMERIC
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        e.numetu, 
        e.nometu, 
        e.prenometu, 
        e.annetu,
        SUM(an.note * ep.coefepr)::numeric AS total_score 
    FROM 
        etudiants e
    JOIN 
        avoir_note an ON e.numetu = an.numetu
    JOIN 
        epreuves ep ON an.numepr = ep.numepr
    JOIN 
        matieres m ON ep.matepr = m.nummat
    GROUP BY 
        e.numetu, e.nometu, e.prenometu, e.annetu
    ORDER BY 
        e.annetu, total_score DESC;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_classement_general()
RETURNS TABLE (numetu INT, nometu VARCHAR(20), prenometu VARCHAR(20), total_score NUMERIC) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        e.numetu, 
        e.nometu, 
        e.prenometu, 
        SUM(an.note * ep.coefepr * m.coefmat)::NUMERIC AS total_score
    FROM 
        etudiants e
    JOIN 
        avoir_note an ON e.numetu = an.numetu
    JOIN 
        epreuves ep ON an.numepr = ep.numepr
    JOIN 
        matieres m ON ep.matepr = m.nummat
    GROUP BY 
        e.numetu, e.nometu, e.prenometu
    ORDER BY 
        total_score DESC;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_classement_par_epreuve_matiere()
RETURNS TABLE (
    matiere TEXT,
    epreuve TEXT,
    nometu TEXT,
    prenometu TEXT,
    score NUMERIC 
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        m.nommat::TEXT AS matiere, 
        ep.libepr::TEXT AS epreuve, 
        e.nometu::TEXT, 
        e.prenometu::TEXT, 
        (an.note * ep.coefepr)::NUMERIC AS score
    FROM 
        etudiants e
    JOIN 
        avoir_note an ON e.numetu = an.numetu
    JOIN 
        epreuves ep ON an.numepr = ep.numepr
    JOIN 
        matieres m ON ep.matepr = m.nummat
    ORDER BY 
        m.nommat, ep.libepr, score DESC;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_classement_par_matiere(nummat integer)
RETURNS TABLE (
    numetu integer,
    nom text,
    prenom text,
    moyenne numeric
) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        etu.numetu,
        etu.nometu::text AS nom, 
        etu.prenometu::text AS prenom,  
        ROUND(AVG(anote.note), 2) AS moyenne
    FROM 
        avoir_note anote
    JOIN 
        epreuves epr ON anote.numepr = epr.numepr
    JOIN 
        etudiants etu ON anote.numetu = etu.numetu
    WHERE 
        epr.matepr = nummat 
        AND anote.note IS NOT NULL
    GROUP BY 
        etu.numetu, etu.nometu, etu.prenometu
    ORDER BY 
        moyenne DESC;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_classement_par_module(nummod integer)
RETURNS TABLE (numetu integer, nom varchar(20), prenom varchar(20), moyenne numeric) AS $$
BEGIN
    RETURN QUERY
    SELECT 
        etu.numetu,
        etu.nometu AS nom,  
        etu.prenometu AS prenom,  
        ROUND(AVG(anote.note), 2) AS moyenne
    FROM 
        avoir_note anote
    JOIN 
        epreuves epr ON anote.numepr = epr.numepr
    JOIN 
        etudiants etu ON anote.numetu = etu.numetu
    JOIN 
        matieres mat ON epr.matepr = mat.nummat
    WHERE 
        mat.nummod = $1
    GROUP BY 
        etu.numetu, etu.nometu, etu.prenometu
    ORDER BY 
        moyenne DESC;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION get_classement_general_module()
RETURNS TABLE (numetu INTEGER, nometu VARCHAR, prenometu VARCHAR, module TEXT, total_score NUMERIC) AS
$$
BEGIN
   RETURN QUERY
   SELECT e.numetu, e.nometu, e.prenometu, 
          CAST(m.nommod AS TEXT) AS module,
          SUM(a.note)::NUMERIC AS total_score
   FROM avoir_note a
   JOIN etudiants e ON a.numetu = e.numetu
   JOIN epreuves ep ON a.numepr = ep.numepr
   JOIN matieres ma ON ep.matepr = ma.nummat
   JOIN modules m ON ma.nummod = m.nummod
   GROUP BY e.numetu, e.nometu, e.prenometu, m.nommod
   ORDER BY total_score DESC;
END;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION get_classement_par_matiere_module() 
RETURNS TABLE(matiere text, numetu integer, nometu text, prenometu text, score numeric, module text)
    LANGUAGE plpgsql
    AS $$
BEGIN
    RETURN QUERY
    SELECT 
        ma.nommat::TEXT AS matiere,  
        e.numetu, 
        e.nometu::TEXT,  
        e.prenometu::TEXT,  
        a.note::NUMERIC AS score, 
        mod.nommod::TEXT AS module  
    FROM 
        avoir_note a
    JOIN 
        etudiants e ON a.numetu = e.numetu
    JOIN 
        epreuves ep ON a.numepr = ep.numepr
    JOIN 
        matieres ma ON ep.matepr = ma.nummat  
    JOIN 
        modules mod ON ma.nummod = mod.nummod
    ORDER BY 
        mod.nommod, ma.nommat, a.note DESC;
END;
$$;




