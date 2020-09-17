/* QUERYS PRA RODAR NO BD PRA SUBSTITUIR CAMPOS DE CASO VAZIO PRA -1 E ALTERAR PRA INTEIRO */
UPDATE
    caso
SET
    obitosCaso = `-1`
WHERE
    obitosCaso = ``;

UPDATE
    caso
SET
    suspeitosCaso = `-1`
WHERE
    suspeitosCaso = ``;

UPDATE
    caso
SET
    confirmadosCaso = `-1`
WHERE
    confirmadosCaso = ``;

UPDATE
    caso
SET
    descartadosCaso = `-1`
WHERE
    descartadosCaso = ``;

UPDATE
    caso
SET
    recuperadosCaso = `-1`
WHERE
    recuperadosCaso = ``;

ALTER TABLE
    `caso` CHANGE `obitosCaso` `obitosCaso` INT(11) NULL DEFAULT NULL;

ALTER TABLE
    `caso` CHANGE `suspeitosCaso` `suspeitosCaso` INT(11) NULL DEFAULT NULL;

ALTER TABLE
    `caso` CHANGE `confirmadosCaso` `confirmadosCaso` INT(11) NULL DEFAULT NULL;

ALTER TABLE
    `caso` CHANGE `descartadosCaso` `descartadosCaso` INT(11) NULL DEFAULT NULL;

ALTER TABLE
    `caso` CHANGE `descartadosCaso` `descartadosCaso` INT(11) NULL DEFAULT NULL;

ALTER TABLE
    `caso` CHANGE `recuperadosCaso` `recuperadosCaso` INT(11) NULL DEFAULT NULL;

/* QUERY PRA CASO POR MIL HABITANTES */
SELECT
    (
        SELECT
            confirmadosCaso
        FROM
            caso c,
            municipio m
        WHERE
            m.idMunicipio = 10
            AND c.idMunicipio = m.idMunicipio
            AND c.deleted_at = '0000-00-00'
        ORDER BY
            c.dataCaso DESC
        LIMIT
            1
    ) / populacaoMunicipio * 1000 as casosPorMilHabitantes
FROM
    municipio
WHERE
    idMunicipio = 10