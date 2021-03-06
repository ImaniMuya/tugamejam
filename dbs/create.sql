CREATE TABLE teams (
    team_id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    the_secret INTEGER
);
CREATE TABLE people (
    person_id INTEGER PRIMARY KEY,
    person_name TEXT NOT NULL,
    email TEXT,
    team_id INTEGER,
    FOREIGN KEY(team_id) REFERENCES teams(team_id)
    --    ON UPDATE CASCADE
    --    ON DELETE SET NULL
);
CREATE TABLE votes (
    team_id INTEGER PRIMARY KEY,
    theme1_id INTEGER,
    theme2_id INTEGER,
    theme3_id INTEGER,
    theme4_id INTEGER,
    theme5_id INTEGER,
    FOREIGN KEY(team_id) REFERENCES teams(team_id)
    --    ON UPDATE CASCADE
    --    ON DELETE SET NULL
);
CREATE TABLE themes (
    theme_id INTEGER PRIMARY KEY,
    theme TEXT
);
CREATE TABLE subm_questions (
    question_id INTEGER PRIMARY KEY,
    question TEXT,
    question_type TEXT -- maybe replace with category later
);
CREATE TABLE subm_answers (
    answer TEXT,
    question_id INTEGER,
    team_id INTEGER,
    PRIMARY KEY(question_id, team_id),
    FOREIGN KEY(question_id) REFERENCES subm_questions(question_id),
    FOREIGN KEY(team_id) REFERENCES teams(team_id)
);

-- INSERT INTO subm_questions (question, question_type) 
-- VALUES
-- ("Name", "text"),
-- ("Main Picture", "image"),
-- ("Picture 1", "image"),
-- ("Picture 2", "image"),
-- ("Description", "textarea"),
-- ("How To Play", "textarea"),
-- ("Submission zip", "file"),
-- ("Game URL", "text");

-- INSERT INTO themes (theme) 
-- VALUES
-- ("theme one"),
-- ("theme two"),
-- ("theme three"),
-- ("theme four"),
-- ("theme five");