# 1st Edit: June 19, 2015
# 2nd Edit: June 25-26, 2015: 9:00 PM - 1:00 AM
# 3rd Edit: June 29, 2015

drop database xiphiasdb;
create database xiphiasdb;
use xiphiasdb;

# Lookup Tables
create table if not exists user_registration(
    serial_code varchar(25) not null,
    username varchar(75) not null,
    primary key(serial_code)
);

create table if not exists rarity(
    rarity_id int auto_increment not null,
    rarity_name varchar(25) not null,
    rarity_range_min int not null,
    rarity_range_max int not null,
    rarity_icon varchar(150) not null,
    primary key(rarity_id)
);

create table if not exists avatar(
    lvl int not null,
    image varchar(150) not null,
    experience_needed int not null,
    primary key(lvl)
);

create table if not exists quests_type(
    quest_type varchar(75) not null,
    description varchar(150) not null,
    primary key(quest_type)
);

# Main Tables
create table if not exists user(
    user_id int auto_increment not null,
	username varchar(75) not null,
	password varchar(100) not null,
	first_name varchar(50) not null,
	middle_name varchar(50) not null,
	last_name varchar(50) not null,
	description varchar(150),
	facebook varchar(50),
	email_address varchar(50),
	home_address varchar(200),
	phone_number varchar(12) unique,
	user_type int not null,
	primary key(user_id)
);

create table if not exists program(
	program_code varchar(25) not null,
	program_name varchar(150) not null,
	primary key(program_code)
);

create table if not exists house(
    house_id int auto_increment not null,
    house_name varchar(50) not null,
    house_points int not null,
    house_description varchar(150) not null,
    house_logo varchar(100) not null,
    primary key(house_id)
);

create table if not exists affiliation(
    affiliation_id int auto_increment not null,
    name varchar(150) not null,
    primary key(affiliation_id)
);

create table if not exists player(
	player_level int not null,
	experience int not null,
    program_code varchar(25) null,
    house_id int not null,
    user_id int not null,
    foreign key(program_code) references program(program_code),
    foreign key(house_id) references house(house_id),
    foreign key(user_id) references user(user_id)
);

create table if not exists npc(
	user_id int not null,
	is_verified int not null,
	foreign key(user_id) references user(user_id)
);

create table if not exists news(
	news_id int auto_increment not null,
	description varchar(150) not null,
    user_id int not null,
	primary key(news_id),
    foreign key(user_id) references npc(user_id)
);

create table if not exists office(
    office_id int auto_increment not null,
    office_name varchar(100) not null,
    office_abbreviation varchar(15) not null,
    office_logo varchar(150),
    office_description varchar(150) not null,
    user_id int not null,
    primary key(office_id),
    foreign key(user_id) references npc(user_id)
);

create table if not exists party(
    party_id int auto_increment not null,
    party_name varchar(50) not null,
    party_password varchar(40) not null,
    party_description varchar(150) not null,
    creator_id int not null,
    primary key(party_id),
    foreign key(creator_id) references npc(user_id)
);

create table if not exists badge(
    badge_id int auto_increment not null,
    badge_description varchar(200) not null,
    date_created date not null,
    creator_id int not null,
    primary key(badge_id),
    foreign key(creator_id) references user(user_id)
);

create table if not exists badge_ups(
    badge_ups_id int not null,
    badge_ups_name varchar(50) not null,
    badge_ups_lvl int not null,
    badge_ups_pix varchar(100) not null,
    requirement int not null,
    foreign key(badge_ups_id) references badge(badge_id)
);

create table if not exists quest(
    quest_id int auto_increment not null,
    quest_title varchar(150) not null,
    quest_description varchar(200) not null,
    quest_rarity int not null,
    date_created date not null,
    start_date date not null,
    end_date date,
    venue varchar(150) not null,
    experience int not null,
    house_points int not null,
    quest_type varchar(75) not null,
    creator_id int not null,
    badge_id int,
    primary key(quest_id),
    foreign key(badge_id) references badge(badge_id),
    foreign key(quest_rarity) references rarity(rarity_id),
    foreign key(quest_type) references quests_type(quest_type),
    foreign key(creator_id) references npc(user_id)
);

create table school(
	school_id int auto_increment not null,
	school_name varchar(100) not null,
	school_level int not null,
	primary key(school_id)
);

# Associative Properties
create table if not exists party_member(
    user_id int not null,
    party_id int not null,
    date_joined date not null,
    primary key(date_joined),
    foreign key(party_id) references party(party_id),
    foreign key(user_id) references player(user_id)
);

create table if not exists earned_badge(
    user_id int not null,
    badge_id int not null,
    date_earned date not null,
    foreign key(user_id) references player(user_id),
    foreign key(badge_id) references badge(badge_id)
);

create table if not exists quest_registration(
    user_id int not null,
    quest_id int not null,
    date_registered date not null,
    date_completed date,
    foreign key(user_id) references player(user_id),
    foreign key(quest_id) references quest(quest_id)
);

create table if not exists student_affiliations(
    start_date date not null,
    end_date date,
    position varchar(100) not null,
    user_id int not null,
    affiliation_id int not null,
    foreign key(user_id) references player(user_id),
    foreign key(affiliation_id) references affiliation(affiliation_id)
);

create table if not exists school_attended(
    start_date date not null,
    end_date date not null,
    school_id int not null,
    user_id int not null,
    foreign key(school_id) references school(school_id),
    foreign key(user_id) references user(user_id)
);

create table if not exists involvement(
    involvement_id int auto_increment,
    involvement_name varchar(100) not null,
    start_date date not null,
    end_date date,
    involvement_venue varchar(100) not null,
    user_id int not null,
    primary key(involvement_id),
    foreign key(user_id) references user(user_id)
);

create table if not exists event(
    username varchar(75),
    description varchar(150),
    date_time timestamp
);

create table if not exists facebook_settings(
    user_id int not null,
    access_token varchar(255),
    expiration_date datetime,
    foreign key(user_id) references user(user_id)    
);

create table if not exists hall_of_fame (
    hof_id int auto_increment,
    description varchar(100) not null,
    primary key(hof_id)
);

create table if not exists ranking (
    hof_id int not null,
    house_id int not null,
    points int not null,
    foreign key(house_id) references house(house_id),
    foreign key(hof_id) references hall_of_fame(hof_id)
);
/*# Extra Tables
create table if not exists settings(
    user_id int not null,
    show_badges int not null,
    show_timeline int not null,
    educ_bg int not null,
    connected_fb int not null,
    share_fb int not null,
    foreign key(user_id) references user(user_id)
);*/