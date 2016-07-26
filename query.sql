SELECT submission.id, `like`.id, count(`like`.id) FROM submission LEFT JOIN `like` ON submission.id = `like`.submission_id GROUP BY submission.id;

/* add unique index for (submission_id, device_id) */
ALTER TABLE `like` ADD UNIQUE `unique_index`(`submission_id`, `device_id`);

/* drop unique index */
ALTER TABLE `like` DROP INDEX `unique_index`;

/* view all_submission */
select `submission`.`id` AS `id`,`candidate`.`name` AS `candidate name`,`candidate`.`email` 
AS `candidate email`,`candidate`.`contact_number` AS `candidate contact number`,`image`.`path` 
AS `image`,`country`.`name` AS `country name`,`submission`.`redeem_at` AS `redeem at` 
from (((`submission` join `candidate` on((`submission`.`candidate_id` = `candidate`.`id`))) 
	join `country` on((`submission`.`country_id` = `country`.`id`))) join `image` 
on((`image`.`id` = `submission`.`image_id`)))

