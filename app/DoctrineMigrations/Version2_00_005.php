<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_005 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 3 sql queries
     */
    public function up(Schema $schema) {

        try {
            $table = $schema->getTable('YearCotisation');
            $column = $table->getColumn('promoReduiteMax');
        }catch(SchemaException $e)
        {
            $this->addSql('ALTER TABLE YearCotisation ADD promoReduiteMax INT NOT NULL;');
            $this->addSql('UPDATE YearCotisation SET promoReduiteMax = year');
        }

        $this->addSql('COMMIT');

    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
