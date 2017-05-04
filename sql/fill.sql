INSERT INTO `type` (`description`) VALUES ('guest');
INSERT INTO `type` (`description`) VALUES ('admin');
INSERT INTO `org` (`description`) VALUES ('Star Pupil');


INSERT INTO  users (name, email, phone, password, specialID) VALUES ('Joshua Hesseltine', 'hesseljo@oregonstate.edu', '6199994444', 'joshPass', 1);
INSERT INTO  users (name, email, specialID, dateOfAward) VALUES ('Mickey', 'mickey@me.com', 2, '2017-01-01');

--INSERT INTO  award (name, email, userID, orgID, dateOfAward) VALUES ('Mickey', 'mickey@me.com', 50, 1, '2017-01-01');

