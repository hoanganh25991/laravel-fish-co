SELECT submission.id, `like`.id, count(`like`.id) FROM submission LEFT JOIN `like` ON submission.id = `like`.submission_id GROUP BY submission.id;

/* add unique index for (submission_id, device_id) */
ALTER TABLE `like` ADD UNIQUE `unique_index`(`submission_id`, `device_id`);

/* drop unique index */
ALTER TABLE `like` DROP INDEX `unique_index`;

