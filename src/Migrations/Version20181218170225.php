<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181218170225 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE feature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE team_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE topic_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE note_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE step_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE project_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, bio TEXT DEFAULT NULL, firstname VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4E7927C74 ON account (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4F85E0677 ON account (username)');
        $this->addSql('CREATE TABLE users_teams (user_id INT NOT NULL, team_id INT NOT NULL, PRIMARY KEY(user_id, team_id))');
        $this->addSql('CREATE INDEX IDX_71B58611A76ED395 ON users_teams (user_id)');
        $this->addSql('CREATE INDEX IDX_71B58611296CD8AE ON users_teams (team_id)');
        $this->addSql('CREATE TABLE users_projects (user_id INT NOT NULL, project_id INT NOT NULL, PRIMARY KEY(user_id, project_id))');
        $this->addSql('CREATE INDEX IDX_27D2987EA76ED395 ON users_projects (user_id)');
        $this->addSql('CREATE INDEX IDX_27D2987E166D1F9C ON users_projects (project_id)');
        $this->addSql('CREATE TABLE feature (id INT NOT NULL, project_id INT DEFAULT NULL, title VARCHAR(200) NOT NULL, content TEXT NOT NULL, type VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1FD77566166D1F9C ON feature (project_id)');
        $this->addSql('CREATE TABLE team (id INT NOT NULL, name VARCHAR(100) NOT NULL, bio TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE topic (id INT NOT NULL, project_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, answer TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9D40DE1B166D1F9C ON topic (project_id)');
        $this->addSql('CREATE TABLE note (id INT NOT NULL, type INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE notes_feature (note_id INT NOT NULL, feature_id INT NOT NULL, PRIMARY KEY(note_id, feature_id))');
        $this->addSql('CREATE INDEX IDX_1F01393226ED0855 ON notes_feature (note_id)');
        $this->addSql('CREATE INDEX IDX_1F01393260E4B879 ON notes_feature (feature_id)');
        $this->addSql('CREATE TABLE notes_users (note_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(note_id, user_id))');
        $this->addSql('CREATE INDEX IDX_8E744D4926ED0855 ON notes_users (note_id)');
        $this->addSql('CREATE INDEX IDX_8E744D49A76ED395 ON notes_users (user_id)');
        $this->addSql('CREATE TABLE step (id INT NOT NULL, type VARCHAR(20) NOT NULL, description TEXT NOT NULL, name VARCHAR(100) NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE comment (id INT NOT NULL, user_id INT DEFAULT NULL, feature_id INT DEFAULT NULL, content TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('CREATE INDEX IDX_9474526C60E4B879 ON comment (feature_id)');
        $this->addSql('CREATE TABLE project (id INT NOT NULL, team_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE296CD8AE ON project (team_id)');
        $this->addSql('ALTER TABLE users_teams ADD CONSTRAINT FK_71B58611A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_teams ADD CONSTRAINT FK_71B58611296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_projects ADD CONSTRAINT FK_27D2987EA76ED395 FOREIGN KEY (user_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE users_projects ADD CONSTRAINT FK_27D2987E166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD77566166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1B166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes_feature ADD CONSTRAINT FK_1F01393226ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes_feature ADD CONSTRAINT FK_1F01393260E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes_users ADD CONSTRAINT FK_8E744D4926ED0855 FOREIGN KEY (note_id) REFERENCES note (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE notes_users ADD CONSTRAINT FK_8E744D49A76ED395 FOREIGN KEY (user_id) REFERENCES account (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C60E4B879 FOREIGN KEY (feature_id) REFERENCES feature (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE296CD8AE FOREIGN KEY (team_id) REFERENCES team (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users_teams DROP CONSTRAINT FK_71B58611A76ED395');
        $this->addSql('ALTER TABLE users_projects DROP CONSTRAINT FK_27D2987EA76ED395');
        $this->addSql('ALTER TABLE notes_users DROP CONSTRAINT FK_8E744D49A76ED395');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE notes_feature DROP CONSTRAINT FK_1F01393260E4B879');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C60E4B879');
        $this->addSql('ALTER TABLE users_teams DROP CONSTRAINT FK_71B58611296CD8AE');
        $this->addSql('ALTER TABLE project DROP CONSTRAINT FK_2FB3D0EE296CD8AE');
        $this->addSql('ALTER TABLE notes_feature DROP CONSTRAINT FK_1F01393226ED0855');
        $this->addSql('ALTER TABLE notes_users DROP CONSTRAINT FK_8E744D4926ED0855');
        $this->addSql('ALTER TABLE users_projects DROP CONSTRAINT FK_27D2987E166D1F9C');
        $this->addSql('ALTER TABLE feature DROP CONSTRAINT FK_1FD77566166D1F9C');
        $this->addSql('ALTER TABLE topic DROP CONSTRAINT FK_9D40DE1B166D1F9C');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE feature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE team_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE topic_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE note_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE step_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE project_id_seq CASCADE');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE users_teams');
        $this->addSql('DROP TABLE users_projects');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE notes_feature');
        $this->addSql('DROP TABLE notes_users');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE project');
    }
}
