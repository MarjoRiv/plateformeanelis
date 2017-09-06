<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version1_00_001 extends AbstractMigration {
    /**
     * @param Schema $schema
     * Résultat à obtenir : 47 SQL Queries
     */
    public function up(Schema $schema) {

        try {
            $table = $schema->getTable('career');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Career` (
            `id` INT(11) NOT NULL,
  `user_id` INT(11) DEFAULT NULL,
  `localisation` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institution` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` LONGTEXT COLLATE utf8_unicode_ci,
  `date` DATETIME NOT NULL,
  `typeCareer_id` INT(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Career`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B5F769B2D4423A36` (`typeCareer_id`),
  ADD KEY `IDX_B5F769B2A76ED395` (`user_id`);');
            $this->addSql('ALTER TABLE `Career`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('cotisation');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Cotisation` (
  `id` INT(11) NOT NULL,
  `user_id` INT(11) DEFAULT NULL,
  `year` DATE NOT NULL,
  `namecotisation` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `pricecotisation` INT(11) NOT NULL,
  `typeCotisation_id` INT(11) NOT NULL,
  `payed` TINYINT(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Cotisation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E139D13D50CC17E8` (`typeCotisation_id`),
  ADD KEY `IDX_E139D13DA76ED395` (`user_id`)');
            $this->addSql('ALTER TABLE `Cotisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('events');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Events` (
        `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fblink` longtext COLLATE utf8_unicode_ci) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');

        }

        try {
            $table = $schema->getTable('image');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Image` (
  `id` int(11) NOT NULL,
  `updated` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `creation` datetime NOT NULL,
  `mandatory` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Image`
  ADD PRIMARY KEY (`id`)');
            $this->addSql('ALTER TABLE `Image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('invoice');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Invoice` (
  `id` int(11) NOT NULL,
  `cotisation_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5FD82ED83EAA84B1` (`cotisation_id`)');
            $this->addSql('ALTER TABLE `Invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('log');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B7722E25A76ED395` (`user_id`)');
            $this->addSql('ALTER TABLE `Log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('message');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Message` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_790009E3A76ED395` (`user_id`)');
            $this->addSql('ALTER TABLE `Message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('statictext');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `StaticText` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `static_text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
        }

        try {
            $table = $schema->getTable('typecareer');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `TypeCareer` (
        `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `TypeCareer`
  ADD PRIMARY KEY (`id`)');
            $this->addSql('ALTER TABLE `TypeCareer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('typecotisation');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `TypeCotisation` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `TypeCotisation`
  ADD PRIMARY KEY (`id`)');
            $this->addSql('ALTER TABLE `TypeCotisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('user');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `User` (
  `id` INT(11) NOT NULL,
  `avatar_id` INT(11) DEFAULT NULL,
  `username` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` TINYINT(1) NOT NULL,
  `salt` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` DATETIME DEFAULT NULL,
  `locked` TINYINT(1) NOT NULL,
  `expired` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL,
  `confirmation_token` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` DATETIME DEFAULT NULL,
  `roles` LONGTEXT COLLATE utf8_unicode_ci NOT NULL COMMENT \'(DC2Type:array)\',
  `credentials_expired` TINYINT(1) NOT NULL,
  `credentials_expire_at` DATETIME DEFAULT NULL,
  `name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `maritalName` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `promotion` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `filiere` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `postalcode` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialFacebook` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialTwitter` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialLinkedin` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialGoogle` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialYoutube` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `socialInstagram` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `biography` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `birthday` DATE NOT NULL,
  `maritalStatus` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `childrenNumber` INT(11) NOT NULL,
  `genre` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `isEmailValid` TINYINT(1) NOT NULL,
  `mlInformations` TINYINT(1) NOT NULL,
  `mlEmployment` TINYINT(1) NOT NULL,
  `mlEvents` TINYINT(1) NOT NULL,
  `mlIsimaNews` TINYINT(1) NOT NULL,
  `isAlive` TINYINT(1) NOT NULL,
  `isGraduated` TINYINT(1) NOT NULL,
  `nickname` VARCHAR(60) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `User`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`),
  ADD KEY `IDX_2DA1797786383B10` (`avatar_id`);');
            $this->addSql('ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('yearbook');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `Yearbook` (
  `id` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `Yearbook` ADD PRIMARY KEY (`id`)');
            $this->addSql('ALTER TABLE `Yearbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('yearbookmessages');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE `YearbookMessages` (
  `id` int(11) NOT NULL,
  `yearbook_id` int(11) NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `userFrom_id` int(11) NOT NULL,
  `userTo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;');
            $this->addSql('ALTER TABLE `YearbookMessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FD93A2532B121C29` (`userFrom_id`),
  ADD KEY `IDX_FD93A253D65059B3` (`userTo_id`),
  ADD KEY `IDX_FD93A253F7857D5B` (`yearbook_id`)');
            $this->addSql('ALTER TABLE `YearbookMessages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT');
        }

        try {
            $table = $schema->getTable('career');
            $fk = $table->getForeignKey('FK_B5F769B2A76ED395');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Career`
              ADD CONSTRAINT `FK_B5F769B2A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('career');
            $fk = $table->getForeignKey('FK_B5F769B2D4423A36');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Career`
              ADD CONSTRAINT `FK_B5F769B2D4423A36` FOREIGN KEY (`typeCareer_id`) REFERENCES `TypeCareer` (`id`)');
        }

        try {
            $table = $schema->getTable('cotisation');
            $fk = $table->getForeignKey('FK_E139D13D50CC17E8');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Cotisation`
  ADD CONSTRAINT `FK_E139D13D50CC17E8` FOREIGN KEY (`typeCotisation_id`) REFERENCES `TypeCotisation` (`id`)');
        }

        try {
            $table = $schema->getTable('cotisation');
            $fk = $table->getForeignKey('FK_E139D13DA76ED395');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Cotisation`
  ADD CONSTRAINT `FK_E139D13DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('invoice');
            $fk = $table->getForeignKey('FK_5FD82ED83EAA84B1');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Invoice`
  ADD CONSTRAINT `FK_5FD82ED83EAA84B1` FOREIGN KEY (`cotisation_id`) REFERENCES `Cotisation` (`id`)');
        }

        try {
            $table = $schema->getTable('log');
            $fk = $table->getForeignKey('FK_B7722E25A76ED395');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Log`
  ADD CONSTRAINT `FK_B7722E25A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('message');
            $fk = $table->getForeignKey('FK_790009E3A76ED395');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `Message`
  ADD CONSTRAINT `FK_790009E3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('user');
            $fk = $table->getForeignKey('FK_2DA1797786383B10');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `User`
  ADD CONSTRAINT `FK_2DA1797786383B10` FOREIGN KEY (`avatar_id`) REFERENCES `Image` (`id`)');
        }

        try {
            $table = $schema->getTable('yearbookmessages');
            $fk = $table->getForeignKey('FK_FD93A2532B121C29');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `YearbookMessages`
  ADD CONSTRAINT `FK_FD93A2532B121C29` FOREIGN KEY (`userFrom_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('yearbookmessages');
            $fk = $table->getForeignKey('FK_FD93A253D65059B3');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `YearbookMessages`
  ADD CONSTRAINT `FK_FD93A253D65059B3` FOREIGN KEY (`userTo_id`) REFERENCES `User` (`id`)');
        }

        try {
            $table = $schema->getTable('yearbookmessages');
            $fk = $table->getForeignKey('FK_FD93A253F7857D5B');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE `YearbookMessages`
  ADD CONSTRAINT `FK_FD93A253F7857D5B` FOREIGN KEY (`yearbook_id`) REFERENCES `Yearbook` (`id`)');
        }

        $this->addSql('COMMIT;');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
