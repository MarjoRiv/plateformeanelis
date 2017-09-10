<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_004 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 3 sql queries
     */
    public function up(Schema $schema) {
        try {
            $table = $schema->getTable('Parameters');
            $this->addSql('INSERT INTO `Parameters` (`name`, `type`, `value`) VALUES
("anelis.cotisation.cotisationEnAttenteText", "html", "Si vous ne
                                souhaitez pas payer en ligne, vous pouvez régler :</p>
                                <ul>
                                <li>Par chèque à l\'ordre de l\'<b>Association des Anciens Elèves de l\'ISIMA</b></li>
                                <li>Par virement à l\'IBAN suivant : <br/><b>FR76 1680 6050 0066 0746 3319 725</b></li>
                                <li>Vous pouvez également payer via Paypal
                                </li>
                                </ul>");');
        }catch (SchemaException $e)
        {}

        $this->addSql('COMMIT;');
    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
