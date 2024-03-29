SET FOREIGN_KEY_CHECKS=0;
CREATE TABLE zotero_importplus (id INT AUTO_INCREMENT NOT NULL, job_id INT DEFAULT NULL, undo_job_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, version INT NOT NULL, UNIQUE INDEX UNIQ_82A3EEB8BE04EA91 (job_id), UNIQUE INDEX UNIQ_82A3EEB84C276F751 (undo_job_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
CREATE TABLE zotero_importplus_item (id INT AUTO_INCREMENT NOT NULL, import_id INT NOT NULL, item_id INT NOT NULL, zotero_key VARCHAR(255) NOT NULL, INDEX IDX_86A2392BB6A263D91 (import_id), INDEX IDX_86A2392B126F525E1 (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
ALTER TABLE zotero_importplus ADD CONSTRAINT FK_82A3EEB8BE04EA91 FOREIGN KEY (job_id) REFERENCES job (id) ON DELETE CASCADE;
ALTER TABLE zotero_importplus ADD CONSTRAINT FK_82A3EEB84C276F751 FOREIGN KEY (undo_job_id) REFERENCES job (id) ON DELETE CASCADE;
ALTER TABLE zotero_importplus_item ADD CONSTRAINT FK_86A2392BB6A263D91 FOREIGN KEY (import_id) REFERENCES zotero_importplus (id) ON DELETE CASCADE;
ALTER TABLE zotero_importplus_item ADD CONSTRAINT FK_86A2392B126F525E1 FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
