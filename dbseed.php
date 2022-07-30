<?php
require 'bootstrap.php';

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS questions (
        id INT NOT NULL AUTO_INCREMENT,
        content VARCHAR(100) NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    CREATE TABLE IF NOT EXISTS answers (
        id INT NOT NULL AUTO_INCREMENT,
        content VARCHAR(100) NOT NULL,
        question_id INT DEFAULT NULL,
        is_correct TINYINT DEFAULT 0,
        PRIMARY KEY (id),
        FOREIGN KEY (question_id)
            REFERENCES questions(id)
            ON DELETE SET NULL
    ) ENGINE=INNODB;

    INSERT INTO questions
        (content)
    VALUES
        ('When they go low, we go high'),
        ('A person who never made a mistake never tried anything new'),
        ('Never interrupt your enemy when he is making a mistake'),
        ('If you can't stand the heat, get out of the kitchen');
        ('Education is the most powerful weapon which you can use to change the world');
        ('We know what we are, but know not what we may be');
        ('Life's most persistent and urgent question is, 'What are you doing for others?');
        ('No woman in my time will ever be Prime Minister?');
        ('I came, I saw, I conquered');
        ('You miss 100 percent of the shots you never take');
        ('We are not makers of history. We are made by history');
        ('Yo Taylor, I'm really happy for you, I'ma let you finish, but Beyoncé had one of the best videos of all time!');
        ('An eye for an eye only ends up making the whole world blind');
        ('From there to here, and here to there, funny things are everywhere');
        ('Only two things are infinite, the universe and human stupidity, and I’m not sure about the former');

    INSERT INTO answers
        (content, question_id, is_correct)
    VALUES
        ('Isaac Newton', 1, 0),
        ('Lady Gaga', 1, 0),
        ('Michelle Obama', 1, 1),
        ('Albert Einstein', 2, 1),
        ('Oscar Wilde', 2, 0),
        ('Donald Trump', 2, 0),
        ('Cristiano Ronaldo', 3, 0),
        ('Winston Churchill', 3, 0),
        ('Napoleon', 3, 1),
        ('Gordon Ramsey', 4, 0),
        ('Margaret Thatcher', 4, 0),
        ('Harry S Truman', 4, 1),
        ('Malala Yousafzai', 5, 0),
        ('Buddha', 5, 1),
        ('Queen Elizabeth II', 5, 0),
        ('Lord Alfred Tennyson', 6, 0);
        ('William Shakespeare', 6, 1);
        ('Wes Anderson', 6, 0);
        ('Serena Williams', 7, 0);
        ('Bradley Cooper', 7, 0);
        ('Martin Luther King Jr.', 7, 1);
        ('Rihanna', 8, 0);
        ('Margaret Thatcher', 8, 1);
        ('Cleopatra', 8, 0);
        ('Napoleon', 9, 0);
        ('Julius Caesar', 9, 1);
        ('Mao Tse Tung9, 9, 0);
        ('Wayne Gretzky', 10, 1);
        ('LeBron James', 10, 0);
        ('Michael Jordan', 10, 0);
        ('Barack Obama', 11, 0);
        ('Martin Luther King Jr.', 11, 1);
        ('Kanye West', 11, 0);
        ('Donald Trump', 12, 0);
        ('Danny DeVito', 12, 0);
        ('Kanye West', 12, 1);
        ('Gandhi', 13, 1);
        ('Wayne Rooney', 13, 0);
        ('Mother Teresa', 13, 0);
        ('Winnie the Pooh', 14, 0);
        ('Dr. Seuss', 14, 1);
        ('Dr. Phil', 14, 0);
        ('Severus Snape', 15, 1);
        ('Isaac Newton', 15, 0);
        ('Bill Gates', 15, 0);
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException$e) {
    exit($e->getMessage());
}
