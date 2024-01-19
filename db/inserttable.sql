-- Inserting data into the USER table
INSERT INTO USER (pseudo, score) VALUES
('user1', 100),
('user2', 85),
('user3', 70);

-- Inserting data into the QUESTION table
INSERT INTO QUESTION (intitule, category, difficulty) VALUES
('What is the capital of France?', 'Geography', 2),
('Who wrote Romeo and Juliet?', 'Literature', 3),
('What is the square root of 25?', 'Mathematics', 1);

-- Inserting data into the ANSWER table
INSERT INTO ANSWER (intitule, idq) VALUES
('Paris', 1),
('William Shakespeare', 2),
('5', 3);

-- Inserting data into the CORRECT_ANSWER table
INSERT INTO CORRECT_ANSWER (question_id, answer_id) VALUES
(1, 1),
(2, 2),
(3, 3);