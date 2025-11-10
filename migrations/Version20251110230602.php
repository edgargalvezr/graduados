<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251110230602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrera (id INT AUTO_INCREMENT NOT NULL, codigo VARCHAR(50) NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estudio_posterior (id INT AUTO_INCREMENT NOT NULL, graduado_id INT NOT NULL, institucion VARCHAR(255) NOT NULL, titulo_obtenido VARCHAR(255) NOT NULL, tipo_estudio VARCHAR(255) NOT NULL, en_curso TINYINT(1) NOT NULL, INDEX IDX_95B38507146255DD (graduado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experiencia_laboral (id INT AUTO_INCREMENT NOT NULL, graduado_id INT NOT NULL, estado_laboral VARCHAR(50) NOT NULL, empresa VARCHAR(255) DEFAULT NULL, cargo VARCHAR(255) DEFAULT NULL, sector VARCHAR(50) DEFAULT NULL, relacionado_carrera TINYINT(1) NOT NULL, fecha_inicio DATE DEFAULT NULL, fecha_fin DATE DEFAULT NULL, INDEX IDX_6B31EEF3146255DD (graduado_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE graduado (id INT AUTO_INCREMENT NOT NULL, carrera_id INT NOT NULL, cedula VARCHAR(10) NOT NULL, apellidos VARCHAR(255) NOT NULL, nombres VARCHAR(255) NOT NULL, cohorte VARCHAR(50) NOT NULL, numero_registro VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telefono VARCHAR(10) DEFAULT NULL, pais_residencia VARCHAR(100) DEFAULT NULL, ciudad_residencia VARCHAR(255) DEFAULT NULL, busca_empleo TINYINT(1) NOT NULL, cv_path VARCHAR(255) DEFAULT NULL, interesado_colaborar TINYINT(1) NOT NULL, logros_destacados LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', temas_interes_formacion JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', modalidad_preferida VARCHAR(100) DEFAULT NULL, habilidades_clave JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', aspiracion_salarial NUMERIC(10, 2) DEFAULT NULL, tipo_colaboracion JSON NOT NULL COMMENT \'(DC2Type:json)\', nombre_jefe_directo VARCHAR(255) NOT NULL, email_contacto_rrhh VARCHAR(255) DEFAULT NULL, telefono_contacto_rrhh VARCHAR(8) DEFAULT NULL, permiso_contacto_empleador TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A28999687BF39BE0 (cedula), INDEX IDX_A2899968C671B40F (carrera_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE estudio_posterior ADD CONSTRAINT FK_95B38507146255DD FOREIGN KEY (graduado_id) REFERENCES graduado (id)');
        $this->addSql('ALTER TABLE experiencia_laboral ADD CONSTRAINT FK_6B31EEF3146255DD FOREIGN KEY (graduado_id) REFERENCES graduado (id)');
        $this->addSql('ALTER TABLE graduado ADD CONSTRAINT FK_A2899968C671B40F FOREIGN KEY (carrera_id) REFERENCES carrera (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE estudio_posterior DROP FOREIGN KEY FK_95B38507146255DD');
        $this->addSql('ALTER TABLE experiencia_laboral DROP FOREIGN KEY FK_6B31EEF3146255DD');
        $this->addSql('ALTER TABLE graduado DROP FOREIGN KEY FK_A2899968C671B40F');
        $this->addSql('DROP TABLE carrera');
        $this->addSql('DROP TABLE estudio_posterior');
        $this->addSql('DROP TABLE experiencia_laboral');
        $this->addSql('DROP TABLE graduado');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
