
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- catalogue_pdf_config
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue_pdf_config`;

CREATE TABLE `catalogue_pdf_config`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `file` VARCHAR(255),
    `url` VARCHAR(255),
    `responsable_nom` VARCHAR(255),
    `responsable_prenom` VARCHAR(255),
    `tel_fixe` VARCHAR(255),
    `tel_mobile` VARCHAR(255),
    `adresse_voie_numero` VARCHAR(255),
    `adresse_codepostal` VARCHAR(255),
    `adresse_commune` VARCHAR(255),
    `siret` VARCHAR(255),
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- catalogue_pdf_document
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue_pdf_document`;

CREATE TABLE `catalogue_pdf_document`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `config_id` INTEGER NOT NULL,
    `file` VARCHAR(255),
    `publication_year` INTEGER,
    PRIMARY KEY (`id`),
    INDEX `fi_pdf_config_id` (`config_id`),
    CONSTRAINT `fk_pdf_config_id`
        FOREIGN KEY (`config_id`)
        REFERENCES `catalogue_pdf_config` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- catalogue_pdf_config_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue_pdf_config_i18n`;

CREATE TABLE `catalogue_pdf_config_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255),
    `subtitle` VARCHAR(255),
    `titre_date_debut` VARCHAR(255),
    `alt` VARCHAR(255),
    `adresse_voie` VARCHAR(255),
    `texte_site` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `catalogue_pdf_config_i18n_fk_51c521`
        FOREIGN KEY (`id`)
        REFERENCES `catalogue_pdf_config` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- catalogue_pdf_document_i18n
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `catalogue_pdf_document_i18n`;

CREATE TABLE `catalogue_pdf_document_i18n`
(
    `id` INTEGER NOT NULL,
    `locale` VARCHAR(5) DEFAULT 'en_US' NOT NULL,
    `title` VARCHAR(255),
    PRIMARY KEY (`id`,`locale`),
    CONSTRAINT `catalogue_pdf_document_i18n_fk_b6ef44`
        FOREIGN KEY (`id`)
        REFERENCES `catalogue_pdf_document` (`id`)
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
