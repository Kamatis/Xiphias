# Insert Queries #
# Program Table
## College of Computer Studies
insert into program values ("BSIT", "Bachelor of Science in Information Technology");
insert into program values ("BSIS", "Bachelor of Science in Information Systems");
insert into program values ("BSCS", "Bachelor of Science in Computer Science");
insert into program values ("BSDIA", "Bachelor of Science in Digital Illustration and Animation");
## College of Business and Accountancy
insert into program values ("BSA", "Bachelor of Science in Accountancy");
insert into program values ("BSBA Business Economics", "Bachelor of Science in Business Administration Major in Business Economics");
insert into program values ("BSBA Business Engineering", "Bachelor of Science in Business Administration Major in Business Engineering");
insert into program values ("BST Dev Tourism Mgmt", "Bachelor of Science in Tourism Major in Development Tourism Management");
insert into program values ("BSEntrep", "Bachelor of Science in Entrepreneurship");
insert into program values ("BSEntrep Ent", "Bachelor of Science in Entrepreneurship Major in Entrepreneurial Tourism");
insert into program values ("BSBA Legal Mgmt", "Bachelor of Science in Business Administration Major in Legal Management");
insert into program values ("BSBA Bank Fin", "Bachelor of Sciance in Business Administration Major in Banking and Finance");
insert into program values ("BSBA Mgmt", "Bachelor of Science in Business Administration Major in Management");
insert into program values ("BSBA Bus Mgmt HP", "Bachelor of Science in Business Administration Major in Business Management Honors Program");
insert into program values ("BSBA HHHCM", "Bachelor of Science in Business Administration Major in Hospital and Home Health Care Management");
insert into program values ("BSBA Mktg Mgmt", "Bachelor of Science in Business Administration Major in Marketing Management");
insert into program values ("BSBA Fin Mgmt Acc", "Bachelor of Science in Businesss Administration Major in Financial Management and Accounting");
insert into program values ("BSBA Comp Mgmt Acc", "Bachelor of Science in Business Administration Major in Computer Management and Accounting");
## College of Education
insert into program values ("BEEd", "Bachelor of Elementary Education");
insert into program values ("BSE", "Bachelor of Secondary Education ");
insert into program values ("CPEd", "Certificate in Professional Education");
## College of Humanities and Social Sciences
insert into program values ("ABB", "Bachelor of Arts in Broadcasting");
insert into program values ("ABC", "Bachelor of Arts in Communication");
insert into program values ("AB Dev Comm", "Bachelor of Arts in Development Communcation");
insert into program values ("AB Journ", "Bachelor of Arts in Journalism");
insert into program values ("AB Eco", "Bachelor of Arts in Economics");
insert into program values ("AB Pol Sci", "Bachelor of Arts in Political Science");
insert into program values ("AB Eng", "Bachelor of Arts in English");
insert into program values ("AB Lit", "Bachelor of Arts in Literature");
insert into program values ("AB Philo", "Bachelor of Arts in Philosophy");
insert into program values ("BS Psych", "Bachelor of Science in Psychology");
## College of Nursing
insert into program values ("BSN", "Bachelor of Science in Nursing");
## College of Science and Engineering
insert into program values ("BS EE", "Bachelor of Science in Electronics Engineering");
insert into program values ("BSCoe", "Bachelor of Science in Computer Engineering");
insert into program values ("BET-CpET", "Bachelor of Engineering Technology Major in Computer Engineering Technology");
insert into program values ("BSCE", "Bachelor of Science in Civil Engineering");
insert into program values ("BSES", "Bachelor of Science in Environmental Science");
insert into program values ("BS Bio", "Bachelor of Science in Biology");
insert into program values ("BS Math", "Bachelor of Science in Mathematics");

# Quest_Type Table
insert into quests_type values (null, "Academic", "Studying is the essence of studying");
insert into quests_type values (null, "Co-Curricular", "Put what you learn into action");
insert into quests_type values (null, "Extra-Curricular", "Anything that is of sense to your intra-personal growth");

# Rarity Table
insert into rarity values (null, "Common", 1, 10, "assets/images/rarity/common.png");
insert into rarity values (null, "Uncommon", 11, 20, "assets/images/rarity/uncommon.png");
insert into rarity values (null, "Rare", 21, 30, "assets/images/rarity/rare.png");
insert into rarity values (null, "Legendary", 31, 40, "assets/images/rarity/legendary.png");
insert into rarity values (null, "Blue Moon", 41, 50, "assets/images/rarity/bluemoon.png");

# User Table
insert into user values(null, "admin", md5("admin"), "Admin", "Admin", "Admin", NULL, "facebook.com", "aadmin@gbox.adnu.edu.ph",null,"09091234567",3);
# NPC Table
insert into npc values(1,1);

# Affiliations Table
insert into affiliation values(null, "Days with the Lord");
insert into affiliation values(null, "The Ateneo Consortium for Technological Information and Computing Sciences");
insert into affiliation values(null, "Ateneo Paradigm Eclat Xircle");


# House Table
insert into house values (null, "Convex Hulk", 0, "Hustle...Loyalty...Respect", "assets/images/houses/house1_logo.png");
insert into house values (null, "Segment Thor-ee", 0, "From out of nowhere", "assets/images/houses/house2_logo.png");
insert into house values (null, "Travelling Ironman", 0, "Got Milk?", "assets/images/houses/house3_logo.png");
insert into house values (null, "Captain Josephus", 0, "Survival of the Fittest", "assets/images/houses/house4_logo.png");


# Avatar Table
insert into avatar values(1, 'assets/images/levels/lvl1.png', 1);
insert into avatar values(2, 'assets/images/levels/lvl2.png', 5);
insert into avatar values(3, 'assets/images/levels/lvl3.png', 15);
insert into avatar values(4, 'assets/images/levels/lvl4.png', 30);
insert into avatar values(5, 'assets/images/levels/lvl5.png', 50);
insert into avatar values(6, 'assets/images/levels/lvl6.png', 75);
insert into avatar values(7, 'assets/images/levels/lvl1.png', 105);
insert into avatar values(8, 'assets/images/levels/lvl1.png', 99999999);

# School Table
insert into school values(null,"Naga Central School II",1);
insert into school values(null,"Naga Central School I",1);
insert into school values(null,"Universidad de Sta. Isabel",1);
insert into school values(null,"Universidad de Sta. Isabel",2);
insert into school values(null,"Universidad de Sta. Isabel",3);
insert into school values(null,"Camarines Sur National High School",2);
insert into school values(null,"Naga City Science High School",2);
insert into school values(null,"Naga College Foundation",1);
insert into school values(null,"Naga College Foundation",2);
insert into school values(null,"Naga College Foundation",3);
insert into school values(null,"University of Nueva Caceres",1);
insert into school values(null,"University of Nueva Caceres",2);
insert into school values(null,"University of Nueva Caceres",3);
insert into school values(null,"Ateneo de Naga University",1);
insert into school values(null,"Ateneo de Naga University",2);
insert into school values(null,"Ateneo de Naga University",3);

insert into hall_of_fame values(null, "SY 2012-2013 1st Semester");
insert into hall_of_fame values(null, "SY 2012-2013 2nd Semester");

insert into ranking values (1, 1, 1000);
insert into ranking values (1, 2, 2000);
insert into ranking values (1, 3, 3000);
insert into ranking values (1, 4, 4000);

insert into ranking values (2, 2, 1000);
insert into ranking values (2, 3, 2000);
insert into ranking values (2, 4, 3000);
insert into ranking values (2, 1, 4000);
