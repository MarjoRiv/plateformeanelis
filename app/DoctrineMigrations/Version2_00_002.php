<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_002 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 60 sql queries
     */
    public function up(Schema $schema) {

        try {
            $table = $schema->getTable('parameters');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE Parameters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_49CE4B2E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('file_offre');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE file_offre (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(127) DEFAULT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('offers');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE Offers (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, attachement_id INT DEFAULT NULL, title VARCHAR(40) NOT NULL, datepublished DATE NOT NULL, description VARCHAR(2000) NOT NULL, type VARCHAR(25) NOT NULL, enabled TINYINT(1) NOT NULL, dateexpire DATE NOT NULL, reading INT NOT NULL, INDEX IDX_DDEA0111A76ED395 (user_id), UNIQUE INDEX UNIQ_DDEA0111A05591E0 (attachement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('offre_var');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE offre_var (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, variable INT NOT NULL, UNIQUE INDEX UNIQ_8DF69F2F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('user_offre');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE user_offre (id INT AUTO_INCREMENT NOT NULL, Nbpropfait INT NOT NULL, Nbpropmax INT NOT NULL, autorized TINYINT(1) NOT NULL, UserApp_id INT NOT NULL, UNIQUE INDEX UNIQ_4D447D37598C300F (UserApp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('credits');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE credits (id INT AUTO_INCREMENT NOT NULL, payment_instruction_id INT NOT NULL, payment_id INT DEFAULT NULL, attention_required TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, credited_amount NUMERIC(10, 5) NOT NULL, crediting_amount NUMERIC(10, 5) NOT NULL, reversing_amount NUMERIC(10, 5) NOT NULL, state SMALLINT NOT NULL, target_amount NUMERIC(10, 5) NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_4117D17E8789B572 (payment_instruction_id), INDEX IDX_4117D17E4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('financial_transactions');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE financial_transactions (id INT AUTO_INCREMENT NOT NULL, credit_id INT DEFAULT NULL, payment_id INT DEFAULT NULL, extended_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:extended_payment_data)\', processed_amount NUMERIC(10, 5) NOT NULL, reason_code VARCHAR(100) DEFAULT NULL, reference_number VARCHAR(100) DEFAULT NULL, requested_amount NUMERIC(10, 5) NOT NULL, response_code VARCHAR(100) DEFAULT NULL, state SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, tracking_id VARCHAR(100) DEFAULT NULL, transaction_type SMALLINT NOT NULL, INDEX IDX_1353F2D9CE062FF9 (credit_id), INDEX IDX_1353F2D94C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('payments');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, payment_instruction_id INT NOT NULL, approved_amount NUMERIC(10, 5) NOT NULL, approving_amount NUMERIC(10, 5) NOT NULL, credited_amount NUMERIC(10, 5) NOT NULL, crediting_amount NUMERIC(10, 5) NOT NULL, deposited_amount NUMERIC(10, 5) NOT NULL, depositing_amount NUMERIC(10, 5) NOT NULL, expiration_date DATETIME DEFAULT NULL, reversing_approved_amount NUMERIC(10, 5) NOT NULL, reversing_credited_amount NUMERIC(10, 5) NOT NULL, reversing_deposited_amount NUMERIC(10, 5) NOT NULL, state SMALLINT NOT NULL, target_amount NUMERIC(10, 5) NOT NULL, attention_required TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, INDEX IDX_65D29B328789B572 (payment_instruction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('payment_instructions');
        } catch (SchemaException $e) {
            $this->addSql('CREATE TABLE payment_instructions (id INT AUTO_INCREMENT NOT NULL, amount NUMERIC(10, 5) NOT NULL, approved_amount NUMERIC(10, 5) NOT NULL, approving_amount NUMERIC(10, 5) NOT NULL, created_at DATETIME NOT NULL, credited_amount NUMERIC(10, 5) NOT NULL, crediting_amount NUMERIC(10, 5) NOT NULL, currency VARCHAR(3) NOT NULL, deposited_amount NUMERIC(10, 5) NOT NULL, depositing_amount NUMERIC(10, 5) NOT NULL, extended_data LONGTEXT NOT NULL COMMENT \'(DC2Type:extended_payment_data)\', payment_system_name VARCHAR(100) NOT NULL, reversing_approved_amount NUMERIC(10, 5) NOT NULL, reversing_credited_amount NUMERIC(10, 5) NOT NULL, reversing_deposited_amount NUMERIC(10, 5) NOT NULL, state SMALLINT NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
        }

        try {
            $table = $schema->getTable('offers');
            $fk = $table->getForeignKey('FK_DDEA0111A76ED395');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE Offers ADD CONSTRAINT FK_DDEA0111A76ED395 FOREIGN KEY (user_id) REFERENCES user_offre (id);');
        }

        try {
            $table = $schema->getTable('offers');
            $fk = $table->getForeignKey('FK_DDEA0111A05591E0');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE Offers ADD CONSTRAINT FK_DDEA0111A05591E0 FOREIGN KEY (attachement_id) REFERENCES file_offre (id);');
        }

        try {
            $table = $schema->getTable('user_offre');
            $fk = $table->getForeignKey('FK_4D447D37598C300F');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE user_offre ADD CONSTRAINT FK_4D447D37598C300F FOREIGN KEY (UserApp_id) REFERENCES User (id);');
        }

        try {
            $table = $schema->getTable('credits');
            $fk = $table->getForeignKey('FK_4117D17E8789B572');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE credits ADD CONSTRAINT FK_4117D17E8789B572 FOREIGN KEY (payment_instruction_id) REFERENCES payment_instructions (id) ON DELETE CASCADE;');
        }

        try {
            $table = $schema->getTable('credits');
            $fk = $table->getForeignKey('FK_4117D17E4C3A3BB');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE credits ADD CONSTRAINT FK_4117D17E4C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON DELETE CASCADE;');
        }

        try {
            $table = $schema->getTable('financial_transactions');
            $fk = $table->getForeignKey('FK_1353F2D9CE062FF9');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE financial_transactions ADD CONSTRAINT FK_1353F2D9CE062FF9 FOREIGN KEY (credit_id) REFERENCES credits (id) ON DELETE CASCADE;');
        }

        try {
            $table = $schema->getTable('financial_transactions');
            $fk = $table->getForeignKey('FK_1353F2D94C3A3BB');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE financial_transactions ADD CONSTRAINT FK_1353F2D94C3A3BB FOREIGN KEY (payment_id) REFERENCES payments (id) ON DELETE CASCADE;');
        }

        try {
            $table = $schema->getTable('payments');
            $fk = $table->getForeignKey('FK_65D29B328789B572');
        } catch (SchemaException $e) {
            $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B328789B572 FOREIGN KEY (payment_instruction_id) REFERENCES payment_instructions (id) ON DELETE CASCADE;');
        }

        try {
            $table = $schema->getTable('events');
            $column = $table->getColumn('id');
            if($table->getPrimaryKey() == null)
            {
                $this->addSql('ALTER TABLE Events ADD PRIMARY KEY (id)');
            }
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('events');
            $column = $table->getColumn('id');
            $this->addSql('ALTER TABLE Events CHANGE id id INT AUTO_INCREMENT NOT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('locked');
            $this->addSql('ALTER TABLE User DROP locked');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('expired');
            $this->addSql('ALTER TABLE User DROP expired');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('expires_at');
            $this->addSql('ALTER TABLE User DROP expires_at');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('credentials_expired');
            $this->addSql('ALTER TABLE User DROP credentials_expired');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('credentials_expire_at');
            $this->addSql('ALTER TABLE User DROP credentials_expire_at');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('username');
            $this->addSql('ALTER TABLE User CHANGE username username VARCHAR(180) NOT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('username_canonical');
            $this->addSql('ALTER TABLE User CHANGE username_canonical username_canonical VARCHAR(180) NOT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('email');
            $this->addSql('ALTER TABLE User CHANGE email email VARCHAR(180) NOT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('email_canonical');
            $this->addSql('ALTER TABLE User CHANGE email_canonical email_canonical VARCHAR(180) NOT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('salt');
            $this->addSql('ALTER TABLE User CHANGE salt salt VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('confirmation_token');
            $this->addSql('ALTER TABLE User CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('maritalName');
            $this->addSql('ALTER TABLE User  CHANGE maritalName maritalName VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('address');
            $this->addSql('ALTER TABLE User  CHANGE address address LONGTEXT DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('postalcode');
            $this->addSql('ALTER TABLE User  CHANGE postalcode postalcode VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('city');
            $this->addSql('ALTER TABLE User CHANGE city city VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('country');
            $this->addSql('ALTER TABLE User CHANGE country country VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('telephone');
            $this->addSql('ALTER TABLE User CHANGE telephone telephone VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('website');
            $this->addSql('ALTER TABLE User CHANGE website website VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialFacebook');
            $this->addSql('ALTER TABLE User CHANGE socialFacebook socialFacebook VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialTwitter');
            $this->addSql('ALTER TABLE User CHANGE socialTwitter socialTwitter VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialLinkedin');
            $this->addSql('ALTER TABLE User CHANGE socialLinkedin socialLinkedin VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialGoogle');
            $this->addSql('ALTER TABLE User CHANGE socialGoogle socialGoogle VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialYoutube');
            $this->addSql('ALTER TABLE User  CHANGE socialYoutube socialYoutube VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('socialInstagram');
            $this->addSql('ALTER TABLE User CHANGE socialInstagram socialInstagram VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('biography');
            $this->addSql('ALTER TABLE User  CHANGE biography biography LONGTEXT DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('maritalStatus');
            $this->addSql('ALTER TABLE User  CHANGE maritalStatus maritalStatus VARCHAR(255) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('childrenNumber');
            $this->addSql('ALTER TABLE User CHANGE childrenNumber childrenNumber INT DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('isEmailValid');
            $this->addSql('ALTER TABLE User CHANGE isEmailValid isEmailValid TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('mlInformations');
            $this->addSql('ALTER TABLE User CHANGE mlInformations mlInformations TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('mlEmployment');
            $this->addSql('ALTER TABLE User CHANGE mlEmployment mlEmployment TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('mlEvents');
            $this->addSql('ALTER TABLE User CHANGE mlEvents mlEvents TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('mlIsimaNews');
            $this->addSql('ALTER TABLE User  CHANGE mlIsimaNews mlIsimaNews TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('isAlive');
            $this->addSql('ALTER TABLE User  CHANGE isAlive isAlive TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('isGraduated');
            $this->addSql('ALTER TABLE User  CHANGE isGraduated isGraduated TINYINT(1) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $column = $table->getColumn('nickname');
            $this->addSql('ALTER TABLE User CHANGE nickname nickname VARCHAR(60) DEFAULT NULL');
        }catch(SchemaException $e)
        {}

        try {
            $table = $schema->getTable('User');
            $index = $table->getIndex('UNIQ_2DA17977C05FB297');
        }catch(SchemaException $e)
        {
            $this->addSql('CREATE UNIQUE INDEX UNIQ_2DA17977C05FB297 ON User (confirmation_token);');
        }

        try {
            $table = $schema->getTable('cotisation');
            $column = $table->getColumn('paymentInstruction_id');
        }catch(SchemaException $e)
        {
            $this->addSql('ALTER TABLE Cotisation ADD paymentInstruction_id INT DEFAULT NULL;');
        }

        try {
            $table = $schema->getTable('cotisation');
            $fk = $table->getForeignKey('FK_E139D13DFD913E4D');
        }catch(SchemaException $e)
        {
            $this->addSql('ALTER TABLE Cotisation ADD CONSTRAINT FK_E139D13DFD913E4D FOREIGN KEY (paymentInstruction_id) REFERENCES payment_instructions (id);');
        }

        try {
            $table = $schema->getTable('cotisation');
            $index = $table->getIndex('UNIQ_E139D13DFD913E4D');
        }catch(SchemaException $e)
        {
            $this->addSql('CREATE UNIQUE INDEX UNIQ_E139D13DFD913E4D ON Cotisation (paymentInstruction_id);');
        }

        try {
            $table = $schema->getTable('statictext');
            $this->addSql('DROP TABLE StaticText;');
        }catch(SchemaException $e)
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
